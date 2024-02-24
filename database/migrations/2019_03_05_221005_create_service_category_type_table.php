<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceCategoryTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_category_type', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name',32);
        });

        DB::statement("
            insert into service_category_type(id, name)
            values (1, 'Каталог'),
            (2, 'Фильтр СЭЗ');
        ");

        Schema::table('service_category', function (Blueprint $table){
            $table->unsignedSmallInteger('service_category_type_id')->nullable();
            $table->boolean('is_standart_contract_template_show')->nullable();
        });

        DB::statement("
            update  service_category
            set
              is_standart_contract_template_show = 0,
              service_category_type_id = 1
        ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_category_type');
    }
}
