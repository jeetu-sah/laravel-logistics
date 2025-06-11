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
        Schema::create('transhipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->string('from_transhipment', 100);
            $table->integer('sequence_no');
            $table->string('type', 15);
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->dateTime('received_at')->nullable();
            $table->dateTime('dispatched_at')->nullable();
            $table->string('status', 20)->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transhipments');
    }
};
