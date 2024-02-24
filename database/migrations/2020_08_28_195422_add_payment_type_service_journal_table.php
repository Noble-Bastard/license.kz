<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentTypeServiceJournalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_journal', function (Blueprint $table){
            $table->unsignedSmallInteger('payment_type_id')->default('2');
            $table->unsignedInteger('city_id')->nullable();

            $table->foreign('payment_type_id', 'service_journal_payment_type_fk')->references('id')->on('payment_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('city_id', 'service_journal_city_fk')->references('id')->on('city')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
