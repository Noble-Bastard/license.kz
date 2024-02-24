<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterServiceExtViewAddedServiceStepMapUsageRequiredDocumentAddServiceReqDocColumn extends Migration
{

    public function up()
    {
        Schema::table('service_step_required_document',function (Blueprint $table){
            $table->unsignedInteger('service_required_document_id')->nullable();

            $table->foreign('service_required_document_id', 'service_step_required_document_service_req_doc_fk')
                ->references('id')->on('service_required_document');
        });

        DB::unprepared("
            update service_step_required_document as ssrd
                inner join service_required_document srd
                on srd.description = ssrd.description
            set
                ssrd.service_required_document_id = srd.id;
        ");

        Schema::table('service_step_required_document',function (Blueprint $table){
            $table->dropForeign('service_step_required_document_document_fk');
            $table->dropColumn('document_template_id');
            $table->dropColumn('description');
        });
    }

    public function down()
    {
        //
    }
}
