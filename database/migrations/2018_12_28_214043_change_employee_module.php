<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeEmployeeModule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee', function (Blueprint $table){
            $table->dropColumn('work_experience_description');
            $table->dropColumn('about_me');
            $table->dropColumn('skill_achievement_description');
            $table->dropColumn('web_site');
        });

        Schema::table('employee_education', function (Blueprint $table){
            $table->dropColumn('description');
        });

        Schema::table('employee_work_experience', function (Blueprint $table){
            $table->dropColumn('position_name');
            $table->dropColumn('end_date');
        });
        
        Schema::drop('employee_skill_achievement');

        Schema::create('employee_speciality', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('employee_id');
            $table->string('name', 512);
            $table->smallInteger('value');

            $table->foreign('employee_id', 'employee_speciality_employee_fk')->references('id')->on('employee');
        });

        Schema::create('social_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value', 128);
        });

        Schema::create('employee_social', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('employee_id');
            $table->unsignedInteger('social_type_id');
            $table->string('value', 128);

            $table->foreign('employee_id', 'employee_social_employee_fk')->references('id')->on('employee');
            $table->foreign('social_type_id', 'employee_social_social_type_fk')->references('id')->on('social_type');
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
