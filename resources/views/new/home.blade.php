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
    <div class="main">

        <!-- Search field -->
        <div class="col-12 text-start main__search_field">
            <div class="container">
                <div class="main__search-box">
                    <button class="main__btn-search"><i class="bi bi-search"></i></button>
                    <input type="text" class="main__input-search" aria-label="search" placeholder="Введите текст">
                </div>
            </div>
        </div>

        <!-- Carousel -->
        <div class="col-12 text-center justify-content-center main__top_carousel">
            <div id="carouselItem" class="carousel slide show-neighbors pointer-event col-12" data-bs-ride="carousel">

                <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="item__third">
                                <div class="carousel-main-element">

                                    <div class="row">

                                        <div class="col-4">
                                            <div class="carousel-element">
                                                <div class="row">
                                                    <div class="col-lg-7 col-12 text-start">
                                                        <div class="col-12 text-center text-md-start"><p class="main__carousel-title-head">Строительство</p></div>
                                                        <div class="col-12 main__carousel-title-list">
                                                            <ol>
                                                                <li><a href="#" class="main__carousel-link">Аккредитация</a></li>
                                                                <li><a href="#" class="main__carousel-link">Изыскательная деятельность</a></li>
                                                                <li><a href="#" class="main__carousel-link">Контроль строительных работ</a></li>
                                                                <li><a href="#" class="main__carousel-link">Проектные работы</a></li>
                                                                <li><a href="#" class="main__carousel-link">Разрешения</a></li>
                                                                <li><a href="#" class="main__carousel-link">Строительно-монтажные работы</a></li>
                                                            </ol>
                                                        </div>

                                                        <nav class="show-mobile-dark">
                                                            <div class="col-12 text-center">
                                                                <img src="{{asset('/new/images/icons/crane.png')}}" class="main__photo-burger_photo">
                                                            </div>
                                                        </nav>

                                                        <div class="col-12">
                                                            <button class="main__services_button">Смотреть весь каталог услуг<i class="bi bi-chevron-compact-right px-2"></i></button>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-5 col-12 text-center">
                                                        <nav class="hide-mobile-dark">
                                                            <img src="{{asset('/new/images/icons/crane.png')}}" class="main__photo-burger_photo">
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="carousel-element">
                                                <div class="row">
                                                    <div class="col-lg-7 col-12 text-start">
                                                        <div class="col-12 text-center text-md-start"><p class="main__carousel-title-head">Строительство</p></div>
                                                        <div class="col-12 main__carousel-title-list">
                                                            <ol>
                                                                <li><a href="#" class="main__carousel-link">Аккредитация</a></li>
                                                                <li><a href="#" class="main__carousel-link">Изыскательная деятельность</a></li>
                                                                <li><a href="#" class="main__carousel-link">Контроль строительных работ</a></li>
                                                                <li><a href="#" class="main__carousel-link">Проектные работы</a></li>
                                                                <li><a href="#" class="main__carousel-link">Разрешения</a></li>
                                                                <li><a href="#" class="main__carousel-link">Строительно-монтажные работы</a></li>
                                                            </ol>
                                                        </div>

                                                        <nav class="show-mobile-dark">
                                                            <div class="col-12 text-center">
                                                                <img src="{{asset('/new/images/icons/crane.png')}}" class="main__photo-burger_photo">
                                                            </div>
                                                        </nav>

                                                        <div class="col-12">
                                                            <button class="main__services_button">Смотреть весь каталог услуг<i class="bi bi-chevron-compact-right px-2"></i></button>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-5 col-12 text-center">
                                                        <nav class="hide-mobile-dark">
                                                            <img src="{{asset('/new/images/icons/crane.png')}}" class="main__photo-burger_photo">
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="carousel-element">
                                                <div class="row">
                                                    <div class="col-lg-7 col-12 text-start">
                                                        <div class="col-12 text-center text-md-start"><p class="main__carousel-title-head">Строительство</p></div>
                                                        <div class="col-12 main__carousel-title-list">
                                                            <ol>
                                                                <li><a href="#" class="main__carousel-link">Аккредитация</a></li>
                                                                <li><a href="#" class="main__carousel-link">Изыскательная деятельность</a></li>
                                                                <li><a href="#" class="main__carousel-link">Контроль строительных работ</a></li>
                                                                <li><a href="#" class="main__carousel-link">Проектные работы</a></li>
                                                                <li><a href="#" class="main__carousel-link">Разрешения</a></li>
                                                                <li><a href="#" class="main__carousel-link">Строительно-монтажные работы</a></li>
                                                            </ol>
                                                        </div>

                                                        <nav class="show-mobile-dark">
                                                            <div class="col-12 text-center">
                                                                <img src="{{asset('/new/images/icons/crane.png')}}" class="main__photo-burger_photo">
                                                            </div>
                                                        </nav>

                                                        <div class="col-12">
                                                            <button class="main__services_button">Смотреть весь каталог услуг<i class="bi bi-chevron-compact-right px-2"></i></button>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-5 col-12 text-center">
                                                        <nav class="hide-mobile-dark">
                                                            <img src="{{asset('/new/images/icons/crane.png')}}" class="main__photo-burger_photo">
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="carousel-item">
                            <div class="item__third">
                                <div class="carousel-main-element">

                                    <div class="row">

                                        <div class="col-4">
                                            <div class="carousel-element">
                                                <div class="row">
                                                    <div class="col-lg-7 col-12 text-start">
                                                        <div class="col-12 text-center text-md-start"><p class="main__carousel-title-head">Строительство</p></div>
                                                        <div class="col-12 main__carousel-title-list">
                                                            <ol>
                                                                <li><a href="#" class="main__carousel-link">Аккредитация</a></li>
                                                                <li><a href="#" class="main__carousel-link">Изыскательная деятельность</a></li>
                                                                <li><a href="#" class="main__carousel-link">Контроль строительных работ</a></li>
                                                                <li><a href="#" class="main__carousel-link">Проектные работы</a></li>
                                                                <li><a href="#" class="main__carousel-link">Разрешения</a></li>
                                                                <li><a href="#" class="main__carousel-link">Строительно-монтажные работы</a></li>
                                                            </ol>
                                                        </div>

                                                        <nav class="show-mobile-dark">
                                                            <div class="col-12 text-center">
                                                                <img src="{{asset('/new/images/icons/crane.png')}}" class="main__photo-burger_photo">
                                                            </div>
                                                        </nav>

                                                        <div class="col-12">
                                                            <button class="main__services_button">Смотреть весь каталог услуг<i class="bi bi-chevron-compact-right px-2"></i></button>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-5 col-12 text-center">
                                                        <nav class="hide-mobile-dark">
                                                            <img src="{{asset('/new/images/icons/crane.png')}}" class="main__photo-burger_photo">
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="carousel-element">
                                                <div class="row">
                                                    <div class="col-lg-7 col-12 text-start">
                                                        <div class="col-12 text-center text-md-start"><p class="main__carousel-title-head">Строительство</p></div>
                                                        <div class="col-12 main__carousel-title-list">
                                                            <ol>
                                                                <li><a href="#" class="main__carousel-link">Аккредитация</a></li>
                                                                <li><a href="#" class="main__carousel-link">Изыскательная деятельность</a></li>
                                                                <li><a href="#" class="main__carousel-link">Контроль строительных работ</a></li>
                                                                <li><a href="#" class="main__carousel-link">Проектные работы</a></li>
                                                                <li><a href="#" class="main__carousel-link">Разрешения</a></li>
                                                                <li><a href="#" class="main__carousel-link">Строительно-монтажные работы</a></li>
                                                            </ol>
                                                        </div>

                                                        <nav class="show-mobile-dark">
                                                            <div class="col-12 text-center">
                                                                <img src="{{asset('/new/images/icons/crane.png')}}" class="main__photo-burger_photo">
                                                            </div>
                                                        </nav>

                                                        <div class="col-12">
                                                            <button class="main__services_button">Смотреть весь каталог услуг<i class="bi bi-chevron-compact-right px-2"></i></button>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-5 col-12 text-center">
                                                        <nav class="hide-mobile-dark">
                                                            <img src="{{asset('/new/images/icons/crane.png')}}" class="main__photo-burger_photo">
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="carousel-element">
                                                <div class="row">
                                                    <div class="col-lg-7 col-12 text-start">
                                                        <div class="col-12 text-center text-md-start"><p class="main__carousel-title-head">Строительство</p></div>
                                                        <div class="col-12 main__carousel-title-list">
                                                            <ol>
                                                                <li><a href="#" class="main__carousel-link">Аккредитация</a></li>
                                                                <li><a href="#" class="main__carousel-link">Изыскательная деятельность</a></li>
                                                                <li><a href="#" class="main__carousel-link">Контроль строительных работ</a></li>
                                                                <li><a href="#" class="main__carousel-link">Проектные работы</a></li>
                                                                <li><a href="#" class="main__carousel-link">Разрешения</a></li>
                                                                <li><a href="#" class="main__carousel-link">Строительно-монтажные работы</a></li>
                                                            </ol>
                                                        </div>

                                                        <nav class="show-mobile-dark">
                                                            <div class="col-12 text-center">
                                                                <img src="{{asset('/new/images/icons/crane.png')}}" class="main__photo-burger_photo">
                                                            </div>
                                                        </nav>

                                                        <div class="col-12">
                                                            <button class="main__services_button">Смотреть весь каталог услуг<i class="bi bi-chevron-compact-right px-2"></i></button>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-5 col-12 text-center">
                                                        <nav class="hide-mobile-dark">
                                                            <img src="{{asset('/new/images/icons/crane.png')}}" class="main__photo-burger_photo">
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="carousel-item">
                            <div class="item__third">
                                <div class="carousel-main-element">

                                    <div class="row">

                                        <div class="col-4">
                                            <div class="carousel-element">
                                                <div class="row">
                                                    <div class="col-lg-7 col-12 text-start">
                                                        <div class="col-12 text-center text-md-start"><p class="main__carousel-title-head">Строительство</p></div>
                                                        <div class="col-12 main__carousel-title-list">
                                                            <ol>
                                                                <li><a href="#" class="main__carousel-link">Аккредитация</a></li>
                                                                <li><a href="#" class="main__carousel-link">Изыскательная деятельность</a></li>
                                                                <li><a href="#" class="main__carousel-link">Контроль строительных работ</a></li>
                                                                <li><a href="#" class="main__carousel-link">Проектные работы</a></li>
                                                                <li><a href="#" class="main__carousel-link">Разрешения</a></li>
                                                                <li><a href="#" class="main__carousel-link">Строительно-монтажные работы</a></li>
                                                            </ol>
                                                        </div>

                                                        <nav class="show-mobile-dark">
                                                            <div class="col-12 text-center">
                                                                <img src="{{asset('/new/images/icons/crane.png')}}" class="main__photo-burger_photo">
                                                            </div>
                                                        </nav>

                                                        <div class="col-12">
                                                            <button class="main__services_button">Смотреть весь каталог услуг<i class="bi bi-chevron-compact-right px-2"></i></button>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-5 col-12 text-center">
                                                        <nav class="hide-mobile-dark">
                                                            <img src="{{asset('/new/images/icons/crane.png')}}" class="main__photo-burger_photo">
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="carousel-element">
                                                <div class="row">
                                                    <div class="col-lg-7 col-12 text-start">
                                                        <div class="col-12 text-center text-md-start"><p class="main__carousel-title-head">Строительство</p></div>
                                                        <div class="col-12 main__carousel-title-list">
                                                            <ol>
                                                                <li><a href="#" class="main__carousel-link">Аккредитация</a></li>
                                                                <li><a href="#" class="main__carousel-link">Изыскательная деятельность</a></li>
                                                                <li><a href="#" class="main__carousel-link">Контроль строительных работ</a></li>
                                                                <li><a href="#" class="main__carousel-link">Проектные работы</a></li>
                                                                <li><a href="#" class="main__carousel-link">Разрешения</a></li>
                                                                <li><a href="#" class="main__carousel-link">Строительно-монтажные работы</a></li>
                                                            </ol>
                                                        </div>

                                                        <nav class="show-mobile-dark">
                                                            <div class="col-12 text-center">
                                                                <img src="{{asset('/new/images/icons/crane.png')}}" class="main__photo-burger_photo">
                                                            </div>
                                                        </nav>

                                                        <div class="col-12">
                                                            <button class="main__services_button">Смотреть весь каталог услуг<i class="bi bi-chevron-compact-right px-2"></i></button>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-5 col-12 text-center">
                                                        <nav class="hide-mobile-dark">
                                                            <img src="{{asset('/new/images/icons/crane.png')}}" class="main__photo-burger_photo">
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="carousel-element">
                                                <div class="row">
                                                    <div class="col-lg-7 col-12 text-start">
                                                        <div class="col-12 text-center text-md-start"><p class="main__carousel-title-head">Строительство</p></div>
                                                        <div class="col-12 main__carousel-title-list">
                                                            <ol>
                                                                <li><a href="#" class="main__carousel-link">Аккредитация</a></li>
                                                                <li><a href="#" class="main__carousel-link">Изыскательная деятельность</a></li>
                                                                <li><a href="#" class="main__carousel-link">Контроль строительных работ</a></li>
                                                                <li><a href="#" class="main__carousel-link">Проектные работы</a></li>
                                                                <li><a href="#" class="main__carousel-link">Разрешения</a></li>
                                                                <li><a href="#" class="main__carousel-link">Строительно-монтажные работы</a></li>
                                                            </ol>
                                                        </div>

                                                        <nav class="show-mobile-dark">
                                                            <div class="col-12 text-center">
                                                                <img src="{{asset('/new/images/icons/crane.png')}}" class="main__photo-burger_photo">
                                                            </div>
                                                        </nav>

                                                        <div class="col-12">
                                                            <button class="main__services_button">Смотреть весь каталог услуг<i class="bi bi-chevron-compact-right px-2"></i></button>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-5 col-12 text-center">
                                                        <nav class="hide-mobile-dark">
                                                            <img src="{{asset('/new/images/icons/crane.png')}}" class="main__photo-burger_photo">
                                                        </nav>
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

            <nav class="hide-mobile-page">

                <div class="col-12 main__indicators_list">

                    <div class="col-12 text-center">
                        <div class="container">
                            <div class="row carousel_row">
                                <div class="col-3">
                                    <ol>
                                        <li data-bs-target="#carouselItem" data-bs-slide-to="0" class="main__indicators_list-items l-1 active">
                                            <i class="bi bi-circle i-c-1" style="display: none"></i>
                                            <i class="bi bi-circle-fill i-cf-1"></i>
                                        </li>

                                        <li data-bs-target="#carouselItem" data-bs-slide-to="1" class="main__indicators_list-items l-2">
                                            <i class="bi bi-circle i-c-2"></i>
                                            <i class="bi bi-circle-fill i-cf-2" style="display: none"></i>
                                        </li>

                                        <li data-bs-target="#carouselItem" data-bs-slide-to="2" class="main__indicators_list-items l-3">
                                            <i class="bi bi-circle i-c-3"></i>
                                            <i class="bi bi-circle-fill i-cf-3" style="display: none"></i>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- fixed button desktop -->
                <div class="col-xxl-3 col-lg-5 col-6 text-end main__fixed_button">
                    <div class="container">
                        <button type="button" class="btn btn-success main__top_button">Где и зачем нужны лицензии?</button>
                        <button type="button" class="main__top_button-whatsapp"><img src="{{asset('/new/images/icons/logos_whatsapp.png')}}"></button>
                    </div>
                </div>

            </nav>

            <nav class="show-mobile-page">

                <div class="col-12 main__indicators_list">
                    <div class="container">
                        <div class="row">

                            <!-- fixed button mobile -->
{{--                            <div class="col-3" style="position: fixed;">--}}
{{--                                <button type="button" class="btn btn-success main__top_button">--}}
{{--                                    Где и зачем нужны лицензии?</button>--}}
{{--                                <button type="button" class="main__top_button-whatsapp"><img src="{{asset('/new/images/icons/logos_whatsapp.png')}}" class="main__whatsapp_photo"></button>--}}
{{--                            </div>--}}

                            <div class="col-12 main__carousel_buttons">
                                <ol>
                                    <li data-bs-target="#carouselItem" data-bs-slide-to="0" class="main__indicators_list-items l-1 active">
                                        <i class="bi bi-circle i-c-1" style="display: none"></i>
                                        <i class="bi bi-circle-fill i-cf-1"></i>
                                    </li>

                                    <li data-bs-target="#carouselItem" data-bs-slide-to="1" class="main__indicators_list-items l-2">
                                        <i class="bi bi-circle i-c-2"></i>
                                        <i class="bi bi-circle-fill i-cf-2" style="display: none"></i>
                                    </li>

                                    <li data-bs-target="#carouselItem" data-bs-slide-to="2" class="main__indicators_list-items l-3">
                                        <i class="bi bi-circle i-c-3"></i>
                                        <i class="bi bi-circle-fill i-cf-3" style="display: none"></i>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

            </nav>

        </div> <!-- Carousel -->

            <!-- Cards -->
        <div class="container">
            <div class="col-12 cards main__top_card">

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="row main__cards_row justify-content-lg-start justify-content-center">

                            @for($i = 0; $i < 17; $i++)
                                <div class="card cd-{{$i}}">
                                    <div class="col-12 text-start">
                                        <img src="{{asset("./new/images/icons/law.png")}}">
                                    </div>
                                    <div class="col-12 main__card_title">
                                        <a href=""><p class="main__card_title-description">Здравоохранение</p></a>
                                    </div>
                                </div>
                                @for($j = 0; $j < 1; $j++)
                                    <div class="col-12 main__card_window text-center win-{{$i}}-{{$j}}">
                                        <h6 style="color: #1EC28B">win-{{$i}}-{{$j}}</h6>
                                    </div>
                                @endfor
                            @endfor

                            <nav class="hide-mobile-dark">
                                <div class="main__information_text">
                                    <p class="main__information_text-main">
                                        <span class="main__information_text-main-span">Полезная информация</span>
                                        от представителей Государственных органов и экспертов о лицензировании
                                    </p>
                                </div>
                            </nav>

                        </div>

                    </div>

                </div>

            </div> <!-- End cards -->

            <!-- Show button for small screen -->
            <nav class="show-mobile-page">
                <div class="col-12 text-center main__cards_button">
                    <button class="btn btn-success main__card_button">Показать все</button>
                </div>

                <div class="col-12 text-center main__cards_button_hide" style="display: none">
                    <button class="btn btn-success main__card_button_hide">Скрыть</button>
                </div>
            </nav>

            <nav class="show-mobile-dark">
                <div class="col-12 main__information_text">
                    <p class="main__information_text-mini">
                        <span class="main__information_text-mini-span">Полезная информация</span>
                        от представителей Государственных органов и экспертов о лицензировании
                    </p>
                </div>
            </nav>
        </div>

        <!-- News -->
        <nav class="hide-mobile-dark">
        <div class="col-12 main__news_window">
            <div class="container" style="max-width: 90rem">
                <div class="row" style="align-items: center">

                    <div class="col-xl-6 col-5 main__news_window_photo">
                        <img src="{{asset("./new/images/partners.png")}}" class="main__news_big_photo">
                        <div class="main__news_small_rectangle text-center">
                            <p class="main__news_window_title-time">21.10.2021</p>
                        </div>
                    </div>

                    <div class="col-xl-6 col-7 main__news_window_context">

                        <div class="col-8">
                            <p class="main__news_window_title-head">Новый экологический кодекс РК и борьба с незаконными свалками</p>
                        </div>

                        <div class="col-10 main__news_window_paragraph">
                            <p class="main__news_window_title-description">
                                Государственная политика в управлении твердыми бытовыми отходами, с введением
                                нового Экологического Кодекса претерпела кардинальные изменения.
                            </p>
                        </div>

                        <div class="10">
                            <a href="" class="main__news_window_link">Читать новость</a>
                        </div>

                        <div class="col-12 main__news_window_news">
                            <div class="row">
                                <div class="col-4 main__news_window_news-content">
                                    <div class="col-12 main__news_window_news_dates">
                                        <img src="{{asset("./new/images/newsPhoto.png")}}" class="main__news_window_news-icons">
                                        <div class="main__news_small_rectangle_news text-center align-items-center">
                                            <p class="main__news_window_title-time_news">21.10.2021</p>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <p class="main__news_window_title-news">Новый экологический кодекс РК и борьба с незаконными свалками</p>
                                    </div>
                                    <div class="col-12 text-start"><a href="" class="main__news_window_title-numbers">01</a></div>
                                </div>

                                <div class="col-4 main__news_window_news-content">
                                    <div class="col-12 main__news_window_news_dates">
                                        <img src="{{asset("./new/images/newsPhoto.png")}}" class="main__news_window_news-icons">
                                        <div class="main__news_small_rectangle_news text-center align-items-center">
                                            <p class="main__news_window_title-time_news">21.10.2021</p>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <p class="main__news_window_title-news">Новый экологический кодекс РК и борьба с незаконными свалками</p>
                                    </div>
                                    <div class="col-12 text-start"><a href="" class="active main__news_window_title-numbers">02</a></div>
                                </div>

                                <div class="col-4 main__news_window_news-content">
                                    <div class="col-12 main__news_window_news_dates">
                                        <img src="{{asset("./new/images/newsPhoto.png")}}" class="main__news_window_news-icons">
                                        <div class="main__news_small_rectangle_news text-center align-items-center">
                                            <p class="main__news_window_title-time_news">21.10.2021</p>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <p class="main__news_window_title-news">Новый экологический кодекс РК и борьба с незаконными свалками</p>
                                    </div>
                                    <div class="col-12 text-start"><a href="" class="main__news_window_title-numbers">03</a></div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
        </nav>

        <nav class="show-mobile-dark">
            <div class="col-12 main__news_window">

                <div class="col-12 main__news_window_photo">
                    <img src="{{asset("./new/images/partners.png")}}" class="main__news_big_photo">
                    <div class="main__news_small_rectangle_mini text-center">
                        <p class="main__news_window_title-time">21.10.2021</p>
                    </div>
                </div>

                <div class="container">

                    <div class="row" style="align-items: center">

                        <div class="col-sm-11 col-12 main__news_window_context">

                            <div class="col-sm-8 col-11">
                                <p class="main__news_window_title-head">Новый экологический кодекс РК и борьба с незаконными свалками</p>
                            </div>

                            <div class="col-sm-10 col-12 main__news_window_paragraph">
                                <p class="main__news_window_title-description">
                                    Государственная политика в управлении твердыми бытовыми отходами, с введением
                                    нового Экологического Кодекса претерпела кардинальные изменения.
                                </p>
                            </div>

                            <div class="10">
                                <a href="" class="main__news_window_link">Читать новость</a>
                            </div>

                            <nav class="hide-mobile-service">
                                <div class="col-12 main__news_window_news">
                                    <div class="row">
                                        <div class="col-4 main__news_window_news-content">

                                            <div class="col-12 main__news_window_news_dates">
                                                <img src="{{asset("./new/images/newsPhoto.png")}}" class="main__news_window_news-icons">
                                                <div class="main__news_small_rectangle_news text-center align-items-center">
                                                    <p class="main__news_window_title-time_news">21.10.2021</p>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <p class="main__news_window_title-news">Новый экологический кодекс РК и борьба с незаконными свалками</p>
                                            </div>
                                            <div class="col-12 text-start"><a href="" class="main__news_window_title-numbers">01</a></div>
                                        </div>

                                        <div class="col-4 main__news_window_news-content">

                                            <div class="col-12 main__news_window_news_dates">
                                                <img src="{{asset("./new/images/newsPhoto.png")}}" class="main__news_window_news-icons">
                                                <div class="main__news_small_rectangle_news text-center align-items-center">
                                                    <p class="main__news_window_title-time_news">21.10.2021</p>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <p class="main__news_window_title-news">Новый экологический кодекс РК и борьба с незаконными свалками</p>
                                            </div>
                                            <div class="col-12 text-start"><a href="" class="active main__news_window_title-numbers">02</a></div>
                                        </div>

                                        <div class="col-4 main__news_window_news-content">

                                            <div class="col-12 main__news_window_news_dates">
                                                <img src="{{asset("./new/images/newsPhoto.png")}}" class="main__news_window_news-icons">
                                                <div class="main__news_small_rectangle_news text-center align-items-center">
                                                    <p class="main__news_window_title-time_news">21.10.2021</p>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <p class="main__news_window_title-news">Новый экологический кодекс РК и борьба с незаконными свалками</p>
                                            </div>
                                            <div class="col-12 text-start"><a href="" class="main__news_window_title-numbers">03</a></div>
                                        </div>
                                    </div>
                                </div>
                            </nav>

                            <nav class="show-mobile-service">
                                <div class="col-12 text-center justify-content-center main__news_carousel">
                                    <div id="carouselNews" class="carousel slide show-news pointer-event col-12" data-bs-ride="carousel">

                                        <div class="carousel-inner">
                                            <div class="carousel-item active">

                                                <div class="item_news">

                                                    <div class="carousel-news-element">

                                                        <div class="row">

                                                            <div class="col-4 main__news_window_news-content">
                                                                <div class="col-12">
                                                                    <img src="{{asset("./new/images/newsPhoto.png")}}" class="main__news_window_news-icons">
                                                                    <div class="main__news_small_rectangle_news_carousel text-center align-items-center">
                                                                        <p class="main__news_window_title-time_news">21.10.2021</p>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12">
                                                                    <p class="main__news_window_title-news">Новый экологический кодекс РК и борьба с незаконными свалками</p>
                                                                </div>
                                                                <div class="col-12 text-start"><a href="" class="main__news_window_title-numbers">01</a></div>
                                                            </div>

                                                            <div class="col-4 main__news_window_news-content">
                                                                <div class="col-12">
                                                                    <img src="{{asset("./new/images/newsPhoto.png")}}" class="main__news_window_news-icons">
                                                                    <div class="main__news_small_rectangle_news_carousel text-center align-items-center">
                                                                        <p class="main__news_window_title-time_news">21.10.2021</p>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12">
                                                                    <p class="main__news_window_title-news">Новый экологический кодекс РК и борьба с незаконными свалками</p>
                                                                </div>
                                                                <div class="col-12 text-start"><a href="" class="active main__news_window_title-numbers">02</a></div>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="carousel-item">
                                                <div class="item_news">

                                                    <div class="carousel-news-element">

                                                        <div class="row">

                                                            <div class="col-4 main__news_window_news-content">
                                                                <div class="col-12">
                                                                    <img src="{{asset("./new/images/newsPhoto.png")}}" class="main__news_window_news-icons">
                                                                    <div class="main__news_small_rectangle_news_carousel text-center align-items-center">
                                                                        <p class="main__news_window_title-time_news">21.10.2021</p>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12">
                                                                    <p class="main__news_window_title-news">Новый экологический кодекс РК и борьба с незаконными свалками</p>
                                                                </div>
                                                                <div class="col-12 text-start"><a href="" class="main__news_window_title-numbers">03</a></div>
                                                            </div>

                                                            <div class="col-4 main__news_window_news-content">
                                                                <div class="col-12">
                                                                    <img src="{{asset("./new/images/newsPhoto.png")}}" class="main__news_window_news-icons">
                                                                    <div class="main__news_small_rectangle_news_carousel text-center align-items-center">
                                                                        <p class="main__news_window_title-time_news">21.10.2021</p>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12">
                                                                    <p class="main__news_window_title-news">Новый экологический кодекс РК и борьба с незаконными свалками</p>
                                                                </div>
                                                                <div class="col-12 text-start"><a href="" class="main__news_window_title-numbers">04</a></div>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </nav>

                        </div>

                    </div>

                </div>

            </div>
        </nav>

        <!-- Our services -->
        <div class="col-12 main__services_window">
            <div class="container">
                <div class="row">
                    <div class="col-12 main__services_window_content">
                        <div class="row">

                            <div class="col-md-6 col-11 text-start">
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
                                    <a href=""><img src="{{asset("./new/images/icons/playIcon.png")}}" class="main__services_window_photo-play"></a>
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
                                <p class="main__license-title-description">Каталог на нашем сайте содержит 18 отраслей и более 500 разрешительных документов</p>
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
                                        <button type="button" class="btn btn-outline-success main__success_btn">Скачать инструкцию</button>
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
                                            <button type="button" class="btn btn-outline-success main__success_btn">Скачать КП</button>
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
                                        <button type="button" class="btn btn-outline-success main__success_btn">Скачать инструкцию</button>
                                    </div>
                                </div>

                                <div class="col-4 text-start">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-outline-success main__success_btn">Скачать КП</button>
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
                <div class="row">
                    <div class="col-xl-10 col-12 main__black_window_top">
                        <div class="row justify-content-center">
                            <!-- -->
                            <div class="col-md-11 col-11">
                                <div class="row">
                                    <div class="col-xl-8 col-lg-7 col-md-12">
                                        <div class="col-12">
                                        <p class="main__black_window_title-head">Гарантированный <span class="main__black_window_title-span">результат</span> в любой отрасли</p>
                                        </div>
                                        <!-- with us -->
                                        <div class="col-12 main__black_window_title-with">
                                            С нами
                                        </div>

                                        <!-- list -->
                                        <div class="col-12 main__black_window_title-description">
                                            <div class="col-xl-8 col-lg-10 col-12">
                                                <ul>
                                                    <li class="main__black_window_title-description-list">Закажите услугу сопровождения онлайн у экспертов портала</li>
                                                    <li class="main__black_window_title-description-list" >Получайте гарантированный результат</li>
                                                </ul>
                                            </div>
                                        </div>

                                        <nav class="show-mobile-dark">
                                            <!-- Photo: calendar + computer -->
                                            <div class="col-xl-4 col-lg-5 col-12">
                                                <img src="{{asset('/new/images/icons/calendar.png')}}" class="main__photo-big-icon">
                                            </div>
                                        </nav>

                                        <!-- Button (call) -->
                                        <div class="col-12">
                                            <button type="button" class="btn btn-success main__black_success_btn">Заказать звонок</button>
                                        </div>

                                        <!-- Question -->
                                        <div class="col-12 main__black_window_title-question">
                                            Как действовать без нас?
                                        </div>

                                    </div>

                                    <!-- Photo: calendar + computer -->
                                    <div class="col-xl-4 col-lg-5 col-12">
                                        <nav class="hide-mobile-dark">
                                        <img src="{{asset('/new/images/icons/calendar.png')}}" class="main__photo-big-icon">
                                        </nav>
                                    </div>
                                </div>

                                <!-- Instruction -->
                                <div class="col-12 main__black_window_title-instruction">
                                    <div class="container">
                                        <div class="row justify-content-start">
                                            <ol>
                                                <li class="main__black_window_title-instruction-list">Выберите нужный разрешительный документ </li>
                                                <li class="main__black_window_title-instruction-list">Скачайте пошаговую инструкцию с актуальными требованиями и шаблонами документов</li>
                                                <li class="main__black_window_title-instruction-list">Получите лицензию самостоятельно</li>
                                            </ol>
                                        </div>
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
                                                                            <button type="button" class="btn btn-success main__black_window_success_btn">Продать компанию</button>
                                                                        </div>

                                                                        <div class="col-6 text-center">
                                                                            <button type="button" class="btn btn-outline-success main__black_window_success_btn">Купить компанию</button>
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
                                                            <button type="button" class="btn btn-success main__black_window_success_btn">Продать компанию</button>
                                                        </div>

                                                        <div class="col-12 text-center main__btn-buy">
                                                            <button type="button" class="btn btn-outline-success main__black_window_success_btn">Купить компанию</button>
                                                        </div>

                                                </nav>

                                            </div>
                                        </div>
                                    </div>
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

                            <div class="col-12">
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
                                        <nav class="hide-mobile-page">
                                            <div class="row">
                                                <div class="col-6">
                                                    <button type="button" class="btn btn-outline-success main__lawyer_button">Отраслевой юридический оутсорсинг</button>
                                                </div>

                                                <div class="col-6">
                                                    <button type="button" class="btn btn-success main__lawyer_button">Отраслевой бухгалтерский оутсорсинг</button>
                                                </div>

                                                <div class="col-9 main__lawyer_button_call-layout">
                                                    <button type="button" class="btn btn-success main__lawyer_button_call">Заказать звонок</button>
                                                </div>
                                            </div>
                                        </nav>

                                        <!-- mobile buttons -->
                                        <nav class="show-mobile-page">
                                            <div class="col-sm-11 col-12">
                                            <div class="row">
                                                <div class="col-6">
                                                    <button type="button" class="btn btn-success main__lawyer_button">Отраслевой бухгалтерский оутсорсинг</button>
                                                </div>

                                                <div class="col-6">
                                                    <button type="button" class="btn btn-outline-success main__lawyer_button">Отраслевой юридический оутсорсинг</button>
                                                </div>

                                                <div class="col-12 text-center main__lawyer_button_call-layout">
                                                    <button type="button" class="btn btn-success main__lawyer_button_call">Заказать звонок</button>
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
            <div class="col-12">

                    <div class="container">
                        <div class="col-xl-5 col-lg-7 col-12">
                            <p class="main__partners_window_title-head"> Специальные условия на услуги
                                <span class="main__partners_window_title-span"> наших партнеров </span>
                            </p>
                        </div>
                    </div>

                    <nav class="hide-mobile-dark">

                        <!-- partners - cards -->
                        <div class="col-12 main__partners_cards">
                            <div class="row carousel_row justify-content-center">

                                <!-- cards - carousel -->
                                <div id="carouselExampleControl" class="carousel slide" data-bs-ride="carousel">

                                        <div class="carousel-item active">
                                            <div class="row main__partner_cards_big">

                                                @for($i = 0; $i < 6; $i++)
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <img src="{{asset("./new/images/icons/partnerIcon.png")}}" class="main__partner_cards-photo">
                                                        </div>
                                                    </div>
                                                @endfor

                                            </div>
                                        </div>

                                        <div class="carousel-item">
                                            <div class="row main__partner_cards_big">
                                            @for($i = 0; $i < 6; $i++)
                                                <div class="btn card">
                                                    <div class="card-body">
                                                        <img src="{{asset("./new/images/icons/partnerIcon.png")}}" class="main__partner_cards-photo">
                                                    </div>
                                                </div>
                                            @endfor
                                            </div>
                                        </div>

                                </div>

                            </div>
                        </div>

                        <div class="container">
                            <div class="col-12 main__partners_carousel_arrows">
                                <div class="row">
                                    <div class="col-auto">
                                    <a type="button" data-bs-target="#carouselExampleControl" data-bs-slide="prev">
                                        <i class="bi bi-arrow-left main__partners_carousel_arrows-design"></i>
                                    </a>
                                    </div>

                                    <div class="col-auto">
                                    <a type="button" data-bs-target="#carouselExampleControl" data-bs-slide="next">
                                        <i class="bi bi-arrow-right main__partners_carousel_arrows-design"></i>
                                    </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </nav>

                    <div class="row" style="justify-content: center">

                    <nav class="show-mobile-dark">
                        <div class="col-12 text-center justify-content-center main__partners_carousel">
                            <div id="carouselPartners" class="carousel slide show-partners pointer-event col-12" data-bs-ride="carousel">

                                <div class="carousel-inner">
                                    <div class="carousel-item active">

                                        <div class="item_partners">

                                            <div class="carousel-partners-element">

                                                <nav class="hide-mobile-service">

                                                    <div class="row">

                                                        <div class="col-auto main__news_window_news-content">
                                                            <div class="main__partner_cards">
                                                                <div class="btn card">
                                                                    <div class="card-body">
                                                                        <img src="{{asset("./new/images/icons/partnerIcon.png")}}" class="main__partner_cards-photo">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-auto main__news_window_news-content">
                                                            <div class="main__partner_cards">
                                                                <div class="btn card">
                                                                    <div class="card-body">
                                                                        <img src="{{asset("./new/images/icons/partnerIcon.png")}}" class="main__partner_cards-photo">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-auto main__news_window_news-content">
                                                            <div class="main__partner_cards">
                                                                <div class="btn card">
                                                                    <div class="card-body">
                                                                        <img src="{{asset("./new/images/icons/partnerIcon.png")}}" class="main__partner_cards-photo">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-auto main__news_window_news-content">
                                                            <div class="main__partner_cards">
                                                                <div class="col-auto">
                                                                    <div class="btn card">
                                                                        <div class="card-body">
                                                                            <img src="{{asset("./new/images/icons/partnerIcon.png")}}" class="main__partner_cards-photo">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </nav>

                                                <nav class="show-mobile-service">

                                                    <div class="row">
                                                        <div class="col-auto main__news_window_news-content">
                                                            <div class="main__partner_cards">
                                                                <div class="btn card">
                                                                    <div class="card-body">
                                                                        <img src="{{asset("./new/images/icons/partnerIcon.png")}}" class="main__partner_cards-photo">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-auto main__news_window_news-content">
                                                            <div class="main__partner_cards">
                                                                <div class="col-auto">
                                                                    <div class="btn card">
                                                                        <div class="card-body">
                                                                            <img src="{{asset("./new/images/icons/partnerIcon.png")}}" class="main__partner_cards-photo">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </nav>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="carousel-item">
                                        <div class="item_partners">

                                            <div class="carousel-partners-element">

                                                <nav class="hide-mobile-service">

                                                    <div class="row">

                                                        <div class="col-auto main__news_window_news-content">
                                                            <div class="main__partner_cards">
                                                                <div class="btn card">
                                                                    <div class="card-body">
                                                                        <img src="{{asset("./new/images/icons/partnerIcon.png")}}" class="main__partner_cards-photo">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-auto main__news_window_news-content">
                                                            <div class="main__partner_cards">
                                                                <div class="btn card">
                                                                    <div class="card-body">
                                                                        <img src="{{asset("./new/images/icons/partnerIcon.png")}}" class="main__partner_cards-photo">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-auto main__news_window_news-content">
                                                            <div class="main__partner_cards">
                                                                <div class="btn card">
                                                                    <div class="card-body">
                                                                        <img src="{{asset("./new/images/icons/partnerIcon.png")}}" class="main__partner_cards-photo">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-auto main__news_window_news-content">
                                                            <div class="main__partner_cards">
                                                                <div class="col-auto">
                                                                    <div class="btn card">
                                                                        <div class="card-body">
                                                                            <img src="{{asset("./new/images/icons/partnerIcon.png")}}" class="main__partner_cards-photo">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </nav>

                                                <nav class="show-mobile-service">

                                                    <div class="row">
                                                        <div class="col-auto main__news_window_news-content">
                                                            <div class="main__partner_cards">
                                                                <div class="btn card">
                                                                    <div class="card-body">
                                                                        <img src="{{asset("./new/images/icons/partnerIcon.png")}}" class="main__partner_cards-photo">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-auto main__news_window_news-content">
                                                            <div class="main__partner_cards">
                                                                <div class="col-auto">
                                                                    <div class="btn card">
                                                                        <div class="card-body">
                                                                            <img src="{{asset("./new/images/icons/partnerIcon.png")}}" class="main__partner_cards-photo">
                                                                        </div>
                                                                    </div>
                                                                </div>
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

                        <div class="container">
                            <div class="col-12 main__partners_carousel_arrows">
                                <div class="row">
                                    <div class="col-auto">
                                        <a type="button" data-bs-target="#carouselPartners" data-bs-slide="prev">
                                            <i class="bi bi-arrow-left main__partners_carousel_arrows-design"></i>
                                        </a>
                                    </div>

                                    <div class="col-auto">
                                        <a type="button" data-bs-target="#carouselPartners" data-bs-slide="next">
                                            <i class="bi bi-arrow-right main__partners_carousel_arrows-design"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>

                </div>

                <div class="col-12 text-center">
                    <div class="container">
                            <button type="button" class="btn btn-success main__partners_button">Все партнеры</button>
                    </div>
                </div>

            </div> <!-- Partners window -->

            <!-- Reviews -->
            <div class="col-12 main__reviews_window_layout">

                <div class="container">

                    <div class="col-12">
                        <div class="row">
                            <div class="col-sm-8 col-12">
                                <p class="main__reviews_title-head">
                                    Отзывы тех, кто уже получил лицензию с
                                    <span class="main__reviews_title-span">upperlicense</span>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                <nav class="hide-mobile-dark">


                    <div class="col-12 text-center main__reviews_carousel_big">
                        <div class="container">

                                <div id="carouselReviewControl" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">

                                        <!-- first element for carousel -->
                                        <div class="carousel-item active">

                                            <div class="row">

                                                <div class="col-8 main__reviews_photo">
                                                    <img src="{{asset("./new/images/ReviewPhoto.png")}}" class="main__reviews_photo-main">
                                                    <a href=" https://www.youtube.com/embed/57HJSav5fEU"><img src="{{asset('/new/images/icons/arrowIcon.png')}}" class="main__reviews_photo-play"/></a>
                                                </div>

                                                <div class="col-4">

                                                    <div class="col-12 main__reviews_layout_1">
                                                        <img src="{{asset("./new/images/ReviewPhotoMini.png")}}" class="main__reviews_photo-mini">
                                                        <div class="col-12 main__reviews_title-description-head_layout_1">
                                                            <p class="main__reviews_title-description-head_1">МK «Construction group»</p>
                                                            <p class="main__reviews_title-description-body_1">Лицензия на эксплуатацию горных и химических производств</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 main__reviews_layout_2">
                                                        <img src="{{asset("./new/images/ReviewPhotoMini.png")}}" class="main__reviews_photo-mini">
                                                        <div class="col-12 main__reviews_title-description-head_layout_2">
                                                            <p class="main__reviews_title-description-head_2">МK «Construction group»</p>
                                                            <p class="main__reviews_title-description-body_2">Лицензия на эксплуатацию горных и химических производств</p>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                            <!-- Arrows for carousel -->
                            <div class="col-12 main__reviews_carousel_arrows">
                                <div class="row">
                                    <div class="col-auto">
                                        <a type="button" data-bs-target="#carouselReviewControl" data-bs-slide="prev">
                                            <i class="bi bi-arrow-left main__partners_carousel_arrows-design"></i>
                                        </a>
                                    </div>

                                    <div class="col-auto">
                                        <a type="button" data-bs-target="#carouselReviewControl" data-bs-slide="next">
                                            <i class="bi bi-arrow-right main__partners_carousel_arrows-design"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>

                <nav class="show-mobile-dark">

                    <nav class="hide-mobile-service">
                    <div class="col-12 text-center justify-content-center main__reviews_carousel">
                        <div id="carouselReviews" class="carousel slide show-reviews pointer-event col-12" data-bs-ride="carousel">

                            <div class="carousel-inner">

                                <div class="carousel-item active">

                                    <div class="item_reviews">

                                        <div class="carousel-reviews-element">

                                            <div class="row">

                                                <div class="col-4 main__news_window_news-content">
                                                    <div class="col-12 main__reviews_size">
                                                        <img src="{{asset("./new/images/ReviewPhotoMini.png")}}" class="main__reviews_photo-mini">
                                                        <div class="col-12 main__reviews_title-description-layout_mini_1">
                                                            <p class="main__reviews_title-description-head_1_mini">МK «Construction group»</p>
                                                        </div>
                                                        <div class="col-12 main__reviews_title-description-layout_mini_2">
                                                            <p class="main__reviews_title-description-body_1_mini">Лицензия на эксплуатацию горных и химических производств</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-4 main__news_window_news-content">
                                                    <div class="col-12 main__reviews_photo">
                                                        <img src="{{asset("./new/images/ReviewPhoto.png")}}" class="main__reviews_photo-main">
                                                        <div class="main__reviews_photo-play_mini">
                                                            <a href=" https://www.youtube.com/embed/57HJSav5fEU"><img src="{{asset('/new/images/icons/arrowIcon.png')}}" class="main__reviews_photo-play_mini_icon"/></a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-4 main__news_window_news-content">
                                                    <div class="col-12 main__reviews_size">
                                                        <img src="{{asset("./new/images/ReviewPhotoMini.png")}}" class="main__reviews_photo-mini">
                                                        <div class="col-12 main__reviews_title-description-layout_mini_1">
                                                            <p class="main__reviews_title-description-head_1_mini">МK «Construction group»</p>
                                                        </div>
                                                        <div class="col-12 main__reviews_title-description-layout_mini_2">
                                                            <p class="main__reviews_title-description-body_1_mini">Лицензия на эксплуатацию горных и химических производств</p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div> <!-- Carousel item -->

                            </div>
                        </div>
                    </div>

                    <!-- Arrows for carousel -->
                    <div class="col-12 main__reviews_carousel_arrows">
                        <div class="row">
                            <div class="col-auto">
                                <a type="button" data-bs-target="#carouselReviews" data-bs-slide="prev">
                                    <i class="bi bi-arrow-left main__partners_carousel_arrows-design"></i>
                                </a>
                            </div>

                            <div class="col-auto">
                                <a type="button" data-bs-target="#carouselReviews" data-bs-slide="next">
                                    <i class="bi bi-arrow-right main__partners_carousel_arrows-design"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    </nav>

                    <!--- --->

                    <nav class="show-mobile-service">

                    <div class="col-12 text-center justify-content-center main__reviews_carousel">
                        <div id="carouselReviewsMini" class="carousel slide show-reviews pointer-event col-12" data-bs-ride="carousel">

                            <div class="carousel-inner">

                                <div class="carousel-item active">

                                    <div class="item_reviews">

                                        <div class="carousel-reviews-element">

                                            <div class="row">

                                                <div class="col-4 main__news_window_news-content">
                                                    <div class="col-12 main__reviews_size">
                                                        <img src="{{asset("./new/images/ReviewPhotoMini.png")}}" class="main__reviews_photo-mini">
                                                        <div class="col-12 main__reviews_title-description-layout_mini_1">
                                                            <p class="main__reviews_title-description-head_1_mini">МK «Construction group»</p>
                                                        </div>
                                                        <div class="col-12 main__reviews_title-description-layout_mini_2">
                                                            <p class="main__reviews_title-description-body_1_mini">Лицензия на эксплуатацию горных и химических производств</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-4 main__news_window_news-content">
                                                    <div class="col-12 main__reviews_photo">
                                                        <img src="{{asset("./new/images/ReviewPhoto.png")}}" class="main__reviews_photo-main">
                                                        <div class="main__reviews_photo-play_mini">
                                                            <a href=" https://www.youtube.com/embed/57HJSav5fEU"><img src="{{asset('/new/images/icons/arrowIcon.png')}}" class="main__reviews_photo-play_mini_icon"/></a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-4 main__news_window_news-content">
                                                    <div class="col-12 main__reviews_size">
                                                        <img src="{{asset("./new/images/ReviewPhotoMini.png")}}" class="main__reviews_photo-mini">
                                                        <div class="col-12 main__reviews_title-description-layout_mini_1">
                                                            <p class="main__reviews_title-description-head_1_mini">МK «Construction group»</p>
                                                        </div>
                                                        <div class="col-12 main__reviews_title-description-layout_mini_2">
                                                            <p class="main__reviews_title-description-body_1_mini">Лицензия на эксплуатацию горных и химических производств</p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div> <!-- Carousel item -->

                                <div class="carousel-item">

                                    <div class="item_reviews">

                                        <div class="carousel-reviews-element">

                                            <div class="row">

                                                <div class="col-4 main__news_window_news-content">
                                                    <div class="col-12 main__reviews_photo">
                                                        <img src="{{asset("./new/images/ReviewPhoto.png")}}" class="main__reviews_photo-main">
                                                        <div class="main__reviews_photo-play_mini">
                                                            <a href=" https://www.youtube.com/embed/57HJSav5fEU"><img src="{{asset('/new/images/icons/arrowIcon.png')}}" class="main__reviews_photo-play_mini_icon"/></a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-4 main__news_window_news-content">
                                                    <div class="col-12 main__reviews_size">
                                                        <img src="{{asset("./new/images/ReviewPhotoMini.png")}}" class="main__reviews_photo-mini">
                                                        <div class="col-12 main__reviews_title-description-layout_mini_1">
                                                            <p class="main__reviews_title-description-head_1_mini">МK «Construction group»</p>
                                                        </div>
                                                        <div class="col-12 main__reviews_title-description-layout_mini_2">
                                                            <p class="main__reviews_title-description-body_1_mini">Лицензия на эксплуатацию горных и химических производств</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-4 main__news_window_news-content">
                                                    <div class="col-12 main__reviews_size">
                                                        <img src="{{asset("./new/images/ReviewPhotoMini.png")}}" class="main__reviews_photo-mini">
                                                        <div class="col-12 main__reviews_title-description-layout_mini_1">
                                                            <p class="main__reviews_title-description-head_1_mini">МK «Construction group»</p>
                                                        </div>
                                                        <div class="col-12 main__reviews_title-description-layout_mini_2">
                                                            <p class="main__reviews_title-description-body_1_mini">Лицензия на эксплуатацию горных и химических производств</p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div> <!-- Carousel item -->

                                <div class="carousel-item">

                                    <div class="item_reviews">

                                        <div class="carousel-reviews-element">

                                            <div class="row">

                                                <div class="col-4 main__news_window_news-content">
                                                    <div class="col-12 main__reviews_size">
                                                        <img src="{{asset("./new/images/ReviewPhotoMini.png")}}" class="main__reviews_photo-mini">
                                                        <div class="col-12 main__reviews_title-description-layout_mini_1">
                                                            <p class="main__reviews_title-description-head_1_mini">МK «Construction group»</p>
                                                        </div>
                                                        <div class="col-12 main__reviews_title-description-layout_mini_2">
                                                            <p class="main__reviews_title-description-body_1_mini">Лицензия на эксплуатацию горных и химических производств</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-4 main__news_window_news-content">
                                                    <div class="col-12 main__reviews_size">
                                                        <img src="{{asset("./new/images/ReviewPhotoMini.png")}}" class="main__reviews_photo-mini">
                                                        <div class="col-12 main__reviews_title-description-layout_mini_1">
                                                            <p class="main__reviews_title-description-head_1_mini">МK «Construction group»</p>
                                                        </div>
                                                        <div class="col-12 main__reviews_title-description-layout_mini_2">
                                                            <p class="main__reviews_title-description-body_1_mini">Лицензия на эксплуатацию горных и химических производств</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-4 main__news_window_news-content">
                                                    <div class="col-12 main__reviews_photo">
                                                        <img src="{{asset("./new/images/ReviewPhoto.png")}}" class="main__reviews_photo-main">
                                                        <div class="main__reviews_photo-play_mini">
                                                            <a href=" https://www.youtube.com/embed/57HJSav5fEU"><img src="{{asset('/new/images/icons/arrowIcon.png')}}" class="main__reviews_photo-play_mini_icon"/></a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div> <!-- Carousel item -->

                            </div>
                        </div>
                    </div>

                    <!-- Arrows for carousel -->
                    <div class="container">
                        <div class="col-12 main__reviews_carousel_arrows">
                            <div class="row">
                                <div class="col-auto">
                                    <a type="button" data-bs-target="#carouselReviewsMini" data-bs-slide="prev">
                                        <i class="bi bi-arrow-left main__reviews_carousel_arrows-design"></i>
                                    </a>
                                </div>

                                <div class="col-auto">
                                    <a type="button" data-bs-target="#carouselReviewsMini" data-bs-slide="next">
                                        <i class="bi bi-arrow-right main__reviews_carousel_arrows-design"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    </nav>

                </nav>



