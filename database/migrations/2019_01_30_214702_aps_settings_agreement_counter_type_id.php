<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ApsSettingsAgreementCounterTypeId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aps_setting', function (Blueprint $table) {
            $table->smallInteger('areement_counter_type_id')->unsigned()->nullable();
        });

        $counterType = new \App\Data\Core\Model\CounterType();
        $counterType->code = 'AGREEMENT_COUNTER';
        $counterType->name = 'Договор';
        $counterType->save();

        DB::statement("
            update aps_setting
            set
              areement_counter_type_id = :areement_counter_type_id",
            array('areement_counter_type_id' => $counterType->id)
        );

        DB::statement("
            insert into counter(
                counter_type_id,
                mask,
                length,
                increase,
                sequence,
                country_id
            )
            select 
                :counter_type_id as counter_type_id,
                'АП/ДОГ-' as mask,
                6 length,
                1 increase,
                0 sequence,
                c.id as country_id
            from country as c",
            array('counter_type_id' => $counterType->id)
        );
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
