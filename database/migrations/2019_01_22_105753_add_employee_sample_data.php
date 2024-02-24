<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\DB;

class AddEmployeeSampleData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::statement("
            delete from employee_education where employee_id in (select id from employee where last_name like 'Doe%');
            delete from employee_skill where employee_id in (select id from employee where last_name like 'Doe%');
            delete from employee_social where employee_id in (select id from employee where last_name like 'Doe%');
            delete from employee_speciality where employee_id in (select id from employee where last_name like 'Doe%');
            
            
            delete from employee_work_experience where employee_id in (select id from employee where last_name like 'Doe%');
            
            delete from employee where last_name like 'Doe%';
            
            insert into employee (employee_position_id, first_name, last_name, photo_path, description, phone, address, email)
            values
                   (1, 'John', 'Doe', null, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.', '+7 (707) 123-45-67', 'Almaty, Nazarbaeva av 10', 'john_doe@ipravo@kz'),
                   (2, 'John1', 'Doe1', null, 'Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat. Praesent dapibus, neque id cursus faucibus, tortor neque egestas auguae, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.', '+7 (707) 893-45-67', 'Almaty, Nazarbaeva av 10', 'john1_doe1@ipravo@kz'),
                   (2, 'John2', 'Doe2', null, 'Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat. Praesent dapibus, neque id cursus faucibus, tortor neque egestas auguae, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.', '+7 (707) 893-45-67', 'Almaty, Nazarbaeva av 10', 'john2_doe2@ipravo@kz'),
                   (3, 'John3', 'Doe3', null, 'Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat. Praesent dapibus, neque id cursus faucibus, tortor neque egestas auguae, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.', '+7 (707) 893-45-67', 'Almaty, Nazarbaeva av 10', 'john3_doe3@ipravo@kz');
            
            set @empl_id = 0;
            
            select id into @empl_id from employee where last_name like 'Doe';
            INSERT INTO employee_education (employee_id, education_place, start_date, end_date)
            VALUES
                  (@empl_id, 'Phasellus ultrices nulla quis nibh. Quisque a lectus', '2002-01-01', '2007-01-01'),
                  (@empl_id, 'Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh', '2007-01-01', '2009-01-01');
            INSERT INTO employee_skill (employee_id, value)
            VALUES
                   (@empl_id, 'pretium'),
                   (@empl_id, 'sollicitudin'),
                   (@empl_id, 'libero');
            INSERT INTO employee_social (employee_id, social_type_id, value)
            VALUES
                   (@empl_id, 1, 'Pellentesque@fb'),
                   (@empl_id, 6, 'diam'),
                   (@empl_id, 7, 'parturient'),
                   (@empl_id, 8, 'natoque');
            INSERT INTO employee_speciality (employee_id, name, value)
            VALUES
                   (@empl_id, 'Обучаемость', 8),
                   (@empl_id, 'Работа в команде', 7),
                   (@empl_id, 'Инициативность', 9);
            INSERT INTO employee_work_experience (employee_id, work_place, description, start_date)
            VALUES
                   (@empl_id, 'Sed semper lorem at felis', 'Morbi interdum mollis sapien. Sed ac risus. Phasellus lacinia, magna a ullamcorper laoreet, lectus arcu pulvinar risus, vitae facilisis libero dolor a purus. Sed vel lacus.', '2016-01-01'),
                   (@empl_id, 'Fusce accumsan mollis', 'Sed semper lorem at felis. Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien ornare nisl.', '2017-01-01'),
                   (@empl_id, 'Quisque fermentum', 'Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis.', '2014-01-01');
            
            select id into @empl_id from employee where last_name like 'Doe1';
            INSERT INTO employee_education (employee_id, education_place, start_date, end_date)
            VALUES
                   (@empl_id, 'Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue', '2005-01-01', '2007-01-01'),
                   (@empl_id, 'Praesent elementum hendrerit tortor. Sed semper lorem at felis', '2007-01-01', '2008-01-01');
            INSERT INTO employee_skill (employee_id, value)
            VALUES
                   (@empl_id, 'felis'),
                   (@empl_id, 'elementum'),
                   (@empl_id, 'vitae'),
                   (@empl_id, 'felis'),
                   (@empl_id, 'pede');
            INSERT INTO employee_social (employee_id, social_type_id, value)
            VALUES
                   (@empl_id, 1, 'Pellentesque@fb'),
                   (@empl_id, 3, 'montes'),
                   (@empl_id, 4, 'ridiculus'),
                   (@empl_id, 5, 'vehicula'),
                   (@empl_id, 6, 'diam'),
                   (@empl_id, 8, 'natoque');
            INSERT INTO employee_speciality (employee_id, name, value)
            VALUES
                   (@empl_id, 'Обучаемость', 8),
                   (@empl_id, 'Работа в команде', 7),
                   (@empl_id, 'Инициативность', 9);
            INSERT INTO employee_work_experience (employee_id, work_place, description, start_date)
            VALUES
                   (@empl_id, 'Sed semper lorem at felis', 'Morbi interdum mollis sapien. Sed ac risus. Phasellus lacinia, magna a ullamcorper laoreet, lectus arcu pulvinar risus, vitae facilisis libero dolor a purus. Sed vel lacus.', '2016-01-01'),
                   (@empl_id, 'Fusce accumsan mollis', 'Sed semper lorem at felis. Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien ornare nisl.', '2017-01-01'),
                   (@empl_id, 'Quisque fermentum', 'Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis.', '2014-01-01');
            
            select id into @empl_id from employee where last_name like 'Doe2';
            INSERT INTO employee_education (employee_id, education_place, start_date, end_date)
            VALUES
                   (@empl_id, 'Pellentesque a diam sit amet mi ullamcorper vehicula', '2002-01-01', '2007-01-01'),
                   (@empl_id, 'Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh', '2007-01-01', '2009-01-01');
            INSERT INTO employee_skill (employee_id, value)
            VALUES
                   (@empl_id, 'vehicula'),
                   (@empl_id, 'ullamcorper'),
                   (@empl_id, 'elementum'),
                   (@empl_id, 'pede');
            INSERT INTO employee_social (employee_id, social_type_id, value)
            VALUES
                   (@empl_id, 7, 'parturient'),
                   (@empl_id, 8, 'natoque');
            INSERT INTO employee_speciality (employee_id, name, value)
            VALUES
                   (@empl_id, 'Обучаемость', 8),
                   (@empl_id, 'Работа в команде', 7),
                   (@empl_id, 'Инициативность', 9);
            INSERT INTO employee_work_experience (employee_id, work_place, description, start_date)
            VALUES
                   (@empl_id, 'Sed semper lorem at felis', 'Morbi interdum mollis sapien. Sed ac risus. Phasellus lacinia, magna a ullamcorper laoreet, lectus arcu pulvinar risus, vitae facilisis libero dolor a purus. Sed vel lacus.', '2016-01-01'),
                   (@empl_id, 'Fusce accumsan mollis', 'Sed semper lorem at felis. Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien ornare nisl.', '2017-01-01'),
                   (@empl_id, 'Quisque fermentum', 'Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis.', '2014-01-01');
            
            
            select id into @empl_id from employee where last_name like 'Doe3';
            INSERT INTO employee_education (employee_id, education_place, start_date, end_date)
            VALUES
                   (@empl_id, 'Pellentesque a diam sit amet mi ullamcorper vehicula', '2002-01-01', '2007-01-01'),
                   (@empl_id, 'Cum sociis natoque penatibus et magnis xdis parturient montes, nascetur ridiculus mus', '2007-01-01', '2009-01-01');
            INSERT INTO employee_skill (employee_id, value)
            VALUES
                   (@empl_id, 'ullamcorper'),
                   (@empl_id, 'vehicula');
            INSERT INTO employee_social (employee_id, social_type_id, value)
            VALUES
                   (@empl_id, 1, 'Pellentesque@fb'),
                   (@empl_id, 2, 'parturient'),
                   (@empl_id, 3, 'montes'),
                   (@empl_id, 7, 'parturient'),
                   (@empl_id, 8, 'natoque');
            INSERT INTO employee_speciality (employee_id, name, value)
            VALUES
                   (@empl_id, 'Обучаемость', 8),
                   (@empl_id, 'Работа в команде', 7),
                   (@empl_id, 'Инициативность', 9);
            
            INSERT INTO employee_work_experience (employee_id, work_place, description, start_date)
            VALUES
                    (@empl_id, 'Sed semper lorem at felis', 'Morbi interdum mollis sapien. Sed ac risus. Phasellus lacinia, magna a ullamcorper laoreet, lectus arcu pulvinar risus, vitae facilisis libero dolor a purus. Sed vel lacus.', '2016-01-01'),
                    (@empl_id, 'Fusce accumsan mollis', 'Sed semper lorem at felis. Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien ornare nisl.', '2017-01-01'),
                    (@empl_id, 'Quisque fermentum', 'Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis.', '2014-01-01');
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
