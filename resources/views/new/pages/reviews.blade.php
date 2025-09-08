@extends('new.layouts.app')
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
                    <!-- Review Card 1 -->
                    <article class="review-card">
                        <div class="review-card__thumb">
                            <img src="https://via.placeholder.com/300x200/F3F4F6/9CA3AF?text=Video+Thumbnail"
                                 alt="Video Thumbnail">
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
                            <h3 class="review-title">Bloomberg: накопленный за пандемию избыток нефти почти
                                исчерпан</h3>
                            <p class="review-text">Кого же привлекает этот новое направление в моде? Неординарные,
                                яркие, смелые в своих решениях люди, которые не боятся пробовать экспериментировать со
                                своим образом.</p>
                            <div class="review-date">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                                    <path d="M16 2v4M8 2v4M3 10h18"/>
                                </svg>
                                10 февраля 2024
                            </div>
                        </div>
                    </article>

                    <!-- Review Card 2 -->
                    <article class="review-card">
                        <div class="review-card__thumb">
                            <img src="https://via.placeholder.com/300x200/F3F4F6/9CA3AF?text=Video+Thumbnail"
                                 alt="Video Thumbnail">
                            <button class="play-button" aria-label="Воспроизвести видео">
                                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                    <circle cx="24" cy="24" r="24" fill="rgba(0,0,0,0.5)"/>
                                    <polygon points="20,16 36,24 20,32" fill="#fff"/>
                                </svg>
                            </button>
                            <span class="duration">06:24</span>
                        </div>
                        <div class="review-card__content">
                            <div class="category">СТРОИТЕЛЬСТВО • МЕДИЦИНА</div>
                            <h3 class="review-title">TransLogistica Kazakhstan 2024</h3>
                            <p class="review-text">Кого же привлекает этот новое направление в моде? Неординарные,
                                яркие, смелые в своих решениях люди, которые не боятся пробовать экспериментировать со
                                своим образом.</p>
                            <div class="review-date">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                                    <path d="M16 2v4M8 2v4M3 10h18"/>
                                </svg>
                                10 февраля 2024
                            </div>
                        </div>
                    </article>

                    <!-- Review Card 3 -->
                    <article class="review-card">
                        <div class="review-card__thumb">
                            <img src="https://via.placeholder.com/300x200/F3F4F6/9CA3AF?text=Video+Thumbnail"
                                 alt="Video Thumbnail">
                            <button class="play-button" aria-label="Воспроизвести видео">
                                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                    <circle cx="24" cy="24" r="24" fill="rgba(0,0,0,0.5)"/>
                                    <polygon points="20,16 36,24 20,32" fill="#fff"/>
                                </svg>
                            </button>
                            <span class="duration">06:24</span>
                        </div>
                        <div class="review-card__content">
                            <div class="category">ЛИЦЕНЗИРОВАНИЕ • СТРОИТЕЛЬСТВО</div>
                            <h3 class="review-title">Петербургский Международный Газовый Форум 2024</h3>
                            <p class="review-text">Кого же привлекает этот новое направление в моде? Неординарные,
                                яркие, смелые в своих решениях люди, которые не боятся пробовать экспериментировать со
                                своим образом.</p>
                            <div class="review-date">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                                    <path d="M16 2v4M8 2v4M3 10h18"/>
                                </svg>
                                10 февраля 2024
                            </div>
                        </div>
                    </article>

                    <!-- Review Card 4 -->
                    <article class="review-card">
                        <div class="review-card__thumb">
                            <img src="https://via.placeholder.com/300x200/F3F4F6/9CA3AF?text=Video+Thumbnail"
                                 alt="Video Thumbnail">
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
                            <h3 class="review-title">Bloomberg: накопленный за пандемию избыток нефти почти
                                исчерпан</h3>
                            <p class="review-text">Кого же привлекает этот новое направление в моде? Неординарные,
                                яркие, смелые в своих решениях люди, которые не боятся пробовать экспериментировать со
                                своим образом.</p>
                            <div class="review-date">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                                    <path d="M16 2v4M8 2v4M3 10h18"/>
                                </svg>
                                10 февраля 2024
                            </div>
                        </div>
                    </article>

                    <!-- Review Card 5 -->
                    <article class="review-card">
                        <div class="review-card__thumb">
                            <img src="https://via.placeholder.com/300x200/F3F4F6/9CA3AF?text=Video+Thumbnail"
                                 alt="Video Thumbnail">
                            <button class="play-button" aria-label="Воспроизвести видео">
                                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                    <circle cx="24" cy="24" r="24" fill="rgba(0,0,0,0.5)"/>
                                    <polygon points="20,16 36,24 20,32" fill="#fff"/>
                                </svg>
                            </button>
                            <span class="duration">06:24</span>
                        </div>
                        <div class="review-card__content">
                            <div class="category">СТРОИТЕЛЬСТВО • МЕДИЦИНА</div>
                            <h3 class="review-title">TransLogistica Kazakhstan 2024</h3>
                            <p class="review-text">Кого же привлекает этот новое направление в моде? Неординарные,
                                яркие, смелые в своих решениях люди, которые не боятся пробовать экспериментировать со
                                своим образом.</p>
                            <div class="review-date">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                                    <path d="M16 2v4M8 2v4M3 10h18"/>
                                </svg>
                                10 февраля 2024
                            </div>
                        </div>
                    </article>

                    <!-- Review Card 6 -->
                    <article class="review-card">
                        <div class="review-card__thumb">
                            <img src="https://via.placeholder.com/300x200/F3F4F6/9CA3AF?text=Video+Thumbnail"
                                 alt="Video Thumbnail">
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
                            <h3 class="review-title">Bloomberg: накопленный за пандемию избыток нефти почти
                                исчерпан</h3>
                            <p class="review-text">Кого же привлекает этот новое направление в моде? Неординарные,
                                яркие, смелые в своих решениях люди, которые не боятся пробовать экспериментировать со
                                своим образом.</p>
                            <div class="review-date">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                                    <path d="M16 2v4M8 2v4M3 10h18"/>
                                </svg>
                                10 февраля 2024
                            </div>
                        </div>
                    </article>

                    <!-- Review Card 7 -->
                    <article class="review-card">
                        <div class="review-card__thumb">
                            <img src="https://via.placeholder.com/300x200/F3F4F6/9CA3AF?text=Video+Thumbnail"
                                 alt="Video Thumbnail">
                            <button class="play-button" aria-label="Воспроизвести видео">
                                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                    <circle cx="24" cy="24" r="24" fill="rgba(0,0,0,0.5)"/>
                                    <polygon points="20,16 36,24 20,32" fill="#fff"/>
                                </svg>
                            </button>
                            <span class="duration">06:24</span>
                        </div>
                        <div class="review-card__content">
                            <div class="category">СТРОИТЕЛЬСТВО • МЕДИЦИНА</div>
                            <h3 class="review-title">TransLogistica Kazakhstan 2024</h3>
                            <p class="review-text">Кого же привлекает этот новое направление в моде? Неординарные,
                                яркие, смелые в своих решениях люди, которые не боятся пробовать экспериментировать со
                                своим образом.</p>
                            <div class="review-date">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                                    <path d="M16 2v4M8 2v4M3 10h18"/>
                                </svg>
                                10 февраля 2024
                            </div>
                        </div>
                    </article>

                    <!-- Review Card 8 -->
                    <article class="review-card">
                        <div class="review-card__thumb">
                            <img src="https://via.placeholder.com/300x200/F3F4F6/9CA3AF?text=Video+Thumbnail"
                                 alt="Video Thumbnail">
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
                            <h3 class="review-title">Bloomberg: накопленный за пандемию избыток нефти почти
                                исчерпан</h3>
                            <p class="review-text">Кого же привлекает этот новое направление в моде? Неординарные,
                                яркие, смелые в своих решениях люди, которые не боятся пробовать экспериментировать со
                                своим образом.</p>
                            <div class="review-date">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                                    <path d="M16 2v4M8 2v4M3 10h18"/>
                                </svg>
                                10 февраля 2024
                            </div>
                        </div>
                    </article>

                    <!-- Review Card 9 -->
                    <article class="review-card">
                        <div class="review-card__thumb">
                            <img src="https://via.placeholder.com/300x200/F3F4F6/9CA3AF?text=Video+Thumbnail"
                                 alt="Video Thumbnail">
                            <button class="play-button" aria-label="Воспроизвести видео">
                                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                    <circle cx="24" cy="24" r="24" fill="rgba(0,0,0,0.5)"/>
                                    <polygon points="20,16 36,24 20,32" fill="#fff"/>
                                </svg>
                            </button>
                            <span class="duration">06:24</span>
                        </div>
                        <div class="review-card__content">
                            <div class="category">СТРОИТЕЛЬСТВО • МЕДИЦИНА</div>
                            <h3 class="review-title">TransLogistica Kazakhstan 2024</h3>
                            <p class="review-text">Кого же привлекает этот новое направление в моде? Неординарные,
                                яркие, смелые в своих решениях люди, которые не боятся пробовать экспериментировать со
                                своим образом.</p>
                            <div class="review-date">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                                    <path d="M16 2v4M8 2v4M3 10h18"/>
                                </svg>
                                10 февраля 2024
                            </div>
                        </div>
                    </article>
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
