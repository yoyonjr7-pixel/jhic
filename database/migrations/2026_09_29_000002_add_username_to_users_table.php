<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('users') || Schema::hasColumn('users', 'username')) return;
        Schema::table('users', function (Blueprint $table): void { $table->string('username')->nullable()->after('name'); });
        $used = [];
        DB::table('users')->orderBy('id')->each(function (object $user) use (&$used): void {
            $localPart = strtolower((string) strtok((string) $user->email, '@'));
            $username = trim((string) preg_replace('/[^a-z0-9._-]+/', '_', $localPart), '._-');
            $username = substr($username ?: 'user-' . $user->id, 0, 240);
            $base = $username; $suffix = 1;
            while (isset($used[$username])) $username = substr($base, 0, 240 - strlen((string) $suffix) - 1) . '-' . $suffix++;
            $used[$username] = true;
            DB::table('users')->where('id', $user->id)->update(['username' => $username]);
        });
        Schema::table('users', function (Blueprint $table): void { $table->unique('username'); });
    }
    public function down(): void
    {
        if (Schema::hasTable('users') && Schema::hasColumn('users', 'username')) Schema::table('users', function (Blueprint $table): void { $table->dropUnique(['username']); $table->dropColumn('username'); });
    }
};