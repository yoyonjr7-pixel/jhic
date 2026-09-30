<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $columns = [
        'whatsapp_siswa' => ['string', 30],
        'whatsapp_orang_tua' => ['string', 30],
        'jurusan' => ['string', 150],
        'sumber_informasi' => ['string', 100],
    ];

    public function up(): void
    {
        $missing = array_filter($this->columns, static fn (array $definition, string $column): bool => ! Schema::hasColumn('spmb_pendaftar', $column), ARRAY_FILTER_USE_BOTH);
        if ($missing === []) return;
        Schema::table('spmb_pendaftar', function (Blueprint $table) use ($missing): void {
            foreach ($missing as $column => [$type, $length]) $table->{$type}($column, $length)->nullable();
        });
    }

    public function down(): void
    {
        $present = array_keys(array_filter($this->columns, static fn (array $definition, string $column): bool => Schema::hasColumn('spmb_pendaftar', $column), ARRAY_FILTER_USE_BOTH));
        if ($present !== []) Schema::table('spmb_pendaftar', fn (Blueprint $table) => $table->dropColumn($present));
    }
};