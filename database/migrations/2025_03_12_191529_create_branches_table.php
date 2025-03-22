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
        Schema::create('branches', function (Blueprint $table) {
            $table->id(); // auto-incrementing id column
            $table->string('branch_name');
            $table->string('branch_code');
            $table->string('owner_name');
            $table->string('contact');
            $table->string('gst');
            $table->unsignedBigInteger('country_name');
            $table->unsignedBigInteger('state_name');
            $table->unsignedBigInteger('city_name')->nullable();
            $table->text('address1');
            $table->text('address2')->nullable();
            $table->enum('user_status', ['active', 'inactive']);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
