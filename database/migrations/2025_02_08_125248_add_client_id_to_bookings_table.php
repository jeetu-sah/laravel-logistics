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
        Schema::table('bookings', function (Blueprint $table) {
            // Add 'client_id' after 'id' and 'manual_bilti_number' after 'bilti_number'
            $table->bigInteger('client_id')->nullable()->after('id');
            $table->bigInteger('manual_bilti_number')->nullable()->after('bilti_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Drop the columns if the migration is rolled back
            $table->dropColumn('client_id');
            $table->dropColumn('manual_bilti_number');
        });
    }
};
