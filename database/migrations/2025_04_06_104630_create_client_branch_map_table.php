<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_client_branch_map_table.php
public function up()
{
    Schema::create('client_branch_map', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('client_id');
        $table->unsignedBigInteger('branch_id');
        $table->timestamps();

        $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_branch_map');
    }
};
