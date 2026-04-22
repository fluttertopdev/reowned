<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('item_custom_fields')) {
            Schema::create('item_custom_fields', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
            });
        }

        // Add missing columns safely
        Schema::table('item_custom_fields', function (Blueprint $table) {

            if (!Schema::hasColumn('item_custom_fields', 'item_id')) {
                $table->unsignedBigInteger('item_id')->nullable()->after('id');
                $table->index('item_id');
            }

            if (!Schema::hasColumn('item_custom_fields', 'custom_field_id')) {
                $table->unsignedBigInteger('custom_field_id')->nullable()->after('item_id');
                $table->index('custom_field_id');
            }

            if (!Schema::hasColumn('item_custom_fields', 'value')) {
                $table->string('value')->nullable()->after('custom_field_id');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_custom_fields');
    }
};