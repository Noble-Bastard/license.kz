<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RegistrationFromTemplateOptionsetAndTableStructureChange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('parameter_optionset_setting')) {
            Schema::drop('parameter_optionset_setting');
        }

        if (Schema::hasTable('parameter_table_column_setting')) {
            Schema::drop('parameter_table_column_setting');
        }

        if (Schema::hasTable('parameter_table_setting')) {
            Schema::drop('parameter_table_setting');
        }


        Schema::create('optionset_type', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->string('name',256);
        });

        Schema::create('optionset_value_template', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('optionset_type_id')->unsigned();
            $table->string('optionset_value',128);
            $table->integer('optionset_id')->unsigned();
            $table->boolean('is_default');
        });

        Schema::table('optionset_value_template', function ($table) {
            $table->foreign('optionset_type_id','optionset_value_template_optionset_type_fk')->references('id')->on('optionset_type');
        });


        Schema::table('parameter_optionset_value', function ($table) {
            $table->integer('optionset_type_id')->unsigned();
        });

        Schema::table('parameter_optionset_value', function ($table) {
            $table->foreign('optionset_type_id','parameter_optionset_value_optionset_type_fk')->references('id')->on('optionset_type');
        });

        Schema::table('registration_form_parameter_template', function ($table) {
            $table->integer('optionset_type_id')->unsigned()->nullable();
        });

        Schema::table('registration_form_parameter_template', function ($table) {
            $table->foreign('optionset_type_id','registration_form_parameter_template_optionset_type_fk')->references('id')->on('optionset_type');
        });


        Schema::create('registration_form_parameter_template_table', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('registration_form_parameter_template_id')->unsigned();
            $table->string('table_caption',256);
        });


        Schema::table('registration_form_parameter_template_table', function ($table) {
            $table->foreign('registration_form_parameter_template_id','registration_form_parameter_template_table_fk')->references('id')->on('registration_form_parameter_template');
        });

        Schema::create('registration_form_parameter_template_table_structure', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('registration_form_parameter_template_table_id')->unsigned();
            $table->string('column_caption',256);
            $table->smallInteger('column_parameter_type_id')->unsigned();
            $table->smallInteger('column_order')->unsigned();
            $table->integer('optionset_type_id')->unsigned()->nullable();
        });


        Schema::table('registration_form_parameter_template_table_structure', function ($table) {
            $table->foreign('optionset_type_id','registration_form_parameter_template_table_strct_oset_type_fk')->references('id')->on('optionset_type');
            $table->foreign('column_parameter_type_id','registration_form_parameter_template_table_structure_pt_fk')->references('id')->on('parameter_type');
            $table->foreign('registration_form_parameter_template_table_id','registration_form_parameter_template_table_strct_tbl_fk')->references('id')->on('registration_form_parameter_template_table');

        });

        //exclude Table parameter type
        DB::statement('ALTER TABLE registration_form_parameter_template_table_structure ADD CONSTRAINT registration_form_parameter_template_table_strct_pt_chk CHECK (column_parameter_type_id != 6);');


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
