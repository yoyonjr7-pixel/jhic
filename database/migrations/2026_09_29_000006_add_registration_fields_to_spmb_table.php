<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $columns = [
            'email' => fn (Blueprint $table) => $table->string('email', 150)->nullable(),
            'whatsapp_siswa' => fn (Blueprint $table) => $table->string('whatsapp_siswa', 30)->nullable(),
            'whatsapp_orang_tua' => fn (Blueprint $table) => $table->string('whatsapp_orang_tua', 30)->nullable(),
            'alamat' => fn (Blueprint $table) => $table->text('alamat')->nullable(),
            'asal_sekolah' => fn (Blueprint $table) => $table->string('asal_sekolah', 150)->nullable(),
            'agama' => fn (Blueprint $table) => $table->string('agama', 50)->nullable(),
            'jurusan' => fn (Blueprint $table) => $table->string('jurusan', 150)->nullable(),
            'sumber_informasi' => fn (Blueprint $table) => $table->string('sumber_informasi', 100)->nullable(),
            'status' => fn (Blueprint $table) => $table->string('status', 30)->default('Baru'),
        ];
        $missing = array_filter(
            $columns,
            static fn (Closure $column, string $name): bool => ! Schema::hasColumn('spmb', $name),
            ARRAY_FILTER_USE_BOTH
        );

        if ($missing === []) {
            return;
        }

        Schema::table('spmb', function (Blueprint $table) use ($missing): void {
            foreach ($missing as $column) {
                $column($table);
            }
        });
    }

    public function down(): void
    {
        // Keep collected registrations intact when rolling back this additive schema change.
    }
};
