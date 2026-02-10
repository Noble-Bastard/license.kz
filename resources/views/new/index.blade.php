@extends('new.layouts.app')

@section('title')
    @if(\Illuminate\Support\Facades\App::getLocale() == "ru")
        ЛИЦЕНЗИИ — Электронное лицензирование в Казахстане
    @else
        LICENSES — Electronic Licensing in Kazakhstan
    @endif
@endsection

@section('meta-description')
    @if(\Illuminate\Support\Facades\App::getLocale() == "ru")
        Е-лицензирование ➤ Электронные лицензии ✅ Получения лицензий и разрешений во всех сферах деятельности ➤ Разрешительные документы в Республике Казахстан ➤ Сайт лицензий!
    @else
        E-licensing ➤ Electronic licenses ✅ Obtaining licenses and permits in all areas of activity ➤ Permits in the Republic of Kazakhstan ➤ License site!
    @endif
@endsection

@section('content')
    <div class="main mt-5">

        <!-- Search field -->
        @if(Auth::check() && !Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client))
        <div class="col-12 text-start main__search_field">
            <div class="container">
                <div class="main__search-box">
                    <button class="main__btn-search"><i class="bi bi-search"></i></button>
                    <input type="text" class="main__input-search home__list-of-industries__search__form__input" aria-label="search" placeholder="Введите текст">
                </div>
            </div>
        </div>
        @endif

        <!-- Carousel -->
        <section class="splide main__top_carousel">
            <div class="splide__track">
                <div class="splide__list">
                    @foreach(collect($topCategoryList)->sortBy('hot_offer_order_no') as $category)
                        <div class="splide__slide">
                            <div class=" carousel-element">
                                <div class="row h-100">
                                    <div class="col-lg-7 col-12 text-start d-flex flex-column justify-content-between">
                                        @php
                                            $catalogList = collect($category->catalogNodes->childNodeList->where('is_visible', 1)->all())->sortBy('name');
                                        @endphp
                                        <div>
                                            <div class="col-12 text-center text-md-start"><p
                                                        class="main__carousel-title-head">{{$category->name}}</p></div>
                                            <div class="col-12 main__carousel-title-list">
                                                <ol>
                                                    @foreach($catalogList as $catalogItem)
                                                        <li class="@if($loop->index > 5) d-none @endif">
                                                            <a href="{{route('new.services-group.info', ['serviceCategoryId'=>$catalogItem->pretty_url])}}"
                                                               class="main__carousel-link">
                                                                {{$catalogItem->name}}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ol>
                                            </div>

                                            <nav class="show-mobile-dark">
                                                <div class="col-12 text-center">
                                                    <img src="{{\Illuminate\Support\Facades\Storage::url($category->img)}}"
                                                         class="main__photo-burger_photo">
                                                </div>
                                            </nav>
                                        </div>
                                        @if(sizeof($catalogList) > 6)
                                            <div class="col-12">
                                                <button class="main__services_button">Смотреть весь каталог услуг<i
                                                            class="bi bi-chevron-compact-right px-md-2"></i></button>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-lg-5 col-12 text-center">
                                        <nav class="hide-mobile-dark">
                                            <img src="{{\Illuminate\Support\Facades\Storage::url($category->img)}}"
                                                 class="main__photo-burger_photo">
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>


        <nav class="hide-mobile-page1">
            <!-- fixed button desktop -->
{{--            <div class="col-xxl-3 col-lg-5 col-12 text-end main__fixed_button">--}}
{{--                <div class="container d-flex justify-content-end">--}}
{{--                    <button type="button" class="btn btn-success main__top_button">Где и зачем нужны лицензии?</button>--}}
{{--                    <a href="https://wa.me/77471350000" onclick="gtag('event', 'click', {'event_category': 'WhatsApp'});" class="main__top_button-whatsapp">--}}
{{--                        <img src="{{asset('/new/images/icons/logos_whatsapp.png')}}">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
        </nav>
        <!-- Carousel -->

            <!-- Cards -->
        <div class="container">
            <div class="col-12 cards main__top_card">
                <div class="row justify-content-center">
                    <div class="container justify-content-sm-start justify-content-center">
                        @foreach($categoryList as $category)
                            <div class="card-container" data-category-id="{{$category->id}}">
                                <div class="card" id="cd-{{$loop->index}}">
                                    <div class="col-12 text-start">
                                        <img src="{{\Illuminate\Support\Facades\Storage::url($category->icon)}}" alt="{{$category->name}}"/>
                                    </div>
                                    <div class="col-12">
                                        <p class="main__top_card-description ph-{{$loop->index}}">{{$category->name}}</p>
                                    </div>
                                    <div class="loader-line d-none"></div>
                                </div>
                                <div class="black_card">

                                </div>
                            </div>
                        @endforeach

                        <nav class="hide-mobile-dark w-100">
                            <div class="main__information_text w-100 d-flex justify-content-end mt-5 pt-5">
                                <p class="main__information_text-main">
                                    <span class="main__information_text-main-span">Полезная информация</span>
                                    от представителей Государственных органов и экспертов о лицензировании
                                </p>
                            </div>
                        </nav>

                    </div>

                </div>


            </div> <!-- End cards -->

            <!-- Show button for small screen -->
            <nav class="show-mobile-page main__card_buttons">
                <div class="col-12 text-center">
                    <button class="btn btn-success main__card_button_show">Показать все</button>
                </div>

                <div class="col-12 text-center">
                    <button class="btn btn-success main__card_button_hide d-none">Скрыть</button>
                </div>
            </nav>


        </div>

        <div>
            <nav class="show-mobile-dark container mt-3">
                <div class="col-12 main__information_text">
                    <p class="main__information_text-mini">
                        <span class="main__information_text-mini-span">Полезная информация</span>
                        от представителей Государственных органов и экспертов о лицензировании
                    </p>
                </div>
            </nav>
        </div>

        <!-- News -->
        @include('new.partials.page.news')

        <!-- Our services -->
        <div class="col-12 main__services_window">
            <div class="container">
                <div class="row">
                    <div class="col-12 main__services_window_content">
                        <div class="row">

                            <div class="col-md-6 col-12 text-start">
                                <div class="col-xl-8 col-9">
                                    <p class="main__services_window_title-head">Наши решения и услуги</p>
                                </div>
                                <div class="col-lg-10 col-11 main__services_window_description">
                                    <p class="main__services_window_title-description">Это платформа, на которой вы можете в онлайн-режиме собрать
                                        все необходимые документы для получения лицензий и разрешений,
                                        а также быть в курсе последних изменений в законодательстве.
                                    </p>
                                </div>
                                <div class="col-11 main__services_window_photo">
                                    <img src="{{asset("./new/images/table.png")}}" class="main__services_window_photo-table">
                                    <a  data-url="https://www.youtube.com/embed/ZdUFNtPZeXM"><img src="{{asset("./new/images/icons/playIcon.png")}}" class="main__services_window_photo-play play-video"></a>
                                </div>
                            </div>

                            <div class="col-md-6 col-12 text-start main__services_window_instructions">
                                <div class="col-xl-8 col-10">
                                    <p class="main__services_window_title-instructions">Более 500 инструкций</p>
                                </div>
                                <div class="col-lg-10 col-12">
                                    <p class="main__services_window_title-instructions-subtitle">по получению лицензий и разрешений всех видов и отраслей</p>
                                </div>
                                <div class="col-12 main__services_window_instructions">
                                    <div class="row">

                                        <div class="col-12">
                                            <div class="row">

                                                <div class="col-sm-6 col-12">
                                                    <div class="col-12">
                                                        <img src="{{asset("./new/images/icons/loopIcon.png")}}" class="py-1">
                                                    </div>
                                                    <div class="col-11 text-start">
                                                        <p class="main__services_window_title-options"> Находите
                                                            <span class="main__services_window_title-span">нужную вам тему</span>
                                                            с помощью поисковой строки или каталога
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 col-12">
                                                    <div class="col-12">
                                                        <img src="{{asset("./new/images/icons/handIcon.png")}}">
                                                    </div>
                                                    <div class="col-11 text-start">
                                                        <p class="main__services_window_title-options">
                                                            <span class="main__services_window_title-span">Бесплатно скачиваете перечень</span>
                                                            требований для получения разрешительных документов
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-sm-6 col-12">
                                            <div class="col-12">
                                                <div class="col-12">
                                                    <img src="{{asset("./new/images/icons/documentsIcon.png")}}" class="py-1">
                                                </div>
                                                <div class="col-11 text-start">
                                                    <p class="main__services_window_title-options"> Мы собирали базу более 1 года, чтобы вы могли получить
                                                        <span class="main__services_window_title-span">вcё в одном месте</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-xl-10 col-8 main__services_window_instructions">
                                    <p class="main__services_window_title-instructions">Информация актуализируется ежедневно</p>
                                </div>

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-sm-6 col-12">
                                            <div class="col-12">
                                                <div class="col-12">
                                                    <img src="{{asset("./new/images/icons/aimIcon.png")}}" class="py-1">
                                                </div>
                                                <div class="col-11 text-start">
                                                    <p class="main__services_window_title-options">
                                                        <span class="main__services_window_title-span">Не нужно искать</span>
                                                        информацию в разных источниках или звонить в государственные органы
                                                        для получения консультаций
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-12">
                                            <div class="col-12">
                                                <div class="col-12">
                                                    <img src="{{asset("./new/images/icons/likeIcon.png")}}" class="py-1">
                                                </div>
                                                <div class="col-11 text-start">
                                                    <p class="main__services_window_title-options">Мы реализовали
                                                        <span class="main__services_window_title-span">синхронизацию с государственными уполномоченными органами</span>
                                                        , чтобы у вас всегда были актуальные данные
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-12 main__license-options">
            <div class="container">
                <div class="row">

                    <!-- Main header-->
                    <div class="col-12">
                        <div class="row">
                            <div class="col-xl-6 col-lg-9 col-12">
                                <p class="main__license-title-head">Получайте <span class="main__license-title-span">лицензии в любой отрасли</span> вместе с нами</p>
                            </div>
                        </div>
                    </div>

                    <!-- Title -->
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <p class="main__license-title-description">Каталог на нашем сайте содержит 19 отраслей и более 500 разрешительных документов</p>
                            </div>
                        </div>
                    </div>

                    <!-- Icons -->
                    <div class="col-12 text-center">
                        <div class="row">
                            <div class="col-md-4 col-12 text-md-center text-start">
                                <div class="col-12"><img src="{{asset('/new/images/icons/mechanism.png')}}" class="main__photo-icons"></div>

                                <nav class="hide-mobile-page">
                                    <div class="col-12 text-start main__numbers"><p class="main__license-title-numbers">01</p></div>
                                    <div class="col-12 text-start"><p class="main__license-title-paragraph">Скачать пошаговую инструкцию</p></div>
                                </nav>

                                <nav class="show-mobile-page">
                                    <div class="row main__mini_description">
                                        <div class="col-1 text-start"><p class="main__license-title-numbers">01</p></div>
                                        <div class="col-11 text-start"><p class="main__license-title-paragraph">Скачать пошаговую инструкцию</p></div>
                                    </div>
                                </nav>

                                <div class="col-12">
                                    <div class="col-10 text-start">
                                        <p class="main__license-title-paragraph-mini">
                                            Мы предоставляем инструкцию с актуальными требованиями для самостоятельного получения лицензии
                                        </p>
                                    </div>
                                </div>

                                <nav class="show-mobile-page">
                                    <div class="col-12 main__btn-layout">
                                        <button type="button" class="btn btn-outline-success main__success_btn color-black">Скачать инструкцию</button>
                                    </div>
                                </nav>

                            </div>

                            <div class="col-md-4 col-12 text-md-center text-start">
                                <div class="col-12"><img src="{{asset('/new/images/icons/list.png')}}" class="main__photo-icons"></div>

                                <nav class="hide-mobile-page">
                                    <div class="col-12 main__numbers"><p class="main__license-title-numbers">02</p></div>
                                    <div class="col-12 text-start"><p class="main__license-title-paragraph">Скачать Коммерческое предложение</p></div>
                                </nav>

                                <nav class="show-mobile-page">
                                    <div class="row main__mini_description">
                                        <div class="col-1"><p class="main__license-title-numbers">02</p></div>
                                        <div class="col-11"><p class="main__license-title-paragraph">Скачать Коммерческое предложение</p></div>
                                        <div class="col-12 main__btn-layout">
                                            <button type="button" class="btn btn-outline-success main__success_btn color-black">Скачать КП</button>
                                        </div>
                                    </div>
                                </nav>

                            </div>

                            <div class="col-md-4 col-12 text-md-center text-start">
                                <div class="col-12"><img src="{{asset('/new/images/icons/pc.png')}}" class="main__photo-icons"></div>
                                <nav class="hide-mobile-page">
                                    <div class="col-12 text-start main__numbers"><p class="main__license-title-numbers">03</p></div>
                                    <div class="col-12 text-start"><p class="main__license-title-paragraph">Заказать услугу онлайн</p></div>
                                </nav>

                                <nav class="show-mobile-page">
                                    <div class="row main__mini_description">
                                        <div class="col-1 text-center"><p class="main__license-title-numbers">03</p></div>
                                        <div class="col-11 text-start"><p class="main__license-title-paragraph">Заказать услугу онлайн</p></div>
                                    </div>
                                </nav>

                                <div class="col-12 text-start">
                                    <div class="col-11">
                                        <p class="main__license-title-paragraph-mini">
                                            Эксперты предоставят её вам с гарантированным результатом
                                        </p>
                                    </div>
                                </div>

                                <nav class="show-mobile-page">
                                    <div class="col-12 main__btn-layout">
                                        <button type="button" class="btn btn-success main__success_btn">Заказать услугу онлайн</button>
                                    </div>
                                </nav>

                            </div>
                        </div>
                    </div>

                    <!-- Buttons for icons -->
                    <nav class="hide-mobile-page">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-4">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-outline-success main__success_btn color-black">Скачать инструкцию</button>
                                    </div>
                                </div>

                                <div class="col-4 text-start">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-outline-success main__success_btn color-black">Скачать КП</button>
                                    </div>
                                </div>

                                <div class="col-4 text-start">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-success main__success_btn">Заказать услугу онлайн</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div> <!-- License window -->

        <!-- dark window -->
        <div class="col-12 align-items-center main__black_element">
            <div class="container">
                    <!-- -->
                <div class="row main__dark_row">
                    <div class="col-xl-10 col-12 main__black_window_top">
                        <div class="row justify-content-center main__dark_row">
                            <!-- -->
                            <div class="col-md-11 col-11">
                                <div class="row">
                                    <div class="col-xl-8 col-lg-7 col-md-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <p class="main__license-title-head main__black_window_title-head">
                                                    Гарантированный <span class="main__black_window_title-span">результат</span>
                                                    в любой отрасли</p>
                                            </div>
                                            <!-- with us -->
                                            <div class="col-12 main__black_window_title-with">
                                                С нами
                                            </div>

                                            <!-- list -->
                                            <div class="col-12 main__black_window_title-description">
                                                <div class="col-xl-8 col-lg-10 col-12">
                                                    <ul>
                                                        <li class="main__black_window_title-description-list">Закажите
                                                            услугу сопровождения онлайн у экспертов портала
                                                        </li>
                                                        <li class="main__black_window_title-description-list">Получайте
                                                            гарантированный результат
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <nav class="show-mobile-dark">
                                                <!-- Photo: calendar + computer -->
                                                <div class="col-xl-4 col-lg-5 col-12">
                                                    <img src="{{asset('/new/images/icons/calendar.png')}}"
                                                         class="main__photo-big-icon">
                                                </div>
                                            </nav>

                                            <!-- Button (call) -->
                                            <div class="col-12">
                                                <button type="button" class="btn btn-success main__black_success_btn"
                                                        data-bs-toggle="modal" data-bs-target="#consultModal">Заказать
                                                    звонок
                                                </button>
                                            </div>

                                            <!-- Question -->
                                            <div class="col-12 main__black_window_title-question">
                                                Как действовать без нас?
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Photo: calendar + computer -->
                                    <div class="col-xl-4 col-lg-5 col-12">
                                        <nav class="hide-mobile-dark">
                                        <img src="{{asset('/new/images/icons/calendar.png')}}" class="main__photo-big-icon">
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Instruction -->
                <div class="container text-start">
                    <div class="col-lg-12 col-10 text-start main__black_window_title-instruction">
                        <div class="row justify-content-start">
                            <ol>
                                <li class="main__black_window_title-instruction-list">Выберите нужный разрешительный документ </li>
                                <li class="main__black_window_title-instruction-list">Скачайте пошаговую инструкцию с актуальными требованиями и шаблонами документов</li>
                                <li class="main__black_window_title-instruction-list">Получите лицензию самостоятельно</li>
                            </ol>
                        </div>
                    </div>
                </div>


                <!-- Bottom-window -->
                <div class="col-12 main__bottom-window">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xxl-10 col-xl-11 col-lg-10 col-11 main__bottom-window-decoration">

                                <!-- header -->
                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-xl-6 col-lg-10 col-auto"><p class="main__black_window_title-bottom"><span class="main__black_window_title-bottom-span">Продажа бизнеса</span>
                                                и компаний с необходимой лицензией и историей</p>
                                        </div>

                                    </div>
                                </div>

                                <!-- description -->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <p class="main__black_window_title-bottom-description">
                                                Если у вас нет времени собирать историю своего бизнеса самостоятельно, купите его на нашем портале
                                            </p>
                                        </div>

                                            <!-- Buttons (sell / buy)-->
                                            <div class="col-6">
                                                <nav class="hide-mobile-page">
                                                    <div class="col-12">
                                                        <div class="row">

                                                            <div class="col-6 text-center">
                                                                <button type="button" class="btn btn-success main__black_success_btn sellCompany"
                                                                        data-bs-toggle="modal" data-bs-target="#consultModal"
                                                                >Продать компанию</button>
                                                            </div>

                                                            <div class="col-6 text-center">
                                                                <button type="button" class="btn btn-outline-success main__black_window_success_btn buyCompany"
                                                                        data-bs-toggle="modal" data-bs-target="#consultModal"
                                                                >Купить компанию</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </nav>
                                            </div>

                                    </div>
                                </div>

                                <div class="col-12">

                                    <nav class="show-mobile-page">

                                        <!-- Buttons (sell / buy)-->
                                            <div class="col-12 text-center main__btn-buy">
                                                <button type="button" class="btn btn-success main__black_success_btn sellCompany"
                                                        data-bs-toggle="modal" data-bs-target="#consultModal">Продать компанию</button>
                                            </div>

                                            <div class="col-12 text-center main__btn-buy">
                                                <button type="button" class="btn btn-outline-success main__black_window_success_btn buyCompany"
                                                        data-bs-toggle="modal" data-bs-target="#consultModal">Купить компанию</button>
                                            </div>

                                    </nav>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- Dark window -->


            <!-- cabinet -->
            <div class="col-12 main__personal_area">
                <div class="container">
                    <div class="row">

                        <nav class="hide-mobile-page">
                            <!-- head title -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-xxl-9 col-lg-10 col-12 main__cabinet_window_head">
                                        <p class="main__cabinet_window_title-head">Пользователю портала предоставляется простой и удобный
                                            <span class="main__cabinet_window_title-span">личный кабинет</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- photo + advantages -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-xxl-8 col-lg-6">
                                        <img src="{{asset('/new/images/icons/window.png')}}" class="main__photo-window">
                                    </div>

                                    <div class="col-xxl-4 col-lg-6">
                                        <div class="col-11 text-xxl-start text-lg-center text-start">
                                            <p class="main__cabinet_window_title-advantages">Преимущества </p>
                                        </div>

                                        <div class="col-12">

                                            <div class="row justify-content-lg-start">
                                                <div class="col-xxl-1 col-md-2 col-3"><p class="main__cabinet_window_title-numbers">01</p></div>
                                                <div class="col-9 text-start"><p class="main__cabinet_window_title-description">Отслеживание статуса заказанных услуг</p></div>
                                            </div>

                                        </div>

                                        <div class="col-12">

                                            <div class="row justify-content-lg-start">
                                                <div class="col-xxl-1 col-md-2 col-3"><p class="main__cabinet_window_title-numbers">02</p></div>
                                                <div class="col-9 text-start"><p class="main__cabinet_window_title-description">Формирование защищённого архива документов</p></div>
                                            </div>

                                        </div>

                                        <div class="col-12">

                                            <div class="row justify-content-lg-start">
                                                <div class="col-xxl-1 col-md-2 col-3"><p class="main__cabinet_window_title-numbers">03</p></div>
                                                <div class="col-9 text-start"><p class="main__cabinet_window_title-description">Получение отраслевых услуг</p></div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </nav>

                        <nav class="show-mobile-page">

                            <div class="col-12 main__mobile_cabinet">
                                <img src="{{asset('/new/images/icons/window.png')}}" class="main__photo-window">
                            </div>

                            <div class="col-12 main__cabinet_window_head">
                                <p class="main__cabinet_window_title-head">
                                    Пользователю портала предоставляется простой и удобный личный кабинет
                                </p>
                            </div>

                            <div class="col-12">

                                <div class="col-11 text-xxl-start text-lg-center text-start">
                                    <p class="main__cabinet_window_title-advantages">Преимущества </p>
                                </div>


                                <div class="row justify-content-start">
                                    <div class="col-md-2 col-1 text-start"><p class="main__cabinet_window_title-number-mini">01</p></div>
                                    <div class="col-11 text-start"><p class="main__cabinet_window_title-description">Отслеживание статуса заказанных услуг</p></div>
                                </div>


                                <div class="col-12">

                                    <div class="row justify-content-start">
                                        <div class="col-md-2 col-1 text-start"><p class="main__cabinet_window_title-number-mini">02</p></div>
                                        <div class="col-11 text-start"><p class="main__cabinet_window_title-description">Формирование защищённого архива документов</p></div>
                                    </div>

                                </div>

                                <div class="col-12">

                                    <div class="row justify-content-start">
                                        <div class="col-md-2 col-1"><p class="main__cabinet_window_title-number-mini">03</p></div>
                                        <div class="col-11 text-start"><p class="main__cabinet_window_title-description">Получение отраслевых услуг</p></div>
                                    </div>

                                </div>
                            </div>

                        </nav>

                        <div class="col-11">
                            <div class="row">
                                <div class="col-lg-7 col-xxl-8 col-12">
                                    <p class="main__cabinet_window_title-bottom">Делаем общение эффективнее. Больше никаких долгих разговоров по телефону и
                                        бесконечных почтовых сообщений, которые невозможно найти в нужный момент.
                                        Вся коммуникация в одном месте!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div> <!-- Cabinet window -->


            <!-- Manager -->
            <div class="col-12">
                <div class="container">

                    <div class="col-12 main__manager_window">
                        <img src="{{asset('/new/images/manager.png')}}" class="main__manager_window-photo d-none d-md-block" />
                        <img src="{{asset('/new/images/manager_mini.png')}}" class="main__manager_window-photo d-block d-md-none" />

                        <div class="col-12 col-md-6 main__manager_window-context">
                            <p class="main__manager_window-title"> При заказе через сайт предоставим персонального менеджера.
                                <span class="main__manager_window-span">Он сделает всё за вас!</span>
                            </p>
                            <button class="btn btn-success main__black_window_success_btn">Узнать подробнее</button>
                        </div>
                    </div>
                </div>
            </div> <!-- Manager -->


            <!-- Lawyer window -->
            <div class="col-12 main__layer_window">
                <div class="container">
                <div class="row">

                    <!-- head title -->
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-7 col-12">
                                <p class="main__lawyer_window-title-head">Невозможно быть лучшим везде</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">

                            <div class="col-md-6 col-12">

                                <!-- description -->
                                <div class="col-md-11 col-12">
                                    <p class="main__lawyer_window-title-description">Услуги юриста и бухгалтера на аутсорсинге для вашего бизнеса</p>
                                </div>

                                <!-- description mini -->
                                <div class="col-11">
                                    <p class="main__lawyer_window-title-description-mini">Для качества экспертизы мы подобрали топовых экспертов отдельно по каждой отрасли</p>
                                </div>

                            </div>

                            <div class="col-md-6 col-12">

                                <!-- Buttons -->
                                <div class="col-12">
                                    <!-- desktop buttons -->
                                    <nav>
                                        <div class="col-sm-11 col-12 industryOutsourcingPanel">
                                            <div class="row">
                                                <div class="col-6">
                                                    <button type="button" class="btn btn-outline-success main__lawyer_button" data-tag="legaloutsourcing" data-comment="Юридический оутсорсинг">Отраслевой юридический аутсорсинг</button>
                                                </div>

                                                <div class="col-6">
                                                    <button type="button" class="btn btn-success main__lawyer_button" data-tag="accountoutsourcing" data-comment="Бухгалтерский оутсорсинг">Отраслевой бухгалтерский аутсорсинг</button>
                                                </div>

                                                <div class="col-9 main__lawyer_button_call-layout">
                                                    <button class="btn btn-success main__lawyer_button_call industryOutsourcing" data-bs-toggle="modal"
                                                            data-bs-target="#consultModal"
                                                            aria-expanded="false">Заказать звонок</button>
                                                </div>
                                            </div>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div> <!-- Lawyer window -->

            <!-- Partners window -->
            @include('new.partials.page.partners')
             <!-- Partners window -->

            <!-- Reviews -->
            @include('new.partials.page.review', ['showAllReviewsBtn' => true])

    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset("libs/splide4/splide.min.css")}}">
@endpush

@section('js')
    <script src="{{asset("libs/splide4/splide.min.js")}}"></script>
    <script>
        $(document).ready(function ()
        {

            let splide = new Splide( '.splide', {
                type   : 'loop',
                padding: '15%',
                focus    : 'center',
                autoWidth: true,
                arrows: false
            });
            splide.mount();

            $('.main__services_button').click(function(){
                let parentBlock = $(this).parents('.carousel-element')[0]
                $('.main__carousel-title-list li.d-none', parentBlock).removeClass('d-none')
            })

            $('.card-container').click(function(e){
                const self = this
                $('.loader-line', self).toggleClass('d-none')
                $.ajax({
                    type: 'GET',
                    url: 'services/child-nodes/' + $(self).data('category-id'),
                    success: function (data) {
                        $('.black_card', self).html(data)
                        $('.card-container').removeClass('card-container__active')
                        $(self).addClass('card-container__active')
                        $('.loader-line', self).toggleClass('d-none')
                    }})
            })

            $('.main__card_button_show').click(function() {
                $('.main__top_card').addClass('active')
                $(this).addClass('d-none');
                $('.main__card_button_hide').removeClass('d-none');
            })
            $('.main__card_button_hide').click(function() {
                $('.main__top_card').removeClass('active')
                $(this).addClass('d-none');
                $('.main__card_button_show').removeClass('d-none');
            })

            $('.main__lawyer_button').click(function () {
                $('.main__lawyer_button').removeClass('btn-success').addClass('btn-outline-success');
                $(this).addClass('btn-success').removeClass('btn-outline-success');
            })

            $('.sellCompany').click(function () {
                setAdditionalDataToSendForm('Sellcompany', 'Продажа компании')
            })

            $('.buyCompany').click(function () {
                setAdditionalDataToSendForm('buycompany', 'Покупка компании')
            })

            $('.industryOutsourcing').click(function () {
                let parent = $('.industryOutsourcingPanel');
                let type = $('.btn-success', parent);
                setAdditionalDataToSendForm($(type).data('tag'), $(type).data('comment'));
            })
try {
  $("input.home__list-of-industries__search__form__input").autocomplete({
    source: function (request, response) {
      $.get("{{route('service.search')}}", {
        query: request.term
      }, function (data) {
        response(data);
      });
    },
    minLength: 3,
    delay: 500,
    select: function (event, ui) {
      window.location = "/searchSelected/" + ui.item.catalog[0].catalog_id + "/" + ui.item.catalog[0].service_id;
    }
  }).data("ui-autocomplete")._renderItem = function (ul, item) {
    ul.addClass('list-of-industries__autocomplete')
    return $("<li>")
      .append("<div>" + item.name + "</div>")
      .appendTo(ul);
  };
} catch (e) {

}
try{
            $("input#homePageSearch").autocomplete({
                source: function (request, response) {
                    $.get("{{route('service.search')}}", {
                        query: request.term
                    }, function (data) {
                        response(data);
                    });
                },
                minLength: 3,
                delay: 500,
                select: function (event, ui) {
                    window.location = "/searchSelected/" + ui.item.catalog[0].catalog_id + "/" + ui.item.catalog[0].service_id;
                }
            }).data("ui-autocomplete")._renderItem = function (ul, item) {
                ul.addClass('list-of-industries__autocomplete')
                return $("<li>")
                    .append("<div>" + item.name + "</div>")
                    .appendTo(ul);
            };
} catch (e) {

}
            $('body').scroll(function () {
                $(".ui-autocomplete").hide();
            });

            $('.l-1').click(function () {
                $(".i-cf-1").toggle();
                $(".i-c-1").toggle();

                $(".i-cf-2").hide();
                $(".i-c-2").show();

                $(".i-cf-3").hide();
                $(".i-c-3").show();
            })

            $('.l-2').click(function () {
                $(".i-cf-2").toggle();
                $(".i-c-2").toggle();

                $(".i-cf-1").hide();
                $(".i-c-1").show();

                $(".i-cf-3").hide();
                $(".i-c-3").show();
            })

            $('.l-3').click(function () {
                $(".i-cf-3").toggle();
                $(".i-c-3").toggle();

                $(".i-cf-2").hide();
                $(".i-c-2").show();

                $(".i-cf-1").hide();
                $(".i-c-1").show();
            })
        });

    </script>
@endsection
