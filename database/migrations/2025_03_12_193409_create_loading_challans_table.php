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
        Schema::create('loading_challans', function (Blueprint $table) {
            $table->id();
            $table->string('challan_number', 30);
            $table->string('busNumber', 50);
            $table->string('driverName', 50);
            $table->string('driverMobile', 15);
            $table->string('locknumber', 55);
            $table->string('status', 15)->nullable();
            $table->integer('created_by');
            $table->integer('from_transhipment');
            $table->integer('to_transhipment');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
            $table->string('coLoder')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loading_challans');
    }
};
