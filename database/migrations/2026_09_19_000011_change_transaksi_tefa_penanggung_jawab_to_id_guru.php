<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Kolom lama `penanggung_jawab` menunjuk ke tabel `siswa`, sedangkan
        // penggantinya `id_guru` menunjuk ke tabel `guru`. Karena sasaran relasi
        // berubah, nilainya tidak dapat dipetakan otomatis dan tidak dipindahkan.
        // Pastikan data lama sudah dibackup bila masih dibutuhkan sebelum deploy.
        if (Schema::hasColumn('transaksi_tefa', 'penanggung_jawab')) {
            Schema::table('transaksi_tefa', function (Blueprint $table) {
                $table->dropForeign(['penanggung_jawab']);
                $table->dropColumn('penanggung_jawab');
            });
        }

        if (! Schema::hasColumn('transaksi_tefa', 'id_guru')) {
            Schema::table('transaksi_tefa', function (Blueprint $table) {
                $table->foreignId('id_guru')
                    ->nullable()
                    ->after('id_layanan')
                    ->constrained('guru', 'id_guru')
                    ->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('transaksi_tefa', 'id_guru')) {
            Schema::table('transaksi_tefa', function (Blueprint $table) {
                $table->dropForeign(['id_guru']);
                $table->dropColumn('id_guru');
            });
        }

        if (! Schema::hasColumn('transaksi_tefa', 'penanggung_jawab')) {
            Schema::table('transaksi_tefa', function (Blueprint $table) {
                $table->foreignId('penanggung_jawab')
                    ->nullable()
                    ->after('id_layanan')
                    ->constrained('siswa', 'id_siswa')
                    ->nullOnDelete();
            });
        }
    }
};
