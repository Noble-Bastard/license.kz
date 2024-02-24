<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgreementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreement', function (Blueprint $table) {
            $table->increments('id');
            $table->string('agreement_no',32);
            $table->date('agreement_date');
            $table->dateTime('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
        });


        Schema::table('invoice', function(Blueprint $table)
        {
            $table->foreign('agreement_id', 'invoice_agreement_fk')->references('id')->on('agreement');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agreement');
    }
}
