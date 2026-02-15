<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}"/>
    <meta name="og:type" content="website" />
    <meta name="twitter:card" content="photo" />
    <title>UPPERLICENSE - Главная</title>
    <link rel="stylesheet" type="text/css" href="{{asset('/current/css/index.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('/current/css/styleguide.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('/current/css/globals.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('/current/css/bootstrap.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('/current/css/normalize.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{asset('/current/css/style.css')}}">
    <style>
        /* Global Link Styles - Убираем синий цвет и подчеркивание при клике */
        a,
        a:link,
        a:visited,
        a:active {
            text-decoration: none !important;
            color: inherit;
        }
        
        a:hover {
            text-decoration: none !important;
        }
        
        /* Hero Slider Styles */
        .hero-slider {
            position: relative;
            width: 100%;
            height: 720px;
            overflow: hidden;
            background: white;
        }
        
        .hero-top-title {
            position: absolute;
            top: -10px;
            left: 3%;
            font-size: 52px;
            font-weight: 500;
            color: #1E1E1E;
            font-family: 'Manrope', sans-serif;
            z-index: 5;
        }
        
        /* Огромный зеленый фон за текстом */
        .hero-slider::before {
            content: '';
            position: absolute;
            left: 3%;
            top: 55.3%;
            transform: translateY(-50%);
            width: 730px;
            height: 550px;
            background: #279760;
            border-radius: 0;
            z-index: 0;
        }
        
        /* Сероватый фон за изображением */
        .hero-slider::after {
            content: '';
            position: absolute;
            right: 3%;
            top: 55.3%;
            transform: translateY(-50%);
            width: 710px;
            height: 550px;
            background: #E5E7EB;
            border-radius: 0;
            z-index: 0;
        }
        
        /* Декоративный чекмарк на фоне */
        .hero-background-checkmark {
            position: absolute;
            right: 10%;
            top: 50%;
            transform: translateY(-50%);
            width: 180px;
            height: 180px;
            background: #279760;
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.8;
            z-index: 1;
        }
        
        .hero-background-checkmark svg {
            width: 100px;
            height: 100px;
        }
        
        .hero-slide {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
            display: flex;
            align-items: center;
            padding: 0 80px;
            padding-top: 100px;
            padding-left: 60px;
        }
        
        .hero-slide.active {
            opacity: 1;
            z-index: 1;
        }
        
        .hero-slide-content {
            max-width: 650px;
            z-index: 2;
            position: relative;
        }
        
        .hero-slide-title {
            font-size: 40px;
            font-weight: 500;
            line-height: 1.2;
            color: white;
            margin-bottom: 24px;
        }
        
        .hero-slide-description {
            font-size: 14px;
            line-height: 1.6;
            color: white;
            margin-bottom: 32px;
        }
        
        .hero-slide-image {
            position: absolute;
            right: 80px;
            top: 50%;
            transform: translateY(-50%);
            max-width: 600px;
            z-index: 2;
        }
        
        .hero-slide-button {
            display: inline-flex;
            align-items: center;
            background: white;
            color: #279760;
            padding: 16px 32px;
            border-radius: 60px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .hero-slide-button:hover {
            background: #f0f0f0;
            color: #279760;
        }
        
        .hero-slider-controls {
            position: absolute;
            bottom: 40px;
            right: 5%;
            display: flex;
            align-items: center;
            gap: 20px;
            z-index: 10;
        }
        
        .hero-slider-pagination {
            font-size: 16px;
            color: white;
        }
        
        .hero-slider-arrows {
            display: flex;
            gap: 10px;
        }
        
        .hero-arrow {
            width: 40px;
            height: 40px;
            border: 1px solid white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            background: transparent;
        }
        
        .hero-arrow svg path {
            stroke: white;
        }
        
        .hero-arrow:hover {
            border-color: white;
            background: white;
        }
        
        .hero-arrow:hover svg path {
            stroke: #279760;
        }
        
        /* About-us Section */
        .about-us__find__header h2 {
            white-space: nowrap;
            text-align: left !important;
            margin: 0 !important;
            padding-left: 200px !important;
        }
        
        /* Industries Section */
        .industries-section {
            padding: 80px 0;
            background: #F9FAFB;
        }
        
        .industries-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 80px;
        }
        
        .industry-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.3s;
            cursor: pointer;
        }
        
        .industry-card:hover {
            transform: translateY(-5px);
        }
        
        .industry-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .industry-content {
            padding: 24px;
        }
        
        .industry-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 16px;
            color: #1E1E1E;
        }
        
        .industry-services {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        
        .industry-service {
            font-size: 14px;
            color: #6B7280;
        }
        
        .industry-more {
            display: inline-flex;
            align-items: center;
            font-size: 14px;
            color: #2DD4BF;
            font-weight: 600;
            margin-top: 12px;
        }
        
        /* RoadMap Section */
        .roadmap-section {
            padding: 80px 0;
            background: white;
        }
        
        .roadmap-title {
            font-size: 52px;
            font-weight: 500;
            text-align: center;
            margin-bottom: 60px;
            color: #1E1E1E;
        }
        
        .roadmap-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 80px;
            position: relative;
        }
        
        .roadmap-timeline {
            display: flex;
            justify-content: space-between;
            position: relative;
            padding-bottom: 40px;
        }
        
        .roadmap-timeline::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(to right, #2DD4BF 25%, #E5E7EB 25%, #E5E7EB 100%);
        }
        
        .roadmap-milestone {
            flex: 1;
            position: relative;
            text-align: center;
        }
        
        .roadmap-dot {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            border: 2px solid #E5E7EB;
            margin: 0 auto 16px;
            position: relative;
            z-index: 2;
        }
        
        .roadmap-milestone.completed .roadmap-dot {
            background: #2DD4BF;
            border-color: #2DD4BF;
        }
        
        .roadmap-milestone.completed .roadmap-dot::after {
            content: '✓';
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 20px;
        }
        
        .roadmap-year {
            font-size: 14px;
            color: #6B7280;
            margin-bottom: 4px;
        }
        
        .roadmap-date {
            font-size: 20px;
            font-weight: 600;
            color: #1E1E1E;
            margin-bottom: 16px;
        }
        
        .roadmap-milestone.completed .roadmap-date {
            color: #2DD4BF;
        }
        
        .roadmap-description {
            font-size: 14px;
            color: #6B7280;
            line-height: 1.5;
        }
        
        .roadmap-cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-top: 40px;
        }
        
        .roadmap-card {
            background: #F9FAFB;
            border-radius: 16px;
            padding: 24px;
            text-align: center;
        }
        
        .roadmap-card-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 16px;
        }
        
        .roadmap-card-title {
            font-size: 18px;
            font-weight: 600;
            color: #1E1E1E;
        }
        
        .roadmap-details {
            margin-top: 60px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
        }
        
        .roadmap-detail {
            padding: 24px;
        }
        
        .roadmap-detail-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 16px;
            color: #1E1E1E;
        }
        
        .roadmap-detail-list {
            list-style: none;
            padding: 0;
        }
        
        .roadmap-detail-list li {
            font-size: 14px;
            color: #6B7280;
            line-height: 1.6;
            margin-bottom: 8px;
            padding-left: 20px;
            position: relative;
        }
        
        .roadmap-detail-list li::before {
            content: '•';
            position: absolute;
            left: 0;
            color: #2DD4BF;
        }
    </style>
