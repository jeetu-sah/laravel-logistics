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
        Schema::create('loading_challans', function (Blueprint $table) {
            $table->id('id');
            $table->string('challan_number');
            
            $table->integer('created_by');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('loading_challan_booking', function (Blueprint $table) {
            $table->id('id');
            $table->integer('loading_challans_id');
            $table->integer('booking_id');

          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
