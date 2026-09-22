<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking_tefa', function (Blueprint $table) {
            $table->unsignedBigInteger('id_book')->primary();
            $table->foreignId('id_transaksi')
                ->constrained('transaksi_tefa', 'id_transaksi')
                ->cascadeOnDelete();
            $table->enum('status_book', ['pending', 'diproses', 'selesai', 'batal'])
                ->default('pending');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_tefa');
    }
};
