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
        Schema::create('loading_challans', function (Blueprint $table) {
            $table->id();  // Auto-incrementing id (bigint unsigned)
            $table->string('challan_number');  // Varchar column for challan_number
            $table->string('busNumber', 50);  // Varchar column for busNumber
            $table->string('driverName', 50);  // Varchar column for driverName
            $table->string('driverMobile', 11);  // Varchar column for driverMobile (max length 11)
            $table->string('locknumber', 55);  // Varchar column for locknumber
            $table->enum('status', ['Dispatch', 'Pending', 'Accept', ''])->default('Pending');  // Enum column for status with a default value 'Pending'
            $table->integer('created_by');  // Integer column for created_by
            $table->timestamp('deleted_at')->nullable();  // Timestamp column for deleted_at (nullable)
            $table->timestamps();  // Automatically adds created_at and updated_at columns
            $table->string('coLoder')->nullable();  // Varchar column for coLoder (nullable)
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loading_challans');
    }
};
