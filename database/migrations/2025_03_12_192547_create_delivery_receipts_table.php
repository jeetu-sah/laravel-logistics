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
        Schema::create('delivery_receipts', function (Blueprint $table) {
            $table->id();  // Auto-incrementing id (integer)
            $table->integer('booking_id');  // Integer column for booking_id
            $table->text('parcel_image');  // Text column for parcel_image
            $table->decimal('freight_charges', 10, 2);  // Decimal column for freight_charges
            $table->decimal('hamali_charges', 10, 2);  // Decimal column for hamali_charges
            $table->decimal('demruge_charges', 10, 2);  // Decimal column for demruge_charges
            $table->decimal('others_charges', 10, 2);  // Decimal column for others_charges
            $table->decimal('grand_total', 10, 2);  // Decimal column for grand_total
            $table->decimal('received_amount', 10, 2)->default(0.00);  // Decimal column for received_amount
            $table->decimal('pending_amount', 10, 2)->default(0.00);  // Decimal column for pending_amount
            $table->string('recived_by', 50);  // Varchar column for recived_by (max length 50)
            $table->bigInteger('reciver_mobile');  // Bigint column for reciver_mobile
            $table->enum('status', ['Delivered']);  // Enum column for status (only 'Delivered' in this case)
            $table->string('delivery_number', 100);  // Varchar column for delivery_number (max length 100)
            $table->timestamps();  // Automatically adds created_at and updated_at columns
            
           
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_receipts');
    }
};
