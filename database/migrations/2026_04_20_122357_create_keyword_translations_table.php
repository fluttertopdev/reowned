<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('keyword_translations')) {
            Schema::create('keyword_translations', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('keyword_translations', function (Blueprint $table) {

            if (!Schema::hasColumn('keyword_translations', 'language_id')) {
                $table->unsignedBigInteger('language_id')->default(0)->after('id');
                $table->index('language_id');
            }

            if (!Schema::hasColumn('keyword_translations', 'group')) {
                $table->string('group', 191)->nullable()->after('language_id');
                $table->index('group');
            }

            if (!Schema::hasColumn('keyword_translations', 'keyword')) {
                $table->text('keyword')->nullable()->after('group');
            }

            if (!Schema::hasColumn('keyword_translations', 'key')) {
                $table->text('key')->nullable()->after('keyword');
            }

            if (!Schema::hasColumn('keyword_translations', 'value')) {
                $table->text('value')->nullable()->after('key');
            }

            if (!Schema::hasColumn('keyword_translations', 'created_at')) {
                $table->timestamp('created_at')->nullable()->after('value');
                $table->index('created_at');
            }

            if (!Schema::hasColumn('keyword_translations', 'updated_at')) {
                $table->timestamp('updated_at')->nullable()->after('created_at');
                $table->index('updated_at');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keyword_translations');
    }
};