{{--                                        <nav class="show-mobile-dark">--}}

{{--                                            <nav class="hide-mobile-page">--}}

{{--                                            <div class="carousel-item active">--}}

{{--                                                <div class="row">--}}

{{--                                                    <div class="col-4">--}}
{{--                                                        <div class="col-12 main__reviews_layout_1">--}}
{{--                                                            <img src="{{asset("./new/images/ReviewPhotoMini.png")}}" class="main__reviews_photo-mini">--}}
{{--                                                            <div class="col-8 main__reviews_title-description-head_layout_1_mini">--}}
{{--                                                                <p class="main__reviews_title-description-head_1_mini">МK «Construction group»</p>--}}
{{--                                                                <p class="main__reviews_title-description-body_1_mini">Лицензия на эксплуатацию горных и химических производств</p>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-4 main__reviews_photo">--}}
{{--                                                        <img src="{{asset("./new/images/ReviewPhoto.png")}}" class="main__reviews_photo-main">--}}
{{--                                                        <a href=" https://www.youtube.com/embed/57HJSav5fEU"><img src="{{asset('/new/images/icons/arrowIcon.png')}}" class="main__reviews_photo-play_mini"/></a>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="col-4">--}}
{{--                                                        <div class="col-12 main__reviews_layout_2">--}}
{{--                                                            <img src="{{asset("./new/images/ReviewPhotoMini.png")}}" class="main__reviews_photo-mini">--}}
{{--                                                            <div class="col-12 main__reviews_title-description-head_layout_2_mini">--}}
{{--                                                                <p class="main__reviews_title-description-head_2_mini">МK «Construction group»</p>--}}
{{--                                                                <p class="main__reviews_title-description-body_2_mini">Лицензия на эксплуатацию горных и химических производств</p>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                </div>--}}

{{--                                            </div>--}}

{{--                                            </nav>--}}

{{--                                            <nav class="show-mobile-page">--}}

{{--                                                <div class="carousel-item">--}}
{{--                                                    <div class="col-6">--}}
{{--                                                        <div class="col-12 main__reviews_layout_2">--}}
{{--                                                            <img src="{{asset("./new/images/ReviewPhotoMini.png")}}" class="main__reviews_photo-mini">--}}
{{--                                                            <div class="col-12 main__reviews_title-description-head_layout_1_mini">--}}
{{--                                                                <p class="main__reviews_title-description-head_2_mini">МK «Construction group»</p>--}}
{{--                                                                <p class="main__reviews_title-description-body_2_mini">Лицензия на эксплуатацию горных и химических производств</p>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                                <div class="carousel-item active">--}}
{{--                                                    <div class="row justify-content-center">--}}
{{--                                                    <div class="col-6 main__reviews_photo">--}}
{{--                                                        <img src="{{asset("./new/images/ReviewPhoto.png")}}" class="main__reviews_photo-main">--}}
{{--                                                        <a href=" https://www.youtube.com/embed/57HJSav5fEU"><img src="{{asset('/new/images/icons/arrowIcon.png')}}" class="main__reviews_photo-play_mini"/></a>--}}
{{--                                                    </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                                <div class="carousel-item">--}}
{{--                                                    <div class="col-6">--}}
{{--                                                        <div class="col-12 main__reviews_layout_2">--}}
{{--                                                            <img src="{{asset("./new/images/ReviewPhotoMini.png")}}" class="main__reviews_photo-mini">--}}
{{--                                                            <div class="col-12 main__reviews_title-description-head_layout_2_mini">--}}
{{--                                                                <p class="main__reviews_title-description-head_2_mini">МK «Construction group»</p>--}}
{{--                                                                <p class="main__reviews_title-description-body_2_mini">Лицензия на эксплуатацию горных и химических производств</p>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                            </nav>--}}

{{--                                        </nav>--}}


                <div class="col-12 text-center main__reviews_button">
                    <button type="button" class="btn btn-success main__partners_button">Отзывы довольных клиентов</button>
                </div>

            </div> <!-- Reviews window -->

    </div>
@endsection

@section('js')
    <script>

        $(document).ready(function ()
        {

            // auto scroll off
            $("#carouselItem").carousel({
                interval: false,
            });

            for (let i = 0; i < 17; i++) {
                for (let j = 0; j < 1; j++) {
                    $(".cd-" + i).click(function () {
                        if($(".main__card_window").hasClass("show"))
                        {
                            $(".main__card_window .show").removeClass("show");
                        }
                        $(".win-" + i + "-" + j).toggle();
                    });
                }
            }


            // cards (show / hide)
            $(window).resize(function() {
                if ($(this).width() < 768) {
                    for (let i = 8; i <= 16; i++) {
                        $(".cd-" + i).hide();
                    }
                }
                else
                {
                    for (let i = 8; i <= 16; i++) {
                        $(".cd-" + i).show();
                    }
                }
            });

            $(".main__card_button").click(function (){
                for (let i = 8; i <= 16; i++) {
                    $(".cd-" + i).show();
                }
                 $(".main__cards_button").hide();
                 $(".main__cards_button_hide").show();
            });

            $(".main__card_button_hide").click(function (){
                for (let i = 8; i <= 16; i++) {
                    $(".cd-" + i).hide();
                }
                $(".main__cards_button_hide").hide();
                $(".main__cards_button").show();
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
