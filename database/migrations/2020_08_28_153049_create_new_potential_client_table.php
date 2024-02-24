<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewPotentialClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_potential_client', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 128)->nullable();
            $table->string('email', 128);
            $table->string('phone', 20);
            $table->string('service_id', 128);
            $table->boolean('is_account_generate')->default(false);
            $table->boolean('is_contacted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('new_potential_client');
    }
}
