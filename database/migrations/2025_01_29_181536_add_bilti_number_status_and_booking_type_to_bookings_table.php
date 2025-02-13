<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBiltiNumberStatusAndBookingTypeToBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Adding 'bilti_number' column as a string (you can adjust the length if needed)
            $table->string('bilti_number')->nullable()->after('id');

            // Adding 'status' column, assuming it's an integer or enum
            $table->enum('status', ['1', '2', '3', '4'])->default('1')->after('bilti_number');
            // '0' - Pending, '1' - Active, '2' - Completed (example states)

            // Adding 'booking_type' column as a string (you can adjust length if needed)
            $table->enum('booking_type', ['Paid', 'Topay', 'Toclient'])->default('Paid')->after('status');
            // You could use 'booking_type' to store types like 'Paid', 'Unpaid', etc.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Drop the columns if rolling back
            $table->dropColumn('bilti_number');
            $table->dropColumn('status');
            $table->dropColumn('booking_type');
        });
    }
}
