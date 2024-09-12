<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('country_states', function (Blueprint $table) {
            $table->id('id');
            $table->string('name', 30);
            $table->string('code', 10)->nullable();
            $table->text('hindi_name')->nullable();
            $table->enum('status', [1, 2])->default(1)->comment('1: active, 2: inactive');
            $table->integer('country_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};
