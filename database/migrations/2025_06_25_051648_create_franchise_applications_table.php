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
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->integer('age');
            $table->string('email')->unique();
            $table->string('cell_number');
            $table->string('landline_number');
            $table->decimal('total_cash_invest', 15, 2);
            $table->decimal('own_cash_invest', 15, 2);
            $table->decimal('borrowed_funds', 15, 2);
            $table->string('borrow_from');
            $table->integer('no_of_outlets');
            $table->text('areas_of_interest');
            $table->date('planned_opening_date');
            $table->text('business_experience');
            $table->text('additional_comments')->nullable();
            $table->longText('signature_data'); // base64 image data
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('franchise_applications');
    }
}
