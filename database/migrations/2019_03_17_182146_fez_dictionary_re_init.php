<?php

use App\Data\Helper\CountryList;
use App\Data\Helper\ServiceCategoryTypeList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FezDictionaryReInit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('free_economic_zone', function (Blueprint $table){
           $table->string("img_path",256)->nullable();
           $table->unsignedInteger('position_order')->nullable();
           $table->boolean('is_visible')->nullable();
        });

        DB::unprepared("
            update free_economic_zone
            set
              is_visible = 0,
              position_order = 0,
              img_path = null;
        ");

        DB::unprepared("
            insert into free_economic_zone
            (
                country_region_id,
                code,
                name,
                service_category_id,
                is_visible,
                position_order,
                img_path
            )
            select
                impData.countryRegionId,
                impData.code,
                impData.name_ru,
                null,
                visible,
                freeZoneOrder,
                imgPath
            from
            (
                select 'ADAFZ' as code, 7 as countryRegionId, 'Абу-Даби' as countryRegion, 'ADAFZ.png' as img, 'images/freeZone/ADAFZ.png' as imgPath, 'Abu Dhabi Airports Free Zone (ADAFZ)' as name, 'СЭЗ Международного Аэропорта Абу-Даби' as name_ru, 1 as freeZoneOrder, 1 as visible
                union all select 'KIZAD' as code, 7 as countryRegionId, 'Абу-Даби' as countryRegion, 'Group 6.png' as img, 'images/freeZone/Group 6.png' as imgPath, 'Khalifa Industrial Zone Abu Dhabi (KIZAD)' as name, 'СЭЗ Промышленная зона Халифа Абу-Даби' as name_ru, 2 as freeZoneOrder, 1 as visible
                union all select 'MCFZ' as code, 7 as countryRegionId, 'Абу-Даби' as countryRegion, 'Masdar city Free zone.png' as img, 'images/freeZone/Masdar city Free zone.png' as imgPath, ' Masdar City Free Zone (Abu Dhabi)' as name, 'СЭЗ Масдар-сити (Абу-Даби)' as name_ru, 3 as freeZoneOrder, 1 as visible
                union all select 'twofour54' as code, 7 as countryRegionId, 'Абу-Даби' as countryRegion, 'twofour54.png' as img, 'images/freeZone/twofour54.png' as imgPath, ' twofour54 (Abu Dhabi)' as name, 'СЭЗ Абу-Даби twofour54' as name_ru, 4 as freeZoneOrder, 1 as visible
                union all select 'JAFZA' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'jafza.png' as img, 'images/freeZone/jafza.png' as imgPath, ' Jebel Ali Free Zone (JAFZA)' as name, 'СЭЗ Джебель Али' as name_ru, 5 as freeZoneOrder, 1 as visible
                union all select 'DMCC' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'DMCC.png' as img, 'images/freeZone/DMCC.png' as imgPath, 'Dubai Multi Commodities Centre (DMCC)' as name, 'Дубайская многопрофильная товарно-сырьевая биржа (сокращенно DMCC)' as name_ru, 6 as freeZoneOrder, 1 as visible
                union all select 'DIFC' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'DIFC.png' as img, 'images/freeZone/DIFC.png' as imgPath, 'Dubai International Financial Centre (DIFC)' as name, 'СЭЗ Дубайский международный финансовый центр' as name_ru, 7 as freeZoneOrder, 1 as visible
                union all select 'DAFZA' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'DAFZA.png' as img, 'images/freeZone/DAFZA.png' as imgPath, 'Dubai International Airport (DAFZA)' as name, 'СЭЗ Международного Аэропорта Дубая' as name_ru, 8 as freeZoneOrder, 1 as visible
                union all select 'DSFZ' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'Dubai South.png' as img, 'images/freeZone/Dubai South.png' as imgPath, 'Dubai South Freezone  ' as name, 'СЭЗ Dubai South' as name_ru, 9 as freeZoneOrder, 1 as visible
                union all select 'DSO' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'dsoa.png' as img, 'images/freeZone/dsoa.png' as imgPath, ' Dubai Silicon Oasis (DSO)' as name, 'СЭЗ Дубайский Силиконовый Оазис' as name_ru, 10 as freeZoneOrder, 1 as visible
                union all select 'DIC' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'DIC.png' as img, 'images/freeZone/DIC.png' as imgPath, 'Dubai Internet City (DIC)' as name, 'СЭЗ Dubai Internet City' as name_ru, 11 as freeZoneOrder, 1 as visible
                union all select 'DKP' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'DKP.png' as img, 'images/freeZone/DKP.png' as imgPath, 'Dubai Knowledge Park (DKP)' as name, 'СЭЗ Dubai Knowledge Park' as name_ru, 12 as freeZoneOrder, 1 as visible
                union all select 'DIAC' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'DIAC.png' as img, 'images/freeZone/DIAC.png' as imgPath, 'Dubai International Academic City (DIAC)' as name, 'СЭЗ Dubai International Academic City' as name_ru, 13 as freeZoneOrder, 1 as visible
                union all select 'DPC' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'DPC.png' as img, 'images/freeZone/DPC.png' as imgPath, 'Dubai Production City (DPC)' as name, 'СЭЗ Dubai Production City' as name_ru, 14 as freeZoneOrder, 1 as visible
                union all select 'DOC' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'DOC.png' as img, 'images/freeZone/DOC.png' as imgPath, 'Dubai Outsource City (DOC)' as name, 'СЭЗ Dubai Outsource City' as name_ru, 15 as freeZoneOrder, 1 as visible
                union all select 'DSP' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'DSP.png' as img, 'images/freeZone/DSP.png' as imgPath, 'Dubai Science Park (DSP)' as name, 'СЭЗ Dubai Science Park' as name_ru, 16 as freeZoneOrder, 1 as visible
                union all select 'DMC' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'DMC.png' as img, 'images/freeZone/DMC.png' as imgPath, 'Dubai Media City (DMC)' as name, 'СЭЗ Dubai Media City' as name_ru, 17 as freeZoneOrder, 1 as visible
                union all select 'd3' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'Dubai design district.png' as img, 'images/freeZone/Dubai design district.png' as imgPath, 'Dubai Design District (d3)' as name, 'СЭЗ Dubai Design District' as name_ru, 18 as freeZoneOrder, 1 as visible
                union all select 'DSC' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'DSC.png' as img, 'images/freeZone/DSC.png' as imgPath, 'Dubai Studio City (DSC)' as name, 'СЭЗ Dubai Studio City' as name_ru, 19 as freeZoneOrder, 1 as visible
                union all select 'SAIF' as code, 2 as countryRegionId, 'Шарджа' as countryRegion, 'SAIF.png' as img, 'images/freeZone/SAIF.png' as imgPath, 'Sharjah International Airport Free Zone (SAIF)' as name, 'СЭЗ Международного Аэропорта Шарджы' as name_ru, 20 as freeZoneOrder, 1 as visible
                union all select 'HFZA' as code, 2 as countryRegionId, 'Шарджа' as countryRegion, 'HFZA.png' as img, 'images/freeZone/HFZA.png' as imgPath, 'Hamriyah Free Zone Authority (Sharjah) (HFZA)' as name, 'СЭЗ Хамрия (эмират Шарджа)' as name_ru, 21 as freeZoneOrder, 1 as visible
                union all select 'SHAMS' as code, 2 as countryRegionId, 'Шарджа' as countryRegion, 'Shams.png' as img, 'images/freeZone/Shams.png' as imgPath, 'Sharjah Media Zone (SHAMS)' as name, 'СЭЗ Медия зон Шарджы' as name_ru, 22 as freeZoneOrder, 1 as visible
                union all select 'AFZA' as code, 5 as countryRegionId, 'Аджман' as countryRegion, 'ajman.png' as img, 'images/freeZone/ajman.png' as imgPath, 'Ajman Free Zone Authority (AFZA)' as name, 'СЭЗ эмирата Аджман' as name_ru, 23 as freeZoneOrder, 1 as visible
                union all select 'UAQ' as code, 6 as countryRegionId, 'Умм-Аль-Кувейн' as countryRegion, 'UAQ.png' as img, 'images/freeZone/UAQ.png' as imgPath, 'Umm Al Quwain Free Trade Zone (UAQ)' as name, 'СЭЗ эмирата Умм-аль-Кувейн' as name_ru, 24 as freeZoneOrder, 1 as visible
                union all select 'RAKEZ' as code, 3 as countryRegionId, 'Рас-Эль-Хейма' as countryRegion, 'rakez.png' as img, 'images/freeZone/rakez.png' as imgPath, 'Ras Al Khaimah Economic Zone (RAKEZ)' as name, 'СЭЗ эмирата Рас-эль-Хейма' as name_ru, 25 as freeZoneOrder, 1 as visible
                union all select 'FFZA' as code, 4 as countryRegionId, 'Фуджейра' as countryRegion, 'FFZA.png' as img, 'images/freeZone/FFZA.png' as imgPath, 'Fujairah Free Zone Authority (FFZA)' as name, 'СЭЗ эмирата Фуджейра' as name_ru, 26 as freeZoneOrder, 1 as visible
                union all select 'CCFZ' as code, 4 as countryRegionId, 'Фуджейра' as countryRegion, 'CCFZ.png' as img, 'images/freeZone/CCFZ.png' as imgPath, 'Creative City Fujairah (CCFZ)' as name, 'СЭЗ Creative City Fujairah' as name_ru, 27 as freeZoneOrder, 1 as visible
                union all select 'IFZA' as code, 4 as countryRegionId, 'Фуджейра' as countryRegion, 'IFZA.png' as img, 'images/freeZone/IFZA.png' as imgPath, 'Fujairah International Free Zone Authority (IFZA)' as name, 'Международная СЭЗ эмирата Фуджейра' as name_ru, 28 as freeZoneOrder, 1 as visible
            ) as impData
                left join free_economic_zone fez
                on fez.code = impData.code
            where fez.id is null
        ");


        DB::unprepared("                
            update   
            (
                select 'ADAFZ' as code, 7 as countryRegionId, 'Абу-Даби' as countryRegion, 'ADAFZ.png' as img, 'images/freeZone/ADAFZ.png' as imgPath, 'Abu Dhabi Airports Free Zone (ADAFZ)' as name, 'СЭЗ Международного Аэропорта Абу-Даби' as name_ru, 1 as freeZoneOrder, 1 as visible
                union all select 'KIZAD' as code, 7 as countryRegionId, 'Абу-Даби' as countryRegion, 'Group 6.png' as img, 'images/freeZone/Group 6.png' as imgPath, 'Khalifa Industrial Zone Abu Dhabi (KIZAD)' as name, 'СЭЗ Промышленная зона Халифа Абу-Даби' as name_ru, 2 as freeZoneOrder, 1 as visible
                union all select 'MCFZ' as code, 7 as countryRegionId, 'Абу-Даби' as countryRegion, 'Masdar city Free zone.png' as img, 'images/freeZone/Masdar city Free zone.png' as imgPath, ' Masdar City Free Zone (Abu Dhabi)' as name, 'СЭЗ Масдар-сити (Абу-Даби)' as name_ru, 3 as freeZoneOrder, 1 as visible
                union all select 'twofour54' as code, 7 as countryRegionId, 'Абу-Даби' as countryRegion, 'twofour54.png' as img, 'images/freeZone/twofour54.png' as imgPath, ' twofour54 (Abu Dhabi)' as name, 'СЭЗ Абу-Даби twofour54' as name_ru, 4 as freeZoneOrder, 1 as visible
                union all select 'JAFZA' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'jafza.png' as img, 'images/freeZone/jafza.png' as imgPath, ' Jebel Ali Free Zone (JAFZA)' as name, 'СЭЗ Джебель Али' as name_ru, 5 as freeZoneOrder, 1 as visible
                union all select 'DMCC' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'DMCC.png' as img, 'images/freeZone/DMCC.png' as imgPath, 'Dubai Multi Commodities Centre (DMCC)' as name, 'Дубайская многопрофильная товарно-сырьевая биржа (сокращенно DMCC)' as name_ru, 6 as freeZoneOrder, 1 as visible
                union all select 'DIFC' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'DIFC.png' as img, 'images/freeZone/DIFC.png' as imgPath, 'Dubai International Financial Centre (DIFC)' as name, 'СЭЗ Дубайский международный финансовый центр' as name_ru, 7 as freeZoneOrder, 1 as visible
                union all select 'DAFZA' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'DAFZA.png' as img, 'images/freeZone/DAFZA.png' as imgPath, 'Dubai International Airport (DAFZA)' as name, 'СЭЗ Международного Аэропорта Дубая' as name_ru, 8 as freeZoneOrder, 1 as visible
                union all select 'DSFZ' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'Dubai South.png' as img, 'images/freeZone/Dubai South.png' as imgPath, 'Dubai South Freezone  ' as name, 'СЭЗ Dubai South' as name_ru, 9 as freeZoneOrder, 1 as visible
                union all select 'DSO' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'dsoa.png' as img, 'images/freeZone/dsoa.png' as imgPath, ' Dubai Silicon Oasis (DSO)' as name, 'СЭЗ Дубайский Силиконовый Оазис' as name_ru, 10 as freeZoneOrder, 1 as visible
                union all select 'DIC' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'DIC.png' as img, 'images/freeZone/DIC.png' as imgPath, 'Dubai Internet City (DIC)' as name, 'СЭЗ Dubai Internet City' as name_ru, 11 as freeZoneOrder, 1 as visible
                union all select 'DKP' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'DKP.png' as img, 'images/freeZone/DKP.png' as imgPath, 'Dubai Knowledge Park (DKP)' as name, 'СЭЗ Dubai Knowledge Park' as name_ru, 12 as freeZoneOrder, 1 as visible
                union all select 'DIAC' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'DIAC.png' as img, 'images/freeZone/DIAC.png' as imgPath, 'Dubai International Academic City (DIAC)' as name, 'СЭЗ Dubai International Academic City' as name_ru, 13 as freeZoneOrder, 1 as visible
                union all select 'DPC' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'DPC.png' as img, 'images/freeZone/DPC.png' as imgPath, 'Dubai Production City (DPC)' as name, 'СЭЗ Dubai Production City' as name_ru, 14 as freeZoneOrder, 1 as visible
                union all select 'DOC' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'DOC.png' as img, 'images/freeZone/DOC.png' as imgPath, 'Dubai Outsource City (DOC)' as name, 'СЭЗ Dubai Outsource City' as name_ru, 15 as freeZoneOrder, 1 as visible
                union all select 'DSP' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'DSP.png' as img, 'images/freeZone/DSP.png' as imgPath, 'Dubai Science Park (DSP)' as name, 'СЭЗ Dubai Science Park' as name_ru, 16 as freeZoneOrder, 1 as visible
                union all select 'DMC' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'DMC.png' as img, 'images/freeZone/DMC.png' as imgPath, 'Dubai Media City (DMC)' as name, 'СЭЗ Dubai Media City' as name_ru, 17 as freeZoneOrder, 1 as visible
                union all select 'd3' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'Dubai design district.png' as img, 'images/freeZone/Dubai design district.png' as imgPath, 'Dubai Design District (d3)' as name, 'СЭЗ Dubai Design District' as name_ru, 18 as freeZoneOrder, 1 as visible
                union all select 'DSC' as code, 1 as countryRegionId, 'Дубай' as countryRegion, 'DSC.png' as img, 'images/freeZone/DSC.png' as imgPath, 'Dubai Studio City (DSC)' as name, 'СЭЗ Dubai Studio City' as name_ru, 19 as freeZoneOrder, 1 as visible
                union all select 'SAIF' as code, 2 as countryRegionId, 'Шарджа' as countryRegion, 'SAIF.png' as img, 'images/freeZone/SAIF.png' as imgPath, 'Sharjah International Airport Free Zone (SAIF)' as name, 'СЭЗ Международного Аэропорта Шарджы' as name_ru, 20 as freeZoneOrder, 1 as visible
                union all select 'HFZA' as code, 2 as countryRegionId, 'Шарджа' as countryRegion, 'HFZA.png' as img, 'images/freeZone/HFZA.png' as imgPath, 'Hamriyah Free Zone Authority (Sharjah) (HFZA)' as name, 'СЭЗ Хамрия (эмират Шарджа)' as name_ru, 21 as freeZoneOrder, 1 as visible
                union all select 'SHAMS' as code, 2 as countryRegionId, 'Шарджа' as countryRegion, 'Shams.png' as img, 'images/freeZone/Shams.png' as imgPath, 'Sharjah Media Zone (SHAMS)' as name, 'СЭЗ Медия зон Шарджы' as name_ru, 22 as freeZoneOrder, 1 as visible
                union all select 'AFZA' as code, 5 as countryRegionId, 'Аджман' as countryRegion, 'ajman.png' as img, 'images/freeZone/ajman.png' as imgPath, 'Ajman Free Zone Authority (AFZA)' as name, 'СЭЗ эмирата Аджман' as name_ru, 23 as freeZoneOrder, 1 as visible
                union all select 'UAQ' as code, 6 as countryRegionId, 'Умм-Аль-Кувейн' as countryRegion, 'UAQ.png' as img, 'images/freeZone/UAQ.png' as imgPath, 'Umm Al Quwain Free Trade Zone (UAQ)' as name, 'СЭЗ эмирата Умм-аль-Кувейн' as name_ru, 24 as freeZoneOrder, 1 as visible
                union all select 'RAKEZ' as code, 3 as countryRegionId, 'Рас-Эль-Хейма' as countryRegion, 'rakez.png' as img, 'images/freeZone/rakez.png' as imgPath, 'Ras Al Khaimah Economic Zone (RAKEZ)' as name, 'СЭЗ эмирата Рас-эль-Хейма' as name_ru, 25 as freeZoneOrder, 1 as visible
                union all select 'FFZA' as code, 4 as countryRegionId, 'Фуджейра' as countryRegion, 'FFZA.png' as img, 'images/freeZone/FFZA.png' as imgPath, 'Fujairah Free Zone Authority (FFZA)' as name, 'СЭЗ эмирата Фуджейра' as name_ru, 26 as freeZoneOrder, 1 as visible
                union all select 'CCFZ' as code, 4 as countryRegionId, 'Фуджейра' as countryRegion, 'CCFZ.png' as img, 'images/freeZone/CCFZ.png' as imgPath, 'Creative City Fujairah (CCFZ)' as name, 'СЭЗ Creative City Fujairah' as name_ru, 27 as freeZoneOrder, 1 as visible
                union all select 'IFZA' as code, 4 as countryRegionId, 'Фуджейра' as countryRegion, 'IFZA.png' as img, 'images/freeZone/IFZA.png' as imgPath, 'Fujairah International Free Zone Authority (IFZA)' as name, 'Международная СЭЗ эмирата Фуджейра' as name_ru, 28 as freeZoneOrder, 1 as visible
            ) as impData
                left join free_economic_zone fez
                on fez.code = impData.code
            set
                fez.img_path = impData.imgPath,
                fez.position_order = impData.freeZoneOrder,
                fez.is_visible = 1,
                fez.name = impData.name_ru
            where fez.id is not null
        ");


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
              fez.code,
              fez.name,
              null,
              1,
              ?,
              ?,
              0
            from free_economic_zone fez
                 left join service_category as sc 
                 on sc.name = fez.code
            where sc.id is null
        ", [CountryList::UAE, ServiceCategoryTypeList::FreeEconomicZone]);

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
