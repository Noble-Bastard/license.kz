<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}"/>
    <meta name="og:type" content="website" />
    <meta name="twitter:card" content="photo" />
    <link rel="stylesheet" type="text/css" href="{{asset('/current/css/index.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('/current/css/styleguide.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('/current/css/globals.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('/current/css/bootstrap.css ')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<body style="margin: 0; background: #ffffff">
<input type="hidden" id="anPageName" name="page" value="index" />
<div class="container-center-horizontal">
    <div class="index screen">
        <header class="header-IO3Fu5">
            <img class="frame-7" src="{{asset('current/img/frame-7-2.svg')}}" alt="Frame 7" />
            <div class="frame-9-74EEvB">
                <div class="button-9jl6u0" onclick="toggleServicesDropdown()" style="cursor: pointer; position: relative;">
                    <img class="icons" src="{{asset('current/img/icons-12.svg')}}" alt="Icons" />
                    <div class="text_label-VdZ3eK manrope-medium-white-14px">Услуги</div>
                    <div id="servicesDropdown" class="services-dropdown" style="display: none; position: absolute; top: 100%; left: 0; background: white; border: 1px solid #ccc; border-radius: 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); z-index: 1000; min-width: 200px;">
                        <a href="{{ route('new-construction') }}" style="display: block; padding: 10px 15px; text-decoration: none; color: #333; border-bottom: 1px solid #eee;">Строительство</a>
                        <a href="{{ route('new-services') }}" style="display: block; padding: 10px 15px; text-decoration: none; color: #333;">Все услуги</a>
                    </div>
                </div>
            </div>
            <div class="frame-5-74EEvB">
                <article class="button-pdI5V2">
                    <a href="{{ route('about') }}" style="text-decoration: none; color: inherit;">
                        <div class="text_label-rCmJVt manrope-medium-eerie-black-14px">О компании</div>
                    </a>
                </article>
                <article class="button-PxPIY7">
                    <a href="{{ route('news.list') }}" style="text-decoration: none; color: inherit;">
                        <div class="text_label-WD0CeE manrope-medium-eerie-black-14px">Блог</div>
                    </a>
                </article>
                <article class="button-9FHqNF">
                    <a href="{{ route('reviews') }}" style="text-decoration: none; color: inherit;">
                        <div class="text_label-n3ZnTb manrope-medium-eerie-black-14px">Отзывы</div>
                    </a>
                </article>
                <article class="button-hn63ZD">
                    <a href="{{ route('faq') }}" style="text-decoration: none; color: inherit;">
                        <div class="text_label-dvxp0h manrope-medium-eerie-black-14px">FAQ</div>
                    </a>
                </article>
                <article class="button-1PTh0q">
                    <a href="{{ route('partners') }}" style="text-decoration: none; color: inherit;">
                        <div class="text_label-COTesI manrope-medium-eerie-black-14px">Партнёрам</div>
                    </a>
                </article>
            </div>
            <div class="frame-6-74EEvB">
                <div class="phone-pXFCLN">
                    <div href="tel: +7 (747) 135-00-00" class="x7-747-135-00-00-rP8x3z">7 (747) 135-00-00</div>
                    <div class="text_label-rP8x3z manrope-medium-eucalyptus-14px" data-bs-toggle="modal" data-bs-target="#consultModal">@lang('messages.layouts.order_call')</div>
                </div>
                <div class="button-pXFCLN" data-bs-toggle="modal" data-bs-target="#loginModal">
                    <img class="icons" src="{{asset('current/img/icons-11.svg')}}" alt="Icons" />
                    <div class="text_label-nd5l3S manrope-medium-eerie-black-14px">@lang('messages.auth.login')</div>
                </div>
            </div>
        </header>
        <div class="frame-46-IO3Fu5">
            <img class="untitled-4-1-2bIzcK untitled-4-1" src="{{asset('current/img/rectangle-95-45@2x.png')}}" alt="Untitled 4 1" />
            <div class="text_label-2bIzcK manrope-semi-bold-white-28px">Промышленность</div>
            <div class="frame-23">
                <article class="button-hL5lpu">
                    <div class="text_label-m7UfLq manrope-medium-white-14px">Строительные работы</div>
                </article>
                <article class="button-xsTVGp">
                    <div class="text_label-4mClpx manrope-medium-white-14px">Контроль СР</div>
                </article>
                <article class="button-YsiGuO">
                    <div class="text_label-8px4sm manrope-medium-white-14px">Проектная деятельность</div>
                </article>
                <article class="button-l6TBjB">
                    <div class="text_label-Oo7ykI manrope-medium-eucalyptus-14px">+2</div>
                </article>
            </div>
        </div>
        <div class="frame-47-IO3Fu5">
            <img class="untitled-4-1-zpnVjt untitled-4-1" src="{{asset('current/img/rectangle-95-45@2x.png')}}" alt="Untitled 4 1" />
            <div class="text_label-zpnVjt manrope-semi-bold-white-28px">Промышленность</div>
            <div class="frame-23">
                <article class="button-cqpNhA">
                    <div class="text_label-rCsC4X manrope-medium-white-14px">Строительные работы</div>
                </article>
                <article class="button-oKDzdP">
                    <div class="text_label-G4xehT manrope-medium-white-14px">Контроль СР</div>
                </article>
                <article class="button-UMaghT">
                    <div class="text_label-iXr2Ov manrope-medium-white-14px">Проектная деятельность</div>
                </article>
                <article class="button-zKxxBu">
                    <div class="text_label-fJSZCs manrope-medium-eucalyptus-14px">+2</div>
                </article>
            </div>
        </div>
        <div class="frame-48-IO3Fu5">
            <img class="untitled-4-1-wRpaKn untitled-4-1" src="{{asset('current/img/rectangle-95-45@2x.png')}}" alt="Untitled 4 1" />
            <div class="text_label-wRpaKn manrope-semi-bold-white-28px">Промышленность</div>
            <div class="frame-23">
                <article class="button-Pyns4o">
                    <div class="text_label-rKZRFK manrope-medium-white-14px">Строительные работы</div>
                </article>
                <article class="button-l87VDV">
                    <div class="text_label-gAHzuv manrope-medium-white-14px">Контроль СР</div>
                </article>
                <article class="button-dGLqfl">
                    <div class="text_label-Ll9DOP manrope-medium-white-14px">Проектная деятельность</div>
                </article>
                <article class="button-fA80Q1">
                    <div class="text_label-YWZqIx manrope-medium-eucalyptus-14px">+2</div>
                </article>
            </div>
        </div>
        <div class="hero-IO3Fu5">
            <p class="text_label-aKwvvX manrope-medium-eerie-black-52px">
                Мгновенный старт для вашего бизнеса в Казахстане
            </p>
            <div class="rectangle-102-aKwvvX"></div>
            <img class="frame-19-aKwvvX" src="{{asset('current/img/frame-19-2.svg')}}" alt="Frame 19" />
            <div class="x01-04-aKwvvX manrope-medium-black-haze-16px">01 / 04</div>
            <div class="rectangle-103-aKwvvX"></div>
            <div class="frame-71-aKwvvX">
                <article class="arrow-right-4BngBJ" src="{{asset('current/img/arrow-right-40.svg')}}" alt="arrow-right" />
                <article class="arrow-right-DggT6Z" src="{{asset('current/img/arrow-right-41.svg')}}" alt="arrow-right" />
            </div>
            <div class="button-aKwvvX">
                <div class="text_label-sJOooA manrope-semi-bold-eucalyptus-16px">Начать регистрацию</div>
            </div>
            <div class="txt-aKwvvX txt">
                <p class="upperlicense-aNYYHG upperlicense">
                    UPPERLICENSE: Идеальное решение для регистрации вашего бизнеса в РК
                </p>
                <p class="x-aNYYHG manrope-medium-black-haze-16px">
                    Полная автоматизация и удобство управления — откройте новые возможности для вашего бизнеса в Казахстане с
                    нашей инновационной онлайн-платформой!
                </p>
            </div>
            <img class="image-slider-1-aKwvvX" src="{{asset('current/img/image-slider-1-2.png')}}" alt="image-slider-1" />
            <img class="element-arrow-aKwvvX element-arrow" src="{{asset('current/img/element-arrow-35.svg')}}" alt="element-arrow" />
        </div>
        <div class="features-IO3Fu5">
            <div class="upperlicense-2q4aZt upperlicense manrope-medium-eerie-black-52px">
                Преимущества работы с UPPERLICENSE
            </div>
            <div class="card-2q4aZt">
                <div class="image-features-01-cDsdpw">
                    <img class="image" src="{{asset('current/img/image-18@2x.png')}}" alt="image" />
                    <img class="rectangle-95-K2DAEM rectangle-95" src="{{asset('current/img/rectangle-95-29.svg')}}" alt="Rectangle 95" />
                    <img class="rectangle-96" src="{{asset('current/img/rectangle-96-26.svg')}}" alt="Rectangle 96" />
                </div>
                <div class="frame-102">
                    <div class="x01 manrope-medium-mountain-mist-16px">01</div>
                    <div class="text_label-yxvGUd manrope-medium-eerie-black-20px">Контроль и инновации</div>
                </div>
                <p class="x-cDsdpw manrope-medium-mountain-mist-16px">
                    Уникальная онлайн-панель управления для вашего бизнеса
                </p>
            </div>
            <div class="card-uxJcdY">
                <div class="image-features-02-aleK6M">
                    <img class="image-A9r9A5 image" src="{{asset('current/img/image-19.png')}}" alt="image" />
                    <img class="rectangle-95-A9r9A5 rectangle-95" src="{{asset('current/img/rectangle-95-29.svg')}}" alt="Rectangle 95" />
                    <img class="rectangle-96" src="{{asset('current/img/rectangle-96-26.svg')}}" alt="Rectangle 96" />
                </div>
                <div class="frame-102">
                    <div class="x01 manrope-medium-mountain-mist-16px">02</div>
                    <div class="text_label-PavG2E manrope-medium-eerie-black-20px">Экспертность</div>
                </div>
                <p class="x-aleK6M manrope-medium-mountain-mist-16px">
                    Полный спектр квалифицированной поддержки для вашего бизнеса
                </p>
            </div>
            <div class="card-2WZr4g">
                <div class="image-features-03-bkiWLQ">
                    <img class="image-RDNw3q image" src="{{asset('current/img/image-20.png')}}" alt="image" />
                    <img class="rectangle-95-RDNw3q rectangle-95" src="{{asset('current/img/rectangle-95-29.svg')}}" alt="Rectangle 95" />
                    <img class="rectangle-96" src="{{asset('current/img/rectangle-96-26.svg')}}" alt="Rectangle 96" />
                </div>
                <div class="frame-102">
                    <div class="x01 manrope-medium-mountain-mist-16px">03</div>
                    <div class="text_label-W35vv9 manrope-medium-eerie-black-20px">Удобство и доступность</div>
                </div>
                <p class="x-bkiWLQ manrope-medium-mountain-mist-16px">
                    Персональный онлайн-кабинет и актуальная база данных
                </p>
            </div>
            <div class="card-pQrh5w">
                <div class="image-features-04-xjY83x">
                    <img class="image-aDWyug image" src="{{asset('current/img/image-21.png')}}" alt="image" />
                    <img class="rectangle-95-aDWyug rectangle-95" src="{{asset('current/img/rectangle-95-29.svg')}}" alt="Rectangle 95" />
                    <img class="rectangle-96" src="{{asset('current/img/rectangle-96-26.svg')}}" alt="Rectangle 96" />
                </div>
                <div class="frame-102">
                    <div class="x01 manrope-medium-mountain-mist-16px">04</div>
                    <div class="text_label-rGCXYD manrope-medium-eerie-black-20px">Устойчивость и развитие</div>
                </div>
                <p class="x-xjY83x manrope-medium-mountain-mist-16px">
                    Фундамент для долгосрочного партнерства, поддержка вашего бизнеса на каждом этапе
                </p>
            </div>
            <div class="button-2q4aZt">
                <div class="text_label-2g2xVW manrope-semi-bold-white-16px">Узнать всё о платформе</div>
            </div>
        </div>
        <div class="categories-IO3Fu5">
            <p class="x-u8l2EV">
            <span class="span0-aYmmEh manrope-medium-eerie-black-52px">Уже выбрали вашу </span
            ><span class="span1-aYmmEh">сферу </span
                ><span class="span2-aYmmEh manrope-medium-eerie-black-52px">деятельности?</span>
            </p>
            <div class="frame-70-u8l2EV">
                <div class="card-S4HslK">
                    <img class="image-spheres-01-HyESER" src="{{asset('current/img/image-spheres-01-10@2x.png')}}" alt="Image-Spheres-01" />
                    <div class="text_label-HyESER manrope-medium-eerie-black-28px">Строительство</div>
                    <div class="categories-HyESER">
                        <article class="button-cQzPGu">
                            <div class="text_label-cE59mu manrope-medium-eerie-black-14px">Строительные работы</div>
                        </article>
                        <article class="button-l1UZoc">
                            <div class="text_label-clo7HH manrope-medium-eerie-black-14px">Контроль СР</div>
                        </article>
                        <article class="button-YBdRlJ">
                            <div class="text_label-pm1SlJ manrope-medium-eucalyptus-14px">+2</div>
                        </article>
                    </div>
                    <img class="element-arrow-HyESER element-arrow" src="{{asset('current/img/element-arrow-35.svg')}}" alt="element-arrow" />
                </div>
                <div class="card-v3Z18N">
                    <img class="image-spheres-02-TtSH2B" src="{{asset('current/img/rectangle-95-45@2x.png')}}" alt="Image-Spheres-02" />
                    <div class="text_label-TtSH2B manrope-medium-eerie-black-28px">Промышленность</div>
                    <div class="categories-TtSH2B">
                        <article class="button-AuS7ns">
                            <div class="text_label-7wtYPt manrope-medium-eerie-black-14px">Энергетика</div>
                        </article>
                        <article class="button-SnD3dP">
                            <div class="text_label-cKyF36 manrope-medium-eerie-black-14px">Добыча полезных ископаемых</div>
                        </article>
                        <article class="button-2VTCdj">
                            <div class="text_label-58s3nc manrope-medium-eucalyptus-14px">+4</div>
                        </article>
                    </div>
                    <img class="element-arrow-TtSH2B element-arrow" src="{{asset('current/img/element-arrow-35.svg')}}" alt="element-arrow" />
                </div>
            </div>
            <div class="frame-24-u8l2EV">
                <article class="arrow-right-lvgHaH" src="{{asset('current/img/arrow-right-42.svg')}}" alt="arrow-right" />
                <article class="arrow-right-O9oJXO" src="{{asset('current/img/arrow-right-43.svg')}}" alt="arrow-right" />
            </div>
            <p class="x-eV9weN manrope-medium-eerie-black-28px">Делаем процесс лицензирования легким и доступным!</p>
            <div class="button-u8l2EV">
                <div class="text_label-zx5kN5 manrope-semi-bold-white-16px">Оформить заявку</div>
            </div>
            <img class="line-5-u8l2EV" src="{{asset('current/img/line-17-5.svg')}}" alt="Line 5" />
        </div>
        <div class="services-IO3Fu5">
            <p class="text_label-AxJY8Q">
            <span class="span0-CU7wWR manrope-medium-eerie-black-52px">Предоставляем качественные и комплексные </span
            ><span class="span1-CU7wWR">решения</span
                ><span class="span2-CU7wWR manrope-medium-eerie-black-52px"> для вашего бизнеса</span>
            </p>
            <div class="card-AxJY8Q">
                <div class="txt-jAXs31 txt">
                    <div class="text_label-dD0u0E manrope-medium-eerie-black-28px">Регистрация компании</div>
                    <div class="frame-156-dD0u0E frame-156">
                        <div class="frame-118">
                            <img class="ic-chek-8RmiUB ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <div class="x-8RmiUB manrope-medium-eerie-black-14px">
                                Подготовка учредительных документов филиала/представительств
                            </div>
                        </div>
                        <div class="frame-119">
                            <img class="ic-chek-Nw24sW ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <p class="text_label-Nw24sW manrope-medium-eerie-black-14px">
                                Сдача документов в регистрирующий орган
                            </p>
                        </div>
                        <div class="frame-120-0SegxT frame-120">
                            <img class="ic-chek-r3Akza ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <div class="text_label-r3Akza manrope-medium-eerie-black-14px">Заполнение формы на регистрацию</div>
                        </div>
                    </div>
                </div>
                <div class="button-jAXs31">
                    <div class="text_label-ROzHDx manrope-semi-bold-eerie-black-16px">Оформить заявку</div>
                </div>
                <img class="element-arrow-jAXs31 element-arrow" src="{{asset('current/img/element-arrow-35.svg')}}" alt="element-arrow" />
                <img class="image-services-01-jAXs31" src="{{asset('current/img/image-services-01-2@2x.png')}}" alt="Image-Services-01" />
            </div>
            <div class="card-2KPKbv">
                <div class="txt-mcK68k txt">
                    <p class="text_label-YRHTjx manrope-medium-eerie-black-28px">Регистрация компаний в СЭЗ и МФЦА</p>
                    <div class="frame-156-YRHTjx frame-156">
                        <div class="frame-118">
                            <img class="ic-chek-eEJ02T ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <p class="astana-hub-international-technology-park-eEJ02T manrope-medium-eerie-black-14px">
                                Регистрация в качестве участника Astana Hub International Technology Park
                            </p>
                        </div>
                    </div>
                </div>
                <div class="button-mcK68k">
                    <div class="text_label-7lxepG manrope-semi-bold-eerie-black-16px">Оформить заявку</div>
                </div>
                <img class="element-arrow-mcK68k element-arrow" src="{{asset('current/img/element-arrow-35.svg')}}" alt="element-arrow" />
                <img class="image-services-02-mcK68k" src="{{asset('current/img/image-services-02-2@2x.png')}}" alt="Image-Services-02" />
            </div>
            <div class="card-mDvzD5">
                <div class="txt-rjUCp9 txt">
                    <div class="text_label-RMtx7M manrope-medium-eerie-black-28px">Открытие банковских счетов</div>
                    <div class="frame-156-RMtx7M frame-156">
                        <div class="frame-118">
                            <img class="ic-chek-C5CFXC ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <div class="text_label-C5CFXC manrope-medium-eerie-black-14px">Сбор документов</div>
                        </div>
                        <div class="frame-119">
                            <img class="ic-chek-g01rfQ ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <p class="text_label-g01rfQ manrope-medium-eerie-black-14px">Подавка заявки на открытие счета</p>
                        </div>
                    </div>
                </div>
                <div class="button-rjUCp9">
                    <div class="text_label-RntYHQ manrope-semi-bold-eerie-black-16px">Оформить заявку</div>
                </div>
                <img class="element-arrow-rjUCp9 element-arrow" src="{{asset('current/img/element-arrow-35.svg')}}" alt="element-arrow" />
                <img class="image-services-03-rjUCp9" src="{{asset('current/img/image-services-03-2@2x.png')}}" alt="Image-Services-03" />
            </div>
            <div class="card-lYKIxG">
                <div class="txt-x5Fyxk txt">
                    <div class="text_label-V9xbxR manrope-medium-eerie-black-28px">Лицензирование</div>
                    <div class="frame-156-V9xbxR frame-156">
                        <div class="frame-118">
                            <img class="ic-chek-ip5xqG ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <p class="text_label-ip5xqG manrope-medium-eerie-black-14px">
                                Получение лицензий и разрешительных документов для всех видов деятельности
                            </p>
                        </div>
                    </div>
                </div>
                <div class="button-x5Fyxk">
                    <div class="text_label-qyGHHI manrope-semi-bold-eerie-black-16px">Оформить заявку</div>
                </div>
                <img class="element-arrow-x5Fyxk element-arrow" src="{{asset('current/img/element-arrow-35.svg')}}" alt="element-arrow" />
                <img class="image-services-04-x5Fyxk" src="{{asset('current/img/image-services-04-2@2x.png')}}" alt="Image-Services-04" />
            </div>
            <div class="card-lMRNmN">
                <div class="txt-xtHeH2 txt">
                    <p class="x3-5-w4bJkH manrope-medium-eerie-black-28px">Получение визы С3 и С5</p>
                    <div class="frame-156-w4bJkH frame-156">
                        <div class="frame-118">
                            <img class="ic-chek-5Rhncc ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <p class="text_label-5Rhncc manrope-medium-eerie-black-14px">
                                Сбор документов и оформление приглашения
                            </p>
                        </div>
                        <div class="frame-119">
                            <img class="ic-chek-lxxN7H ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <p class="text_label-lxxN7H manrope-medium-eerie-black-14px">Оформление визы в консульстве РК</p>
                        </div>
                    </div>
                </div>
                <div class="button-xtHeH2">
                    <div class="text_label-xbTdTR manrope-semi-bold-eerie-black-16px">Оформить заявку</div>
                </div>
                <img class="element-arrow-xtHeH2 element-arrow" src="{{asset('current/img/element-arrow-35.svg')}}" alt="element-arrow" />
                <img class="image-services-05-xtHeH2" src="{{asset('current/img/image-services-05-2@2x.png')}}" alt="Image-Services-05" />
            </div>
            <div class="card-J1EI5y">
                <div class="txt-jwqKwT txt">
                    <div class="text_label-uxKGgW manrope-medium-eerie-black-28px">Предоставление отраслевого юриста</div>
                    <div class="frame-156-uxKGgW frame-156">
                        <div class="frame-118">
                            <img class="ic-chek-xtOUj2 ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <p class="text_label-xtOUj2 manrope-medium-eerie-black-14px">
                                Услуги юриста на аутсорсинге для вашего бизнеса
                            </p>
                        </div>
                    </div>
                </div>
                <div class="button-jwqKwT">
                    <div class="text_label-fIKBaY manrope-semi-bold-eerie-black-16px">Оформить заявку</div>
                </div>
                <img class="element-arrow-jwqKwT element-arrow" src="{{asset('current/img/element-arrow-35.svg')}}" alt="element-arrow" />
                <img class="image-services-06-jwqKwT" src="{{asset('current/img/image-services-06-2@2x.png')}}" alt="Image-Services-06" />
            </div>
            <div class="card-HtVoXk">
                <div class="txt-Stxq5k txt">
                    <div class="text_label-7oogE9 manrope-medium-eerie-black-28px">Бухгалтерский аутсорсинг</div>
                    <div class="frame-156-7oogE9 frame-156">
                        <div class="frame-118">
                            <img class="ic-chek-CGihRX ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <p class="x-CGihRX manrope-medium-eerie-black-14px">
                                Подписание документов в банке (работа с менеджером банка)
                            </p>
                        </div>
                        <div class="frame-119">
                            <img class="ic-chek-LhxihO ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <div class="text_label-LhxihO manrope-medium-eerie-black-14px">Сбор данных клиентов</div>
                        </div>
                    </div>
                </div>
                <div class="button-Stxq5k">
                    <div class="text_label-5FWBac manrope-semi-bold-eerie-black-16px">Оформить заявку</div>
                </div>
                <img class="element-arrow-Stxq5k element-arrow" src="{{asset('current/img/element-arrow-35.svg')}}" alt="element-arrow" />
                <img class="image-services-07-Stxq5k" src="{{asset('current/img/image-services-07-2@2x.png')}}" alt="Image-Services-07" />
            </div>
            <div class="card-Y3CINJ">
                <div class="txt-6NMh2e txt">
                    <div class="text_label-NGv8tt manrope-medium-eerie-black-28px">Дополнительные услуги</div>
                    <div class="frame-156-NGv8tt frame-156">
                        <div class="frame-118">
                            <img class="ic-chek-thLkqj ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <div class="x-thLkqj manrope-medium-eerie-black-14px">Получение ИИН, БИН</div>
                        </div>
                        <div class="frame-119">
                            <img class="ic-chek-d63vMy ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <div class="text_label-d63vMy manrope-medium-eerie-black-14px">Получение ЭЦП</div>
                        </div>
                        <div class="frame-120-szzerw frame-120">
                            <img class="ic-chek-XIXNId ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <div class="text_label-XIXNId manrope-medium-eerie-black-14px">Оформление РВП</div>
                        </div>
                    </div>
                </div>
                <div class="button-6NMh2e">
                    <div class="text_label-apG4Sv manrope-semi-bold-eerie-black-16px">Оформить заявку</div>
                </div>
                <img class="element-arrow-6NMh2e element-arrow" src="{{asset('current/img/element-arrow-35.svg')}}" alt="element-arrow" />
                <img class="image-services-08-6NMh2e" src="{{asset('current/img/image-services-08-2@2x.png')}}" alt="Image-Services-08" />
            </div>
        </div>
        <div class="numbers-IO3Fu5">
            <div class="uppercase-sAnUcC manrope-medium-eerie-black-52px">О группе UPPERCASE</div>
            <img class="line-6-sAnUcC" src="{{asset('current/img/line-6-2.svg')}}" alt="Line 6" />
            <img class="line-7-sAnUcC" src="{{asset('current/img/line-7-2.svg')}}" alt="Line 7" />
            <h1 class="title-sAnUcC">3000+</h1>
            <p class="x-sAnUcC manrope-medium-mountain-mist-16px">
                Клиентов в области регистрации, лицензирования, сопровождения международных сделок и корпоративного права
            </p>
            <div class="txt01-sAnUcC">
                <div class="x13-PNU2Yr manrope-medium-eerie-black-36px">13+ лет</div>
                <p class="text_label-PNU2Yr manrope-medium-mountain-mist-16px">На рынке юридических услуг и консалтинга</p>
            </div>
            <img class="line-8-sAnUcC" src="{{asset('current/img/line-8-2.svg')}}" alt="Line 8" />
            <div class="txt02-sAnUcC">
                <div class="x6-V6CTdk manrope-medium-eerie-black-36px">6</div>
                <p class="text_label-V6CTdk manrope-medium-mountain-mist-16px">Филиалов в ОАЭ и РК</p>
            </div>
            <img class="line-9-sAnUcC" src="{{asset('current/img/line-8-2.svg')}}" alt="Line 9" />
            <div class="txt03-sAnUcC">
                <div class="it-swLPFN manrope-medium-eerie-black-36px">IT-решения</div>
                <p class="text_label-swLPFN manrope-medium-mountain-mist-16px">В области юридических услуг и консалтинга</p>
            </div>
            <img class="line-10-sAnUcC" src="{{asset('current/img/line-8-2.svg')}}" alt="Line 10" />
            <div class="txt04-sAnUcC">
                <div class="x500-fcjtmK manrope-medium-eerie-black-36px">500+</div>
                <div class="text_label-fcjtmK manrope-medium-mountain-mist-16px">Успешно завершенных проектов</div>
            </div>
            <img class="line-11-sAnUcC" src="{{asset('current/img/line-8-2.svg')}}" alt="Line 11" />
            <div class="txt05-sAnUcC">
                <div class="x300-T6k4xe manrope-medium-eerie-black-36px">300+</div>
                <div class="text_label-T6k4xe manrope-medium-mountain-mist-16px">Опытных специалистов в команде</div>
            </div>
        </div>
        <div class="personal-area-IO3Fu5">
            <div class="rectangle-104-yVD4xx"></div>
            <img class="image-line-yVD4xx" src="{{asset('current/img/image-line-2.svg')}}" alt="Image-Line" />
            <div class="rectangle-105-yVD4xx"></div>
            <div class="button-yVD4xx">
                <div class="text_label-RSvL3d manrope-semi-bold-eucalyptus-16px">Получить консультацию</div>
            </div>
            <p class="text_label-yVD4xx">Пользователю портала предоставляется простой и удобный личный кабинет</p>
            <div class="frame-156-yVD4xx frame-156">
                <div class="frame-118">
                    <img class="ic-chek-WNKAHK ic-chek" src="{{asset('current/img/ic-chek-118.svg')}}" alt="ic-chek" />
                    <div class="text_label-WNKAHK manrope-medium-white-14px">Отслеживание статус заказанных услуг</div>
                </div>
                <div class="frame-119">
                    <img class="ic-chek-vv1ahS ic-chek" src="{{asset('current/img/ic-chek-118.svg')}}" alt="ic-chek" />
                    <p class="text_label-vv1ahS manrope-medium-white-14px">Создание надежного архива ваших документов</p>
                </div>
                <div class="frame-120-prTAGx frame-120">
                    <img class="ic-chek-dZwv6S ic-chek" src="{{asset('current/img/ic-chek-118.svg')}}" alt="ic-chek" />
                    <div class="text_label-dZwv6S manrope-medium-white-14px">
                        Получение специализированных отраслевых услуг
                    </div>
                </div>
            </div>
            <img class="image-personal-area-yVD4xx" src="{{asset('current/img/image-personalarea-2.png')}}" alt="Image-PersonalArea" />
        </div>
        <div class="form-IO3Fu5">
            <img class="image-line-green-CvbIgo" src="{{asset('current/img/image-line-green-2.svg')}}" alt="Image-Line-Green" />
            <div class="form-CvbIgo">
                <div class="frame-149-Tj6uoL">
                    <div class="text_label-xi7cQ2 manrope-semi-bold-eerie-black-16px">Представьтесь пожалуйста</div>
                    <div class="input-xi7cQ2 input">
                        <div class="x-meUTcL manrope-semi-bold-mountain-mist-16px">Ф.И.О</div>
                    </div>
                </div>
                <div class="frame-150-Tj6uoL">
                    <div class="text_label-3vJAlL manrope-semi-bold-eerie-black-16px">Услуга</div>
                    <div class="input-3vJAlL input">
                        <div class="text_label-vNx1yN manrope-semi-bold-mountain-mist-16px">Выберите услугу</div>
                        <img class="arrow-up-vNx1yN" src="{{asset('current/img/arrow-up-5.svg')}}" alt="arrow-up" />
                    </div>
                </div>
                <div class="frame-151-Tj6uoL">
                    <div class="text_label-6lflbR manrope-semi-bold-eerie-black-16px">Электронная почта</div>
                    <div class="input-6lflbR input">
                        <div class="examplegmailcom-utOXDI manrope-semi-bold-mountain-mist-16px">example@gmail.com</div>
                    </div>
                </div>
                <div class="frame-152-Tj6uoL">
                    <div class="text_label-5FeFco manrope-semi-bold-eerie-black-16px">Телефон</div>
                    <div class="input-5FeFco input">
                        <div class="x8-___-___-__-__-oq3we9 manrope-semi-bold-mountain-mist-16px">8 (___) ___-__-__</div>
                    </div>
                </div>
                <div class="frame-153-Tj6uoL">
                    <div class="text_label-vQupHm manrope-semi-bold-eerie-black-16px">Комментарий</div>
                    <div class="input-vQupHm input">
                        <div class="text_label-ROPbPy manrope-semi-bold-mountain-mist-16px">Оставьте свой комментарий</div>
                    </div>
                </div>
                <div class="button-Tj6uoL">
                    <div class="text_label-h7BP9b manrope-semi-bold-white-16px">Получить консультацию</div>
                </div>
                <img class="rectangle-95-Tj6uoL rectangle-95" src="{{asset('current/img/element-arrow-35.svg')}}" alt="Rectangle 95" />
                <p class="x-Tj6uoL manrope-semi-bold-eerie-black-14px">
              <span class="span0-I8Z1xh manrope-semi-bold-eerie-black-14px">Нажимая на кнопку, я соглашаюсь на </span
              ><a href="https://skillbox.ru/privacy_policy.pdf" target="_blank"
                    ><span class="span1-I8Z1xh manrope-semi-bold-eerie-black-14px">обработку персональных данных</span></a
                    ><span class="span2-I8Z1xh manrope-semi-bold-eerie-black-14px">&nbsp;</span>
                </p>
            </div>
            <div class="text_label-CvbIgo manrope-medium-eerie-black-52px">Свяжитесь с нами</div>
            <p class="text_label-yeYOQS manrope-medium-eerie-black-16px">
                Предоставимтбыстрое и эффективное открытие и ведение бизнеса в Казахстане
            </p>
        </div>
        <div class="logos-IO3Fu5">
            <div class="text_label-HTvolb manrope-medium-eerie-black-52px">Нам доверяют</div>
            <img class="arrow-right-HTvolb" src="{{asset('current/img/arrow-right-42.svg')}}" alt="arrow-right" />
            <img class="arrow-right-qvKaqU" src="{{asset('current/img/arrow-right-43.svg')}}" alt="arrow-right" />
            <div class="frame-133-HTvolb">
                <div class="logo-kalugin-light"><img class="image-48" src="{{asset('current/img/image-48-2@2x.png')}}" alt="image 48" /></div>
                <div class="logo-metprom-light-fjfVOB">
                    <img class="image-49-C9FrkZ" src="{{asset('current/img/image-49-2@2x.png')}}" alt="image 49" />
                </div>
                <div class="logo-usp-light-fjfVOB">
                    <img class="image-51-IWRCzR" src="{{asset('current/img/image-51-3@2x.png')}}" alt="image 51" />
                </div>
                <div class="logo-crcc-light-fjfVOB">
                    <img class="image-50-xOWhcR" src="{{asset('current/img/image-50-2@2x.png')}}" alt="image 50" />
                </div>
                <div class="logo-simax-light-fjfVOB">
                    <img class="image-53-ocuX8s" src="{{asset('current/img/image-53-2@2x.png')}}" alt="image 53" />
                </div>
                <div class="logo-kalugin-light"><img class="image-48" src="{{asset('current/img/image-48-2@2x.png')}}" alt="image 48" /></div>
            </div>
            <div class="cursor-finger-HTvolb"><img class="cursor-0gjgR7" src="{{asset('current/img/cursor-2.png')}}" alt="cursor" /></div>
        </div>
        <footer class="footer-IO3Fu5">
            <img class="group-6isyAT group" src="{{asset('current/img/group-7@2x.png')}}" alt="Group" />
            <img class="group-yG03hB group" src="{{asset('current/img/group-6@2x.png')}}" alt="Group" />
            <img class="group-PFJXaN group" src="{{asset('current/img/group-8@2x.png')}}" alt="Group" />
            <div class="links-6isyAT">
                <div class="text_label-ptfToW manrope-medium-eerie-black-14px">О компании</div>
                <div class="text_label-Hdvxoc manrope-medium-eerie-black-14px">Регистрация компании</div>
                <div class="text_label-jgXW3m manrope-medium-eerie-black-14px">Лицензирование</div>
                <div class="text_label-DUuBuA manrope-medium-eerie-black-14px">Открытие счетов</div>
                <div class="text_label-1cFwD3 manrope-medium-eerie-black-14px">Блог</div>
            </div>
            <p class="upperlicense-6isyAT upperlicense">
                UPPERLICENSE не является государственным органом и не представляет какой-либо официальный орган. Все
                названия продуктов, логотипы и бренды являются собственностью их владельцев. Все названия компаний, органов
                власти, реестра, продуктов и услуг, используемые на этом веб-сайте, используются только в целях
                идентификации. Использование этих названий, логотипов и брендов не означает одобрения.
            </p>
            <div class="text_label-6isyAT manrope-medium-eerie-black-12px">Политика конфиденциальности</div>
            <div class="x2023-upperlicense-6isyAT manrope-medium-eerie-black-12px">©2023 UPPERLICENSE</div>
            <div class="text_label-yG03hB manrope-medium-mountain-mist-14px">Контактный центр</div>
            <div class="text_label-PFJXaN manrope-medium-mountain-mist-14px">Мы в социальных сетях</div>
            <div class="text_label-xI381Q manrope-medium-mountain-mist-14px">Меню</div>
            <div class="text_label-oVxNOX manrope-medium-mountain-mist-14px">Напишите на почту</div>
            <div class="social-6isyAT">
                <img class="button-Xsm6MR" src="{{asset('current/img/button-10.svg')}}" alt="button" />
                <img class="button-6ZoZEl" src="{{asset('current/img/button-11.png')}}" alt="button" />
                <img class="button-iu3xCh" src="{{asset('current/img/button-12.png')}}" alt="button" />
                <img class="button-7a3VvC" src="{{asset('current/img/button-13.png')}}" alt="button" />
                <img class="button-vilndL" src="{{asset('current/img/button-14.png')}}" alt="button" />
            </div>
            <div class="frame-80-6isyAT">
                <div class="infolicensekz-i7XuTo manrope-medium-eerie-black-28px">info@license.kz</div>
                <img class="arrow-right-i7XuTo" src="{{asset('current/img/arrow-right-36.svg')}}" alt="arrow-right" />
            </div>
            <div class="frame-79-6isyAT">
                <div class="x7-747-135-0000-5xAIT8 manrope-medium-eerie-black-28px">+7 (747) 135-0000</div>
                <img class="arrow-right-5xAIT8" src="{{asset('current/img/arrow-right-36.svg')}}" alt="arrow-right" />
            </div>
            <img class="line-17-6isyAT line-17" src="{{asset('current/img/line-17-5.svg')}}" alt="Line 17" />
        </footer>
        <img class="line-17-IO3Fu5 line-17" src="{{asset('current/img/line-17-5.svg')}}" alt="Line 17" />
        <div class="qa-IO3Fu5">
            <div class="frame-68-hEx8MF">
                <div class="button-YGgNaq">
                    <p class="x-JwEnvq manrope-medium-eerie-black-16px">Каковы сроки регистрации бизнеса в Казахстане?</p>
                    <img class="component-1" src="{{asset('current/img/component-1-23.svg')}}" alt="Component 1" />
                </div>
                <div class="button-NRLNre">
                    <div class="frame-69-ctQ4Nj">
                        <p class="x-AYmxuQ manrope-medium-eerie-black-16px">
                            Какие основные требования для регистрации компании в Казахстане?
                        </p>
                        <p class="x-aL8yC8 manrope-medium-eerie-black-14px">
                            Предоставим&nbsp;&nbsp;быстрое и эффективное открытие и ведение бизнеса в Казахстане. В остальных
                            случаях расчетный счет можно открыть за один день. Сразу после подачи заявки вы получите реквизиты и
                            сможете выставлять счета на оплату. После встречи с представителем банка появится возможность
                            принимать деньги и совершать исходящие платежи.
                        </p>
                    </div>
                    <img class="component-1" src="{{asset('current/img/component-1-21.svg')}}" alt="Component 1" />
                </div>
                <div class="button-jix0Vq">
                    <p class="x-KxgASs manrope-medium-eerie-black-16px">
                        Какие документы понадобятся для регистрации юридического лица в Казахстане?
                    </p>
                    <img class="component-1" src="{{asset('current/img/component-1-23.svg')}}" alt="Component 1" />
                </div>
                <div class="button-kwSlwS">
                    <p class="x-diiWAN manrope-medium-eerie-black-16px">
                        Можно ли в казахстанском банке открыть счет для ИП удаленно?
                    </p>
                    <img class="component-1" src="{{asset('current/img/component-1-23.svg')}}" alt="Component 1" />
                </div>
                <div class="button-ztTbnm">
                    <p class="x-bTAgrV manrope-medium-eerie-black-16px">Какие налоги потребуется платить в Казахстане?</p>
                    <img class="component-1" src="{{asset('current/img/component-1-23.svg')}}" alt="Component 1" />
                </div>
                <div class="button-nTUWV7">
                    <p class="x-65ChbN manrope-medium-eerie-black-16px">
                        Как долго обычно занимает процесс получения разрешений в стране?
                    </p>
                    <img class="component-1" src="{{asset('current/img/component-1-23.svg')}}" alt="Component 1" />
                </div>
                <div class="button-IOSEYL">
                    <p class="x-7QG5pc manrope-medium-eerie-black-16px">
                        Какие отрасли и виды деятельности подлежат обязательной лицензированию в Казахстане?
                    </p>
                    <img class="component-1" src="{{asset('current/img/component-1-23.svg')}}" alt="Component 1" />
                </div>
            </div>
            <div class="text_label-hEx8MF manrope-medium-eerie-black-52px">Ответы на вопросы</div>
        </div>
        <div class="cases-IO3Fu5">
            <div class="text_label-6Udbc1 manrope-medium-eerie-black-52px">Кейсы наших клиентов</div>
            <div class="right-6Udbc1">
                <div class="frame-130-CGku8L">
                    <div class="text_label-uKRz1u manrope-medium-eerie-black-20px">Входные параметры</div>
                    <div class="frame-120-uKRz1u frame-120">
                        <div class="frame-118">
                            <img class="ic-chek-rijAln ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <p class="x7-1-rijAln manrope-medium-mountain-mist-14px">
                                В короткие сроки (7 рабочих дней) получить лицензию на проведение строительно-монтажных работ
                                1 категории.
                            </p>
                        </div>
                        <div class="frame-119">
                            <img class="ic-chek-uIrkqt ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <p class="x-uIrkqt manrope-medium-mountain-mist-14px">
                                Получить консультирование отраслевого юриста по квалификационным требованиям и нормативно-правовым
                                актам в сфере строительства.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="frame-129-CGku8L">
                    <div class="text_label-r03b7C manrope-medium-eerie-black-20px">Решение</div>
                    <div class="frame-120-r03b7C frame-120">
                        <div class="frame-128-s3xf1s">
                            <div class="frame-118">
                                <img class="ic-chek-WxfYb4 ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                                <p class="x-WxfYb4 manrope-medium-mountain-mist-14px">
                                    Получение консультации отраслевого юриста. Консультация опытного юриста по вопросам
                                    квалификационных требований и нормативно-правовых актов в сфере строительства.
                                </p>
                            </div>
                            <div class="frame-119">
                                <img class="ic-chek-ZDnxAc ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                                <p class="x-ZDnxAc manrope-medium-mountain-mist-14px">
                                    Советы и рекомендации по подготовке документов и прохождению процедуры лицензирования.
                                </p>
                            </div>
                            <div class="frame-120-Jex0ey frame-120">
                                <img class="ic-chek-35DAhk ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                                <div class="text_label-35DAhk manrope-medium-mountain-mist-14px">
                                    Подготовка необходимого пакета документов
                                </div>
                            </div>
                            <div class="frame-121-Jex0ey">
                                <img class="ic-chek-NfbqWV ic-chek" src="{{asset('current/img/rectangle-95-45')}}@2x.png" alt="ic-chek" />
                                <p class="x-NfbqWV manrope-medium-eerie-black-16px">
                                    Составление полного списка и подготовка всех необходимых документов.
                                </p>
                            </div>
                            <div class="frame-122-Jex0ey">
                                <img class="ic-chek-GfiLUP ic-chek" src="{{asset('current/img/rectangle-95-45')}}@2x.png" alt="ic-chek" />
                                <p class="text_label-GfiLUP manrope-medium-eerie-black-16px">
                                    Обращение в орган регулирования и подача заявления
                                </p>
                            </div>
                            <div class="frame-123-Jex0ey">
                                <img class="ic-chek-dYvpIp ic-chek" src="{{asset('current/img/rectangle-95-45@2x.png')}}" alt="ic-chek" />
                                <p class="x-dYvpIp manrope-medium-eerie-black-16px">
                                    Подача полного и правильно заполненного заявления в соответствующий орган, оплата необходимых
                                    сборов.
                                </p>
                            </div>
                            <div class="frame-124-Jex0ey">
                                <img class="ic-chek-Ofhx8p ic-chek" src="{{asset('current/img/rectangle-95-45@2x.png')}}" alt="ic-chek" />
                                <div class="x-Ofhx8p manrope-medium-eerie-black-16px">
                                    Проведение экспресс-аудита и подготовка к проверке
                                </div>
                            </div>
                            <div class="frame-125-Jex0ey">
                                <img class="ic-chek-oKcEHx ic-chek" src="{{asset('current/img/rectangle-95-45@2x.png')}}" alt="ic-chek" />
                                <div class="text_label-oKcEHx manrope-medium-eerie-black-16px">
                                    Согласование с регулятором и получение лицензии
                                </div>
                            </div>
                            <div class="frame-126-Jex0ey">
                                <img class="ic-chek-DaT35x ic-chek" src="{{asset('current/img/rectangle-95-45@2x.png')}}" alt="ic-chek" />
                                <p class="x1-DaT35x x1 manrope-medium-eerie-black-16px">
                                    Получение лицензии на проведение строительно-монтажных работ 1 категории.
                                </p>
                            </div>
                        </div>
                        <div class="button-s3xf1s">
                            <div class="text_label-IxX8Wk manrope-medium-eucalyptus-14px">Показать полностью</div>
                        </div>
                    </div>
                </div>
                <div class="frame-131-CGku8L">
                    <div class="text_label-ixvFbE manrope-medium-white-20px">Результат</div>
                    <div class="frame-120-ixvFbE frame-120">
                        <div class="frame-118">
                            <img class="ic-chek-uUlwSD ic-chek" src="{{asset('current/img/ic-chek-118.svg')}}" alt="ic-chek" />
                            <p class="x1-uUlwSD x1 manrope-medium-white-14px">
                                В результате успешной реализации этого кейса, компания смогла получить лицензию на проведение
                                строительно-монтажных работ 1 категории в короткие сроки, а также получила консультацию отраслевого
                                юриста, что позволило ей эффективно соблюсти все требования и нормативы в сфере строительства
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="left-6Udbc1">
                <p class="text_label-2DrgxM manrope-medium-eerie-black-36px">
                    Розничная торговля путём заказа товаров по почте
                </p>
                <div class="frame-155-2DrgxM">
                    <div class="image-logo-X0Eib4">
                        <img class="image-54-ixHv21" src="{{asset('current/img/image-54-2@2x.png')}}" alt="image 54" />
                    </div>
                    <div class="frame-154-X0Eib4">
                        <div class="text_label-beOyuX manrope-medium-eerie-black-20px">Технониколь</div>
                        <p class="text_label-NaHZt2 manrope-medium-mountain-mist-14px">
                            Производитель строительных материалов и систем
                        </p>
                    </div>
                </div>
                <div class="button-2DrgxM">
                    <div class="x-4OKL3N manrope-semi-bold-eerie-black-16px">Смотреть видео-отзыв</div>
                    <img class="polygon-1-4OKL3N" src="{{asset('current/img/polygon-1-3.svg')}}" alt="Polygon 1" />
                </div>
            </div>
            <img class="line-35-6Udbc1" src="{{asset('current/img/line-17-5.svg')}}" alt="Line 35" />
            <img class="arrow-right-6Udbc1" src="{{asset('current/img/arrow-right-42.svg')}}" alt="arrow-right" />
            <img class="arrow-right-ujmPcf" src="{{asset('current/img/arrow-right-43.svg')}}" alt="arrow-right" />
        </div>
        <div class="roadmap-IO3Fu5">
            <div class="upperlicense-road-map-0EqGIa manrope-medium-eerie-black-52px">UPPERLICENSE RoadMap</div>
            <div class="date-0EqGIa date">
                <div class="x2023-w9F9bA manrope-medium-mountain-mist-14px">2023</div>
                <div class="x20-w9F9bA x20">20 декабря</div>
            </div>
            <div class="date-x6gIBU date">
                <div class="x2024 manrope-medium-mountain-mist-14px">2024</div>
                <div class="x20 manrope-medium-eerie-black-28px">20 января</div>
            </div>
            <div class="date-Yxxyxt date">
                <div class="x2024 manrope-medium-mountain-mist-14px">2024</div>
                <div class="x26-yRy6Qp manrope-medium-eerie-black-28px">26 января</div>
            </div>
            <div class="date-QIXsGe date">
                <div class="x2024 manrope-medium-mountain-mist-14px">2024</div>
                <div class="x30-IjwRGv manrope-medium-eerie-black-28px">30 января</div>
            </div>
            <div class="card-0EqGIa">
                <div class="image-roadmap-04">
                    <img class="image-v2635l image" src="{{asset('current/img/image-22.png')}}" alt="image" />
                    <img class="rectangle-95-v2635l rectangle-95" src="{{asset('current/img/rectangle-95-29.svg')}}" alt="Rectangle 95" />
                    <img class="rectangle-96" src="{{asset('current/img/rectangle-96-26.svg')}}" alt="Rectangle 96" />
                </div>
                <div class="frame-135">
                    <div class="frame-102"><div class="mvp-oUi5ST manrope-medium-eerie-black-20px">Запуск MVP</div></div>
                </div>
                <img class="attention-info_circle" src="{{asset('current/img/attention---info-circle-14.svg')}}" alt="attention / info_circle" />
            </div>
            <div class="card-x6gIBU">
                <div class="image-roadmap-04">
                    <img class="image-uHwtOw image" src="{{asset('current/img/image-23.png')}}" alt="image" />
                    <img class="rectangle-95-uHwtOw rectangle-95" src="{{asset('current/img/rectangle-95-29.svg')}}" alt="Rectangle 95" />
                    <img class="rectangle-96" src="{{asset('current/img/rectangle-96-26.svg')}}" alt="Rectangle 96" />
                </div>
                <div class="frame-135">
                    <div class="frame-102">
                        <div class="text_label-YJe5jE manrope-medium-eerie-black-20px">Расширение перечня услуг</div>
                    </div>
                </div>
                <img class="attention-info_circle" src="{{asset('current/img/attention---info-circle-14.svg')}}" alt="attention / info_circle" />
            </div>
            <div class="card-Yxxyxt">
                <div class="image-roadmap-04">
                    <img class="image-R0jhtA image" src="{{asset('current/img/image-24.png')}}" alt="image" />
                    <img class="rectangle-95-R0jhtA rectangle-95" src="{{asset('current/img/rectangle-95-29.svg')}}" alt="Rectangle 95" />
                    <img class="rectangle-96" src="{{asset('current/img/rectangle-96-26.svg')}}" alt="Rectangle 96" />
                </div>
                <div class="frame-135">
                    <div class="frame-102">
                        <div class="text_label-5ikjZs manrope-medium-eerie-black-20px">Упрощенная оплата</div>
                    </div>
                </div>
                <img class="attention-info_circle" src="{{asset('current/img/attention---info-circle-14.svg')}}" alt="attention / info_circle" />
            </div>
            <div class="card-QIXsGe">
                <div class="image-roadmap-04">
                    <img class="image-PxPo1n image" src="{{asset('current/img/image-25.png')}}" alt="image" />
                    <img class="rectangle-95-PxPo1n rectangle-95" src="{{asset('current/img/rectangle-95-29.svg')}}" alt="Rectangle 95" />
                    <img class="rectangle-96" src="{{asset('current/img/rectangle-96-26.svg')}}" alt="Rectangle 96" />
                </div>
                <div class="frame-135">
                    <div class="frame-102">
                        <div class="text_label-b1Qp2i manrope-medium-eerie-black-20px">Реферальная система</div>
                    </div>
                </div>
                <img class="attention-info_circle" src="{{asset('current/img/attention---info-circle-14.svg')}}" alt="attention / info_circle" />
            </div>
            <div class="progressbar-0EqGIa">
                <img class="line-40-QqfxNe" src="{{asset('current/img/line-40-3.svg')}}" alt="Line 40" />
                <img class="line-41-QqfxNe" src="{{asset('current/img/line-41-3.svg')}}" alt="Line 41" />
                <div class="dot-active-QqfxNe">
                    <div class="ellipse-1382-3Nixp1 ellipse-1382"></div>
                    <img class="ic-chek-3Nixp1 ic-chek" src="{{asset('current/img/ic-chek-133.svg')}}" alt="ic-chek" />
                </div>
                <div class="dot-QqfxNe dot">
                    <div class="ellipse-1382-ZUWnoG ellipse-1382"></div>
                    <img class="ic-chek-ZUWnoG ic-chek" src="{{asset('current/img/ic-chek-134.svg')}}" alt="ic-chek" />
                </div>
                <div class="dot-KWWVlW dot">
                    <div class="ellipse-1382-kjQU9w ellipse-1382"></div>
                    <img class="ic-chek-kjQU9w ic-chek" src="{{asset('current/img/ic-chek-134.svg')}}" alt="ic-chek" />
                </div>
                <div class="dot-1FT5pu dot">
                    <div class="ellipse-1382-xNyQsE ellipse-1382"></div>
                    <img class="ic-chek-xNyQsE ic-chek" src="{{asset('current/img/ic-chek-134.svg')}}" alt="ic-chek" />
                </div>
            </div>
            <img class="arrow-right-0EqGIa" src="{{asset('current/img/arrow-right-42.svg')}}" alt="arrow-right" />
            <img class="arrow-right-x6gIBU" src="{{asset('current/img/arrow-right-43.svg')}}" alt="arrow-right" />
        </div>
    </div>
