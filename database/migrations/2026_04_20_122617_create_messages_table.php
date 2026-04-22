<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('messages')) {
            Schema::create('messages', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
            });
        }

        // Add missing columns safely
        Schema::table('messages', function (Blueprint $table) {

            if (!Schema::hasColumn('messages', 'conversation_id')) {
                $table->unsignedBigInteger('conversation_id')->after('id');
                $table->index('conversation_id');
            }

            if (!Schema::hasColumn('messages', 'sender_id')) {
                $table->unsignedBigInteger('sender_id')->after('conversation_id');
                $table->index('sender_id');
            }

            if (!Schema::hasColumn('messages', 'message')) {
                $table->text('message')->nullable()->after('sender_id');
            }

            if (!Schema::hasColumn('messages', 'file')) {
                $table->string('file')->nullable()->after('message');
            }

            if (!Schema::hasColumn('messages', 'type')) {
                $table->enum('type', ['text', 'image'])->default('text')->after('file');
            }

            if (!Schema::hasColumn('messages', 'is_seen')) {
                $table->boolean('is_seen')->default(false)->after('type');
                $table->index('is_seen');
            }

            if (!Schema::hasColumn('messages', 'seen_at')) {
                $table->timestamp('seen_at')->nullable()->after('is_seen');
            }

            // Ensure created_at index
            if (!Schema::hasColumn('messages', 'created_at')) {
                $table->timestamp('created_at')->nullable();
                $table->index('created_at');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};