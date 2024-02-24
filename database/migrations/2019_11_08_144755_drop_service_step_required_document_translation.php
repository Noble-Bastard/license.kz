<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropServiceStepRequiredDocumentTranslation extends Migration
{

    public function up()
    {
        DB::unprepared("        
            delete t from translation t
                inner join translation_attribute as ta
                on t.translation_attribute_id = ta.id
                    inner join translation_entity te
                    on te.id = ta.translation_entity_id
            where te.name = 'service_step_required_document';
            
            delete ta from translation_attribute as ta
                inner join translation_entity te
                on te.id = ta.translation_entity_id
            where te.name = 'service_step_required_document';
            
            delete from translation_entity
            where name = 'service_step_required_document';
        ");
    }


    public function down()
    {
        //
    }
}
