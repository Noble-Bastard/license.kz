<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceCategoryImgHeadCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $img_business = file_get_contents('docs/service_category_img/business.png');
        $img_business64 = base64_encode($img_business);

        DB::statement("update service_category set order_no=16,img='$img_business64'
                             where id=16
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
