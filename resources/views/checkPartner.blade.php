@extends('new.layouts.app')

@section('title')
    @lang('messages.pages.about.title')
@endsection

@section('content')
    <div class="container check_partner mt-5">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <div class="check_partner-header">
                        Проверяйте <span>деловых партнеров/контрагентов</span>
                    </div>
                    <div class="check_partner-header">
                        Это поможет снизить риски
                    </div>
                </div>
                <p>Благонадежность партнера один из ключевых факторов <b>ведения бизнеса, нацеленного на минимизацию</b>
                    финансовых и временных рисков.</p>
                <p>Необходимость проверки деловых партнеров возникает при заключении деловых отношений.</p>
                <p><strong><span>ВАЖНО!</span></strong> Бизнес партнер считается благонадежным <b>в случае если он
                        отсутствует в списках</b> государственных органов.</p>
            </div>
            <div class="col-12 col-md-6">
                <div class="check_partner-subheader">Проверка контрагентов РК</div>
                <div class="check_partner-link">
                    <a href="https://kgd.gov.kz/ru/app/culs-taxarrear-search-web" target="_blank">Сведения об отсутствии
                        (наличии) задолженности, учет по которым ведется в органах государственных доходов</a>
                </div>
                <div class="check_partner-link">
                    <a href="http://kgd.gov.kz/ru/section/cpisok-platelshchikov-imeyushchih-zadolzhennost-po-tamozhennym-platezham-nalogam-i-penyam"
                       target="_blank">Список плательщиков, имеющих задолженность по таможенным платежам, налогам и
                        пеням</a>
                </div>
                <div class="check_partner-link">
                    <a href="http://kgd.gov.kz/ru/section/perechen-lzhepredpriyatiy" target="_blank">Перечень
                        налогоплательщиков, осуществивших лжепредпринимательскую деятельность</a>
                </div>
                <div class="check_partner-link">
                    <a href="http://kgd.gov.kz/ru/content/spiski-nesostoyatelnyh-dolzhnikov-1-1" target="_blank">Cписки
                        несостоятельных должников</a>
                </div>
                <div class="check_partner-link">
                    <a href="http://portal.goszakup.gov.kz/portal/index.php/ru/public_careless/reestr/grid/page/1"
                       target="_blank">Реестр недобросовестных участников государственных закупок</a>
                </div>
                <div class="check_partner-subheader mt-3">Проверка контрагентов РФ</div>
                <div class="check_partner-link">
                    <a href="https://egrul.nalog.ru/index.html" target="_blank">Сведений из ЕГРЮЛ/ЕГРИП</a>
                </div>
                <div class="check_partner-link">
                    <a href="https://pb.nalog.ru/" target="_blank">Сервис «Прозрачный бизнес» позволяет получить
                        комплексную информацию о налогоплательщике – организации.</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection