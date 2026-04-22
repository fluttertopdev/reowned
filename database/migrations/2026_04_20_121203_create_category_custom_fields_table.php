<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('category_custom_fields')) {
            Schema::create('category_custom_fields', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
            });
        }

        // Add missing columns safely
        Schema::table('category_custom_fields', function (Blueprint $table) {

            if (!Schema::hasColumn('category_custom_fields', 'category_id')) {
                $table->unsignedBigInteger('category_id')->after('id');
                $table->index('category_id');
            }

            if (!Schema::hasColumn('category_custom_fields', 'field_name')) {
                $table->string('field_name')->after('category_id');
            }

            if (!Schema::hasColumn('category_custom_fields', 'field_type')) {
                $table->enum('field_type', ['textbox', 'number', 'dropdown', 'checkbox'])->after('field_name');
            }

            if (!Schema::hasColumn('category_custom_fields', 'min_length')) {
                $table->integer('min_length')->nullable()->after('field_type');
            }

            if (!Schema::hasColumn('category_custom_fields', 'max_length')) {
                $table->integer('max_length')->nullable()->after('min_length');
            }

            if (!Schema::hasColumn('category_custom_fields', 'is_required')) {
                $table->boolean('is_required')->default(false)->after('max_length');
            }

            if (!Schema::hasColumn('category_custom_fields', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('is_required');
            }

            if (!Schema::hasColumn('category_custom_fields', 'sort_order')) {
                $table->integer('sort_order')->default(0)->after('is_active');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_custom_fields');
    }
};