<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ServiceJournalProfileLegalServiceJournalNotNull extends Migration
{
    public function up()
    {
        Schema::table('service_journal_profile_legal', function (Blueprint $table){
            $table->integer('service_journal_id')->unsigned()->nullable(false)->change();
        });
    }


    public function down()
    {
        //
    }
}
