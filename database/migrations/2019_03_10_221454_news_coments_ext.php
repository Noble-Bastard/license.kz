<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewsComentsExt extends Migration
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
            create or replace view news_comments_ext
            as
              select 
                nc.id,
                nc.news_id,
                nc.parent_comment_id,
                nc.comment,
                nc.create_date,
                nc.level,
                nc.user_id,
                IFNULL(u.name,'Anonim') name           
              from 
                news_comments  nc
              left join 
                users  u
              on u.id=nc.user_id          
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
        DB::statement('
            drop view news_comments_ext;
        ');
    }
}
