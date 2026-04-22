<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('faqs')) {
            Schema::create('faqs', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('faqs', function (Blueprint $table) {

            if (!Schema::hasColumn('faqs', 'title')) {
                $table->string('title')->after('id');
            }

            if (!Schema::hasColumn('faqs', 'description')) {
                $table->text('description')->after('title');
            }

            if (!Schema::hasColumn('faqs', 'status')) {
                $table->tinyInteger('status')->default(1)->after('description');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};