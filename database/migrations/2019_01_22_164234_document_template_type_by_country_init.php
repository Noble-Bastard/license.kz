<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DocumentTemplateTypeByCountryInit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            insert into document_template_type (id, name)
            values
              (3, \'Шаблон счет фактуры\');
                                          
        ');

        DB::statement('
            insert into document_template (
              name, 
              path, 
              country_id, 
              document_template_type_id
            )
            select 
              null, 
              null, 
              c.id,
              dtt.id
            from country as c
              inner join document_template_type dtt 
              on 1 = 1;
                                          
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
    }
}
