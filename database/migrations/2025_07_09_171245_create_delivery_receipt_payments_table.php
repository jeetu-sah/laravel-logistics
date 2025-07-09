<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryReceiptPaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('delivery_receipt_payments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('delivery_receipt_id');
            $table->decimal('pending_amount', 10, 2)->nullable();
            $table->decimal('received_amount', 10, 2)->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('delivery_receipt_payments');
    }
}
