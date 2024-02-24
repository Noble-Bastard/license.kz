<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTranslationProfilePartner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
          insert into translation_entity(id, name)
          values(16, 'profile_partner');
        ");

        DB::unprepared("
          insert into translation_attribute(translation_entity_id, name )
          values 
            (16, 'company_name'),
            (16, 'company_site'),
            (16, 'company_logo'),
            (16, 'company_activity_field'),
            (16, 'company_founder'),
            (16, 'company_services'),
            (16, 'company_projects'),
            (16, 'company_awards')
          ;
        ");
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
