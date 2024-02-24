<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CountryData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement('                    
            delete from country where id=2');

        DB::statement('                    
            insert into country (id, code, name) 
            values
              (2, \'RU\', \'Россия\');                       
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::statement('                    
            delete from country where id=2');
    }
}
