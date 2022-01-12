<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobSalaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_salary', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('currency_type');
            $table->string('range_from');
            $table->string('range_to');
            $table->string('rate');
            $table->unsignedBigInteger('job_id');
            $table->timestamps();
            
            $table->foreign('job_id')
                ->references('id')
                ->on('jobs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_salary');
    }
}
