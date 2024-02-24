<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ComapnyErd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_profile', function(Blueprint $table)
        {
            $table->smallInteger('id', true)->unsigned()->unique();
            $table->string('bin', 16);
            $table->string('web_site', 32);
            $table->string('email', 64);
            $table->string('skype', 64);
            $table->string('mobile_phone', 16);
            $table->string('name', 128);
            $table->string('description', 1024);
            $table->Integer('director_id')->unsigned();
            $table->string('post_code', 16);
        });

        Schema::create('company_profile_address', function(Blueprint $table)
        {
            $table->smallInteger('id', true)->unsigned();
            $table->smallInteger('company_profile_id')->unsigned();
            $table->string('address', 1024);

        });

        Schema::table('company_profile_address', function ($table) {
            $table->foreign('company_profile_id','company_profile_address_company_profile_fk')->references('id')->on('company_profile');
        });

        Schema::table('company_profile', function ($table) {
            $table->foreign('director_id','company_profile_profile_fk')->references('id')->on('profile');
        });



        DB::statement('                    
            insert into company_profile  (id, bin, web_site, email, skype, mobile_phone, name, description, director_id, post_code)
            values
              (1,\'130740008482\', \'www.mypravo.kz\', \'info@ipravo.kz\', \'ipravo.kz\', \'8 705 135 0000\', \'ТОВАРИЩЕСТВО С ОГРАНИЧЕННОЙ ОТВЕТСТВЕННОСТЬЮ «IPRAVO»\', \'Юридическая компания «Ipravo» успешно работает на рынке юридических услуг с 2009 года. На сегодняшний день наши офисы расположены в пяти городах, это Алматы, Астана, Караганда, Москва и Санкт-Петербург.\',1, \'050051\');                                                   
        ');

        DB::statement('                    
            insert into company_profile_address  (id, company_profile_id, address )
            values
              (1,1, \'РК, г. Алматы, пр. Достык, 91/2 , 7 эт.\'),
              (2,1, \'РК, г. Астана, ул. Бейбитшилик д.14 оф.1505\'),
              (3,1, \'РК, г. Караганда, ул. Ержанова, 41/1, оф. 5\'),
              (4,1, \'РФ, МО, г. Химки, ул. Бабакина, 5а \'),              
              (5,1, \'РФ, г. Санкт-Петербург, ул. Радищева, 33а\');                                                                       
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
