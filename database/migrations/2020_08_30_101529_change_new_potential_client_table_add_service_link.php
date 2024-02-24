<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNewPotentialClientTableAddServiceLink extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_potential_client_service', function (Blueprint $table){
           $table->integerIncrements('id');
           $table->unsignedBigInteger('new_potential_client_id');
           $table->unsignedInteger('service_id');

            $table->foreign('new_potential_client_id', 'npcs_new_potential_client_fk')->references('id')->on('new_potential_client')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('service_id', 'npcs_service_fk')->references('id')->on('service')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
