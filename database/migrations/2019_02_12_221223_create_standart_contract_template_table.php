<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStandartContractTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standart_contract_template', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 256);
            $table->string('path', 1024);
            $table->smallInteger('country_id');
            $table->unsignedInteger('standart_contract_template_type_id');
        });

        Schema::table('standart_contract_template', function (Blueprint $table) {
            $table->foreign('country_id','standart_contract_template_country_fk')->references('id')->on('country');
            $table->foreign('standart_contract_template_type_id','standart_contract_template_standart_contract_template_type_fk')->references('id')->on('standart_contract_template_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('standart_contract_template');
    }
}
