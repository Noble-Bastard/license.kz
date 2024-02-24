<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateServiceStepAddPlanExecutionTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_step', function (Blueprint $table){
           $table->integer('execution_time_plan');
        });
        Schema::table('task', function (Blueprint $table){
            $table->integer('execution_time_plan');
            $table->integer('execution_time_fact');
        });
        Schema::table('task_hist', function (Blueprint $table){
            $table->integer('execution_time_plan');
            $table->integer('execution_time_fact');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_step', function (Blueprint $table){
            $table->dropColumn('execution_time_plan');
        });
        Schema::table('task', function (Blueprint $table){
            $table->dropColumn('execution_time_plan');
            $table->dropColumn('execution_time_fact');
        });
        Schema::table('task_hist', function (Blueprint $table){
            $table->dropColumn('execution_time_plan');
            $table->dropColumn('execution_time_fact');
        });
    }
}
