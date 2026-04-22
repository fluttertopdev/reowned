<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('roles')) {
            Schema::create('roles', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
            });
        }

        // Add missing columns safely
        Schema::table('roles', function (Blueprint $table) {

            if (!Schema::hasColumn('roles', 'name')) {
                $table->string('name', 50)->after('id');
                $table->index('name');
            }

            if (!Schema::hasColumn('roles', 'guard_name')) {
                $table->string('guard_name')->default('web')->after('name');
            }

            if (!Schema::hasColumn('roles', 'status')) {
                $table->boolean('status')->default(true)->after('guard_name');
                $table->index('status');
            }

            // Ensure timestamps exist
            if (!Schema::hasColumn('roles', 'created_at')) {
                $table->timestamp('created_at')->nullable();
            }

            if (!Schema::hasColumn('roles', 'updated_at')) {
                $table->timestamp('updated_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};