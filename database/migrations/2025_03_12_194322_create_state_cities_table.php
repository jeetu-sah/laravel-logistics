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
        Schema::create('state_cities', function (Blueprint $table) {
            $table->id();  // Auto-incrementing id (bigint unsigned)
            $table->string('name', 100);  // Name of the city (varchar(100))
            $table->string('code', 10)->nullable();  // City code (varchar(10), nullable)
            $table->text('hindi_name')->nullable();  // Hindi name of the city (text, nullable)
            $table->unsignedBigInteger('state_id');  // Foreign key to the states table (bigint unsigned)
            $table->timestamps();  // Automatically adds created_at and updated_at columns

            // Add foreign key constraint to state_id
            
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('state_cities');
    }
};
