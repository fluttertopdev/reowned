<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('category_custom_field_options')) {
            Schema::create('category_custom_field_options', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('custom_field_id');
                $table->string('option_value');
                $table->integer('sort_order')->default(0);
                $table->timestamps();

                $table->foreign('custom_field_id')
                      ->references('id')
                      ->on('category_custom_fields')
                      ->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('category_custom_field_options');
    }
};
