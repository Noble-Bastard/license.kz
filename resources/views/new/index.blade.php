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
        .hero-top-title {
            font-size: 52px;
            font-weight: 500;
            color: #1E1E1E;
            font-family: 'Manrope', sans-serif;
            margin-bottom: 37px;
            line-height: 110%;
        }
        
        .hero-corner-frame {
            position: absolute;
            right: 0%;
            top: 0;
            width: 20px;
            height: 20px;
            border: 2px solid #279760;
            border-left: none;
            border-bottom: none;
            z-index: 2;
        }
        
        .hero-slide {
            display: none;
            padding: 30px 20px;
        }
        
        .hero-slide.active {
            display: block;
            animation: fadeIn 0.5s;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .hero-slide-title {
            font-size: 24px;
            font-weight: 500;
            line-height: 120%;
            color: white;
            padding-bottom: 20px;
            font-family: 'Manrope', sans-serif;
        }
        
        .hero-slide-description {
            font-size: 16px;
            line-height: 150%;
            color: #F6F7F8;
            opacity: 0.7;
            font-family: 'Manrope', sans-serif;
        }
        
        .hero-slider-section .img-fluid {
            position: relative;
            z-index: 2;
        }
        
        .hero-slider-section .col-lg-6 {
            position: relative;
            z-index: 2;
        }
        
        .hero-slide-button {
            position: absolute;
            bottom: 40px;
            display: inline-flex;
            align-items: center;
            background: white;
            color: #279760;
            padding: clamp(12px, 1vw, 16px) clamp(24px, 2vw, 32px);
            border-radius: clamp(45px, 3.8vw, 60px);
            text-decoration: none;
            font-weight: 600;
            font-size: clamp(0.875rem, 0.9vw + 0.25rem, 1rem);
            transition: all 0.3s;
            line-height: 100%;
            font-family: 'Manrope', sans-serif;
        }
        
        .hero-slide-button:hover {
            background: #f0f0f0;
            color: #279760;
            transform: translateY(-2px);
        }
        
        .hero-slider-controls {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-top: 0;
            position: absolute;
            right: 5%;
            bottom: 40px;
            z-index: 10;
        }
        
        .hero-slider-pagination {
            font-size: 16px;
            color: white;
            font-family: 'Manrope', sans-serif;
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
        
        /* Consultation Block - убираем верхнюю линию */
        .consultation-block::before {
            display: none !important;
        }
        
        /* FAQ Accordion - плюс/минус вместо стрелки */
        .accordion-button::after {
            content: '+' !important;
            background-image: none !important;
            font-size: 32px !important;
            font-weight: 300 !important;
            width: auto !important;
            height: auto !important;
            transform: none !important;
            color: #191E1D !important;
        }
        
        .accordion-button:not(.collapsed)::after {
            content: '−' !important;
            transform: none !important;
            color: #D1D5DB !important;
        }
        
        .accordion-button:not(.collapsed) {
            color: #D1D5DB !important;
        }
        
        .accordion-button:focus {
            box-shadow: none !important;
            outline: none !important;
        }
        
        .accordion-button {
            box-shadow: none !important;
            font-family: Manrope;
            font-weight: 500;
            font-size: 16px;
            line-height: 100%;
        }

        .accordion-body {
            font-family: Manrope;
            font-weight: 500;
            font-size: 14px;
            line-height: 150%;
            color: #191E1D;
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
            font-size: clamp(2.5rem, 3vw + 1rem, 3.25rem);
            font-weight: 500;
            text-align: center;
            margin-bottom: clamp(40px, 3.8vw, 60px);
            color: #1E1E1E;
            font-family: 'Manrope', sans-serif;
            text-align: left;
            line-height: 100%;
        }
        
        .roadmap-timeline {
            display: flex;
            justify-content: space-between;
            position: relative;
            padding-bottom: 40px;
            margin-bottom: 0px;
        }
        
        .roadmap-timeline::before {
            content: '';
            position: absolute;
            bottom: 38px;
            left: 0;
            right: 0;
            height: 2px;
            background:
                linear-gradient(to right, #279760 0 25%, transparent 25% 100%),
                repeating-linear-gradient(
                    to right,
                    #E5E7EB 0 6px,
                    transparent 6px 12px
                );
        }
        
        .roadmap-milestone {
            flex: 1;
            position: relative;
            text-align: center;
        }
        
        .roadmap-dot {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #E5E7EB;
            border: 2px solid #E5E7EB;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            top: 10px;
            left: -2px;
        }
        
        .roadmap-milestone.completed .roadmap-dot {
            background: #279760;
            border-color: #279760;
        }
        
        .roadmap-milestone.completed .roadmap-dot::after {
            content: '✓';
            color: white;
            font-size: 12px;
            font-weight: bold;
        }
        
        .roadmap-year {
            font-size: 14px;
            color: #6B7280;
            margin-bottom: 4px;
            font-family: 'Manrope', sans-serif;
        }
        
        .roadmap-date {
            font-size: 28px;
            font-weight: 600;
            color: #1E1E1E;
            margin-bottom: 16px;
            font-family: 'Manrope', sans-serif;
            line-height: 120%;
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
            display: flex;
            align-items: center;
            background: #F9FAFB;
            padding: 32px 24px;
            transition: transform 0.3s;
            cursor: pointer;
            position: relative;
        }

        .roadmap-card:hover {
            background: #F1F7F6;
        }

        .roadmap-card:hover > .roadmap-card-info {
            filter: invert(36%) sepia(67%) saturate(430%) hue-rotate(95deg) brightness(90%) contrast(90%);
        } 

        .roadmap-milestone-content {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
        }

        .roadmap-card-info {
            position: absolute;
            top: 12px;
            right: 12px;
        }

        .tooltip-text ul {
            list-style-type: disc;
            margin-left: 20px;
            padding: 10px;
        }

        .tooltip-text ul li {
            font-family: Manrope;
            font-weight: 500;
            font-style: Medium;
            font-size: 16px;
            line-height: 150%;
            letter-spacing: 0%;
        }

        .tooltip-text {
            opacity: 0;
            transition: opacity 0.3s;
            z-index: 10;
            visibility: hidden;
            width: 340px; /* Ширина тултипа */
            background-color: #fff !important; /* Зеленый фон */
            box-shadow: 0px 20px 50px 0px #0000001A;
            position: absolute;
            color: #191E1D;
            padding: 8px;
            border-radius: 6px;
        }

        /* Сам тултип */
        .tooltip-text__1, .tooltip-text__2  {
            top: -75%;
            left: 90%;
        }

        .tooltip-text__3 {
            top: -125%;
            left: 90%;
        }

        .tooltip-text__4 {
            top: -110%;
            left: 5%;
        }

        .tooltip-text__4::after {
            right: 9px;
            left: 0;
            content: "";
            position: absolute;
            top: 100%; /* Стрелка внизу тултипа */
            left: unset!important;
            transform: translateX(-50%);
            border-width: 5px;
            border-style: solid;
            border-color: #fff transparent transparent transparent;
        } 

        /* Стрелка тултипа */
        .tooltip-text::after {
            content: "";
            position: absolute;
            top: 100%; /* Стрелка внизу тултипа */
            left: 15px;
            transform: translateX(-50%);
            border-width: 5px;
            border-style: solid;
            border-color: #fff transparent transparent transparent;
        }

        /* Показать тултип при hover */
        .roadmap-card:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }
        
        .roadmap-card:hover {
            transform: translateY(-5px);
        }
        
        .roadmap-card-icon {
            width: 80px;
            height: 80px;
            margin-right: 30px;
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
        
        /* Скрываем мобильный логотип на десктопе */
        .hero-mobile-logo {
            display: none !important;
        }
        
        /* Скрываем картинку внутри слайда на десктопе */
        .hero-slide-image {
            display: none;
        }

        .main__block__slider {
            height: 414px;
            box-sizing: border-box;
        }

        .main__block__slider__first {
            background: #279760;
            width: 100%;
            height: 100%;
            background-image: url('current/img/lines.svg');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .main__block__slider__second {
            background: #E5E7EB;
            width: 100%;
            height: 100%;
            position: relative;
        }

        .main__block__slider__second__img {
            max-height: 470px;
            max-width: 470px;
            width: 100%;
            position: absolute;
            top: -56px;
            left: 50%;
            transform: translateX(-50%);
        }

        .about-us__find {
            padding-top: 100px!important;
            padding-bottom: 60px!important;
        }

        .about-us__find__header h2 {
            max-width: none!important;
            font-family: Manrope;
            font-weight: 500!important;
            line-height: 100%!important;

        }

        .about-us__find__cards-container {
            margin-top: 60px!important;
            padding: 0px!important;
        }

        .about-us__find__btn {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .about-us__find__btn__link {
            background-color: #279760;
            padding: 24px;
            border-radius: 60px;
            color: #FFFFFF;
            font-family: Manrope;
            line-height: 100%;
            font-size: 16px;
        }

        .about-us__find__btn__link:hover {
            text-decoration: none;
            color: #FFFFFF;
        }

        .categories-section {
            position: relative;
        }

        .categories-nav-wrapper {
            position: absolute;
            right: 10px;
            top: 70px;
        }

        .trust-section-nav-wrapper {
            position: absolute;
            right: 15px;
            top: 20px;
        }

        .category-arrow-prev {
            overflow: visible!important;
        }
        
        .categories-nav-wrapper .hero-arrow svg path, .trust-section-nav-wrapper .hero-arrow svg path {
            stroke: #191E1D;
        }

        .stats-table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 160px;
            margin-bottom: 160px;
        }

        /* верхний ряд */
        .top-cell {
            padding: 0!important;
        }

        .top-inner {
            display: flex;
        }

        .top-inner > div {
            flex: 1; /* 50% / 50% */
            padding: 20px;
        }

        /* линия между верхними блоками */
        .top-inner > div + div {
            border-left: 1px solid #ccc;
        }

        .stats-table td {
            padding: 20px;
        }

        /* линии между ячейками */
        .stats-table td + td {
            border-left: 1px solid #ccc;
        }

        .stats-table tr + tr td {
            border-top: 1px solid #ccc;
        }

        .top-inner__title__left {
            color: #191E1D;
            font-family: Manrope;
            font-weight: 500;
            font-style: Medium;
            font-size: 52px;
            line-height: 100%;
            letter-spacing: -2%;
        }

        .top-inner__title__right, .top-inner__title__left {
            display: flex;
            align-items: center;
        }

        .top-inner__title__right, .top-inner__title__left {
            padding-bottom: 38px!important;
        }
        
        .top-inner__title__right__green {
            color: #279760;
            font-family: Manrope;
            font-weight: 500;
            font-style: Medium;
            font-size: 67px;
            line-height: 100%;
            letter-spacing: -2%;
        }

        .top-inner__title__right__descr {
            font-family: Manrope;
            font-weight: 500;
            font-style: Medium;
            font-size: 16px;
            line-height: 150%;
            letter-spacing: 0%;
            color: #999999;
            margin-left: 20px;
        }

        .bottom-inner__title {
            font-family: Manrope;
            font-weight: 500;
            font-style: Medium;
            font-size: 36px;
            line-height: 100%;
            letter-spacing: -2%;
            color: #191E1D;
            margin-bottom: 30px;
        }

        .bottom-inner__descr {
            font-family: Manrope;
            font-weight: 500;
            font-style: Medium;
            font-size: 16px;
            line-height: 150%;
            letter-spacing: 0%;
            color: #999999;
        }

        .about-us__stats__wrap {
            display: flex;
            margin: 0 auto;
        }

        .services-section {
            max-width: unset!important;
            padding: 0!important;
            margin-top: 80px!important;
        }

        .services-section__title {
            font-family: Manrope;
            font-weight: 500!important;
            font-size: 28px!important;
            line-height: 120%!important;
        }

        .services-section__link {
            font-family: Manrope;
            font-weight: 600!important;
            font-size: 16px!important;
            line-height: 100%!important;
        }

        .services-section__descr {
            font-family: Manrope;
            font-weight: 500!important;
            font-size: 14px!important;
            line-height: 150%!important;
        }

        .cta-list-item {
            font-family: Manrope;
            font-weight: 500;
            font-size: 14px!important;
            line-height: 150%;
        }

        .cta-left {
            background-image: url('current/img/lines.svg');
            background-repeat: no-repeat;
            background-size: contain;
            background-position-y: bottom;
            background-color: #279760; 
            padding: 30px; 
        }

        .cta-title, .cta-btn, .cta-list {
            margin-left: 30px;
        }

        .cta-btn {
            position: absolute;
            bottom: 40px;
            padding: 24px;
            font-family: Manrope;
            font-weight: 600;
            font-size: 16px;
            line-height: 100%;
        }

        .client-case-detail {
            display: flex;
            justify-content: space-between!important;
        }
        
        .client-case-detail__checkmark {
            width: 12px!important;
        }

        .consultation-hero-subtitle, .consultation-hero-title {
            top: 0!important;
            height: auto!important;
            left: 0!important;
            position: relative!important;
        }

        .consultation-block {
            width: unset!important;
            margin-top: 160px!important;
        }

        .consultation-form-container {
            position: relative!important;
            top: 0!important;
            left: 0!important;
        }

        .consultation-hero-title {
            margin-bottom: 32px;
        }

        .consultation-block__first {
            background-image: url('images/Vector_6908.png');
            background-repeat: no-repeat;
            background-size: cover;
            background-position-y: bottom;
            background-position-x: -2%;
        }

        .privacy-text {
            position: unset!important;
            margin-left: 20px!important;
            max-width: 400px!important;
            width: 100%!important;
        }

        .trust-logo-item {
            border: 1px solid #E8E8E8;
            max-width: 204px;
            width: 100%;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .accordion-body {
            color: #6B7280 !important;
            opacity: 1 !important;
            visibility: visible;
        }

        .about-us__find__card__title {
            font-family: Manrope;
            font-weight: 500!important;
            font-size: 20px!important;
            line-height: 120%!important;
        }

        .about-us__find__card__description {
            font-family: Manrope;
            font-weight: 500!important;
            font-size: 16px!important;
            line-height: 150%!important;
        }

        .category-title {
            font-family: Manrope;
            font-weight: 500!important;
            font-size: 28px!important;
            line-height: 120%!important;
        }

        .category-tag {
            font-family: Manrope;
            font-weight: 500!important;
            font-size: 14px!important;
            line-height: 100%!important;
        }

        .categories-footer {
            max-width: unset!important;
            border-top: 1px solid #E8E8E8;
            padding-top: 45px;
        }

        .categories-footer-text {
            font-family: Manrope;
            font-weight: 500!important;
            font-size: 28px!important;
            line-height: 120%!important;
        }

        .categories-footer-btn {
            font-family: Manrope;
            font-weight: 600!important;
            font-size: 16px!important;
            line-height: 100%!important;
            text-align: right!important;
        }

        .form-input, .form-select, .form-textarea {
            width: 100%!important;
        }

        .consultation-form-container {
            max-width: 762px!important;
            width: 100%!important;
        }

        /* Специфичные стили для 1920x1080 - более точный диапазон */
        @media (min-width: 1920px) and (max-width: 1921px) {
            .hero-slide .hero-slide-title {
                font-size: 2.75rem !important;
            }
            
            .hero-slide .hero-slide-description {
                font-size: 1.125rem !important;
            }
            
            .hero-slider-controls {
                right: 8%;
            }
            
            .hero-slider-section .col-lg-6:last-child img {
                margin-top: 20px;
            }
        }
        
        /* Исправление для больших экранов 2560px */
        @media (min-width: 2560px) {
            .hero-slider-section::before {
                width: 950px;
                height: 620px;
            }
            
            .hero-slider-section::after {
                width: 950px;
                height: 620px;
            }
            
            .hero-top-title {
                font-size: 52px;
            }
            
            .hero-slide-title {
                font-size: 40px;
            }
            
            .hero-slide-description {
                font-size: 16px;
            }
            
            .roadmap-title {
                font-size: 52px;
            }
        }

        @media (max-width: 1600px) {
            .client-case-detail__left,
            .client-case-detail__right {
                max-width: 50% !important;
                flex: none !important;
            }
        }

        @media (max-width: 1300px) {
            .hero-slider-section {
                margin: 0 20px!important;
            }
        }

        @media (max-width: 1024px) {
            .client-case-detail__left,
            .client-case-detail__right {
                max-width: 100% !important;
                flex: none !important;
            }
        }
        
        @media (max-width: 768px) {
            /* Глобально запрещаем горизонтальный скролл */
            html, body {
                overflow-x: hidden !important;
                max-width: 100vw !important;
            }
            
            .container, .container-fluid {
                max-width: 100% !important;
                padding-left: 16px !important;
                padding-right: 16px !important;
                overflow-x: hidden !important;
            }
            
            .row {
                margin-left: 0 !important;
                margin-right: 0 !important;
            }
            
            [class*="col-"] {
                padding-left: 0 !important;
                padding-right: 0 !important;
            }
            
            /* Секции - предотвращение overflow */
            section {
                overflow-x: hidden !important;
                max-width: 100vw !important;
            }
            
            /* Для inline стилей с position absolute - ограничение */
            [style*="position: absolute"] {
                max-width: 100% !important;
            }
            /* ==========================================
               HERO SECTION - согласно Figma
            ========================================== */
            .hero-slider-section {
                min-height: auto;
                padding: 0;
                background: white;
                margin: 0!important;
            }
            
            .hero-slider-section::before,
            .hero-slider-section::after {
                display: none;
            }

            #app {
                padding-top: 20px!important;
            }

            /* Заголовок над зеленым блоком */
            .hero-top-title {
                position: relative !important;
                top: auto !important;
                left: auto !important;
                font-size: 32px !important;
                padding: 0 16px !important;
                margin-bottom: 8px !important;
                white-space: normal !important;
                line-height: 1.3 !important;
                color: #191E1D !important;
                font-weight: 500 !important;
            }
            
            .hero-top-title br {
                display: none;
            }
            
            .hero-slide {
                padding-top: 0;
                margin-left: 0;
                padding-bottom: 10px;
            }
            
            .hero-slide-title {
                font-size: 14px;
                line-height: 1.4;
                color: white;
                font-weight: 500;
                max-width: 70%;
                margin-top: 15px;
                padding-bottom: 10px;
            }
            
            .hero-slide-description {
                font-size: 14px;
                line-height: 1.5;
                margin-bottom: 14px;
                color: rgba(255,255,255,0.85);
                max-width: 65%;
            }
            
            .hero-slide-button {
                padding: 10px 18px;
                font-size: 11px;
                border-radius: 30px;
                background: white;
                color: #279760;
                font-weight: 600;
                display: inline-block;
                bottom: 20px;
            }
            
            /* Скрываем отдельную колонку с картинкой */
            .hero-image-col {
                display: none !important;
            }
            
            .hero-mobile-logo {
                display: flex !important;
                padding: 12px 16px !important;
            }
            
            /* Контролы слайдера - по Figma */
            .hero-slider-controls {
                position: absolute;
                right: auto;
                bottom: 50px;
                justify-content: flex-start;
                padding: 0 20px 16px;
                gap: 10px;
                margin-top: 0;
            }
            
            .hero-slider-pagination {
                font-size: 12px;
                color: #fff !important;
            }
            
            .hero-arrow {
                width: 32px;
                height: 32px;
                border-color: #E5E7EB;
                background: white;
            }
            
            .hero-arrow svg path {
                stroke: #6B7280;
            }
            
            /* Картинка внутри слайда - справа внизу по Figma */
            .hero-slide-image {
                display: block !important;
                position: absolute;
                right: 0;
                bottom: 0;
                width: 180px;
                height: auto;
                object-fit: contain;
            }
            
            /* ==========================================
               ПРЕИМУЩЕСТВА - согласно Figma
            ========================================== */
            .about-us__find {
                margin: 0!important;
                padding-bottom: 20px!important;
            }
            
            .about-us__find__header {
                padding: 0 16px;
                margin-bottom: 20px !important;
            }
            
            .about-us__find__cards-container {
                display: flex!important;
                flex-direction: column!important;
                padding: 0 16px !important;
                margin-top: 20px!important;
                gap: 0px!important;
            }
            
            .about-us__find__card {
                padding: 30px 0 !important;
                border-top: 1px solid #E5E7EB !important;
                border-bottom: none !important;
                display: flex !important;
                flex-direction: column !important;
                align-items: flex-start !important;
                margin: 0 auto!important;
                max-width: 100%!important;
            }
            
            .about-us__find__card:first-child {
                border-top: none !important;
            }
            
            .about-us__find__card::before {
                display: none !important;
            }
            
            .about-us__find__card__image {
                width: 40px !important;
                height: 40px !important;
                margin-bottom: 8px !important;
            }
            
            .about-us__find__card__number {
                font-size: 11px !important;
                margin-bottom: 6px !important;
                margin-left: 0 !important;
                color: #999 !important;
            }
            
            .about-us__find__card__title {
                font-size: 14px !important;
                margin-bottom: 6px !important;
                font-weight: 500 !important;
            }
            
            .about-us__find__card__description {
                font-size: 12px !important;
                line-height: 1.4 !important;
                color: #6B7280 !important;
            }
            
            /* Кнопка "Узнать как это работает" */
            .about-us__find .cta-btn-container {
                padding: 0 16px;
                margin-top: 20px;
            }
            
            .about-us__find .cta-btn-container a,
            .about-us__find .cta-btn-container button {
                width: 100% !important;
                display: flex !important;
                justify-content: center !important;
            }
            
            /* ==========================================
               СТАТИСТИКА - согласно Figma
            ========================================== */
            .stats-section {
                padding: 32px 0 !important;
            }
            
            .stats-section .container {
                padding: 0 16px !important;
            }
            
            /* Скрываем десктоп версию */
            .about-us__stats__grid.d-none.d-lg-grid {
                display: none !important;
            }
            
            /* Показываем мобильную версию */
            .stats-mobile.d-lg-none {
                display: block !important;
            }
            
            .stats-mobile-title {
                font-size: 32px !important;
                margin-bottom: 16px !important;
                font-weight: 500 !important;
            }
            
            .stats-mobile-item {
                padding: 14px 0 !important;
            }
            
            .stats-mobile-item > div:first-child {
                font-size: 28px !important;
                margin-bottom: 4px !important;
            }
            
            .stats-mobile-item p {
                font-size: 11px !important;
                line-height: 1.4 !important;
            }
            
            /* Переопределение stats grid inline стилей */
            .about-us__stats__grid[style] {
                grid-template-columns: 1fr 1fr !important;
                display: grid !important;
                padding-left: 0 !important;
                max-width: 100% !important;
            }
            
            .about-us__stats__grid > div[style*="width"] {
                width: 100% !important;
                height: auto !important;
            }
            
            /* CTA Section (Личный кабинет) - Mobile */
            .cta-section-mobile {
                padding: 0 !important;
            }
            
            .cta-section-mobile .row {
                flex-direction: column;
            }
            
            .cta-section-mobile .col-lg-6 {
                width: 100% !important;
                padding: 32px 16px !important;
            }
            
            .cta-section-mobile .col-lg-6:first-child {
                background: #279760;
            }
            
            .cta-section-mobile .col-lg-6:last-child {
                background: #F3F4F6;
            }
            
            .cta-section-mobile h2 {
                font-size: 20px !important;
                margin-bottom: 16px !important;
                margin-top: 0 !important;
                line-height: 1.3 !important;
            }
            
            .cta-section-mobile h2 br {
                display: none;
            }
            
            .cta-section-mobile .cta-list-item {
                font-size: 13px !important;
                margin-bottom: 8px !important;
            }
            
            .cta-section-mobile .cta-btn {
                padding: 14px 24px !important;
                font-size: 13px !important;
            }
            
            .cta-section-mobile img {
                max-width: 100%;
                height: auto;
            }
            
            /* ==========================================
               КЕЙСЫ КЛИЕНТОВ - согласно Figma
            ========================================== */
            .client-cases {
                padding: 32px 0 !important;
                margin-top: 100px!important;
            }
            
            .client-cases__header {
                padding: 0 16px;
                margin-bottom: 20px !important;
            }
            
            .client-cases__title {
                font-size: 32px !important;
                font-weight: 500 !important;
            }
            
            .client-case-detail {
                flex-direction: column !important;
                gap: 20px !important;
                padding: 0 16px !important;
            }
            
            .client-case-detail__left,
            .client-case-detail__right {
                max-width: 100% !important;
                flex: none !important;
            }
            
            .client-case-detail__title {
                font-size: 16px !important;
                font-weight: 500 !important;
            }
            
            .client-case-detail__logo {
                width: 50px !important;
                height: 50px !important;
            }
            
            .client-case-detail__client-name {
                font-size: 14px !important;
            }
            
            .client-case-detail__video-btn {
                width: 100% !important;
                justify-content: center !important;
                font-size: 12px !important;
                padding: 12px 16px !important;
            }
            
            .client-case-detail__section {
                padding: 14px !important;
            }
            
            .client-case-detail__section-title {
                font-size: 14px !important;
            }
            
            .client-case-detail__list-item {
                font-size: 14px !important;
            }
            
            /* ==========================================
               НАМ ДОВЕРЯЮТ - согласно Figma
            ========================================== */
            .trust-section-mobile {
                padding: 32px 16px !important;
            }
            
            .trust-section-mobile h2 {
                font-size: 20px !important;
                text-align: left !important;
                margin-bottom: 20px !important;
                font-weight: 500 !important;
            }
            
            .trust-section-mobile .row {
                gap: 12px !important;
            }
            
            .trust-section-mobile .col-lg-2 {
                flex: 0 0 calc(33.333% - 8px) !important;
                max-width: calc(33.333% - 8px) !important;
            }
            
            .trust-section-mobile img {
                max-width: 80px !important;
            }
            
            /* ==========================================
               ФОРМА КОНТАКТОВ - согласно Figma
            ========================================== */
            .consultation-block {
                width: 100% !important;
                height: auto !important;
                padding: 32px 16px !important;
            }
            
            .consultation-hero-title {
                position: relative !important;
                left: auto !important;
                top: auto !important;
                width: 100% !important;
                height: auto !important;
                font-size: 20px !important;
                margin-bottom: 10px !important;
                font-weight: 500 !important;
            }
            
            .consultation-hero-subtitle {
                position: relative !important;
                left: auto !important;
                top: auto !important;
                width: 100% !important;
                height: auto !important;
                font-size: 12px !important;
                margin-bottom: 20px !important;
            }
            
            .consultation-form-container {
                position: relative !important;
                width: 100% !important;
                height: auto !important;
                right: auto !important;
                top: auto !important;
            }
            
            .consultation-form {
                padding: 16px !important;
            }
            
            .form-input,
            .form-select {
                width: 100% !important;
                height: 48px !important;
                padding: 12px !important;
                font-size: 13px !important;
            }
            
            .form-textarea {
                width: 100% !important;
                height: 80px !important;
            }
            
            .submit-btn {
                width: 100% !important;
                height: 46px !important;
                font-size: 13px !important;
            }
            
            .privacy-text {
                position: relative !important;
                left: auto !important;
                top: auto !important;
                width: 100% !important;
                height: auto !important;
                font-size: 10px !important;
                margin-top: 10px !important;
                text-align: center !important;
            }
            
            .consultation-bg-vector {
                display: none !important;
            }
            
            /* ==========================================
               FAQ - согласно Figma
            ========================================== */
            .faq-section-mobile {
                padding: 32px 0 !important;
            }
            
            .faq-section-mobile .row {
                flex-direction: column;
            }
            
            .faq-section-mobile .col-lg-6 {
                width: 100%;
                padding: 0 16px;
            }
            
            .faq-section-mobile h2 {
                font-size: 20px !important;
                margin-bottom: 20px !important;
                font-weight: 500 !important;
            }
            
            .accordion-item {
                border-radius: 0 !important;
            }
            
            .accordion-button {
                font-size: 13px !important;
                padding: 14px 0 !important;
            }
            
            .accordion-body {
                font-size: 12px !important;
                padding: 0 0 14px !important;
            }
            
            /* ==========================================
               ROADMAP - согласно Figma
            ========================================== */
            .roadmap-section {
                padding: 32px 16px !important;
            }
            
            .roadmap-title {
                font-size: 20px !important;
                margin-bottom: 20px !important;
                font-weight: 500 !important;
            }
            
            .roadmap-timeline {
                flex-direction: column !important;
                gap: 16px !important;
                padding-bottom: 0 !important;
                margin-bottom: 24px !important;
            }
            
            .roadmap-timeline::before {
                display: none !important;
            }
            
            .roadmap-milestone {
                display: flex !important;
                align-items: center !important;
                gap: 12px !important;
                text-align: left !important;
            }
            
            .roadmap-dot {
                width: 28px !important;
                height: 28px !important;
                margin: 0 !important;
                flex-shrink: 0;
            }
            
            .roadmap-year,
            .roadmap-date {
                display: inline;
                font-size: 14px !important;
                margin: 0 !important;
            }
            
            .roadmap-description {
                font-size: 12px !important;
                max-width: none !important;
                margin: 4px 0 0 0 !important;
            }
            
            .roadmap-cards {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 12px !important;
                margin-bottom: 32px !important;
            }
            
            .roadmap-card {
                padding: 20px 16px !important;
            }
            
            .roadmap-card-icon {
                width: 48px !important;
                height: 48px !important;
                margin-bottom: 12px !important;
            }
            
            .roadmap-card-title {
                font-size: 13px !important;
            }
            
            .roadmap-details {
                grid-template-columns: 1fr !important;
                gap: 24px !important;
            }
            
            .roadmap-detail-title {
                font-size: 16px !important;
            }
            
            .roadmap-detail-list li {
                font-size: 13px !important;
            }
            
            /* Categories Section - Mobile */
            .categories-section {
                padding: 40px 0 !important;
            }
            
            .categories-nav-wrapper {
                text-align: left !important;
                padding: 0 16px !important;
                margin-bottom: 24px !important;
            }
            
            .categories-slider-wrapper {
                padding: 0 !important;
                margin: 0 16px !important;
            }
            
            .categories-slider {
                gap: 12px !important;
            }
            
            /* ==========================================
               КАТЕГОРИИ (СФЕРЫ) - согласно Figma
            ========================================== */
            .categories-section {
                padding: 32px 0 !important;
            }
            
            .categories-section-title {
                font-size: 32px !important;
                text-align: center !important;
                padding: 0 16px !important;
                margin-top: 100%px!important;
                margin-bottom: 40px !important;
                line-height: 1.2 !important;
                font-weight: 500 !important;
            }
            
            .categories-section-title span {
                color: #279760 !important;
            }
            
            .categories-nav-wrapper {
                text-align: left !important;
                padding: 0 16px !important;
                margin-bottom: 16px !important;
                display: none;
            }
            
            .categories-slider-wrapper {
                padding: 0 !important;
                margin: 0 !important;
                overflow: hidden !important;
                width: 100% !important;
            }
            
            .categories-slider {
                gap: 12px !important;
                padding: 0 16px !important;
            }
            
            .category-slide {
                min-width: calc(100vw - 48px) !important;
                max-width: calc(100vw - 48px) !important;
                min-height: 220px !important;
                padding: 16px !important;
                overflow: hidden !important;
                position: relative !important;
                background: #F9FAFB !important;
            }
            
            .category-title {
                font-size: 14px !important;
                margin-bottom: 0 !important;
                font-weight: 600 !important;
            }
            
            .category-corner {
                width: 16px !important;
                height: 16px !important;
            }
            
            .category-tags {
                bottom: 14px !important;
                left: 14px !important;
                position: absolute !important;
                z-index: 2 !important;
            }
            
            .category-tag {
                padding: 5px 10px !important;
                font-size: 9px !important;
                border-radius: 12px !important;
                background: white !important;
                border: 1px solid #E5E7EB !important;
                display: inline-block !important;
                margin-bottom: 6px !important;
            }
            
            .category-tag-more {
                width: 24px !important;
                height: 24px !important;
                font-size: 9px !important;
            }
            
            .category-img,
            .category-slide img,
            .category-slide img[style] {
                width: 130px !important;
                height: 130px !important;
                right: 0px !important;
                bottom: 0px !important;
                position: absolute !important;
                object-fit: contain !important;
            }
            
            .categories-footer {
                flex-direction: column !important;
                align-items: flex-start !important;
                padding: 0 16px !important;
                margin-top: 20px !important;
                gap: 12px !important;
            }
            
            .categories-footer-text {
                font-size: 20px !important;
                line-height: 1.3 !important;
                font-weight: 500 !important;
                text-align: center!important;
            }
            
            .categories-footer-btn {
                width: 100% !important;
                justify-content: center !important;
                padding: 12px 20px !important;
                font-size: 13px !important;
            }
            
            /* ==========================================
               УСЛУГИ - согласно Figma
            ========================================== */
            .services-section {
                padding: 32px 0 !important;
                margin-top: 0px!important;
            }
            
            .services-title {
                font-size: 32px !important;
                text-align: center !important;
                padding: 0 16px !important;
                margin-bottom: 20px !important;
                line-height: 1.2 !important;
                font-weight: 500 !important;
            }
            
            .about-us__stats__wrap {
                display: none;
            }

            .services-title br {
                display: none !important;
            }
            
            .services-section .row.g-4 {
                gap: 12px !important;
                padding: 0 16px !important;
                margin: 0 !important;
            }
            
            .services-section .col-lg-6 {
                padding: 0 !important;
                width: 100% !important;
                flex: 0 0 100% !important;
                max-width: 100% !important;
            }
            
            .services-section .col-lg-6 > div {
                height: auto !important;
                min-height: 240px !important;
                padding: 16px !important;
                overflow: hidden !important;
                position: relative !important;
            }
            
            .services-section .col-lg-6 > div h3 {
                font-size: 14px !important;
                margin-bottom: 10px !important;
                font-weight: 600 !important;
                max-width: 60% !important;
            }
            
            .services-section .col-lg-6 > div > div[style*="margin-bottom: 24px"] {
                margin-bottom: 10px !important;
            }
            
            .services-section .col-lg-6 > div > div[style*="display: flex; align-items: start"] {
                margin-bottom: 4px !important;
            }
            
            .services-section .col-lg-6 > div > div[style*="display: flex; align-items: start"] div {
                font-size: 10px !important;
            }
            
            .services-section .col-lg-6 > div > div[style*="display: flex; align-items: start"] img {
                width: 14px !important;
                height: 14px !important;
                margin-right: 6px !important;
                position: static !important;
            }
            
            .services-section .col-lg-6 > div > img:last-of-type,
            .services-section .col-lg-6 > div img[style*="position: absolute"],
            .services-section img[style*="width: 380px"] {
                width: 140px !important;
                height: 140px !important;
                right: 0px !important;
                bottom: 0px !important;
                position: absolute !important;
                object-fit: contain !important;
            }
            
            .services-section .col-lg-6 > div a[style*="position: absolute; bottom"] {
                font-size: 11px !important;
                padding: 10px 16px !important;
                bottom: 14px !important;
                left: 14px !important;
            }
            
            /* Stats Section - Mobile */
            .stats-section {
                padding: 40px 0 !important;
            }
            
            .d-lg-none.stats-mobile {
                display: block !important;
            }
            
            .d-none.d-lg-grid {
                display: none !important;
            }
            
            /* ==========================================
               CTA СЕКЦИЯ - согласно Figma
            ========================================== */
            .cta-section {
                padding: 0 !important;
            }
            
            .cta-section .container-fluid {
                padding: 0 !important;
            }
            
            .cta-section .row {
                flex-direction: column !important;
                margin: 0 !important;
            }
            
            .cta-left {
                padding: 24px 16px !important;
                width: 100% !important;
                flex: none !important;
                max-width: 100% !important;
            }
            
            .cta-right {
                padding: 20px 16px !important;
                width: 100% !important;
                flex: none !important;
                max-width: 100% !important;
            }
            
            .cta-title {
                font-size: 16px !important;
                margin-bottom: 12px !important;
                line-height: 1.3 !important;
                font-weight: 500 !important;
            }
            
            .cta-title br {
                display: none !important;
            }
            
            .cta-list {
                margin-bottom: 16px !important;
            }
            
            .cta-list-item {
                margin-bottom: 6px !important;
            }
            
            .cta-list-item span {
                font-size: 11px !important;
            }
            
            .cta-list-item img {
                width: 14px !important;
                margin-right: 8px !important;
            }
            
            .cta-btn {
                width: 100% !important;
                justify-content: center !important;
                padding: 12px 20px !important;
                font-size: 12px !important;
            }
            
            .cta-image {
                max-width: 100% !important;
                height: auto !important;
            }
            
            /* Trust Section - Mobile */
            .trust-section {
                padding: 40px 0 !important;
            }
            
            .trust-section .container {
                padding: 0 16px !important;
            }
            
            .trust-title {
                font-size: 32px !important;
                margin-bottom: 24px !important;
            }
            
            .trust-logos {
                gap: 12px !important;
            }
            
            .trust-logo-item {
                flex: 0 0 calc(33.333% - 8px) !important;
                max-width: calc(33.333% - 8px) !important;
                padding: 8px !important;
            }
            
            .trust-logo {
                max-width: 60px !important;
                height: auto !important;
            }
            
            /* Contact Form Section - Mobile */
            .consultation-block {
                width: 100% !important;
                height: auto !important;
                padding: 40px 16px !important;
                margin-top: 0px!important;
            }

            .consultation-block__first {
                background-image: none;
            }
            
            .consultation-hero-title {
                position: relative !important;
                width: 100% !important;
                height: auto !important;
                font-size: 32px !important;
                margin-bottom: 32px !important;
            }
            
            .consultation-hero-subtitle {
                position: relative !important;
                width: 100% !important;
                height: auto !important;
                font-size: 14px !important;
                margin-bottom: 0px !important;
            }
            
            .consultation-form-container {
                position: relative !important;
                width: 100% !important;
                height: auto !important;
                right: auto !important;
                top: auto !important;
            }
            
            .consultation-form {
                padding: 20px !important;
            }
            
            .consultation-form .row.g-3 {
                gap: 12px !important;
            }
            
            .consultation-form .col-12.col-md-6 {
                flex: 0 0 100% !important;
                max-width: 100% !important;
            }
            
            .form-input,
            .form-select {
                width: 100% !important;
                height: 52px !important;
                padding: 14px !important;
                font-size: 14px !important;
            }
            
            .form-textarea {
                width: 100% !important;
                height: 100px !important;
            }
            
            .submit-btn {
                width: 100% !important;
                height: 52px !important;
                font-size: 14px !important;
            }
            
            .privacy-text {
                position: relative !important;
                left: auto !important;
                top: auto !important;
                width: 100% !important;
                height: auto !important;
                font-size: 11px !important;
                margin-top: 12px !important;
                text-align: center !important;
                margin-left: 0px!important;
            }

            .cta-title, .cta-btn, .cta-list {
                margin-left: 0px;
            }

            .cta-btn {
                position: relative;
                margin-top: 35px;
                bottom: unset;
            }
            
            .roadmap-card-info {
                display: none;
            }

            .consultation-bg-vector {
                display: none !important;
            }
            
            /* FAQ Section - Mobile */
            .faq-section {
                padding: 40px 0 !important;
            }
            
            .faq-section .container {
                padding: 0 16px !important;
            }
            
            .faq-section .row {
                flex-direction: column !important;
            }
            
            .faq-section .col-lg-6 {
                width: 100% !important;
                max-width: 100% !important;
                flex: none !important;
            }
            
            .faq-section .col-lg-6 h2 {
                font-size: 20px !important;
                margin-bottom: 20px !important;
                font-weight: 500 !important;
                width: auto !important;
            }
            
            /* RoadMap Section - Mobile */
            .roadmap-section {
                padding: 40px 16px !important;
            }
            
            .roadmap-title {
                font-size: 24px !important;
                margin-bottom: 24px !important;
            }
            
            .roadmap-timeline {
                flex-direction: column !important;
                gap: 16px !important;
                padding-bottom: 0 !important;
                margin-bottom: 24px !important;
            }
            
            .roadmap-timeline::before {
                display: none !important;
            }
            
            .roadmap-milestone {
                display: flex !important;
                align-items: flex-start !important;
                gap: 12px !important;
                text-align: left !important;
            }
            
            .roadmap-dot {
                width: 28px !important;
                height: 28px !important;
                min-width: 28px !important;
                margin: 0 !important;
                flex-shrink: 0;
            }
            
            .roadmap-milestone.completed .roadmap-dot::after {
                font-size: 14px !important;
            }
            
            .roadmap-milestone-content {
                flex: 1;
            }
            
            .roadmap-year {
                font-size: 12px !important;
                margin-bottom: 0 !important;
                display: inline !important;
            }
            
            .roadmap-date {
                font-size: 14px !important;
                margin-bottom: 4px !important;
                display: inline !important;
            }
            
            .roadmap-description {
                font-size: 11px !important;
                max-width: none !important;
                margin: 4px 0 0 0 !important;
            }
            
            .roadmap-cards {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 12px !important;
                margin-bottom: 24px !important;
            }
            
            .roadmap-card {
                padding: 16px 12px !important;
                border-radius: 12px !important;
            }
            
            .roadmap-card-icon {
                width: 40px !important;
                height: 40px !important;
                margin-bottom: 8px !important;
            }
            
            .roadmap-card-title {
                font-size: 12px !important;
            }
            
            .roadmap-details {
                grid-template-columns: 1fr !important;
                gap: 20px !important;
            }
            
            .roadmap-detail-title {
                font-size: 14px !important;
                margin-bottom: 12px !important;
            }
            
            .roadmap-detail-list li {
                font-size: 12px !important;
                margin-bottom: 8px !important;
            }
            
            .hero-slide-title {
                font-size: 24px;
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

        @media (max-width: 568px) {
            .hero-slide-title {
                font-size: 18px;
                max-width: 100%;
            }

            .hero-slide-description {
                max-width: 100%;
            }

            .hero-slide-image {
                width: 120px;
            }
        }
    </style>
        @endpush

        @section('content')
    <!-- Hero Slider Section -->
    <section class="hero-slider-section">
        <div class="container">
            <div class="row">
                <h2 class="hero-top-title">Мгновенный старт для вашего<br>бизнеса в Казахстане</h2>
            </div>
        </div>
        
        <!-- Зеленая рамка в верхнем правом углу серого блока -->
        
        <div class="container">
            <div class="row align-items-center main__block__slider">
                <div class="col-lg-6 main__block__slider__first">
                    <!-- Slide 1 -->
                    <div class="hero-slide active" data-slide="1">
                        <div class="hero-slide-content">
                            <h1 class="hero-slide-title">UPPERLICENSE: Идеальное решение для регистрации вашего бизнеса в РК</h1>
                            <p class="hero-slide-description">Полная автоматизация и удобство управления — откройте новые возможности для вашего бизнеса в Казахстане с нашей инновационной онлайн-платформой!</p>
                            <a href="#" class="hero-slide-button">Начать регистрацию</a>
                            <img src="{{asset('current/img/image-slider-1-2.png')}}" alt="" class="hero-slide-image" />
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="hero-slide" data-slide="2">
                        <div class="hero-slide-content">
                            <h1 class="hero-slide-title">UPPERLICENSE: Ваш ключ к беспроблемному лицензированию</h1>
                            <p class="hero-slide-description">Надежное сопровождение вашего процесса лицензирования «под ключ», усиленное базой данных и индивидуально адаптированным личным кабинетом для вашего максимального комфорта и удобства</p>
                                                     <a href="#" class="hero-slide-button">Начать регистрацию</a>

                            <img src="{{asset('current/img/image-slider-1-2.png')}}" alt="" class="hero-slide-image" />
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="hero-slide" data-slide="3">

                        <div class="hero-slide-content">
                            <h1 class="hero-slide-title">Получите вашу рабочую и бизнес-визу в Казахстане легко и надежно с UPPERLICENSE. Быстро, эффективно, без хлопот</h1>
                            <p class="hero-slide-description">Оперативное оформление виз С3 и С5 — максимальная скорость, минимальные сроки</p>
                                                     <a href="#" class="hero-slide-button">Начать регистрацию</a>

                            <img src="{{asset('current/img/image-slider-1-2.png')}}" alt="" class="hero-slide-image" />
                        </div>
                    </div>

                    <!-- Slide 4 -->
                    <div class="hero-slide" data-slide="4">

                        <div class="hero-slide-content">
                            <h1 class="hero-slide-title">Гарантируйте стабильный рост вашего бизнеса в эпоху перемен с экспертной поддержкой UPPERLICENSE</h1>
                            <p class="hero-slide-description">Высококлассное юридическое и бухгалтерское сопровождение от UPPERLICENSE — ваш надежный фундамент для стойкости и прогресса вашей компании</p>
                                                     <a href="#" class="hero-slide-button">Начать регистрацию</a>

                            <img src="{{asset('current/img/image-slider-1-2.png')}}" alt="" class="hero-slide-image" />
                        </div>
                    </div>

                    <!-- Slider Controls -->
                    <div class="hero-slider-controls">
                        <div class="hero-slider-pagination">
                            <span class="current-slide">01</span> / <span class="total-slides">04</span>
                        </div>
                        <div class="hero-slider-arrows">
                            <div class="hero-arrow prev-arrow" id="hero-prev" style="cursor: pointer;">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.5 15L7.5 10L12.5 5" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="hero-arrow next-arrow" id="hero-next" style="cursor: pointer;">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.5 5L12.5 10L7.5 15" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 hero-image-col main__block__slider__second">
                    <div class="hero-corner-frame"></div>
                    <img src="{{asset('current/img/image-slider-1-2.png')}}" alt="UPPERLICENSE" class="main__block__slider__second__img">
                </div>
            </div>
        </div>
    </section>

    <!-- Industries Section -->
    <section class="about-us">
        <div class="about-us__find">
            <div class="container">
                <div class="about-us__find__header">
                    <h2>Преимущества работы с UPPERLICENSE</h2>
                </div>
                <div class="about-us__find__cards-container">
                    <div class="about-us__find__card">
                        <div class="about-us__find__card__image">
                            <img src="{{asset('images/about_us-1.png')}}" alt="Контроль и инновации">
                        </div>
                        <p class="about-us__find__card__number">01</p>
                        <div class="about-us__find__card__content">
                            <h3 class="about-us__find__card__title">Контроль и инновации</h3>
                            <p class="about-us__find__card__description">Уникальная онлайн-панель управления для вашего бизнеса</p>
                        </div>
                    </div>
                    <div class="about-us__find__card">
                        <div class="about-us__find__card__image">
                            <img src="{{asset('images/about_us-2.png')}}" alt="Экспертность">
                        </div>
                        <p class="about-us__find__card__number">02</p>
                        <div class="about-us__find__card__content">
                            <h3 class="about-us__find__card__title">Экспертность </h3>
                            <p class="about-us__find__card__description">Полный спектр квалифицированной поддержки для вашего бизнеса</p>
                        </div>
                    </div>
                    <div class="about-us__find__card">
                        <div class="about-us__find__card__image">
                            <img src="{{asset('images/about_us-3.png')}}" alt="Удобство и доступность">
                        </div>
                        <p class="about-us__find__card__number">03</p>
                        <div class="about-us__find__card__content">
                            <h3 class="about-us__find__card__title">Удобство и доступность</h3>
                            <p class="about-us__find__card__description">Персональный онлайн-кабинет и актуальная база данных</p>
                        </div>
                    </div>
                    <div class="about-us__find__card">
                        <div class="about-us__find__card__image">
                            <img src="{{asset('images/about_us-4.png')}}" alt="Устойчивость и развитие">
                        </div>
                        <p class="about-us__find__card__number">04</p>
                        <div class="about-us__find__card__content">
                            <h3 class="about-us__find__card__title">Устойчивость и развитие</h3>
                            <p class="about-us__find__card__description">Фундамент для долгосрочного партнерства, поддержка вашего бизнеса на каждом этапе</p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="about-us__find__btn">
                <a href="#" class="about-us__find__btn__link">Узнфцвать всё о платформе</a>
            </div>
    </section>

    <!-- Categories Slider Section -->
    <section class="categories-section" style="padding: 80px 0; background: white; overflow: hidden;">
        <div class="container" style="position: relative;">
                <h2 class="categories-section-title" style="font-size: 52px; font-weight: 500; text-align: center; margin-bottom: 60px; font-family: 'Manrope', sans-serif; color: #191E1D; line-height: 100%;">
                Уже выбрали вашу <span style="color: #279760;">сферу</span><br>деятельности?
            </h2>
            <div class="categories-nav-wrapper" style="text-align: center; margin-bottom: 60px;">
                <div style="display: inline-flex; gap: 10px;">
                    <div class="category-arrow-prev hero-arrow" id="cat-prev" style="cursor: pointer; border-color: #E5E7EB;">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.5 15L7.5 10L12.5 5" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="category-arrow-next hero-arrow" id="cat-next" style="cursor: pointer; border-color: #E5E7EB;">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.5 5L12.5 10L7.5 15" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="categories-slider-wrapper" style="position: relative; overflow: hidden;">
                <div class="categories-slider" style="display: flex; gap: 24px; transition: transform 0.5s ease;">
                    <!-- Category 1 - Строительство -->
                    <div class="category-slide" style="min-width: calc(50% - 12px); background: #F9FAFB; border-radius: 0; padding: 32px; position: relative; min-height: 350px;">
                        <div class="category-corner" style="position: absolute; top: 0; right: 0; width: 30px; height: 30px; border-top: 2px solid #279760; border-right: 2px solid #279760;"></div>
                        <h3 class="category-title" style="font-size: 26px; margin-bottom: 24px;">Строительство</h3>
                        <div class="category-tags" style="position: absolute; bottom: 32px; left: 32px;">
                            <div style="margin-bottom: 12px;">
                                <span class="category-tag" style="display: inline-block; background: white; border: 1px solid #D1D5DB; border-radius: 20px; padding: 8px 16px; font-size: 14px;">Строительные работы</span>
                            </div>
                            <div style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                                <span class="category-tag" style="display: inline-block; background: white; border: 1px solid #D1D5DB; border-radius: 20px; padding: 8px 16px; font-size: 14px;">Контроль СР</span>
                                <span class="category-tag-more" style="display: inline-flex; align-items: center; justify-content: center; background: #E5E7EB; border: none; border-radius: 50%; width: 40px; height: 40px; font-size: 14px; color: #1E7B4E; font-weight: 600;">+2</span>
                            </div>
                        </div>
                        <img class="category-img" src="{{asset('current/img/image-spheres-01-10@2x.png')}}" alt="Строительство" style="position: absolute; right: 15px; bottom: 0px; width: 350px; height: 350px; object-fit: contain;" />
                    </div>

                    <div class="category-slide" style="min-width: calc(50% - 12px); background: #F9FAFB; border-radius: 0; padding: 32px; position: relative; min-height: 350px;">
                        <div class="category-corner" style="position: absolute; top: 0; right: 0; width: 30px; height: 30px; border-top: 2px solid #279760; border-right: 2px solid #279760;"></div>
                        <h3 class="category-title" style="font-size: 26px; margin-bottom: 24px;">Промышленность</h3>
                        <div class="category-tags" style="position: absolute; bottom: 32px; left: 32px;">
                            <div style="margin-bottom: 12px;">
                                <span class="category-tag" style="display: inline-block; background: white; border: 1px solid #D1D5DB; border-radius: 20px; padding: 8px 16px; font-size: 14px;">Энергетика</span>
                            </div>
                            <div style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                                <span class="category-tag" style="display: inline-block; background: white; border: 1px solid #D1D5DB; border-radius: 20px; padding: 8px 16px; font-size: 14px;">Добыча полезных ископаемых</span>
                                <span class="category-tag-more" style="display: inline-flex; align-items: center; justify-content: center; background: #E5E7EB; border: none; border-radius: 50%; width: 40px; height: 40px; font-size: 14px; color: #1E7B4E; font-weight: 600;">+4</span>
                            </div>
                        </div>
                        <img class="category-img" src="{{asset('current/img/Image-Spheres-02.png')}}" alt="Промышленность" style="position: absolute; right: 15px; bottom: 0px; width: 350px; height: 350px; object-fit: contain;" />
                    </div>

                    <!-- Category 2 - Импорт-экспорт -->
                    <div class="category-slide" style="min-width: calc(50% - 12px); background: #F9FAFB; border-radius: 0; padding: 32px; position: relative; min-height: 350px;">
                        <div class="category-corner" style="position: absolute; top: 0; right: 0; width: 30px; height: 30px; border-top: 2px solid #279760; border-right: 2px solid #279760;"></div>
                        <h3 class="category-title" style="font-size: 26px;  margin-bottom: 24px;">Импорт-экспорт</h3>
                        <div class="category-tags" style="position: absolute; bottom: 32px; left: 32px;">
                            <div style="margin-bottom: 12px;">
                                <span class="category-tag" style="display: inline-block; background: white; border: 1px solid #D1D5DB; border-radius: 20px; padding: 8px 16px; font-size: 14px;">Таможенные процедуры</span>
                            </div>
                            <div style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                                <span class="category-tag" style="display: inline-block; background: white; border: 1px solid #D1D5DB; border-radius: 20px; padding: 8px 16px; font-size: 14px;">Транспорт</span>
                                <span class="category-tag-more" style="display: inline-flex; align-items: center; justify-content: center; background: #E5E7EB; border: none; border-radius: 50%; width: 40px; height: 40px; font-size: 14px; color: #1E7B4E; font-weight: 600;">+3</span>
                            </div>
                        </div>
                        <img class="category-img" src="{{asset('current/img/image-spheres-01-6@2x.png')}}" alt="Импорт-экспорт" style="position: absolute; right: 15px; bottom: 0px; width: 350px; height: 350px; object-fit: contain;" />
                    </div>

                    <!-- Category 3 - Медицина -->
                    <div class="category-slide" style="min-width: calc(50% - 12px); background: #F9FAFB; border-radius: 0; padding: 32px; position: relative; min-height: 350px;">
                        <div class="category-corner" style="position: absolute; top: 0; right: 0; width: 30px; height: 30px; border-top: 2px solid #279760; border-right: 2px solid #279760;"></div>
                        <h3 class="category-title" style="font-size: 28px; margin-bottom: 24px;">Медицина</h3>
                        <div class="category-tags" style="position: absolute; bottom: 32px; left: 32px;">
                            <div style="margin-bottom: 12px;">
                                <span class="category-tag" style="display: inline-block; background: white; border: 1px solid #D1D5DB; border-radius: 20px; padding: 8px 16px; font-size: 14px;">Медицинское оборудование</span>
                            </div>
                            <div style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                                <span class="category-tag" style="display: inline-block; background: white; border: 1px solid #D1D5DB; border-radius: 20px; padding: 8px 16px; font-size: 14px;">Фарм. индустрия</span>
                                <span class="category-tag-more" style="display: inline-flex; align-items: center; justify-content: center; background: #E5E7EB; border: none; border-radius: 50%; width: 40px; height: 40px; font-size: 14px; color: #1E7B4E; font-weight: 600;">+4</span>
                            </div>
                        </div>
                        <img class="category-img" src="{{asset('current/img/image-spheres-01-7@2x.png')}}" alt="Медицина" style="position: absolute; right: 15px; bottom: 0px; width: 350px; height: 350px; object-fit: contain;" />
                    </div>

                    <!-- Category 4 - Сельское хозяйство -->
                    <div class="category-slide" style="min-width: calc(50% - 12px); background: #F9FAFB; border-radius: 0; padding: 32px; position: relative; min-height: 350px;">
                        <div class="category-corner" style="position: absolute; top: 0; right: 0; width: 30px; height: 30px; border-top: 2px solid #279760; border-right: 2px solid #279760;"></div>
                        <h3 class="category-title" style="font-size: 28px; margin-bottom: 24px;">Сельское хозяйство</h3>
                        <div class="category-tags" style="position: absolute; bottom: 32px; left: 32px;">
                            <div style="margin-bottom: 12px;">
                                <span class="category-tag" style="display: inline-block; background: white; border: 1px solid #D1D5DB; border-radius: 20px; padding: 8px 16px; font-size: 14px;">Животноводство</span>
                            </div>
                            <div style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                                <span class="category-tag" style="display: inline-block; background: white; border: 1px solid #D1D5DB; border-radius: 20px; padding: 8px 16px; font-size: 14px;">Растениеводство</span>
                                <span class="category-tag-more" style="display: inline-flex; align-items: center; justify-content: center; background: #E5E7EB; border: none; border-radius: 50%; width: 40px; height: 40px; font-size: 14px; color: #1E7B4E; font-weight: 600;">+2</span>
                            </div>
                        </div>
                        <img class="category-img" src="{{asset('current/img/image-spheres-01-8@2x.png')}}" alt="Сельское хозяйство" style="position: absolute; right: 15px; bottom: 0px; width: 350px; height: 350px; object-fit: contain;" />
                    </div>

                    <!-- Category 5 - Культура -->
                    <div class="category-slide" style="min-width: calc(50% - 12px); background: #F9FAFB; border-radius: 0; padding: 32px; position: relative; min-height: 350px;">
                        <div class="category-corner" style="position: absolute; top: 0; right: 0; width: 30px; height: 30px; border-top: 2px solid #279760; border-right: 2px solid #279760;"></div>
                        <h3 class="category-title" style="font-size: 28px; margin-bottom: 24px;">Культура</h3>
                        <div class="category-tags" style="position: absolute; bottom: 32px; left: 32px;">
                            <div style="margin-bottom: 12px;">
                                <span class="category-tag" style="display: inline-block; background: white; border: 1px solid #D1D5DB; border-radius: 20px; padding: 8px 16px; font-size: 14px;">Искусство</span>
                            </div>
                            <div style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                                <span class="category-tag" style="display: inline-block; background: white; border: 1px solid #D1D5DB; border-radius: 20px; padding: 8px 16px; font-size: 14px;">Развлечения</span>
                                <span class="category-tag-more" style="display: inline-flex; align-items: center; justify-content: center; background: #E5E7EB; border: none; border-radius: 50%; width: 40px; height: 40px; font-size: 14px; color: #1E7B4E; font-weight: 600;">+3</span>
                            </div>
                        </div>
                        <img class="category-img" src="{{asset('current/img/image-spheres-01-9@2x.png')}}" alt="Культура" style="position: absolute; right: 15px; bottom: 0px; width: 350px; height: 350px; object-fit: contain;" />
                    </div>
                </div>
            </div>
            
            <div class="categories-footer" style="display: flex; justify-content: space-between; align-items: center; margin-top: 40px; max-width: 1320px; margin-left: auto; margin-right: auto; flex-wrap: wrap; gap: 20px;">
                <p class="categories-footer-text" style="font-size: 28px; font-weight: 500; margin: 0; font-family: 'Manrope', sans-serif; text-align: left;">Делаем процесс лицензирования легким и доступным!</p>
                <a href="#" class="categories-footer-btn" style="display: inline-flex; align-items: center; background: #279760; color: white; padding: 16px 32px; border-radius: 60px; text-decoration: none; font-weight: 600; font-size: 16px; white-space: nowrap;">Оформить заявку</a>
            </div>
        </div>
    </section>

                <!-- Services Section -->
    <section class="services-section">
        <div class="container">
            <h2 class="services-title" style="font-size: 52px; font-weight: 500; text-align: center; margin-bottom: 60px; font-family: 'Manrope', sans-serif; color: #191E1D; line-height: 1.2;">
                Предоставляем качественные<br>и комплексные <span style="color: #279760;">решения</span><br>для вашего бизнеса
            </h2>
            
                        <div class="row g-4">
                <!-- Service 1 -->
                <div class="col-lg-6">
                    <div style="background: #F1F7F6; border-radius: 0; padding: 32px; position: relative; height: 520px;">
                        <!-- Зеленая рамка -->
                        <div style="position: absolute; top: 0; right: 0; width: 30px; height: 30px; border-top: 2px solid #279760; border-right: 2px solid #279760;"></div>
                        
                        <h3 class="services-section__title" style="font-size: 28px; margin-bottom: 24px;">Регистрация компании</h3>
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; align-items: start; margin-bottom: 12px;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div class="services-section__descr" style="font-size: 14px;">Подготовка учредительных документов</div>
                            </div>
                            <div style="display: flex; align-items: start; margin-bottom: 12px;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div class="services-section__descr" style="font-size: 14px;">Сдача документов в орган</div>
                            </div>
                            <div style="display: flex; align-items: start;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div class="services-section__descr" style="font-size: 14px;">Заполнение формы на регистрацию</div>
                            </div>
                        </div>
                        <a href="#" class="services-section__link" style="position: absolute; bottom: 32px; left: 32px; display: inline-block; background: white; color: #1E1E1E; padding: 12px 24px; border-radius: 60px; text-decoration: none; font-weight: 600;">Оформить заявку</a>
                        <img src="{{asset('current/img/image-services-01-2@2x.png')}}" alt="Service" style="position: absolute; right: 0px; bottom: 0px; width: 380px; opacity: 0.9;" />
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="col-lg-6">
                    <div style="background: #DBF1D6; border-radius: 0; padding: 32px; position: relative; height: 520px;">
                        <div style="position: absolute; top: 0; right: 0; width: 30px; height: 30px; border-top: 2px solid #279760; border-right: 2px solid #279760;"></div>
                        <h3 class="services-section__title" style="font-size: 28px; margin-bottom: 24px;">Регистрация компаний в СЭЗ и МФЦА</h3>
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; align-items: start;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div class="services-section__descr" style="font-size: 14px;">Регистрация в качестве участника Astana Hub International Technology Park</div>
                            </div>
                        </div>
                        <a class="services-section__link" href="#" style="position: absolute; bottom: 32px; left: 32px; display: inline-block; background: white; color: #1E1E1E; padding: 12px 24px; border-radius: 60px; text-decoration: none; font-weight: 600;">Оформить заявку</a>
                        <img src="{{asset('current/img/image-services-02-2@2x.png')}}" alt="Service" style="position: absolute; right: 0px; bottom: 0px; width: 380px; opacity: 0.9;" />
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="col-lg-6">
                    <div style="background: #F1F7F6; border-radius: 0; padding: 32px; position: relative; height: 520px;">
                        <div style="position: absolute; top: 0; right: 0; width: 30px; height: 30px; border-top: 2px solid #279760; border-right: 2px solid #279760;"></div>
                        <h3 class="services-section__title" style="font-size: 28px; margin-bottom: 24px;">Открытие банковских счетов</h3>
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; align-items: start; margin-bottom: 12px;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div class="services-section__descr" style="font-size: 14px;">Сбор документов</div>
                            </div>
                            <div style="display: flex; align-items: start;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div class="services-section__descr" style="font-size: 14px;">Подача заявки на открытие счета</div>
                            </div>
                        </div>
                        <a href="#" class="services-section__link" style="position: absolute; bottom: 32px; left: 32px; display: inline-block; background: white; color: #1E1E1E; padding: 12px 24px; border-radius: 60px; text-decoration: none; font-weight: 600;">Оформить заявку</a>
                        <img src="{{asset('current/img/image-services-03-2@2x.png')}}" alt="Service" style="position: absolute; right: 0px; bottom: 0px; width: 380px; opacity: 0.9;" />
                    </div>
                </div>

                <!-- Service 4 -->
                <div class="col-lg-6">
                    <div style="background: #EAECEE; border-radius: 0; padding: 32px; position: relative; height: 520px;">
                        <div style="position: absolute; top: 0; right: 0; width: 30px; height: 30px; border-top: 2px solid #279760; border-right: 2px solid #279760;"></div>
                        <h3 class="services-section__title" style="font-size: 28px; margin-bottom: 24px;">Лицензирование</h3>
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; align-items: start;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div class="services-section__descr" style="font-size: 14px;">Получение лицензий для всех видов деятельности</div>
                            </div>
                        </div>
                        <a href="#" class="services-section__link" style="position: absolute; bottom: 32px; left: 32px; display: inline-block; background: white; color: #1E1E1E; padding: 12px 24px; border-radius: 60px; text-decoration: none; font-weight: 600;">Оформить заявку</a>
                        <img src="{{asset('current/img/image-services-04-2@2x.png')}}" alt="Service" style="position: absolute; right: 0px; bottom: 0px; width: 380px; opacity: 0.9;" />
                    </div>
                </div>

                <!-- Service 5 -->
                <div class="col-lg-6">
                    <div style="background: #F1F7F6; border-radius: 0; padding: 32px; position: relative; height: 520px;">
                        <div style="position: absolute; top: 0; right: 0; width: 30px; height: 30px; border-top: 2px solid #279760; border-right: 2px solid #279760;"></div>
                        <h3 class="services-section__title" style="font-size: 28px; margin-bottom: 24px;">Получение визы С3 и С5</h3>
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; align-items: start; margin-bottom: 12px;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div class="services-section__descr" style="font-size: 14px;">Сбор документов и оформление</div>
                            </div>
                            <div style="display: flex; align-items: start;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div class="services-section__descr" style="font-size: 14px;">Оформление визы в консульстве РК</div>
                            </div>
                        </div>
                        <a href="#" class="services-section__link" style="position: absolute; bottom: 32px; left: 32px; display: inline-block; background: white; color: #1E1E1E; padding: 12px 24px; border-radius: 60px; text-decoration: none; font-weight: 600;">Оформить заявку</a>
                        <img src="{{asset('current/img/image-services-05-2@2x.png')}}" alt="Service" style="position: absolute; right: 0px; bottom: 0px; width: 380px; opacity: 0.9;" />
                    </div>
                </div>

                <!-- Service 6 -->
                <div class="col-lg-6">
                    <div style="background: #F1EBD6; border-radius: 0; padding: 32px; position: relative; height: 520px;">
                        <div style="position: absolute; top: 0; right: 0; width: 30px; height: 30px; border-top: 2px solid #279760; border-right: 2px solid #279760;"></div>
                        <h3 class="services-section__title" style="font-size: 28px; margin-bottom: 24px;">Отраслевой юрист</h3>
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; align-items: start;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div class="services-section__descr" style="font-size: 14px;">Услуги юриста на аутсорсинге</div>
                            </div>
                                        </div>
                        <a href="#" class="services-section__link" style="position: absolute; bottom: 32px; left: 32px; display: inline-block; background: white; color: #1E1E1E; padding: 12px 24px; border-radius: 60px; text-decoration: none; font-weight: 600;">Оформить заявку</a>
                        <img src="{{asset('current/img/image-services-06-2@2x.png')}}" alt="Service" style="position: absolute; right: 0px; bottom: 0px; width: 380px; opacity: 0.9;" />
                                        </div>
                                    </div>

                <!-- Service 7 -->
                <div class="col-lg-6">
                    <div style="background: #E2E8F0; border-radius: 0; padding: 32px; position: relative; height: 520px;">
                        <div style="position: absolute; top: 0; right: 0; width: 30px; height: 30px; border-top: 2px solid #279760; border-right: 2px solid #279760;"></div>
                        <h3 class="services-section__title" style="font-size: 28px; margin-bottom: 24px;">Бухгалтерский аутсорсинг</h3>
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; align-items: start; margin-bottom: 12px;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div class="services-section__descr" style="font-size: 14px;">Подписание документов в банке</div>
                            </div>
                            <div style="display: flex; align-items: start;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div class="services-section__descr" style="font-size: 14px;">Сбор данных клиентов</div>
                                </div>
                        </div>
                        <a href="#" class="services-section__link" style="position: absolute; bottom: 32px; left: 32px; display: inline-block; background: white; color: #1E1E1E; padding: 12px 24px; border-radius: 60px; text-decoration: none; font-weight: 600;">Оформить заявку</a>
                        <img src="{{asset('current/img/image-services-07-2@2x.png')}}" alt="Service" style="position: absolute; right: 0px; bottom: 0px; width: 380px; opacity: 0.9;" />
                    </div>
                </div>

                <!-- Service 8 -->
                <div class="col-lg-6">
                    <div style="background: #EAECEE; border-radius: 0; padding: 32px; position: relative; height: 520px;">
                        <div style="position: absolute; top: 0; right: 0; width: 30px; height: 30px; border-top: 2px solid #279760; border-right: 2px solid #279760;"></div>
                        <h3 class="services-section__title" style="font-size: 28px; margin-bottom: 24px;">Дополнительные услуги</h3>
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; align-items: start; margin-bottom: 12px;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div class="services-section__descr" style="font-size: 14px;">Получение ИИН, БИН</div>
                            </div>
                            <div style="display: flex; align-items: start; margin-bottom: 12px;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div class="services-section__descr" style="font-size: 14px;">Получение ЭЦП</div>
                            </div>
                            <div style="display: flex; align-items: start;">
                                <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px;" />
                                <div class="services-section__descr" style="font-size: 14px;">Оформление РВП</div>
                            </div>
                        </div>
                        <a href="#" class="services-section__link" style="position: absolute; bottom: 32px; left: 32px; display: inline-block; background: white; color: #1E1E1E; padding: 12px 24px; border-radius: 60px; text-decoration: none; font-weight: 600;">Оформить заявку</a>
                        <img src="{{asset('current/img/image-services-08-2@2x.png')}}" alt="Service" style="position: absolute; right: 0px; bottom: 0px; width: 380px; opacity: 0.9;" />
                    </div>
                            </div>
                        </div>
                    </div>
                </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <!-- Desktop Layout -->
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
                </div>
            <!-- Mobile Layout -->
            <div class="stats-mobile d-lg-none" style="padding: 0 16px;">
                <h2 class="stats-mobile-title" style="font-size: 24px; font-weight: 500; margin-bottom: 24px; font-family: 'Manrope', sans-serif; color: #191E1D;">О группе UPPERCASE</h2>
                
                <div class="stats-mobile-item" style="padding: 20px 0; border-bottom: 1px solid #E5E7EB;">
                    <div style="font-size: 36px; font-weight: 500; color: #279760; margin-bottom: 8px; font-family: 'Manrope', sans-serif;">3000+</div>
                    <p style="font-size: 13px; color: #6B7280; margin: 0; line-height: 1.5;">Клиентов в области регистрации, лицензирования, сопровождения международных сделок и корпоративного права</p>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0;">
                    <div class="stats-mobile-item" style="padding: 20px 16px 20px 0; border-bottom: 1px solid #E5E7EB; border-right: 1px solid #E5E7EB;">
                        <div style="font-size: 28px; font-weight: 500; color: #279760; margin-bottom: 4px; font-family: 'Manrope', sans-serif;">13+ лет</div>
                        <p style="font-size: 12px; color: #6B7280; margin: 0; line-height: 1.4;">На рынке юридических услуг и консалтинга</p>
                    </div>
                    <div class="stats-mobile-item" style="padding: 20px 0 20px 16px; border-bottom: 1px solid #E5E7EB;">
                        <div style="font-size: 28px; font-weight: 500; color: #279760; margin-bottom: 4px; font-family: 'Manrope', sans-serif;">6</div>
                        <p style="font-size: 12px; color: #6B7280; margin: 0; line-height: 1.4;">Филиалов в ОАЭ и РК</p>
                    </div>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0;">
                    <div class="stats-mobile-item" style="padding: 20px 16px 20px 0; border-bottom: 1px solid #E5E7EB; border-right: 1px solid #E5E7EB;">
                        <div style="font-size: 20px; font-weight: 500; color: #279760; margin-bottom: 4px; font-family: 'Manrope', sans-serif;">IT-решения</div>
                        <p style="font-size: 12px; color: #6B7280; margin: 0; line-height: 1.4;">В области юридических услуг и консалтинга</p>
                    </div>
                    <div class="stats-mobile-item" style="padding: 20px 0 20px 16px; border-bottom: 1px solid #E5E7EB;">
                        <div style="font-size: 28px; font-weight: 500; color: #279760; margin-bottom: 4px; font-family: 'Manrope', sans-serif;">500+</div>
                        <p style="font-size: 12px; color: #6B7280; margin: 0; line-height: 1.4;">Успешно завершенных проектов</p>
                    </div>
                </div>
                
                <div class="stats-mobile-item" style="padding: 20px 0;">
                    <div style="font-size: 28px; font-weight: 500; color: #279760; margin-bottom: 4px; font-family: 'Manrope', sans-serif;">300+</div>
                    <p style="font-size: 12px; color: #6B7280; margin: 0; line-height: 1.4;">Опытных специалистов в команде</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section" style="padding: 0; background: white; position: relative; overflow: hidden;">
        <div class="container" style="padding: 0;">
            <div class="row g-0 align-items-stretch">
                <!-- Left Green Block -->
                <div class="col-lg-6 cta-left">
                    <h2 class="cta-title" style="font-size: 32px; font-weight: 500; color: white; margin-bottom: 24px; font-family: 'Manrope', sans-serif; line-height: 1.3;">Пользователю портала<br>предоставляется простой и удобный<br>личный кабинет</h2>
                    
                    <div class="cta-list" style="margin-bottom: 32px;">
                        <div class="cta-list-item" style="display: flex; align-items: start; margin-bottom: 12px;">
                            <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px; filter: brightness(0) invert(1);" />
                            <span style="font-size: 16px; color: white;">Отслеживание статуса заказанных услуг</span>
                        </div>
                        <div class="cta-list-item" style="display: flex; align-items: start; margin-bottom: 12px;">
                            <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px; filter: brightness(0) invert(1);" />
                            <span style="font-size: 16px; color: white;">Создание надежного архива ваших документов</span>
                        </div>
                        <div class="cta-list-item" style="display: flex; align-items: start; margin-bottom: 12px;">
                            <img src="{{asset('current/img/ic-chek-103.svg')}}" alt="check" style="width: 20px; margin-right: 12px; filter: brightness(0) invert(1);" />
                            <span style="font-size: 16px; color: white;">Получение специализированных отраслевых услуг</span>
                        </div>
                    </div>
                    
                    <div>
                        <a href="#" class="cta-btn" style="display: inline-flex; align-items: center; background: white; color: #279760; border-radius: 60px; text-decoration: none; font-weight: 600; font-size: 16px;">Получить консультацию</a>
                    </div>
                </div>
                
                <!-- Right Gray Block with Image -->
                <div class="col-lg-6 cta-right" style="background: #F8F8F8; padding: 60px 40px; display: flex; align-items: center; justify-content: center;">
                    <img src="{{asset('current/img/image-personalarea-2.png')}}" alt="Личный кабинет" class="img-fluid cta-image" style="max-width: 100%; height: auto;" />
                </div>
            </div>
        </div>
    </section>
    <section class="client-cases" style="margin-top: 160px;">
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
                    <h3 class="client-case-detail__title">Получение лицензии на проведение СМР 1 категории</h3>
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
    <section class="trust-section" style="padding: 80px 0;">
        <div class="container" style="position: relative;">
            <div class="trust-section-nav-wrapper" style="text-align: center; margin-bottom: 60px;">
                <div style="display: inline-flex; gap: 10px;">
                    <div class="category-arrow-prev hero-arrow" id="trust-prev" style="cursor: pointer; border-color: #E5E7EB;">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.5 15L7.5 10L12.5 5" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="category-arrow-next hero-arrow" id="trust-next" style="cursor: pointer; border-color: #E5E7EB;">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.5 5L12.5 10L7.5 15" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
            </div>
            <h2 class="trust-title" style="font-size: 52px; font-weight: 500; text-align: left; margin-bottom: 60px; font-family: 'Manrope', sans-serif; color: #191E1D; line-height: 1.2;">Нам доверяют</h2>
            <div class="trust-slider-wrapper" style="position: relative; overflow: hidden;">
                <div class="trust-logos" style="display: flex; transform 0.5s; transform: translateX(0px);">
                    <div class="col-lg-2 col-md-3 col-4 text-center trust-logo-item" style="margin-right: 20px;">
                        <img src="{{asset('current/img/group-7@2x.png')}}" alt="Partner" class="trust-logo" style="max-width: 100%; height: auto; opacity: 0.7;" />
                    </div>
                    <div class="col-lg-2 col-md-3 col-4 text-center trust-logo-item" style="margin-right: 20px;">
                        <img src="{{asset('current/img/button-10.svg')}}" alt="Partner" class="trust-logo" style="max-width: 100%; height: auto; opacity: 0.7;" />
                    </div>
                    <div class="col-lg-2 col-md-3 col-4 text-center trust-logo-item" style="margin-right: 20px;">
                        <img src="{{asset('current/img/button-11.png')}}" alt="Partner" class="trust-logo" style="max-width: 100%; height: auto; opacity: 0.7;" />
                    </div>
                    <div class="col-lg-2 col-md-3 col-4 text-center trust-logo-item" style="margin-right: 20px;">
                        <img src="{{asset('current/img/button-12.png')}}" alt="Partner" class="trust-logo" style="max-width: 100%; height: auto; opacity: 0.7;" />
                    </div>
                    <div class="col-lg-2 col-md-3 col-4 text-center trust-logo-item" style="margin-right: 20px;">
                        <img src="{{asset('current/img/button-13.png')}}" alt="Partner" class="trust-logo" style="max-width: 100%; height: auto; opacity: 0.7;" />
                    </div>
                    <div class="col-lg-2 col-md-3 col-4 text-center trust-logo-item" style="margin-right: 20px;">
                        <img src="{{asset('current/img/button-14.png')}}" alt="Partner" class="trust-logo" style="max-width: 100%; height: auto; opacity: 0.7;" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="consultation-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0 consultation-block__first">
                    <h2 class="consultation-hero-title">Свяжитесь с нами</h2>
                    <p class="consultation-hero-subtitle">Предоставим быстрое и эффективное открытие и ведение бизнеса в Казахстане</p>
                            </div>
                <div class="col-lg-6">
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
                                    <div class="col-12 d-flex align-items-center gap-2">
                                        <button type="submit" class="submit-btn">Получить консультацию</button>
                                        <p class="privacy-text mb-0">Нажимая на кнопку, я соглашаюсь на обработку персональных данных</p>
                                    </div>
                                </div>
                                </form>
                        </div>
                        <div class="hero-corner-frame"></div>
                    </div>
                                    </div>
                                </div>
                            </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section" style="padding: 80px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="faq-title" style="font-size: 52px; font-weight: 500; text-align: left; margin-bottom: 60px; font-family: 'Manrope', sans-serif; color: #191E1D; line-height: 1.2;">Ответы на вопросы</h2>
                </div>
                <div class="col-lg-6">
                    <div class="accordion" id="faqAccordion">
                <div class="accordion-item" style="border: none; border-bottom: 1px solid #E5E7EB; background: transparent; border-radius: 0; margin-bottom: 0; overflow: visible;">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" style="background: transparent; border: none; padding: 24px; font-size: 18px; font-weight: 600;">
                            Какие документы нужны для регистрации ТОО?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body" style="padding: 0 24px 24px; color: #6B7280; font-size: 16px; line-height: 1.6;">
                            Для регистрации ТОО потребуются копии удостоверений личности учредителей, решение о создании ТОО, устав организации и заявление на регистрацию. Наши специалисты помогут подготовить все необходимые документы.
                        </div>
                    </div>
                </div>

                <div class="accordion-item" style="border: none; border-bottom: 1px solid #E5E7EB; background: transparent; border-radius: 0; margin-bottom: 0; overflow: visible;">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" style="background: transparent; border: none; padding: 24px; font-size: 18px; font-weight: 600;">
                            Сколько времени занимает получение лицензии?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body" style="padding: 0 24px 24px; color: #6B7280; font-size: 16px; line-height: 1.6;">
                            Срок получения лицензии зависит от вида деятельности и составляет от 15 до 30 рабочих дней. Мы помогаем ускорить процесс за счет правильной подготовки документов.
                        </div>
                    </div>
                </div>

                <div class="accordion-item" style="border: none; border-bottom: 1px solid #E5E7EB; background: transparent; border-radius: 0; margin-bottom: 0; overflow: visible;">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" style="background: transparent; border: none; padding: 24px; font-size: 18px; font-weight: 600;">
                            Как получить рабочую визу в Казахстане?
                                        </button>
                                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body" style="padding: 0 24px 24px; color: #6B7280; font-size: 16px; line-height: 1.6;">
                            Для получения рабочей визы необходимо иметь приглашение от работодателя, действующий загранпаспорт и пакет документов. Мы оказываем полное сопровождение процесса получения виз С3 и С5.
                                        </div>
                                    </div>
                                </div>

                <div class="accordion-item" style="border: none; border-bottom: 1px solid #E5E7EB; background: transparent; border-radius: 0; margin-bottom: 0; overflow: visible;">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" style="background: transparent; border: none; padding: 24px; font-size: 18px; font-weight: 600;">
                            Какие услуги входят в бухгалтерский аутсорсинг?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body" style="padding: 0 24px 24px; color: #6B7280; font-size: 16px; line-height: 1.6;">
                            Бухгалтерский аутсорсинг включает ведение бухгалтерского учета, подготовку и сдачу отчетности, консультации по налоговым вопросам, работу с банками и контролирующими органами.
                        </div>
                    </div>
                                </div>

                <div class="accordion-item" style="border: none; border-bottom: 1px solid #E5E7EB; background: transparent; border-radius: 0; margin-bottom: 0; overflow: visible;">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" style="background: transparent; border: none; padding: 24px; font-size: 18px; font-weight: 600;">
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
            </div>
        </div>
    </section>
    <section class="roadmap-section">
        <div class="container">
            <h2 class="roadmap-title">UPPERLICENSE RoadMap</h2>

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
                        <img class="roadmap-card-info" src="{{asset('current/img/coolicon.svg')}}" alt="">
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
                    <img class="roadmap-card-info" src="{{asset('current/img/coolicon.svg')}}" alt="">
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
                    <img class="roadmap-card-info" src="{{asset('current/img/coolicon.svg')}}" alt="">
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
                    <img class="roadmap-card-info" src="{{asset('current/img/coolicon.svg')}}" alt="">
                    <div class="tooltip-text tooltip-text__4">
                        <ul>
                            <li>Программа лояльности для клиентов</li>
                            <li>Механизмы отслеживания рефералов и начисления бонусов за привлечение клиентов</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
        @endsection

@section('js')
            <script>
        (function() {
            function pad2(n) { return String(n).padStart(2, '0'); }

            function initHero() {
                var slides = document.querySelectorAll('.hero-slide');
                if (!slides || slides.length === 0) return;

                var totalSlides = slides.length;
                var current = 1;
                var timerId;

                var totalSlideEl = document.querySelector('.total-slides');
                if (totalSlideEl) totalSlideEl.textContent = pad2(totalSlides);

                function show(n) {
                    if (n > totalSlides) current = 1;
                    else if (n < 1) current = totalSlides;
                    else current = n;

                    for (var i = 0; i < slides.length; i++) {
                        slides[i].classList.remove('active');
                    }
                    slides[current - 1].classList.add('active');

                    var currentEl = document.querySelector('.current-slide');
                    if (currentEl) currentEl.textContent = pad2(current);
                }

                function next() { show(current + 1); }
                function prev() { show(current - 1); }
                function start() { timerId = setInterval(next, 5000); }
                function stop() { if (timerId) clearInterval(timerId); }

                var nextBtn = document.getElementById('hero-next');
                var prevBtn = document.getElementById('hero-prev');
                if (nextBtn) nextBtn.addEventListener('click', function(e) { e.preventDefault(); stop(); next(); start(); });
                if (prevBtn) prevBtn.addEventListener('click', function(e) { e.preventDefault(); stop(); prev(); start(); });

                show(1);
                start();
            }

            function initCategories() {
                var track = document.querySelector('.categories-slider');
                var slides = document.querySelectorAll('.category-slide');
                if (!track || !slides || slides.length === 0) return;

                var current = 0;

                function isMobile() {
                    return window.innerWidth < 768;
                }

                function getVisibleSlides() {
                    return isMobile() ? 1 : 2;
                }

                function getStep() {
                    var width = slides[0].getBoundingClientRect().width;
                    var gap = isMobile() ? 12 : 24; // smaller gap on mobile
                    return width + gap;
                }

                function getMaxSlide() {
                    return Math.max(0, slides.length - getVisibleSlides());
                }

                function update() {
                    track.style.transform = 'translateX(-' + (current * getStep()) + 'px)';
                }

                var nextBtn = document.getElementById('cat-next');
                var prevBtn = document.getElementById('cat-prev');
                if (nextBtn) nextBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (current < getMaxSlide()) current++; else current = 0;
                    update();
                });
                if (prevBtn) prevBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (current > 0) current--; else current = getMaxSlide();
                    update();
                });

                window.addEventListener('resize', function() {
                    // Reset to first slide on resize to prevent overflow
                    if (current > getMaxSlide()) current = getMaxSlide();
                    update();
                });
                update();
            }

            function initTrust() {
                var track = document.querySelector('.trust-logos');
                var slides = document.querySelectorAll('.trust-logo-item');
                if (!track || !slides || slides.length === 0) return;

                var current = 0;

                function isMobile() {
                    return window.innerWidth < 768;
                }

                function getVisibleSlides() {
                    return isMobile() ? 1 : 2;
                }

                function getStep() {
                    var width = slides[0].getBoundingClientRect().width;
                    var gap = isMobile() ? 12 : 24; // smaller gap on mobile
                    return width + gap;
                }

                function getMaxSlide() {
                    return Math.max(0, slides.length - getVisibleSlides());
                }

                function update() {
                    track.style.transform = 'translateX(-' + (current * getStep()) + 'px)';
                }

                var nextBtn = document.getElementById('trust-next');
                var prevBtn = document.getElementById('trust-prev');
                if (nextBtn) nextBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (current < getMaxSlide()) current++; else current = 0;
                    update();
                });
                if (prevBtn) prevBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (current > 0) current--; else current = getMaxSlide();
                    update();
                });

                window.addEventListener('resize', function() {
                    // Reset to first slide on resize to prevent overflow
                    if (current > getMaxSlide()) current = getMaxSlide();
                    update();
                });
                update();
            }

            function ready(fn) {
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', fn);
                } else {
                    fn();
                }
            }

            ready(function() {
                initHero();
                initCategories();
                initTrust();
            });
        })();
            </script>
@endsection
