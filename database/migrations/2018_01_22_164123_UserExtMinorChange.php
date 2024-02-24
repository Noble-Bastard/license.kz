<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserExtMinorChange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            create or replace view users_ext
            as
            select
                u.id,
                u.name,
                u.email,
                u.password,
                ur.role_id,
                r.name role_name,
                u.is_active
            from users u
                left join user_role ur
                on ur.user_id = u.id
                  left join role r
                  on r.id = ur.role_id;
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
