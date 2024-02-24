<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCareerForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_form', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fio', 1024);
            $table->date('dob');
            $table->string('photo_path', 2048)->nullable();
            $table->string('desired_position', 256);
            $table->string('useful_skills', 2048);
            $table->unsignedSmallInteger('books_read_cnt');
            $table->string('sport_attitude', 1024);
            $table->string('self_describe', 1024);
            $table->string('contribute_development', 1024);
            $table->string('self_see', 1024);
            $table->unsignedInteger('salary');
            $table->string('want_our_team', 1024);
            $table->string('city_location', 1024);
            $table->string('social_status', 256);
            $table->string('phone', 128);
            $table->string('email', 128);
        });

        Schema::create('career_form_education',function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('career_form_id');
            $table->string('place', 2048);
            $table->date('start');
            $table->date('end');
            $table->string('description', 2048);

            $table->foreign('career_form_id', 'career_form_education_career_form_fk')->references('id')->on('career_form');
        });

        Schema::create('career_form_experience',function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('career_form_id');
            $table->string('place', 2048);
            $table->date('start');
            $table->date('end');
            $table->string('main_responsibilities', 2048);
            $table->string('merits', 2048);

            $table->foreign('career_form_id', 'career_form_experience_career_form_fk')->references('id')->on('career_form');
        });

        Schema::create('career_form_lang_knowledge',function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('career_form_id');
            $table->string('lang_name', 124);
            $table->string('lang_level', 124);

            $table->foreign('career_form_id', 'career_form_lang_knowledge_career_form_fk')->references('id')->on('career_form');
        });

        Schema::create('editor_type',function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 124);
        });

        Schema::create('career_form_editor_speed',function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('career_form_id');
            $table->unsignedSmallInteger('editor_type_id');
            $table->smallInteger('value');

            $table->foreign('career_form_id', 'career_form_editor_speed_career_form_fk')->references('id')->on('career_form');
            $table->foreign('editor_type_id', 'career_form_editor_speed_editor_type_fk')->references('id')->on('editor_type');
        });

        Schema::create('career_form_social',function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('career_form_id');
            $table->unsignedInteger('social_type_id');
            $table->smallInteger('value');

            $table->foreign('career_form_id', 'career_form_social_career_form_fk')->references('id')->on('career_form');
            $table->foreign('social_type_id', 'career_form_social_social_type_fk')->references('id')->on('social_type');
        });

        \Illuminate\Support\Facades\DB::statement("
            insert into editor_type (name) values 
              ('Word'),
              ('Excel');
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('career_form_editor_speed');
        Schema::drop('editor_type');
        Schema::drop('career_form_social');
        Schema::drop('career_form_education');
        Schema::drop('career_form_experience');
        Schema::drop('career_form_lang_knowledge');
        Schema::drop('career_form');
    }
}
