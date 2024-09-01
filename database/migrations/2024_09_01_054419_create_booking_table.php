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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('paid_booking_id');
            $table->unsignedBigInteger('consignor_branch_name')->nullable();
            $table->string('consignor_name')->nullable();
            $table->text('address')->nullable();
            $table->string('phone_number_1')->nullable();
            $table->string('phone_number_2')->nullable();
            $table->string('email')->nullable();
            $table->string('gst_number')->nullable();
            $table->string('pin_code')->nullable();
            $table->unsignedBigInteger('consignee_branch_name')->nullable();
            $table->string('consignee_name')->nullable();
            $table->text('consignee_address')->nullable();
            $table->string('consignee_phone_number_1')->nullable();
            $table->string('consignee_phone_number_2')->nullable();
            $table->string('consignee_email')->nullable();
            $table->string('consignee_gst_number')->nullable();
            $table->string('consignee_pin_code')->nullable();
            $table->string('dest_pin_code')->nullable();
            $table->string('services_line')->nullable();
            $table->integer('no_of_pkg')->nullable();
            $table->string('actual_weight')->nullable(); // Updated to string
            $table->string('gateway')->nullable();
            $table->string('packing_type')->nullable();
            $table->decimal('freight_amount', 8, 2)->nullable();
            $table->decimal('os_amount', 8, 2)->nullable();
            $table->decimal('fov_amount', 8, 2)->nullable();
            $table->decimal('transhipment_amount', 8, 2)->nullable();
            $table->decimal('handling_charge_amount', 8, 2)->nullable();
            $table->decimal('loading_charge_amount', 8, 2)->nullable();
            $table->decimal('misc_charge_amount', 8, 2)->nullable();
            $table->decimal('other_charge_amount', 8, 2)->nullable();
            $table->decimal('grand_total_amount', 10, 2)->nullable();
            $table->tinyInteger('booking_type')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            // Define foreign keys
            $table->foreign('consignor_branch_name')->references('id')->on('branch')->onDelete('set null');
            $table->foreign('consignee_branch_name')->references('id')->on('branch')->onDelete('set null');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
