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
        Schema::create('item_types', function (Blueprint $table) {
            $table->id();  // Auto-incrementing id (bigint unsigned)
            $table->string('name', 250);  // Varchar column for name (250 characters)
            $table->string('slug', 250);  // Varchar column for slug (250 characters)
            $table->text('description')->nullable();  // Text column for description (nullable)
            $table->string('status', 20)->default('active')->comment('active, inactive');  // Varchar column for status with a default value 'active'
            $table->timestamps();  // Automatically adds created_at and updated_at columns
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_types');
    }
};
