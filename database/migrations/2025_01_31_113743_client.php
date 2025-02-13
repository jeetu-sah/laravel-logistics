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
        Schema::create('clients', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->foreignId('consignor_branch_id')->constrained('branches'); // Assuming 'branches' table exists
            $table->foreignId('consignee_branch_id')->constrained('branches'); // Assuming 'branches' table exists
            $table->integer('no_of_artical');
            $table->decimal('good_of_value', 15, 2);
            $table->string('consignor_name');
            $table->string('consignee_name');
            $table->text('consignor_address');
            $table->text('consignee_address');
            $table->string('consignor_phone_number');
            $table->string('consignee_phone_number');
            $table->string('consignor_gst_number');
            $table->string('consignee_gst_number');
            $table->string('consignor_email');
            $table->string('consignee_email');
            $table->string('invoice_number');
            $table->string('eway_bill_number');
            $table->string('mark')->nullable();
            $table->text('remark')->nullable();
            $table->decimal('distance', 10, 2);
            $table->decimal('freight_amount', 10, 2);
            $table->decimal('wbc_charges', 10, 2);
            $table->decimal('handling_charges', 10, 2);
            $table->decimal('fov_amount', 10, 2);
            $table->decimal('fuel_amount', 10, 2);
            $table->decimal('pickup_charges', 10, 2);
            $table->decimal('hamali_Charges', 10, 2);
            $table->decimal('bilti_Charges', 10, 2);
            $table->decimal('discount', 10, 2);
            $table->decimal('compney_charges', 10, 2);
            $table->decimal('sub_total', 15, 2);
            $table->decimal('cgst', 10, 2);
            $table->decimal('sgst', 10, 2);
            $table->decimal('igst', 10, 2);
            $table->decimal('grand_total', 15, 2);
            $table->decimal('misc_charge_amount', 10, 2);
            $table->decimal('grand_total_amount', 15, 2);
            $table->timestamps(); 
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
