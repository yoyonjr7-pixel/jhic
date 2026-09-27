<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spmb_pendaftar', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 150);
            $table->string('nik', 30)->nullable();
            $table->string('nisn', 30)->nullable();
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_hp', 30)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('asal_sekolah', 150)->nullable();
            $table->string('tahun_lulus', 10)->nullable();
            $table->string('pilihan_jurusan', 150)->nullable();
            $table->string('nama_ayah', 150)->nullable();
            $table->string('nama_ibu', 150)->nullable();
            $table->string('no_hp_orang_tua', 30)->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spmb_pendaftar');
    }
};
