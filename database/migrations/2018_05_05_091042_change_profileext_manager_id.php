<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeProfileextManagerId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            create or replace view profile_ext
            as
            select
                p.id,
                p.full_name,
                p.user_id,
                u.name user_name,
                ur.role_id,
                r.name role_name,
                u.is_active,
                p.phone,
                p.email,
                p.last_login_date,
                p.create_date,
                p.created_by,
                p.is_resident,
                p.profile_state_type_id,
                pst.name profile_state_type_name,
                pl.id profile_legal_id,
                pl.company_name,
                pl.business_identification_number,
                pl.contact_person,
                pl.position,
                pl.scope_activity,
                p.manager_id,
                pm.full_name manager_name
            from profile p
                left join users u
                    on u.id = p.user_id
                left join user_role ur
                    on ur.user_id = u.id
                left join role r
                    on r.id = ur.role_id
                left join profile_state_type pst
                    on pst.id = p.profile_state_type_id
                left join profile_legal pl
                    on pl.profile_id = p.id
                left join profile pm
                    on pm.id = p.manager_id
            where u.is_active = 1;

        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW profile_ext RESTRICT;');
    }
}
