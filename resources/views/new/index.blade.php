@extends('new-redesign.layouts.app')

@section('title')
    UPPERLICENSE - Главная
@endsection
@section('css')
    <link href="{{asset('css/faq-redesign.css')}}" rel="stylesheet">
@endsection
@push('css')
    <link href="{{asset('css/app_new.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/current/css/index.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/current/css/styleguide.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/current/css/globals.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('css/about-new-styles.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Hero Slider Styles */
        .hero-slider-section {
            position: relative;
            min-height: 720px;
            overflow: hidden;
            background: white;
            padding: 100px 0;
        }
        
        .hero-slide {
            display: none;
        }
        
        .hero-slide.active {
            display: block;
            animation: fadeIn 0.5s;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .hero-slide-content {
            max-width: 650px;
        }
        
        .hero-slide-title {
            font-size: 52px;
            font-weight: 500;
            line-height: 1.2;
            color: #1E1E1E;
            margin-bottom: 24px;
            font-family: 'Manrope', sans-serif;
        }
        
        .hero-slide-description {
            font-size: 18px;
            line-height: 1.6;
            color: #6B7280;
            margin-bottom: 32px;
            font-family: 'Manrope', sans-serif;
        }
        
        .hero-slide-button {
            display: inline-flex;
            align-items: center;
            background: #279760;
            color: white;
            padding: 16px 32px;
            border-radius: 60px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s;
            font-family: 'Manrope', sans-serif;
        }
        
        .hero-slide-button:hover {
            background: #1E7B4E;
            color: white;
            transform: translateY(-2px);
        }
        
        .hero-slider-controls {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-top: 40px;
        }
        
        .hero-slider-pagination {
            font-size: 16px;
            color: #6B7280;
            font-family: 'Manrope', sans-serif;
        }
        
        .hero-slider-arrows {
            display: flex;
            gap: 10px;
        }
        
        .hero-arrow {
            width: 40px;
            height: 40px;
            border: 1px solid #E5E7EB;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            background: white;
        }
        
        .hero-arrow:hover {
            border-color: #279760;
            background: #279760;
        }
        
        .hero-arrow:hover svg path {
            stroke: white;
        }
        
        /* Industries Section */
        .industries-section {
            padding: 80px 0;
            background: #F9FAFB;
        }
        
        .industries-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
        }
        
        .industry-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }
        
        .industry-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
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
            font-family: 'Manrope', sans-serif;
        }
        
        .industry-service {
            font-size: 14px;
            color: #6B7280;
            margin-bottom: 8px;
            font-family: 'Manrope', sans-serif;
        }
        
        .industry-more {
            display: inline-block;
            color: #279760;
            font-weight: 600;
            margin-top: 12px;
            font-size: 14px;
            font-family: 'Manrope', sans-serif;
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
            font-family: 'Manrope', sans-serif;
        }
        
        .roadmap-timeline {
            display: flex;
            justify-content: space-between;
            position: relative;
            padding-bottom: 40px;
            margin-bottom: 60px;
        }
        
        .roadmap-timeline::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(to right, #279760 25%, #E5E7EB 25%, #E5E7EB 100%);
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
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .roadmap-milestone.completed .roadmap-dot {
            background: #279760;
            border-color: #279760;
        }
        
        .roadmap-milestone.completed .roadmap-dot::after {
            content: '✓';
            color: white;
            font-size: 20px;
            font-weight: bold;
        }
        
        .roadmap-year {
            font-size: 14px;
            color: #6B7280;
            margin-bottom: 4px;
            font-family: 'Manrope', sans-serif;
        }
        
        .roadmap-date {
            font-size: 20px;
            font-weight: 600;
            color: #1E1E1E;
            margin-bottom: 16px;
            font-family: 'Manrope', sans-serif;
        }
        
        .roadmap-milestone.completed .roadmap-date {
            color: #279760;
        }
        
        .roadmap-description {
            font-size: 14px;
            color: #6B7280;
            line-height: 1.5;
            max-width: 250px;
            margin: 0 auto;
            font-family: 'Manrope', sans-serif;
        }
        
        .roadmap-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-bottom: 60px;
        }
        
        .roadmap-card {
            background: #F9FAFB;
            border-radius: 16px;
            padding: 32px 24px;
            text-align: center;
            transition: transform 0.3s;
        }
        
        .roadmap-card:hover {
            transform: translateY(-5px);
        }
        
        .roadmap-card-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 16px;
            object-fit: contain;
        }
        
        .roadmap-card-title {
            font-size: 18px;
            font-weight: 600;
            color: #1E1E1E;
            font-family: 'Manrope', sans-serif;
        }
        
        .roadmap-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
        }
        
        .roadmap-detail-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 16px;
            color: #1E1E1E;
            font-family: 'Manrope', sans-serif;
        }
        
        .roadmap-detail-list {
            list-style: none;
            padding: 0;
        }
        
        .roadmap-detail-list li {
            font-size: 14px;
            color: #6B7280;
            line-height: 1.6;
            margin-bottom: 12px;
            padding-left: 20px;
            position: relative;
            font-family: 'Manrope', sans-serif;
        }
        
        .roadmap-detail-list li::before {
            content: '•';
            position: absolute;
            left: 0;
            color: #279760;
            font-weight: bold;
        }
        
        @media (max-width: 768px) {
            .hero-slide-title {
                font-size: 32px;
            }
            
            .roadmap-title {
                font-size: 32px;
            }
            
            .industries-grid,
            .roadmap-cards,
            .roadmap-details {
                grid-template-columns: 1fr;
            }
            
            .roadmap-timeline {
                flex-direction: column;
                gap: 30px;
            }
            
            .roadmap-timeline::before {
                display: none;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Hero Slider Section -->
    <section class="hero-slider-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- Slide 1 -->
                    <div class="hero-slide active" data-slide="1">
                        <div class="hero-slide-content">
                            <h1 class="hero-slide-title">Мгновенный старт для вашего бизнеса в Казахстане</h1>
                            <a href="#" class="hero-slide-button">Начать регистрацию</a>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="hero-slide" data-slide="2">
                        <div class="hero-slide-content">
                            <h1 class="hero-slide-title">UPPERLICENSE: Ваш ключ к беспроблемному лицензированию</h1>
                            <p class="hero-slide-description">Надежное сопровождение вашего процесса лицензирования «под ключ», усиленное базой данных и индивидуально адаптированным личным кабинетом для вашего максимального комфорта и удобства</p>
                            <a href="#" class="hero-slide-button">Начать регистрацию</a>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="hero-slide" data-slide="3">
                        <div class="hero-slide-content">
                            <h1 class="hero-slide-title">Получите вашу рабочую и бизнес-визу в Казахстане легко и надежно с UPPERLICENSE. Быстро, эффективно, без хлопот</h1>
                            <p class="hero-slide-description">Оперативное оформление виз С3 и С5 — максимальная скорость, минимальные сроки</p>
                            <a href="#" class="hero-slide-button">Начать регистрацию</a>
                        </div>
                    </div>

                    <!-- Slide 4 -->
                    <div class="hero-slide" data-slide="4">
                        <div class="hero-slide-content">
                            <h1 class="hero-slide-title">Гарантируйте стабильный рост вашего бизнеса в эпоху перемен с экспертной поддержкой UPPERLICENSE</h1>
                            <p class="hero-slide-description">Высококлассное юридическое и бухгалтерское сопровождение от UPPERLICENSE — ваш надежный фундамент для стойкости и прогресса вашей компании</p>
                            <a href="#" class="hero-slide-button">Начать регистрацию</a>
                        </div>
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
                <div class="col-lg-6">
                    <img src="{{asset('current/img/image-slider-1-2.png')}}" alt="UPPERLICENSE" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Industries Section -->
    <section class="about-us">
        <div class="about-us__find">
            <div class="about-us__find__header">
                <h2>Преимущества работы с UPPERLICENSE</h2>
            </div>
            <div class="about-us__find__cards-container">
                <div class="about-us__find__card">
                    <div class="about-us__find__card__image">
                        <img src="{{asset('images/aboutactual.png')}}" alt="Контроль и инновации">
                    </div>
                    <p class="about-us__find__card__number">01</p>
                    <div class="about-us__find__card__content">
                        <h3 class="about-us__find__card__title">Контроль и инновации</h3>
                        <p class="about-us__find__card__description">Уникальная онлайн-панель управления для вашего бизнеса</p>
                    </div>
                </div>
                <div class="about-us__find__card">
                    <div class="about-us__find__card__image">
                        <img src="{{asset('images/aboutprof.png')}}" alt="Экспертность">
                    </div>
                    <p class="about-us__find__card__number">02</p>
                    <div class="about-us__find__card__content">
                        <h3 class="about-us__find__card__title">Экспертность </h3>
                        <p class="about-us__find__card__description">Полный спектр квалифицированной поддержки для вашего бизнеса</p>
                    </div>
                </div>
                <div class="about-us__find__card">
                    <div class="about-us__find__card__image">
                        <img src="{{asset('images/aboutserv.png')}}" alt="Удобство и доступность">
                    </div>
                    <p class="about-us__find__card__number">03</p>
                    <div class="about-us__find__card__content">
                        <h3 class="about-us__find__card__title">Удобство и доступность</h3>
                        <p class="about-us__find__card__description">Персональный онлайн-кабинет и актуальная база данных</p>
                    </div>
                </div>
                <div class="about-us__find__card">
                    <div class="about-us__find__card__image">
                        <img src="{{asset('images/aboutvideo.png')}}" alt="Устойчивость и развитие">
                    </div>
                    <p class="about-us__find__card__number">04</p>
                    <div class="about-us__find__card__content">
                        <h3 class="about-us__find__card__title">Устойчивость и развитие</h3>
                        <p class="about-us__find__card__description">Фундамент для долгосрочного партнерства, поддержка вашего бизнеса на каждом этапе</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Slider Section -->
    <section style="padding: 80px 0; background: white; overflow: hidden;">
        <div class="container">
            <h2 style="font-size: 52px; font-weight: 500; text-align: center; margin-bottom: 16px; font-family: 'Manrope', sans-serif;">
                Уже выбрали вашу <span style="color: #279760;">сферу</span> деятельности?
            </h2>
            <div style="text-align: center; margin-bottom: 60px;">
                <div style="display: inline-flex; gap: 10px;">
                    <div class="category-arrow-prev hero-arrow" style="cursor: pointer;">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.5 15L7.5 10L12.5 5" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="category-arrow-next hero-arrow" style="cursor: pointer;">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.5 5L12.5 10L7.5 15" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="categories-slider-wrapper" style="position: relative; overflow: hidden;">
                <div class="categories-slider" style="display: flex; gap: 24px; transition: transform 0.5s ease;">
                    <!-- Category 1 - Строительство -->
                    <div class="category-slide" style="min-width: calc(50% - 12px); background: #F9FAFB; border-radius: 20px; padding: 32px; position: relative;">
                        <h3 style="font-size: 28px; font-weight: 600; margin-bottom: 24px;">Строительство</h3>
                        <div style="margin-bottom: 80px;">
                            <div style="margin-bottom: 12px;">
                                <div style="display: inline-block; background: white; border-radius: 20px; padding: 8px 16px; font-size: 14px;">Строительные работы</div>
                            </div>
                            <div style="margin-bottom: 12px;">
                                <div style="display: inline-block; background: white; border-radius: 20px; padding: 8px 16px; font-size: 14px;">Контроль СР</div>
                            </div>
                            <div>
                                <div style="display: inline-block; background: white; border-radius: 20px; padding: 8px 16px; font-size: 14px; color: #279760; font-weight: 600;">+2</div>
                            </div>
                        </div>
                        <img src="{{asset('current/img/image-spheres-01-10@2x.png')}}" alt="Строительство" style="position: absolute; right: 32px; bottom: 32px; width: 200px; height: 200px; object-fit: contain;" />
                    </div>

                    <!-- Category 2 - Промышленность -->
                    <div class="category-slide" style="min-width: calc(50% - 12px); background: #F9FAFB; border-radius: 20px; padding: 32px; position: relative;">
                        <h3 style="font-size: 28px; font-weight: 600; margin-bottom: 24px;">Промышленность</h3>
                        <div style="margin-bottom: 80px;">
                            <div style="margin-bottom: 12px;">
                                <div style="display: inline-block; background: white; border-radius: 20px; padding: 8px 16px; font-size: 14px;">Энергетика</div>
                            </div>
                            <div style="margin-bottom: 12px;">
                                <div style="display: inline-block; background: white; border-radius: 20px; padding: 8px 16px; font-size: 14px;">Добыча полезных ископаемых</div>
                            </div>
                            <div>
                                <div style="display: inline-block; background: white; border-radius: 20px; padding: 8px 16px; font-size: 14px; color: #279760; font-weight: 600;">+4</div>
                            </div>
                        </div>
                        <img src="{{asset('current/img/image-spheres-01-10@2x.png')}}" alt="Промышленность" style="position: absolute; right: 32px; bottom: 32px; width: 200px; height: 200px; object-fit: contain;" />
                    </div>

                    <!-- Category 3 - Медицина -->
                    <div class="category-slide" style="min-width: calc(50% - 12px); background: #F9FAFB; border-radius: 20px; padding: 32px; position: relative;">
                        <h3 style="font-size: 28px; font-weight: 600; margin-bottom: 24px;">Медицина</h3>
                        <div style="margin-bottom: 80px;">
                            <div style="margin-bottom: 12px;">
                                <div style="display: inline-block; background: white; border-radius: 20px; padding: 8px 16px; font-size: 14px;">Медицинское оборудование</div>
                            </div>
                            <div style="margin-bottom: 12px;">
                                <div style="display: inline-block; background: white; border-radius: 20px; padding: 8px 16px; font-size: 14px;">Фарм. индустрия</div>
                            </div>
                            <div>
                                <div style="display: inline-block; background: white; border-radius: 20px; padding: 8px 16px; font-size: 14px; color: #279760; font-weight: 600;">+4</div>
                            </div>
                        </div>
                        <img src="{{asset('current/img/image-spheres-01-6@2x.png')}}" alt="Медицина" style="position: absolute; right: 32px; bottom: 32px; width: 200px; height: 200px; object-fit: contain;" />
                    </div>

                    <!-- Category 4 - Импорт-экспорт -->
                    <div class="category-slide" style="min-width: calc(50% - 12px); background: #F9FAFB; border-radius: 20px; padding: 32px; position: relative;">
                        <h3 style="font-size: 28px; font-weight: 600; margin-bottom: 24px;">Импорт-экспорт</h3>
                        <div style="margin-bottom: 80px;">
                            <div style="margin-bottom: 12px;">
                                <div style="display: inline-block; background: white; border-radius: 20px; padding: 8px 16px; font-size: 14px;">Таможенные процедуры</div>
                            </div>
                            <div style="margin-bottom: 12px;">
                                <div style="display: inline-block; background: white; border-radius: 20px; padding: 8px 16px; font-size: 14px;">Транспорт</div>
                            </div>
                            <div>
                                <div style="display: inline-block; background: white; border-radius: 20px; padding: 8px 16px; font-size: 14px; color: #279760; font-weight: 600;">+3</div>
                            </div>
                        </div>
                        <img src="{{asset('current/img/image-spheres-01-7@2x.png')}}" alt="Импорт-экспорт" style="position: absolute; right: 32px; bottom: 32px; width: 200px; height: 200px; object-fit: contain;" />
                    </div>
                </div>
            </div>
            
            <div style="text-align: center; margin-top: 40px;">
                <p style="font-size: 28px; font-weight: 500; margin-bottom: 24px; font-family: 'Manrope', sans-serif;">Делаем процесс лицензирования легким и доступным!</p>
                <a href="#" style="display: inline-flex; align-items: center; background: #279760; color: white; padding: 16px 32px; border-radius: 60px; text-decoration: none; font-weight: 600; font-size: 16px;">Оформить заявку</a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section style="padding: 80px 0; background: #F9FAFB;">
        <div class="container">
            <h2 style="font-size: 52px; font-weight: 500; text-align: center; margin-bottom: 60px; font-family: 'Manrope', sans-serif;">
                Предоставляем качественные и комплексные <span style="color: #279760;">решения</span> для вашего бизнеса
            </h2>
            
            <div class="row g-4">
                <!-- Service 1 -->
                <div class="col-lg-6">
                    <div style="background: #FFF9E6; border-radius: 20px; padding: 32px; position: relative; min-height: 280px;">
                        <h3 style="font-size: 28px; font-weight: 600; margin-bottom: 24px;">Регистрация компании</h3>
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; align-items: start; margin-bottom: 12px;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div style="font-size: 14px;">Подготовка учредительных документов</div>
                            </div>
                            <div style="display: flex; align-items: start; margin-bottom: 12px;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div style="font-size: 14px;">Сдача документов в орган</div>
                            </div>
                            <div style="display: flex; align-items: start;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div style="font-size: 14px;">Заполнение формы на регистрацию</div>
                            </div>
                        </div>
                        <a href="#" style="display: inline-block; background: white; color: #1E1E1E; padding: 12px 24px; border-radius: 60px; text-decoration: none; font-weight: 600;">Оформить заявку</a>
                        <img src="{{asset('current/img/image-services-01-2@2x.png')}}" alt="Service" style="position: absolute; right: 24px; bottom: 24px; width: 120px; opacity: 0.9;" />
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="col-lg-6">
                    <div style="background: #E8F5F3; border-radius: 20px; padding: 32px; position: relative; min-height: 280px;">
                        <h3 style="font-size: 28px; font-weight: 600; margin-bottom: 24px;">Регистрация в СЭЗ и МФЦА</h3>
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; align-items: start;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div style="font-size: 14px;">Регистрация в Astana Hub</div>
                            </div>
                        </div>
                        <a href="#" style="display: inline-block; background: white; color: #1E1E1E; padding: 12px 24px; border-radius: 60px; text-decoration: none; font-weight: 600;">Оформить заявку</a>
                        <img src="{{asset('current/img/image-services-02-2@2x.png')}}" alt="Service" style="position: absolute; right: 24px; bottom: 24px; width: 120px; opacity: 0.9;" />
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="col-lg-6">
                    <div style="background: #FFF9E6; border-radius: 20px; padding: 32px; position: relative; min-height: 280px;">
                        <h3 style="font-size: 28px; font-weight: 600; margin-bottom: 24px;">Открытие банковских счетов</h3>
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; align-items: start; margin-bottom: 12px;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div style="font-size: 14px;">Сбор документов</div>
                            </div>
                            <div style="display: flex; align-items: start;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div style="font-size: 14px;">Подача заявки на открытие счета</div>
                            </div>
                        </div>
                        <a href="#" style="display: inline-block; background: white; color: #1E1E1E; padding: 12px 24px; border-radius: 60px; text-decoration: none; font-weight: 600;">Оформить заявку</a>
                        <img src="{{asset('current/img/image-services-03-2@2x.png')}}" alt="Service" style="position: absolute; right: 24px; bottom: 24px; width: 120px; opacity: 0.9;" />
                    </div>
                </div>

                <!-- Service 4 -->
                <div class="col-lg-6">
                    <div style="background: #F3F4F6; border-radius: 20px; padding: 32px; position: relative; min-height: 280px;">
                        <h3 style="font-size: 28px; font-weight: 600; margin-bottom: 24px;">Лицензирование</h3>
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; align-items: start;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div style="font-size: 14px;">Получение лицензий для всех видов деятельности</div>
                            </div>
                        </div>
                        <a href="#" style="display: inline-block; background: white; color: #1E1E1E; padding: 12px 24px; border-radius: 60px; text-decoration: none; font-weight: 600;">Оформить заявку</a>
                        <img src="{{asset('current/img/image-services-04-2@2x.png')}}" alt="Service" style="position: absolute; right: 24px; bottom: 24px; width: 120px; opacity: 0.9;" />
                    </div>
                </div>

                <!-- Service 5 -->
                <div class="col-lg-6">
                    <div style="background: #FFF9E6; border-radius: 20px; padding: 32px; position: relative; min-height: 280px;">
                        <h3 style="font-size: 28px; font-weight: 600; margin-bottom: 24px;">Получение визы С3 и С5</h3>
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; align-items: start; margin-bottom: 12px;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div style="font-size: 14px;">Сбор документов и оформление</div>
                            </div>
                            <div style="display: flex; align-items: start;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div style="font-size: 14px;">Оформление визы в консульстве РК</div>
                            </div>
                        </div>
                        <a href="#" style="display: inline-block; background: white; color: #1E1E1E; padding: 12px 24px; border-radius: 60px; text-decoration: none; font-weight: 600;">Оформить заявку</a>
                        <img src="{{asset('current/img/image-services-05-2@2x.png')}}" alt="Service" style="position: absolute; right: 24px; bottom: 24px; width: 120px; opacity: 0.9;" />
                    </div>
                </div>

                <!-- Service 6 -->
                <div class="col-lg-6">
                    <div style="background: #FEF3C7; border-radius: 20px; padding: 32px; position: relative; min-height: 280px;">
                        <h3 style="font-size: 28px; font-weight: 600; margin-bottom: 24px;">Отраслевой юрист</h3>
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; align-items: start;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div style="font-size: 14px;">Услуги юриста на аутсорсинге</div>
                            </div>
                        </div>
                        <a href="#" style="display: inline-block; background: white; color: #1E1E1E; padding: 12px 24px; border-radius: 60px; text-decoration: none; font-weight: 600;">Оформить заявку</a>
                        <img src="{{asset('current/img/image-services-06-2@2x.png')}}" alt="Service" style="position: absolute; right: 24px; bottom: 24px; width: 120px; opacity: 0.9;" />
                    </div>
                </div>

                <!-- Service 7 -->
                <div class="col-lg-6">
                    <div style="background: #DBEAFE; border-radius: 20px; padding: 32px; position: relative; min-height: 280px;">
                        <h3 style="font-size: 28px; font-weight: 600; margin-bottom: 24px;">Бухгалтерский аутсорсинг</h3>
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; align-items: start; margin-bottom: 12px;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div style="font-size: 14px;">Подписание документов в банке</div>
                            </div>
                            <div style="display: flex; align-items: start;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div style="font-size: 14px;">Сбор данных клиентов</div>
                            </div>
                        </div>
                        <a href="#" style="display: inline-block; background: white; color: #1E1E1E; padding: 12px 24px; border-radius: 60px; text-decoration: none; font-weight: 600;">Оформить заявку</a>
                        <img src="{{asset('current/img/image-services-07-2@2x.png')}}" alt="Service" style="position: absolute; right: 24px; bottom: 24px; width: 120px; opacity: 0.9;" />
                    </div>
                </div>

                <!-- Service 8 -->
                <div class="col-lg-6">
                    <div style="background: #F3F4F6; border-radius: 20px; padding: 32px; position: relative; min-height: 280px;">
                        <h3 style="font-size: 28px; font-weight: 600; margin-bottom: 24px;">Дополнительные услуги</h3>
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; align-items: start; margin-bottom: 12px;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div style="font-size: 14px;">Получение ИИН, БИН</div>
                            </div>
                            <div style="display: flex; align-items: start; margin-bottom: 12px;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div style="font-size: 14px;">Получение ЭЦП</div>
                            </div>
                            <div style="display: flex; align-items: start;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div style="font-size: 14px;">Оформление РВП</div>
                            </div>
                        </div>
                        <a href="#" style="display: inline-block; background: white; color: #1E1E1E; padding: 12px 24px; border-radius: 60px; text-decoration: none; font-weight: 600;">Оформить заявку</a>
                        <img src="{{asset('current/img/image-services-08-2@2x.png')}}" alt="Service" style="position: absolute; right: 24px; bottom: 24px; width: 120px; opacity: 0.9;" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section style="padding: 80px 0; background: white;" class="about-us">
        <div class="about-us__stats">
            <div class="container">
                <div class="about-us__stats__grid">
                    <div class="about-us__stats__header">
                        <div class="about-us__stats__logo">
                            <i class="fas fa-chevron-up"></i>
                            <span>UPPERCASE</span>
                        </div>
                        <p>UPPERLICENSE создан и разработан<br>экспертами группы компаний UPPERCASE</p>
                    </div>
                    <div class="about-us__stats__item">
                        <div class="about-us__stats__number">13+</div>
                        <p>лет</p>
                        <span>На рынке юридических услуг и консалтинга</span>
                    </div>
                    <div class="about-us__stats__item">
                        <div class="about-us__stats__number">6</div>
                        <p>Филиалов в ОАЭ и РК</p>
                    </div>
                    <div class="about-us__stats__item">
                        <div class="about-us__stats__number">500+</div>
                        <p>Успешно завершенных проектов</p>
                    </div>
                    <div class="about-us__stats__item">
                        <div class="about-us__stats__number">300+</div>
                        <p>Опытных специалистов в команде</p>
                    </div>
                    <div class="about-us__stats__item">
                        <div class="about-us__stats__number">3000+</div>
                        <p>Клиентов в области регистрации, лицензирования, сопровождения международных сделок и корпоративного права</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section style="padding: 80px 0; background: #279760; position: relative; overflow: hidden;">
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.1;">
            <div style="width: 100%; height: 100%; background: repeating-linear-gradient(45deg, transparent, transparent 10px, white 10px, white 12px);"></div>
        </div>
        <div class="container" style="position: relative; z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2 style="font-size: 48px; font-weight: 500; color: white; margin-bottom: 24px; font-family: 'Manrope', sans-serif;">Пользователю портала предоставляется простой и удобный личный кабинет</h2>
                    <p style="font-size: 18px; color: white; margin-bottom: 32px; opacity: 0.9;">Специалисты готовы помочь вам</p>
                    <div style="display: flex; gap: 16px; flex-wrap: wrap;">
                        <a href="#" style="display: inline-flex; align-items: center; background: white; color: #279760; padding: 16px 32px; border-radius: 60px; text-decoration: none; font-weight: 600; font-size: 16px;">Связаться с нами</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <img src="{{asset('current/img/image-personalarea-2.png')}}" alt="CTA" class="img-fluid" />
                </div>
            </div>
        </div>
    </section>
    <section class="client-cases">
        <div class="container">
            <div class="client-cases__header">
                <h2 class="client-cases__title">Кейсы наших клиентов</h2>
                <div class="client-cases__navigation">
                    <button type="button" class="client-cases__nav-btn client-cases__nav-btn--prev"
                            aria-label="Предыдущий кейс">&lt;
                    </button>
                    <button type="button" class="client-cases__nav-btn client-cases__nav-btn--next"
                            aria-label="Следующий кейс">&gt;
                    </button>
                </div>
            </div>

            <div class="client-case-detail">
                <div class="client-case-detail__left">
                    <h3 class="client-case-detail__title">Розничная торговля путём заказа товаров по почте</h3>
                    <div class="client-case-detail__client-info">
                        <div class="client-case-detail__logo">
                            <span class="logo-text">ТН</span>
                        </div>
                        <div class="client-case-detail__client-text">
                            <p class="client-case-detail__client-name">Технониколь</p>
                            <p class="client-case-detail__client-description">Производитель строительных материалов
                                и систем</p>
                        </div>
                    </div>
                    <button class="client-case-detail__video-btn">
                        Смотреть видео-отзыв
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 12L10 8L6 4V12Z" fill="currentColor"/>
                        </svg>
                    </button>
                </div>

                <div class="client-case-detail__right">
                    <div class="client-case-detail__section">
                        <h4 class="client-case-detail__section-title">Входные параметры</h4>
                        <ul class="client-case-detail__list">
                            <li class="client-case-detail__list-item">
                                <svg class="client-case-detail__checkmark" width="16" height="16"
                                     viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.3333 4L6 11.3333L2.66667 8" stroke="#16A34A" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                В короткие сроки (7 рабочих дней) получить лицензию на проведение
                                строительно-монтажных работ 1 категории.
                            </li>
                            <li class="client-case-detail__list-item">
                                <svg class="client-case-detail__checkmark" width="16" height="16"
                                     viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.3333 4L6 11.3333L2.66667 8" stroke="#16A34A" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Получить консультирование отраслевого юриста по квалификационным требованиям и
                                нормативно-правовым актам в сфере строительства.
                            </li>
                        </ul>
                    </div>

                    <div class="client-case-detail__section">
                        <h4 class="client-case-detail__section-title">Решение</h4>
                        <ul class="client-case-detail__list">
                            <li class="client-case-detail__list-item">
                                <svg class="client-case-detail__checkmark" width="16" height="16"
                                     viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.3333 4L6 11.3333L2.66667 8" stroke="#16A34A" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Получение консультации отраслевого юриста. Консультация опытного юриста по вопросам
                                квалификационных требований и нормативно-правовых актов в сфере строительства.
                            </li>
                            <li class="client-case-detail__list-item">
                                <svg class="client-case-detail__checkmark" width="16" height="16"
                                     viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.3333 4L6 11.3333L2.66667 8" stroke="#16A34A" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Советы и рекомендации по подготовке документов и прохождению процедуры
                                лицензирования.
                            </li>
                            <li class="client-case-detail__list-item">
                                <svg class="client-case-detail__checkmark" width="16" height="16"
                                     viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.3333 4L6 11.3333L2.66667 8" stroke="#16A34A" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Подготовка необходимого пакета документов
                            </li>
                        </ul>
                        <button type="button" class="client-case-detail__show-more-btn">Показать полностью</button>
                    </div>

                    <div class="client-case-detail__section client-case-detail__section--result">
                        <h4 class="client-case-detail__section-title">Результат</h4>
                        <ul class="client-case-detail__list">
                            <li class="client-case-detail__list-item">
                                <svg class="client-case-detail__checkmark client-case-detail__checkmark--white"
                                     width="16" height="16" viewBox="0 0 16 16" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.3333 4L6 11.3333L2.66667 8" stroke="white" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                В результате успешной реализации этого кейса, компания смогла получить лицензию на
                                проведение строительно-монтажных работ 1 категории в короткие сроки, а также
                                получила консультацию отраслевого юриста, что позволило ей эффективно соблюсти все
                                требования и нормативы в сфере строительства
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Section -->
    <section style="padding: 80px 0; background: #F9FAFB;">
        <div class="container">
            <h2 style="font-size: 52px; font-weight: 500; text-align: center; margin-bottom: 60px; font-family: 'Manrope', sans-serif;">Нам доверяют</h2>
            <div class="row g-4 align-items-center justify-content-center">
                <div class="col-lg-2 col-md-3 col-4 text-center">
                    <img src="{{asset('current/img/group-7@2x.png')}}" alt="Partner" style="max-width: 100%; height: auto; opacity: 0.7;" />
                </div>
                <div class="col-lg-2 col-md-3 col-4 text-center">
                    <img src="{{asset('current/img/button-10.svg')}}" alt="Partner" style="max-width: 100%; height: auto; opacity: 0.7;" />
                </div>
                <div class="col-lg-2 col-md-3 col-4 text-center">
                    <img src="{{asset('current/img/button-11.png')}}" alt="Partner" style="max-width: 100%; height: auto; opacity: 0.7;" />
                </div>
                <div class="col-lg-2 col-md-3 col-4 text-center">
                    <img src="{{asset('current/img/button-12.png')}}" alt="Partner" style="max-width: 100%; height: auto; opacity: 0.7;" />
                </div>
                <div class="col-lg-2 col-md-3 col-4 text-center">
                    <img src="{{asset('current/img/button-13.png')}}" alt="Partner" style="max-width: 100%; height: auto; opacity: 0.7;" />
                </div>
                <div class="col-lg-2 col-md-3 col-4 text-center">
                    <img src="{{asset('current/img/button-14.png')}}" alt="Partner" style="max-width: 100%; height: auto; opacity: 0.7;" />
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="consultation-block">
        <div class="container">
            <div class="row align-items-stretch">
                <div class="col-lg-7 d-flex flex-column justify-content-center mb-4 mb-lg-0">
                    <h2 class="consultation-hero-title">Свяжитесь с нами</h2>
                    <p class="consultation-hero-subtitle">Предоставим быстрое и эффективное открытие и ведение бизнеса в Казахстане</p>
                </div>
                <div class="col-lg-5">
                    <div class="consultation-form-container">
                        <div class="consultation-form">
                            <form class="consultation-form-content" action="#" method="post">
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Представьтесь пожалуйста</label>
                                        <input type="text" class="form-input" placeholder="Ф.И.О">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Услуга</label>
                                        <select class="form-select">
                                            <option value="">Выберите услугу</option>
                                            <option value="licensing">Лицензирование</option>
                                            <option value="registration">Регистрация компании</option>
                                            <option value="legal">Юридическое сопровождение</option>
                                            <option value="accounting">Бухгалтерия</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Электронная почта</label>
                                        <input type="email" class="form-input" placeholder="example@gmail.com">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Телефон</label>
                                        <input type="tel" class="form-input" placeholder="8 (___) ___-__-__">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Комментарий</label>
                                        <textarea class="form-textarea" placeholder="Оставьте свой комментарий" rows="4"></textarea>
                                    </div>
                                    <div class="col-12 d-flex align-items-center flex-wrap gap-2">
                                        <button type="submit" class="submit-btn">Получить консультацию</button>
                                        <p class="privacy-text mb-0">Нажимая на кнопку, я соглашаюсь на обработку персональных данных</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="{{asset('images/Vector_6908.png')}}" alt="" class="consultation-bg-vector">
    </section>

    <!-- FAQ Section -->
    <section style="padding: 80px 0; background: #F9FAFB;">
        <div class="container">
            <h2 style="font-size: 52px; font-weight: 500; text-align: center; margin-bottom: 60px; font-family: 'Manrope', sans-serif;">Ответы на вопросы</h2>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item" style="border: none; background: white; border-radius: 16px; margin-bottom: 16px; overflow: hidden;">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" style="background: white; border: none; padding: 24px; font-size: 18px; font-weight: 600;">
                            Какие документы нужны для регистрации ТОО?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body" style="padding: 0 24px 24px; color: #6B7280; font-size: 16px; line-height: 1.6;">
                            Для регистрации ТОО потребуются копии удостоверений личности учредителей, решение о создании ТОО, устав организации и заявление на регистрацию. Наши специалисты помогут подготовить все необходимые документы.
                        </div>
                    </div>
                </div>

                <div class="accordion-item" style="border: none; background: white; border-radius: 16px; margin-bottom: 16px; overflow: hidden;">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" style="background: white; border: none; padding: 24px; font-size: 18px; font-weight: 600;">
                            Сколько времени занимает получение лицензии?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body" style="padding: 0 24px 24px; color: #6B7280; font-size: 16px; line-height: 1.6;">
                            Срок получения лицензии зависит от вида деятельности и составляет от 15 до 30 рабочих дней. Мы помогаем ускорить процесс за счет правильной подготовки документов.
                        </div>
                    </div>
                </div>

                <div class="accordion-item" style="border: none; background: white; border-radius: 16px; margin-bottom: 16px; overflow: hidden;">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" style="background: white; border: none; padding: 24px; font-size: 18px; font-weight: 600;">
                            Как получить рабочую визу в Казахстане?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body" style="padding: 0 24px 24px; color: #6B7280; font-size: 16px; line-height: 1.6;">
                            Для получения рабочей визы необходимо иметь приглашение от работодателя, действующий загранпаспорт и пакет документов. Мы оказываем полное сопровождение процесса получения виз С3 и С5.
                        </div>
                    </div>
                </div>

                <div class="accordion-item" style="border: none; background: white; border-radius: 16px; margin-bottom: 16px; overflow: hidden;">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" style="background: white; border: none; padding: 24px; font-size: 18px; font-weight: 600;">
                            Какие услуги входят в бухгалтерский аутсорсинг?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body" style="padding: 0 24px 24px; color: #6B7280; font-size: 16px; line-height: 1.6;">
                            Бухгалтерский аутсорсинг включает ведение бухгалтерского учета, подготовку и сдачу отчетности, консультации по налоговым вопросам, работу с банками и контролирующими органами.
                        </div>
                    </div>
                </div>

                <div class="accordion-item" style="border: none; background: white; border-radius: 16px; margin-bottom: 16px; overflow: hidden;">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" style="background: white; border: none; padding: 24px; font-size: 18px; font-weight: 600;">
                            Что такое Astana Hub и как в него попасть?
                        </button>
                    </h2>
                    <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body" style="padding: 0 24px 24px; color: #6B7280; font-size: 16px; line-height: 1.6;">
                            Astana Hub — это международный технопарк IT-стартапов с особыми налоговыми льготами. Для регистрации необходимо соответствовать критериям технологичности проекта. Мы помогаем с подготовкой документов и регистрацией.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="roadmap-section">
        <div class="container">
            <h2 class="roadmap-title">UPPERLICENSE RoadMap</h2>

            <div class="roadmap-timeline">
                <div class="roadmap-milestone completed">
                    <div class="roadmap-dot"></div>
                    <div class="roadmap-year">2023</div>
                    <div class="roadmap-date">20 декабря</div>
                </div>

                <div class="roadmap-milestone">
                    <div class="roadmap-dot"></div>
                    <div class="roadmap-year">2024</div>
                    <div class="roadmap-date">20 января</div>
                    <p class="roadmap-description">Внедрение ИИ-решений для оптимизации бизнес-процессов и улучшения обслуживания клиентов</p>
                </div>

                <div class="roadmap-milestone">
                    <div class="roadmap-dot"></div>
                    <div class="roadmap-year">2024</div>
                    <div class="roadmap-date">26 января</div>
                </div>

                <div class="roadmap-milestone">
                    <div class="roadmap-dot"></div>
                    <div class="roadmap-year">2024</div>
                    <div class="roadmap-date">30 января</div>
                </div>
            </div>

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

            <div class="roadmap-details">
                <div>
                    <h4 class="roadmap-detail-title">Запуск MVP</h4>
                    <ul class="roadmap-detail-list">
                        <li>Исследование и анализ рынка</li>
                        <li>Разработка новых продуктов или услуг</li>
                    </ul>
                </div>

                <div>
                    <h4 class="roadmap-detail-title">Расширение перечня услуг</h4>
                    <ul class="roadmap-detail-list">
                        <li>Исследование и анализ рынка</li>
                        <li>Разработка новых продуктов или услуг</li>
                    </ul>
                </div>

                <div>
                    <h4 class="roadmap-detail-title">Упрощенная оплата</h4>
                    <ul class="roadmap-detail-list">
                        <li>Интеграция с платежными системами</li>
                        <li>Разработка удобного интерфейса для безопасных онлайн-платежей</li>
                        <li>Обеспечение безопасности данных клиентов</li>
                    </ul>
                </div>

                <div>
                    <h4 class="roadmap-detail-title">Реферальная система</h4>
                    <ul class="roadmap-detail-list">
                        <li>Программа лояльности для клиентов</li>
                        <li>Механизмы отслеживания рефералов и начисления бонусов за привлечение клиентов</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hero Slider
            let currentSlide = 1;
            const totalSlides = 4;
            let slideInterval;

            function showSlide(n) {
                const slides = document.querySelectorAll('.hero-slide');
                if (n > totalSlides) currentSlide = 1;
                if (n < 1) currentSlide = totalSlides;
                
                slides.forEach(slide => slide.classList.remove('active'));
                if (slides[currentSlide - 1]) {
                    slides[currentSlide - 1].classList.add('active');
                }
                
                const currentSlideEl = document.querySelector('.current-slide');
                if (currentSlideEl) {
                    currentSlideEl.textContent = String(currentSlide).padStart(2, '0');
                }
            }

            function nextSlide() {
                currentSlide++;
                showSlide(currentSlide);
            }

            function prevSlide() {
                currentSlide--;
                showSlide(currentSlide);
            }

            function startSlideShow() {
                slideInterval = setInterval(nextSlide, 5000);
            }

            function stopSlideShow() {
                clearInterval(slideInterval);
            }

            const nextArrow = document.querySelector('.next-arrow');
            const prevArrow = document.querySelector('.prev-arrow');
            
            if (nextArrow) {
                nextArrow.addEventListener('click', () => {
                    stopSlideShow();
                    nextSlide();
                    startSlideShow();
                });
            }
            
            if (prevArrow) {
                prevArrow.addEventListener('click', () => {
                    stopSlideShow();
                    prevSlide();
                    startSlideShow();
                });
            }

            // Start slideshow
            startSlideShow();

            // Categories Slider
            let currentCategorySlide = 0;
            const categorySlides = document.querySelectorAll('.category-slide');
            const categoriesSlider = document.querySelector('.categories-slider');
            const categoryPrevArrow = document.querySelector('.category-arrow-prev');
            const categoryNextArrow = document.querySelector('.category-arrow-next');

            function updateCategorySlider() {
                if (categoriesSlider && categorySlides.length > 0) {
                    const slideWidth = categorySlides[0].offsetWidth + 24; // width + gap
                    categoriesSlider.style.transform = `translateX(-${currentCategorySlide * slideWidth}px)`;
                }
            }

            if (categoryNextArrow) {
                categoryNextArrow.addEventListener('click', () => {
                    if (currentCategorySlide < categorySlides.length - 2) {
                        currentCategorySlide++;
                        updateCategorySlider();
                    }
                });
            }

            if (categoryPrevArrow) {
                categoryPrevArrow.addEventListener('click', () => {
                    if (currentCategorySlide > 0) {
                        currentCategorySlide--;
                        updateCategorySlider();
                    }
                });
            }

            // Update slider on window resize
            window.addEventListener('resize', updateCategorySlider);
        });
    </script>
@endpush
