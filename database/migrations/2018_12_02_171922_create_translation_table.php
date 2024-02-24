<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translation', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('translation_attribute_id');
            $table->unsignedInteger('language_id');
            $table->unsignedInteger('pk_value');
            $table->string('value',1024)->nullable();
        });

        Schema::table('translation', function(Blueprint $table)
        {
            $table->foreign('language_id', 'translation_language_fk')->references('id')->on('language')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('translation_attribute_id', 'translation_translation_attribute_fk')->references('id')->on('translation_attribute')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translation');
    }
}
