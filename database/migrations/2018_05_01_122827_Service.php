<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Service extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('counter_type', function(Blueprint $table)
        {
            $table->smallInteger('id', true)->unsigned();
            $table->string('code', 32);
            $table->string('name', 256);
        });

        Schema::create('counter', function(Blueprint $table)
        {
            $table->smallInteger('id', true)->unsigned();
            $table->smallInteger('counter_type_id')->unsigned()->unique();
            $table->string('mask', 50);
            $table->integer('length');
            $table->integer('increase');
            $table->integer('sequence');
        });

        Schema::table('counter', function ($table) {
            $table->foreign('counter_type_id','counter_counter_type_fk')->references('id')->on('counter_type');
        });

        Schema::create('service', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->smallInteger('service_thematic_group_id')->unsigned();
            $table->string('name', 256);
            $table->string('description', 1024);
            $table->string('required_document', 2048);
            $table->smallInteger('time_of_service_execution_from')->unsigned();
            $table->smallInteger('time_of_service_execution_to')->unsigned();
            $table->boolean('is_active');
            $table->smallInteger('counter_type_id')->unsigned();
        });

        Schema::table('service', function ($table) {
            $table->foreign('service_thematic_group_id','service_service_thematic_group_fk')->references('id')->on('service_thematic_group');
        });

        Schema::table('service', function ($table) {
            $table->foreign('counter_type_id','service_counter_type_fk')->references('id')->on('counter_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('counter')) {
            Schema::drop('counter');
        }

        if (Schema::hasTable('service')) {
            Schema::drop('service');
        }

        if (Schema::hasTable('counter_type')) {
            Schema::drop('counter_type');
        }
    }
}
