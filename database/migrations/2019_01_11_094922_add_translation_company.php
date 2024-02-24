<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTranslationCompany extends Migration
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
          values(5, 'country');
        ");

        DB::unprepared("
          insert into translation_attribute(id, translation_entity_id, name )
          values 
            (7, 5, 'name')
          ;
        ");

        DB::unprepared("
          insert into translation(translation_attribute_id, language_id, pk_value, value )
          values 
            (7, 2, 1, 'Kazakhstan'),
            (7, 2, 2, 'Russia')
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
