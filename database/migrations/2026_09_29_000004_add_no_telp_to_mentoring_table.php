<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('mentoring', 'no_telp')) {
            Schema::table('mentoring', function (Blueprint $table): void {
                $table->string('no_telp', 15)->nullable()->after('nama_siswa');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('mentoring', 'no_telp')) {
            Schema::table('mentoring', function (Blueprint $table): void {
                $table->dropColumn('no_telp');
            });
        }
    }
};
