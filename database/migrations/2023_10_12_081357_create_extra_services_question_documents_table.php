<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraServicesQuestionDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_services_question_documents', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('extra_services_document_id');
          $table->unsignedInteger('extra_service_question_value_id');
          $table->unsignedInteger('extra_services_step_header_id');
          $table->softDeletes();

          $table->foreign('extra_services_document_id', 'es_question_documents_es_document_id_foreign')
            ->references('id')->on('extra_services_documents');
          $table->foreign('extra_service_question_value_id', 'es_question_documents_es_question_values_foreign')
            ->references('id')->on('extra_service_question_values');
          $table->foreign('extra_services_step_header_id', 'es_question_documents_es__step_headers_foreign')
            ->references('id')->on('extra_services_step_headers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extra_services_question_documents');
    }
}
