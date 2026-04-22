<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('userreports')) {
            Schema::create('userreports', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('userreports', function (Blueprint $table) {

            if (!Schema::hasColumn('userreports', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
                $table->index('user_id');
            }

            if (!Schema::hasColumn('userreports', 'item_id')) {
                $table->unsignedBigInteger('item_id')->nullable()->after('user_id');
                $table->index('item_id');
            }

            if (!Schema::hasColumn('userreports', 'reason_id')) {
                $table->unsignedBigInteger('reason_id')->nullable()->after('item_id');
                $table->index('reason_id');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('userreports');
    }
};