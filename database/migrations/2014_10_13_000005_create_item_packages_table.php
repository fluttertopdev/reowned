<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration {
    public function up()
    {
        Schema::create('item_packages', function (Blueprint $table) {
            $table->id();
            $table->integer('price');
            $table->decimal('discount', 10, 2);
            $table->integer('final_price');
            $table->string('image', 255);
            $table->text('description');
            $table->enum('days', ['limited', 'unlimited']);
            $table->integer('no_of_days')->nullable();
            $table->enum('item', ['limited', 'unlimited']);
            $table->integer('no_of_item')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamp('created_at')->default(Carbon::now());
            $table->timestamp('updated_at')->default(Carbon::now());
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('item_packages');
    }
};
