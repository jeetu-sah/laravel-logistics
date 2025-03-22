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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();  // Auto-incrementing id (bigint unsigned)
            $table->char('code', 5);  // Char column for country code (length 5)
            $table->string('name', 255);  // Varchar column for country name (length 255)
            $table->mediumInteger('phonecode');  // Mediumint column for phone code
            $table->timestamps();  // Automatically adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
