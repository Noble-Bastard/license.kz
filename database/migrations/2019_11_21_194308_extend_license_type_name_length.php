<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExtendLicenseTypeNameLength extends Migration
{

    public function up()
    {
        Schema::table('license_type', function (Blueprint $table){
            $table->string('name', 2048)->change();
        });
    }


    public function down()
    {
        //
    }
}
