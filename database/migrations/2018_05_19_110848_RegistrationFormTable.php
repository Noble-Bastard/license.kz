<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RegistrationFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_form', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('service_journal_id')->unsigned()->unique('registration_form_uix');
            $table->string('form_number',32);
            $table->dateTime('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::table('registration_form', function ($table) {
            $table->foreign('service_journal_id','registration_form_service_journal_fk')->references('id')->on('service_journal');
        });

        Schema::create('registration_form_group', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('registration_form_id')->unsigned();
            $table->smallInteger('parameter_group_id')->unsigned();
            $table->smallInteger('order_number')->unsigned();
        });

        Schema::table('registration_form_group', function ($table) {
            $table->foreign('registration_form_id','registration_form_group_registration_form_fk')->references('id')->on('registration_form');
            $table->foreign('parameter_group_id','registration_form_group_parameter_group_fk')->references('id')->on('parameter_group');
        });


        Schema::create('registration_form_parameter', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('registration_form_group_id')->unsigned()->nullable();
            $table->smallInteger('parameter_type_id')->unsigned();
            $table->string('caption',256);
            $table->string('comment',1024)->nullable();
            $table->string('parameter_formatted_value',1024)->nullable();
            $table->smallInteger('order_number')->unsigned();
        });

        Schema::table('registration_form_parameter', function ($table) {
            $table->foreign('registration_form_group_id','registration_form_parameter_form_group_fk')->references('id')->on('registration_form_group');
            $table->foreign('parameter_type_id','registration_form_parameter_parameter_type_fk')->references('id')->on('parameter_type');
        });

        Schema::create('parameter_number_value', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('registration_form_parameter_id')->unique('parameter_number_value_uix')->unsigned();
            $table->decimal('parameter_value');
        });


        Schema::table('parameter_number_value', function ($table) {
            $table->foreign('registration_form_parameter_id','parameter_number_value_form_parameter_fk')->references('id')->on('registration_form_parameter');
        });

        Schema::create('parameter_bool_value', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('registration_form_parameter_id')->unique('parameter_bool_value_uix')->unsigned();
            $table->boolean('parameter_value');
        });

        Schema::table('parameter_bool_value', function ($table) {
            $table->foreign('registration_form_parameter_id','parameter_bool_value_form_parameter_fk')->references('id')->on('registration_form_parameter');
        });

        Schema::create('parameter_datetime_value', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('registration_form_parameter_id')->unique('parameter_datetime_value_uix')->unsigned();
            $table->dateTime('parameter_value');
        });

        Schema::table('parameter_datetime_value', function ($table) {
            $table->foreign('registration_form_parameter_id','parameter_datetime_value_form_parameter_fk')->references('id')->on('registration_form_parameter');
        });

        Schema::create('parameter_optionset_value', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('registration_form_parameter_id')->unique('parameter_optionset_value_uix')->unsigned();
            $table->string('optionset_value',128);
            $table->integer('optionset_id')->unsigned();
        });

        Schema::table('parameter_optionset_value', function ($table) {
            $table->foreign('registration_form_parameter_id','parameter_optionset_value_form_parameter_fk')->references('id')->on('registration_form_parameter');
        });


        Schema::create('parameter_table_column_value', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('registration_form_parameter_id')->unsigned();
            $table->integer('row_id')->unsigned();
            $table->integer('column_value_id')->unsigned();
        });

        Schema::table('parameter_table_column_value', function ($table) {
            $table->foreign('registration_form_parameter_id','parameter_table_column_value_registration_form_parameter_fk')->references('id')->on('registration_form_parameter');
            $table->foreign('column_value_id','parameter_table_column_value_form_parameter_fk')->references('id')->on('registration_form_parameter');
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
