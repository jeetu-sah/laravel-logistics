<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();  // Auto-incrementing id (bigint unsigned)
            $table->string('consignor_name', 255)->nullable();  // String column for consignor_name, nullable
            $table->string('consignee_name', 255)->nullable();  // String column for consignee_name, nullable
            $table->text('consignor_address')->nullable();  // Text column for consignor_address, nullable
            $table->text('consignee_address')->nullable();  // Text column for consignee_address, nullable
            $table->string('consignor_phone_number', 255)->nullable();  // String column for consignor_phone_number, nullable
            $table->string('consignee_phone_number', 255)->nullable();  // String column for consignee_phone_number, nullable
            $table->string('consignor_gst_number', 255)->nullable();  // String column for consignor_gst_number, nullable
            $table->string('consignee_gst_number', 255)->nullable();  // String column for consignee_gst_number, nullable
            $table->string('consignor_email', 255)->nullable();  // String column for consignor_email, nullable
            $table->string('consignee_email', 255)->nullable();  // String column for consignee_email, nullable
            $table->string('aadhar_card', 255)->nullable();  // String column for aadhar_card, nullable
            $table->integer('status')->unsigned();  // Integer column for status (non-negative)
            $table->timestamps();  // Automatically adds created_at and updated_at columns
            $table->timestamp('deleted_at')->nullable();  // Timestamp column for deleted_at, nullable
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
