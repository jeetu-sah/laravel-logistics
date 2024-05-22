<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->bigInteger('mobile')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('password');
            $table->string('user_type')->default('admin')->comment('admin, reviewer');
            $table->string('user_status')->default('active')->comment('active, inactive');
            $table->tinyInteger('term_and_condition')->default(1)->comment('1: agreed, 2: disagreed');
            $table->tinyInteger('is_signed')->default(1)->comment('1: signedIn, 2: LogOut');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
