<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 20)->nullable();
            $table->string('last_name', 20)->nullable();
            $table->string('email', 40)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->bigInteger('mobile', false, true)->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('identity', 20);
            $table->string('password', 255);
            $table->string('user_type', 10)->default('admin')->comment('admin, reviewer');
            $table->string('user_status', 10)->default('active')->comment('active, inactive');
            $table->tinyInteger('term_and_condition')->default(1)->comment('1: agreed, 2: disagreed');
            $table->tinyInteger('is_signed')->default(1)->comment('1: signedIn, 2: LogOut');
            $table->string('remember_token', 100)->nullable();
            $table->string('degree', 20)->nullable();
            $table->string('institution', 20)->nullable();
            $table->string('position', 20)->nullable();
            $table->string('department', 20)->nullable();
            $table->text('reason')->nullable();
            $table->string('userId', 30)->nullable();
            $table->integer('branch_user_id')->nullable();
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
