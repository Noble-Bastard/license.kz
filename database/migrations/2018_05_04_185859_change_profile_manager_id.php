<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeProfileManagerId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile', function(Blueprint $table)
        {
            $table->integer('manager_id')->nullable()->unsigned();

            $table->foreign('manager_id', 'profile_profile_manager_id_fk')->references('id')->on('profile')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profile', function(Blueprint $table)
        {
            $table->dropForeign('profile_profile_manager_id_fk');
        });
    }
}
