<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('user_chats', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->integer('user_id'); // Foreign key for user
            $table->text('msg'); // Message content
            $table->tinyInteger('status')->default(0); // Status with default 0
            $table->timestamp('created_at')->useCurrent(); // Created at timestamp
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_chats');
    }
};
