@extends('new.layouts.app')

@section('title')
    @lang('messages.pages.about.title')
@endsection

@push('css')
    <link href="{{mix('css/app_new.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@section('content')
    <div class="about-us">
        <!-- Hero Section -->
        <div class="about-us__hero">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="about-us__hero__content">
                            <h1 class="about-us__hero__title">
                                <span class="text-primary">UPPERLICENSE</span> — инновационная онлайн-платформа, предлагающая комплексные решения для ведения бизнеса в Казахстане
                            </h1>
                            <p class="about-us__hero__description">
                                Мы объединяем передовые технологии и профессиональную экспертизу, чтобы максимально упростить взаимодействие предпринимателей с государственными органами - от регистрации ТОО и открытия банковских счетов до получения лицензий и разрешений.
                            </p>
                            <div class="about-us__hero__buttons">
                                <a href="{{route('new-index') . '#listOfIndustries'}}" class="btn btn-primary">
                                    Стать клиентом
                                </a>
                                <a href="{{route('new-partners')}}" class="btn btn-outline-primary">
                                    Стать партнёром
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="about-us__hero__image-container">
                            <img src="{{asset('images/aboutmain.png')}}" alt="UPPERLICENSE" class="about-us__hero__image img-fluid" onerror="this.onerror=null;this.src='{{ asset('images/aboutmain.png') }}';">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Features Section -->
        <div class="about-us__features">
            <div class="container">
                <div class="about-us__features__header">
                    <h2>С UPPERLICENSE вы  <span class="text-primary">легко соберете и оформите все необходимые документы</span> и всегда будете в курсе актуальных изменений законодательства.</h2>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="about-us__features__card about-us__features__card--white">
                        <h3>Бесплатный доступ к информации</h3>
                            <div class="about-us__features__card__image">
                                <img src="{{ asset('images/Rectangleabout.png') }}" alt="Бесплатный доступ" class="img-fluid">
                            </div>
                            
                            <p>Уникальная онлайн-платформа с постоянно обновляемой базой данных.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="about-us__features__card about-us__features__card--green">
                        <h3>Всегда актуальные данные</h3>
                            <div class="about-us__features__card__image">
                                <img src="{{ asset('images/Rectangleabout2.png') }}" alt="Актуальные данные" class="img-fluid">
                            </div>
                            
                            <p>Оперируйте самыми свежими и достоверными данными о бизнес-процессах, включая открытие ТОО, создание банковских счётов и лицензирование в различных отраслях.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="about-us__features__card about-us__features__card--beige">
                        <h3>Все документы для бизнеса в одном месте</h3>
                            <div class="about-us__features__card__image">
                                <img src="{{ asset('images/Rectangleabout3.png') }}" alt="Документы в одном месте" class="img-fluid">
                            </div>
                            
                            <p>Легко и быстро собирайте и оформляйте полные комплекты документов для получения лицензий, разрешений и других бизнес-услуг.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mission Section -->
        <div class="about-us__mission">
            <div class="container">
                <div class="about-us__mission__content">
                    <p><span class="text-primary">Наша миссия</span> — содействовать улучшению деловой среды в Казахстане, предоставляя современные цифровые решения и сервисы для упрощения взаимодействия бизнеса и государства.</p>
                </div>
            </div>
        </div>

        

        <!-- What You Will Find Section -->
        <div class="about-us__find">
            <div class="about-us__find__header">
                <h2>Все, что нужно для получения<br>лицензий и разрешений</h2>
            </div>
            <div class="about-us__find__cards-container">
                <div class="about-us__find__card">
                    <div class="about-us__find__card__image">
                        <img src="{{asset('images/aboutactual.png')}}" alt="Актуальная информация">
                    </div>
                    <div class="about-us__find__card__content">
                        <p class="about-us__find__card__number">01</p>
                        <h3 class="about-us__find__card__title">Актуальная информация</h3>
                        <p class="about-us__find__card__description">Больше не нужно тратить время на поиск разрозненной информации - на нашей платформе вся необходимая информация собрана в одном месте, тщательно проверена и всегда актуальна.</p>
                    </div>
                </div>
                <div class="about-us__find__card">
                    <div class="about-us__find__card__image">
                    <img src="{{asset('images/aboutprof.png')}}" alt="Профессиональные услуги">
                    </div>
                    <div class="about-us__find__card__content">
                        <p class="about-us__find__card__number">02</p>
                        <h3 class="about-us__find__card__title">Профессиональные услуги</h3>
                        <p class="about-us__find__card__description">Доверьте сбор документов и отслеживание заявок профессионалам нашей команде, которая оперативно подготовит все необходимые материалы.</p>
                    </div>
                </div>
                <div class="about-us__find__card">
                    <div class="about-us__find__card__image">
                    <img src="{{asset('images/aboutserv.png')}}" alt="Сопутствующие сервисы">
                    </div>
                    <div class="about-us__find__card__content">
                        <p class="about-us__find__card__number">03</p>
                        <h3 class="about-us__find__card__title">Сопутствующие сервисы</h3>
                        <p class="about-us__find__card__description">Воспользуйтесь дополнительными сервисами и специальными условиями от наших партнеров для полного соответствия лицензионным требованиям.</p>
                    </div>
                </div>
                <div class="about-us__find__card">
                    <div class="about-us__find__card__image">
                    <img src="{{asset('images/aboutvideo.png')}}" alt="Видеоконтент от госорганов">
                    </div>
                    <div class="about-us__find__card__content">
                        <p class="about-us__find__card__number">04</p>
                        <h3 class="about-us__find__card__title">Видеоконтент от госорганов</h3>
                        <p class="about-us__find__card__description">Смотрите разъясняющие видеоматериалы с пояснениями требований и условий для лицензирования непосредственно от представителей государственных органов.</p>
                    </div>
                </div>
            </div>
        </div>
        

        <!-- Services Grid Section -->
        <div class="services-section bg-white py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="section-title">Предоставляем качественные</h2>
                    <h2 class="section-title">и комплексные <span class="text-success">решения</span></h2>
                    <h2 class="section-title">для вашего бизнеса</h2>
                </div>

                <div class="row g-4">
                    <!-- Card 1 -->
                    <div class="col-md-6">
                        <div class="service-card">
                            <div class="card-content">
                                <h3>Регистрация компании</h3>
                                <ul class="service-list">
                                    <li>Подготовка учредительных документов филиала/представительств</li>
                                    <li>Сдача документов в регистрирующий орган</li>
                                    <li>Заполнение формы на регистрацию</li>
                                </ul>
                            </div>
                            <div class="card-button">
                                <button class="btn btn-outline-dark rounded-pill">Оформить заявку</button>
                            </div>
                            <div class="card-image">
                                <img src="{{ asset('new/images/icons/documentsIcon.png') }}" alt="Регистрация компании">
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-md-6">
                        <div class="service-card card-green">
                            <div class="card-content">
                                <h3>Регистрация компаний в СЭЗ и МФЦА</h3>
                                <ul class="service-list">
                                    <li>Регистрация в качестве участника Astana Hub International Technology Park</li>
                                </ul>
                            </div>
                            <div class="card-button">
                                <button class="btn btn-outline-dark rounded-pill">Оформить заявку</button>
                            </div>
                            <div class="card-image">
                                <img src="{{ asset('new/images/icons/astanahub.png') }}" alt="Регистрация в СЭЗ">
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-md-6">
                        <div class="service-card card-blue">
                            <div class="card-content">
                                <h3>Открытие банковских счетов</h3>
                                <ul class="service-list">
                                    <li>Сбор документов</li>
                                    <li>Подача заявки на открытие счета</li>
                                </ul>
                            </div>
                            <div class="card-button">
                                <button class="btn btn-outline-dark rounded-pill">Оформить заявку</button>
                            </div>
                            <div class="card-image">
                                <img src="{{ asset('new/images/icons/uslugibank.png') }}" alt="Банковские счета">
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="col-md-6">
                        <div class="service-card card-orange">
                            <div class="card-content">
                                <h3>Лицензирование</h3>
                                <ul class="service-list">
                                    <li>Получение лицензий и разрешительных документов для всех видов деятельности</li>
                                </ul>
                            </div>
                            <div class="card-button">
                                <button class="btn btn-outline-dark rounded-pill">Оформить заявку</button>
                            </div>
                            <div class="card-image">
                                <img src="{{ asset('new/images/icons/uslugilicense.png') }}" alt="Лицензирование">
                            </div>
                        </div>
                    </div>

                    <!-- Card 5 -->
                    <div class="col-md-6">
                        <div class="service-card card-purple">
                            <div class="card-content">
                                <h3>Получение визы С3 и С5</h3>
                                <ul class="service-list">
                                    <li>Сбор документов и оформление приглашения</li>
                                    <li>Оформление визы в консульстве РК</li>
                                </ul>
                            </div>
                            <div class="card-button">
                                <button class="btn btn-outline-dark rounded-pill">Оформить заявку</button>
                            </div>
                            <div class="card-image">
                                <img src="{{ asset('new/images/icons/uslugivisa.png') }}" alt="Визы">
                            </div>
                        </div>
                    </div>

                    <!-- Card 6 -->
                    <div class="col-md-6">
                        <div class="service-card card-yellow">
                            <div class="card-content">
                                <h3>Предоставление отраслевого юриста</h3>
                                <ul class="service-list">
                                    <li>Услуги юриста на аутсорсе для вашего бизнеса</li>
                                </ul>
                            </div>
                            <div class="card-button">
                                <button class="btn btn-outline-dark rounded-pill">Оформить заявку</button>
                            </div>
                            <div class="card-image">
                                <img src="{{ asset('new/images/icons/uslugilaw.png') }}" alt="Юрист">
                            </div>
                        </div>
                    </div>

                    <!-- Card 7 -->
                    <div class="col-md-6">
                        <div class="service-card card-red">
                            <div class="card-content">
                                <h3>Бухгалтерский аутсорсинг</h3>
                                <ul class="service-list">
                                    <li>Подписание документов в банке (работа с менеджером банка)</li>
                                    <li>Сбор данных клиентов</li>
                                </ul>
                            </div>
                            <div class="card-button">
                                <button class="btn btn-outline-dark rounded-pill">Оформить заявку</button>
                            </div>
                            <div class="card-image">
                                <img src="{{ asset('new/images/icons/uslugibuh.png') }}" alt="Бухгалтерия">
                            </div>
                        </div>
                    </div>

                    <!-- Card 8 -->
                    <div class="col-md-6">
                        <div class="service-card card-gray">
                            <div class="card-content">
                                <h3>Дополнительные услуги</h3>
                                <ul class="service-list">
                                    <li>Получение ИИН, БИН</li>
                                    <li>Получение ЭЦП</li>
                                    <li>Оформление РВП</li>
                                </ul>
                            </div>
                            <div class="card-button">
                                <button class="btn btn-outline-dark rounded-pill">Оформить заявку</button>
                            </div>
                            <div class="card-image">
                                <img src="{{ asset('new/images/icons/uslugiplus.png') }}" alt="Дополнительные услуги">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <!-- Statistics Section -->
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

        <!-- CTA Section -->
        <div class="about-us__cta">
            <div class="container">
                <div class="about-us__cta__content">
                    <h2>Присоединяйтесь к UPPERLICENSE!</h2>
                    <p>Мы делаем процесс получения лицензий и разрешений в Казахстане максимально простым и удобным.</p>
                    <div class="about-us__cta__buttons">
                        <a href="{{route('new-index') . '#listOfIndustries'}}" class="btn btn-primary">
                            Стать клиентом
                        </a>
                        <a href="{{route('new-partners')}}" class="btn btn-outline-primary">
                            Стать партнёром
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection