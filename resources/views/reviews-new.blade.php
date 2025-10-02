@extends('new-redesign.layouts.app')

@section('title')
    @lang('messages.pages.reviews.title')
@endsection

@push('css')
    <link href="{{asset('css/app_new.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@section('content')
    <main class="reviews-page">
        <!-- Breadcrumb Navigation -->
        <nav class="breadcrumb" aria-label="Хлебные крошки">
            <div class="container">
                <div class="breadcrumb__content">
                    <a href="/" class="breadcrumb__link">Главная</a>
                    <span class="breadcrumb__separator">/</span>
                    <span class="breadcrumb__current">Отзывы</span>
                </div>
            </div>
        </nav>

        <!-- Page Header -->
        <header class="page-header">
            <div class="container">
                <h1 class="page-title">Отзывы и кейсы Клиентов</h1>
                <div class="filters">
                    <button type="button" class="filter-btn filter-btn--active">Все Отзывы</button>
                    <button type="button" class="filter-btn">Лицензирование</button>
                    <button type="button" class="filter-btn">Регистрация компании</button>
                    <button type="button" class="filter-btn">Юридическое сопровождение</button>
                    <button type="button" class="filter-btn">Бухгалтерия</button>
                    <button type="button" class="show-more-btn">Показать ещё</button>
                </div>
            </div>
        </header>

        <!-- Reviews Grid Section -->
        <section class="reviews-section">
            <div class="container">
                <div class="reviews-grid">
                    @if(isset($reviewList) && count($reviewList) > 0)
                        @foreach($reviewList as $review)
                            <article class="review-card" data-category="{{$review->service_category ?? 'ОБЩЕЕ'}}">
                                <div class="review-card__thumb">
                                    @if($review->youtube_preview)
                                        <img src="{{$review->youtube_preview}}" alt="{{$review->company_name ?? 'Отзыв клиента'}}">
                                    @elseif($review->image)
                                        <img src="{{asset('images/' . $review->image)}}" alt="{{$review->company_name ?? 'Отзыв клиента'}}">
                                    @else
                                        <img src="https://via.placeholder.com/300x200/F3F4F6/9CA3AF?text=Review+Image" alt="{{$review->company_name ?? 'Отзыв клиента'}}">
                                    @endif
                                    @if($review->youtube_url || $review->video_url)
                                        <button class="play-button" aria-label="Воспроизвести видео" data-video-url="{{$review->youtube_url ?? $review->video_url}}">
                                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                                <circle cx="24" cy="24" r="24" fill="rgba(0,0,0,0.5)"/>
                                                <polygon points="20,16 36,24 20,32" fill="#fff"/>
                                            </svg>
                                        </button>
                                        <span class="duration">{{$review->duration ?? '06:24'}}</span>
                                    @endif
                                </div>
                                <div class="review-card__content">
                                    <div class="category">
                                        @if($review->service_category)
                                            {{strtoupper($review->service_category)}}
                                        @elseif(isset($review->review_type_id) && $review->review_type_id == 1)
                                            ЛИЦЕНЗИРОВАНИЕ
                                        @else
                                            ОБЩЕЕ
                                        @endif
                                    </div>
                                    <h3 class="review-title">
                                        {{$review->title ?? $review->company_name ?? 'Отзыв довольного клиента'}}
                                    </h3>
                                    <p class="review-text">
                                        {{Illuminate\Support\Str::limit($review->content ?? $review->company_description ?? 'Благодарим команду UPPERLICENSE за профессиональную помощь в получении лицензии. Все было сделано быстро и качественно.', 150)}}
                                    </p>
                                    <div class="review-date">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="3" y="4" width="18" height="18" rx="2"/>
                                            <path d="M16 2v4M8 2v4M3 10h18"/>
                                        </svg>
                                        {{$review->created_at ? $review->created_at->format('d F Y') : '10 февраля 2024'}}
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    @else
                        <!-- Placeholder review cards if no data -->
                        @for($i = 1; $i <= 9; $i++)
                    <article class="review-card">
                        <div class="review-card__thumb">
                                    <img src="https://via.placeholder.com/300x200/F3F4F6/9CA3AF?text=Video+Thumbnail" alt="Video Thumbnail">
                            <button class="play-button" aria-label="Воспроизвести видео">
                                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                    <circle cx="24" cy="24" r="24" fill="rgba(0,0,0,0.5)"/>
                                    <polygon points="20,16 36,24 20,32" fill="#fff"/>
                                </svg>
                            </button>
                            <span class="duration">06:24</span>
                        </div>
                        <div class="review-card__content">
                            <div class="category">СТРОИТЕЛЬСТВО • ЛИЦЕНЗИРОВАНИЕ</div>
                                    <h3 class="review-title">Отзыв клиента о работе UPPERLICENSE {{$i}}</h3>
                                    <p class="review-text">Благодарим команду UPPERLICENSE за профессиональную помощь в получении лицензии. Все было сделано быстро и качественно.</p>
                            <div class="review-date">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                                    <path d="M16 2v4M8 2v4M3 10h18"/>
                                </svg>
                                10 февраля 2024
                            </div>
                        </div>
                    </article>
                        @endfor
                    @endif
                </div>

                <div class="load-more">
                    <button type="button" class="load-more-btn">Загрузить ещё</button>
                </div>
            </div>
        </section>

        <!-- Client Cases Section -->
        <section class="client-cases">
            <div class="container">
                <div class="client-cases__header">
                    <h2 class="client-cases__title">Кейсы наших клиентов</h2>
                    <div class="client-cases__navigation">
                        <button type="button" class="client-cases__nav-btn client-cases__nav-btn--prev" aria-label="Предыдущий кейс">&lt;</button>
                        <button type="button" class="client-cases__nav-btn client-cases__nav-btn--next" aria-label="Следующий кейс">&gt;</button>
                    </div>
                </div>

                <div class="client-case-detail">
                    <div class="client-case-detail__left">
                        <h3 class="client-case-detail__title">Получение лицензии на строительно-монтажные работы</h3>
                        <div class="client-case-detail__client-info">
                            <div class="client-case-detail__logo">
                                <span class="logo-text">ТН</span>
                            </div>
                            <div class="client-case-detail__client-text">
                                <p class="client-case-detail__client-name">Технониколь</p>
                                <p class="client-case-detail__client-description">Производитель строительных материалов и систем</p>
                            </div>
                        </div>
                        <button class="client-case-detail__video-btn">
                            Смотреть видео-отзыв
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 12L10 8L6 4V12Z" fill="currentColor"/>
                            </svg>
                        </button>
                    </div>

                    <div class="client-case-detail__right">
                        <div class="client-case-detail__section">
                            <h4 class="client-case-detail__section-title">Входные параметры</h4>
                            <ul class="client-case-detail__list">
                                <li class="client-case-detail__list-item">
                                    <svg class="client-case-detail__checkmark" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.3333 4L6 11.3333L2.66667 8" stroke="#16A34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    В короткие сроки (7 рабочих дней) получить лицензию на проведение строительно-монтажных работ 1 категории.
                                </li>
                                <li class="client-case-detail__list-item">
                                    <svg class="client-case-detail__checkmark" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.3333 4L6 11.3333L2.66667 8" stroke="#16A34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Получить консультирование отраслевого юриста по квалификационным требованиям и нормативно-правовым актам в сфере строительства.
                                </li>
                            </ul>
                        </div>

                        <div class="client-case-detail__section">
                            <h4 class="client-case-detail__section-title">Решение</h4>
                            <ul class="client-case-detail__list">
                                <li class="client-case-detail__list-item">
                                    <svg class="client-case-detail__checkmark" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.3333 4L6 11.3333L2.66667 8" stroke="#16A34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Получение консультации отраслевого юриста. Консультация опытного юриста по вопросам квалификационных требований и нормативно-правовых актов в сфере строительства.
                                </li>
                                <li class="client-case-detail__list-item">
                                    <svg class="client-case-detail__checkmark" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.3333 4L6 11.3333L2.66667 8" stroke="#16A34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Советы и рекомендации по подготовке документов и прохождению процедуры лицензирования.
                                </li>
                                <li class="client-case-detail__list-item">
                                    <svg class="client-case-detail__checkmark" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.3333 4L6 11.3333L2.66667 8" stroke="#16A34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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
                                    <svg class="client-case-detail__checkmark client-case-detail__checkmark--white" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.3333 4L6 11.3333L2.66667 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    В результате успешной реализации этого кейса, компания смогла получить лицензию на проведение строительно-монтажных работ 1 категории в короткие сроки, а также получила консультацию отраслевого юриста, что позволило ей эффективно соблюсти все требования и нормативы в сфере строительства
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Form Section -->
        <section class="contact-section">
            <div class="container contact-section__container">
                <div class="contact-section__info">
                    <h2 class="contact-section__title">У вас есть запрос?<br>Давайте обсудим!</h2>
                    <p class="contact-section__desc">
                        Предоставим быстрое и эффективное открытие<br>
                        и ведение бизнеса в Казахстане
                    </p>
                </div>
                <form class="contact-section__form">
                    <div class="contact-section__form-row">
                        <div class="contact-section__form-group">
                            <label for="name">Представьтесь пожалуйста</label>
                            <input type="text" id="name" name="name" placeholder="Ф.И.О" required>
                        </div>
                        <div class="contact-section__form-group">
                            <label for="service">Услуга</label>
                            <select id="service" name="service" required>
                                <option value="">Выберите услугу</option>
                                <option value="licensing">Лицензирование</option>
                                <option value="registration">Регистрация компании</option>
                                <option value="legal">Юридическое сопровождение</option>
                                <option value="accounting">Бухгалтерия</option>
                            </select>
                        </div>
                    </div>
                    <div class="contact-section__form-row">
                        <div class="contact-section__form-group">
                            <label for="email">Электронная почта</label>
                            <input type="email" id="email" name="email" placeholder="example@gmail.com" required>
                        </div>
                        <div class="contact-section__form-group">
                            <label for="phone">Телефон</label>
                            <input type="tel" id="phone" name="phone" placeholder="8 (___) ___-__-__" required>
                        </div>
                    </div>
                    <div class="contact-section__form-group">
                        <label for="comment">Комментарий</label>
                        <textarea id="comment" name="comment" placeholder="Оставьте свой комментарий"></textarea>
                    </div>
                    <div class="contact-section__form-actions">
                        <button type="button" class="contact-section__submit">Получить консультацию</button>
                        <span class="contact-section__policy">
                        Нажимая на кнопку, я соглашаюсь на обработку персональных данных
                    </span>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Фильтры отзывов
    const filterBtns = document.querySelectorAll('.filter-btn');
    const reviewCards = document.querySelectorAll('.review-card');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Убираем активный класс со всех кнопок
            filterBtns.forEach(b => b.classList.remove('filter-btn--active'));
            // Добавляем активный класс к нажатой кнопке
            this.classList.add('filter-btn--active');
            
            const filterText = this.textContent.trim();
            
            reviewCards.forEach(card => {
                if (filterText === 'Все Отзывы') {
                    card.style.display = 'block';
                } else {
                    const category = card.querySelector('.category').textContent;
                    const dataCategory = card.getAttribute('data-category');
                    
                    let shouldShow = false;
                    
                    // Проверяем соответствие фильтра
                    if (filterText === 'Лицензирование') {
                        shouldShow = category.includes('ЛИЦЕНЗИРОВАНИЕ') || 
                                   dataCategory?.includes('лицензирование') ||
                                   dataCategory?.includes('licensing');
                    } else if (filterText === 'Регистрация компании') {
                        shouldShow = category.includes('РЕГИСТРАЦИЯ') || 
                                   dataCategory?.includes('регистрация') ||
                                   dataCategory?.includes('registration');
                    } else if (filterText === 'Юридическое сопровождение') {
                        shouldShow = category.includes('ЮРИДИЧЕСКОЕ') || 
                                   dataCategory?.includes('юридическое') ||
                                   dataCategory?.includes('legal');
                    } else if (filterText === 'Бухгалтерия') {
                        shouldShow = category.includes('БУХГАЛТЕРИЯ') || 
                                   dataCategory?.includes('бухгалтерия') ||
                                   dataCategory?.includes('accounting');
                    } else {
                        shouldShow = category.includes(filterText.toUpperCase());
                    }
                    
                    card.style.display = shouldShow ? 'block' : 'none';
                }
            });
        });
    });
    
    // Кнопка "Загрузить еще"
    const loadMoreBtn = document.querySelector('.load-more-btn');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            // Имитация загрузки дополнительных отзывов
            this.textContent = 'Загрузка...';
            this.disabled = true;
            
            setTimeout(() => {
                this.textContent = 'Загрузить ещё';
                this.disabled = false;
                // Здесь можно добавить AJAX запрос для загрузки реальных данных
            }, 1000);
        });
    }
    
    // Кнопки воспроизведения видео
    const playBtns = document.querySelectorAll('.play-button');
    playBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const videoUrl = this.getAttribute('data-video-url');
            if (videoUrl) {
                window.open(videoUrl, '_blank');
            } else {
                alert('Видео временно недоступно');
            }
        });
    });
    
    // Навигация кейсов клиентов
    const prevBtn = document.querySelector('.client-cases__nav-btn--prev');
    const nextBtn = document.querySelector('.client-cases__nav-btn--next');
    
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            // Логика переключения на предыдущий кейс
            console.log('Предыдущий кейс');
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            // Логика переключения на следующий кейс
            console.log('Следующий кейс');
        });
    }
    
    // Кнопка "Показать полностью" в кейсах
    const showMoreBtn = document.querySelector('.client-case-detail__show-more-btn');
    if (showMoreBtn) {
        showMoreBtn.addEventListener('click', function() {
            const hiddenItems = document.querySelectorAll('.client-case-detail__list-item[style*="display: none"]');
            if (hiddenItems.length > 0) {
                hiddenItems.forEach(item => item.style.display = 'flex');
                this.textContent = 'Скрыть';
            } else {
                // Скрыть дополнительные элементы (если есть)
                this.textContent = 'Показать полностью';
            }
        });
    }
    
    // Кнопка видео-отзыва
    const videoBtn = document.querySelector('.client-case-detail__video-btn');
    if (videoBtn) {
        videoBtn.addEventListener('click', function() {
            alert('Видео-отзыв будет добавлен позже');
        });
    }
    
    // Форма обратной связи
    const contactForm = document.querySelector('.contact-section__form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = this.querySelector('.contact-section__submit');
            const originalText = submitBtn.textContent;
            
            submitBtn.textContent = 'Отправка...';
            submitBtn.disabled = true;
            
            // Имитация отправки формы
            setTimeout(() => {
                alert('Спасибо за обращение! Мы свяжемся с вами в ближайшее время.');
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
                this.reset();
            }, 1500);
        });
    }
    
    // Маска для телефона
    const phoneInput = document.querySelector('#phone');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (value.length <= 1) {
                    value = '8 (' + value;
                } else if (value.length <= 4) {
                    value = '8 (' + value.substring(1);
                } else if (value.length <= 7) {
                    value = '8 (' + value.substring(1, 4) + ') ' + value.substring(4);
                } else if (value.length <= 9) {
                    value = '8 (' + value.substring(1, 4) + ') ' + value.substring(4, 7) + '-' + value.substring(7);
                } else {
                    value = '8 (' + value.substring(1, 4) + ') ' + value.substring(4, 7) + '-' + value.substring(7, 9) + '-' + value.substring(9, 11);
                }
            }
            e.target.value = value;
        });
    }
    
    // Кнопка "Показать ещё" фильтров
    const showMoreFiltersBtn = document.querySelector('.show-more-btn');
    if (showMoreFiltersBtn) {
        showMoreFiltersBtn.addEventListener('click', function() {
            // Здесь можно добавить логику показа дополнительных фильтров
            alert('Дополнительные фильтры будут добавлены позже');
        });
    }
});
</script>
@endpush