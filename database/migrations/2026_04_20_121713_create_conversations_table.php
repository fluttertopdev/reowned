<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('conversations')) {
            Schema::create('conversations', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
            });
        }

        // Add missing columns safely
        Schema::table('conversations', function (Blueprint $table) {

            if (!Schema::hasColumn('conversations', 'item_id')) {
                $table->unsignedBigInteger('item_id')->after('id');
                $table->index('item_id');
            }

            if (!Schema::hasColumn('conversations', 'seller_id')) {
                $table->unsignedBigInteger('seller_id')->after('item_id');
                $table->index('seller_id');
            }

            if (!Schema::hasColumn('conversations', 'buyer_id')) {
                $table->unsignedBigInteger('buyer_id')->after('seller_id');
                $table->index('buyer_id');
            }

            if (!Schema::hasColumn('conversations', 'last_message_at')) {
                $table->timestamp('last_message_at')->nullable()->after('buyer_id');
                $table->index('last_message_at');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};