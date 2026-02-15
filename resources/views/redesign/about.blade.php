@extends('redesign.layouts.app')

@section('title', 'UPPERLICENSE - О компании')

@section('css')
<link rel="stylesheet" href="{{asset('assets/css/about.css')}}">
@endsection

@section('content')
    <div class="breadscrumb">
        <div class="container">
            <div class="row">
                <ul class="breadscrumb__list">
                    <li>
                        <a href="{{ route('new-index') }}">
                            <img src="{{asset('assets/img/ic-home.svg')}}" alt="">
                            Главная
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="elipsis"></div>
                            О компании
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="about__first">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-xs-12 col-xl-6 col-lg-6">
                    <div class="about__first__block">
                        <div class="about__first__block__title"><span class="green">UPPERLICENSE</span> — инновационная онлайн-платформа, предлагающая комплексные решения для ведения бизнеса в Казахстане</div>
                        <div class="about__first__block__descr">Мы объединяем передовые технологии и профессиональную экспертизу, чтобы максимально упростить взаимодействие предпринимателей с государственными органами -  от регистрации ТОО и открытия банковских счетов до получения лицензий и разрешений.</div>
                        <div class="about__first__block__btns">
                            <a class="about__first__block__btns__primary" href="#">Стать клиентом</a>
                            <a class="about__first__block__btns__default" href="#">Стать партнёром</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-xs-12 col-xl-6 col-lg-6">
                    <div class="about__first__block__bg"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="about__second">
        <div class="container">
            <div class="about__second__title">
                С UPPERLICENSE вы легко <span class="green">соберете и оформите все необходимые документы</span> и всегда будете в курсе актуальных изменений законодательства.
            </div>
            <div class="row about__second__wrap">
                <div class="col-md-12 col-12 col-sm-12 col-xs-12 col-xl-4 col-lg-4">
                    <div class="about__second__block about__second__block__first">
                        <div class="about__second__block__title">Бесплатный доступ к информации</div>
                        <div class="about__second__block__img">
                            <img src="{{asset('assets/img/about__second-1.png')}}" alt="">
                        </div>
                        <div class="about__second__block__descr">Уникальная онлайн-платформа с постоянно обновляемой базой данных.</div>    
                    </div>
                </div>
                <div class="col-md-12 col-12 col-sm-12 col-xs-12 col-xl-4 col-lg-4">
                    <div class="about__second__block about__second__block__second">
                        <div class="about__second__block__title">Всегда актуальные данные</div>
                        <div class="about__second__block__img">
                            <img src="{{asset('assets/img/about__second-2.png')}}" alt="">
                        </div>
                        <div class="about__second__block__descr">Оперируйте самыми свежими и достоверными данными о бизнес-процессах, включая открытие ТОО, создание банковских счётов и лицензирование в различных отраслях.</div>    
                    </div>
                </div>
                <div class="col-md-12 col-12 col-sm-12 col-xs-12 col-xl-4 col-lg-4">
                    <div class="about__second__block about__second__block__third">
                        <div class="about__second__block__title">Все документы для бизнеса в одном месте</div>
                        <div class="about__second__block__img">
                            <img src="{{asset('assets/img/about__second-3.png')}}" alt="">
                        </div>
                        <div class="about__second__block__descr">Легко и быстро собирайте и оформляйте полные комплекты документов для получения лицензий, разрешений и других бизнес-услуг.</div>    
                    </div>
                </div>
            </div>
            <div class="about__second__subtitle">
                <span class="green">Наша миссия</span> — содействовать улучшению деловой среды в Казахстане, предоставляя современные цифровые решения и сервисы для упрощения взаимодействия бизнеса и государства.
            </div>
        </div>
    </div>

    <div class="second about__third">
        <div class="container">
            <div class="row">
                <div class="second__title">Все, что нужно для получения лицензий и разрешений</div>
                <div class="second__wrap">
                    <div class="col-md-6 col-12 col-sm-12 col-xs-12 col-xl-3 col-lg-3">
                        <div class="second__block">
                            <div class="second__block__img">
                                <img src="{{asset('assets/img/about-features-01.png')}}" alt="">
                            </div>
                            <div class="second__block__wrap">
                                <div class="second__block__number">01</div>
                                <div class="second__block__title">Актуальная информация</div>
                                <div class="second__block__descr">Больше не нужно тратить время на поиск разрозненной информации - на нашей платформе вся необходимая информация собрана в одном месте, тщательно проверена и всегда актуальна.</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 col-sm-12 col-xs-12 col-xl-3 col-lg-3">
                        <div class="second__block">
                            <div class="second__block__img">
                                <img src="{{asset('assets/img/about-features-02.png')}}" alt="">
                            </div>
                            <div class="second__block__wrap">
                                <div class="second__block__number">02</div>
                                <div class="second__block__title">Профессиональные услуги</div>
                                <div class="second__block__descr">Доверьте сбор документов и отслеживание заявок профессиональной команде, которая оперативно подготовит все необходимые материалы.</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 col-sm-12 col-xs-12 col-xl-3 col-lg-3">
                        <div class="second__block">
                            <div class="second__block__img">
                                <img src="{{asset('assets/img/about-features-03.png')}}" alt="">
                            </div>
                            <div class="second__block__wrap">
                                <div class="second__block__number">03</div>
                                <div class="second__block__title">Сопутствующие сервисы</div>
                                <div class="second__block__descr">Воспользуйтесь дополнительными сервисами и специальными условиями от наших надежных партнеров для полного соответствия лицензионным требованиям.</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 col-sm-12 col-xs-12 col-xl-3 col-lg-3">
                        <div class="second__block">
                            <div class="second__block__img">
                                <img src="{{asset('assets/img/about-features-04.png')}}" alt="">
                            </div>
                            <div class="second__block__wrap">
                                <div class="second__block__number">04</div>
                                <div class="second__block__title">Видеоконтент от госорганов</div>
                                <div class="second__block__descr">Смотрите разъясняющие видеоматериалы с пояснениями требований и условий лицензирования непосредственно от представителей государственных органов.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fourth">
        <div class="container">
            <div class="row fourth__wrap">
                <div class="fourth__title">Предоставляем качественные и комплексные <span class="green">решения</span> для вашего бизнеса</div>
                <div class="col-12 col-sm-6 col-xl-6 col-lg-6 col-xs-12 fourth__block__items">
                    <div class="fourth__block__items__text">
                        <div class="fourth__block__items__text__title">Регистрация компании</div>
                        <ul class="fourth__block__items__text__list">
                            <li><img src="{{asset('assets/img/ic-chek.svg')}}" alt="">Подготовка учредительных документов филиала/представительств</li>
                            <li><img src="{{asset('assets/img/ic-chek.svg')}}" alt="">Сдача документов в регистрирующий орган</li>
                            <li><img src="{{asset('assets/img/ic-chek.svg')}}" alt="">Заполнение формы на регистрацию</li>
                        </ul>
                    </div>
                    <a href="#" class="fourth__block__items__btn">
                        Оформить заявку
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-xl-6 col-lg-6 col-xs-12 fourth__block__items">
                    <div class="fourth__block__items__text">
                        <div class="fourth__block__items__text__title">Регистрация компаний в СЭЗ и МФЦА</div>
                        <ul class="fourth__block__items__text__list">
                            <li><img src="{{asset('assets/img/ic-chek.svg')}}" alt="">Регистрация в качестве участника Astana Hub International Technology Park</li>
                        </ul>
                    </div>
                    <a href="#" class="fourth__block__items__btn">
                        Оформить заявку
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-xl-6 col-lg-6 col-xs-12 fourth__block__items">
                    <div class="fourth__block__items__text">
                        <div class="fourth__block__items__text__title">Открытие банковских счетов</div>
                        <ul class="fourth__block__items__text__list">
                            <li><img src="{{asset('assets/img/ic-chek.svg')}}" alt="">Сбор документов</li>
                            <li><img src="{{asset('assets/img/ic-chek.svg')}}" alt="">Подача заявки на открытие счёта</li>
                        </ul>
                    </div>
                    <a href="#" class="fourth__block__items__btn">
                        Оформить заявку
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-xl-6 col-lg-6 col-xs-12 fourth__block__items">
                    <div class="fourth__block__items__text">
                        <div class="fourth__block__items__text__title">Лицензирование</div>
                        <ul class="fourth__block__items__text__list">
                            <li><img src="{{asset('assets/img/ic-chek.svg')}}" alt="">Получение лицензий и разрешительных документов для всех видов деятельности</li>
                        </ul>
                    </div>
                    <a href="#" class="fourth__block__items__btn">
                        Оформить заявку
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-xl-6 col-lg-6 col-xs-12 fourth__block__items">
                    <div class="fourth__block__items__text">
                        <div class="fourth__block__items__text__title">Получение визы С3 и С5</div>
                        <ul class="fourth__block__items__text__list">
                            <li><img src="{{asset('assets/img/ic-chek.svg')}}" alt="">Сбор документов и оформление приглашения</li>
                            <li><img src="{{asset('assets/img/ic-chek.svg')}}" alt="">Оформление визы в консульстве РК</li>
                        </ul>
                    </div>
                    <a href="#" class="fourth__block__items__btn">
                        Оформить заявку
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-xl-6 col-lg-6 col-xs-12 fourth__block__items">
                    <div class="fourth__block__items__text">
                        <div class="fourth__block__items__text__title">Предоставление отраслевого юриста</div>
                        <ul class="fourth__block__items__text__list">
                            <li><img src="{{asset('assets/img/ic-chek.svg')}}" alt="">Услуги юриста на аутсорсинге для вашего бизнеса</li>
                        </ul>
                    </div>
                    <a href="#" class="fourth__block__items__btn">
                        Оформить заявку
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-xl-6 col-lg-6 col-xs-12 fourth__block__items">
                    <div class="fourth__block__items__text">
                        <div class="fourth__block__items__text__title">Бухгалтерский аутсорсинг</div>
                        <ul class="fourth__block__items__text__list">
                            <li><img src="{{asset('assets/img/ic-chek.svg')}}" alt="">Подписание документов в банке (работа с менеджером банка)</li>
                            <li><img src="{{asset('assets/img/ic-chek.svg')}}" alt="">Сбор данных клиентов</li>
                        </ul>
                    </div>
                    <a href="#" class="fourth__block__items__btn">
                        Оформить заявку
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-xl-6 col-lg-6 col-xs-12 fourth__block__items">
                    <div class="fourth__block__items__text">
                        <div class="fourth__block__items__text__title">Дополнительные услуги</div>
                        <ul class="fourth__block__items__text__list">
                            <li><img src="{{asset('assets/img/ic-chek.svg')}}" alt="">Получение ИИН, БИН</li>
                            <li><img src="{{asset('assets/img/ic-chek.svg')}}" alt="">Получение ЭЦП</li>
                            <li><img src="{{asset('assets/img/ic-chek.svg')}}" alt="">Оформление РВП</li>
                        </ul>
                    </div>
                    <a href="#" class="fourth__block__items__btn">
                        Оформить заявку
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="about__fifth">
        <div class="about-us__stats">
            <div class="container">
                <div class="about-us__stats__grid">
                    <div class="about-us__stats__header">
                        <div class="about-us__stats__logo">
                            <img src="{{asset('assets/img/logo_white.svg')}}" alt="">
                        </div>
                        <p>UPPERLICENSE создан и разработан<br>экспертами группы компаний UPPERCASE</p>
                    </div>
                    <div class="about-us__stats__item item1">
                        <div class="about-us__stats__number">13+ лет</div>
                        <p>На рынке юридических услуг и консалтинга</p>
                    </div>
                    <div class="about-us__stats__item item2">
                        <div class="about-us__stats__number">6</div>
                        <p>Филиалов в ОАЭ и РК</p>
                    </div>
                    <div class="about-us__stats__item item3">
                        <div class="about-us__stats__number">500+</div>
                        <p>Успешно завершенных проектов</p>
                    </div>
                    <div class="about-us__stats__item item4">
                        <div class="about-us__stats__number">300+</div>
                        <p>Опытных специалистов в команде</p>
                    </div>
                    <div class="about-us__stats__item footer__about">
                        <div class="about-us__stats__number">3000+</div>
                        <p>Клиентов в области регистрации, лицензирования, сопровождения международных сделок и корпоративного права</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="about__sixth">
        <div class="container">
            <div class="row">
                <div class="about__sixth__block">
                    <div class="about__sixth__block__text">
                        <div class="about__sixth__block__title">Присоединяйтесь к UPPERLICENSE!</div>
                        <div class="about__sixth__block__descr">Мы делаем процесс получения лицензий и разрешений в Казахстане максимально простым и удобным.</div>
                        <div class="about__sixth__block__btns">
                            <a class="about__sixth__block__btns__primary" href="#">Стать клиентом</a>
                            <a class="about__sixth__block__btns__default" href="#">Стать партнёром</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection