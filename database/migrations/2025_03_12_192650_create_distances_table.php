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
        Schema::create('distances', function (Blueprint $table) {
            $table->id();  // Auto-incrementing id (bigint unsigned)
            $table->unsignedBigInteger('from_branch_id');  // Foreign key reference for from_branch_id
            $table->unsignedBigInteger('to_branch_id');  // Foreign key reference for to_branch_id
            $table->integer('distance');  // Integer column for distance
            $table->integer('status');  // Integer column for status
            $table->timestamp('deleted_at')->nullable();  // Timestamp for deleted_at (nullable)
            $table->timestamps();  // Automatically adds created_at and updated_at columns

            // Adding foreign key constraints
            $table->foreign('from_branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('to_branch_id')->references('id')->on('branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distances');
    }
};
