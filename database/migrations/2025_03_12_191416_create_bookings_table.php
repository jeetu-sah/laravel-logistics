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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id(); // auto-incrementing id column
            $table->string('bilti_number', 30)->nullable();
            $table->enum('status', ['1', '2', '3', '4'])->default('1');
            $table->enum('booking_type', ['paid', 'topay'])->default('paid');
            $table->date('booking_date');
            $table->unsignedBigInteger('consignor_branch_id');
            $table->unsignedBigInteger('consignee_branch_id');
            $table->integer('no_of_artical');
            $table->decimal('good_of_value', 15, 2);
            $table->string('consignor_name', 20);
            $table->text('consignor_address')->nullable();
            $table->bigInteger('consignor_phone_number')->nullable();
            $table->string('consignor_gst_number', 20)->nullable();
            $table->string('consignor_email', 50)->nullable();


            $table->string('consignee_name', 20);
            $table->text('consignee_address');
            $table->bigInteger('consignee_phone_number');
            $table->string('consignee_gst_number', 20);
            $table->string('consignee_email', 40)->nullable();

            $table->string('invoice_number', 30);
            $table->string('eway_bill_number', 20);
            $table->string('mark', 20)->nullable();
            $table->text('remark')->nullable();
            $table->string('photo_id')->nullable();
            $table->string('parcel_image')->nullable();
            $table->decimal('distance', 10, 2)->default(0);
            $table->decimal('freight_amount', 10, 2)->default(0);
            $table->decimal('wbc_charges', 10, 2)->default(0);
            $table->decimal('handling_charges', 10, 2)->default(0);
            $table->decimal('fov_amount', 10, 2)->default(0);
            $table->decimal('fuel_amount', 10, 2)->default(0);
            $table->decimal('transhipmen_one_amount', 10, 2)->default(0);
            $table->decimal('transhipmen_two_amount', 10, 2)->default(0);
            $table->decimal('transhipment_three_amount', 10, 2)->default(0);
            $table->decimal('pickup_charges', 10, 2)->default(0);
            $table->decimal('hamali_Charges', 10, 2)->default(0);
            $table->decimal('bilti_Charges', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('compney_charges', 10, 2)->default(0);
            $table->decimal('sub_total', 15, 2)->default(0);
            $table->decimal('cgst', 10, 2)->default(0);
            $table->decimal('sgst', 10, 2)->default(0);
            $table->decimal('igst', 10, 2)->default(0);
            $table->decimal('grand_total', 15, 2)->default(0);
            $table->decimal('misc_charge_amount', 10, 2)->default(0);
            $table->decimal('grand_total_amount', 15, 2)->default(0);

            $table->decimal('actual_weight', 8, 2)->nullable();
            $table->string('cantain', 10)->nullable();
            $table->string('aadhar_card', 20)->nullable();
            $table->string('manual_bilty_number', 20)->nullable();
            $table->dateTime('offline_booking_date')->nullable();
            $table->integer('client_id')->nullable();
            $table->string('booking_status', 20)->default('normal-booking');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
