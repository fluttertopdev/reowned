<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('language_codes')) {
            Schema::create('language_codes', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('language_codes', function (Blueprint $table) {

            if (!Schema::hasColumn('language_codes', 'name')) {
                $table->string('name')->nullable()->after('id');
                $table->index('name');
            }

            if (!Schema::hasColumn('language_codes', 'code')) {
                $table->string('code')->nullable()->after('name');
                $table->index('code');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('language_codes');
    }
};