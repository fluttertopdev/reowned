<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('contact_us')) {
            Schema::create('contact_us', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
            });
        }

        // Add missing columns safely
        Schema::table('contact_us', function (Blueprint $table) {

            if (!Schema::hasColumn('contact_us', 'name')) {
                $table->string('name', 150)->after('id');
            }

            if (!Schema::hasColumn('contact_us', 'email')) {
                $table->string('email', 150)->after('name');
                $table->index('email');
            }

            if (!Schema::hasColumn('contact_us', 'subject')) {
                $table->string('subject')->after('email');
            }

            if (!Schema::hasColumn('contact_us', 'message')) {
                $table->text('message')->after('subject');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_us');
    }
};