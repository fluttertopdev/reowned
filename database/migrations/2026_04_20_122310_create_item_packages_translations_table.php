<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('item_packages_translations')) {
            Schema::create('item_packages_translations', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('item_packages_translations', function (Blueprint $table) {

            if (!Schema::hasColumn('item_packages_translations', 'itempackage_id')) {
                $table->unsignedBigInteger('itempackage_id')->nullable()->after('id');
                $table->index('itempackage_id');
            }

            if (!Schema::hasColumn('item_packages_translations', 'language_code')) {
                $table->string('language_code', 30)->nullable()->after('itempackage_id');
                $table->index('language_code');
            }

            if (!Schema::hasColumn('item_packages_translations', 'name')) {
                $table->string('name')->nullable()->after('language_code');
            }

            if (!Schema::hasColumn('item_packages_translations', 'description')) {
                $table->text('description')->nullable()->after('name');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_packages_translations');
    }
};