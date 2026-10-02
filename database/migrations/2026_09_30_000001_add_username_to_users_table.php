<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('users')) {
            return;
        }

        if (! Schema::hasColumn('users', 'username')) {
            Schema::table('users', function (Blueprint $table): void {
                $table->string('username')->nullable()->after('name');
            });
        }

        if (Schema::hasColumn('users', 'email')) {
            $used = [];

            DB::table('users')->orderBy('id')->each(function (object $user) use (&$used): void {
                $localPart = strtolower((string) strtok((string) $user->email, '@'));
                $base = trim((string) preg_replace('/[^a-z0-9._-]+/', '_', $localPart), '._-');
                $base = substr($base ?: 'user-' . $user->id, 0, 240);
                $username = $user->username ?: $base;
                $suffix = 1;

                while (isset($used[strtolower($username)])) {
                    $username = substr($base, 0, 240 - strlen((string) $suffix) - 1) . '-' . $suffix++;
                }

                $used[strtolower($username)] = true;
                DB::table('users')->where('id', $user->id)->update(['username' => $username]);
            });

            Schema::table('users', function (Blueprint $table): void {
                $table->string('email')->nullable()->change();
            });
        }

        Schema::table('users', function (Blueprint $table): void {
            $table->string('username')->nullable(false)->change();
        });

        $hasUniqueUsername = collect(Schema::getIndexes('users'))->contains(
            fn (array $index): bool => $index['unique'] && $index['columns'] === ['username']
        );

        if (! $hasUniqueUsername) {
            Schema::table('users', function (Blueprint $table): void {
                $table->unique('username');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('users')) {
            return;
        }

        if (Schema::hasColumn('users', 'email')) {
            DB::table('users')->whereNull('email')->orderBy('id')->each(function (object $user): void {
                DB::table('users')->where('id', $user->id)->update([
                    'email' => 'user-' . $user->id . '@invalid.local',
                ]);
            });

            Schema::table('users', function (Blueprint $table): void {
                $table->string('email')->nullable(false)->change();
            });
        }

        if (Schema::hasColumn('users', 'username')) {
            Schema::table('users', function (Blueprint $table): void {
                $table->dropUnique(['username']);
                $table->dropColumn('username');
            });
        }
    }
};
