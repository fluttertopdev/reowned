<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('banners')) {
            Schema::create('banners', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('banners', function (Blueprint $table) {

            if (!Schema::hasColumn('banners', 'image')) {
                $table->string('image')->nullable()->after('id');
            }

            if (!Schema::hasColumn('banners', 'link')) {
                $table->text('link')->nullable()->after('image');
            }

            if (!Schema::hasColumn('banners', 'status')) {
                $table->tinyInteger('status')->default(1)->comment('1=Active, 0=Inactive')->after('link');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};