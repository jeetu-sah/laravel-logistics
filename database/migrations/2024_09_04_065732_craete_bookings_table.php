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
            $table->string('bilti_number')->nullable();
            $table->bigInteger('consignor_branch_id')->nullable();

            $table->string('consignor_name')->nullable();
            $table->text('address')->nullable();
            $table->string('phone_number_1')->nullable();
            $table->string('phone_number_2')->nullable();
            $table->string('email')->nullable();
            $table->string('gst_number')->nullable();
            $table->string('pin_code')->nullable();

            // Consignee Information
            $table->bigInteger('consignee_branch_id')->nullable();
            $table->string('consignee_name')->nullable();
            $table->text('consignee_address')->nullable();
            $table->string('consignee_phone_number_1')->nullable();
            $table->string('consignee_phone_number_2')->nullable();
            $table->string('consignee_email')->nullable();
            $table->string('consignee_gst_number')->nullable();
            $table->string('consignee_pin_code')->nullable();

            // Other Details
            $table->integer('no_of_pkg')->nullable();
            $table->integer('no_of_artical')->nullable(); // Consider using integer if this represents a count
            $table->decimal('actual_weight', 10, 2)->nullable();
            $table->string('packing_type')->nullable();

            // Transhipment Details (if these are meant to be foreign IDs, use foreignId)
            $table->bigInteger('transhipmen_one')->nullable();
            $table->bigInteger('transhipmen_two')->nullable();
            $table->bigInteger('transhipment_three')->nullable();

            // Billing Information
            $table->decimal('good_of_value', 10, 2)->nullable();
            $table->decimal('fov_amount', 10, 2)->nullable();
            $table->decimal('freight_amount', 10, 2)->nullable();
            $table->decimal('os_amount', 10, 2)->nullable();
            $table->decimal('transhipmen_one_amount', 10, 2)->nullable();
            $table->decimal('transhipmen_two_amount', 10, 2)->nullable();
            $table->decimal('transhipment_three_amount', 10, 2)->nullable();
            $table->decimal('loading_charge_amount', 10, 2)->nullable();
            $table->decimal('misc_charge_amount', 10, 2)->nullable();
            $table->decimal('other_charge_amount', 10, 2)->nullable();
            $table->decimal('grand_total_amount', 10, 2)->nullable();

            // Additional Fields
            $table->tinyInteger('booking_type')->default(1); // 1: Paid, 2: Unpaid, etc.
            $table->tinyInteger('status')->default(1); // 1: Active, 0: Inactive
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
