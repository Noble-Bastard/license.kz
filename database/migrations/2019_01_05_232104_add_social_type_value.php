<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialTypeValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("                    
            insert into social_type (id, value) 
            values
            (1, 'Facebook'),
            (2, 'YouTube'),
            (3, 'Instagram'),
            (4, 'Qzone'),
            (5, 'Weibo'),
            (6, 'Twitter'),
            (7, 'Reddit'),
            (8, 'Pinterest'),
            (9, 'Ask.fm'),
            (10, 'Tumblr'),
            (11, 'Flickr'),
            (12, 'Google+'),
            (13, 'LinkedIn'),
            (14, 'VK'),
            (15, 'Odnoklassniki'),
            (16, 'Meetup'),
            (17, 'Best of Behance')              
            ;                        
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
    }
}
