<header class="header-new w-100 {{Request::url() === url(route('new-home')) ? 'header_home' : ''}}">
    <div class="container" style="max-width: 1440px">
        <div class="px-md-12">
            <nav class="hide-mobile-header-new d-none d-xl-block">
                <div class="row align-items-center justify-content-center">

                    <!-- logo -->
                    <div class="col-2 text-center logo">
                        <a href="/" class="header-new__logo">
                            <img src="{{asset('/new/images/icons/logo.png')}}" alt="logo"/>
                            <img src="{{asset('/new/images/icons/Burger_logo.png')}}" alt="logo"/>
                        </a>
                    </div>

                    <!-- Menu -->
                    <div class="col-3 col-xl-auto text-center links-menu">
                        <ul class="nav header-new__menu">
                            @include('layouts.menu')
                        </ul>
                    </div>

                    <!-- burger with animation -->
                    <div class="col-xxl-1 col-xl-1 text-center burger">
                        <i class="bi bi-list header-new__burger-icon"></i>
                        <i class="bi bi-x header-new__burger-icon"></i>
                    </div>

                    <!-- Language dropdown -->
                    @if((Auth::check() && Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client)) || !Auth::check())
                        <div class="col-auto text-xxl-end text-xl-end header-new__language_dropdown elements">
                            <div class="row">

                                <div class="col-auto">
                                    <div class="language-links">
                                        <ul class="nav-element">

                                            <li>
                                                @if(\Illuminate\Support\Facades\App::getLocale() == "ru")
                                                    <a href="" class="header-new__language_dropdown-element">
                                                      Русский
                                                    </a>
                                                    <a href="" class="header-new__language_dropdown-element-white">
                                                      Русский
                                                    </a>
                                                @else
                                                    <a href="" class="header-new__language_dropdown-element">
                                                      English
                                                    </a>
                                                    <a href="" class="header-new__language_dropdown-element-white">
                                                      English
                                                    </a>
                                                @endif

                                                <ul class="submenu">
                                                    <li>
                                                        <a rel="alternate" hreflang="ru"
                                                           href="{{ LaravelLocalization::getLocalizedURL("ru", null, [], true) }}">
                                                          Русский
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a rel="alternate" hreflang="en"
                                                           href="{{ LaravelLocalization::getLocalizedURL("en", null, [], true) }}">
                                                          English
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>

                                        </ul>
                                    </div>
                                </div>

                                <div class="col-auto text-start language-header-icons">
                                    <i class="bi bi-chevron-down header-new__dropdown-icon arrow-down px-1"></i>
                                    <i class="bi bi-chevron-up header-new__dropdown-icon arrow-up px-1"
                                       style="display: none"></i>
                                </div>

                            </div>

                        </div>
                    @endif

                    <div class="col-auto text-xxl-center text-xl-end cabinet">
                        @if(Auth::check())
                            <div class="dropdown">
                                <a class="nav-link" href="#" id="profileDropdown" role="button"
                                   data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                    @if(Auth::user()->profile->photo_id !=null)
                                        <img src="/storage_/{{Auth::user()->profile->photo_path}}"
                                             class="profile-photo_icon rounded-circle">
                                    @else
                                        <i class="bi bi-person-circle header-new__icons"></i>
                                        Личный кабинет
                                    @endif
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                                    @if(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client))
                                        <a class="dropdown-item"
                                           href="{{route('Client.service.list')}}">@lang('messages.layouts.personal_services')</a>
                                        <a class="dropdown-item"
                                           href="{{route('profile.documentList')}}">@lang('messages.layouts.personal_documents')</a>
                                        <a class="dropdown-item"
                                           href="{{route('profile.bookkeeping')}}">@lang('messages.layouts.personal_bookkeeping')</a>
                                        <a class="dropdown-item"
                                           href="{{route('profile')}}">@lang('messages.layouts.personal_area')</a>

                                    @endif

                                    <a class="dropdown-item" href="{{route('logout')}}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    >
                                        @lang('messages.layouts.logout')</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
                            </div>
                        @else
                            <button class="header-new__btn px-0 login">
                                <i class="bi bi-person-circle header-new__icons"></i>
                                Личный кабинет
                            </button>

                            <button class="header-new__btn-white px-0 login">
                                <i class="bi bi-person-circle header-new__icons"></i>
                                Личный кабинет
                            </button>
                        @endif
                    </div>


                    @if((Auth::check() && Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client)) || !Auth::check())
                    <!-- call button -->
                    <div class="col-xxl-2 text-xxl-end header-new__btn_burger col-xl-2 text-xl-end">
                        <button class="btn btn-success" id="phoneDropdown" data-bs-toggle="modal"
                                data-bs-target="#consultModal"
                                aria-expanded="false">
                            <i class="bi bi-telephone-fill me-2" style="color: white"></i>
                            Заказать звонок
                        </button>
                    </div>
                    @endif
                </div>

            </nav>

            <nav class="show-mobile-header-new">
                <div class="row align-items-center">
                    <div class="col-sm-3 col-5 logo_mini">
                        <!-- logo-mini (mobile device) -->
                        <a href="/">
                            <img src="{{asset('/new/images/icons/logo.png')}}" class="header-new__logo-small"
                                 alt="logo-sm"/>
                            <img src="{{asset('/new/images/icons/Burger_logo.png')}}" class="header-new__logo-small"
                                 alt="burger-logo"/>
                        </a>
                    </div>

                    <div class="col-sm-9 col-7 text-end">
                        <!-- call button -->
                        <div class="row align-items-center">

                            <div class="col-md-11 col-sm-10 col-9 text-end btn_mini">
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#consultModal">
                                    <i class="bi bi-telephone-fill me-2" style="color: white"></i>
                                    Заказать звонок
                                </button>

                                <button class="header-new__btn">
                                    <i class="bi bi-search header-new__search-icon"></i>
                                </button>

                                @if(Auth::check())
                                    <button class="dropdown header-new__btn" style="overflow: inherit !important;">
                                        <a class="nav-link" href="#" id="profileDropdown" role="button"
                                           data-bs-toggle="dropdown"
                                           aria-expanded="false">
                                            @if(Auth::user()->profile->photo_id !=null)
                                                <img src="/storage_/{{Auth::user()->profile->photo_path}}"
                                                     class="profile-photo_icon rounded-circle">
                                            @else
                                                <i class="bi bi-person-circle header-new__search-icon"></i>
                                            @endif
                                        </a>

                                        <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                                            @if(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client))
                                                <a class="dropdown-item"
                                                   href="{{route('Client.service.list')}}">@lang('messages.layouts.personal_services')</a>
                                                <a class="dropdown-item"
                                                   href="{{route('profile.documentList')}}">@lang('messages.layouts.personal_documents')</a>
                                                <a class="dropdown-item"
                                                   href="{{route('profile.bookkeeping')}}">@lang('messages.layouts.personal_bookkeeping')</a>
                                                <a class="dropdown-item"
                                                   href="{{route('profile')}}">@lang('messages.layouts.personal_area')</a>

                                            @endif

                                            <a class="dropdown-item" href="{{route('logout')}}"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            >
                                                @lang('messages.layouts.logout')</a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  style="display: none;">
                                                @csrf
                                            </form>
                                        </ul>
                                    </button>
                                @else
                                     <button class="header-new__btn login">
                                        <i class="bi bi-person-circle header-new__search-icon"></i>
                                    </button>
                                @endif
                            </div>

                            <!-- dropdown burger -->
                            <div class="col-md-1 col-sm-2 col-3 text-start burger_mobile">
                                <i class="bi bi-list header-new__burger-icon"></i>
                                <i class="bi bi-x header-new__burger-icon"></i>
                            </div>
                        </div>
                    </div>

                </div>

            </nav>

        </div>
    </div>

    <nav class="navbar">

        <div class="col-12 header-new__content">
            <div class="row">

                <nav class="hide-mobile-header d-none d-md-block">

                    <div class="col-xxl-10 col-11 header-new__burger_content">

                        <div class="row">

                            <div class="col-8">

                                <div class="row">

                                    <div class="col-xl-auto col-6">
                                        <div class="col-12 header-new__burger_content-elements drop-element-0">
                                            <ul class="list_menu">
                                                <li><a href="#" class="header-new__burger_content-link">Школа
                                                        лицензирования
                                                        <i class="bi bi-chevron-up a-up-0 px-2"
                                                           style="display: none"></i>
                                                        <i class="bi bi-chevron-down a-down-0 px-2"></i>
                                                    </a>
                                                    <ul class="submenu">
                                                        <li><a href="{{route('news.npa.list')}}">Изменение НПА</a></li>
                                                        <li><a href="{{route('news.expert.list')}}">Контент от экспертов</a></li>
                                                        <li><a href="{{route('news.government_agencies.list')}}">Контент от государственных органов</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="col-12 header-new__burger_content-elements  drop-element-1">
                                            <ul class="list_menu">
                                                <li>
                                                    <a href="#" class="header-new__burger_content-link">Календарь
                                                        событий
                                                    </a>
                                                    <ul class="submenu">
                                                        <li></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-xl-auto col-6">
                                        <div class="col-12 header-new__burger_content-elements">
                                            <a href="{{route('news.list')}}" class="header-new__burger_content-link">Новости</a>
                                        </div>
                                        <div class="col-12 header-new__burger_content-elements">
                                            <a href="{{route('check_partner.index')}}" class="header-new__burger_content-link">
                                                Проверка партнера
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-xxl-auto col-xl-3 col-6">
                                        <div class="col-12 header-new__burger_content-elements">
                                            <a href="{{route('new-reviews')}}" class="header-new__burger_content-link">Отзывы</a>
                                        </div>
                                        <div class="col-12 header-new__burger_content-elements">
                                            <a href="{{route('oked.index')}}" class="header-new__burger_content-link">ТНВЭД</a>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-12 text-start">
                                        <div class="col-12 header-new__burger_content-elements text-start">
                                            <a href="{{route('news.faq.list')}}" class="header-new__burger_content-link">Вопрос-ответ</a>
                                        </div>
                                    </div>


                                </div>

                            </div>

                            <div class="col-4 header-new__video_description_column">
                                <div class="col-xl-8 col-9">
                                    <p class="header-new__burger_title-head">Где и зачем нужны лицензии?</p>
                                </div>

                                <div class="col-8 header-new__burger_video">
                                    <img src="{{asset('/new/images/icons/burger_video.png')}}"
                                         class="header-new__burger_video-picture"/>
                                    <a data-url="https://www.youtube.com/embed/57HJSav5fEU"><img
                                                src="{{asset('/new/images/icons/play_btn.png')}}"
                                                class="header-new__burger_video-play play-video"/></a>
                                </div>

                                <div class="col-7 header-new__burger_white_element">
                                    <div class="col-10 header-new__text_field">
                                        <p class="header-new__burger_title-description">
                                            Как получить медицинскую лицензию в Казахстане?
                                        </p>
                                    </div>

                                    <div class="col-10 header-new__text_field">
                                        <p class="header-new__burger_title-description-black">
                                            Лицензирование медицинской деятельности в Республике Казахстан находится под
                                            особым контролем.
                                        </p>
                                    </div>
                                </div>

                                <div class="col-xl-8 col-9 header-new__burger_social">
                                    <div class="row">

                                        <div class="col-4 text-start">
                                            <div class="row justify-content-center">
                                                <div class="col-3 text-start">
                                                    <i class="bi bi-facebook header-new__burger_icons"></i>
                                                </div>
                                                <div class="col-3 text-start">
                                                    <i class="bi bi-telegram header-new__burger_icons"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-8 text-center header-new__burger_icons-mail">
                                            <div class="col-12">
                                                <span><i class="bi bi-envelope-fill"
                                                         style="color: #008c5e"></i></span><a
                                                        class="px-1 header-new__burger_title-email"
                                                        href="mailto:info@license.kz">info@license.kz</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </nav>

                <nav class="show-mobile-header-new">

                    <div class="col-11 header-new__burger_mobile_content text-start">

                        <div class="col-12">
                            <div class="row">

                                <!-- Mobile menu -->
                                <div class="col-lg-8 col-sm-6 col-5 text-start">
                                    <ul class="header-new__burger_mobile_menu">
                                        <li><a href="{{route('new-index')}}" class="active nav-link header-new__burger_mobile_menu-item">Главная</a>
                                        </li>
                                        <li><a href="{{route('new-about')}}" class="nav-link header-new__burger_mobile_menu-item">О нас</a>
                                        </li>
                                        <li><a href="{{route('new-partners')}}" class="nav-link header-new__burger_mobile_menu-item">Партнерская
                                                сеть</a></li>
                                    </ul>
                                </div>

                                <div class="col-lg-4 col-sm-6 col-7 text-start">

                                    <!-- Школа лицензирования -->
                                    <div class="col-12 header-new__burger_mobile_content-elements">
                                        <div class="row">
                                            <div class="col-md-8 col-10 drop-mobile-element-0">
                                                <ul class="list_menu">
                                                    <li>
                                                        <a href="#" class="header-new__burger_mobile_content-link">Школа
                                                            лицензирования</a>
                                                        <ul class="submenu">
                                                            <li><a href="{{route('news.npa.list')}}">Изменение НПА</a></li>
                                                            <li><a href="{{route('news.expert.list')}}">Контент от экспертов</a></li>
                                                            <li><a href="{{route('news.government_agencies.list')}}">Контент от государственных органов</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-2 drop-element-icon-0">
                                                <a href="#" class="header-new__burger_mobile_content-link-icon">
                                                    <i class="bi bi-chevron-up a-mobile-up-0" style="display: none"></i>
                                                    <i class="bi bi-chevron-down a-mobile-down-0"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Календарь событий -->
                                    <div class="col-12 header-new__burger_mobile_content-elements">
                                        <div class="row">
                                            <div class="col-md-8 col-10 drop-mobile-element-1">
                                                <ul class="list_menu">
                                                    <li>
                                                        <a href="#" class="header-new__burger_mobile_content-link">Календарь
                                                            событий</a>
                                                        <ul class="submenu">
                                                            <li></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="col-2 drop-element-icon-1">
                                                <a href="#" class="header-new__burger_mobile_content-link-icon">
                                                    <i class="bi bi-chevron-up a-mobile-up-1" style="display: none"></i>
                                                    <i class="bi bi-chevron-down a-mobile-down-1"></i>
                                                </a>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- Новости -->
                                    <div class="col-12 header-new__burger_mobile_content-elements">
                                        <div class="row">
                                            <div class="col-md-8 col-10 drop-mobile-element-2">
                                                <a href="{{route('news.list')}}" class="header-new__burger_mobile_content-link">Новости</a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Проверка партнера -->
                                    <div class="col-12 header-new__burger_mobile_content-elements">
                                        <div class="row">
                                            <div class="col-md-8 col-10 drop-mobile-element-3">
                                                <a href="{{route('check_partner.index')}}" class="header-new__burger_mobile_content-link">
                                                    Проверка партнера
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Отзывы -->
                                    <div class="col-12 header-new__burger_mobile_content-elements">
                                        <div class="row">
                                            <div class="col-md-8 col-10 drop-mobile-element-4">
                                                <a href="{{route('new-reviews')}}" class="header-new__burger_mobile_content-link">Отзывы</a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ТНВЭД -->
                                    <div class="col-12 header-new__burger_mobile_content-elements">
                                        <div class="row">
                                            <div class="col-md-8 col-10 drop-mobile-element-5">
                                                <a href="{{route('oked.index')}}" class="header-new__burger_mobile_content-link">ТНВЭД</a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Вопрос-ответ -->
                                    <div class="col-12 header-new__burger_mobile_content-elements">
                                        <div class="row">
                                            <div class="col-md-8 col-10 drop-mobile-element-6">
                                                <a href="{{route('news.faq.list')}}"
                                                   class="header-new__burger_mobile_content-link">Вопрос-ответ</a>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">

                                <div class="col-md-3 col-4 text-md-center text-start" style="margin-left: 1rem">
                                    <i class="bi bi-facebook header-new__burger_icons"></i>
                                    <i class="bi bi-telegram header-new__burger_icons"></i>
                                </div>

                                <div class="col-md-3 col-12 text-md-center text-start header-new__language_mobile_dropdown">
                                    <div class="row justify-content-start">

                                        <div class="col-auto text-start" style="margin-left: 1rem">
                                            <div class="language-mobile-links">
                                                <ul class="nav-element">
                                                    <li>
                                                        <a href="" class="header-new__language_dropdown-element-white">Русский</a>
                                                        <ul class="submenu">
{{--                                                            <li><a href="">На казахском</a></li>--}}
                                                            <li><a href="">English</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-auto text-start language-icons">
                                            <i class="bi bi-chevron-down header-new__dropdown-icon arrow-mobile-down"></i>
                                            <i class="bi bi-chevron-up header-new__dropdown-icon arrow-mobile-up"
                                               style="display: none"></i>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-3 col-6 text-center">
                                    <span><i class="bi bi-telephone-fill" style="color: #008c5e"></i></span><a
                                            class="px-1 footer__text-st" href="tel: +7 (747) 135-0000"
                                            style="font-size: 14px">+7 (747) 135-0000</a>
                                </div>

                                <div class="col-md-auto col-6 text-center">
                                    <span><i class="bi bi-envelope-paper-fill" style="color: #008c5e"></i></span><a
                                            class="px-1 footer__text-st"
                                            href="mailto:info@license.kz">info@license.kz</a>
                                </div>

                            </div>
                        </div>

                    </div>

                </nav>

            </div>
        </div>

    </nav>

