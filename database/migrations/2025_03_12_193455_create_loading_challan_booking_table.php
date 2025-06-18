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
        Schema::create('loading_challan_booking', function (Blueprint $table) {
            $table->id();  // Auto-incrementing id (bigint unsigned)
            $table->unsignedBigInteger('loading_challans_id');  // Foreign key reference for loading_challans_id
            $table->unsignedBigInteger('booking_id');  // Foreign key reference for booking_id
            $table->timestamps();  // Automatically adds created_at and updated_at columns

            // Add foreign key constraints
            $table->foreign('loading_challans_id')->references('id')->on('loading_challans')->onDelete('cascade');
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
             $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loading_challan_booking');
    }
};
