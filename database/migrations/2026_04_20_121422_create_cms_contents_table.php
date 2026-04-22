<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('cms_contents')) {
            Schema::create('cms_contents', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('cms_contents', function (Blueprint $table) {

            if (!Schema::hasColumn('cms_contents', 'page_name')) {
                $table->string('page_name', 100)->after('id');
            }

            if (!Schema::hasColumn('cms_contents', 'slug')) {
                $table->string('slug', 100)->after('page_name');
                $table->index('slug');
            }

            if (!Schema::hasColumn('cms_contents', 'description')) {
                $table->text('description')->after('slug');
            }

            if (!Schema::hasColumn('cms_contents', 'status')) {
                $table->tinyInteger('status')->default(1)->after('description');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cms_contents');
    }
};