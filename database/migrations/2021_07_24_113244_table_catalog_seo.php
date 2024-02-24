<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableCatalogSeo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catalog', function (Blueprint $table){
            $table->string('pretty_url', 512)->unique()->nullable()->index();
            $table->string('seo_title', 1024)->nullable();
            $table->string('seo_description', 1024)->nullable();
            $table->string('seo_keys', 1024)->nullable();
        });

        DB::unprepared("
          insert into translation_attribute(id, translation_entity_id, name )
          values
            (43, 13, 'seo_title'),
            (44, 13, 'seo_description'),
            (45, 13, 'seo_keys')
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
        //
    }
}
