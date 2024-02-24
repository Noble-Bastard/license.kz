<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveServiceCatalogUix extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
//            alter table service_catalog drop foreign key category_catalog_service_fk;
//    
//            drop index service_catalog_uix on service_catalog;
//            
//            alter table service_catalog
//                add constraint category_catalog_service_fk
//                    foreign key (service_id) references service (id);
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
