<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('spmb_pendaftar', function (Blueprint $table) {
            $table->string('whatsapp_siswa', 30)->nullable();
            $table->string('whatsapp_orang_tua', 30)->nullable();
            $table->string('jurusan', 150)->nullable();
            $table->string('sumber_informasi', 100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('spmb_pendaftar', function (Blueprint $table) {
            $table->dropColumn([
                'whatsapp_siswa',
                'whatsapp_orang_tua',
                'jurusan',
                'sumber_informasi',
            ]);
        });
    }
};
