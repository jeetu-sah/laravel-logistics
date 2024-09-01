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
        Schema::create('district', function (Blueprint $table) {
            $table->id('district_id'); // Primary key
            $table->string('district_name');
            $table->string('hindi_name');
            $table->unsignedBigInteger('state_id'); // Foreign key to states table
            $table->boolean('status')->default(1); // Status column
            $table->timestamps();

            // Foreign key constraint (assuming you have a 'states' table)
            $table->foreign('state_id')->references('state_id')->on('states')->onDelete('cascade');
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
