<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('book_jasah', function (Blueprint $table) {
            $table->id('id_bookjasah');
            $table->foreignId('id_alumni')
                ->constrained('alumni_track', 'id_alumni')
                ->cascadeOnDelete();
            $table->enum('status_book', ['pending', 'diproses', 'selesai', 'batal'])
                ->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('book_jasah');
    }
};
