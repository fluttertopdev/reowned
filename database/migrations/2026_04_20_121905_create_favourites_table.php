<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('favourites')) {
            Schema::create('favourites', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('favourites', function (Blueprint $table) {

            if (!Schema::hasColumn('favourites', 'item_id')) {
                $table->unsignedBigInteger('item_id')->after('id');
                $table->index('item_id');
            }

            if (!Schema::hasColumn('favourites', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('item_id');
                $table->index('user_id');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favourites');
    }
};