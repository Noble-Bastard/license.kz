<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ServiceRequiredDocumentTranslationInit extends Migration
{

    public function up()
    {
        DB::unprepared("
          insert into translation_entity(id, name)
          values(20, 'service_required_document');
        ");

        DB::unprepared("
          insert into translation_attribute(translation_entity_id, name )
          values
            (20, 'description')
          ;
        ");

        DB::unprepared("
            insert into translation(translation_attribute_id, language_id, pk_value, value) 
            select
                tad.id as translation_attribute_id,
                2 as language_id,
                srd.id,
                max(t.value) description_en
            from service_step_required_document as ssrd
                left join service_required_document srd
                on srd.description = ssrd.description
                left join translation_entity te
                on te.name = 'service_step_required_document'
                    left join translation_attribute ta
                    on ta.translation_entity_id = te.id
                    and ta.name = 'description'
                        left join translation t
                        on t.translation_attribute_id = ta.id
                        and t.pk_value = ssrd.id
                        and t.language_id = 2
                left join translation_entity ted
                on ted.name = 'service_required_document'
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
