<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddServiceRequiredOcumentIdServiceJournalClientDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('service_journal_client_document', function (Blueprint $table){
//            $table->unsignedInteger('service_required_document_id')->nullable();
//
//            $table->foreign('service_required_document_id', 'sjcd_srd_fk')->references('id')->on('service_required_document')->onUpdate('NO ACTION')->onDelete('NO ACTION');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
