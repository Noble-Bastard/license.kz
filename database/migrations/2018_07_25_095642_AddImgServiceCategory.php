<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImgServiceCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table('service_category', function(Blueprint $table)
        {
            $table->longText('img');
            $table->integer('order_no');

        });

        $img_business = file_get_contents('docs/service_category_img/business.png');
        $img_business64 = base64_encode($img_business);

        $img_home = file_get_contents('docs/service_category_img/home.png');
        $img_home64 = base64_encode($img_home);

        $img_family= file_get_contents('docs/service_category_img/family.png');
        $img_family64 = base64_encode($img_family);

        $img_employment= file_get_contents('docs/service_category_img/employment.png');
        $img_employment64 = base64_encode($img_employment);

        $img_taxesandfinances= file_get_contents('docs/service_category_img/taxesandfinances.png');
        $img_taxesandfinances64=base64_encode($img_taxesandfinances);

        $img_counting= file_get_contents('docs/service_category_img/counting.png');
        $img_counting64=base64_encode($img_counting);

        $img_citizenship= file_get_contents('docs/service_category_img/citizenship.png');
        $img_citizenship64=base64_encode($img_citizenship);

        $img_representationInCourt= file_get_contents('docs/service_category_img/representationInCourt.png');
        $img_representationInCourt64=base64_encode($img_representationInCourt);

        $img_constructing= file_get_contents('docs/service_category_img/constructing.png');
        $img_constructing64=base64_encode($img_constructing);

        DB::statement("update service_category set order_no=5,img='$img_business64'
                             where id=1
        ");
        DB::statement("update service_category set order_no=2,img='$img_home64'
                             where id=2
        ");
        DB::statement("update service_category set order_no=1,img='$img_family64'
                             where id=3
        ");
        DB::statement("update service_category set order_no=3,img='$img_employment64'
                             where id=4
        ");
        DB::statement("update service_category set order_no=4,img='$img_taxesandfinances64'
                             where id=5
        ");
        DB::statement("
            update service_category set order_no=6,img='$img_counting64'
                             where id=6
        ");
        DB::statement("
            update service_category set order_no=7,img='$img_citizenship64'
                             where id=7
        ");
        DB::statement("
            update service_category set order_no=8,img='$img_representationInCourt64'
                             where id=8
        ");
        DB::statement("
            update service_category set order_no=9,img='$img_constructing64'
                             where id=9
        ");
        DB::statement("
            update service_category set order_no=10,img='$img_employment64'
                             where id=10
        ");
        DB::statement("
            update service_category set order_no=11,img='$img_citizenship64'
                             where id=11
        ");
        DB::statement("
            update service_category set order_no=12,img='$img_business64'
                             where id=12
        ");
        DB::statement("
            update service_category set order_no=13,img='$img_representationInCourt64'
                             where id=13
        ");
        DB::statement("
            update service_category set order_no=14,img='$img_employment64'
                             where id=14
        ");
        DB::statement("
            update service_category set order_no=15,img='$img_counting64'
                             where id=15
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
        DB::statement('alter table service_category 
                          drop COLUMN img');

        DB::statement('alter table service_category 
                          drop COLUMN order_no');
    }
}
