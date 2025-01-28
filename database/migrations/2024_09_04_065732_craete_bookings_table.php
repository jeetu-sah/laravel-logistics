<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */

     public function up(): void
     {
         Schema::create('bookings', function (Blueprint $table) {
             $table->id();
     
             // Consignor Information
             $table->date('booking_date')->nullable();
             $table->string('bilti_number')->nullable();
             $table->bigInteger('transhipment_one')->nullable();
             $table->bigInteger('consignor_branch_id')->nullable();
             $table->bigInteger('transhipment_two')->nullable();
             $table->bigInteger('consignee_branch_id')->nullable();
             $table->bigInteger('transhipment_three')->nullable();
             $table->integer('no_of_articles')->nullable(); // fixed spelling error
             $table->decimal('actual_weight', 10, 2)->nullable();
             $table->integer('no_of_pkg')->nullable();
             $table->decimal('goods_value', 10, 2)->nullable(); // fixed field name
             $table->string('consignor_name')->nullable();
             $table->string('consignee_name')->nullable();
             $table->text('consignor_address')->nullable();
             $table->text('consignee_address')->nullable();
             $table->string('consignor_phone_number')->nullable();
             $table->string('consignee_phone_number')->nullable();
             $table->string('consignor_gst_number')->nullable();
             $table->string('consignee_gst_number')->nullable();
             $table->string('consignor_email')->nullable();
             $table->string('consignee_email')->nullable();
     
             // Bill Information
             $table->decimal('distance', 15, 2)->nullable(); // changed to decimal
             $table->decimal('freight_amount', 15, 2)->nullable(); // changed to decimal
             $table->decimal('fov_amount', 10, 2)->nullable();
             $table->decimal('transhipment_one_amount', 10, 2)->nullable();
             $table->decimal('transhipment_two_amount', 10, 2)->nullable();
             $table->decimal('transhipment_three_amount', 10, 2)->nullable();
             $table->decimal('pickup_charges', 10, 2)->nullable();
             $table->decimal('hamali_charges', 10, 2)->nullable(); // fixed capitalization
             $table->decimal('discount', 10, 2)->nullable();
             $table->decimal('company_charges', 10, 2)->nullable(); // fixed capitalization
             $table->decimal('cgst', 10, 2)->nullable();
             $table->decimal('sgst', 10, 2)->nullable();
             $table->decimal('igst', 10, 2)->nullable();
             $table->decimal('grand_total', 10, 2)->nullable();
             $table->decimal('misc_charge_amount', 10, 2)->nullable();
             $table->decimal('other_charge_amount', 10, 2)->nullable();
     
             // Additional Fields
             $table->tinyInteger('booking_type')->default(1);
             $table->tinyInteger('status')->default(1);
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
