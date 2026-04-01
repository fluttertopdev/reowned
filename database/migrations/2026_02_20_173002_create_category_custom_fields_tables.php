<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('category_custom_fields')) {
            Schema::create('category_custom_fields', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('category_id');
                $table->string('field_name');
                $table->enum('field_type', ['textbox','number','dropdown','checkbox']);
                $table->integer('min_length')->nullable();
                $table->integer('max_length')->nullable();
                $table->boolean('is_required')->default(0);
                $table->boolean('is_active')->default(1);
                $table->integer('sort_order')->default(0);
                $table->timestamps();

                $table->foreign('category_id')
                      ->references('id')
                      ->on('categories')
                      ->onDelete('cascade');
            })
        }
    }

    public function down()
    {
        Schema::dropIfExists('category_custom_fields');
    }
};
