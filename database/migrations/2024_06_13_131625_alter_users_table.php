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
        Schema::table('users', function (Blueprint $table) {
            $table->string('degree')->nullable()->after('remember_token');
            $table->string('institution')->nullable()->after('degree');
            $table->string('position')->nullable()->after('institution');
            $table->string('department')->nullable()->after('position');
            $table->text('reason')->nullable()->after('department');
            $table->string('userId')->nullable()->after('reason');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
