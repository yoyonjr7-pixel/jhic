<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mentoring', function (Blueprint $table): void {
            $table->id();
            $table->string('nama_siswa', 150);
            $table->string('no_telp', 15)->nullable();
            $table->foreignId('id_siswa')->nullable()->constrained('siswa', 'id_siswa')->nullOnDelete();
            $table->foreignId('id_jurusan')->nullable()->constrained('jurusan', 'id_jurusan')->nullOnDelete();
            $table->string('kelas', 20)->nullable();
            $table->foreignId('id_alumni')->nullable()->constrained('alumni_track', 'id_alumni')->nullOnDelete();
            $table->string('nama_mentor', 150)->nullable();
            $table->string('topik_mentoring', 255);
            $table->text('catatan')->nullable();
            $table->enum('status', ['pending', 'diproses', 'selesai'])->default('pending');
            $table->date('tanggal')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('mentoring'); }
};