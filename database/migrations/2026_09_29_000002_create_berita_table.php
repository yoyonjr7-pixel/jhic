<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id('id_berita');
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('kategori', 100)->nullable();
            $table->string('penulis')->nullable();
            $table->longText('isi');
            $table->string('foto')->nullable();
            $table->date('tanggal_publish')->nullable();
            $table->string('status', 20)->default('Draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
