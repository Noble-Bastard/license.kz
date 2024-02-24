<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\DB;

class CountryCityCompanyAddData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            INSERT INTO country (id, code, name)
            SELECT * FROM (SELECT 1, 'kz', 'Казахстан') AS tmp
            WHERE NOT EXISTS (
                SELECT name FROM country WHERE name = 'Казахстан'
            ) LIMIT 1;
            
            INSERT INTO country (id, code, name)
            SELECT * FROM (SELECT 2, 'ru', 'Россия') AS tmp
            WHERE NOT EXISTS (
                SELECT name FROM country WHERE name = 'Россия'
            ) LIMIT 1;
            
            INSERT INTO country (id, code, name)
            SELECT * FROM (SELECT 3, 'ae', 'ОАЭ') AS tmp
            WHERE NOT EXISTS (
                SELECT name FROM country WHERE name = 'ОАЭ'
            ) LIMIT 1;
            
            delete t
            from
                translation t
                left join translation_attribute ta
                    on t.translation_attribute_id = ta.id
            where ta.translation_entity_id = 5;
            
            insert into translation(translation_attribute_id, language_id, pk_value, value)
            values 
                (7, 2, 1, 'Kazakhstan'),
                (7, 2, 2, 'Russia'),
                (7, 2, 3, 'UAE');
            
            update profile set city_id = null;    
            delete from company;
            delete from city;    
                  
            INSERT INTO city (id, country_id, value)
            values 
              (1, 1, 'Астана'),
              (2, 1, 'Алматы'),
              (3, 1, 'Караганда'),
              (4, 2, 'Москва'),
              (5, 2, 'Санкт-Петербург'),
              (6, 3, 'Дубай');
             
            delete t
            from
                translation t
                left join translation_attribute ta
                    on t.translation_attribute_id = ta.id
            where ta.translation_entity_id = 3;
              
            insert into translation(translation_attribute_id, language_id, pk_value, value)
            values 
                (4, 2, 1, 'Astana'),
                (4, 2, 2, 'Almaty'),
                (4, 2, 3, 'Karaganda'),  
                (4, 2, 4, 'Moscow'),  
                (4, 2, 5, 'Saint Petersburg'),  
                (4, 2, 6, 'Dubai');  
                
            insert into company (name, address, city_id, email, skype, phone, phone_1, fax, location, beneficiary, bank, BIN, IIK, KBE, BIK, payment_code, photo_path)
            values
              ('Ipravo в Астане', 'Адрес: Ул. Бейбитшилик, 14 БЦ «MARDEN», офис 1505', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
              ('Ipravo в Алматы', 'Адрес: Пр. Достык, 91/2, 7 этаж', 2, '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
              ('Ipravo в Караганде', 'Адрес: Ул.Ержанова, 41/1 Офис 5', 3, '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
              ('Ipravo в Москве', 'Адрес: Г.Химки, ул.Бабкина, 5а, офис 303', 4, '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
              ('Ipravo в Санкт-Петербурге', 'Адрес: Радищева, 33А', 5, '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
              ('Ipravo в Дубае', 'Office #2901, X3 Jumeirah Lake Towers', 6, '', '', '', '', '', '', '', '', '', '', '', '', '', '');
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
