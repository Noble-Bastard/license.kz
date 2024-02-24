<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreeEconomicZoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('free_economic_zone', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('country_region_id');
            $table->string('code',32);
            $table->string('name',256);
        });

        Schema::table('free_economic_zone', function (Blueprint $table) {
            $table->foreign('country_region_id','free_economic_zone_country_region_fk')->references('id')->on('country_region');
        });

        DB::statement("
            insert into free_economic_zone(id, country_region_id, code, name)
            values(1, 1, 'JAFZA', 'Jebel Ali Free Zone'),
            (2, 1, 'DSFZ', 'Dubai South Free Zone'),
            (3, 1, 'DAFZA', 'Dubai Airport Free Zone'),
            (4, 1, 'DIC', 'Dubai Internet City'),
            (5, 1, 'DMCC', 'Dubai Multi Commodities Centre'),
            (6, 1, 'DIFC', 'Dubai International Financial Centre'),
            (7, 1, 'DMC', 'Dubai Media City'),
            (8, 1, 'DKV', 'Dubai Knowledge Village'),
            (9, 1, 'DHCC', 'Dubai Health Care City'),
            (10, 1, 'DSO', 'Dubai Silicon Oasis'),
            (11, 2, 'SAIF', 'Sharjah Airport Free Zone'),
            (12, 2, 'HAFZA', 'Hamriyah Free Zone'),
            (13, 3, 'RAK FTZ', 'RAK Free Trade Zone'),
            (14, 3, 'RAKIA', 'RAK Investment Authority'),
            (15, 4, 'FCC', 'Fujeirah Creative City'),
            (16, 4, 'FFZ', 'Fujairah Free Zone'),
            (17, 5, 'AFZA', 'Ajman Free Zone'),
            (18, 6, 'UAQ FTZ', 'Umm Al Quwain Free Trade Zone'),
            (19, 7, 'MCFZ', 'Masdar City Free Zone')
        ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('free_economic_zone');
    }
}
