<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompanyProfileAddressChangeToCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('profile', function (Blueprint $table){
            $table->dropForeign('profile_company_profile_address_fk');

        });

        Schema::rename('company_profile_address', 'company');

        Schema::table('profile', function (Blueprint $table) {
            $table->renameColumn('company_profile_address_id', 'company_id');
        });

        Schema::table('profile', function (Blueprint $table){
            $table->foreign('company_id','profile_company_fk')->references('id')->on('company');
        });

        DB::statement("
          UPDATE translation_entity SET name = 'company' WHERE id = 4;
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
