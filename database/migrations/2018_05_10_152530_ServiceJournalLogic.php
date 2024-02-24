<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceJournalLogic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_journal', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->smallInteger('service_status_id')->unsigned();
            $table->integer('service_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('manager_id')->unsigned();
            $table->string('service_no', 256);
            $table->dateTime('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('modify_date')->nullable();
        });

        Schema::table('service_journal', function(Blueprint $table)
        {
            $table->foreign('service_id', 'service_journal_services_fk')->references('id')->on('service')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('service_status_id', 'service_journal_service_status_fk')->references('id')->on('service_status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('client_id', 'service_journal_client_fk')->references('id')->on('profile')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('manager_id', 'service_journal_manager_fk')->references('id')->on('profile')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::create('service_journal_step', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('service_journal_id')->unsigned();
            $table->integer('service_step_id')->unsigned();
            $table->string('service_step_no', 256);
            $table->boolean('is_completed');
            $table->dateTime('execution_start_date')->nullable();
            $table->dateTime('completion_date')->nullable();
        });

        Schema::table('service_journal_step', function(Blueprint $table)
        {
            $table->foreign('service_journal_id', 'service_journal_step_service_journal_fk')->references('id')->on('service_journal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('service_step_id', 'service_journal_step_result_service_step_fk')->references('id')->on('service_step')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::create('service_journal_payment', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('service_journal_id')->unsigned();
            $table->string('document_no', 128)->nullable();
            $table->date('document_date')->nullable();
            $table->dateTime('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->decimal('amount');
            $table->smallInteger('currency_id');
            $table->boolean('is_payed');
        });

        Schema::table('service_journal_payment', function(Blueprint $table)
        {
            $table->foreign('service_journal_id', 'service_journal_payment_service_journal_fk')->references('id')->on('service_journal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('currency_id', 'service_journal_payment_currency_fk')->references('id')->on('currency')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::create('service_journal_message', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('service_journal_id')->unsigned();
            $table->integer('message_id')->unsigned();
            $table->dateTime('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('created_by')->unsigned();
        });

        Schema::table('service_journal_message', function(Blueprint $table)
        {
            $table->foreign('service_journal_id', 'service_journal_message_service_journal_fk')->references('id')->on('service_journal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('message_id', 'service_journal_message_message_fk')->references('id')->on('messages')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('created_by', 'service_journal_message_created_by_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });


        Schema::create('service_journal_document', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('service_journal_id')->unsigned();
            $table->integer('document_id')->unsigned();
            $table->dateTime('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('created_by')->unsigned();
            $table->string('description', 1024);
        });

        Schema::table('service_journal_document', function(Blueprint $table)
        {
            $table->foreign('service_journal_id', 'service_journal_document_service_journal_fk')->references('id')->on('service_journal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('document_id', 'service_journal_document_dcoument_fk')->references('id')->on('document')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('created_by', 'service_journal_document_created_by_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });


        Schema::create('service_journal_client_document', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('service_journal_id')->unsigned();
            $table->integer('service_journal_step_id')->unsigned()->nullable();
            $table->integer('document_id')->unsigned();
            $table->dateTime('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('description', 1024);
        });

        Schema::table('service_journal_client_document', function(Blueprint $table)
        {
            $table->foreign('service_journal_id', 'service_journal_client_document_service_journal_fk')->references('id')->on('service_journal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('service_journal_step_id', 'service_journal_client_document_service_journal_step_fk')->references('id')->on('service_journal_step')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('document_id', 'service_journal_client_document_dcoument_fk')->references('id')->on('document')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
