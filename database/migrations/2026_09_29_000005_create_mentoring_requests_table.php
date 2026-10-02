<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mentoring_requests', function (Blueprint $table): void {
            $table->id('id_mentoring');
            $table->foreignId('id_mentor')
                ->nullable()
                ->constrained('alumni_track', 'id_alumni')
                ->nullOnDelete();
            $table->string('mentor_nama', 150);
            $table->string('nama_pemohon', 150);
            $table->string('status_pemohon', 100);
            $table->text('topik');
            $table->string('status_pengajuan', 30)->default('menunggu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentoring_requests');
    }
};
