<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStandartContractTemplateTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standart_contract_template_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 256);
        });

        DB::unprepared("
            insert into standart_contract_template_type(name)
            values
              ('Купля-продажа'),
              ('Аренда'),
              ('Услуги'),
              ('Подряд'),
              ('Поставка'),
              ('Заем'),
              ('Безвозмездное пользование'),
              ('Согласование/изменение/расторжение договора'),
              ('Транспортные услуги'),
              ('Лизинг'),
              ('Доверительное управление'),
              ('Публичная оферта'),
              ('Хранение'),
              ('Перевод долга'),
              ('Комиссия'),
              ('Интеллектульная собственность');
        ");

        DB::unprepared("
          insert into translation_entity(id, name)
          values
            (14, 'standart_contract_template_type');
        ");

        DB::unprepared("
          insert into translation_attribute(id, translation_entity_id, name )
          values 
            (21, 14, 'name');
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('standart_contract_template_type');
    }
}
