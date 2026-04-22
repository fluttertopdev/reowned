<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('users', function (Blueprint $table) {

            if (!Schema::hasColumn('users', 'type')) {
                $table->enum('type', ['admin', 'staff', 'user'])->after('id');
            }

            if (!Schema::hasColumn('users', 'role_id')) {
                $table->unsignedBigInteger('role_id')->nullable()->after('type');
                $table->index('role_id');
            }

            if (!Schema::hasColumn('users', 'name')) {
                $table->string('name')->after('role_id');
            }

            if (!Schema::hasColumn('users', 'email')) {
                $table->string('email', 100)->unique()->after('name');
            }

            if (!Schema::hasColumn('users', 'email_verified_at')) {
                $table->timestamp('email_verified_at')->nullable()->after('email');
            }

            if (!Schema::hasColumn('users', 'email_verification_token')) {
                $table->string('email_verification_token')->nullable()->after('email_verified_at');
            }

            if (!Schema::hasColumn('users', 'email_verification_expires_at')) {
                $table->timestamp('email_verification_expires_at')->nullable()->after('email_verification_token');
            }

            if (!Schema::hasColumn('users', 'image')) {
                $table->string('image')->nullable()->after('email_verification_expires_at');
            }

            if (!Schema::hasColumn('users', 'password')) {
                $table->string('password')->after('image');
            }

            if (!Schema::hasColumn('users', 'country_code')) {
                $table->string('country_code', 25)->nullable()->after('password');
            }

            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone', 30)->nullable()->after('country_code');
            }

            if (!Schema::hasColumn('users', 'status')) {
                $table->boolean('status')->default(false)->after('phone');
            }

            if (!Schema::hasColumn('users', 'is_verified')) {
                $table->boolean('is_verified')->default(false)->after('status');
            }

            if (!Schema::hasColumn('users', 'otp_count')) {
                $table->integer('otp_count')->default(0)->after('is_verified');
            }

            if (!Schema::hasColumn('users', 'otp')) {
                $table->integer('otp')->nullable()->after('otp_count');
            }

            if (!Schema::hasColumn('users', 'otp_expires_at')) {
                $table->timestamp('otp_expires_at')->nullable()->after('otp');
            }

            if (!Schema::hasColumn('users', 'address')) {
                $table->text('address')->nullable()->after('otp_expires_at');
            }

            if (!Schema::hasColumn('users', 'id_proof_front')) {
                $table->string('id_proof_front')->nullable()->after('address');
            }

            if (!Schema::hasColumn('users', 'id_proof_back')) {
                $table->string('id_proof_back')->nullable()->after('id_proof_front');
            }

            if (!Schema::hasColumn('users', 'enable_notificaton')) {
                $table->boolean('enable_notificaton')->default(false)->after('id_proof_back');
            }

            if (!Schema::hasColumn('users', 'enable_contact_info')) {
                $table->boolean('enable_contact_info')->default(false)->after('enable_notificaton');
            }

            if (!Schema::hasColumn('users', 'login_type')) {
                $table->enum('login_type', ['email', 'google'])->nullable()->after('enable_contact_info');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};