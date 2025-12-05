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
        Schema::create('branch_commisions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consignor_branch_id');
            $table->unsignedBigInteger('consignee_branch_id');

            $table->foreign('consignor_branch_id')
                ->references('id')
                ->on('branches')
                ->onDelete('cascade');

            $table->foreign('consignee_branch_id')
                ->references('id')
                ->on('branches')
                ->onDelete('cascade');

            $table->decimal('amount', 10, 2)->default(0);

            $table->string('status', 15)->default('active')->comment('active, inactive');
            $table->string('type', 15)->default('outgoing')->comment('outgoing, incoming');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_commisions');
    }
};
