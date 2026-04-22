<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('user_packages')) {
            Schema::create('user_packages', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('user_packages', function (Blueprint $table) {

            if (!Schema::hasColumn('user_packages', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
                $table->index('user_id');
            }

            if (!Schema::hasColumn('user_packages', 'item_package_id')) {
                $table->unsignedBigInteger('item_package_id')->nullable()->after('user_id');
                $table->index('item_package_id');
            }

            if (!Schema::hasColumn('user_packages', 'ad_package_id')) {
                $table->unsignedBigInteger('ad_package_id')->nullable()->after('item_package_id');
                $table->index('ad_package_id');
            }

            if (!Schema::hasColumn('user_packages', 'start_date')) {
                $table->timestamp('start_date')->after('ad_package_id');
            }

            if (!Schema::hasColumn('user_packages', 'end_date')) {
                $table->timestamp('end_date')->after('start_date');
            }

            if (!Schema::hasColumn('user_packages', 'total_limit')) {
                $table->integer('total_limit')->after('end_date');
            }

            if (!Schema::hasColumn('user_packages', 'used_limit')) {
                $table->integer('used_limit')->default(0)->after('total_limit');
            }

            if (!Schema::hasColumn('user_packages', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('used_limit');
                $table->index('is_active');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_packages');
    }
};