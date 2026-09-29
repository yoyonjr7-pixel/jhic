<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mentoring', function (Blueprint $table) {
            $table->id('id_mentoring');

            // Data siswa
            $table->unsignedBigInteger('id_siswa')->nullable();
            $table->unsignedBigInteger('id_jurusan')->nullable();

            // Data mentor/alumni
            $table->string('nama_mentor');
            $table->string('no_telp_mentor')->nullable();

            // Data permintaan mentoring
            $table->string('topik');
            $table->text('deskripsi')->nullable();

            // Status proses mentoring
            $table->enum('status', [
                'Menunggu',
                'Dihubungi',
                'Disetujui',
                'Ditolak',
                'Selesai'
            ])->default('Menunggu');

            // Catatan admin
            $table->text('catatan_admin')->nullable();

            // Tanggal proses
            $table->dateTime('tanggal_pengajuan')->nullable();
            $table->dateTime('tanggal_dihubungi')->nullable();
            $table->dateTime('tanggal_selesai')->nullable();

            $table->timestamps();

            // Relasi ke tabel siswa
            $table->foreign('id_siswa')
                ->references('id_siswa')
                ->on('siswa')
                ->nullOnDelete();

            // Relasi ke tabel jurusan
            $table->foreign('id_jurusan')
                ->references('id_jurusan')
                ->on('jurusan')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentoring');
    }
};