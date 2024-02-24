<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BillTemplateExt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement('
            create or replace view bill_template_ext
            as
              select
                t.id,
                t.country_id,
                t.name,
                t.content,
                c.name country_name
              from
                bill_template t
                left join country c
                  on t.country_id = c.id
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
