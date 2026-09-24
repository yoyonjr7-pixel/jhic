<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('alumni_track', function (Blueprint $table) {
            // Drop FK dulu
            $table->dropForeign(['id_siswa']);
            // Ubah jadi nullable tanpa FK
            $table->unsignedBigInteger('id_siswa')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('alumni_track', function (Blueprint $table) {
            $table->unsignedBigInteger('id_siswa')->nullable(false)->change();
            $table->foreign('id_siswa')->references('id_siswa')->on('siswa')->cascadeOnDelete();
        });
    }
};
