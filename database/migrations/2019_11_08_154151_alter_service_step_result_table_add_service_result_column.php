<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterServiceStepResultTableAddServiceResultColumn extends Migration
{

    public function up()
    {
        Schema::table('service_step_result',function (Blueprint $table){
            $table->unsignedInteger('service_result_id')->nullable();

            $table->foreign('service_result_id', 'service_step_result_service_result_fk')
                ->references('id')->on('service_result');
        });

        DB::unprepared("
            update service_step_result as ssr
                inner join service_result sr
                on sr.description = ssr.description
            set
                ssr.service_result_id = sr.id;
        ");

        Schema::table('service_step_result',function (Blueprint $table){
            $table->dropColumn('description');
        });

        DB::unprepared("        
            delete t from translation t
                inner join translation_attribute as ta
                on t.translation_attribute_id = ta.id
                    inner join translation_entity te
                    on te.id = ta.translation_entity_id
            where te.name = 'service_step_result';
            
            delete ta from translation_attribute as ta
                inner join translation_entity te
                on te.id = ta.translation_entity_id
            where te.name = 'service_step_result';
            
            delete from translation_entity
            where name = 'service_step_result';
        ");
    }


    public function down()
    {
        //
    }
}
