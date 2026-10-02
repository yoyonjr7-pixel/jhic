<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('unduh_informasi', function (Blueprint $table): void {
            $table->string('nama_file')->nullable()->change();
            $table->string('file_path')->nullable()->change();
            $table->string('format_file', 20)->nullable()->change();
            $table->unsignedBigInteger('ukuran_file')->nullable()->change();
        });
    }

    public function down(): void
    {
        $hasRecordsWithoutFiles = DB::table('unduh_informasi')
            ->where(function ($query): void {
                $query->whereNull('nama_file')
                    ->orWhereNull('file_path')
                    ->orWhereNull('format_file')
                    ->orWhereNull('ukuran_file');
            })
            ->exists();

        if ($hasRecordsWithoutFiles) {
            throw new RuntimeException(
                'Unggah file untuk semua informasi sebelum membatalkan migrasi ini.'
            );
        }

        Schema::table('unduh_informasi', function (Blueprint $table): void {
            $table->string('nama_file')->nullable(false)->change();
            $table->string('file_path')->nullable(false)->change();
            $table->string('format_file', 20)->nullable(false)->change();
            $table->unsignedBigInteger('ukuran_file')->nullable(false)->change();
        });
    }
};
