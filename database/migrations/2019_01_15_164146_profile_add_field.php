<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProfileAddField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile', function (Blueprint $table){
            $table->unsignedSmallInteger('company_profile_address_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();

            $table->foreign('company_profile_address_id','profile_company_profile_address_fk')->references('id')->on('company_profile_address');
            $table->foreign('city_id','profile_city_fk')->references('id')->on('city');
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
