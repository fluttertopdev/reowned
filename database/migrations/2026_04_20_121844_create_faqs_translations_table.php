<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('faqs_translations')) {
            Schema::create('faqs_translations', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('faqs_translations', function (Blueprint $table) {

            if (!Schema::hasColumn('faqs_translations', 'faq_id')) {
                $table->unsignedBigInteger('faq_id')->nullable()->after('id');
                $table->index('faq_id');
            }

            if (!Schema::hasColumn('faqs_translations', 'language_code')) {
                $table->string('language_code', 30)->nullable()->after('faq_id');
                $table->index('language_code');
            }

            if (!Schema::hasColumn('faqs_translations', 'title')) {
                $table->text('title')->nullable()->after('language_code');
            }

            if (!Schema::hasColumn('faqs_translations', 'description')) {
                $table->text('description')->nullable()->after('title');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faqs_translations');
    }
};