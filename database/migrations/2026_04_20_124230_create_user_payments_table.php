<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('user_payments')) {
            Schema::create('user_payments', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('user_payments', function (Blueprint $table) {

            if (!Schema::hasColumn('user_payments', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
                $table->index('user_id');
            }

            if (!Schema::hasColumn('user_payments', 'item_package_id')) {
                $table->unsignedBigInteger('item_package_id')->nullable()->after('user_id');
                $table->index('item_package_id');
            }

            if (!Schema::hasColumn('user_payments', 'ad_package_id')) {
                $table->unsignedBigInteger('ad_package_id')->nullable()->after('item_package_id');
                $table->index('ad_package_id');
            }

            if (!Schema::hasColumn('user_payments', 'payment_gateway')) {
                $table->string('payment_gateway', 50)->after('ad_package_id');
            }

            if (!Schema::hasColumn('user_payments', 'transaction_id')) {
                $table->string('transaction_id')->nullable()->after('payment_gateway');
                $table->index('transaction_id');
            }

            if (!Schema::hasColumn('user_payments', 'order_id')) {
                $table->string('order_id')->nullable()->after('transaction_id');
                $table->index('order_id');
            }

            if (!Schema::hasColumn('user_payments', 'amount')) {
                $table->decimal('amount', 10, 2)->after('order_id');
            }

            if (!Schema::hasColumn('user_payments', 'currency')) {
                $table->string('currency', 10)->default('INR')->after('amount');
            }

            if (!Schema::hasColumn('user_payments', 'payment_status')) {
                $table->string('payment_status')->default('pending')->after('currency');
                $table->index('payment_status');
            }

            if (!Schema::hasColumn('user_payments', 'gateway_response')) {
                $table->longText('gateway_response')->nullable()->after('payment_status');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_payments');
    }
};