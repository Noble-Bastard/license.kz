<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommercialOfferServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commercial_offer_service', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedBigInteger('commercial_offer_id');
            $table->unsignedInteger('service_id');

            $table->foreign('commercial_offer_id', 'cos_commercial_offer_fk')->references('id')->on('commercial_offer')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('service_id', 'cos_service_fk')->references('id')->on('service')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commercial_offer_service');
    }
}
