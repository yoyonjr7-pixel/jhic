<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumni_track', function (Blueprint $table) {
            $table->id('id_alumni');
            $table->foreignId('id_siswa')
                ->constrained('siswa', 'id_siswa')
                ->cascadeOnDelete();
            $table->year('tahun_lulus');
            $table->string('no_telp', 20)->nullable();
            $table->string('email', 150)->nullable();
            $table->enum('status', ['bekerja', 'kuliah', 'wirausaha', 'mencari_kerja'])
                ->default('mencari_kerja');
            $table->text('keterangan')->nullable();
            $table->string('mentor', 150)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumni_track');
    }
};
