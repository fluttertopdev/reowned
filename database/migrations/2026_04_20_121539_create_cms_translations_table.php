<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('cms_translations')) {
            Schema::create('cms_translations', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('cms_translations', function (Blueprint $table) {

            if (!Schema::hasColumn('cms_translations', 'cms_id')) {
                $table->unsignedBigInteger('cms_id')->after('id');
                $table->index('cms_id');
            }

            if (!Schema::hasColumn('cms_translations', 'language_code')) {
                $table->string('language_code', 10)->after('cms_id');
                $table->index('language_code');
            }

            if (!Schema::hasColumn('cms_translations', 'page_name')) {
                $table->string('page_name')->after('language_code');
            }

            if (!Schema::hasColumn('cms_translations', 'description')) {
                $table->text('description')->nullable()->after('page_name');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cms_translations');
    }
};