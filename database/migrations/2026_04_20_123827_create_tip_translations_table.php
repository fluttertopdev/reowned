<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('tip_translations')) {
            Schema::create('tip_translations', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('tip_translations', function (Blueprint $table) {

            if (!Schema::hasColumn('tip_translations', 'tip_id')) {
                $table->unsignedBigInteger('tip_id')->nullable()->after('id');
                $table->index('tip_id');
            }

            if (!Schema::hasColumn('tip_translations', 'language_code')) {
                $table->string('language_code', 30)->nullable()->after('tip_id');
                $table->index('language_code');
            }

            if (!Schema::hasColumn('tip_translations', 'description')) {
                $table->text('description')->nullable()->after('language_code');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tip_translations');
    }
};