<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id('id_prestasi');
            $table->string('judul_prestasi');
            $table->string('nama_pemenang');
            $table->string('kelas', 50)->nullable();
            $table->foreignId('id_jurusan')
                ->nullable()
                ->constrained('jurusan', 'id_jurusan')
                ->nullOnDelete();
            $table->string('tingkat', 100)->nullable();
            $table->string('juara', 100)->nullable();
            $table->unsignedSmallInteger('tahun')->nullable();
            $table->string('foto')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};
