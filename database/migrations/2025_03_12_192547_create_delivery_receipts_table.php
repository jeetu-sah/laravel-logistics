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
        Schema::create('delivery_receipts', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id');
            $table->text('parcel_image');
            $table->decimal('freight_charges', 10, 2)->default(0.00);
            $table->decimal('hamali_charges', 10, 2)->default(0.00);
            $table->decimal('demruge_charges', 10, 2)->default(0.00);
            $table->decimal('others_charges', 10, 2)->default(0.00);
            $table->decimal('grand_total', 10, 2)->default(0.00);
            $table->decimal('received_amount', 10, 2)->default(0.00);
            $table->decimal('pending_amount', 10, 2)->default(0.00);
            $table->string('recived_by', 50);
            $table->bigInteger('reciver_mobile');
            $table->string('status', 10);
            $table->string('delivery_number', 15);
            $table->timestamps();


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
