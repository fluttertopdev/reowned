<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->string('name', 50); // State name
            $table->integer('countries_id'); // Foreign key for country
            $table->tinyInteger('status')->default(1); // Status with default 1
            $table->timestamps(); // created_at and updated_at
            $table->softDeletes(); // deleted_at for soft deletes
        });
    }

    public function down()
    {
        Schema::dropIfExists('states');
    }
};
