<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('report_reason_translations')) {
            Schema::create('report_reason_translations', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('report_reason_translations', function (Blueprint $table) {

            if (!Schema::hasColumn('report_reason_translations', 'reason_id')) {
                $table->unsignedBigInteger('reason_id')->nullable()->after('id');
                $table->index('reason_id');
            }

            if (!Schema::hasColumn('report_reason_translations', 'reason')) {
                $table->text('reason')->nullable()->after('reason_id');
            }

            if (!Schema::hasColumn('report_reason_translations', 'language_code')) {
                $table->string('language_code', 50)->nullable()->after('reason');
                $table->index('language_code');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_reason_translations');
    }
};