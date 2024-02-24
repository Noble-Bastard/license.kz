<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainServiceCarousel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_service_carousel', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('service_id')->unsigned();
            $table->integer('order_no');
        });

        Schema::table('main_service_carousel', function (Blueprint $table){
            $table->foreign('service_id','main_service_carousel_service_fk')->references('id')->on('service');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('main_service_carousel');
    }
}
