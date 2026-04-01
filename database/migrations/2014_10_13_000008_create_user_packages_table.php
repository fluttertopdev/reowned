<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('user_packages', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('item_package_id')->nullable();
            $table->integer('ad_package_id')->nullable();
            $table->string('start_date', 50);
            $table->string('end_date', 50);
            $table->integer('total_limit');
            $table->integer('used_limit')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_packages');
    }
};
