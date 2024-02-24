<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city', function(Blueprint $table){
            $table->increments('id');
            $table->smallInteger('country_id');
            $table->string('value', 32);

            $table->foreign('country_id','city_country_fk')->references('id')->on('country');
        });

        \Illuminate\Support\Facades\DB::statement('delete from company_profile_address;');
        \Illuminate\Support\Facades\DB::statement('alter table company_profile_address drop foreign key company_profile_address_company_profile_fk;');

        Schema::table('company_profile_address', function (Blueprint $table){
            $table->dropColumn('company_profile_id');
            $table->unsignedInteger('city_id');
            $table->string('email', 64);
            $table->string('skype', 64);
            $table->string('phone', 20);
            $table->string('phone_1', 20);
            $table->string('fax', 20);
            $table->string('location', 30);
            $table->string('beneficiary', 1024);
            $table->string('bank', 512);
            $table->string('BIN', 30);
            $table->string('IIK', 30);
            $table->string('KBE', 10);
            $table->string('BIK', 30);
            $table->string('payment_code', 10);

            $table->foreign('city_id','company_profile_address_city_fk')->references('id')->on('city');
        });

        Schema::dropIfExists('company_profile');

        Schema::dropIfExists('company_profile_ext');

        DB::unprepared("
          insert into translation_entity(id, name)
          values(3, 'city');
        ");

        DB::unprepared("
          insert into translation_attribute(id, translation_entity_id, name )
          values (4, 3, 'value');
        ");
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
