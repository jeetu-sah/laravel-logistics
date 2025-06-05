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
        Schema::create('branches_settings', function (Blueprint $table) {
            $table->id();  // Auto-incrementing id
            $table->integer('user_id');  // Integer column for user_id
            $table->string('prefix_employee_id', 255)->nullable();
            $table->decimal('freight_amount', 10, 2)->nullable();
            $table->decimal('wbc_charges', 10, 2)->nullable();
            $table->decimal('handling_charges', 10, 2)->nullable();
            $table->decimal('fov_amount', 10, 2)->nullable();
            $table->decimal('fuel_amount', 10, 2)->nullable();
            $table->decimal('transhipmen_amount', 10, 2)->nullable();
            $table->decimal('hamali_Charges', 10, 2)->nullable();
            $table->decimal('bilti_Charges', 10, 2)->nullable();
            $table->decimal('compney_charges', 10, 2)->nullable();
            $table->decimal('cgst', 10, 2)->nullable();
            $table->decimal('sgst', 10, 2)->nullable();
            $table->decimal('igst', 10, 2)->nullable();
            $table->timestamp('deleted_at')->nullable();  // Timestamp column for deleted_at, nullable
            $table->timestamps();  // This creates created_at and updated_at columns automatically
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches_settings');
    }
};
