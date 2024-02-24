<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceJournalServiceMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_journal_service_map', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('service_journal_id');
            $table->unsignedInteger('service_id');
        });

        Schema::table('service_journal_service_map', function(Blueprint $table)
        {
            $table->foreign('service_id', 'service_journal_service_map_srv_fk')
                ->references('id')->on('service')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('service_journal_id', 'service_journal_service_map_srvj_fk')
                ->references('id')->on('service_journal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_journal_service_map');
    }
}
