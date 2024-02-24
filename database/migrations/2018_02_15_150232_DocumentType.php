<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DocumentType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_type', function(Blueprint $table)
        {
            $table->smallInteger('id', true)->unsigned();
            $table->string('name', 32);
        });

        DB::statement('                    
            insert into document_type (id, name) 
            values
              (1, \'Не определен\'),
              (2, \'Фото профиля\');                       
        ');

        Schema::table('document', function($table)
        {
            $table->smallInteger('document_type_id')->unsigned()->default(1);
        });

        Schema::table('document', function(Blueprint $table)
        {
            $table->foreign('document_type_id', 'document_document_type_fk')->references('id')->on('document_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('profile', function(Blueprint $table)
        {
            $table->integer('photo_id')->unsigned()->nullable();
        });

        Schema::table('profile', function(Blueprint $table)
        {
            $table->foreign('photo_id', 'profile_document_fk')->references('id')->on('document')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

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
                p.photo_id,
                d.path photo_path
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
                left join document d
                on d.id = p.photo_id
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
                pl.scope_activity
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
            where u.is_active = 1;

        ');

        Schema::table('document', function($table)
        {
            $table->dropColumn('document_type_id');
        });

        Schema::table('profile', function($table)
        {
            $table->dropColumn('photo_id');
        });

        Schema::drop('document_type');
    }
}
