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
    <style>
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
                    <div class="text_label-rP8x3z manrope-medium-eucalyptus-14px" data-bs-toggle="modal" data-bs-target="#consultModal">Заказать звонок</div>
                </div>
                <div class="button-pXFCLN" data-bs-toggle="modal" data-bs-target="#loginModal">
                    <img class="icons" src="{{asset('current/img/icons-11.svg')}}" alt="Icons" />
                    <div class="text_label-nd5l3S manrope-medium-eerie-black-14px">Войти</div>
                </div>
            </div>
        </header>

        <!-- Hero Slider -->
        <div class="hero-slider">
            <h2 class="hero-top-title">Мгновенный старт для вашего<br>бизнеса в Казахстане</h2>
            
            <!-- Декоративный чекмарк на фоне -->
            <div class="hero-background-checkmark">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 6L9 17L4 12" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            
            <!-- Slide 1 -->
            <div class="hero-slide active" data-slide="1">
                <div class="hero-slide-content">
                    <h1 class="hero-slide-title">UPPERLICENSE: Идеальное решение для регистрации вашего бизнеса в РК</h1>
                    <p class="hero-slide-description">Полная автоматизация и удобство управления — откройте новые возможности для вашего бизнеса в Казахстане с нашей инновационной онлайн-платформой!</p>
                    <a href="#" class="hero-slide-button">Начать регистрацию</a>
                </div>
                <img class="hero-slide-image" src="{{asset('current/img/image-slider-1-2.png')}}" alt="Slide 1" />
            </div>

            <!-- Slide 2 -->
            <div class="hero-slide" data-slide="2">
                <div class="hero-slide-content">
                    <h1 class="hero-slide-title">UPPERLICENSE: Ваш ключ к беспроблемному лицензированию</h1>
                    <p class="hero-slide-description">Надежное сопровождение вашего процесса лицензирования «под ключ», усиленное базой данных и индивидуально адаптированным личным кабинетом для вашего максимального комфорта и удобства</p>
                    <a href="#" class="hero-slide-button">Начать регистрацию</a>
                </div>
                <img class="hero-slide-image" src="{{asset('current/img/image-slider-1-2.png')}}" alt="Slide 2" />
            </div>

            <!-- Slide 3 -->
            <div class="hero-slide" data-slide="3">
                <div class="hero-slide-content">
                    <h1 class="hero-slide-title">Получите вашу рабочую и бизнес-визу в Казахстане легко и надежно с UPPERLICENSE. Быстро, эффективно, без хлопот</h1>
                    <p class="hero-slide-description">Оперативное оформление виз С3 и С5 — максимальная скорость, минимальные сроки</p>
                    <a href="#" class="hero-slide-button">Начать регистрацию</a>
                </div>
                <img class="hero-slide-image" src="{{asset('current/img/image-slider-1-2.png')}}" alt="Slide 3" />
            </div>

            <!-- Slide 4 -->
            <div class="hero-slide" data-slide="4">
                <div class="hero-slide-content">
                    <h1 class="hero-slide-title">Гарантируйте стабильный рост вашего бизнеса в эпоху перемен с экспертной поддержкой UPPERLICENSE</h1>
                    <p class="hero-slide-description">Высококлассное юридическое и бухгалтерское сопровождение от UPPERLICENSE — ваш надежный фундамент для стойкости и прогресса вашей компании</p>
                    <a href="#" class="hero-slide-button">Начать регистрацию</a>
                </div>
                <img class="hero-slide-image" src="{{asset('current/img/image-slider-1-2.png')}}" alt="Slide 4" />
            </div>

            <!-- Slider Controls -->
            <div class="hero-slider-controls">
                <div class="hero-slider-pagination">
                    <span class="current-slide">01</span> / <span class="total-slides">04</span>
                </div>
                <div class="hero-slider-arrows">
                    <div class="hero-arrow prev-arrow">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.5 15L7.5 10L12.5 5" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="hero-arrow next-arrow">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.5 5L12.5 10L7.5 15" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Industries Section -->
        <div class="industries-section">
            <div class="industries-grid">
                <!-- Медицина -->
                <div class="industry-card">
                    <img class="industry-image" src="{{asset('current/img/image-spheres-01-6@2x.png')}}" alt="Медицина" />
                    <div class="industry-content">
                        <h3 class="industry-title">Медицина</h3>
                        <div class="industry-services">
                            <div class="industry-service">Медицинское оборудование</div>
                            <div class="industry-service">Фарм. индустрия</div>
                        </div>
                        <div class="industry-more">+4</div>
                    </div>
                </div>

                <!-- Импорт-экспорт -->
                <div class="industry-card">
                    <img class="industry-image" src="{{asset('current/img/image-spheres-01-7@2x.png')}}" alt="Импорт-экспорт" />
                    <div class="industry-content">
                        <h3 class="industry-title">Импорт-экспорт</h3>
                        <div class="industry-services">
                            <div class="industry-service">Таможенные процендуры</div>
                            <div class="industry-service">Траспорт</div>
                        </div>
                        <div class="industry-more">+3</div>
                    </div>
                </div>

                <!-- Культура -->
                <div class="industry-card">
                    <img class="industry-image" src="{{asset('current/img/image-spheres-01-8@2x.png')}}" alt="Культура" />
                    <div class="industry-content">
                        <h3 class="industry-title">Культура</h3>
                        <div class="industry-services">
                            <div class="industry-service">Кинематограф</div>
                            <div class="industry-service">Искусство</div>
                        </div>
                        <div class="industry-more">+4</div>
                    </div>
                </div>

                <!-- Сельское хозяйство -->
                <div class="industry-card">
                    <img class="industry-image" src="{{asset('current/img/image-spheres-01-9@2x.png')}}" alt="Сельское хозяйство" />
                    <div class="industry-content">
                        <h3 class="industry-title">Сельское хозяйство</h3>
                        <div class="industry-services">
                            <div class="industry-service">Выращивание растений</div>
                            <div class="industry-service">С-х услуги</div>
                        </div>
                        <div class="industry-more">+4</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Advantages Section -->
        <div class="advantages-section" style="padding: 80px 0; background: white;">
            <div style="max-width: 1280px; margin: 0 auto; padding: 0 80px;">
                <h2 style="font-size: 52px; font-weight: 500; text-align: center; margin-bottom: 60px;">Преимущества работы с UPPERLICENSE</h2>
                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px;">
                    <!-- Advantage 1 -->
                    <div style="background: #F9FAFB; border-radius: 16px; padding: 24px; text-align: center;">
                        <div style="width: 80px; height: 80px; background: #E8F5F3; border-radius: 12px; margin: 0 auto 16px; display: flex; align-items: center; justify-content: center;">
                            <img src="{{asset('current/img/image-18@2x.png')}}" alt="Инновации" style="width: 60px;" />
                        </div>
                        <div style="font-size: 16px; color: #6B7280; margin-bottom: 8px;">01</div>
                        <h4 style="font-size: 20px; font-weight: 600; margin-bottom: 12px;">Контроль и инновации</h4>
                        <p style="font-size: 16px; color: #6B7280; line-height: 1.5;">Уникальная онлайн-панель управления для вашего бизнеса</p>
                    </div>

                    <!-- Advantage 2 -->
                    <div style="background: #F9FAFB; border-radius: 16px; padding: 24px; text-align: center;">
                        <div style="width: 80px; height: 80px; background: #E8F5F3; border-radius: 12px; margin: 0 auto 16px; display: flex; align-items: center; justify-content: center;">
                            <img src="{{asset('current/img/image-19.png')}}" alt="Экспертность" style="width: 60px;" />
                        </div>
                        <div style="font-size: 16px; color: #6B7280; margin-bottom: 8px;">02</div>
                        <h4 style="font-size: 20px; font-weight: 600; margin-bottom: 12px;">Экспертность</h4>
                        <p style="font-size: 16px; color: #6B7280; line-height: 1.5;">Полный спектр квалифицированной поддержки для вашего бизнеса</p>
                    </div>

                    <!-- Advantage 3 -->
                    <div style="background: #F9FAFB; border-radius: 16px; padding: 24px; text-align: center;">
                        <div style="width: 80px; height: 80px; background: #E8F5F3; border-radius: 12px; margin: 0 auto 16px; display: flex; align-items: center; justify-content: center;">
                            <img src="{{asset('current/img/image-20.png')}}" alt="Удобство" style="width: 60px;" />
                        </div>
                        <div style="font-size: 16px; color: #6B7280; margin-bottom: 8px;">03</div>
                        <h4 style="font-size: 20px; font-weight: 600; margin-bottom: 12px;">Удобство и доступность</h4>
                        <p style="font-size: 16px; color: #6B7280; line-height: 1.5;">Персональный онлайн-кабинет и актуальная база данных</p>
                    </div>

                    <!-- Advantage 4 -->
                    <div style="background: #F9FAFB; border-radius: 16px; padding: 24px; text-align: center;">
                        <div style="width: 80px; height: 80px; background: #E8F5F3; border-radius: 12px; margin: 0 auto 16px; display: flex; align-items: center; justify-content: center;">
                            <img src="{{asset('current/img/image-21.png')}}" alt="Развитие" style="width: 60px;" />
                        </div>
                        <div style="font-size: 16px; color: #6B7280; margin-bottom: 8px;">04</div>
                        <h4 style="font-size: 20px; font-weight: 600; margin-bottom: 12px;">Устойчивость и развитие</h4>
                        <p style="font-size: 16px; color: #6B7280; line-height: 1.5;">Фундамент для долгосрочного партнерства, поддержка вашего бизнеса на каждом этапе</p>
                    </div>
                </div>
                <div style="text-align: center; margin-top: 40px;">
                    <a href="#" style="display: inline-flex; align-items: center; background: #2DD4BF; color: white; padding: 16px 32px; border-radius: 60px; text-decoration: none; font-weight: 600; font-size: 16px;">Узнать всё о платформе</a>
                </div>
            </div>
        </div>

        <!-- Services Section -->
        <div style="padding: 80px 0; background: #F9FAFB;">
            <div style="max-width: 1280px; margin: 0 auto; padding: 0 80px;">
                <h2 style="font-size: 52px; font-weight: 500; text-align: center; margin-bottom: 60px;">
                    Предоставляем качественные и комплексные <span style="color: #2DD4BF;">решения</span> для вашего бизнеса
                </h2>
                
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px;">
                    <!-- Service 1 -->
                    <div style="background: #FFF9E6; border-radius: 20px; padding: 32px; position: relative; overflow: hidden;">
                        <h3 style="font-size: 28px; font-weight: 600; margin-bottom: 24px;">Регистрация компании</h3>
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; align-items: start; margin-bottom: 12px;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px; margin-top: 2px;" />
                                <div>Подготовка учредительных документов филиала/представительств</div>
                            </div>
                            <div style="display: flex; align-items: start; margin-bottom: 12px;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px; margin-top: 2px;" />
                                <div>Сдача документов в регистрирующий орган</div>
                            </div>
                            <div style="display: flex; align-items: start;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px; margin-top: 2px;" />
                                <div>Заполнение формы на регистрацию</div>
                            </div>
                        </div>
                        <a href="#" style="display: inline-block; background: white; color: #1E1E1E; padding: 12px 24px; border-radius: 60px; text-decoration: none; font-weight: 600;">Оформить заявку</a>
                        <img src="{{asset('current/img/image-services-01-2@2x.png')}}" alt="Service" style="position: absolute; right: 24px; bottom: 24px; width: 150px;" />
                    </div>

                    <!-- Service 2 -->
                    <div style="background: #E8F5F3; border-radius: 20px; padding: 32px; position: relative; overflow: hidden;">
                        <h3 style="font-size: 28px; font-weight: 600; margin-bottom: 24px;">Регистрация компаний в СЭЗ и МФЦА</h3>
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; align-items: start;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px; margin-top: 2px;" />
                                <div>Регистрация в качестве участника Astana Hub International Technology Park</div>
                            </div>
                        </div>
                        <a href="#" style="display: inline-block; background: white; color: #1E1E1E; padding: 12px 24px; border-radius: 60px; text-decoration: none; font-weight: 600;">Оформить заявку</a>
                        <img src="{{asset('current/img/image-services-02-2@2x.png')}}" alt="Service" style="position: absolute; right: 24px; bottom: 24px; width: 150px;" />
                    </div>

                    <!-- Service 3 -->
                    <div style="background: #FFF9E6; border-radius: 20px; padding: 32px; position: relative; overflow: hidden;">
                        <h3 style="font-size: 28px; font-weight: 600; margin-bottom: 24px;">Открытие банковских счетов</h3>
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; align-items: start; margin-bottom: 12px;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px; margin-top: 2px;" />
                                <div>Сбор документов</div>
                            </div>
                            <div style="display: flex; align-items: start;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px; margin-top: 2px;" />
                                <div>Подача заявки на открытие счета</div>
                            </div>
                        </div>
                        <a href="#" style="display: inline-block; background: white; color: #1E1E1E; padding: 12px 24px; border-radius: 60px; text-decoration: none; font-weight: 600;">Оформить заявку</a>
                        <img src="{{asset('current/img/image-services-03-2@2x.png')}}" alt="Service" style="position: absolute; right: 24px; bottom: 24px; width: 150px;" />
                    </div>

                    <!-- Service 4 -->
                    <div style="background: #F3F4F6; border-radius: 20px; padding: 32px; position: relative; overflow: hidden;">
                        <h3 style="font-size: 28px; font-weight: 600; margin-bottom: 24px;">Лицензирование</h3>
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; align-items: start;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px; margin-top: 2px;" />
                                <div>Получение лицензий и разрешительных документов для всех видов деятельности</div>
                            </div>
                        </div>
                        <a href="#" style="display: inline-block; background: white; color: #1E1E1E; padding: 12px 24px; border-radius: 60px; text-decoration: none; font-weight: 600;">Оформить заявку</a>
                        <img src="{{asset('current/img/image-services-04-2@2x.png')}}" alt="Service" style="position: absolute; right: 24px; bottom: 24px; width: 150px;" />
                    </div>

                    <!-- Service 5 -->
                    <div style="background: #FFF9E6; border-radius: 20px; padding: 32px; position: relative; overflow: hidden;">
                        <h3 style="font-size: 28px; font-weight: 600; margin-bottom: 24px;">Получение визы С3 и С5</h3>
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; align-items: start; margin-bottom: 12px;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px; margin-top: 2px;" />
                                <div>Сбор документов и оформление приглашения</div>
                            </div>
                            <div style="display: flex; align-items: start;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px; margin-top: 2px;" />
                                <div>Оформление визы в консульстве РК</div>
                            </div>
                        </div>
                        <a href="#" style="display: inline-block; background: white; color: #1E1E1E; padding: 12px 24px; border-radius: 60px; text-decoration: none; font-weight: 600;">Оформить заявку</a>
                        <img src="{{asset('current/img/image-services-05-2@2x.png')}}" alt="Service" style="position: absolute; right: 24px; bottom: 24px; width: 150px;" />
                    </div>

                    <!-- Service 6 -->
                    <div style="background: #FEF3C7; border-radius: 20px; padding: 32px; position: relative; overflow: hidden;">
                        <h3 style="font-size: 28px; font-weight: 600; margin-bottom: 24px;">Предоставление отраслевого юриста</h3>
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; align-items: start;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px; margin-top: 2px;" />
                                <div>Услуги юриста на аутсорсинге для вашего бизнеса</div>
                            </div>
                        </div>
                        <a href="#" style="display: inline-block; background: white; color: #1E1E1E; padding: 12px 24px; border-radius: 60px; text-decoration: none; font-weight: 600;">Оформить заявку</a>
                        <img src="{{asset('current/img/image-services-06-2@2x.png')}}" alt="Service" style="position: absolute; right: 24px; bottom: 24px; width: 150px;" />
                    </div>

                    <!-- Service 7 -->
                    <div style="background: #DBEAFE; border-radius: 20px; padding: 32px; position: relative; overflow: hidden;">
                        <h3 style="font-size: 28px; font-weight: 600; margin-bottom: 24px;">Бухгалтерский аутсорсинг</h3>
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; align-items: start; margin-bottom: 12px;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px; margin-top: 2px;" />
                                <div>Подписание документов в банке (работа с менеджером банка)</div>
                            </div>
                            <div style="display: flex; align-items: start;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px; margin-top: 2px;" />
                                <div>Сбор данных клиентов</div>
                            </div>
                        </div>
                        <a href="#" style="display: inline-block; background: white; color: #1E1E1E; padding: 12px 24px; border-radius: 60px; text-decoration: none; font-weight: 600;">Оформить заявку</a>
                        <img src="{{asset('current/img/image-services-07-2@2x.png')}}" alt="Service" style="position: absolute; right: 24px; bottom: 24px; width: 150px;" />
                    </div>

                    <!-- Service 8 -->
                    <div style="background: #F3F4F6; border-radius: 20px; padding: 32px; position: relative; overflow: hidden;">
                        <h3 style="font-size: 28px; font-weight: 600; margin-bottom: 24px;">Дополнительные услуги</h3>
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; align-items: start; margin-bottom: 12px;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px; margin-top: 2px;" />
                                <div>Получение ИИН, БИН</div>
                            </div>
                            <div style="display: flex; align-items: start; margin-bottom: 12px;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px; margin-top: 2px;" />
                                <div>Получение ЭЦП</div>
                            </div>
                            <div style="display: flex; align-items: start;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px; margin-top: 2px;" />
                                <div>Оформление РВП</div>
                            </div>
                        </div>
                        <a href="#" style="display: inline-block; background: white; color: #1E1E1E; padding: 12px 24px; border-radius: 60px; text-decoration: none; font-weight: 600;">Оформить заявку</a>
                        <img src="{{asset('current/img/image-services-08-2@2x.png')}}" alt="Service" style="position: absolute; right: 24px; bottom: 24px; width: 150px;" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div style="padding: 80px 0; background: white;">
            <div style="max-width: 1280px; margin: 0 auto; padding: 0 80px;">
                <h2 style="font-size: 52px; font-weight: 500; text-align: center; margin-bottom: 60px;">О группе UPPERCASE</h2>
                <div style="display: grid; grid-template-columns: 300px 1fr; gap: 24px; align-items: start;">
                    <!-- Left Card -->
                    <div style="background: #1E1E1E; border-radius: 20px; padding: 40px; color: white;">
                        <img src="{{asset('current/img/logo-1.svg')}}" alt="UPPERCASE" style="width: 120px; margin-bottom: 24px;" />
                        <p style="font-size: 16px; line-height: 1.6;">UPPERLICENSE создан и разработан экспертами группы компаний UPPERCASE</p>
                    </div>

                    <!-- Right Grid -->
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px;">
                        <div style="background: #F9FAFB; border-radius: 16px; padding: 32px;">
                            <div style="font-size: 48px; font-weight: 700; color: #2DD4BF; margin-bottom: 12px;">13+ лет</div>
                            <div style="font-size: 16px; color: #6B7280;">На рынке юридических услуг и консалтинга</div>
                        </div>
                        <div style="background: #F9FAFB; border-radius: 16px; padding: 32px;">
                            <div style="font-size: 48px; font-weight: 700; color: #2DD4BF; margin-bottom: 12px;">6</div>
                            <div style="font-size: 16px; color: #6B7280;">Филиалов в ОАЭ и РК</div>
                        </div>
                        <div style="background: #F9FAFB; border-radius: 16px; padding: 32px;">
                            <div style="font-size: 48px; font-weight: 700; color: #2DD4BF; margin-bottom: 12px;">500+</div>
                            <div style="font-size: 16px; color: #6B7280;">Успешно завершенных проектов</div>
                        </div>
                        <div style="background: #F9FAFB; border-radius: 16px; padding: 32px;">
                            <div style="font-size: 48px; font-weight: 700; color: #2DD4BF; margin-bottom: 12px;">300+</div>
                            <div style="font-size: 16px; color: #6B7280;">Опытных специалистов в команде</div>
                        </div>
                        <div style="background: #F9FAFB; border-radius: 16px; padding: 32px; grid-column: span 2;">
                            <div style="font-size: 48px; font-weight: 700; color: #2DD4BF; margin-bottom: 12px;">3000+</div>
                            <div style="font-size: 16px; color: #6B7280;">Клиентов в области регистрации, лицензирования, сопровождения международных сделок и корпоративного права</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div style="padding: 80px 0; background: #2DD4BF; position: relative; overflow: hidden;">
            <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.1;">
                <div style="width: 100%; height: 100%; background: repeating-linear-gradient(45deg, transparent, transparent 10px, white 10px, white 12px);"></div>
            </div>
            <div style="max-width: 1280px; margin: 0 auto; padding: 0 80px; position: relative; z-index: 2; text-align: center;">
                <h2 style="font-size: 52px; font-weight: 500; color: white; margin-bottom: 24px;">Присоединяйтесь к UPPERLICENSE!</h2>
                <p style="font-size: 20px; color: white; margin-bottom: 40px; opacity: 0.9;">Мы делаем процесс получения лицензий и разрешений в Казахстане максимально простым и удобным.</p>
                <div style="display: flex; gap: 16px; justify-content: center;">
                    <a href="#" style="display: inline-flex; align-items: center; background: #1E1E1E; color: white; padding: 16px 32px; border-radius: 60px; text-decoration: none; font-weight: 600; font-size: 16px;">Стать клиентом</a>
                    <a href="#" style="display: inline-flex; align-items: center; background: white; color: #1E1E1E; padding: 16px 32px; border-radius: 60px; text-decoration: none; font-weight: 600; font-size: 16px;">Стать партнёром</a>
                </div>
            </div>
        </div>

        <!-- RoadMap Section -->
        <div class="roadmap-section">
            <h2 class="roadmap-title">UPPERLICENSE RoadMap</h2>
            <div class="roadmap-container">
                <div class="roadmap-timeline">
                    <!-- Milestone 1 -->
                    <div class="roadmap-milestone completed">
                        <div class="roadmap-dot"></div>
                        <div class="roadmap-year">2023</div>
                        <div class="roadmap-date">20 декабря</div>
                    </div>

                    <!-- Milestone 2 -->
                    <div class="roadmap-milestone">
                        <div class="roadmap-dot"></div>
                        <div class="roadmap-year">2024</div>
                        <div class="roadmap-date">20 января</div>
                        <p class="roadmap-description">Внедрение ИИ-решений для оптимизации бизнес-процессов и улучшения обслуживания клиентов</p>
                    </div>

                    <!-- Milestone 3 -->
                    <div class="roadmap-milestone">
                        <div class="roadmap-dot"></div>
                        <div class="roadmap-year">2024</div>
                        <div class="roadmap-date">26 января</div>
                    </div>

                    <!-- Milestone 4 -->
                    <div class="roadmap-milestone">
                        <div class="roadmap-dot"></div>
                        <div class="roadmap-year">2024</div>
                        <div class="roadmap-date">30 января</div>
                    </div>
                </div>

                <!-- RoadMap Cards -->
                <div class="roadmap-cards">
                    <div class="roadmap-card">
                        <img class="roadmap-card-icon" src="{{asset('current/img/icon1.png')}}" alt="Запуск MVP" />
                        <h4 class="roadmap-card-title">Запуск MVP</h4>
                    </div>

                    <div class="roadmap-card">
                        <img class="roadmap-card-icon" src="{{asset('current/img/icon2.png')}}" alt="Расширение перечня услуг" />
                        <h4 class="roadmap-card-title">Расширение перечня услуг</h4>
                    </div>

                    <div class="roadmap-card">
                        <img class="roadmap-card-icon" src="{{asset('current/img/icon3.png')}}" alt="Упрощенная оплата" />
                        <h4 class="roadmap-card-title">Упрощенная оплата</h4>
                    </div>

                    <div class="roadmap-card">
                        <img class="roadmap-card-icon" src="{{asset('current/img/icon4.png')}}" alt="Реферальная система" />
                        <h4 class="roadmap-card-title">Реферальная система</h4>
                    </div>
                </div>

                <!-- RoadMap Details -->
                <div class="roadmap-details">
                    <div class="roadmap-detail">
                        <h4 class="roadmap-detail-title">Запуск MVP</h4>
                        <ul class="roadmap-detail-list">
                            <li>Исследование и анализ рынка</li>
                            <li>Разработка новых продуктов или услуг</li>
                        </ul>
                    </div>

                    <div class="roadmap-detail">
                        <h4 class="roadmap-detail-title">Расширение перечня услуг</h4>
                        <ul class="roadmap-detail-list">
                            <li>Исследование и анализ рынка</li>
                            <li>Разработка новых продуктов или услуг</li>
                        </ul>
                    </div>

                    <div class="roadmap-detail">
                        <h4 class="roadmap-detail-title">Упрощенная оплата</h4>
                        <ul class="roadmap-detail-list">
                            <li>Интеграция с платежными системами</li>
                            <li>Разработка удобного интерфейса для безопасных онлайн-платежей</li>
                            <li>Обеспечение безопасности данных клиентов</li>
                        </ul>
                    </div>

                    <div class="roadmap-detail">
                        <h4 class="roadmap-detail-title">Реферальная система</h4>
                        <ul class="roadmap-detail-list">
                            <li>Программа лояльности для клиентов</li>
                            <li>Механизмы отслеживания рефералов и начисления бонусов за привлечение клиентов</li>
                        </ul>
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
                    <p>© 2024 UPPERLICENSE. Все права защищены.</p>
                </div>
            </div>
        </footer>
    </div>
