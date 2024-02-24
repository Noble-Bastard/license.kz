<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InvoiceCounterInit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aps_setting', function (Blueprint $table) {
            $table->smallInteger('invoice_counter_type_id')->unsigned()->nullable();
        });


        Schema::table('aps_setting', function(Blueprint $table)
        {
            $table->foreign('invoice_counter_type_id', 'aps_setting_invoice_counter_type_fk')->references('id')->on('counter_type');
        });

        Schema::table('aps_setting', function(Blueprint $table)
        {
            $table->foreign('areement_counter_type_id', 'aps_setting_areement_counter_type_fk')->references('id')->on('counter_type');
        });

        Schema::table('aps_setting', function(Blueprint $table)
        {
            $table->foreign('payment_counter_type_id', 'aps_setting_payment_counter_type_fk')->references('id')->on('counter_type');
        });

        $counterType = new \App\Data\Core\Model\CounterType();
        $counterType->code = 'INVOICE_COUNTER';
        $counterType->name = 'Счет фактура';
        $counterType->save();

        DB::statement("
            update aps_setting
            set
              invoice_counter_type_id = :invoice_counter_type_id",
            array('invoice_counter_type_id' => $counterType->id)
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
                'IP' as mask,
                9 length,
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
