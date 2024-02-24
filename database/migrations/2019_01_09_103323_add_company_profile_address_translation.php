<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyTranslation extends Migration
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
          values(4, 'company_profile_address');
        ");

        DB::unprepared("
          insert into translation_attribute(id, translation_entity_id, name )
          values 
            (5, 4, 'address'),
            (6, 4, 'name')
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
