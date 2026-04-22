<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create table if not exists
        if (!Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Add missing columns safely
        Schema::table('settings', function (Blueprint $table) {

            if (!Schema::hasColumn('settings', 'key')) {
                $table->string('key')->after('id');
                $table->unique('key'); // important
            }

            if (!Schema::hasColumn('settings', 'value')) {
                $table->text('value')->nullable()->after('key');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};