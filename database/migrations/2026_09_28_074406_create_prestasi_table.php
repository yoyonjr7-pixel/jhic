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
            $table->string('kelas')->nullable();

            $table->unsignedBigInteger('id_jurusan')->nullable();

            $table->string('tingkat')->nullable();
            $table->string('juara')->nullable();
            $table->year('tahun')->nullable();

            $table->string('foto')->nullable();

            $table->text('deskripsi')->nullable();

            $table->timestamps();

            $table->foreign('id_jurusan')
                ->references('id_jurusan')
                ->on('jurusan')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};