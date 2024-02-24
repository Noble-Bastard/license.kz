<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ApsSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        try {

            DB::beginTransaction();

            Schema::create('aps_day_type', function(Blueprint $table)
            {
                $table->smallInteger('id', true)->unsigned();
                $table->string('name', 256);
            });

            DB::statement('
                insert into aps_day_type(id, name)
                values
                  (1, \'Work\'),
                  (2, \'Holiday\');
            ');

            Schema::create('aps_working_day', function(Blueprint $table)
            {
                $table->Integer('id', true)->unsigned();
                $table->smallInteger('aps_day_type_id')->unsigned();
                $table->date('start_date');
                $table->date('end_date');
                $table->string('decsription');
            });

            Schema::table('aps_working_day', function ($table) {
                $table->foreign('aps_day_type_id','aps_working_day_aps_day_type_fk')->references('id')->on('aps_day_type');
            });

            DB::statement('
                insert into aps_working_day(aps_day_type_id, start_date, end_date, decsription)
                values
                  (2, \'2018-08-21\',\'2018-08-21\',\'Курбан-айт\'),
                  (1, \'2018-08-25\',\'2018-08-25\',\'День Конституции РК (перенос)\'),
                  (2, \'2018-08-30\',\'2018-08-31\',\'День Конституции РК\');
            ');

            Schema::create('aps_week_working_day', function(Blueprint $table)
            {
                $table->smallInteger('id', true)->unsigned();
                $table->boolean('sun');
                $table->boolean('mon');
                $table->boolean('tue');
                $table->boolean('wed');
                $table->boolean('thu');
                $table->boolean('fri');
                $table->boolean('sat');
            });

            DB::statement('
                insert into aps_week_working_day(id, sun, mon, tue, wed, thu, fri, sat)
                values
                  (1, 0,1,1,1,1,1,0);
            ');

            Schema::create('aps_setting', function(Blueprint $table)
            {
                $table->smallInteger('id', true)->unsigned();
                $table->smallInteger('aps_week_working_day_id')->unsigned();
            });

            Schema::table('aps_setting', function ($table) {
                $table->foreign('aps_week_working_day_id','aps_setting_aps_week_working_day_fk')->references('id')->on('aps_week_working_day');
            });

            DB::statement('ALTER TABLE aps_setting ADD CONSTRAINT chk_aps_setting CHECK (id = 1);');

            DB::statement('
                insert into aps_setting(id, aps_week_working_day_id)
                values
                  (1, 1);
            ');

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
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
