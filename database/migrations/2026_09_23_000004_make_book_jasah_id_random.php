<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE book_jasah MODIFY id_bookjasah BIGINT UNSIGNED NOT NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE book_jasah MODIFY id_bookjasah BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
    }
};