</div>

<!-- Modals and Scripts -->
<script src="{{asset('/current/js/bootstrap.min.js')}}"></script>
<script>
    // Hero Slider
    let currentSlide = 1;
    const totalSlides = 4;
    let slideInterval;

    function showSlide(n) {
        const slides = document.querySelectorAll('.hero-slide');
        if (n > totalSlides) currentSlide = 1;
        if (n < 1) currentSlide = totalSlides;
        
        slides.forEach(slide => slide.classList.remove('active'));
        slides[currentSlide - 1].classList.add('active');
        
        document.querySelector('.current-slide').textContent = String(currentSlide).padStart(2, '0');
    }

    function nextSlide() {
        currentSlide++;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide--;
        showSlide(currentSlide);
    }

    // Auto-play
    function startSlideShow() {
        slideInterval = setInterval(nextSlide, 5000);
    }

    function stopSlideShow() {
        clearInterval(slideInterval);
    }

    // Event Listeners
    document.querySelector('.next-arrow').addEventListener('click', () => {
        stopSlideShow();
        nextSlide();
        startSlideShow();
    });

    document.querySelector('.prev-arrow').addEventListener('click', () => {
        stopSlideShow();
        prevSlide();
        startSlideShow();
    });

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

    // Start slideshow
    startSlideShow();
</script>

</body>
</html>
