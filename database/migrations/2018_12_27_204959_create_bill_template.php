<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillTemplate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('bill_template', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->text('content');
            $table->smallInteger('country_id')->nullable();
        });

        Schema::table('bill_template', function(Blueprint $table)
        {
            $table->foreign('country_id', 'bill_template_country_fk')->references('id')->on('country')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
        Schema::dropIfExists('bill_template');
    }
}
