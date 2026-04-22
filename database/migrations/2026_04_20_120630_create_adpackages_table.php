<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('adpackages')) {
            Schema::create('adpackages', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('adpackages', function (Blueprint $table) {

            if (!Schema::hasColumn('adpackages', 'user_id')) {
                $table->integer('user_id')->nullable()->after('id');
            }

            if (!Schema::hasColumn('adpackages', 'name')) {
                $table->string('name')->nullable()->after('user_id');
            }

            if (!Schema::hasColumn('adpackages', 'price')) {
                $table->decimal('price', 10, 2)->nullable()->after('name');
            }

            if (!Schema::hasColumn('adpackages', 'discount')) {
                $table->decimal('discount', 10, 2)->default(0.00)->after('price');
            }

            if (!Schema::hasColumn('adpackages', 'final_price')) {
                $table->decimal('final_price', 10, 2)->nullable()->after('discount');
            }

            if (!Schema::hasColumn('adpackages', 'image')) {
                $table->string('image')->after('final_price');
            }

            if (!Schema::hasColumn('adpackages', 'description')) {
                $table->text('description')->after('image');
            }

            if (!Schema::hasColumn('adpackages', 'days')) {
                $table->enum('days', ['limited', 'unlimited'])->after('description');
            }

            if (!Schema::hasColumn('adpackages', 'no_of_days')) {
                $table->integer('no_of_days')->nullable()->after('days');
            }

            if (!Schema::hasColumn('adpackages', 'item')) {
                $table->enum('item', ['limited', 'unlimited'])->after('no_of_days');
            }

            if (!Schema::hasColumn('adpackages', 'no_of_item')) {
                $table->integer('no_of_item')->nullable()->after('item');
            }

            if (!Schema::hasColumn('adpackages', 'status')) {
                $table->tinyInteger('status')->default(1)->after('no_of_item');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adpackages');
    }
};