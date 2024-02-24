<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_node_type', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('value', 256);
        });

        Schema::create('catalog', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('catalog_parent_id')->nullable();
            $table->unsignedSmallInteger('catalog_node_type_id');
            $table->string('name', 1024);
            $table->text('description')->nullable();
            $table->string('image_path', 2048)->nullable();
        });

        Schema::table('catalog', function(Blueprint $table)
        {
            $table->foreign('catalog_parent_id', 'catalog_catalog_parent_fk')->references('id')->on('catalog');
            $table->foreign('catalog_node_type_id', 'catalog_catalog_node_type_fk')->references('id')->on('catalog_node_type');
        });

        Schema::create('service_category_catalog', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('service_category_id')->unique('service_category_catalog_uix');
            $table->unsignedInteger('catalog_id');

            $table->foreign('service_category_id', 'service_category_catalog_category_fk')->references('id')->on('service_category');
            $table->foreign('catalog_id', 'service_category_catalog_catalog_fk')->references('id')->on('catalog');
        });
        Schema::create('service_catalog', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('service_id')->unique('service_catalog_uix');
            $table->unsignedInteger('catalog_id');


            $table->foreign('service_id', 'category_catalog_service_fk')->references('id')->on('service');
            $table->foreign('catalog_id', 'category_catalog_catalog_fk')->references('id')->on('catalog');
        });

        //translate
        DB::unprepared("
          insert into translation_entity(id, name)
          values
            (13, 'catalog')
            ;
        ");

        DB::unprepared("
          insert into translation_attribute(id, translation_entity_id, name )
          values 
            (19, 13, 'name'),
            (20, 13, 'description')
          ;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_catalog');
        Schema::dropIfExists('service_catalog');
        Schema::dropIfExists('catalog');
        Schema::dropIfExists('catalog_node_type');
    }
}
