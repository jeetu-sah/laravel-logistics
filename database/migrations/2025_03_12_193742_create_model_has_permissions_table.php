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
        Schema::create('model_has_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');  // Foreign key reference for permission_id
            $table->string('model_type');  // Varchar column for model_type
            $table->unsignedBigInteger('model_id');  // Foreign key reference for model_id

            // Add foreign key constraints (optional if permission_id references a permissions table)
            // $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            // If you're using polymorphic relationships, `model_type` would store the related model type and `model_id` the related model's ID

            $table->primary(['permission_id', 'model_type', 'model_id']);  // Composite primary key on permission_id, model_type, and model_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_has_permissions');
    }
};
