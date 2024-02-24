<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSerciceCategoryAndServiceGroup1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            update service_thematic_group set name = \'Аутсорсинг\', description =\'Аутсорсинг\' where id = 1;
            ');
        DB::statement('
            update service_thematic_group set name = \'Юридические услуги\', description =\'Юридические услуги\' where id = 3;
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
