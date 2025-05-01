<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id');
            $table->string('full_name');
            $table->string('mobile');
            $table->string('email');
            $table->string('address');
            $table->enum('gender', ['male', 'female']);
            $table->text('why_hire');
            $table->string('resume');
            $table->timestamps();

            $table->foreign('job_id')->references('id')->on('careers')->onDelete('cascade'); // Assuming 'careers' is the job table
        });
    }

    public function down()
    {
        Schema::dropIfExists('applications');
    }
}


