<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddProfileExtLegalCompanyColumns extends Migration
{

    public function up()
    {
        DB::unprepared("
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
                pl.company_name as company_legal_name,
                pl.business_identification_number,
                pl.contact_person,
                pl.position,
                pl.scope_activity,
                p.photo_id,
                d.path photo_path,
                p.manager_id,
                pm.full_name manager_name,
                p.company_id,
                cpa_c.value company_name,
                p.city_id,
                c.value city_name,
                pl.bank_code_type_id,
                pl.bank_code,
                pl.director_name,
                pl.legal_address,
                bct.name bank_code_type_name,
                pl.company_name profile_company_name
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
                        left join bank_code_type bct
                            on bct.id = pl.bank_code_type_id
                left join document d
                    on d.id = p.photo_id
                left join profile pm
                  on pm.id = p.manager_id
                left join company cpa
                    on p.company_id = cpa.id
                    left join city cpa_c
                        on cpa.city_id = cpa_c.id
                left join city c on p.city_id = c.id

        ");
    }


    public function down()
    {
        //
    }
}
