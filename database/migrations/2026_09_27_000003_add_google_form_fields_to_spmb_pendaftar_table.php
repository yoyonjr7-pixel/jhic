<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('spmb_pendaftar', 'hobi')) {
            return;
        }
        Schema::table('spmb_pendaftar', function (Blueprint $table) {
            $table->string('hobi', 150)->nullable();
            $table->string('keahlian_khusus', 200)->nullable();
            $table->string('cita_cita', 150)->nullable();
            $table->string('kebutuhan_khusus', 200)->nullable();
            $table->text('informasi_kebutuhan_khusus')->nullable();
            $table->string('agama', 50)->nullable();
            $table->string('telepon_siswa', 30)->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->string('asal_smp', 150)->nullable();
            $table->text('alamat_smp')->nullable();
            $table->string('jurusan_pilihan_1', 150)->nullable();
            $table->string('jurusan_pilihan_2', 150)->nullable();
            $table->string('pendidikan_ayah', 100)->nullable();
            $table->string('pendidikan_ibu', 100)->nullable();
            $table->string('pekerjaan_ayah', 150)->nullable();
            $table->string('pekerjaan_ibu', 150)->nullable();
            $table->text('alamat_orang_tua')->nullable();
            $table->string('telp_ayah', 30)->nullable();
            $table->string('telp_ibu', 30)->nullable();
            $table->string('nama_wali', 150)->nullable();
            $table->string('agama_wali', 50)->nullable();
            $table->string('pekerjaan_wali', 150)->nullable();
            $table->text('alamat_wali')->nullable();
            $table->string('telp_wali', 30)->nullable();
            $table->string('foto_siswa')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('spmb_pendaftar', function (Blueprint $table) {
            $table->dropColumn([
                'hobi',
                'keahlian_khusus',
                'cita_cita',
                'kebutuhan_khusus',
                'informasi_kebutuhan_khusus',
                'agama',
                'telepon_siswa',
                'alamat_lengkap',
                'asal_smp',
                'alamat_smp',
                'jurusan_pilihan_1',
                'jurusan_pilihan_2',
                'pendidikan_ayah',
                'pendidikan_ibu',
                'pekerjaan_ayah',
                'pekerjaan_ibu',
                'alamat_orang_tua',
                'telp_ayah',
                'telp_ibu',
                'nama_wali',
                'agama_wali',
                'pekerjaan_wali',
                'alamat_wali',
                'telp_wali',
                'foto_siswa',
            ]);
        });
    }
};
