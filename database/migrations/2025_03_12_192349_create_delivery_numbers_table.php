<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_numbers', function (Blueprint $table) {
            $table->id();  // Auto-incrementing id (integer)
            $table->string('delivery_number', 11);  // Varchar column for delivery_number (max length 11)
            $table->integer('booking_id');  // Integer column for booking_id
            $table->integer('status');  // Integer column for status
            $table->timestamps();  // Automatically adds created_at and updated_at columns
            
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_numbers');
    }
}
