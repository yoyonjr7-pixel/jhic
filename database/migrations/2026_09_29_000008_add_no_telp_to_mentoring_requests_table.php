<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mentoring_requests', function (Blueprint $table): void {
            $table->string('no_telp', 30)->nullable()->after('nama_pemohon');
        });
    }

    public function down(): void
    {
        Schema::table('mentoring_requests', function (Blueprint $table): void {
            $table->dropColumn('no_telp');
        });
    }
};
