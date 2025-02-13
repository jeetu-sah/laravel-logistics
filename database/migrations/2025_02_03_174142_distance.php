<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('distances', function (Blueprint $table) {
        $table->id();
        $table->bigInteger('from_branch_id');
        $table->bigInteger('to_branch_id');
        $table->integer('distance');
        $table->integer('status');
        $table->softDeletes(); // Add soft deletes column
        $table->timestamps(); // Adds created_at and updated_at columns
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('distances', function (Blueprint $table) {
            Schema::dropIfExists('distances'); // Drops the entire table
            $table->dropSoftDeletes(); // Drops the deleted_at column
        });
    }
    
};
