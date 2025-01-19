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
        Schema::table('loading_challans', function (Blueprint $table) {
            $table->string('coLoder')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('loading_challans', function (Blueprint $table) {
            $table->dropColumn(['coLoder']);
        });
    }
};
