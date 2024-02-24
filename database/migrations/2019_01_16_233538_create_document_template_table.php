<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_template', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 256)->nullable();
            $table->string('path', 1024)->nullable();
            $table->smallInteger('country_id')->nullable();
            $table->unsignedSmallInteger('document_template_type_id')->nullable();
        });

        Schema::table('document_template', function (Blueprint $table) {
            $table->foreign('country_id','document_template_country_fk')->references('id')->on('country');
            $table->foreign('document_template_type_id','document_template_document_template_type_fk')->references('id')->on('document_template_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_template');
    }
}
