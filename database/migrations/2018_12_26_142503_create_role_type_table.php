<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',32);
        });

        Schema::table('role', function (Blueprint $table) {
            $table->unsignedInteger('role_type_id')->nullable();
        });

        Schema::table('role', function ($table) {
            $table->foreign('role_type_id','role_role_type_fk')->references('id')->on('role');
        });

        DB::unprepared("
            insert into role_type
            values(1,'Сотрудники'),
            (2, 'Внешние пользователи') 
        ");

        DB::unprepared("
            update role
            set
                role_type_id = case   
                  when id in (8,1,6,2,7,4,5) then 1
                  else 2
                end
        ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_type');
    }
}
