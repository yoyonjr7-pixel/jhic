<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $addJurusan = ! Schema::hasColumn('lowongan_kerja', 'id_jurusan');
        $addGajiMin = ! Schema::hasColumn('lowongan_kerja', 'gaji_min');
        $addGajiMax = ! Schema::hasColumn('lowongan_kerja', 'gaji_max');
        $addSkills = ! Schema::hasColumn('lowongan_kerja', 'skills');

        if (! $addJurusan && ! $addGajiMin && ! $addGajiMax && ! $addSkills) {
            return;
        }

        Schema::table('lowongan_kerja', function (Blueprint $table) use ($addJurusan, $addGajiMin, $addGajiMax, $addSkills): void {
            if ($addJurusan) {
                $table->foreignId('id_jurusan')
                    ->nullable()
                    ->constrained('jurusan', 'id_jurusan')
                    ->nullOnDelete();
            }

            if ($addGajiMin) {
                $table->unsignedBigInteger('gaji_min')->nullable();
            }

            if ($addGajiMax) {
                $table->unsignedBigInteger('gaji_max')->nullable();
            }

            if ($addSkills) {
                $table->json('skills')->nullable();
            }
        });
    }

    public function down(): void
    {
        // These fields may already exist on installations created before this migration.
    }
};
