<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('manual_bilty_number')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('privet_mark')->nullable();
            $table->string('remark')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['manual_bilty_number', 'invoice_number', 'privet_mark', 'remark']);
        });
    }
};
