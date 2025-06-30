<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFranchiseApplicationsTable extends Migration
{
    public function up()
    {
        Schema::create('franchise_applications', function (Blueprint $table) {
            $table->id();
            $table->string('title', 10)->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('age')->nullable();
            $table->string('email')->unique();
            $table->string('cell_number')->nullable();
            $table->string('landline_number')->nullable();
            $table->decimal('total_cash_invest', 15, 2)->nullable();
            $table->decimal('own_cash_invest', 15, 2)->nullable();
            $table->decimal('borrowed_funds', 15, 2)->nullable();
            $table->string('borrow_from')->nullable();
            $table->integer('no_of_outlets')->nullable();
            $table->text('areas_of_interest')->nullable();
            $table->date('planned_opening_date')->nullable();
            $table->text('business_experience')->nullable();
            $table->text('additional_comments')->nullable();
            $table->longText('signature_data')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('franchise_applications');
    }
}
