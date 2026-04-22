<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('user_recent_views')) {
            Schema::create('user_recent_views', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
            });
        }

        // Add missing columns safely
        Schema::table('user_recent_views', function (Blueprint $table) {

            if (!Schema::hasColumn('user_recent_views', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
                $table->index('user_id');
            }

            if (!Schema::hasColumn('user_recent_views', 'item_id')) {
                $table->unsignedBigInteger('item_id')->nullable()->after('user_id');
                $table->index('item_id');
            }

            if (!Schema::hasColumn('user_recent_views', 'category_id')) {
                $table->unsignedBigInteger('category_id')->nullable()->after('item_id');
                $table->index('category_id');
            }

            if (!Schema::hasColumn('user_recent_views', 'type')) {
                $table->string('type')->default('item')->after('category_id');
                $table->index('type');
            }

            // Ensure created_at exists
            if (!Schema::hasColumn('user_recent_views', 'created_at')) {
                $table->timestamp('created_at')->nullable();
                $table->index('created_at');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_recent_views');
    }
};