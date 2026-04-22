<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('categories_translations')) {
            Schema::create('categories_translations', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('categories_translations', function (Blueprint $table) {

            if (!Schema::hasColumn('categories_translations', 'category_id')) {
                $table->unsignedBigInteger('category_id')->nullable()->after('id');
                $table->index('category_id');
            }

            if (!Schema::hasColumn('categories_translations', 'language_code')) {
                $table->string('language_code', 30)->nullable()->after('category_id');
                $table->index('language_code');
            }

            if (!Schema::hasColumn('categories_translations', 'name')) {
                $table->string('name')->nullable()->after('language_code');
            }

            if (!Schema::hasColumn('categories_translations', 'description')) {
                $table->text('description')->nullable()->after('name');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories_translations');
    }
};