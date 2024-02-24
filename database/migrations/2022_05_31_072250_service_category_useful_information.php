<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceCategoryUsefulInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_category_useful_information', function (Blueprint $table) {
           $table->increments('id');
           $table->unsignedSmallInteger('service_category_id');
           $table->smallInteger('order_no');
           $table->string('name', 2048);
           $table->string('short_description', 2048);
           $table->text('description')->nullable();
           $table->string('btn_name', 2048)->nullable();
           $table->string('file_path', 2048)->nullable();

            $table->foreign('service_category_id', 'scui_service_category_fk')
                ->references('id')->on('service_category')
                ->onUpdate('NO ACTION')->onDelete('NO ACTION');

            $table->softDeletes();
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