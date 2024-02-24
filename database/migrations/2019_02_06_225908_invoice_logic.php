<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InvoiceLogic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('service_journal_id');
            $table->string('invoice_no',32);
            $table->date('invoice_date');
            $table->date('turnover_date');
            $table->dateTime('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::table('invoice', function(Blueprint $table)
        {
            $table->foreign('service_journal_id', 'invoice_service_journal_fk')->references('id')->on('service_journal');
        });

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
        //
    }
}
