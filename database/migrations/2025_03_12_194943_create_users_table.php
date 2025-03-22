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
            $table->id();  // Auto-incrementing id (bigint unsigned)
            $table->string('first_name', 100)->nullable();  // First name of the user (varchar(100), nullable)
            $table->string('last_name', 100)->nullable();  // Last name of the user (varchar(100), nullable)
            $table->string('email', 255)->unique();  // Email of the user (varchar(255), unique)
            $table->timestamp('email_verified_at')->nullable();  // Timestamp for email verification (nullable)
            $table->bigInteger('mobile', false, true)->nullable();  // Mobile number (bigint(20), nullable)
            $table->timestamp('mobile_verified_at')->nullable();  // Timestamp for mobile verification (nullable)
            $table->string('password', 255);  // Password for the user (varchar(255))
            $table->string('user_type', 255)->default('admin')->comment('admin, reviewer');  // Type of user (varchar(255))
            $table->string('user_status', 255)->default('active')->comment('active, inactive');  // Status of the user (varchar(255))
            $table->tinyInteger('term_and_condition')->default(1)->comment('1: agreed, 2: disagreed');  // Agreement with terms (tinyint)
            $table->tinyInteger('is_signed')->default(1)->comment('1: signedIn, 2: LogOut');  // User signed-in status (tinyint)
            $table->string('remember_token', 100)->nullable();  // Remember me token (varchar(100), nullable)
            $table->string('degree', 255)->nullable();  // Degree of the user (varchar(255), nullable)
            $table->string('institution', 255)->nullable();  // Institution (varchar(255), nullable)
            $table->string('position', 255)->nullable();  // Position in the company (varchar(255), nullable)
            $table->string('department', 255)->nullable();  // Department (varchar(255), nullable)
            $table->text('reason')->nullable();  // Reason for registration or other purpose (text, nullable)
            $table->string('userId', 30)->nullable();  // User ID (varchar(30), nullable)
            $table->integer('branch_user_id')->nullable();  // Branch user ID (int(11), nullable)
            $table->timestamps();  // Automatically adds created_at and updated_at columns
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
