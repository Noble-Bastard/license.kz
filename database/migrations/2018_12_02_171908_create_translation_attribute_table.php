<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslationAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translation_attribute', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('translation_entity_id');
            $table->string('name',32);
        });

        Schema::table('translation_attribute', function(Blueprint $table)
        {
            $table->foreign('translation_entity_id', 'translation_attribute_translation_entity_fk')->references('id')->on('translation_entity')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        DB::unprepared("
          insert into translation_attribute(id, translation_entity_id, name )
          values (1, 1, 'name'),
          (2,1, 'description');        
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translation_attribute');
    }
}
