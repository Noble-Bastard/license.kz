<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::drop('users');

        Schema::create('users', function (Blueprint $table) {
            $table->integer('id', true)->unsigned();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('is_active');
            $table->rememberToken();
            $table->timestamps();
        });


        Schema::create('role', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->string('name', 32)->unique('uix_role_name');
        });

        Schema::create('user_role', function(Blueprint $table)
        {
            $table->integer('id', true)->unsigned();
            $table->integer('user_id')->unsigned()->unique('user_role_uix');
            $table->integer('role_id')->unsigned()->nullable();
            $table->timestamp('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('created_by')->unsigned();
        });

        Schema::table('user_role', function(Blueprint $table)
        {
            $table->foreign('user_id', 'user_role_users_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('created_by', 'user_role_created_by_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('role_id', 'user_role_role_fk')->references('id')->on('role')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });


        DB::statement('                    
            insert into role (id, name) 
            values
              (1, \'Administrator\'),
              (2, \'Executor\'),
              (3, \'Customer\');                        
        ');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_role');
        Schema::drop('role');
    }
}
