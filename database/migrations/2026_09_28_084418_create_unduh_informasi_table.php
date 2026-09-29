
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('unduh_informasi', function (Blueprint $table) {

            $table->id('id_informasi');

            $table->string('judul');

            $table->string('slug')->unique();

            $table->string('kategori')->nullable();

            $table->text('deskripsi')->nullable();

            $table->string('nama_file');

            $table->string('file_path');

            $table->string('format_file', 20)->nullable();

            $table->unsignedBigInteger('ukuran_file')->nullable();

            $table->enum('status', ['Draft', 'Terbit'])
                ->default('Draft');

            $table->date('tanggal_publish')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unduh_informasi');
    }
};