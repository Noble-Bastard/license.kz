<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgreementServiceJournalColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agreement', function (Blueprint $table){
           $table->integer('service_journal_id')->unsigned()->nullable();
        });

        Schema::table('agreement', function (Blueprint $table) {
            $table->foreign('service_journal_id','agreement_service_journal_fk')->references('id')->on('service_journal');
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
