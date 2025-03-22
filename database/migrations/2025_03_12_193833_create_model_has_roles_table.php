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
        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');  // Foreign key reference for role_id
            $table->string('model_type');  // Varchar column for model_type
            $table->unsignedBigInteger('model_id');  // Foreign key reference for model_id
            $table->tinyInteger('login_status')->default(0)->comment('0: logout, 1: login');  // Login status with default 0

            // Add foreign key constraints if necessary (optional)
            // $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            // If you're using polymorphic relationships, `model_type` would store the related model type and `model_id` the related model's ID

            $table->primary(['role_id', 'model_type', 'model_id']);  // Composite primary key on role_id, model_type, and model_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_has_roles');
    }
};
