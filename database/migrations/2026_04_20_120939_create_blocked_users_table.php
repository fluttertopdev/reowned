<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('blocked_users')) {
            Schema::create('blocked_users', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
            });
        }

        // Add missing columns safely
        Schema::table('blocked_users', function (Blueprint $table) {

            if (!Schema::hasColumn('blocked_users', 'blocked_by')) {
                $table->unsignedBigInteger('blocked_by')->after('id');
                $table->index('blocked_by');
            }

            if (!Schema::hasColumn('blocked_users', 'blocked_user_id')) {
                $table->unsignedBigInteger('blocked_user_id')->after('blocked_by');
                $table->index('blocked_user_id');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blocked_users');
    }
};