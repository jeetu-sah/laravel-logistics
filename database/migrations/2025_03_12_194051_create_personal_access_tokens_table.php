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
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();  // Auto-incrementing id (bigint unsigned)
            $table->string('tokenable_type');  // Polymorphic model type (varchar(255))
            $table->unsignedBigInteger('tokenable_id');  // Polymorphic model id (bigint unsigned)
            $table->string('name');  // Name of the token (varchar(255))
            $table->string('token', 64);  // The actual token (varchar(64))
            $table->text('abilities')->nullable();  // Abilities associated with the token (nullable text field)
            $table->timestamp('last_used_at')->nullable();  // Last time the token was used (timestamp, nullable)
            $table->timestamp('expires_at')->nullable();  // Expiration time for the token (timestamp, nullable)
            $table->timestamps();  // Created_at and updated_at timestamp columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};
