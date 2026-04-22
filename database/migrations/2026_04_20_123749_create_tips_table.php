<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('tips')) {
            Schema::create('tips', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('tips', function (Blueprint $table) {

            if (!Schema::hasColumn('tips', 'description')) {
                $table->text('description')->after('id');
            }

            if (!Schema::hasColumn('tips', 'status')) {
                $table->boolean('status')->default(true)->after('description');
                $table->index('status');
            }

            // Ensure timestamps if missing
            if (!Schema::hasColumn('tips', 'created_at')) {
                $table->timestamp('created_at')->nullable();
            }

            if (!Schema::hasColumn('tips', 'updated_at')) {
                $table->timestamp('updated_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tips');
    }
};