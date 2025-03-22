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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();  // Auto-incrementing id (bigint unsigned)
            $table->string('name')->nullable();  // Varchar column for name (nullable)
            $table->string('email');  // Varchar column for email
            $table->string('mobile', 15);  // Varchar column for mobile (max length 15)
            $table->unsignedBigInteger('state_id');  // Foreign key reference for state_id
            $table->unsignedBigInteger('district_id');  // Foreign key reference for district_id
            $table->unsignedBigInteger('destination_state_id');  // Foreign key for destination_state_id
            $table->unsignedBigInteger('destination_district_id');  // Foreign key for destination_district_id
            $table->text('description');  // Text column for description
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])->default('pending');  // Enum column for status
            $table->timestamps();  // Automatically adds created_at and updated_at columns

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
