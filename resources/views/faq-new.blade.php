@extends('new-redesign.layouts.app')

@section('css')
<link href="{{asset('css/faq-redesign.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="faq-page">
        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('new-index')}}">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{route('news.list')}}">Блог</a></li>
                    <li class="breadcrumb-item active" aria-current="page">FAQ</li>
                </ol>
            </nav>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="faq-header">
                        <h1 class="faq-title">Частые вопросы</h1>
                    </div>

                    <div class="faq-search-section">
                        <div class="search-container">
                            <div class="search-input-wrapper">
                                <input type="text" class="search-input" placeholder="@lang('messages.pages.news.faq.search_articles')" value="{{$filter->search}}">
                                <button class="search-btn" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="category-filters">
                            <button class="filter-btn active" type="button">Все вопросы</button>
                            <button class="filter-btn" type="button">Лицензирование</button>
                            <button class="filter-btn" type="button">Регистрация компании</button>
                            <button class="filter-btn" type="button">Юридическое сопровождение</button>
                            <button class="filter-btn" type="button">Бухгалтерия</button>
                        </div>
                    </div>

                    <div class="faq-content">
                        <div class="faq-content-header">
                            <h2 class="faq-content-title">Все вопросы</h2>
                            <button class="ask-question-btn" type="button" onclick="openModal()">Задать вопрос</button>
                        </div>

                        <div class="faq-accordion">
                            <details class="faq-item" id="faq-0">
                                <summary class="faq-question">
                                    <span class="question-text">Каковы сроки регистрации бизнеса в Казахстане?</span>
                                </summary>
                                <div class="faq-answer">
                                    <div class="answer-content">
                                        <p>Сроки регистрации бизнеса в Казахстане зависят от формы регистрации:</p>
                                        <ul>
                                            <li><strong>ТОО (Товарищество с ограниченной ответственностью):</strong> 3-5 рабочих дней</li>
                                            <li><strong>ИП (Индивидуальный предприниматель):</strong> 1-2 рабочих дня</li>
                                            <li><strong>АО (Акционерное общество):</strong> 5-7 рабочих дней</li>
                                        </ul>
                                        <p>С UPPERLICENSE процесс может быть ускорен благодаря нашему опыту и готовым шаблонам документов.</p>
                                    </div>
                                </div>
                            </details>

                            <details class="faq-item" id="faq-1">
                                <summary class="faq-question">
                                    <span class="question-text">Какие основные требования для регистрации компании в Казахстане?</span>
                                </summary>
                                <div class="faq-answer">
                                    <div class="answer-content">Предоставим  быстрое и эффективное открытие и ведение бизнеса в Казахстане. В остальных случаях расчетный счет можно открыть за один день. Сразу после подачи заявки вы получите реквизиты и сможете выставлять счета на оплату. После встречи с представителем банка появится возможность принимать деньги и совершать исходящие платежи.</div>
                                </div>
                            </details>

                            <details class="faq-item" id="faq-2">
                                <summary class="faq-question">
                                    <span class="question-text">Какие документы понадобятся для регистрации юридического лица в Казахстане?</span>
                                </summary>
                                <div class="faq-answer">
                                    <div class="answer-content">
                                        <p>Для регистрации ТОО в Казахстане потребуются следующие документы:</p>
                                        <ul>
                                            <li>Устав компании</li>
                                            <li>Заявление о государственной регистрации</li>
                                            <li>Документы, подтверждающие личность учредителей</li>
                                            <li>Справка о юридическом адресе</li>
                                            <li>Документ об уплате государственной пошлины</li>
                                            <li>Решение единственного учредителя или протокол собрания учредителей</li>
                                        </ul>
                                        <p>UPPERLICENSE поможет подготовить все необходимые документы в соответствии с требованиями законодательства.</p>
                                    </div>
                                </div>
                            </details>

                            <details class="faq-item" id="faq-3">
                                <summary class="faq-question">
                                    <span class="question-text">Можно ли в казахстанском банке открыть счет для ИП удаленно?</span>
                                </summary>
                                <div class="faq-answer">
                                    <div class="answer-content">
                                        <p>Да, в некоторых казахстанских банках возможно удаленное открытие счета для ИП. Однако процедура может включать:</p>
                                        <ul>
                                            <li>Подачу заявки онлайн</li>
                                            <li>Видеоидентификацию</li>
                                            <li>Предоставление документов в электронном виде</li>
                                            <li>Последующее посещение банка для подписания договора</li>
                                        </ul>
                                        <p>Мы поможем выбрать банк с наиболее удобными условиями открытия счета.</p>
                                    </div>
                                </div>
                            </details>

                            <details class="faq-item" id="faq-4">
                                <summary class="faq-question">
                                    <span class="question-text">Какие налоги потребуется платить в Казахстане?</span>
                                </summary>
                                <div class="faq-answer">
                                    <div class="answer-content">
                                        <p>В Казахстане действуют следующие основные налоговые режимы:</p>
                                        <ul>
                                            <li><strong>Обычный режим:</strong> КПН (корпоративный подоходный налог) - 20%</li>
                                            <li><strong>Упрощенная декларация:</strong> 1-3% с оборота (в зависимости от вида деятельности)</li>
                                            <li><strong>Статус "Международная IT-компания":</strong> льготное налогообложение</li>
                                            <li><strong>НДС:</strong> 12% (при превышении лимита)</li>
                                        </ul>
                                        <p>Наши специалисты помогут выбрать оптимальный налоговый режим для вашего бизнеса.</p>
                                    </div>
                                </div>
                            </details>

                            <details class="faq-item" id="faq-5">
                                <summary class="faq-question">
                                    <span class="question-text">Как долго обычно занимает процесс получения разрешений в стране?</span>
                                </summary>
                                <div class="faq-answer">
                                    <div class="answer-content">
                                        <p>Сроки получения разрешений зависят от типа деятельности:</p>
                                        <ul>
                                            <li><strong>Уведомление о начале деятельности:</strong> 1-3 рабочих дня</li>
                                            <li><strong>Лицензия на строительство:</strong> 10-15 рабочих дней</li>
                                            <li><strong>Лицензия на образовательную деятельность:</strong> 20-30 рабочих дней</li>
                                            <li><strong>Медицинская лицензия:</strong> 15-20 рабочих дней</li>
                                        </ul>
                                        <p>С UPPERLICENSE процесс ускоряется благодаря профессиональной подготовке документов.</p>
                                    </div>
                                </div>
                            </details>

                            <details class="faq-item" id="faq-6">
                                <summary class="faq-question">
                                    <span class="question-text">Какие отрасли и виды деятельности подлежат обязательной лицензированию в Казахстане?</span>
                                </summary>
                                <div class="faq-answer">
                                    <div class="answer-content">
                                        <p>Обязательному лицензированию подлежат следующие виды деятельности:</p>
                                        <ul>
                                            <li>Строительно-монтажные работы</li>
                                            <li>Медицинская деятельность</li>
                                            <li>Образовательная деятельность</li>
                                            <li>Фармацевтическая деятельность</li>
                                            <li>Банковские и страховые услуги</li>
                                            <li>Телекоммуникационные услуги</li>
                                            <li>Деятельность в области использования атомной энергии</li>
                                            <li>Нотариальная деятельность</li>
                                        </ul>
                                        <p>Полный список лицензируемых видов деятельности можно получить у наших консультантов.</p>
                                    </div>
                                </div>
                            </details>
                        </div>

                        <div class="load-more-container">
                            <button class="load-more-btn" type="button">Загрузить ещё</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="consultation-block">
        <div class="container">
            <div class="row align-items-stretch">
                <div class="col-lg-7 d-flex flex-column justify-content-center mb-4 mb-lg-0">
                    <h2 class="consultation-hero-title">У вас есть запрос? Давайте обсудим!</h2>
                    <p class="consultation-hero-subtitle">Предоставим быстрое и эффективное открытие и ведение бизнеса в Казахстане</p>
                    <div class="consultation-hero-decoration"></div>
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

    <!-- Custom Modal Overlay -->
    <div class="modal-overlay" id="modalNewQuestion" style="display: none;">
        <div class="modal-container">
            <button type="button" class="modal-close-btn" onclick="closeModal()">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18M6 6L18 18" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            
            <form method="post" id="formFaqNewQuestion" action="{{route('news.faq.new')}}" class="modal-form">
                <h2 class="modal-title">Задать вопрос</h2>
                
                <div class="form-fields">
                    <div class="form-field">
                        <label class="field-label">Полное имя</label>
                        @if(\Illuminate\Support\Facades\Auth::guest())
                            <input type="text" id="faqName" class="field-input" placeholder="Ф.И.О." required value=""/>
                        @else
                            <input type="text" id="faqName" class="field-input" placeholder="Ф.И.О." required value="{{\Illuminate\Support\Facades\Auth::user()->name}}"/>
                        @endif
                    </div>
                    
                    <div class="form-field">
                        <label class="field-label">Телефон</label>
                        @if(\Illuminate\Support\Facades\Auth::guest())
                            <input type="tel" id="faqPhone" class="field-input" placeholder="+7 (___) ___-__-__" required value=""/>
                        @else
                            <input type="tel" id="faqPhone" class="field-input" placeholder="+7 (___) ___-__-__" required value="{{\Illuminate\Support\Facades\Auth::user()->profile->phone}}"/>
                        @endif
                    </div>
                    
                    <div class="form-field">
                        <label class="field-label">Электронная почта</label>
                        @if(\Illuminate\Support\Facades\Auth::guest())
                            <input type="email" id="faqEmail" class="field-input" placeholder="example@gmail.com" required value=""/>
                        @else
                            <input type="email" id="faqEmail" class="field-input" placeholder="example@gmail.com" required value="{{\Illuminate\Support\Facades\Auth::user()->email}}"/>
                        @endif
                    </div>
                    
                    <div class="form-field">
                        <label class="field-label">Тема вопроса</label>
                        <select class="field-input field-select">
                            <option value="">Безопасность</option>
                            <option value="licensing">Лицензирование</option>
                            <option value="registration">Регистрация компании</option>
                            <option value="legal">Юридическое сопровождение</option>
                            <option value="accounting">Бухгалтерия</option>
                        </select>
                    </div>
                    
                    <div class="form-field">
                        <label class="field-label">Вопрос</label>
                        <textarea id="faqQuestion" class="field-input field-textarea" placeholder="Ваш вопрос" required></textarea>
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="submit-button">Отправить</button>
                    <p class="privacy-notice">
                        Нажимая на кнопку «Подписаться», я соглашаюсь с <a href="{{route('offer')}}" target="_blank">условиями политики конфиденциальности</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalSendEmailConfirm" tabindex="-1" role="dialog"
         aria-labelledby="modalSendEmailConfirmLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    {{trans('messages.pages.news.faq.new_question.confirm')}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success"
                            data-bs-dismiss="modal">{{trans('messages.all.close')}}</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Основной JavaScript для FAQ
        document.addEventListener('DOMContentLoaded', function() {
            // Поиск по FAQ
            const searchInput = document.querySelector('.search-input');
            const searchBtn = document.querySelector('.search-btn');
            const faqItems = document.querySelectorAll('.faq-item');
            
            function performSearch() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                let visibleCount = 0;
                
                faqItems.forEach(item => {
                    const questionText = item.querySelector('.question-text').textContent.toLowerCase();
                    const answerText = item.querySelector('.answer-content').textContent.toLowerCase();
                    
                    if (searchTerm === '' || questionText.includes(searchTerm) || answerText.includes(searchTerm)) {
                        item.style.display = 'block';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });
                
                // Показать сообщение если ничего не найдено
                const noResultsMsg = document.querySelector('.no-results-message');
                if (visibleCount === 0 && searchTerm !== '') {
                    if (!noResultsMsg) {
                        const message = document.createElement('div');
                        message.className = 'no-results-message';
                        message.innerHTML = '<p style="text-align: center; padding: 20px; color: #666;">По вашему запросу ничего не найдено. Попробуйте изменить поисковый запрос или <button class="ask-question-btn" onclick="openModal()" style="background: none; border: none; color: #279760; text-decoration: underline; cursor: pointer;">задать свой вопрос</button>.</p>';
                        document.querySelector('.faq-accordion').appendChild(message);
                    }
                } else if (noResultsMsg) {
                    noResultsMsg.remove();
                }
            }
            
            if (searchInput && searchBtn) {
                searchInput.addEventListener('input', performSearch);
                searchBtn.addEventListener('click', performSearch);
            }
            
            // Фильтры по категориям
            const filterBtns = document.querySelectorAll('.filter-btn');
            const contentTitle = document.querySelector('.faq-content-title');
            
            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Убираем активный класс со всех кнопок
                    filterBtns.forEach(b => b.classList.remove('active'));
                    // Добавляем активный класс к нажатой кнопке
                    this.classList.add('active');
                    
                    const filterText = this.textContent.trim();
                    if (contentTitle) {
                        contentTitle.textContent = filterText;
                    }
                    
                    // Фильтруем FAQ по категориям
                    faqItems.forEach(item => {
                        item.style.display = 'block';
                    });
                    
                    // Очищаем поиск при смене фильтра
                    if (searchInput) {
                        searchInput.value = '';
                    }
                    const noResultsMsg = document.querySelector('.no-results-message');
                    if (noResultsMsg) {
                        noResultsMsg.remove();
                    }
                });
            });
            
            // Кнопка "Загрузить ещё"
            const loadMoreBtn = document.querySelector('.load-more-btn');
            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', function() {
                    this.textContent = 'Загрузка...';
                    this.disabled = true;
                    
                    // Имитация загрузки дополнительных FAQ
                    setTimeout(() => {
                        this.textContent = 'Загрузить ещё';
                        this.disabled = false;
                        alert('Дополнительные вопросы будут добавлены позже');
                    }, 1000);
                });
            }
            
            // Форма консультации
            const consultationForm = document.querySelector('.consultation-form-content');
            if (consultationForm) {
                consultationForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.textContent;
                    
                    submitBtn.textContent = 'Отправка...';
                    submitBtn.disabled = true;
                    
                    // Имитация отправки формы
                    setTimeout(() => {
                        alert('Спасибо за обращение! Наш специалист свяжется с вами в течение 30 минут.');
                        submitBtn.textContent = originalText;
                        submitBtn.disabled = false;
                        this.reset();
                    }, 1500);
                });
            }
            
            // Форма модального окна "Задать вопрос"
            const modalForm = document.getElementById('formFaqNewQuestion');
            if (modalForm) {
                modalForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const submitBtn = this.querySelector('.submit-button');
                    const originalText = submitBtn.textContent;
                    
                    submitBtn.textContent = 'Отправка...';
                    submitBtn.disabled = true;
                    
                    // Собираем данные формы
                    const formData = new FormData(this);
                    
                    // Имитация отправки (в реальности здесь будет AJAX запрос)
                    setTimeout(() => {
                        alert('Спасибо за ваш вопрос! Мы ответим на него в ближайшее время.');
                        submitBtn.textContent = originalText;
                        submitBtn.disabled = false;
                        this.reset();
                        closeModal();
                    }, 1500);
                });
            }
            
            // Маска для телефона в модальном окне
            const modalPhoneInput = document.getElementById('faqPhone');
            if (modalPhoneInput) {
                modalPhoneInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    if (value.length > 0) {
                        if (value.length <= 1) {
                            value = '+7 (' + value;
                        } else if (value.length <= 4) {
                            value = '+7 (' + value.substring(1);
                        } else if (value.length <= 7) {
                            value = '+7 (' + value.substring(1, 4) + ') ' + value.substring(4);
                        } else if (value.length <= 9) {
                            value = '+7 (' + value.substring(1, 4) + ') ' + value.substring(4, 7) + '-' + value.substring(7);
                        } else {
                            value = '+7 (' + value.substring(1, 4) + ') ' + value.substring(4, 7) + '-' + value.substring(7, 9) + '-' + value.substring(9, 11);
                        }
                    }
                    e.target.value = value;
                });
            }
        });

        function openModal() {
            const modal = document.getElementById('modalNewQuestion');
            if (modal) {
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            } else {
                // Fallback если модальное окно не найдено
                const question = prompt('Введите ваш вопрос:');
                if (question && question.trim()) {
                    alert('Спасибо за ваш вопрос! Мы ответим на него в ближайшее время.\n\nВаш вопрос: ' + question);
                }
            }
        }

        function closeModal() {
            document.getElementById('modalNewQuestion').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking on overlay
        document.getElementById('modalNewQuestion').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
@endsection

