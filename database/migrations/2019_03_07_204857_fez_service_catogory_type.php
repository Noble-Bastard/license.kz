<?php

use App\Data\Helper\CountryList;
use App\Data\Helper\ServiceCategoryTypeList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FezServiceCatogoryType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            insert into service_category_type(id, name)
            values (3, 'СЭЗ');
        ");


        DB::statement("
            delete from service_category
            where service_category_type_id = ?
        ", [ServiceCategoryTypeList::FreeEconomicZone]);

        DB::statement("
            insert into service_category
            (
                name,
                description,
                img,
                order_no,
                country_id,
                service_category_type_id,
                is_standart_contract_template_show
            )
            select
              code,
              name,
              null,
              1,
              ?,
              ?,
              0
            from free_economic_zone
        ", [CountryList::UAE, ServiceCategoryTypeList::FreeEconomicZone]);


        Schema::table("free_economic_zone", function (Blueprint $table){
           $table->unsignedSmallInteger("service_category_id")->nullable();
        });

        Schema::table('free_economic_zone', function (Blueprint $table) {
            $table->foreign('service_category_id','free_economic_zone_service_category_fk')->references('id')->on('service_category');
        });

        DB::statement("
            
            update free_economic_zone as fez
              inner join service_category as sc 
              on sc.name = fez.code
            set
              service_category_id = sc.id              
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
