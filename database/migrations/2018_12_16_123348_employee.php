<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Employee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('employee_position_id');
            $table->string('first_name', 256);
            $table->string('last_name', 256);
            $table->string('photo_path', 2048);
            $table->text('description');
            $table->text('work_experience_description');
            $table->text('about_me');
            $table->text('skill_achievement_description');
            $table->string('phone', 128);
            $table->string('address', 128);
            $table->string('email', 128);
            $table->string('web_site', 128);

            $table->foreign('employee_position_id', 'employee_employee_position_fk')->references('id')->on('employee_position');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee');
    }
}
