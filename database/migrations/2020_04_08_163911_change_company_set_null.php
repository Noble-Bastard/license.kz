<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCompanySetNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company', function (Blueprint $table){
            $table->string('beneficiary', 1024)->nullable()->change();
            $table->string('bank', 512)->nullable()->change();
            $table->string('BIN', 30)->nullable()->change();
            $table->string('IIK', 30)->nullable()->change();
            $table->string('KBE', 10)->nullable()->change();
            $table->string('BIK', 30)->nullable()->change();
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
