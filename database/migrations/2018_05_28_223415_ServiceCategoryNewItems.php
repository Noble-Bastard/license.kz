<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceCategoryNewItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $serviceCategory = \App\Data\Service\Model\ServiceCategory::where('id',4)->first();

        if(is_null($serviceCategory)) {
            DB::statement('                    
                insert into service_category (id, name, description) 
                values
                  (4, \'Трудоустройство\', \'Трудоустройство\'),
                  (5, \'Налоги и финансы\', \'Налоги и финансы\'),
                  (6, \'Бухгалтерия\', \'Бухгалтерия\'),
                  (7, \'Гражданство, миграция, имиграция\', \'Гражданство, миграция, имиграция\'),
                  (8, \'Представление в суде\', \'Представление в суде\'),
                  (9, \'Строительство\', \'Строительство\');                       
            ');
        }
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
