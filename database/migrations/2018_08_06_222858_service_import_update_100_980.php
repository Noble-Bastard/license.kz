<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceImportUpdate100980 extends Migration
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

            Schema::table('service_category', function ($table) {
                $table->longText('img')->nullable()->change();
                $table->integer('order_no')->nullable()->change();
            });

            DB::statement('
                insert into service_category(id, name, description)
                values
                  (16, \'БИН и ЭЦП на головную компанию\', \'БИН и ЭЦП на головную компанию\');
            ');

            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (22, 16, \'Регистрация бизнеса - Иные услуги в области корпоративного права\', \'Регистрация бизнеса - Иные услуги в области корпоративного права\');
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 22
                where code = \'100\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 22
                where code = \'110\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 22
                where code = \'120\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 22
                where code = \'130\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 22
                where code = \'140\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 22
                where code = \'150\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 22
                where code = \'160\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 22
                where code = \'170\'
            ');

            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (23, 16, \'Регистрация бизнеса -  Регистрация ТОО (учредитель физ.лицо и/или юр.лицо РК)\', \'Регистрация бизнеса -  Регистрация ТОО (учредитель физ.лицо и/или юр.лицо РК)\');
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 23
                where code = \'180\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 23
                where code = \'190\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 23
                where code = \'200\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 23
                where code = \'210\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 23
                where code = \'220\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 23
                where code = \'230\'
            ');

            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (24, 16, \'Регистрация бизнеса - Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)\', \'Регистрация бизнеса - Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)\');
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 24
                where code = \'240\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 24
                where code = \'250\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 24
                where code = \'260\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 24
                where code = \'270\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 24
                where code = \'280\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 24
                where code = \'290\'
            ');

            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (25, 16, \'Регистрация бизнеса - Регистрация ТОО (учредитель физ.лицо и/или юр.лицо нерезидент)\', \'Регистрация бизнеса - Регистрация ТОО (учредитель физ.лицо и/или юр.лицо нерезидент)\');
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 25
                where code = \'300\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 25
                where code = \'310\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 25
                where code = \'320\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 25
                where code = \'330\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 25
                where code = \'340\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 25
                where code = \'350\'
            ');

            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (26, 16, \'Регистрация филиала/представительства -  Регистрация филиала/представительства (учредитель юр.лицо РК)\', \'Регистрация филиала/представительства -  Регистрация филиала/представительства (учредитель юр.лицо РК)\');
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 26
                where code = \'360\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 26
                where code = \'370\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 26
                where code = \'380\'
            ');

            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (27, 16, \'Регистрация филиала/представительства - Регистрация филиала/представительства (учредитель юр.лицо ЕВРАЗЭС)\', \'Регистрация филиала/представительства - Регистрация филиала/представительства (учредитель юр.лицо ЕВРАЗЭС)\');
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 27
                where code = \'390\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 27
                where code = \'400\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 27
                where code = \'410\'
            ');

            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (28, 16, \'Регистрация филиала/представительства - Регистрация филиала/представительства\', \'Регистрация филиала/представительства - Регистрация филиала/представительства\');
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 28
                where code = \'420\'
            ');

            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (29, 16, \'Регистрация филиала/представительства - Регистрация филиала/представительства (учредитель юр.лицо нерезидент)\', \'Регистрация филиала/представительства - Регистрация филиала/представительства (учредитель юр.лицо нерезидент)\');
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 29
                where code = \'420\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 29
                where code = \'430\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 29
                where code = \'440\'
            ');

            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (30, 16, \'Перерегистрация и внесение изменеий и дополнений в учредительные документы юридического лица - Смена участников ТОО\', \'Перерегистрация и внесение изменеий и дополнений в учредительные документы юридического лица - Смена участников ТОО\');
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 30
                where code = \'450\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 30
                where code = \'460\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 30
                where code = \'470\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 30
                where code = \'480\'
            ');

            DB::statement('
                insert into service_thematic_group (id, service_category_id, name, description)
                values
                  (31, 16, \'Реорганизация бизнеса - Ликвидация бизнеса\', \'Реорганизация бизнеса - Ликвидация бизнеса\');
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 31
                where code = \'490\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 15
                where code = \'520\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 15
                where code = \'530\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 15
                where code = \'540\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 15
                where code = \'550\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 15
                where code = \'560\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 15
                where code = \'570\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 15
                where code = \'580\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 15
                where code = \'590\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 15
                where code = \'600\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 15
                where code = \'610\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 16
                where code = \'620\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 17
                where code = \'630\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 17
                where code = \'640\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 17
                where code = \'650\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 17
                where code = \'660\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 17
                where code = \'670\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 17
                where code = \'680\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 17
                where code = \'690\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 18
                where code = \'700\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 18
                where code = \'710\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 18
                where code = \'720\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 18
                where code = \'730\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 18
                where code = \'740\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 18
                where code = \'750\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 18
                where code = \'760\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 18
                where code = \'770\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 18
                where code = \'780\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 19
                where code = \'790\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 19
                where code = \'800\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 19
                where code = \'810\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 19
                where code = \'820\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 19
                where code = \'830\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 19
                where code = \'840\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 20
                where code = \'850\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 20
                where code = \'860\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 20
                where code = \'870\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 20
                where code = \'880\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 20
                where code = \'890\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 20
                where code = \'900\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 20
                where code = \'910\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 21
                where code = \'920\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 21
                where code = \'930\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 21
                where code = \'940\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 21
                where code = \'950\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 21
                where code = \'960\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 21
                where code = \'970\'
            ');

            DB::statement('
                update service  
                    set service_thematic_group_id = 21
                where code = \'980\'
            ');

            DB::commit();

        } catch (\Exception $e) {
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
