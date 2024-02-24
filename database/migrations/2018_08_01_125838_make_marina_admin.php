<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeMarinaAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement("                    
        update user_role set role_id=1 where user_id=(select id from users where email='tortuga_88@mail.ru');                       
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::statement("                    
        update user_role set role_id=3 where user_id=(select top 1 from users where email='tortuga_88@mail.ru');                       
        ");
    }
}
