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
        Schema::create('article_types', function (Blueprint $table) {
            $table->id(); // auto-incrementing id column
            $table->string('name', 50);
            $table->string('slug', 50);
            $table->text('description')->nullable();
            $table->string('status', 20)->comment('active, inactive');
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_types');
    }
};
