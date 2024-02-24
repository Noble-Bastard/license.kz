<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddedClientCheckBaseCostToAppSettings extends Migration
{

    public function up()
    {
        Schema::table('aps_setting', function (Blueprint $table) {
            $table->decimal('client_check_cost',9,2)->nullable();
            $table->decimal('mrp',9,2)->nullable();
            $table->smallInteger('base_currency_id')->nullable();
        });

        Schema::table('aps_setting', function(Blueprint $table)
        {
            $table->foreign('base_currency_id', 'aps_setting_currency_fk')->references('id')->on('currency');
        });

        DB::unprepared("
            update aps_setting
            set
                client_check_cost = 100,
                mrp = 2651,
                base_currency_id = 1;
        ");
    }

    public function down()
    {

        Schema::table('aps_setting', function (Blueprint $table) {
            $table->dropForeign('aps_setting_currency_fk');
        });

        Schema::table('aps_setting', function (Blueprint $table) {
            $table->dropColumn('client_check_cost');
            $table->dropColumn('mrp');
            $table->dropColumn('base_currency_id');
        });

    }
}
