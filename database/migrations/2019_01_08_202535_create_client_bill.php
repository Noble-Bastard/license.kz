<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientBill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('service_journal_bill', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->unsignedInteger('service_journal_id');
        });

        Schema::table('service_journal_bill', function(Blueprint $table)
        {
            $table->foreign('service_journal_id', 'client_bill_service_journal_fk')->references('id')->on('service_journal');
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
        Schema::dropIfExists('service_journal_bill');
    }
}
