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
        Schema::table('delivery_receipts', function (Blueprint $table) {
            // Adding the new columns
            $table->decimal('received_amount', 10, 2)->default(0.00)->after('some_column'); // Make sure to set the correct 'after' column
            $table->decimal('pending_amount', 10, 2)->default(0.00)->after('received_amount'); // Adjust if you need a specific order
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('delivery_receipts', function (Blueprint $table) {
            // Drop the columns if you need to roll back the migration
            $table->dropColumn(['received_amount', 'pending_amount']);
        });
    }
};
