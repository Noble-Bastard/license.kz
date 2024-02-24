<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitPassportClient extends Migration
{

    public function up() : void
    {
        Artisan::call('passport:install');
        Artisan::call('passport:client --personal --name "UpperMedia Access Client "');
    }


    public function down() : void
    {
        //
    }
}