</div>
<div class="container-center-horizontal">
    <div class="main-360 screen">
        <img class="image-slider-1-rwxf71" src="{{asset('current/img/image-slider-1-2.png')}}" alt="image-slider-1" />
        <header class="header-rwxf71">
            <img class="logo-qBP2f2" src="{{asset('current/img/logo-1.svg')}}" alt="Logo" />
            <div class="frame-157-qBP2f2">
                <div class="callback-leIyBx" data-bs-toggle="modal" data-bs-target="#consultModal">
                    <div class="button-jD5n99">
                        <img class="basic-phone-xw66AK" src="{{asset('current/img/basic---phone-2.svg')}}" alt="basic / phone" />
                    </div>
                </div>
                <div class="menu-leIyBx">
                    <div class="button-jFkVun"><img class="icons-Qq6Qex" src="{{asset('current/img/icons-13.svg')}}" alt="Icons" /></div>
                </div>
            </div>
        </header>
        <p class="text_label-rwxf71 manrope-medium-eerie-black-32px">
            Мгновенный старт для вашего бизнеса в Казахстане
        </p>
        <div class="frame-159-rwxf71 frame-159">
            <div class="txt-yT6e4Q txt">
                <p class="upperlicense-poaWf3 manrope-medium-white-20px">
                    UPPERLICENSE: Идеальное решение для регистрации вашего бизнеса в РК
                </p>
                <p class="x-poaWf3 x">
                    Полная автоматизация и удобство управления — откройте новые возможности для вашего бизнеса в Казахстане с
                    нашей инновационной онлайн-платформой!
                </p>
                <div class="button-poaWf3">
                    <div class="text_label-aq7Z6p manrope-semi-bold-eucalyptus-16px">Начать регистрацию</div>
                </div>
            </div>
            <div class="frame-158">
                <div class="x01-04 manrope-medium-black-haze-16px">01 / 04</div>
                <div class="frame-71">
                    <article class="arrow-right-YW0Flt arrow-right" src="{{asset('current/img/arrow-right-40.svg')}}" alt="arrow-right" />
                    <article class="arrow-right-dDeguz arrow-right" src="{{asset('current/img/arrow-right-41.svg')}}" alt="arrow-right" />
                </div>
            </div>
        </div>
        <div class="features-rwxf71">
            <div class="upperlicense-2XJxe4 manrope-medium-eerie-black-32px">Преимущества работы с UPPERLICENSE</div>
            <div class="frame-160-2XJxe4">
                <div class="card-DFWeIL customCard">
                    <div class="image-features-01-PTrenY">
                        <img class="image" src="{{asset('current/img/image-18@2x.png')}}" alt="image" />
                        <img class="rectangle-95-5o4BRE rectangle-95" src="{{asset('current/img/rectangle-95-38.svg')}}" alt="Rectangle 95" />
                        <img class="rectangle-96-5o4BRE rectangle-96" src="{{asset('current/img/rectangle-96-34.svg')}}" alt="Rectangle 96" />
                    </div>
                    <div class="frame-165-PTrenY">
                        <div class="frame-102">
                            <div class="x01-GxeT9m manrope-medium-mountain-mist-16px">01</div>
                            <div class="text_label-GxeT9m manrope-medium-eerie-black-16px">Контроль и инновации</div>
                        </div>
                        <p class="x-xgYYF1 x manrope-medium-mountain-mist-14px">
                            Уникальная онлайн-панель управления для вашего бизнеса
                        </p>
                    </div>
                </div>
                <div class="card-KGWmH6 customCard">
                    <div class="image-features-02-dsxMMn">
                        <img class="image-9RDGaQ image" src="{{asset('current/img/image-19.png')}}" alt="image" />
                        <img class="rectangle-95-9RDGaQ rectangle-95" src="{{asset('current/img/rectangle-95-38.svg')}}" alt="Rectangle 95" />
                        <img class="rectangle-96-9RDGaQ rectangle-96" src="{{asset('current/img/rectangle-96-34.svg')}}" alt="Rectangle 96" />
                    </div>
                    <div class="frame-166-dsxMMn">
                        <div class="frame-102">
                            <div class="x02-drSsJK manrope-medium-mountain-mist-16px">02</div>
                            <div class="text_label-drSsJK manrope-medium-eerie-black-16px">Экспертность</div>
                        </div>
                        <p class="text_label-bYxj1c manrope-medium-mountain-mist-14px">
                            Полный спектр квалифицированной поддержки для вашего бизнеса
                        </p>
                    </div>
                </div>
                <div class="card-lMcLkv customCard">
                    <div class="image-features-03-wmmQU2">
                        <img class="image-dGrocX image" src="{{asset('current/img/image-20.png')}}" alt="image" />
                        <img class="rectangle-95-dGrocX rectangle-95" src="{{asset('current/img/rectangle-95-38.svg')}}" alt="Rectangle 95" />
                        <img class="rectangle-96-dGrocX rectangle-96" src="{{asset('current/img/rectangle-96-34.svg')}}" alt="Rectangle 96" />
                    </div>
                    <div class="frame-167-wmmQU2">
                        <div class="frame-102">
                            <div class="x03-TAbXsj manrope-medium-mountain-mist-16px">03</div>
                            <div class="text_label-TAbXsj manrope-medium-eerie-black-16px">Удобство и доступность</div>
                        </div>
                        <p class="x-kWAQzc x manrope-medium-mountain-mist-14px">
                            Персональный онлайн-кабинет и актуальная база данных
                        </p>
                    </div>
                </div>
                <div class="card-77hRQA customCard">
                    <div class="image-features-04-X5vcf9">
                        <img class="image-VWil9S image" src="{{asset('current/img/image-21.png')}}" alt="image" />
                        <img class="rectangle-95-VWil9S rectangle-95" src="{{asset('current/img/rectangle-95-38.svg')}}" alt="Rectangle 95" />
                        <img class="rectangle-96-VWil9S rectangle-96" src="{{asset('current/img/rectangle-96-34.svg')}}" alt="Rectangle 96" />
                    </div>
                    <div class="frame-168-X5vcf9">
                        <div class="frame-102">
                            <div class="x04-zoVcCM manrope-medium-mountain-mist-16px">04</div>
                            <div class="text_label-zoVcCM manrope-medium-eerie-black-16px">Устойчивость и развитие</div>
                        </div>
                        <p class="x-8UWT4O x manrope-medium-mountain-mist-14px">
                            Фундамент для долгосрочного партнерства, поддержка вашего бизнеса на каждом этапе
                        </p>
                    </div>
                </div>
            </div>
            <div class="button-2XJxe4">
                <div class="text_label-2TqQTx manrope-semi-bold-white-16px">Узнать всё о платформе</div>
            </div>
        </div>
        <div class="categories-rwxf71">
            <p class="x-ZW8NVc x">
            <span class="span0-UxRInf manrope-medium-eerie-black-32px">Уже выбрали вашу </span
            ><span class="span1-UxRInf">сферу </span
                ><span class="span2-UxRInf manrope-medium-eerie-black-32px">деятельности?</span>
            </p>
            <div class="frame-164-ZW8NVc">
                <article class="card-lG8NdY customCard">
                    <div class="text_label-gulf4s manrope-medium-eerie-black-20px">Строительство</div>
                    <div class="categories-gulf4s">
                        <article class="button-fBnDbt">
                            <div class="text_label-GNNPur manrope-medium-eerie-black-14px">Строительные работы</div>
                        </article>
                        <article class="button-v2ZLMf">
                            <div class="text_label-1hD4j9 manrope-medium-eerie-black-14px">Контроль СР</div>
                        </article>
                        <article class="button-tkgBqO">
                            <div class="text_label-WLwkRs manrope-medium-eucalyptus-14px">+2</div>
                        </article>
                    </div>
                    <img
                            class="image-spheres-01-gulf4s image-spheres-01"
                            src="{{asset('current/img/image-spheres-01-10@2x.png')}}"
                            alt="Image-Spheres-01"
                    />
                    <img class="element-arrow-gulf4s element-arrow" src="{{asset('current/img/element-arrow-35.svg')}}" alt="element-arrow" />
                </article>
                <article class="card-WQb8ht customCard">
                    <div class="text_label-N35hu4 manrope-medium-eerie-black-20px">Импорт-экспорт</div>
                    <div class="categories-N35hu4">
                        <article class="button-ctxiwZ">
                            <div class="text_label-mRp1lr manrope-medium-eerie-black-14px">Таможенные процендуры</div>
                        </article>
                        <article class="button-EOqWna">
                            <div class="text_label-vK9xJM manrope-medium-eerie-black-14px">Траспорт</div>
                        </article>
                        <article class="button-uWBI7f">
                            <div class="text_label-WamNAp manrope-medium-eucalyptus-14px">+2</div>
                        </article>
                    </div>
                    <img
                            class="image-spheres-01-N35hu4 image-spheres-01"
                            src="{{asset('current/img/image-spheres-01-6@2x.png')}}"
                            alt="Image-Spheres-01"
                    />
                    <img class="element-arrow-N35hu4 element-arrow" src="{{asset('current/img/element-arrow-35.svg')}}" alt="element-arrow" />
                </article>
                <article class="card-9xn8CM customCard">
                    <div class="text_label-LPombo manrope-medium-eerie-black-20px">Медицина</div>
                    <div class="categories-LPombo">
                        <article class="button-GZXZFp">
                            <div class="text_label-TAfgli manrope-medium-eerie-black-14px">Медицинское оборудование</div>
                        </article>
                        <article class="button-vrxOeh">
                            <div class="text_label-1zxC0b manrope-medium-eerie-black-14px">Фарм. индустрия</div>
                        </article>
                        <article class="button-PEOK4w">
                            <div class="text_label-g843lu manrope-medium-eucalyptus-14px">+2</div>
                        </article>
                    </div>
                    <img
                            class="image-spheres-01-LPombo image-spheres-01"
                            src="{{asset('current/img/image-spheres-01-7@2x.png')}}"
                            alt="Image-Spheres-01"
                    />
                    <img class="element-arrow-LPombo element-arrow" src="{{asset('current/img/element-arrow-35.svg')}}" alt="element-arrow" />
                </article>
                <article class="card-ovmxxk customCard">
                    <div class="text_label-KikS2E manrope-medium-eerie-black-20px">Сельское хозяйство</div>
                    <div class="categories-KikS2E">
                        <article class="button-DVxppT">
                            <div class="text_label-E4g7nq manrope-medium-eerie-black-14px">Выращивание растений</div>
                        </article>
                        <article class="button-Zv4m0c">
                            <div class="text_label-hxJLiC manrope-medium-eerie-black-14px">С-х услуги</div>
                        </article>
                        <article class="button-BEwgxN">
                            <div class="text_label-zWQtKJ manrope-medium-eucalyptus-14px">+2</div>
                        </article>
                    </div>
                    <img
                            class="image-spheres-01-KikS2E image-spheres-01"
                            src="{{asset('current/img/image-spheres-01-8@2x.png')}}"
                            alt="Image-Spheres-01"
                    />
                    <img class="element-arrow-KikS2E element-arrow" src="{{asset('current/img/element-arrow-35.svg')}}" alt="element-arrow" />
                </article>
                <article class="card-muWlHJ customCard">
                    <div class="text_label-mGzSNh manrope-medium-eerie-black-20px">Культура</div>
                    <div class="categories-mGzSNh">
                        <article class="button-GbIIhx">
                            <div class="text_label-YUjtBt manrope-medium-eerie-black-14px">Кинематограф</div>
                        </article>
                        <article class="button-yh5YWq">
                            <div class="text_label-jvw6HT manrope-medium-eerie-black-14px">Искусство</div>
                        </article>
                        <article class="button-58M2W5">
                            <div class="text_label-Y0l46j manrope-medium-eucalyptus-14px">+2</div>
                        </article>
                    </div>
                    <img
                            class="image-spheres-01-mGzSNh image-spheres-01"
                            src="{{asset('current/img/image-spheres-01-9@2x.png')}}"
                            alt="Image-Spheres-01"
                    />
                    <img class="element-arrow-mGzSNh element-arrow" src="{{asset('current/img/element-arrow-35.svg')}}" alt="element-arrow" />
                </article>
            </div>
            <div class="frame-163-ZW8NVc">
                <p class="x-ld92tT x manrope-medium-eerie-black-20px">Делаем процесс лицензирования легким и доступным!</p>
                <div class="button-ld92tT">
                    <div class="text_label-T3JBS3 manrope-semi-bold-white-16px">Узнать всё о платформе</div>
                </div>
            </div>
        </div>
        <div class="categories-Y1hAoq">
            <p class="text_label-EYnDtQ">
            <span class="span0-PRNpjI manrope-medium-eerie-black-32px">Предоставляем качественные и комплексные </span
            ><span class="span1-PRNpjI">решения </span
                ><span class="span2-PRNpjI manrope-medium-eerie-black-32px">для вашего бизнеса</span>
            </p>
            <div class="frame-169-EYnDtQ">
                <article class="card-Q7bkaU customCard">
                    <div class="text_label-ePeV5y manrope-medium-eerie-black-20px">Регистрация компании</div>
                    <div class="frame-156">
                        <div class="frame-118">
                            <img class="ic-chek-I6dseV ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <div class="x-I6dseV x manrope-medium-eerie-black-14px">
                                Подготовка учредительных документов филиала/представительств
                            </div>
                        </div>
                        <div class="frame-119">
                            <img class="ic-chek-71IOCe ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <p class="text_label-71IOCe manrope-medium-eerie-black-14px">
                                Сдача документов в регистрирующий орган
                            </p>
                        </div>
                        <div class="frame-120-UUJkxy frame-120">
                            <img class="ic-chek-jOgljZ ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <div class="text_label-jOgljZ manrope-medium-eerie-black-14px">Заполнение формы на регистрацию</div>
                        </div>
                    </div>
                    <img
                            class="image-spheres-01-ePeV5y image-spheres-01"
                            src="{{asset('current/img/image-services-01-2@2x.png')}}"
                            alt="Image-Spheres-01"
                    />
                    <img class="element-arrow-ePeV5y element-arrow" src="{{asset('current/img/element-arrow-35.svg')}}" alt="element-arrow" />
                    <div class="button-ePeV5y">
                        <div class="text_label-S884BE manrope-semi-bold-eerie-black-16px">Оформить заявку</div>
                    </div>
                </article>
                <article class="card-x5OBLV customCard">
                    <p class="text_label-VklvHK manrope-medium-eerie-black-20px">Регистрация компаний в СЭЗ и МФЦА</p>
                    <div class="frame-156">
                        <div class="frame-118">
                            <img class="ic-chek-22lno8 ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <p class="x-22lno8 x manrope-medium-eerie-black-14px">
                                Регистрация в качестве участника Astana Hub International Technology Park
                            </p>
                        </div>
                    </div>
                    <img
                            class="image-spheres-01-VklvHK image-spheres-01"
                            src="{{asset('current/img/image-services-02-2@2x.png')}}"
                            alt="Image-Spheres-01"
                    />
                    <img class="element-arrow-VklvHK element-arrow" src="{{asset('current/img/element-arrow-35.svg')}}" alt="element-arrow" />
                    <div class="button-VklvHK">
                        <div class="text_label-uPaNn3 manrope-semi-bold-eerie-black-16px">Оформить заявку</div>
                    </div>
                </article>
                <article class="card-AjF9Nx customCard">
                    <div class="text_label-NZKw0A manrope-medium-eerie-black-20px">Открытие банковских счетов</div>
                    <div class="frame-156">
                        <div class="frame-118">
                            <img class="ic-chek-OBECw3 ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <div class="x-OBECw3 x manrope-medium-eerie-black-14px">Сбор документов</div>
                        </div>
                        <div class="frame-119">
                            <img class="ic-chek-eexPxT ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <p class="text_label-eexPxT manrope-medium-eerie-black-14px">Подавка заявки на открытие счета</p>
                        </div>
                    </div>
                    <img
                            class="image-spheres-01-NZKw0A image-spheres-01"
                            src="{{asset('current/img/image-services-03-2@2x.png')}}"
                            alt="Image-Spheres-01"
                    />
                    <img class="element-arrow-NZKw0A element-arrow" src="{{asset('current/img/element-arrow-35.svg')}}" alt="element-arrow" />
                    <div class="button-NZKw0A">
                        <div class="text_label-I6viOr manrope-semi-bold-eerie-black-16px">Оформить заявку</div>
                    </div>
                </article>
                <article class="card-bCRnG8 customCard">
                    <div class="text_label-28NtQc manrope-medium-eerie-black-20px">Лицензирование</div>
                    <div class="frame-156">
                        <div class="frame-118">
                            <img class="ic-chek-avLH5i ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <p class="x-avLH5i x manrope-medium-eerie-black-14px">
                                Получение лицензий и разрешительных документов для всех видов деятельности
                            </p>
                        </div>
                    </div>
                    <img
                            class="image-spheres-01-28NtQc image-spheres-01"
                            src="{{asset('current/img/image-services-04-2@2x.png')}}"
                            alt="Image-Spheres-01"
                    />
                    <img class="element-arrow-28NtQc element-arrow" src="{{asset('current/img/element-arrow-35.svg')}}" alt="element-arrow" />
                    <div class="button-28NtQc">
                        <div class="text_label-nFw2M5 manrope-semi-bold-eerie-black-16px">Оформить заявку</div>
                    </div>
                </article>
                <article class="card-hSxZMk customCard">
                    <p class="text_label-cbnEOM manrope-medium-eerie-black-20px">Получение визы С3 и С5</p>
                    <div class="frame-156">
                        <div class="frame-118">
                            <img class="ic-chek-qDHaux ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <p class="x-qDHaux x manrope-medium-eerie-black-14px">Сбор документов и оформление приглашения</p>
                        </div>
                        <div class="frame-119">
                            <img class="ic-chek-sKv4fF ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <p class="text_label-sKv4fF manrope-medium-eerie-black-14px">Оформление визы в консульстве РК</p>
                        </div>
                        <div class="frame-120-hQUaqr frame-120">
                            <img class="ic-chek-EH5BGf ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <div class="text_label-EH5BGf manrope-medium-eerie-black-14px">Заполнение формы на регистрацию</div>
                        </div>
                    </div>
                    <img
                            class="image-spheres-01-cbnEOM image-spheres-01"
                            src="{{asset('current/img/image-services-05-2@2x.png')}}"
                            alt="Image-Spheres-01"
                    />
                    <img class="element-arrow-cbnEOM element-arrow" src="{{asset('current/img/element-arrow-35.svg')}}" alt="element-arrow" />
                    <div class="button-cbnEOM">
                        <div class="text_label-15bF5A manrope-semi-bold-eerie-black-16px">Оформить заявку</div>
                    </div>
                </article>
                <article class="card-q9vfnj customCard">
                    <div class="text_label-BlzKuy manrope-medium-eerie-black-20px">Предоставление отраслевого юриста</div>
                    <div class="frame-156">
                        <div class="frame-118">
                            <img class="ic-chek-BaiueI ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <p class="x-BaiueI x manrope-medium-eerie-black-14px">
                                Услуги юриста на аутсорсинге для вашего бизнеса
                            </p>
                        </div>
                    </div>
                    <img
                            class="image-spheres-01-BlzKuy image-spheres-01"
                            src="{{asset('current/img/image-services-06-2@2x.png')}}"
                            alt="Image-Spheres-01"
                    />
                    <img class="element-arrow-BlzKuy element-arrow" src="{{asset('current/img/element-arrow-35.svg')}}" alt="element-arrow" />
                    <div class="button-BlzKuy">
                        <div class="text_label-Sdragt manrope-semi-bold-eerie-black-16px">Оформить заявку</div>
                    </div>
                </article>
                <article class="card-fB2pQ8 customCard">
                    <div class="text_label-LnBYB2 manrope-medium-eerie-black-20px">Бухгалтерский аутсорсинг</div>
                    <div class="frame-156">
                        <div class="frame-118">
                            <img class="ic-chek-TxRRsO ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <p class="x-TxRRsO x manrope-medium-eerie-black-14px">
                                Подписание документов в банке (работа с менеджером банка)
                            </p>
                        </div>
                        <div class="frame-119">
                            <img class="ic-chek-jO48eR ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <div class="text_label-jO48eR manrope-medium-eerie-black-14px">Сбор данных клиентов</div>
                        </div>
                    </div>
                    <img
                            class="image-spheres-01-LnBYB2 image-spheres-01"
                            src="{{asset('current/img/image-services-07-2@2x.png')}}"
                            alt="Image-Spheres-01"
                    />
                    <img class="element-arrow-LnBYB2 element-arrow" src="{{asset('current/img/element-arrow-35.svg')}}" alt="element-arrow" />
                    <div class="button-LnBYB2">
                        <div class="text_label-tfRLrD manrope-semi-bold-eerie-black-16px">Оформить заявку</div>
                    </div>
                </article>
                <article class="card-vzIlUo customCard">
                    <div class="text_label-x90g8t manrope-medium-eerie-black-20px">Дополнительные услуги</div>
                    <div class="frame-156">
                        <div class="frame-118">
                            <img class="ic-chek-74QXn7 ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <div class="x-74QXn7 x manrope-medium-eerie-black-14px">Получение ИИН, БИН</div>
                        </div>
                        <div class="frame-119">
                            <img class="ic-chek-ySJsiR ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <div class="text_label-ySJsiR manrope-medium-eerie-black-14px">Получение ЭЦП</div>
                        </div>
                        <div class="frame-120-x4aoxB frame-120">
                            <img class="ic-chek-EHJ03G ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <div class="text_label-EHJ03G manrope-medium-eerie-black-14px">Оформление РВП</div>
                        </div>
                    </div>
                    <img
                            class="image-spheres-01-x90g8t image-spheres-01"
                            src="{{asset('current/img/image-services-08-2@2x.png')}}"
                            alt="Image-Spheres-01"
                    />
                    <img class="element-arrow-x90g8t element-arrow" src="{{asset('current/img/element-arrow-35.svg')}}" alt="element-arrow" />
                    <div class="button-x90g8t">
                        <div class="text_label-WlOVUL manrope-semi-bold-eerie-black-16px">Оформить заявку</div>
                    </div>
                </article>
            </div>
        </div>
        <div class="categories-vQKjAi">
            <div class="uppercase-1gesmz manrope-medium-eerie-black-32px">О группе UPPERCASE</div>
            <div class="frame-173-1gesmz">
                <div class="frame-170-9oMBL6">
                    <h1 class="title-9Viras">3000+</h1>
                    <p class="x-9Viras x manrope-medium-mountain-mist-14px">
                        Клиентов в области регистрации, лицензирования, сопровождения международных сделок и корпоративного
                        права
                    </p>
                </div>
                <img class="line-37-9oMBL6" src="{{asset('current/img/line-37-1.svg')}}" alt="Line 37" />
                <div class="frame-171-9oMBL6">
                    <div class="txt01-NWxxI7 txt01">
                        <div class="x13-NE8CZ0 manrope-medium-eerie-black-32px">13+ лет</div>
                        <p class="text_label-NE8CZ0 manrope-medium-mountain-mist-14px">
                            На рынке юридических услуг и консалтинга
                        </p>
                    </div>
                    <div class="txt02">
                        <div class="x6-pPihwQ manrope-medium-eerie-black-32px">6</div>
                        <p class="text_label-pPihwQ manrope-medium-mountain-mist-14px">Филиалов в ОАЭ и РК</p>
                    </div>
                </div>
                <img class="line-36-9oMBL6" src="{{asset('current/img/line-37-1.svg')}}" alt="Line 36" />
                <div class="txt01-9oMBL6 txt01">
                    <div class="it-Sgdfzk manrope-medium-eerie-black-32px">IT-решения</div>
                    <p class="text_label-Sgdfzk manrope-medium-mountain-mist-14px">
                        В области юридических услуг и консалтинга
                    </p>
                </div>
                <img class="line-38-9oMBL6" src="{{asset('current/img/line-37-1.svg')}}" alt="Line 38" />
                <div class="frame-172-9oMBL6">
                    <div class="txt02">
                        <div class="x500-x1I06Z manrope-medium-eerie-black-32px">500+</div>
                        <div class="text_label-x1I06Z manrope-medium-mountain-mist-14px">Успешно завершенных проектов</div>
                    </div>
                    <div class="txt02">
                        <div class="x300-QVpWWp manrope-medium-eerie-black-32px">300+</div>
                        <div class="text_label-QVpWWp manrope-medium-mountain-mist-14px">Опытных специалистов в команде</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="frame-175-rwxf71">
            <div class="group-30-NIc4ev">
                <div class="rectangle-106-llal85"></div>
                <img class="image-personal-area-llal85" src="{{asset('current/img/image-personalarea-2.png')}}" alt="Image-PersonalArea" />
            </div>
            <div class="frame-159-NIc4ev frame-159">
                <div class="txt-57f9f0 txt">
                    <p class="text_label-wsAiuV manrope-medium-white-20px">
                        Пользователю портала предоставляется простой и удобный личный кабинет
                    </p>
                    <div class="frame-156">
                        <div class="frame-118">
                            <img class="ic-chek-Q4xQ0J ic-chek" src="{{asset('current/img/ic-chek-118.svg')}}" alt="ic-chek" />
                            <div class="text_label-Q4xQ0J manrope-medium-white-14px">Отслеживание статус заказанных услуг</div>
                        </div>
                        <div class="frame-119">
                            <img class="ic-chek-EjMxUg ic-chek" src="{{asset('current/img/ic-chek-118.svg')}}" alt="ic-chek" />
                            <p class="text_label-EjMxUg manrope-medium-white-14px">Создание надежного архива ваших документов</p>
                        </div>
                        <div class="frame-120-UwU1Iz frame-120">
                            <img class="ic-chek-BLg2ad ic-chek" src="{{asset('current/img/ic-chek-118.svg')}}" alt="ic-chek" />
                            <div class="text_label-BLg2ad manrope-medium-white-14px">
                                Получение специализированных отраслевых услуг
                            </div>
                        </div>
                    </div>
                    <div class="button-wsAiuV">
                        <div class="text_label-knDCJz manrope-semi-bold-eucalyptus-16px">Получить консультацию</div>
                    </div>
                </div>
                <div class="frame-158">
                    <div class="x01-04 manrope-medium-black-haze-16px">01 / 04</div>
                    <div class="frame-71">
                        <article class="arrow-right-KBMWKJ arrow-right" src="{{asset('current/img/arrow-right-52.svg')}}" alt="arrow-right" />
                        <article class="arrow-right-rcX39b arrow-right" src="{{asset('current/img/arrow-right-53.svg')}}" alt="arrow-right" />
                    </div>
                </div>
            </div>
        </div>
        <div class="categories-jp4fGa">
            <div class="text_label-o0RQPQ manrope-medium-eerie-black-32px">Кейсы наших клиентов</div>
            <img class="line-39-o0RQPQ" src="{{asset('current/img/line-39-1.svg')}}" alt="Line 39" />
            <div class="left-o0RQPQ">
                <p class="text_label-oeTGxj manrope-medium-eerie-black-20px">
                    Розничная торговля путём заказа товаров по почте
                </p>
                <div class="frame-155-oeTGxj">
                    <div class="image-logo-PioEvF">
                        <img class="image-54-JfmqDP" src="{{asset('current/img/image-54-2@2x.png')}}" alt="image 54" />
                    </div>
                    <div class="frame-154-PioEvF">
                        <div class="text_label-yqxCR7 manrope-medium-eerie-black-16px">Технониколь</div>
                        <p class="text_label-lJNaym manrope-medium-mountain-mist-14px">
                            Производитель строительных материалов и систем
                        </p>
                    </div>
                </div>
                <div class="button-oeTGxj">
                    <div class="x-PcPeDx x manrope-semi-bold-eerie-black-16px">Смотреть видео-отзыв</div>
                    <img class="polygon-1-PcPeDx" src="{{asset('current/img/polygon-1-3.svg')}}" alt="Polygon 1" />
                </div>
            </div>
            <div class="right-o0RQPQ">
                <div class="frame-130-PIhf75">
                    <div class="text_label-EqrrUc manrope-medium-eerie-black-20px">Входные параметры</div>
                    <div class="frame-120-EqrrUc frame-120">
                        <div class="frame-118">
                            <img class="ic-chek-hWhffL ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <p class="x7-1-hWhffL manrope-medium-mountain-mist-14px">
                                В короткие сроки (7 рабочих дней) получить лицензию на проведение строительно-монтажных работ
                                1 категории.
                            </p>
                        </div>
                        <div class="frame-119">
                            <img class="ic-chek-r3V1uD ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                            <p class="x-r3V1uD x manrope-medium-mountain-mist-14px">
                                Получить консультирование отраслевого юриста по квалификационным требованиям и нормативно-правовым
                                актам в сфере строительства.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="frame-129-PIhf75">
                    <div class="text_label-pL50ln manrope-medium-eerie-black-20px">Решение</div>
                    <div class="frame-120-pL50ln frame-120">
                        <div class="frame-128-OAakkC">
                            <div class="frame-118">
                                <img class="ic-chek-5GHVxT ic-chek" src="{{asset('current/img/ic-chek-103.svg')}}" alt="ic-chek" />
                                <p class="x-5GHVxT x manrope-medium-mountain-mist-14px">
                                    Получение консультации отраслевого юриста. Консультация опытного юриста по вопросам
                                    квалификационных требований и нормативно-правовых актов в сфере строительства.
                                </p>
                            </div>
                            <div class="frame-119">
                                <img class="ic-chek-su5Nx5 ic-chek" src="{{asset('current/img/rectangle-95-45@2x.png')}}" alt="ic-chek" />
                                <p class="x-su5Nx5 x manrope-medium-mountain-mist-14px">
                                    Советы и рекомендации по подготовке документов и прохождению процедуры лицензирования.
                                </p>
                            </div>
                            <div class="frame-120-U9RWaC frame-120">
                                <img class="ic-chek-WyTeeD ic-chek" src="{{asset('current/img/rectangle-95-45@2x.png')}}" alt="ic-chek" />
                                <div class="text_label-WyTeeD manrope-medium-mountain-mist-14px">
                                    Подготовка необходимого пакета документов
                                </div>
                            </div>
                            <div class="frame-121-U9RWaC">
                                <img class="ic-chek-TLVbxa ic-chek" src="{{asset('current/img/rectangle-95-45@2x.png')}}" alt="ic-chek" />
                                <p class="x-TLVbxa x manrope-medium-eerie-black-16px">
                                    Составление полного списка и подготовка всех необходимых документов.
                                </p>
                            </div>
                            <div class="frame-122-U9RWaC">
                                <img class="ic-chek-wuz33g ic-chek" src="{{asset('current/img/rectangle-95-45@2x.png')}}" alt="ic-chek" />
                                <p class="text_label-wuz33g manrope-medium-eerie-black-16px">
                                    Обращение в орган регулирования и подача заявления
                                </p>
                            </div>
                            <div class="frame-123-U9RWaC">
                                <img class="ic-chek-hyjfbA ic-chek" src="{{asset('current/img/rectangle-95-45@2x.png')}}" alt="ic-chek" />
                                <p class="x-hyjfbA x manrope-medium-eerie-black-16px">
                                    Подача полного и правильно заполненного заявления в соответствующий орган, оплата необходимых
                                    сборов.
                                </p>
                            </div>
                            <div class="frame-124-U9RWaC">
                                <img class="ic-chek-v00hSc ic-chek" src="{{asset('current/img/rectangle-95-45@2x.png')}}" alt="ic-chek" />
                                <div class="x-v00hSc x manrope-medium-eerie-black-16px">
                                    Проведение экспресс-аудита и подготовка к проверке
                                </div>
                            </div>
                            <div class="frame-125-U9RWaC">
                                <img class="ic-chek-dzzuDt ic-chek" src="{{asset('current/img/rectangle-95-45@2x.png')}}" alt="ic-chek" />
                                <div class="text_label-dzzuDt manrope-medium-eerie-black-16px">
                                    Согласование с регулятором и получение лицензии
                                </div>
                            </div>
                            <div class="frame-126-U9RWaC">
                                <img class="ic-chek-0ksOdC ic-chek" src="{{asset('current/img/rectangle-95-45@2x.png')}}" alt="ic-chek" />
                                <p class="x1-0ksOdC manrope-medium-eerie-black-16px">
                                    Получение лицензии на проведение строительно-монтажных работ 1 категории.
                                </p>
                            </div>
                        </div>
                        <div class="button-OAakkC">
                            <div class="text_label-MgxqYL manrope-medium-eucalyptus-14px">Показать полностью</div>
                        </div>
                    </div>
                </div>
                <div class="frame-131-PIhf75">
                    <div class="text_label-Rjq7jc manrope-medium-white-20px">Результат</div>
                    <div class="frame-120-Rjq7jc frame-120">
                        <div class="frame-118">
                            <img class="ic-chek-a8z5QZ ic-chek" src="{{asset('current/img/ic-chek-118.svg')}}" alt="ic-chek" />
                            <p class="x1-a8z5QZ manrope-medium-white-14px">
                                В результате успешной реализации этого кейса, компания смогла получить лицензию на проведение
                                строительно-монтажных работ 1 категории в короткие сроки, а также получила консультацию отраслевого
                                юриста, что позволило ей эффективно соблюсти все требования и нормативы в сфере строительства
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="frame-176">
                <article class="arrow-right-CpvCTa arrow-right" src="{{asset('current/img/arrow-right-54.svg')}}" alt="arrow-right" />
                <article class="arrow-right-bxHhcR arrow-right" src="{{asset('current/img/arrow-right-55.svg')}}" alt="arrow-right" />
            </div>
        </div>
        <div class="form-rwxf71">
            <div class="text_label-q1rxKl manrope-medium-eerie-black-32px">Свяжитесь с нами</div>
            <p class="text_label-opC4Nx manrope-medium-eerie-black-14px">
                Предоставимтбыстрое и эффективное открытие и ведение бизнеса в Казахстане
            </p>
            <div class="frame-177-q1rxKl">
                <div class="frame-149-b20BCX">
                    <div class="text_label-CPZojx manrope-semi-bold-eerie-black-16px">Представьтесь пожалуйста</div>
                    <div class="input-CPZojx input">
                        <div class="x-XVKOCJ x manrope-semi-bold-mountain-mist-16px">Ф.И.О</div>
                    </div>
                </div>
                <div class="frame-150-b20BCX">
                    <div class="text_label-K0tyvy manrope-semi-bold-eerie-black-16px">Услуга</div>
                    <div class="input-K0tyvy input">
                        <div class="text_label-jUoOHp manrope-semi-bold-mountain-mist-16px">Выберите услугу</div>
                        <img class="arrow-up-jUoOHp" src="{{asset('current/img/arrow-up-5.svg')}}" alt="arrow-up" />
                    </div>
                </div>
                <div class="frame-151-b20BCX">
                    <div class="text_label-xnIP9t manrope-semi-bold-eerie-black-16px">Электронная почта</div>
                    <div class="input-xnIP9t input">
                        <div class="examplegmailcom-fhJAU9 manrope-semi-bold-mountain-mist-16px">example@gmail.com</div>
                    </div>
                </div>
                <div class="frame-152-b20BCX">
                    <div class="text_label-BEhgL4 manrope-semi-bold-eerie-black-16px">Телефон</div>
                    <div class="input-BEhgL4 input">
                        <div class="x8-___-___-__-__-LyNVSS manrope-semi-bold-mountain-mist-16px">8 (___) ___-__-__</div>
                    </div>
                </div>
                <div class="frame-153-b20BCX">
                    <div class="text_label-UgdnhA manrope-semi-bold-eerie-black-16px">Комментарий</div>
                    <div class="input-UgdnhA input">
                        <div class="text_label-7ocO1H manrope-semi-bold-mountain-mist-16px">Оставьте свой комментарий</div>
                    </div>
                </div>
                <div class="button-b20BCX">
                    <div class="text_label-MRYc4E manrope-semi-bold-white-16px">Получить консультацию</div>
                </div>
                <p class="x-b20BCX x manrope-semi-bold-eerie-black-14px">
              <span class="span0-bXszWl manrope-semi-bold-eerie-black-14px">Нажимая на кнопку, я соглашаюсь на </span
              ><a href="https://skillbox.ru/privacy_policy.pdf" target="_blank"
                    ><span class="span1-bXszWl manrope-semi-bold-eerie-black-14px">обработку персональных данных</span></a
                    ><span class="span2-bXszWl manrope-semi-bold-eerie-black-14px">&nbsp;</span>
                </p>
                <img class="rectangle-95-b20BCX rectangle-95" src="{{asset('current/img/element-arrow-35.svg')}}" alt="Rectangle 95" />
            </div>
        </div>
        <div class="logos-rwxf71">
            <div class="text_label-v65q4f manrope-medium-eerie-black-32px">Нам доверяют</div>
            <div class="frame-133-v65q4f">
                <div class="logo-kalugin-light"><img class="image-48" src="{{asset('current/img/image-48-2@2x.png')}}" alt="image 48" /></div>
                <div class="logo-simax-light-WxtvHq">
                    <img class="image-53-x2R4LD" src="{{asset('current/img/image-53-2@2x.png')}}" alt="image 53" />
                </div>
                <div class="logo-metprom-light-WxtvHq">
                    <img class="image-49-BdVpKP" src="{{asset('current/img/image-49-2@2x.png')}}" alt="image 49" />
                </div>
                <div class="logo-usp-light-WxtvHq">
                    <img class="image-51-Z7beKX" src="{{asset('current/img/image-51-4@2x.png')}}" alt="image 51" />
                </div>
                <div class="logo-crcc-light-WxtvHq">
                    <img class="image-50-tgh5rO" src="{{asset('current/img/image-50-2@2x.png')}}" alt="image 50" />
                </div>
                <div class="logo-kalugin-light"><img class="image-48" src="{{asset('current/img/image-48-2@2x.png')}}" alt="image 48" /></div>
            </div>
            <div class="frame-176">
                <article class="arrow-right-fk78p2 arrow-right" src="{{asset('current/img/arrow-right-54.svg')}}" alt="arrow-right" />
                <article class="arrow-right-oW53Hw arrow-right" src="{{asset('current/img/arrow-right-55.svg')}}" alt="arrow-right" />
            </div>
        </div>
        <div class="qa-rwxf71" id="faq">
            <div class="text_label-iiACF6 manrope-medium-eerie-black-32px">Ответы на вопросы</div>
            <div class="frame-68-iiACF6">
                <div class="button-90M7us">
                    <p class="x-BKxRHF x manrope-medium-eerie-black-16px">Каковы сроки регистрации бизнеса в Казахстане?</p>
                    <img class="component-1" src="{{asset('current/img/component-1-23.svg')}}" alt="Component 1" />
                </div>
                <div class="button-qcFJlS">
                    <div class="frame-69-R2UCXL">
                        <p class="x-FQ9JW9 x manrope-medium-eerie-black-16px">
                            Какие основные требования для регистрации компании в Казахстане?
                        </p>
                        <p class="x-H2jRyp x manrope-medium-eerie-black-14px">
                            Предоставим&nbsp;&nbsp;быстрое и эффективное открытие и ведение бизнеса в Казахстане. В остальных
                            случаях расчетный счет можно открыть за один день. Сразу после подачи заявки вы получите реквизиты и
                            сможете выставлять счета на оплату. После встречи с представителем банка появится возможность
                            принимать деньги и совершать исходящие платежи.
                        </p>
                    </div>
                    <img class="component-1" src="{{asset('current/img/component-1-21.svg')}}" alt="Component 1" />
                </div>
                <div class="button-n3xE3p">
                    <p class="x-KQnXPv x manrope-medium-eerie-black-16px">
                        Какие документы понадобятся для регистрации юридического лица в Казахстане?
                    </p>
                    <img class="component-1" src="{{asset('current/img/component-1-23.svg')}}" alt="Component 1" />
                </div>
                <div class="button-0kuWeZ">
                    <p class="x-fIgxhv x manrope-medium-eerie-black-16px">
                        Можно ли в казахстанском банке открыть счет для ИП удаленно?
                    </p>
                    <img class="component-1" src="{{asset('current/img/component-1-23.svg')}}" alt="Component 1" />
                </div>
                <div class="button-mfIAUH">
                    <p class="x-expGsP x manrope-medium-eerie-black-16px">Какие налоги потребуется платить в Казахстане?</p>
                    <img class="component-1" src="{{asset('current/img/component-1-23.svg')}}" alt="Component 1" />
                </div>
                <div class="button-Hrxrcr">
                    <p class="x-ji7zyV x manrope-medium-eerie-black-16px">
                        Как долго обычно занимает процесс получения разрешений в стране?
                    </p>
                    <img class="component-1" src="{{asset('current/img/component-1-23.svg')}}" alt="Component 1" />
                </div>
                <div class="button-uvzdWH">
                    <p class="x-BSvceY x manrope-medium-eerie-black-16px">
                        Какие отрасли и виды деятельности подлежат обязательной лицензированию в Казахстане?
                    </p>
                    <img class="component-1" src="{{asset('current/img/component-1-23.svg')}}" alt="Component 1" />
                </div>
            </div>
        </div>
        <footer class="footer-rwxf71">
            <img class="x1-odGaMm" src="{{asset('current/img/----------1-1.svg')}}" alt="1" />
            <div class="links-odGaMm">
                <div class="text_label-djP4iT manrope-medium-eerie-black-14px">О компании</div>
                <div class="text_label-ApaV4j manrope-medium-eerie-black-14px">Регистрация компании</div>
                <div class="text_label-6pqMQ2 manrope-medium-eerie-black-14px">Лицензирование</div>
                <div class="text_label-p8g4bM manrope-medium-eerie-black-14px">Открытие счетов</div>
                <div class="text_label-jyKJAx manrope-medium-eerie-black-14px">Блог</div>
            </div>
            <div class="text_label-odGaMm manrope-medium-mountain-mist-14px">Меню</div>
            <div class="text_label-YxDvcW manrope-medium-mountain-mist-14px">Контактный центр</div>
            <div class="frame-81-odGaMm">
                <div class="x7-747-135-0000-oSxxgC manrope-medium-eerie-black-28px">+7 (747) 135-0000</div>
                <img class="arrow-right-oSxxgC arrow-right" src="{{asset('current/img/arrow-right-36.svg')}}" alt="arrow-right" />
            </div>
            <div class="text_label-Bi47ey manrope-medium-mountain-mist-14px">Напишите на почту</div>
            <div class="frame-80-odGaMm">
                <div class="infolicensekz-w2ATEu manrope-medium-eerie-black-28px">info@license.kz</div>
                <img class="arrow-right-w2ATEu arrow-right" src="{{asset('current/img/arrow-right-36.svg')}}" alt="arrow-right" />
            </div>
            <div class="text_label-LWSlKk manrope-medium-mountain-mist-14px">Мы в социальных сетях</div>
            <div class="social-odGaMm">
                <div class="ic-facebook-rZHBxj">
                    <div class="ellipse"></div>
                    <img class="image-1-traced-sy2VQ5" src="{{asset('current/img/image-1--traced--1.svg')}}" alt="image 1 (Traced)" />
                </div>
                <div class="ic-instagramm-rZHBxj">
                    <div class="ellipse"></div>
                    <img class="vector-HDs9Ku vector" src="{{asset('current/img/vector-4.svg')}}" alt="Vector" />
                </div>
                <div class="ic-linkedin-rZHBxj">
                    <div class="ellipse"></div>
                    <img class="vector-FxgOSC vector" src="{{asset('current/img/vector-5.svg')}}" alt="Vector" />
                </div>
                <div class="ic-youtube-rZHBxj">
                    <div class="ellipse"></div>
                    <img class="vector-Ky8N5X vector" src="{{asset('current/img/vector-6.svg')}}" alt="Vector" />
                </div>
                <div class="ic-telegramm-rZHBxj">
                    <div class="ellipse"></div>
                    <img class="vector-EBzobb vector" src="{{asset('current/img/vector-7.svg')}}" alt="Vector" />
                </div>
            </div>
            <div class="x2023-upperlicense-odGaMm manrope-medium-eerie-black-12px">©2024 UPPERLICENSE</div>
            <p class="upperlicense-odGaMm">
                UPPERLICENSE не является государственным органом и не представляет какой-либо официальный орган. Все
                названия продуктов, логотипы и бренды являются собственностью их владельцев. Все названия компаний, органов
                власти, реестра, продуктов и услуг, используемые на этом веб-сайте, используются только в целях
                идентификации. Использование этих названий, логотипов и брендов не означает одобрения.
            </p>
            <div class="text_label-8qxArQ manrope-medium-eerie-black-12px">Политика конфиденциальности</div>
            <img class="line-17-odGaMm" src="{{asset('current/img/line-39-1.svg')}}" alt="Line 17" />
        </footer>
        <div class="road-map-rwxf71">
            <div class="upperlicense-road-map-xvA8LZ manrope-medium-eerie-black-32px">UPPERLICENSE RoadMap</div>
            <div class="frame-181-xvA8LZ">
                <div class="dates-cVncZq">
                    <div class="date">
                        <div class="x2023-BR0Vss manrope-medium-mountain-mist-14px">2023</div>
                        <div class="x20-BR0Vss x20">20 декабря</div>
                    </div>
                    <div class="date">
                        <div class="x2024 manrope-medium-mountain-mist-14px">2024</div>
                        <div class="x20 manrope-medium-eerie-black-20px">20 января</div>
                    </div>
                    <div class="date">
                        <div class="x2024 manrope-medium-mountain-mist-14px">2024</div>
                        <div class="x26-emcVhM manrope-medium-eerie-black-20px">26 января</div>
                    </div>
                    <div class="date">
                        <div class="x2024 manrope-medium-mountain-mist-14px">2024</div>
                        <div class="x30-Z82h29 manrope-medium-eerie-black-20px">30 января</div>
                    </div>
                </div>
                <div class="progressbar-cVncZq">
                    <img class="line-40-d1poO7" src="{{asset('current/img/line-40-4.svg')}}" alt="Line 40" />
                    <img class="line-41-d1poO7" src="{{asset('current/img/line-41-4.svg')}}" alt="Line 41" />
                    <div class="dot-active-d1poO7">
                        <div class="ellipse-1382-i4xdxe ellipse-1382"></div>
                        <img class="ic-chek-i4xdxe ic-chek" src="{{asset('current/img/ic-chek-133.svg')}}" alt="ic-chek" />
                    </div>
                    <div class="dot-d1poO7 dot">
                        <div class="ellipse-1382-PmqSyj ellipse-1382"></div>
                        <img class="ic-chek-PmqSyj ic-chek" src="{{asset('current/img/ic-chek-134.svg')}}" alt="ic-chek" />
                    </div>
                    <div class="dot-HvN95y dot">
                        <div class="ellipse-1382-VRKIZz ellipse-1382"></div>
                        <img class="ic-chek-VRKIZz ic-chek" src="{{asset('current/img/rectangle-95-45@2x.png')}}" alt="ic-chek" />
                    </div>
                    <div class="dot-5z3eIx dot">
                        <div class="ellipse-1382-HfkLt1 ellipse-1382"></div>
                        <img class="ic-chek-HfkLt1 ic-chek" src="{{asset('current/img/rectangle-95-45@2x.png')}}" alt="ic-chek" />
                    </div>
                </div>
                <div class="frame-184-cVncZq">
                    <div class="card-nLKnlV customCard">
                        <div class="image-roadmap-04">
                            <img class="image-zTx9nM image" src="{{asset('current/img/image-22.png')}}" alt="image" />
                            <img class="rectangle-95-zTx9nM rectangle-95" src="{{asset('current/img/rectangle-95-38.svg')}}" alt="Rectangle 95" />
                            <img class="rectangle-96-zTx9nM rectangle-96" src="{{asset('current/img/rectangle-96-34.svg')}}" alt="Rectangle 96" />
                        </div>
                        <div class="frame-135"><div class="mvp-CNBGse manrope-medium-eerie-black-16px">Запуск MVP</div></div>
                        <img
                                class="attention-info_circle-CkTBlx attention-info_circle"
                                src="{{asset('current/img/attention---info-circle-18.svg')}}"
                                alt="attention / info_circle"
                        />
                    </div>
                    <div class="card-AlWU3H customCard">
                        <div class="image-roadmap-04">
                            <img class="image-d1Bwkn image" src="{{asset('current/img/image-23.png')}}" alt="image" />
                            <img class="rectangle-95-d1Bwkn rectangle-95" src="{{asset('current/img/rectangle-95-38.svg')}}" alt="Rectangle 95" />
                            <img class="rectangle-96-d1Bwkn rectangle-96" src="{{asset('current/img/rectangle-96-34.svg')}}" alt="Rectangle 96" />
                        </div>
                        <div class="frame-135">
                            <div class="text_label-AoNyfX manrope-medium-eerie-black-16px">Расширение перечня услуг</div>
                        </div>
                        <img
                                class="attention-info_circle-kdGa9O attention-info_circle"
                                src="{{asset('current/img/attention---info-circle-19@2x.png')}}"
                                alt="attention / info_circle"
                        />
                    </div>
                    <div class="card-qxAgmH customCard">
                        <div class="image-roadmap-04">
                            <img class="image-8nkxed image" src="{{asset('current/img/image-24.png')}}" alt="image" />
                            <img class="rectangle-95-8nkxed rectangle-95" src="{{asset('current/img/rectangle-95-45@2x.png')}}" alt="Rectangle 95" />
                            <img class="rectangle-96-8nkxed rectangle-96" src="{{asset('current/img/rectangle-95-45@2x.png')}}" alt="Rectangle 96" />
                        </div>
                        <div class="frame-135">
                            <div class="text_label-OaVXYv manrope-medium-eerie-black-16px">Упрощенная оплата</div>
                        </div>
                        <img
                                class="attention-info_circle-0avF4p attention-info_circle"
                                src="{{asset('current/img/rectangle-95-45@2x.png')}}"
                                alt="attention / info_circle"
                        />
                    </div>
                    <div class="card-ex5b7O customCard">
                        <div class="image-roadmap-04">
                            <img class="image-3rAmhE image" src="{{asset('current/img/image-25.png')}}" alt="image" />
                            <img class="rectangle-95-3rAmhE rectangle-95" src="{{asset('current/img/rectangle-95-45@2x.png')}}" alt="Rectangle 95" />
                            <img class="rectangle-96-3rAmhE rectangle-96" src="{{asset('current/img/rectangle-95-45@2x.png')}}" alt="Rectangle 96" />
                        </div>
                        <div class="frame-135">
                            <div class="text_label-eDFxVx manrope-medium-eerie-black-16px">Реферальная система</div>
                        </div>
                        <img
                                class="attention-info_circle-MHYVkS attention-info_circle"
                                src="{{asset('current/img/rectangle-95-45@2x.png')}}"
                                alt="attention / info_circle"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modals">
    <div class="modal fade" id="consultModal" tabindex="-1" aria-labelledby="consultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <button type="button" class="btn modal_close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="bi bi-x modals__icon"></i></button>


                <div class="modal-body">
                    <p class="modals__title-head">Менеджер перезвонит и проконсультирует вас</p>
                    {!! Form::open(['url' => route('callMe'), 'method' => 'post', 'class' => 'callMe']) !!}
                    <input type="hidden" name="tags" value="Callback">
                    <input type="hidden" name="comment" value="Заказ звонка">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <input type="text" class="form-control modals__input" name="name"
                                       placeholder="Ваше имя" required>
                            </div>
                            <div class="col-lg-6 col-12">
                                <input type="text" class="form-control modals__input" name="phone"
                                       placeholder="Ваш телефон*" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success modals__success_btn">Отправить</button>
                    <p class="modals__title-description">Нажимая кнопку отправить вы даете разрешение на обработку
                        персональных данных</p>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
    @php
        if(optional($errors)->login){
            $loginError = $errors->login;
        }
        if(optional($errors)->register){
            $registerError = $errors->register;
        }
    @endphp
    @include('new.partials.modal.login', ['loginError' => $loginError, 'registerError' => $registerError])

