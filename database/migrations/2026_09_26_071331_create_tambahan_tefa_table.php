<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tambahan_tefa', function (Blueprint $table) {
            $table->id('id_tambahan');

            $table->unsignedBigInteger('id_book');

            $table->string('nama_tambahan', 150);

            $table->text('keterangan')->nullable();

            $table->decimal('harga', 12, 2)->default(0);

            $table->timestamps();

            $table->foreign('id_book')
                ->references('id_book')
                ->on('booking_tefa')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tambahan_tefa');
    }
};