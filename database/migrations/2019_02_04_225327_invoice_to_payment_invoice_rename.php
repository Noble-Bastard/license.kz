<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InvoiceToPaymentInvoiceRename extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aps_setting', function (Blueprint $table) {
            $table->smallInteger('payment_counter_type_id')->unsigned()->nullable();
        });

        $counterType = new \App\Data\Core\Model\CounterType();
        $counterType->code = 'PAYMENT_INVOICE_COUNTER';
        $counterType->name = 'Счет на оплату';
        $counterType->save();

        DB::statement("
            update aps_setting
            set
              payment_counter_type_id = :payment_counter_type_id",
            array('payment_counter_type_id' => $counterType->id)
        );

        DB::statement("
            insert into counter(
                counter_type_id,
                mask,
                length,
                increase,
                sequence,
                country_id
            )
            select
                :counter_type_id as counter_type_id,
                'ОПЛ-' as mask,
                6 length,
                1 increase,
                0 sequence,
                c.id as country_id
            from country as c",
            array('counter_type_id' => $counterType->id)
        );

        DB::statement('delete from document where id in (select document_id from invoice_document);');
        Schema::dropIfExists('invoice_document');
        Schema::dropIfExists('payment_journal');
        Schema::dropIfExists('invoice');
        Schema::create('payment_invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('service_journal_id');
            $table->unsignedInteger('agreement_id');
            $table->string('payment_invoice_no',32);
            $table->date('payment_invoice_date');
            $table->dateTime('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedSmallInteger('payment_status_id');
            $table->decimal('amount',15,4);
            $table->smallInteger('currency_id');
        });

        Schema::table('payment_invoice', function(Blueprint $table)
        {
            $table->foreign('service_journal_id', 'payment_invoice_service_journal_fk')->references('id')->on('service_journal');
        });

        Schema::table('payment_invoice', function(Blueprint $table)
        {
            $table->foreign('currency_id', 'payment_invoice_currency_fk')->references('id')->on('currency');
        });

        Schema::table('payment_invoice', function(Blueprint $table)
        {
            $table->foreign('payment_status_id', 'payment_invoice_payment_status_fk')->references('id')->on('payment_status');
        });

        Schema::table('payment_invoice', function(Blueprint $table)
        {
            $table->foreign('agreement_id', 'payment_invoice_agreement_fk')->references('id')->on('agreement');
        });


        Schema::create('payment_invoice_document', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('payment_invoice_id');
            $table->unsignedInteger('document_id');
            $table->boolean('is_actual');
            $table->boolean('is_system_generated');
            $table->dateTime('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::table('payment_invoice_document', function(Blueprint $table)
        {
            $table->foreign('payment_invoice_id', 'payment_invoice_document_payment_invoice_fk')->references('id')->on('payment_invoice');
        });

        Schema::table('payment_invoice_document', function(Blueprint $table)
        {
            $table->foreign('document_id', 'payment_invoice_document_document_fk')->references('id')->on('document');
        });


        Schema::create('payment_journal', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('payment_invoice_id');
            $table->date('payment_date');
            $table->dateTime('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedSmallInteger('payment_type_id');
            $table->decimal('amount',15,4);
            $table->smallInteger('currency_id');
            $table->string('ext_payment_id',20)->nullable();
            $table->string('ext_status',20)->nullable();
            $table->string('ext_error_code',20)->nullable();
            $table->text('ext_message')->nullable();
            $table->text('ext_details')->nullable();
        });

        Schema::table('payment_journal', function(Blueprint $table)
        {
            $table->foreign('payment_invoice_id', 'payment_journal_payment_invoice_fk')->references('id')->on('payment_invoice');
        });

        Schema::table('payment_journal', function(Blueprint $table)
        {
            $table->foreign('payment_type_id', 'payment_journal_payment_type_fk')->references('id')->on('payment_type');
        });

        Schema::table('payment_journal', function(Blueprint $table)
        {
            $table->foreign('currency_id', 'payment_journal_currency_fk')->references('id')->on('currency');
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
