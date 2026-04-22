<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('category_custom_field_options')) {
            Schema::create('category_custom_field_options', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
            });
        }

        // Add missing columns safely
        Schema::table('category_custom_field_options', function (Blueprint $table) {

            if (!Schema::hasColumn('category_custom_field_options', 'custom_field_id')) {
                $table->unsignedBigInteger('custom_field_id')->after('id');
                $table->index('custom_field_id');
            }

            if (!Schema::hasColumn('category_custom_field_options', 'option_value')) {
                $table->string('option_value')->after('custom_field_id');
            }

            if (!Schema::hasColumn('category_custom_field_options', 'sort_order')) {
                $table->integer('sort_order')->default(0)->after('option_value');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_custom_field_options');
    }
};