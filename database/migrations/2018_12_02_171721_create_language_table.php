<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('language', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code',4);
            $table->string('name',16);
        });

        DB::unprepared("
            insert into language(id, code, name)
            values (1, 'ru','Русский'),
            (2, 'en', 'Английский');
        ");

        Schema::table('aps_setting',function (Blueprint $table){
            $table->unsignedInteger('default_language_id')->nullable();
        });

        Schema::table('aps_setting', function(Blueprint $table)
        {
            $table->foreign('default_language_id', 'aps_setting_language_fk')->references('id')->on('language')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        DB::statement("update aps_setting set default_language_id = 1;");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('language');
    }
}
