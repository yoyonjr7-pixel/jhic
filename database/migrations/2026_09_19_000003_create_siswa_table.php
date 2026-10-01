<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id('id_siswa');
            $table->string('nisn', 20)->unique();
            $table->string('nama_siswa', 150);
            $table->string('kelas', 20);
            $table->foreignId('id_jurusan')
                ->constrained('jurusan', 'id_jurusan')
                ->cascadeOnDelete();
            $table->enum('status', ['aktif', 'lulus', 'keluar'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
