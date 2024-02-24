<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentJournalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_journal', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('invoice_id');
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
            $table->foreign('invoice_id', 'payment_journal_invoice_fk')->references('id')->on('invoice');
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
        Schema::dropIfExists('payment_journal');
    }
}
