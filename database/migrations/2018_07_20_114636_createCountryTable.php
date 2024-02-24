<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country', function(Blueprint $table)
        {
            $table->smallInteger('id', true);
            $table->string('code', 16)->nullable();
            $table->string('name', 128)->nullable();
        });

        DB::statement('                    
            insert into country (id, code, name) 
            values
              (1, \'KZ\', \'Казахстан\');                       
        ');

        Schema::table('service', function(Blueprint $table)
        {
            $table->smallInteger('service_country_id')->nullable();

        });

        Schema::table('service', function ($table) {
            $table->foreign('service_country_id','service_country_fk')->references('id')->on('country');
        });

        DB::statement('update service 
                          set service_country_id=1
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('alter table service 
                          drop COLUMN service_country_id');
        Schema::drop('country');

    }
}
