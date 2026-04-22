<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('item_images')) {
            Schema::create('item_images', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('item_images', function (Blueprint $table) {

            if (!Schema::hasColumn('item_images', 'item_id')) {
                $table->unsignedBigInteger('item_id')->after('id');
                $table->index('item_id');
            }

            if (!Schema::hasColumn('item_images', 'image')) {
                $table->string('image')->after('item_id');
            }

            if (!Schema::hasColumn('item_images', 'status')) {
                $table->tinyInteger('status')->default(1)->after('image');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_images');
    }
};