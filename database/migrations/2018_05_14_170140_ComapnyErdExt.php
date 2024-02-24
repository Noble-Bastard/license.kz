<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ComapnyErdExt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            create or replace view company_profile_ext
                as
                  select
                    cp.id,
                    cp.bin,
                    cp.web_site,
                    cp.email,
                    cp.skype,
                    cp.mobile_phone,
                    cp.name,
                    cp.description,
                    cp.post_code,
                    cp.director_id,
                    prf.full_name director_name
                  from
                    company_profile cp
                    join profile prf
                      on cp.director_id=prf.id

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
