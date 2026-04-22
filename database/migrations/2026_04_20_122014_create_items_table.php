<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('items')) {
            Schema::create('items', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('items', function (Blueprint $table) {

            if (!Schema::hasColumn('items', 'title')) {
                $table->string('title')->after('id');
            }

            if (!Schema::hasColumn('items', 'description')) {
                $table->text('description')->nullable()->after('title');
            }

            if (!Schema::hasColumn('items', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('description');
                $table->index('user_id');
            }

            if (!Schema::hasColumn('items', 'price')) {
                $table->integer('price')->after('user_id');
            }

            if (!Schema::hasColumn('items', 'area')) {
                $table->string('area')->nullable()->after('price');
            }

            if (!Schema::hasColumn('items', 'city')) {
                $table->string('city')->nullable()->after('area');
            }

            if (!Schema::hasColumn('items', 'state')) {
                $table->string('state')->nullable()->after('city');
            }

            if (!Schema::hasColumn('items', 'country')) {
                $table->string('country')->nullable()->after('state');
            }

            if (!Schema::hasColumn('items', 'pincode')) {
                $table->string('pincode', 20)->nullable()->after('country');
            }

            if (!Schema::hasColumn('items', 'latitude')) {
                $table->decimal('latitude', 10, 8)->nullable()->after('pincode');
            }

            if (!Schema::hasColumn('items', 'longitude')) {
                $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            }

            if (!Schema::hasColumn('items', 'category_id')) {
                $table->unsignedBigInteger('category_id')->after('longitude');
                $table->index('category_id');
            }

            if (!Schema::hasColumn('items', 'subcategory_id')) {
                $table->unsignedBigInteger('subcategory_id')->nullable()->after('category_id');
                $table->index('subcategory_id');
            }

            if (!Schema::hasColumn('items', 'slug')) {
                $table->string('slug', 100)->after('subcategory_id');
                $table->index('slug');
            }

            if (!Schema::hasColumn('items', 'status')) {
                $table->tinyInteger('status')->default(1)->after('slug');
            }

            if (!Schema::hasColumn('items', 'is_sold')) {
                $table->boolean('is_sold')->default(false)->after('status');
            }

            if (!Schema::hasColumn('items', 'views')) {
                $table->unsignedBigInteger('views')->default(0)->after('is_sold');
            }

            if (!Schema::hasColumn('items', 'rejected_reason')) {
                $table->string('rejected_reason')->nullable()->after('views');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};