<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_category', function(Blueprint $table)
        {
            $table->smallInteger('id', true)->unsigned();
            $table->string('name', 256);
            $table->string('description', 1024);
        });

        DB::statement('                    
            insert into service_category (id, name, description) 
            values
              (1, \'Юридические услуги\', \'Юридические услуги\'),
              (2, \'Бухгалтерские услуги\', \'Бухгалтерские услуги\'),
              (3, \'Аутсорсинг\', \'Аутсорсинг\');                       
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('service_category');
    }
}
