<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('adpackages_translations')) {
            Schema::create('adpackages_translations', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('adpackages_translations', function (Blueprint $table) {

            if (!Schema::hasColumn('adpackages_translations', 'adspackage_id')) {
                $table->integer('adspackage_id')->nullable()->after('id');
            }

            if (!Schema::hasColumn('adpackages_translations', 'language_code')) {
                $table->string('language_code', 30)->nullable()->after('adspackage_id');
            }

            if (!Schema::hasColumn('adpackages_translations', 'name')) {
                $table->string('name')->nullable()->after('language_code');
            }

            if (!Schema::hasColumn('adpackages_translations', 'description')) {
                $table->text('description')->nullable()->after('name');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adpackages_translations');
    }
};