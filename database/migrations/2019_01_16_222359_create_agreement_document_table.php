<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgreementDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreement_document', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('agreement_id');
            $table->unsignedInteger('document_id');
            $table->boolean('is_actual');
            $table->boolean('is_system_generated');
            $table->dateTime('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::table('agreement_document', function(Blueprint $table)
        {
            $table->foreign('agreement_id', 'agreement_document_invoice_fk')->references('id')->on('agreement');
        });

        Schema::table('agreement_document', function(Blueprint $table)
        {
            $table->foreign('document_id', 'agreement_document_document_fk')->references('id')->on('document');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agreement_document');
    }
}
