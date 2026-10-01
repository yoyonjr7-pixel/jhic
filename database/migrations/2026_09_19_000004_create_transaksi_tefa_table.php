<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_tefa', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->string('nama_pelanggan', 150);
            $table->date('tanggal');
            $table->string('no_telp', 20)->nullable();
            $table->text('deskripsi');
            $table->foreignId('id_layanan')
                ->constrained('layanan', 'id_layanan')
                ->cascadeOnDelete();
            $table->foreignId('penanggung_jawab')
                ->nullable()
                ->constrained('siswa', 'id_siswa')
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_tefa');
    }
};
