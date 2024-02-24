<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RegistrationFormTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_form_template', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->smallInteger('counter_type_id')->unsigned();
        });

        Schema::table('registration_form_template', function ($table) {
            $table->foreign('counter_type_id','registration_form_template_counter_type_fk')->references('id')->on('counter_type');
        });

        Schema::create('service_registration_form_template', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('service_id')->unsigned();
            $table->integer('registration_form_template_id')->unsigned();
        });

        Schema::table('service_registration_form_template', function ($table) {
            $table->foreign('service_id','service_registration_form_template_service_fk')->references('id')->on('service');
            $table->foreign('registration_form_template_id','service_registration_form_template_registration_form_template_fk')->references('id')->on('registration_form_template');
        });

        Schema::create('parameter_group', function(Blueprint $table)
        {
            $table->smallInteger('id', true)->unsigned();
            $table->string('name',256);
        });


        Schema::create('registration_form_group_template', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('registration_form_template_id')->unsigned();
            $table->smallInteger('parameter_group_id')->unsigned();
            $table->smallInteger('order_number')->unsigned();
        });

        Schema::table('registration_form_group_template', function ($table) {
            $table->foreign('registration_form_template_id','registration_form_group_template_registration_form_template_fk')->references('id')->on('registration_form_template');
            $table->foreign('parameter_group_id','registration_form_group_template_parameter_group_fk')->references('id')->on('parameter_group');
        });

        Schema::create('parameter_type', function(Blueprint $table)
        {
            $table->smallInteger('id', true)->unsigned();
            $table->string('name',32);
            $table->string('data_type',16);
        });


        Schema::create('registration_form_parameter_template', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('registration_form_group_template_id')->unsigned();
            $table->smallInteger('parameter_type_id')->unsigned();
            $table->string('caption',256);
            $table->boolean('is_active');
            $table->string('comment',1024)->nullable();
            $table->smallInteger('order_number')->unsigned();
        });

        Schema::table('registration_form_parameter_template', function ($table) {
            $table->foreign('registration_form_group_template_id','registration_form_parameter_template_group_template_fk')->references('id')->on('registration_form_group_template');
            $table->foreign('parameter_type_id','registration_form_parameter_template_parameter_type_fk')->references('id')->on('parameter_type');
        });


        Schema::create('parameter_text_setting', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->smallInteger('parameter_type_id')->unique('parameter_text_setting_uix')->unsigned();
            $table->string('validation_mask',32)->nullable();
            $table->string('default_value',128)->nullable();
        });


        Schema::table('parameter_text_setting', function ($table) {
            $table->foreign('parameter_type_id','parameter_text_setting_parameter_type_fk')->references('id')->on('parameter_type');
        });


        Schema::create('parameter_number_setting', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->smallInteger('parameter_type_id')->unique('parameter_number_setting_uix')->unsigned();
            $table->decimal('min_value')->nullable();
            $table->decimal('max_value')->nullable();
            $table->decimal('default_value')->nullable();
            $table->smallInteger('round_type')->unsigned()->nullable();
        });


        Schema::table('parameter_number_setting', function ($table) {
            $table->foreign('parameter_type_id','parameter_number_setting_parameter_type_fk')->references('id')->on('parameter_type');
        });

        Schema::create('parameter_datetime_setting', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->smallInteger('parameter_type_id')->unique('parameter_datetime_setting_uix')->unsigned();
            $table->string('date_format',16)->nullable();
            $table->dateTime('default_value')->nullable();
        });


        Schema::table('parameter_datetime_setting', function ($table) {
            $table->foreign('parameter_type_id','parameter_datetime_setting_parameter_type_fk')->references('id')->on('parameter_type');
        });


        Schema::create('parameter_optionset_setting', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->smallInteger('parameter_type_id')->unsigned();
            $table->string('optionset_value',128);
            $table->integer('optionset_id')->unsigned();
            $table->boolean('is_default');
        });

        Schema::table('parameter_optionset_setting', function ($table) {
            $table->foreign('parameter_type_id','parameter_optionset_setting_parameter_type_fk')->references('id')->on('parameter_type');
        });


        Schema::create('parameter_table_setting', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->smallInteger('parameter_type_id')->unsigned()->unique('parameter_table_setting_uix');
            $table->string('table_caption',256);
        });

        Schema::table('parameter_table_setting', function ($table) {
            $table->foreign('parameter_type_id','parameter_table_setting_parameter_type_fk')->references('id')->on('parameter_type');
        });


        Schema::create('parameter_table_column_setting', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('parameter_table_setting_id')->unsigned();
            $table->string('column_caption',256);
            $table->smallInteger('column_parameter_type_id')->unsigned();
            $table->smallInteger('column_order')->unsigned();
        });

        Schema::table('parameter_table_column_setting', function ($table) {
            $table->foreign('column_parameter_type_id','parameter_table_column_setting_parameter_type_fk')->references('id')->on('parameter_type');
            $table->foreign('parameter_table_setting_id','parameter_table_column_setting_parameter_table_setting_fk')->references('id')->on('parameter_table_setting');
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
