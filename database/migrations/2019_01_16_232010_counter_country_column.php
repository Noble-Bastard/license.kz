<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CounterCountryColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('counter', function (Blueprint $table){
            $table->smallInteger('country_id')->nullable();
            $table->foreign('country_id','counter_country_fk')->references('id')->on('country');
        });

        Schema::table('counter', function (Blueprint $table){
            $table->index('counter_type_id','counter_counter_type_id_fki');
            $table->dropIndex('counter_counter_type_id_unique');
        });

        Schema::table('counter', function (Blueprint $table){
            $table->unique(array('counter_type_id', 'country_id'),'counter_uix');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('counter', function (Blueprint $table){
            $table->dropForeign('counter_country_fk');
            $table->dropColumn('country_id');
        });
    }
}
