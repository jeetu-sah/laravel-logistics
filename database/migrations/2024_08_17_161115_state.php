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
        Schema::create('states', function (Blueprint $table) {
            $table->id('state_id');
            $table->string('state_name', 30);
            $table->string('code', 10);
            $table->text('hindi_name');
            $table->enum('status', [1, 2])->default(1)->comment('1 For Active , 2 For Inactive');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('state');
    }
};
