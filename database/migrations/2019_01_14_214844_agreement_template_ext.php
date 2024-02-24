<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgreementTemplateExt extends Migration
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
            create or replace view agreement_template_ext
            as
              select
                t.id,
                t.country_id,
                t.name,
                t.content,
                c.name country_name
              from
                agreement_template t
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
