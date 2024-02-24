<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommercialOfferTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commercial_offer_type', function(Blueprint $table){
            $table->smallIncrements('id');
            $table->string('name', 256);
        });

        \Illuminate\Support\Facades\DB::statement("
            insert into commercial_offer_type (id, name) values
            (1, 'Коммерческое предложение'),
            (2, 'Требования');
        ");

        Schema::table('commercial_offer', function(Blueprint $table){
            $table->unsignedSmallInteger('commercial_offer_type_id')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commercial_offer_type');
    }
}
