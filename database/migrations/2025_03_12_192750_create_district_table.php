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
        Schema::create('district', function (Blueprint $table) {
            $table->id('district_id');  // Auto-incrementing district_id (bigint unsigned)
            $table->string('district_name');  // Varchar column for district_name (255 characters)
            $table->string('hindi_name');  // Varchar column for hindi_name (255 characters)
            $table->unsignedBigInteger('state_id');  // Foreign key reference for state_id (bigint unsigned)
            $table->tinyInteger('status')->default(1);  // Tinyint column for status with a default value of 1
            $table->timestamps();  // Automatically adds created_at and updated_at columns

            // Adding foreign key constraint assuming there's a states table with an id column
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('district');
    }
};
