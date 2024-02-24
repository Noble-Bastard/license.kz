<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceResultTranslationInit extends Migration
{

    public function up()
    {
        DB::unprepared("
          insert into translation_entity(id, name)
          values(21, 'service_result');
        ");

        DB::unprepared("
          insert into translation_attribute(translation_entity_id, name )
          values 
            (21, 'description')
          ;
        ");

        DB::unprepared("
            insert into translation(translation_attribute_id, language_id, pk_value, value) 
            select
                tad.id as translation_attribute_id,
                2 as language_id,
                srd.id,
                max(t.value) description_en
            from service_step_result as ssrd
                left join service_result srd
                on srd.description = ssrd.description
                left join translation_entity te
                on te.name = 'service_step_result'
                    left join translation_attribute ta
                    on ta.translation_entity_id = te.id
                    and ta.name = 'description'
                        left join translation t
                        on t.translation_attribute_id = ta.id
                        and t.pk_value = ssrd.id
                        and t.language_id = 2
                left join translation_entity ted
                on ted.name = 'service_result'
                    left join translation_attribute tad
                    on tad.translation_entity_id = ted.id
                    and tad.name = 'description'
            group by srd.id, ssrd.description, tad.id
            having max(t.value) is not null;
        ");
    }


    public function down()
    {
        //
    }
}
