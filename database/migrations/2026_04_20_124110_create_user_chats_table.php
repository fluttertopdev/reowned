<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('user_chats')) {
            Schema::create('user_chats', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
            });
        }

        // Add missing columns safely
        Schema::table('user_chats', function (Blueprint $table) {

            if (!Schema::hasColumn('user_chats', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
                $table->index('user_id');
            }

            if (!Schema::hasColumn('user_chats', 'msg')) {
                $table->text('msg')->after('user_id');
            }

            if (!Schema::hasColumn('user_chats', 'status')) {
                $table->boolean('status')->default(false)->after('msg');
                $table->index('status');
            }

            // Ensure created_at exists
            if (!Schema::hasColumn('user_chats', 'created_at')) {
                $table->timestamp('created_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_chats');
    }
};