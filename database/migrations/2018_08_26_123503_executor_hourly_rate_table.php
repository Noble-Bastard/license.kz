<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExecutorHourlyRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('executor_hourly_rate', function(Blueprint $table)
        {
            $table->Integer('id', true);
            $table->Integer('executor_id')->unsigned();
            $table->Integer('hourly_rate');
            $table->dateTime('create_date');
            $table->Integer('created_by')->unsigned();
        });

        Schema::table('executor_hourly_rate', function (Blueprint $table){
            $table->foreign('executor_id','executor_hourly_rate_profile_fk')->references('id')->on('profile');
            $table->foreign('created_by','executor_hourly_rate_profile_created_by_fk')->references('id')->on('profile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('executor_hourly_rate');
    }
}
