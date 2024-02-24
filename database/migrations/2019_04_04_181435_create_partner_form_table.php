<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_form', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fio', 1024);
            $table->string('position', 1024);
            $table->string('email', 128);
            $table->string('phone', 128);
            $table->string('company_name', 512);
            $table->string('company_site', 128);
            $table->string('company_phone', 128);
            $table->string('company_activity', 2048);
            $table->string('company_location', 512);
            $table->string('company_additionally', 2048)->nullable();
            $table->string('company_logo', 2048)->nullable();
        });

        Schema::create('partner_form_social', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('partner_form_id');
            $table->unsignedInteger('social_type_id');
            $table->string('value', 128);

            $table->foreign('partner_form_id', 'partner_form_social_partner_form_fk')->references('id')->on('partner_form');
            $table->foreign('social_type_id', 'partner_form_social_social_type_fk')->references('id')->on('social_type');
        });

        Schema::create('profile_partner', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('profile_id')->unsigned()->unique('profile_legal_uix');
            $table->string('company_name', 512);
            $table->string('company_site', 128);
            $table->string('company_logo', 2048)->nullable();
            $table->string('company_activity_field', 2048)->nullable();
            $table->string('company_founder', 2048)->nullable();
            $table->string('company_services', 2048)->nullable();
            $table->string('company_projects', 2048)->nullable();
            $table->string('company_awards', 2048)->nullable();

            $table->foreign('profile_id', 'profile_partner_profile_fk')->references('id')->on('profile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partner_form_social');
        Schema::dropIfExists('profile_partner');
        Schema::dropIfExists('partner_form');
    }
}
