<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lowongan_kerja', function (Blueprint $table) {
            $table->id('id_lowongan');
            $table->string('nama_lowongan', 150);
            $table->text('deskripsi')->nullable();
            $table->integer('jumlah')->default(0);
            $table->string('status', 30)->default('dibuka');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lowongan_kerja');
    }
};
