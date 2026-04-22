<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('report_reasons')) {
            Schema::create('report_reasons', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('report_reasons', function (Blueprint $table) {

            if (!Schema::hasColumn('report_reasons', 'reason')) {
                $table->text('reason')->after('id');
            }

            if (!Schema::hasColumn('report_reasons', 'status')) {
                $table->boolean('status')->default(true)->after('reason');
                $table->index('status');
            }

            // Ensure timestamps if missing
            if (!Schema::hasColumn('report_reasons', 'created_at')) {
                $table->timestamp('created_at')->nullable();
            }

            if (!Schema::hasColumn('report_reasons', 'updated_at')) {
                $table->timestamp('updated_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_reasons');
    }
};