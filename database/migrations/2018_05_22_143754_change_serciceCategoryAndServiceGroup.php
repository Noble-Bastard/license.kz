<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSerciceCategoryAndServiceGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            update service_category set name = \'Регистрация бизнеса\', description =\'Регистрация бизнеса\' where id = 1;
            ');
        DB::statement('
            update service_category set name = \'Недвижимость\', description =\'Недвижимость\' where id = 2;
            ');
        DB::statement('
            update service_category set name = \'Семья\', description =\'Семья\' where id = 3;
            ');
        DB::statement('
            update service_thematic_group set name = \'Юридические услуги\', description =\'Юридические услуги\' where id = 1;
            ');
        DB::statement('
            update service_thematic_group set name = \'Бухгалтерские услуги\', description =\'Бухгалтерские услуги\' where id = 2;
            ');
        DB::statement('
            update service_thematic_group set name = \'Аутсорсинг\', description =\'Аутсорсинг\' where id = 3;
            ');
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
