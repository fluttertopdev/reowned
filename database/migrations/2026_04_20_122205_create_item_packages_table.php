<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('item_packages')) {
            Schema::create('item_packages', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('item_packages', function (Blueprint $table) {

            if (!Schema::hasColumn('item_packages', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
                $table->index('user_id');
            }

            if (!Schema::hasColumn('item_packages', 'name')) {
                $table->string('name')->nullable()->after('user_id');
            }

            if (!Schema::hasColumn('item_packages', 'price')) {
                $table->decimal('price', 10, 2)->nullable()->after('name');
            }

            if (!Schema::hasColumn('item_packages', 'discount')) {
                $table->decimal('discount', 10, 2)->default(0)->after('price');
            }

            if (!Schema::hasColumn('item_packages', 'final_price')) {
                $table->decimal('final_price', 10, 2)->nullable()->after('discount');
            }

            if (!Schema::hasColumn('item_packages', 'image')) {
                $table->string('image')->after('final_price');
            }

            if (!Schema::hasColumn('item_packages', 'description')) {
                $table->text('description')->after('image');
            }

            if (!Schema::hasColumn('item_packages', 'days')) {
                $table->enum('days', ['limited', 'unlimited'])->after('description');
            }

            if (!Schema::hasColumn('item_packages', 'no_of_days')) {
                $table->integer('no_of_days')->nullable()->after('days');
            }

            if (!Schema::hasColumn('item_packages', 'item')) {
                $table->enum('item', ['limited', 'unlimited'])->after('no_of_days');
            }

            if (!Schema::hasColumn('item_packages', 'no_of_item')) {
                $table->integer('no_of_item')->nullable()->after('item');
            }

            if (!Schema::hasColumn('item_packages', 'status')) {
                $table->tinyInteger('status')->default(1)->after('no_of_item');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_packages');
    }
};