</head>
<body style="margin: 0; background: #ffffff">

<div class="container-center-horizontal">
    <div class="index screen">
        <!-- Header -->
        <header class="header-IO3Fu5">
            <img class="frame-7" src="{{asset('current/img/frame-7-2.svg')}}" alt="Frame 7" />
            <div class="frame-9-74EEvB">
                <div class="button-9jl6u0" onclick="toggleServicesDropdown()" style="cursor: pointer; position: relative;">
                    <img class="icons" src="{{asset('current/img/icons-12.svg')}}" alt="Icons" />
                    <div class="text_label-VdZ3eK manrope-medium-white-14px">Услуги</div>
                    <div id="servicesDropdown" class="services-dropdown" style="display: none; position: absolute; top: 100%; left: 0; background: white; border: 1px solid #ccc; border-radius: 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); z-index: 1000; min-width: 200px;">
                        <a href="{{ route('new-services') }}" style="display: flex; align-items: center; gap: 8px; padding: 10px 15px; text-decoration: none; color: #333;">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 1L13 13M13 1L1 13" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Услуги</span>
                        </a>
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
                    <div class="text_label-rP8x3z manrope-medium-eucalyptus-14px" data-bs-toggle="modal" data-bs-target="#consultModal">Заказать звонок</div>
                </div>
                <div class="button-pXFCLN" data-bs-toggle="modal" data-bs-target="#loginModal">
                    <img class="icons" src="{{asset('current/img/icons-11.svg')}}" alt="Icons" />
                    <div class="text_label-nd5l3S manrope-medium-eerie-black-14px">Войти</div>
                </div>
            </div>
        </header>

        <!-- First Section - Hero Slider -->
        <div class="first">
            <div class="container">
                <div class="row">
                    <div class="first__title">
                        Мгновенный старт для вашего бизнеса в Казахстане
                    </div>
                    <div class="first__slider__wrap">
                        <div class="swiper first__slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="first__slider__block">
                                        <div class="first__slider__block__green">
                                            <div class="first__slider__block__title">UPPERLICENSE: Идеальное решение для регистрации вашего бизнеса в РК</div>
                                            <div class="first__slider__block__descr">Полная автоматизация и удобство управления — откройте новые возможности для вашего бизнеса в Казахстане с нашей инновационной онлайн-платформой!</div>
                                            <a href="tel:+77471350000" class="first__slider__block__link">Начать регистрацию</a>
                                            <div class="first__slider__items__wrap">
                                                <div class="first__slider__counter">
                                                    <span class="current">01</span> / <span class="total">04</span>
                                                </div>
                                                <div class="first__slider__arrows">
                                                    <div class="prev"><img src="{{asset('current/img/icon-left-arrow.svg')}}" alt=""></div>
                                                    <div class="next"><img src="{{asset('current/img/icon-right-arrow.svg')}}" alt=""></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="first__slider__block__bg">
                                            <img src="{{asset('current/img/image-slider-1.png')}}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="first__slider__block">
                                        <div class="first__slider__block__green">
                                            <div class="first__slider__block__title">Гарантируйте стабильный рост вашего бизнеса в эпоху перемен с экспертной поддержкой UPPERLICENSE</div>
                                            <div class="first__slider__block__descr">Высококлассное юридическое и бухгалтерское сопровождение от UPPERLICENSE — ваш надежный фундамент для стойкости и прогресса вашей компании</div>
                                            <a href="tel:+77471350000" class="first__slider__block__link">Начать регистрацию</a>
                                            <div class="first__slider__items__wrap">
                                                <div class="first__slider__counter">
                                                    <span class="current">02</span> / <span class="total">04</span>
                                                </div>
                                                <div class="first__slider__arrows">
                                                    <div class="prev"><img src="{{asset('current/img/icon-left-arrow.svg')}}" alt=""></div>
                                                    <div class="next"><img src="{{asset('current/img/icon-right-arrow.svg')}}" alt=""></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="first__slider__block__bg">
                                            <img src="{{asset('current/img/image-slider-2.png')}}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="first__slider__block">
                                        <div class="first__slider__block__green">
                                            <div class="first__slider__block__title">Получите вашу рабочую и бизнес-визу в Казахстане легко и надежно с UPPERLICENSE. Быстро, эффективно, без хлопот</div>
                                            <div class="first__slider__block__descr">Оперативное оформление виз С3 и С5 — максимальная скорость, минимальные сроки</div>
                                            <a href="tel:+77471350000" class="first__slider__block__link">Начать регистрацию</a>
                                            <div class="first__slider__items__wrap">
                                                <div class="first__slider__counter">
                                                    <span class="current">03</span> / <span class="total">04</span>
                                                </div>
                                                <div class="first__slider__arrows">
                                                    <div class="prev"><img src="{{asset('current/img/icon-left-arrow.svg')}}" alt=""></div>
                                                    <div class="next"><img src="{{asset('current/img/icon-right-arrow.svg')}}" alt=""></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="first__slider__block__bg">
                                            <img src="{{asset('current/img/image-slider-3.png')}}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="first__slider__block">
                                        <div class="first__slider__block__green">
                                            <div class="first__slider__block__title">UPPERLICENSE: Ваш ключ к беспроблемному лицензированию</div>
                                            <div class="first__slider__block__descr">Надежное сопровождение вашего процесса лицензирования «под ключ», усиленное базой данных и индивидуально адаптированным личным кабинетом для вашего максимального комфорта и удобства</div>
                                            <a href="tel:+77471350000" class="first__slider__block__link">Начать регистрацию</a>
                                            <div class="first__slider__items__wrap">
                                                <div class="first__slider__counter">
                                                    <span class="current">04</span> / <span class="total">04</span>
                                                </div>
                                                <div class="first__slider__arrows">
                                                    <div class="prev"><img src="{{asset('current/img/icon-left-arrow.svg')}}" alt=""></div>
                                                    <div class="next"><img src="{{asset('current/img/icon-right-arrow.svg')}}" alt=""></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="first__slider__block__bg">
                                            <img src="{{asset('current/img/image-slider-4.png')}}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Second Section - Advantages -->
        <div class="second">
            <div class="container">
                <div class="row">
                    <div class="second__title">Преимущества работы с UPPERLICENSE</div>
                    <div class="second__wrap">
                        <div class="col-md-6 col-12 col-sm-12 col-xs-12 col-xl-3 col-lg-3">
                            <div class="second__block">
                                <div class="second__block__img">
                                    <img src="{{asset('current/img/Image-Features-01.png')}}" alt="">
                                </div>
                                <div class="second__block__wrap">
                                    <div class="second__block__number">01</div>
                                    <div class="second__block__title">Контроль и инновации</div>
                                    <div class="second__block__descr">Уникальная онлайн-панель управления для вашего бизнеса</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 col-sm-12 col-xs-12 col-xl-3 col-lg-3">
                            <div class="second__block">
                                <div class="second__block__img">
                                    <img src="{{asset('current/img/Image-Features-02.png')}}" alt="">
                                </div>
                                <div class="second__block__wrap">
                                    <div class="second__block__number">02</div>
                                    <div class="second__block__title">Экспертность</div>
                                    <div class="second__block__descr">Полный спектр квалифицированной поддержки для вашего бизнеса</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 col-sm-12 col-xs-12 col-xl-3 col-lg-3">
                            <div class="second__block">
                                <div class="second__block__img">
                                    <img src="{{asset('current/img/Image-Features-03.png')}}" alt="">
                                </div>
                                <div class="second__block__wrap">
                                    <div class="second__block__number">03</div>
                                    <div class="second__block__title">Удобство и доступность</div>
                                    <div class="second__block__descr">Персональный онлайн-кабинет и актуальная база данных</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 col-sm-12 col-xs-12 col-xl-3 col-lg-3">
                            <div class="second__block">
                                <div class="second__block__img">
                                    <img src="{{asset('current/img/Image-Features-04.png')}}" alt="">
                                </div>
                                <div class="second__block__wrap">
                                    <div class="second__block__number">04</div>
                                    <div class="second__block__title">Устойчивость и развитие</div>
                                    <div class="second__block__descr">Фундамент для долгосрочного партнерства, поддержка вашего бизнеса на каждом этапе</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('about') }}" class="second__button">Узнвфцвать всё о платформе</a>
                </div>
            </div>
        </div>

        <!-- Third Section - Industries -->
        <div class="third">
            <div class="container">
                <div class="row">
                    <div class="third__title__wrap">
                        <div class="third__title">Уже выбрали вашу <span class="green">сферу</span> деятельности?</div>
                        <div class="third__arrow">
                            <div class="third__arrow__prev">
                                <img src="{{asset('current/img/ic-arrow-prev-black.svg')}}" alt="">
                            </div>
                            <div class="third__arrow__next">
                                <img src="{{asset('current/img/ic-arrow-next-black.svg')}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="third__wrap swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide third__slider__item">
                                <div class="third__slider__item__title">
                                    Строительство
                                </div>
                                <div class="third__slider__item__link__wrapper">
                                    <a href="#" class="third__slider__item__link">Строительные работы</a>
                                    <a href="#" class="third__slider__item__link">Контроль СР</a>
                                    <div class="third__slider__item__link__green">+2</div>
                                </div>
                            </div>
                            <div class="swiper-slide third__slider__item">
                                <div class="third__slider__item__title">
                                    Промышленность
                                </div>
                                <div class="third__slider__item__link__wrapper">
                                    <a href="#" class="third__slider__item__link">Энергетика</a>
                                    <a href="#" class="third__slider__item__link">Добыча полезных ископаемых</a>
                                    <div class="third__slider__item__link__green">+4</div>
                                </div>
                            </div>
                            <div class="swiper-slide third__slider__item">
                                <div class="third__slider__item__title">
                                    Импорт-экспорт
                                </div>
                                <div class="third__slider__item__link__wrapper">
                                    <a href="#" class="third__slider__item__link">Таможенные процендуры</a>
                                    <a href="#" class="third__slider__item__link">Траспорт</a>
                                    <div class="third__slider__item__link__green">+3</div>
                                </div>
                            </div>
                            <div class="swiper-slide third__slider__item">
                                <div class="third__slider__item__title">
                                    Медицина
                                </div>
                                <div class="third__slider__item__link__wrapper">
                                    <a href="#" class="third__slider__item__link">Медицинское оборудование</a>
                                    <a href="#" class="third__slider__item__link">Фарм. индустрия</a>
                                    <div class="third__slider__item__link__green">+4</div>
                                </div>
                            </div>
                            <div class="swiper-slide third__slider__item">
                                <div class="third__slider__item__title">
                                    Сельское хозяйство
                                </div>
                                <div class="third__slider__item__link__wrapper">
                                    <a href="#" class="third__slider__item__link">Выращивание растений</a>
                                    <a href="#" class="third__slider__item__link">С-х услуги</a>
                                    <div class="third__slider__item__link__green">+4</div>
                                </div>
                            </div>
                            <div class="swiper-slide third__slider__item">
                                <div class="third__slider__item__title">
                                    Культура
                                </div>
                                <div class="third__slider__item__link__wrapper">
                                    <a href="#" class="third__slider__item__link">Кинематограф</a>
                                    <a href="#" class="third__slider__item__link">Искусство</a>
                                    <div class="third__slider__item__link__green">+4</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="third__footer">
                        <div class="third__footer__title">Делаем процесс лицензирования легким и доступным!</div>
                        <a href="tel:+77471350000" class="third__button">Оформить заявку</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fourth Section - Services -->
        <div class="fourth">
            <div class="container">
                <div class="row fourth__wrap">
                    <div class="fourth__title">Предоставляем качественные и комплексные <span class="green">решения</span> для вашего бизнеса</div>
                    <div class="col-12 col-sm-6 col-xl-6 col-lg-6 col-xs-12 fourth__block__items">
                        <div class="fourth__block__items__text">
                            <div class="fourth__block__items__text__title">Регистрация компании</div>
                            <ul class="fourth__block__items__text__list">
                                <li><img src="{{asset('current/img/ic-chek.svg')}}" alt="">Подготовка учредительных документов филиала/представительств</li>
                                <li><img src="{{asset('current/img/ic-chek.svg')}}" alt="">Сдача документов в регистрирующий орган</li>
                                <li><img src="{{asset('current/img/ic-chek.svg')}}" alt="">Заполнение формы на регистрацию</li>
                            </ul>
                        </div>
                        <a href="tel:+77471350000" class="fourth__block__items__btn">
                            Оформить заявку
                        </a>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-6 col-lg-6 col-xs-12 fourth__block__items">
                        <div class="fourth__block__items__text">
                            <div class="fourth__block__items__text__title">Регистрация компаний в СЭЗ и МФЦА</div>
                            <ul class="fourth__block__items__text__list">
                                <li><img src="{{asset('current/img/ic-chek.svg')}}" alt="">Регистрация в качестве участника Astana Hub International Technology Park</li>
                            </ul>
                        </div>
                        <a href="tel:+77471350000" class="fourth__block__items__btn">
                            Оформить заявку
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-6 col-lg-6 col-xs-12 fourth__block__items">
                        <div class="fourth__block__items__text">
                            <div class="fourth__block__items__text__title">Открытие банковских счетов</div>
                            <ul class="fourth__block__items__text__list">
                                <li><img src="{{asset('current/img/ic-chek.svg')}}" alt="">Сбор документов</li>
                                <li><img src="{{asset('current/img/ic-chek.svg')}}" alt="">Подача заявки на открытие счёта</li>
                            </ul>
                        </div>
                        <a href="tel:+77471350000" class="fourth__block__items__btn">
                            Оформить заявку
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-6 col-lg-6 col-xs-12 fourth__block__items">
                        <div class="fourth__block__items__text">
                            <div class="fourth__block__items__text__title">Лицензирование</div>
                            <ul class="fourth__block__items__text__list">
                                <li><img src="{{asset('current/img/ic-chek.svg')}}" alt="">Получение лицензий и разрешительных документов для всех видов деятельности</li>
                            </ul>
                        </div>
                        <a href="tel:+77471350000" class="fourth__block__items__btn">
                            Оформить заявку
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-6 col-lg-6 col-xs-12 fourth__block__items">
                        <div class="fourth__block__items__text">
                            <div class="fourth__block__items__text__title">Получение визы С3 и С5</div>
                            <ul class="fourth__block__items__text__list">
                                <li><img src="{{asset('current/img/ic-chek.svg')}}" alt="">Сбор документов и оформление приглашения</li>
                                <li><img src="{{asset('current/img/ic-chek.svg')}}" alt="">Оформление визы в консульстве РК</li>
                            </ul>
                        </div>
                        <a href="tel:+77471350000" class="fourth__block__items__btn">
                            Оформить заявку
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-6 col-lg-6 col-xs-12 fourth__block__items">
                        <div class="fourth__block__items__text">
                            <div class="fourth__block__items__text__title">Предоставление отраслевого юриста</div>
                            <ul class="fourth__block__items__text__list">
                                <li><img src="{{asset('current/img/ic-chek.svg')}}" alt="">Услуги юриста на аутсорсинге для вашего бизнеса</li>
                            </ul>
                        </div>
                        <a href="tel:+77471350000" class="fourth__block__items__btn">
                            Оформить заявку
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-6 col-lg-6 col-xs-12 fourth__block__items">
                        <div class="fourth__block__items__text">
                            <div class="fourth__block__items__text__title">Бухгалтерский аутсорсинг</div>
                            <ul class="fourth__block__items__text__list">
                                <li><img src="{{asset('current/img/ic-chek.svg')}}" alt="">Подписание документов в банке (работа с менеджером банка)</li>
                                <li><img src="{{asset('current/img/ic-chek.svg')}}" alt="">Сбор данных клиентов</li>
                            </ul>
                        </div>
                        <a href="tel:+77471350000" class="fourth__block__items__btn">
                            Оформить заявку
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-6 col-lg-6 col-xs-12 fourth__block__items">
                        <div class="fourth__block__items__text">
                            <div class="fourth__block__items__text__title">Дополнительные услуги</div>
                            <ul class="fourth__block__items__text__list">
                                <li><img src="{{asset('current/img/ic-chek.svg')}}" alt="">Получение ИИН, БИН</li>
                                <li><img src="{{asset('current/img/ic-chek.svg')}}" alt="">Получение ЭЦП</li>
                                <li><img src="{{asset('current/img/ic-chek.svg')}}" alt="">Оформление РВП</li>
                            </ul>
                        </div>
                        <a href="tel:+77471350000" class="fourth__block__items__btn">
                            Оформить заявку
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fifth Section - Stats -->
        <div class="fifth">
            <div class="container">
                <div class="row">
                    <div class="about-us__stats__wrap">
                        <table class="stats-table">
                            <tr>
                                <td colspan="5" class="top-cell">
                                    <div class="top-inner">
                                        <div class="top-inner__title__left">О группе UPPERCASE</div>
                                        <div class="top-inner__title__right">
                                            <div class="top-inner__title__right__green">
                                                3000+
                                            </div>
                                            <div class="top-inner__title__right__descr">
                                                Клиентов в области регистрации, лицензирования, сопровождения международных сделок и корпоративного права
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="bottom-inner">
                                    <div class="bottom-inner__title">
                                        13+ лет
                                    </div>
                                    <div class="bottom-inner__descr">
                                        На рынке юридических услуг и консалтинга
                                    </div>
                                </td>
                                <td class="bottom-inner">
                                    <div class="bottom-inner__title">
                                        6
                                    </div>    
                                    <div class="bottom-inner__descr">
                                        Филиалов в ОАЭ и РК
                                    </div>
                                </td>
                                <td class="bottom-inner">
                                    <div class="bottom-inner__title">
                                        IT-решения
                                    </div>    
                                    <div class="bottom-inner__descr">
                                        В области юридических услуг и консалтинга
                                    </div>
                                </td>
                                <td class="bottom-inner">
                                    <div class="bottom-inner__title">
                                        500+
                                    </div>    
                                    <div class="bottom-inner__descr">
                                        Успешно завершенных проектов
                                    </div>
                                </td>
                                <td class="bottom-inner">
                                    <div class="bottom-inner__title">
                                        300+
                                    </div>    
                                    <div class="bottom-inner__descr">
                                        Опытных специалистов в команде
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <div class="fifth__list">
                            <div class="fifth__list__title">О группе UPPERCASE</div>
                            <div class="fifth__list__block">
                                <div class="fifth__list__block__title green">3000+</div>
                                <div class="fifth__list__block__descr">
                                    Клиентов в области регистрации, лицензирования, сопровождения международных сделок и корпоративного права
                                </div>
                            </div>
                            <div class="fifth__list__block__wrap__first">
                                <div class="fifth__list__block">
                                    <div class="fifth__list__block__title">13+ лет</div>
                                    <div class="fifth__list__block__descr">
                                        На рынке юридических услуг и консалтинга
                                    </div>
                                </div>
                                <div class="fifth__list__block">
                                    <div class="fifth__list__block__title">6</div>
                                    <div class="fifth__list__block__descr">
                                        Филиалов в ОАЭ и РК
                                    </div>
                                </div>
                            </div>
                            <div class="fifth__list__block__wrap__second">
                                <div class="fifth__list__block">
                                    <div class="fifth__list__block__title">IT-решения</div>
                                    <div class="fifth__list__block__descr">
                                        В области юридических услуг и консалтинга
                                    </div>
                                </div>
                            </div>
                            <div class="fifth__list__block__wrap__third">
                                <div class="fifth__list__block">
                                    <div class="fifth__list__block__title">500+</div>
                                    <div class="fifth__list__block__descr">
                                        Успешно завершенных проектов
                                    </div>
                                </div>
                                <div class="fifth__list__block">
                                    <div class="fifth__list__block__title">300+</div>
                                    <div class="fifth__list__block__descr">
                                        Опытных специалистов в команде
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sixth Section - Personal Area -->
        <div class="sixth">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-xl-6 col-lg-6 col-xs-12 sixth__block__wrap">
                        <div class="sixth__block">
                            <div class="sixth__block__text">
                                <div class="sixth__block__title">Пользователю портала предоставляется простой и удобный личный кабинет</div>
                                <ul class="sixth__block__list">
                                    <li><img src="{{asset('current/img/ic-chek.svg')}}" alt="">Отслеживание статуса заказанных услуг</li>
                                    <li><img src="{{asset('current/img/ic-chek.svg')}}" alt="">Создание надежного архива ваших документов </li>
                                    <li><img src="{{asset('current/img/ic-chek.svg')}}" alt="">Получение специализированных отраслевых услуг</li>
                                </ul>
                            </div>
                            <a href="tel:+77471350000" class="sixth__block__btn">Получить консультацию</a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-xl-6 col-lg-6 col-xs-12 sixth__block__wrap">
                        <div class="sixth__block__gray"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Seventh Section - Cases -->
        <div class="seventh">
            <div class="container">
                <div class="row">
                    <div class="seventh__title__wrap">
                        <div class="seventh__title">Кейсы наших клиентов</div>
                        <div class="seventh__arrow">
                            <div class="seventh__arrow__prev">
                                <img src="{{asset('current/img/ic-arrow-prev-black.svg')}}" alt="">
                            </div>
                            <div class="seventh__arrow__next">
                                <img src="{{asset('current/img/ic-arrow-next-black.svg')}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-xl-5 col-lg-5 col-xs-12">
                        <div class="seventh__block">
                            <div class="seventh__block__title">Получение лицензии на проведение СМР 1 категории</div>
                            <div class="seventh__block__content">
                                <div class="seventh__block__content__img">
                                    <img src="{{asset('current/img/technicol.png')}}" alt="">
                                </div>
                                <div class="seventh__block__content__block">
                                    <div class="seventh__block__content__block__title">Технониколь</div>
                                    <div class="seventh__block__content__block__descr">Производитель строительных материалов и систем</div>
                                </div>
                            </div>
                            <a href="#" class="seventh__block__btn">
                                Смотреть видео-отзыв
                                <img src="{{asset('current/img/play.png')}}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-xl-7 col-lg-7 col-xs-12">
                        <div class="seventh__list">
                            <div class="seventh__list__gray">
                                <div class="seventh__list__gray__title">Входные параметры</div>
                                <ul class="seventh__list__gray__list">
                                    <li>
                                        <img src="{{asset('current/img/ic-chek.svg')}}" alt="">
                                        <div>В короткие сроки (7 рабочих дней) получить лицензию на проведение строительно-монтажных работ 1 категории.</div>
                                    </li>
                                    <li>
                                        <img src="{{asset('current/img/ic-chek.svg')}}" alt="">
                                        <div>Получить консультирование отраслевого юриста по квалификационным требованиям и нормативно-правовым актам в сфере строительства.</div>
                                    </li>
                                </ul>
                            </div>
                            <div class="seventh__list__gray">
                                <div class="seventh__list__gray__title">Решение</div>
                                <ul class="seventh__list__gray__list">
                                    <li>
                                        <img src="{{asset('current/img/ic-chek.svg')}}" alt="">
                                        <div>Получение консультации отраслевого юриста. Консультация опытного юриста по вопросам квалификационных требований и нормативно-правовых актов в сфере строительства.</div>
                                    </li>
                                    <li>
                                        <img src="{{asset('current/img/ic-chek.svg')}}" alt="">
                                        <div>Советы и рекомендации по подготовке документов и прохождению процедуры лицензирования.</div>
                                    </li>
                                    <li>
                                        <img src="{{asset('current/img/ic-chek.svg')}}" alt="">
                                        <div>Подготовка необходимого пакета документов</div>
                                    </li>
                                </ul>
                                <a class="seventh__list__gray__btn" href="#">Показать полностью</a>
                            </div>
                            <div class="seventh__list__green">
                                <div class="seventh__list__green__title">Результат</div>
                                <ul class="seventh__list__green__list">
                                    <li>
                                        <img src="{{asset('current/img/ic-chek.svg')}}" alt="">
                                        <div>
                                            В результате успешной реализации этого кейса, компания смогла получить лицензию на проведение строительно-монтажных работ 1 категории в короткие сроки, а также получила консультацию отраслевого юриста, что позволило ей эффективно соблюсти все требования и нормативы в сфере строительства
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Eighteth Section - Trust -->
        <div class="eighteth">
            <div class="container">
                <div class="row">
                    <div class="eighteth__title__wrap">
                        <div class="eighteth__title">Нам доверяют</div>
                        <div class="eighteth__arrow">
                            <div class="eighteth__arrow__prev">
                                <img src="{{asset('current/img/ic-arrow-prev-black.svg')}}" alt="">
                            </div>
                            <div class="eighteth__arrow__next">
                                <img src="{{asset('current/img/ic-arrow-next-black.svg')}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="eighteth__wrap swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide eighteth__slider__item">
                                <img src="{{asset('current/img/image 48.png')}}" alt="">
                            </div>
                            <div class="swiper-slide eighteth__slider__item">
                                <img src="{{asset('current/img/image 49.png')}}" alt="">
                            </div>
                            <div class="swiper-slide eighteth__slider__item">
                                <img src="{{asset('current/img/image 50.png')}}" alt="">
                            </div>
                            <div class="swiper-slide eighteth__slider__item">
                                <img src="{{asset('current/img/image 53.png')}}" alt="">
                            </div>
                            <div class="swiper-slide eighteth__slider__item">
                                <img src="{{asset('current/img/image 48.png')}}" alt="">
                            </div>
                            <div class="swiper-slide eighteth__slider__item">
                                <img src="{{asset('current/img/image 49.png')}}" alt="">
                            </div>
                            <div class="swiper-slide eighteth__slider__item">
                                <img src="{{asset('current/img/image 50.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nineth Section - Contact -->
        <div class="nineth">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-xl-5 col-lg-5 col-xs-12">
                        <div class="nineth__title">Свяжитесь с нами</div>
                        <div class="nineth__descr">Предоставим быстрое и эффективное открытие и ведение бизнеса в Казахстане</div>
                    </div>
                    <div class="col-12 col-sm-12 col-xl-7 col-lg-7 col-xs-12">
                        <div class="nineth__form">
                            <div class="nineth__form__input">
                                <label for="name">
                                    Представьтесь пожалуйста
                                </label>
                                <input id="name" placeholder="Ф.И.О" type="text" />
                            </div>
                            <div class="nineth__form__input">
                                <label class="form-label">Услуга</label>
                                <select class="form-select">
                                    <option value="">Выберите услугу</option>
                                    <option value="licensing">Лицензирование</option>
                                    <option value="registration">Регистрация компании</option>
                                    <option value="legal">Юридическое сопровождение</option>
                                    <option value="accounting">Бухгалтерия</option>
                                </select>
                            </div>
                            <div class="nineth__form__input">
                                <label for="email">
                                    Электронная почта
                                </label>
                                <input id="email" placeholder="example@gmail.com" type="text" />
                            </div>
                            <div class="nineth__form__input">
                                <label for="phone">
                                    Телефон
                                </label>
                                <input id="phone" type="text" />
                            </div>
                            <div class="nineth__form__textarea">
                                <label for="comment">
                                    Комментарий
                                </label>
                                <textarea id="comment"></textarea>
                            </div>
                            <div class="nineth__form__footer">
                                <a class="nineth__form__footer__btn" href="tel:+77471350000">Получить консультацию</a>
                                <div class="ninth__form__warn">Нажимая на кнопку, я соглашаюсь на обработку персональных данных </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ten Section - FAQ -->
        <div class="ten">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-xl-5 col-lg-5 col-xs-12">
                        <div class="ten__title">Ответы на вопросы</div>
                    </div>
                    <div class="col-12 col-sm-12 col-xl-7 col-lg-7 col-xs-12">
                        <div class="ten__accordion">
                            <div class="ten__accordion-item">
                              <button class="ten__accordion-header">
                                Каковы сроки регистрации бизнеса в Казахстане?
                                <span class="icon">+</span>
                              </button>
                              <div class="ten__accordion-content">
                                <p>Предоставим  быстрое и эффективное открытие и ведение бизнеса в Казахстане. В остальных случаях расчетный счет можно открыть за один день. Сразу после подачи заявки вы получите реквизиты и сможете выставлять счета на оплату. После встречи с представителем банка появится возможность принимать деньги и совершать исходящие платежи.</p>
                              </div>
                            </div>
                          
                            <div class="ten__accordion-item">
                              <button class="ten__accordion-header">
                                Какие основные требования для регистрации компании в Казахстане?
                                <span class="icon">+</span>
                              </button>
                              <div class="ten__accordion-content">
                                <p>Предоставим  быстрое и эффективное открытие и ведение бизнеса в Казахстане. В остальных случаях расчетный счет можно открыть за один день. Сразу после подачи заявки вы получите реквизиты и сможете выставлять счета на оплату. После встречи с представителем банка появится возможность принимать деньги и совершать исходящие платежи.</p>
                              </div>
                            </div>

                            <div class="ten__accordion-item">
                                <button class="ten__accordion-header">
                                    Какие документы понадобятся для регистрации юридического лица в Казахстане?
                                  <span class="icon">+</span>
                                </button>
                                <div class="ten__accordion-content">
                                  <p>Предоставим  быстрое и эффективное открытие и ведение бизнеса в Казахстане. В остальных случаях расчетный счет можно открыть за один день. Сразу после подачи заявки вы получите реквизиты и сможете выставлять счета на оплату. После встречи с представителем банка появится возможность принимать деньги и совершать исходящие платежи.</p>
                                </div>
                            </div>

                            <div class="ten__accordion-item">
                                <button class="ten__accordion-header">
                                    Можно ли в казахстанском банке открыть счет для ИП удаленно?
                                  <span class="icon">+</span>
                                </button>
                                <div class="ten__accordion-content">
                                  <p>Предоставим  быстрое и эффективное открытие и ведение бизнеса в Казахстане. В остальных случаях расчетный счет можно открыть за один день. Сразу после подачи заявки вы получите реквизиты и сможете выставлять счета на оплату. После встречи с представителем банка появится возможность принимать деньги и совершать исходящие платежи.</p>
                                </div>
                            </div>
                            
                            <div class="ten__accordion-item">
                                <button class="ten__accordion-header">
                                    Какие налоги потребуется платить в Казахстане?
                                  <span class="icon">+</span>
                                </button>
                                <div class="ten__accordion-content">
                                  <p>Предоставим  быстрое и эффективное открытие и ведение бизнеса в Казахстане. В остальных случаях расчетный счет можно открыть за один день. Сразу после подачи заявки вы получите реквизиты и сможете выставлять счета на оплату. После встречи с представителем банка появится возможность принимать деньги и совершать исходящие платежи.</p>
                                </div>
                            </div>

                            <div class="ten__accordion-item">
                                <button class="ten__accordion-header">
                                    Как долго обычно занимает процесс получения разрешений в стране?
                                  <span class="icon">+</span>
                                </button>
                                <div class="ten__accordion-content">
                                  <p>Предоставим  быстрое и эффективное открытие и ведение бизнеса в Казахстане. В остальных случаях расчетный счет можно открыть за один день. Сразу после подачи заявки вы получите реквизиты и сможете выставлять счета на оплату. После встречи с представителем банка появится возможность принимать деньги и совершать исходящие платежи.</p>
                                </div>
                            </div>

                            <div class="ten__accordion-item">
                                <button class="ten__accordion-header">
                                    Какие отрасли и виды деятельности подлежат обязательной лицензированию в Казахстане?
                                  <span class="icon">+</span>
                                </button>
                                <div class="ten__accordion-content">
                                  <p>Предоставим  быстрое и эффективное открытие и ведение бизнеса в Казахстане. В остальных случаях расчетный счет можно открыть за один день. Сразу после подачи заявки вы получите реквизиты и сможете выставлять счета на оплату. После встречи с представителем банка появится возможность принимать деньги и совершать исходящие платежи.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Eleven Section - RoadMap -->
        <div class="eleven">
            <div class="container">
                <div class="row">
                    <div class="eleven__title__wrap">
                        <div class="eleven__title">UPPERLICENSE RoadMap</div>
                        <div class="eleven__arrow">
                            <div class="eleven__arrow__prev">
                                <img src="{{asset('current/img/ic-arrow-prev-black.svg')}}" alt="">
                            </div>
                            <div class="eleven__arrow__next">
                                <img src="{{asset('current/img/ic-arrow-next-black.svg')}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="roadmap">
                        <div class="roadmap-timeline">
                            <div class="roadmap-milestone completed">
                                <div class="roadmap-milestone-content">
                                    <span class="roadmap-year">2023</span>
                                    <span class="roadmap-date">20 декабря</span>
                                </div>
                                <div class="roadmap-dot"></div>
                            </div>
        
                            <div class="roadmap-milestone">
                                <div class="roadmap-milestone-content">
                                    <span class="roadmap-year">2024</span>
                                    <span class="roadmap-date">20 января</span>
                                </div>
                                <div class="roadmap-dot"></div>
                            </div>
        
                            <div class="roadmap-milestone">
                                <div class="roadmap-milestone-content">
                                    <span class="roadmap-year">2024</span>
                                    <span class="roadmap-date">26 января</span>
                                </div>
                                <div class="roadmap-dot"></div>
                            </div>
                            <div class="roadmap-milestone">
                                <div class="roadmap-milestone-content">
                                    <span class="roadmap-year">2024</span>
                                    <span class="roadmap-date">30 января</span>
                                </div>
                                <div class="roadmap-dot"></div> 
                            </div>
                        </div>
        
                        <div class="roadmap-cards">
                            <div class="roadmap-card">
                                <img class="roadmap-card-icon" src="{{asset('current/img/roadmap_1.png')}}" alt="Запуск MVP" />
                                <h4 class="roadmap-card-title">Запуск MVP</h4>
                                <div class="tooltip-container">
                                    <img class="roadmap-card-info" src="{{asset('current/img/info_circle.png')}}" alt="">
                                    <div class="tooltip-text tooltip-text__1">
                                        <ul>
                                            <li>Исследование и анализ рынка</li>
                                            <li>Разработка новых продуктов или услуг</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
        
                            <div class="roadmap-card">
                                <img class="roadmap-card-icon" src="{{asset('current/img/roadmap_2.png')}}" alt="Расширение перечня услуг" />
                                <h4 class="roadmap-card-title">Расширение перечня услуг</h4>
                                <img class="roadmap-card-info" src="{{asset('current/img/info_circle.png')}}" alt="">
                                <div class="tooltip-text tooltip-text__2">
                                    <ul>
                                        <li>Исследование и анализ рынка</li>
                                        <li>Разработка новых продуктов или услуг</li>
                                    </ul>
                                </div>
                            </div>
        
                            <div class="roadmap-card">
                                <img class="roadmap-card-icon" src="{{asset('current/img/roadmap_3.png')}}" alt="Упрощенная оплата" />
                                <h4 class="roadmap-card-title">Упрощенная оплата</h4>
                                <img class="roadmap-card-info" src="{{asset('current/img/info_circle.png')}}" alt="">
                                <div class="tooltip-text tooltip-text__3">
                                    <ul>
                                        <li>Интеграция с платежными системами</li>
                                        <li>Разработка удобного интерфейса для безопасных онлайн-платежей</li>
                                        <li>Обеспечение безопасности данных клиентов</li>
                                    </ul>
                                </div>
                            </div>
        
                            <div class="roadmap-card">
                                <img class="roadmap-card-icon" src="{{asset('current/img/roadmap_4.png')}}" alt="Реферальная система" />
                                <h4 class="roadmap-card-title">Реферальная система</h4>
                                <img class="roadmap-card-info" src="{{asset('current/img/info_circle.png')}}" alt="">
                                <div class="tooltip-text tooltip-text__4">
                                    <ul>
                                        <li>Программа лояльности для клиентов</li>
                                        <li>Механизмы отслеживания рефералов и начисления бонусов за привлечение клиентов</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Footer -->
        <footer style="background: #1E1E1E; color: white; padding: 60px 0 30px;">
            <div style="max-width: 1280px; margin: 0 auto; padding: 0 80px;">
                <div style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 60px; margin-bottom: 40px;">
                    <div>
                        <img src="{{asset('current/img/logo-1.svg')}}" alt="UPPERLICENSE" style="width: 140px; margin-bottom: 20px; filter: brightness(0) invert(1);" />
                        <p style="color: #9CA3AF; line-height: 1.6;">Онлайн-платформа для упрощения процесса лицензирования и ведения бизнеса в Казахстане</p>
                    </div>
                    <div>
                        <h4 style="font-size: 18px; margin-bottom: 20px;">Компания</h4>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="margin-bottom: 12px;"><a href="{{ route('about') }}" style="color: #9CA3AF; text-decoration: none;">О компании</a></li>
                            <li style="margin-bottom: 12px;"><a href="{{ route('news.list') }}" style="color: #9CA3AF; text-decoration: none;">Блог</a></li>
                            <li style="margin-bottom: 12px;"><a href="{{ route('reviews') }}" style="color: #9CA3AF; text-decoration: none;">Отзывы</a></li>
                            <li style="margin-bottom: 12px;"><a href="{{ route('partners') }}" style="color: #9CA3AF; text-decoration: none;">Партнёрам</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 style="font-size: 18px; margin-bottom: 20px;">Услуги</h4>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="margin-bottom: 12px;"><a href="{{ route('new-services') }}" style="color: #9CA3AF; text-decoration: none;">Все услуги</a></li>
                            <li style="margin-bottom: 12px;"><a href="{{ route('new-construction') }}" style="color: #9CA3AF; text-decoration: none;">Строительство</a></li>
                            <li style="margin-bottom: 12px;"><a href="#" style="color: #9CA3AF; text-decoration: none;">Лицензирование</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 style="font-size: 18px; margin-bottom: 20px;">Контакты</h4>
                        <div style="color: #9CA3AF; margin-bottom: 12px;">7 (747) 135-00-00</div>
                        <div style="color: #9CA3AF;">info@license.kz</div>
                    </div>
                </div>
                <div style="border-top: 1px solid #374151; padding-top: 30px; text-align: center; color: #6B7280;">
                    <p>© 2026 UPPERLICENSE. Все права защищены.</p>
                </div>
            </div>
        </footer>
    </div>
</div>

<!-- Modals and Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{asset('/current/js/main.js')}}"></script>
<script>
    // Services Dropdown
    function toggleServicesDropdown() {
        const dropdown = document.getElementById('servicesDropdown');
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('servicesDropdown');
        const button = document.querySelector('.button-9jl6u0');
        
        if (!button.contains(event.target)) {
            dropdown.style.display = 'none';
        }
    });
</script>

</body>
</html>
