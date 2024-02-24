<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExecutorGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('executor_group', function(Blueprint $table)
        {
            $table->Integer('id', true)->unsigned();;
            $table->string('name', 128)->nullable();
        });

        Schema::create('executor_group_body', function(Blueprint $table)
        {
            $table->Integer('id', true);
            $table->Integer('executor_group_id')->unsigned();
            $table->Integer('profile_id')->unsigned();
        });

        Schema::table('executor_group_body', function (Blueprint $table){
            $table->foreign('executor_group_id','executor_group_body_executor_group_fk')->references('id')->on('executor_group');
            $table->foreign('profile_id','executor_group_body_profile_fk')->references('id')->on('profile');
         });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('executor_group_body');
        Schema::drop('executor_group');
    }
}
