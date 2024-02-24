<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDecimal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_journal_payment', function(Blueprint $table)
        {
            $table->decimal('amount', 9, 2)->change();
        });

        Schema::table('service_step_cost_hist', function(Blueprint $table)
        {
            $table->decimal('cost', 9, 2)->change();
        });

        Schema::table('parameter_number_value', function(Blueprint $table)
        {
            $table->decimal('parameter_value', 9, 2)->change();
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
