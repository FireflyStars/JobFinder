<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobPaymentLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_payment_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('currency');
            $table->string('price');
            $table->string('payment_id');
            $table->boolean('status');
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
        Schema::dropIfExists('job_payment_logs');
    }
}
