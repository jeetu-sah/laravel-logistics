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
        Schema::table('branches', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('column_name');  // Replace 'column_name' with the name of the column after which you want to add `deleted_at`.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
};
