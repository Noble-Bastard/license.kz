<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('profile_state_type', function(Blueprint $table)
        {
            $table->smallInteger('id', true)->unsigned();
            $table->string('name', 32);
        });

        DB::statement('                    
            insert into profile_state_type (id, name) 
            values
              (1, \'Юридическое лицо\'),
              (2, \'Физическое лицо\');                       
        ');

        Schema::create('profile', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('user_id')->unsigned()->unique('profile_uix');
            $table->smallInteger('profile_state_type_id')->unsigned();
            $table->string('phone', 32);
            $table->string('email', 256);
            $table->dateTime('last_login_date')->nullable();
            $table->timestamp('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('created_by')->unsigned();
            $table->boolean('is_resident');
            $table->string('full_name', 256)->nullable();

        });

        Schema::table('profile', function(Blueprint $table)
        {
            $table->foreign('user_id', 'profile_users_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('profile_state_type_id', 'profile_profile_state_type_fk')->references('id')->on('profile_state_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('created_by', 'profile_users_created_by_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::create('profile_legal', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('profile_id')->unsigned()->unique('profile_legal_uix');
            $table->string('company_name', 128)->nullable();
            $table->string('business_identification_number', 16)->nullable();
            $table->string('contact_person', 128)->nullable();
            $table->string('position', 256)->nullable();
            $table->string('scope_activity', 1024)->nullable();

        });

        Schema::table('profile_legal', function(Blueprint $table)
        {
            $table->foreign('profile_id', 'profile_legal_profile_fk')->references('id')->on('profile')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        DB::statement('DROP VIEW profile_ext RESTRICT;');
        Schema::drop('profile_legal');
        Schema::drop('profile');
        Schema::drop('profile_state_type');

    }
}
