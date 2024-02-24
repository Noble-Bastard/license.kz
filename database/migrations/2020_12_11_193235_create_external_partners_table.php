<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExternalPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('external_partner_category', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name');
        });

        Schema::create('external_partner', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedSmallInteger('external_partner_category_id');
            $table->string('name', 256);
            $table->string('short_info', 1024);
            $table->text('info');
            $table->string('site_url', 128);
            $table->string('logo_path');
            $table->string('offer', 128);

            $table->foreign('external_partner_category_id', 'external_partner_external_partner_category_fk')->references('id')->on('external_partner_category')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('external_partner');
        Schema::dropIfExists('external_partner_category');
    }
}