</header>
<div class="modals">
    <div class="modal fade" id="consultModal" tabindex="-1" aria-labelledby="consultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-12">
                        <div class="row justify-content-end">
                            <div class="col-lg-1 col-auto text-start">
                                <button type="button" class="btn btn-x" data-bs-dismiss="modal" aria-label="Close"><i
                                            class="bi bi-x-circle modals__icon"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
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
    </div>
</div>
<div id="video-overlay" class="video-overlay">
    <a class="video-overlay-close">&times;</a>
</div>
@section('header-js')
    <script>
        $(document).ready(function () {
            const burger = document.querySelector('.burger');
            const burger_mobile = document.querySelector('.burger_mobile');
            const navbar = document.querySelector('.navbar');
            const logo = document.querySelector('.logo');
            const logo_mini = document.querySelector('.logo_mini');
            const btn_mini = document.querySelector('.btn_mini');
            const links = document.querySelector('.links-menu');
            const elements = document.querySelector('.elements');
            const cabinet = document.querySelector('.cabinet');
            const logins = document.querySelectorAll('.login');

            for (let i = 0; i < logins.length; i++) {
                logins[i].addEventListener("click", function() {
                    window.location.href = '{{ route('login') }}'
                });
            }

            burger.addEventListener('click', () => {
                navbar.classList.toggle('nav-open');
                logo.classList.toggle('logo-open');
                logo_mini.classList.toggle('logo_mini-open');
                links.classList.toggle('links-menu-open');
                burger.classList.toggle('burger-open');
                btn_mini.classList.toggle('btn_mini-open');
                burger_mobile.classList.toggle('burger_mobile-open')
                elements.classList.toggle('elements-open');
                cabinet.classList.toggle('cabinet-open');
            });

            burger_mobile.addEventListener('click', () => {
                navbar.classList.toggle('nav-open');
                logo.classList.toggle('logo-open');
                logo_mini.classList.toggle('logo_mini-open');
                btn_mini.classList.toggle('btn_mini-open');
                links.classList.toggle('links-menu-open');
                burger_mobile.classList.toggle('burger_mobile-open')
                burger.classList.toggle('burger-open');
                elements.classList.toggle('elements-open');
                cabinet.classList.toggle('cabinet-open');
            });

            // $(".language-links li:has(.submenu)").hover(
            //     function () {
            //         $(".arrow-down").stop().toggle();
            //         $(".arrow-up").stop().toggle();
            //     }
            // );

            $(".language-mobile-links li ul").hide();
            $(".language-icons").hover(
                function () {
                    $(".arrow-mobile-down").stop().toggle();
                    $(".arrow-mobile-up").stop().toggle();
                    $(".language-mobile-links li ul").stop().fadeToggle(300);
                }
            );

            $(".language-links li ul").hide();
            $(".language-header-icons, .language-links").hover(
                function () {
                    $(".arrow-down").stop().toggle();
                    $(".arrow-up").stop().toggle();
                    $(".language-links li ul").stop().fadeToggle(300);
                }
            );

            $('input[name="phone"]').inputmask("+7 (999) 999-99-99");

            $('.callMe').submit(function () {

                $('.modals__success_btn', this).attr('disabled', true);
                $(this).ajaxSubmit({
                    success: function () {
                        gtag('event', 'send', {'event_category': 'callback'});
                        $('#consultModal .modals__success_btn').attr('disabled', false);

                        // let myModalEl = document.getElementById('consultModal')
                        // let modal = bootstrap.Modal.getInstance(myModalEl);
                        // modal.hide();

                      $('#consultModal input').val('')
                      $('#consultModal .btn-x').click()

                        setTimeout(() => {
                            alert("@lang('messages.client.service_create')")
                        }, 500);
                    }
                })

                return false
            })
try {
  $(".search-mobile-modal #SearchMobileModal").autocomplete({
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
    ul.addClass('search-mobile-modal__autocomplete')
    return $("<li>")
      .append("<div>" + item.name + "</div>")
      .appendTo(ul);
  };
} catch (e) {

}

            for (let i = 0; i < 7; i++) {
                $(".drop-mobile-element-" + i + " li ul").hide();
                $(".drop-element-icon-" + i).hover(
                    function () {
                        $(".a-mobile-down-" + i).stop().toggle();
                        $(".a-mobile-up-" + i).stop().toggle();
                        $(".drop-mobile-element-" + i + " li ul").stop().fadeToggle(300);
                    }
                );
            }

            for (let i = 0; i < 7; i++) {
                $(".drop-element-" + i + " li ul").hide();
                $(".drop-element-" + i + " li:has(.submenu)").hover(
                    function () {
                        $(".a-down-" + i).stop().toggle();
                        $(".a-up-" + i).stop().toggle();
                        $(".drop-element-" + i + " li ul").stop().fadeToggle(300);
                    }
                );
            }

        });

        function setAdditionalDataToSendForm(tag, comment){
            let parent = $('#consultModal');
            $('input[name="tags"]', parent).val(tag)
            $('input[name="comment"]', parent).val(comment)
        }
    </script>
@endsection
