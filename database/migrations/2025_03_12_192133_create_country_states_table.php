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
        Schema::create('country_states', function (Blueprint $table) {
            $table->id();  // Auto-incrementing id (bigint unsigned)
            $table->string('name', 30);  // Varchar column for the state name (max length 30)
            $table->string('code', 10)->nullable();  // Varchar column for state code (max length 10)
            $table->text('hindi_name')->nullable();  // Text column for state name in Hindi, nullable
            $table->enum('status', ['1', '2'])->default('1')->comment('1: active, 2: inactive');  // Enum column for status (active or inactive)
            $table->unsignedBigInteger('country_id');  // Foreign key reference for country_id
            $table->timestamps();  // Automatically adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('country_states');
    }
};
