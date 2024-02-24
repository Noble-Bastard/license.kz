<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBossToHead extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('                    
            update role set name=\'Head\' where id = 7;                        
        ');
        DB::statement('                    
            update users set name=\'TestHead\',email=\'Head@ipravo.kz\' where name = \'TestBoss\';                        
        ');
        DB::statement('                    
            update profile set full_name=\'TestHead\',email=\'Head@ipravo.kz\' where full_name = \'TestBoss\';                        
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
