<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceStepRequiredDocumentExt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('        
            create or replace view service_step_required_document_ext
            as
            select
              srd.id,
              ss.service_id,
              srv.name service_name,
              srv.code service_code,
              srd.service_step_id,
              ss.description service_step_description,
              srd.document_number,
              srd.description,
              srd.document_template_id,
              d.name document_template_name,
              d.path document_template_path,
              d.document_type_id,
              dt.name document_type_name
            from service_step_required_document srd
              left join service_step ss
              on ss.id = srd.service_step_id
                left join service srv
                on srv.id = ss.service_id
              left join document d
              on d.id = srd.document_template_id
                left join document_type dt
                on dt.id = d.document_type_id
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