</div>
<script type="text/javascript" src="{{asset('/current/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('libs/jquery-3.5.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('libs/jquerymask/dist/jquery.mask.js')}}"></script>
<script type="text/javascript" src="{{asset('libs/jquery.inputmask.min.js')}}"></script>
<script type="text/javascript" src="{{asset('libs/jqueryform/dist/jquery.form.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/customScript.js')}}"></script>
<script type="text/javascript" src="{{asset('libs/jquery-ui.min.js')}}"></script>
<script src="https://www.google.com/recaptcha/api.js?render={{ env('GOOGLE_RECAPTCHA_KEY') }}"></script>
<script>
    function showLoginTab(activeTabId, clickedElm){
        $('.new_modal_login_main_tab_header_item').removeClass('active')
        $(clickedElm).addClass('active')

        $('.new_modal_login_main_tab_pane').removeClass('active')
        $(activeTabId).addClass('active')
    }

    function setRecaptcha(formId){
        grecaptcha.ready(function () {
            grecaptcha.execute("{{ env('GOOGLE_RECAPTCHA_KEY') }}", {action: 'submit'}).then(function (token) {
                $(formId).prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
                $(document).off('submit', formId)
                $(formId).unbind('submit').submit();
            });
        });
    }

    $(document).ready(function () {
        $('body').click((e) => {
            // e.preventDefault();
            // e.stopPropagation();
            $('.menu_services').removeClass('open')
            $('.new_main_menu').removeClass('open')
            $('.new_mobile_header_menu').removeClass('open')
            $('.new_mobile_main_menu').removeClass('open')
            $('body').removeClass('menu_open')
        })

        $('.menu_services').click((e) => {
            e.preventDefault();
            e.stopPropagation();
            $('.menu_services').toggleClass('open')
            $('.new_main_menu').toggleClass('open')
            $('body').toggleClass('menu_open')
        })

        $('.new_mobile_header_menu').click((e) => {
            e.preventDefault();
            e.stopPropagation();
            $('.new_mobile_header_menu').toggleClass('open')
            $('.new_mobile_main_menu').toggleClass('open')
            $('body').toggleClass('menu_open')
        })

        $('.new_mobile_main_menu_panel_nav_sub_close').click(function (e) {
            e.preventDefault();
            e.stopPropagation();

            $(this).parent().parent().removeClass('is-active');
        });

        $('.new_mobile_main_menu_panel_nav_link').click(function (e) {
            e.preventDefault();
            e.stopPropagation();

            $(this).siblings().addClass('is-active');
        })


        $('input[name="phone"]').inputmask("+7 (999) 999-99-99");

        $('.callMe').submit(function () {

            $('.modals__success_btn', this).attr('disabled', true);
            $(this).ajaxSubmit({
                success: function () {
                    gtag('event', 'send', {'event_category': 'callback'});
                    $('#consultModal .modals__success_btn').attr('disabled', false);

                    $('#consultModal input').val('')
                    $('#consultModal .btn-x').click()

                    setTimeout(() => {
                        alert("@lang('messages.client.service_create')")
                    }, 500);
                }
            })

            return false
        })

        $('#new_modal_login_main_tab_login').click(function () {
            showLoginTab('#login-tab-pane', this)
        })

        $('#new_modal_login_main_tab_register').click(function () {
            showLoginTab('#registration-tab-pane', this)
        })

        $('.pills-legalentity-tab').click(function () {
            $('.pills-legalentity-tab').removeClass('active')
            $(this).addClass('active')

            $('.new_modal_login_main_tab_pane_register').removeClass('active')
            $($(this).data('form')).addClass('active')
        })

        @if(sizeof($loginError) > 0 || sizeof($registerError) > 0 )
        showLoginTab('{{sizeof($registerError) > 0 ? '#registration-tab-pane' : '#login-tab-pane'}}', '{{sizeof($registerError) > 0 ? '#new_modal_login_main_tab_register' : '#new_modal_login_main_tab_login'}}')
        $('.new_header_login').click()
        @endif

        $(document).on('submit', '#legalentityForm1', function (event) {
            event.preventDefault();

            setRecaptcha('#legalentityForm1')
        });

        $(document).on('submit', '#legalentityForm', function (event) {
            event.preventDefault();

            setRecaptcha('#legalentityForm')
        });


    });

    function setAdditionalDataToSendForm(tag, comment) {
        let parent = $('#consultModal');
        $('input[name="tags"]', parent).val(tag)
        $('input[name="comment"]', parent).val(comment)
    }

    function toggleServicesDropdown() {
        const dropdown = document.getElementById('servicesDropdown');
        if (dropdown.style.display === 'none') {
            dropdown.style.display = 'block';
        } else {
            dropdown.style.display = 'none';
        }
    }

    // Закрыть dropdown при клике вне его
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('servicesDropdown');
        const button = event.target.closest('.button-9jl6u0');
        
        if (!button && dropdown) {
            dropdown.style.display = 'none';
        }
    });
</script>
</body>
</html>