<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->integer('user_id');
            $table->integer('price');
            $table->integer('countries_id');
            $table->integer('state_id');
            $table->integer('city_id');
            $table->integer('area_id');
            $table->integer('category_id');
            $table->string('phone_number', 20);
            $table->text('video_link')->nullable();
            $table->string('slug', 100)->unique();
            $table->string('color', 100)->nullable();
            $table->string('brand', 100)->nullable();
            $table->text('address')->nullable();
            $table->string('longitude', 100)->nullable();
            $table->string('latitude', 100)->nullable();
            $table->text('feature')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('rejected_reason', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('items');
    }
};
