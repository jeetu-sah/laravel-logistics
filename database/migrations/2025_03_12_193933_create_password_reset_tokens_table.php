<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email');  // Email address for password reset
            $table->string('token');  // Token used for password reset
            $table->timestamp('created_at')->nullable();  // Timestamp for when the token was created

            // Optional: You can add a primary key constraint on email and token if you want
            // or use a unique constraint to avoid duplicate tokens for the same email
            $table->primary(['email', 'token']);  // Composite primary key (email, token) for uniqueness

            // You could also add a unique constraint if you want to ensure the token is unique per email
            // $table->unique(['email', 'token']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
    }
};
