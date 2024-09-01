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
        Schema::create('branch', function (Blueprint $table) {
            $table->id(); // This creates an auto_increment primary key named 'id'
            $table->string('branch_name');
            $table->string('branch_code');
            $table->string('owner_name');
            $table->string('contact');
            $table->string('gst');
            $table->unsignedBigInteger('country_name'); // Assuming you want to store a reference ID
            $table->unsignedBigInteger('state_name');   // Assuming you want to store a reference ID
            $table->unsignedBigInteger('city_name');    // Assuming you want to store a reference ID
            $table->text('address1');
            $table->text('address2')->nullable();
            $table->enum('user_status', ['active', 'inactive']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch');
    }
};
