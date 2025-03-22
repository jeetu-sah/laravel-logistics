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
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();  // Auto-incrementing id (bigint unsigned)
            $table->string('uuid');  // Varchar column for uuid
            $table->text('connection');  // Text column for connection
            $table->text('queue');  // Text column for queue
            $table->longText('payload');  // Longtext column for payload
            $table->longText('exception');  // Longtext column for exception
            $table->timestamp('failed_at')->default(DB::raw('CURRENT_TIMESTAMP'));  // Timestamp for failed_at, default to current timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('failed_jobs');
    }
};
