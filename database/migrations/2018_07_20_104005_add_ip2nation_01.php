<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use  Illuminate\Support\Facades\DB;

class AddIp2nation01 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

            DB::beginTransaction();

            $sql = file_get_contents('database/sql/custom/ip2nation/ip2nation.sql');
            foreach(explode(';', $sql) as $sqlLine){
                if($sqlLine !== '') {
                    DB::statement($sqlLine);
                }
            }

            DB::commit();

        } catch  (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
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
