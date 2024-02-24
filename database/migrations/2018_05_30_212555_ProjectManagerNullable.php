<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProjectManagerNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project', function(Blueprint $table)
        {
            $table->integer('manager_id')->unsigned()->nullable()->change();
        });

        Schema::table('task', function(Blueprint $table)
        {
            $table->dateTime('execution_time')->nullable()->change();
        });

        Schema::table('task_hist', function(Blueprint $table)
        {
            $table->dateTime('execution_time')->nullable()->change();
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
    }
}
