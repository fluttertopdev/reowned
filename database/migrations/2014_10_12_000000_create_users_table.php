<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    
        public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('type', ['admin', 'staff', 'user']);
            $table->string('image', 255)->nullable();
            $table->string('password', 100);
            $table->string('country_code', 25);
            $table->integer('phone');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_verified')->default(0);
            $table->integer('otp_count')->default(0);
            $table->integer('otp')->nullable();
            $table->integer('role_id');
            $table->string('otp_expires_at', 25)->nullable();
            $table->text('address')->nullable();
            $table->string('id_proof_front', 255)->nullable();
            $table->string('id_proof_back', 255)->nullable();
            $table->tinyInteger('enable_notificaton')->default(0);
            $table->tinyInteger('enable_contact_info')->default(0);
            $table->enum('login_type', ['email', 'google']);
            $table->timestamps();
            $table->softDeletes();
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }


};
