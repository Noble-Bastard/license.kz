<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_document', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('invoice_id');
            $table->unsignedInteger('document_id');
            $table->boolean('is_actual');
            $table->boolean('is_system_generated');
            $table->dateTime('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::table('invoice_document', function(Blueprint $table)
        {
            $table->foreign('invoice_id', 'invoice_document_invoice_fk')->references('id')->on('invoice');
        });

        Schema::table('invoice_document', function(Blueprint $table)
        {
            $table->foreign('document_id', 'invoice_document_document_fk')->references('id')->on('document');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_document');
    }
}
