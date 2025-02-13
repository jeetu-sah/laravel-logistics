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
        Schema::table('bookings', function (Blueprint $table) {
            // Add actual_weight column
            $table->decimal('actual_weight', 8, 2)->nullable(); // Adjust precision and scale as needed
            $table->string('cantain')->nullable(); // Adjust precision and scale as needed
            
            // Add aadhar_card column
            $table->string('aadhar_card', 20)->nullable(); // Assuming Aadhar card number has 12 digits, you can use varchar(20)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Drop the added columns if the migration is rolled back
            $table->dropColumn('actual_weight');
            $table->dropColumn('cantain');
            $table->dropColumn('aadhar_card');
        });
    }
};
