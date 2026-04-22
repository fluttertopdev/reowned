<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('categories', function (Blueprint $table) {

            if (!Schema::hasColumn('categories', 'parent_id')) {
                $table->unsignedBigInteger('parent_id')->default(0)->after('id');
            }

            if (!Schema::hasColumn('categories', 'user_id')) {
                $table->integer('user_id')->nullable()->after('parent_id');
            }

            if (!Schema::hasColumn('categories', 'name')) {
                $table->string('name')->after('user_id');
            }

            if (!Schema::hasColumn('categories', 'slug')) {
                $table->string('slug')->after('name');
                $table->index('slug');
            }

            if (!Schema::hasColumn('categories', 'description')) {
                $table->text('description')->nullable()->after('slug');
            }

            if (!Schema::hasColumn('categories', 'image')) {
                $table->string('image')->nullable()->after('description');
            }

            if (!Schema::hasColumn('categories', 'status')) {
                $table->tinyInteger('status')->default(1)->after('image');
            }

            if (!Schema::hasColumn('categories', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('status');
            }

            if (!Schema::hasColumn('categories', 'featured_position')) {
                $table->integer('featured_position')->nullable()->after('is_featured');
            }

            if (!Schema::hasColumn('categories', 'custom_fields')) {
                $table->longText('custom_fields')->nullable()->after('featured_position');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};