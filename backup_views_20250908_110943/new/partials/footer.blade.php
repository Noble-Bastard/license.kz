<footer class="footer">
    <div class="footer__body">
        <div class="container px-md-4">
            <nav class="hide-mobile-footer">
                <div class="row">
                    <div class="col-5">
                        <div class="col-12">
                            <div class="row">
                                <!-- Logo -->
                                <div class="col-xl-4 col-md-12">
                                    <a href="/">
                                        <img src="{{asset('/new/images/icons/footer_logo.png')}}" alt="logo"/>
                                    </a>
                                </div>
                                <!-- Description -->
                                <div class="col-xl-6 col-md-12">
                                    <p class="footer__description">Онлайн платформа по получению всех видов лицензий и разрешений.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-11 col-md-12" style="margin-top: 1%">
                            <p class="footer__description">
                                UPPERLICENSE не является государственным органом и не представляет какой-либо официальный
                                орган. Все названия продуктов, логотипы и бренды являются собственностью их владельцев.
                                Все названия компаний, органов власти, реестра, продуктов и услуг, используемые на этом
                                веб-сайте, используются только в целях идентификации. Использование этих названий, логотипов
                                и брендов не означает одобрения.
                            </p>
                        </div>
                    </div>

                    <!-- Menu-links -->
                    <div class="col-2">
                        <div class="row justify-content-center">
                            <div class="col-10">
                                <ul class="nav footer__menu">
                                    <li class="nav-link footer__menu-item_main">Меню</li>
                                    <li><a href="{{route('new-index')}}" class="active nav-link footer__menu-item">Главная</a></li>
                                    <li><a href="{{route('new-about')}}" class="nav-link  footer__menu-item">О нас</a></li>
                                    <li><a href="{{route('new-partners')}}" class="nav-link  footer__menu-item">Партнерская сеть</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="row footer__row">
                            <!-- Button user-page -->
                            <div class="col-12 py-1">
                                <button class="footer__btn px-0 login">
                                    <i class="bi bi-person-circle footer__icons"></i>
                                    Личный кабинет
                                </button>
                            </div>

                            <!-- Search -->
{{--                            <div class="col-12 text-start py-2">--}}
{{--                                <div class="footer__search-box">--}}
{{--                                    <button class="footer__btn-search"><i class="bi bi-search"></i></button>--}}
{{--                                    <input type="text" class="footer__input-search" aria-label="search">--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <!-- Language dropdown -->
                            <div class="col-12 footer__language_dropdown py-1 mt-2">
                                <div class="row">

                                    <div class="col-auto">
                                        <div class="language-footer-links">
                                            <ul class="nav-footer-element">

                                                <li>
                                                    @if(\Illuminate\Support\Facades\App::getLocale() == "ru")
                                                        <a href="" class="footer__language_dropdown-element">Русский</a>
                                                    @else
                                                        <a href="" class="footer__language_dropdown-element">English</a>
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

                                    <div class="col-auto text-start language-footer-icons">
                                        <i class="bi bi-chevron-down footer__dropdown-icon arrow-down px-1"></i>
                                        <i class="bi bi-chevron-up footer__dropdown-icon arrow-up px-1" style="display: none"></i>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="col-12">
                            <div class="row align-items-center">
                                <!-- tel number -->
                                <div class="col-xxl-6 col-xl-12 text-end footer__text">
                                    <span><i class="bi bi-telephone-fill" style="color: #008c5e"></i></span><a class="px-1 footer__text-st" href="tel: +7 (747) 135-0000" style="font-size: 14px">+7 (747) 135-0000</a>
                                </div>
                                <!-- Email -->
                                <div class="col-xxl-6 col-xl-12 text-end footer__text">
                                    <span><i class="bi bi-envelope-paper-fill" style="color: #008c5e"></i></span><a class="px-1 footer__text-st" href="mailto:info@license.kz">info@license.kz</a>
                                </div>
                            </div>
                        </div>
                        <!-- icons (social networks)-->
                        <div class="col-12 footer__social text-end">

                                <a
                                    href="#"
                                    class="px-1 footer__social-icons">
                                    <img src="{{asset('/new/images/icons/inst_logo.png')}}" alt="inst"/>
                                </a>

                                <a
                                    href="#"
                                    class="px-1 footer__social-icons">
                                    <img src="{{asset('/new/images/icons/telegram_logo.png')}}" alt="telegram"/>
                                </a>

                                <a
                                    href="#"
                                    class="px-1 footer__social-icons">
                                    <img src="{{asset('/new/images/icons/facebook_logo.png')}}" alt="facebook"/>
                                </a>

                                <a
                                    href="#"
                                    class="px-1 footer__social-icons">
                                    <img src="{{asset('/new/images/icons/in_logo.png')}}" alt="in"/>
                                </a>

                                <a
                                    href="#"
                                    class="px-1 footer__social-icons">
                                    <img src="{{asset('/new/images/icons/youTube_logo.png')}}" alt="YouTube"/>
                                </a>

                        </div>
                    </div>
                </div>
            </nav>

            <nav class="show-mobile-footer">
                <div class="col-12">
                    <div class="row align-items-start">
                        <div class="col-6 col-md-7 text-start">
                            <!-- (Mobile) Company logo -->
                            <div class="col-12">
                                <a href="/">
                                    <img src="{{asset('/new/images/icons/footer_logo.png')}}" alt="logo"/>
                                </a>
                            </div>
                            <!-- (Mobile) Description -->
                            <div class="col-12 py-1">
                                <p class="footer__description">Онлайн платформа по получению всех видов лицензий и разрешений.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-5 text-end">
                            <!-- (Mobile) Tel num -->
                            <div class="col-12 footer__text">
                                <span><i class="bi bi-telephone-fill" style="color: #008c5e"></i></span><a class="px-1 footer__text-st-mobile" href="tel: +7 (747) 135-0000" style="font-size: 14px">+7 (747) 135-0000</a>
                            </div>
                            <!-- (Mobile) Email -->
                            <div class="col-12 py-1">
                                <span><i class="bi bi-envelope-paper-fill" style="color: #008c5e"></i></span><a class="px-1 footer__text-st-mobile" href="mailto:info@license.kz">info@license.kz</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- (Mobile) social-icons -->
                <div class="col-12 footer__social-mobile text-center">

                    <a
                        href="#"
                        class="px-2 footer__social-icons">
                        <img src="{{asset('/new/images/icons/inst_logo.png')}}" class="footer__mobile-icons" alt="inst"/>
                    </a>

                    <a
                        href="#"
                        class="px-2 footer__social-icons">
                        <img src="{{asset('/new/images/icons/telegram_logo.png')}}" class="footer__mobile-icons" alt="telegram"/>
                    </a>

                    <a
                        href="#"
                        class="px-2 footer__social-icons">
                        <img src="{{asset('/new/images/icons/facebook_logo.png')}}" class="footer__mobile-icons" alt="facebook"/>
                    </a>

                    <a
                        href="#"
                        class="px-2 footer__social-icons">
                        <img src="{{asset('/new/images/icons/in_logo.png')}}" class="footer__mobile-icons" alt="in"/>
                    </a>

                    <a
                        href="#"
                        class="px-2 footer__social-icons">
                        <img src="{{asset('/new/images/icons/youTube_logo.png')}}" class="footer__mobile-icons" alt="YouTube"/>
                    </a>
                </div>

                <div class="col-12">
                    <div class="row align-items-start">
                        <!-- (Mobile) menu -->
                        <div class="col-sm-6 col-6">
                            <div class="row">
                                <div class="col-11">
                                    <ul class="nav footer__menu">
                                        <li><a href="#" class="nav-lik footer__menu-item ">Меню</a></li>
                                        <li><a href="{{route('new-index')}}" class="active nav-link footer__menu-item">Главная</a></li>
                                        <li><a href="{{route('new-about')}}" class="nav-link  footer__menu-item">О нас</a></li>
                                        <li><a href="{{route('new-partners')}}" class="nav-link  footer__menu-item">Партнерская сеть</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- (Mobile) button (private-office)-->
                        <div class="col-sm-6 col-6 text-md-center text-sm-end text-end">
                            <div class="col-12 text-md-center text-sm-end text-start">
                                <button class="footer__btn px-0 login">
                                    <i class="bi bi-person-circle footer__icons"></i>
                                    Личный кабинет
                                </button>
                            </div>
                            <!-- (Mobile) Search -->
{{--                            <div class="col-md-8 col-sm-12 col-12 text-sm-center text-md-center text-start py-1">--}}
{{--                                <div class="footer__search-box_mobile">--}}
{{--                                    <button class="footer__btn-search_mobile"><i class="bi bi-search"></i></button>--}}
{{--                                    <input type="text" class="footer__input-search_mobile" aria-label="search">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <!-- (Mobile) Language dropdown -->
{{--                            <div class="col-12 text-md-center text-sm-end text-start">--}}
{{--                                <button class="footer__dropdown">На русском</button>--}}
{{--                                <a type="button" class="btn dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"></a>--}}
{{--                            </div>--}}
                            <div class="col-12 footer__language_dropdown mt-2">
                                <div class="row justify-content-md-center justify-content-sm-end">
                                    <div class="col-auto">
                                        <div class="language-footer-links">
                                            <ul class="nav-footer-element">
                                                <li>
                                                    @if(\Illuminate\Support\Facades\App::getLocale() == "ru")
                                                        <a href="" class="footer__language_dropdown-element">Русский</a>
                                                    @else
                                                        <a href="" class="footer__language_dropdown-element">English</a>
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

                                    <div class="col-auto text-start language-footer-icons">
                                        <i class="bi bi-chevron-down footer__dropdown-icon arrow-down px-1"></i>
                                        <i class="bi bi-chevron-up footer__dropdown-icon arrow-up px-1" style="display: none"></i>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <!-- (Mobile) License -->
                    <p class="footer__description">
                        UPPERLICENSE не является государственным органом и не представляет какой-либо официальный
                        орган. Все названия продуктов, логотипы и бренды являются собственностью их владельцев.
                        Все названия компаний, органов власти, реестра, продуктов и услуг, используемые на этом
                        веб-сайте, используются только в целях идентификации. Использование этих названий, логотипов
                        и брендов не означает одобрения.
                    </p>
                </div>

            </nav>
        </div>
    </div>
</footer>

@section('footer-js')
    <script>
        $(".language-footer-links li ul").hide();
        $(".language-footer-icons, .language-footer-links").hover(
            function () {
                $(".arrow-down").stop().toggle();
                $(".arrow-up").stop().toggle();
                $(".language-footer-links li ul").stop().fadeToggle(300);
            }
        );

    </script>
@endsection
