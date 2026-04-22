<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('permissions')) {
            Schema::create('permissions', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('permissions', function (Blueprint $table) {

            if (!Schema::hasColumn('permissions', 'module')) {
                $table->string('module')->after('id');
            }

            if (!Schema::hasColumn('permissions', 'name')) {
                $table->string('name')->after('module');
                $table->index('name');
            }

            if (!Schema::hasColumn('permissions', 'permission_name')) {
                $table->string('permission_name')->after('name');
            }

            if (!Schema::hasColumn('permissions', 'group')) {
                $table->string('group', 50)->after('permission_name');
                $table->index('group');
            }

            if (!Schema::hasColumn('permissions', 'guard_name')) {
                $table->string('guard_name', 50)->default('web')->after('group');
            }

            if (!Schema::hasColumn('permissions', 'is_default')) {
                $table->boolean('is_default')->default(false)->after('guard_name');
            }

            // Ensure timestamps exist (for safety)
            if (!Schema::hasColumn('permissions', 'created_at')) {
                $table->timestamp('created_at')->nullable();
            }

            if (!Schema::hasColumn('permissions', 'updated_at')) {
                $table->timestamp('updated_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};