<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration {
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('moduel', 255);
            $table->string('name', 255);
            $table->string('permission_name', 255);
            $table->string('group', 50);
            $table->string('guard_name', 50);
            $table->timestamp('created_at')->default(Carbon::now());
            $table->timestamp('updated_at')->default(Carbon::now());
        });
    }

    public function down()
    {
        Schema::dropIfExists('permissions');
    }
};
