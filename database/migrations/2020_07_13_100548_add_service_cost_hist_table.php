<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddServiceCostHistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_cost_hist', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('service_id');
            $table->decimal('base_cost', 15, 2);
            $table->decimal('additional_cost', 15, 2);
            $table->smallInteger('currency_id');
            $table->integer('created_by')->unsigned()->nullable();;
            $table->timestamp('create_date')->default(\Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP'));


            $table->foreign('service_id', 'service_cost_hist_service_fk')->references('id')->on('service')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('created_by', 'service_cost_hist_created_by_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('currency_id', 'service_cost_hist_currency_fk')->references('id')->on('currency')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
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
