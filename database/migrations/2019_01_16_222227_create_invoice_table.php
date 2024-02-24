<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration
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
            $table->unsignedInteger('agreement_id');
            $table->string('invoice_no',32);
            $table->date('invoice_date');
            $table->dateTime('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedSmallInteger('payment_status_id');
            $table->decimal('amount',15,4);
            $table->smallInteger('currency_id');
        });

        Schema::table('invoice', function(Blueprint $table)
        {
            $table->foreign('service_journal_id', 'invoice_service_journal_fk')->references('id')->on('service_journal');
        });

        Schema::table('invoice', function(Blueprint $table)
        {
            $table->foreign('currency_id', 'invoice_currency_fk')->references('id')->on('currency');
        });

        Schema::table('invoice', function(Blueprint $table)
        {
            $table->foreign('payment_status_id', 'invoice_payment_status_fk')->references('id')->on('payment_status');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice');
    }
}
