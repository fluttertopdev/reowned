<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('languages')) {
            Schema::create('languages', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('languages', function (Blueprint $table) {

            if (!Schema::hasColumn('languages', 'code_id')) {
                $table->unsignedBigInteger('code_id')->default(0)->after('id');
                $table->index('code_id');
            }

            if (!Schema::hasColumn('languages', 'name')) {
                $table->string('name')->nullable()->after('code_id');
                $table->index('name');
            }

            if (!Schema::hasColumn('languages', 'code')) {
                $table->string('code')->nullable()->after('name');
                $table->index('code');
            }

            if (!Schema::hasColumn('languages', 'position')) {
                $table->enum('position', ['rtl', 'ltr'])->nullable()->after('code');
                $table->index('position');
            }

            if (!Schema::hasColumn('languages', 'status')) {
                $table->tinyInteger('status')->default(1)->after('position');
                $table->index('status');
            }

            if (!Schema::hasColumn('languages', 'is_default')) {
                $table->boolean('is_default')->default(false)->after('status');
                $table->index('is_default');
            }

            // Ensure indexes on timestamps if needed
            if (!Schema::hasColumn('languages', 'created_at')) {
                $table->timestamp('created_at')->nullable();
                $table->index('created_at');
            }

            if (!Schema::hasColumn('languages', 'updated_at')) {
                $table->timestamp('updated_at')->nullable();
                $table->index('updated_at');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};