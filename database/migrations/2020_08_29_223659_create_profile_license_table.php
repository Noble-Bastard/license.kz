<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileLicenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_license_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('profile_id');
            $table->unsignedSmallInteger('license_type_id');

            $table->foreign('profile_id', 'profile_license_type_profile_fk')->references('id')->on('profile')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('license_type_id', 'profile_license_type_license_type_fk')->references('id')->on('license_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_license');
    }
}
