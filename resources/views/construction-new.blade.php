@extends('new-redesign.layouts.app')

@section('css')
    <link href="{{asset('new/css/app_1.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="construction-page bg-white">
        <div class="container py-5">
            <!-- Breadcrumb -->
            <div class="icon-section mb-3 text-start d-flex align-items-center">
                <img
                        src="{{ asset('new/images/icons/home-02.png') }}"
                        alt="Иконка строительства"
                        class="construction-icon me-2"
                        width="11"
                        height="11"
                >
                <span class="breadcrumb-text" style="
                    font-family: 'Manrope', sans-serif;
                    font-weight: 500;
                    font-style: normal;
                    font-size: 12px;
                    line-height: 100%;
                    letter-spacing: 0;
                ">
                    Главная &bull; Строительство
                </span>
            </div>

            <!-- Main Content -->
            <div class="content-section text-center">
                <h1 class="mb-4" style="font-family: 'Manrope', sans-serif; font-weight: 500;">Строительство</h1>
                <p class="mb-5 mx-auto" style="
                    max-width: 800px;
                    font-family: 'Manrope', sans-serif;
                    font-weight: 500;
                    font-style: normal;
                    font-size: 15px;
                    line-height: 150%;
                    letter-spacing: 0%;
                    text-align: center;
                ">
                    Строительная сфера — одна из значимых составляющих экономики Казахстана,
                    остается в числе наиболее привлекательных для инвесторов.
                    Это отрасль, в которой за последние 10 лет наблюдается быстрый рост
                </p>
                <div class="image-container">
                    <img
                            src="{{ asset('new/images/icons/constructionmain.png') }}"
                            class="construction-main-image"
                            alt="Строительство"
                    >
                </div>
            </div>

            <!-- Step 1: Document Selection -->
            <div class="step-section mb-3">
                <div class="container py-4">
                    <h2 class="step-title mb-4" style="font-family: 'Manrope', sans-serif;">
                        <span class="step-number">1</span>
                        Выберите разрешительный документ
                    </h2>
                    <div class="document-selection">
                        <div class="row g-4">
                            @foreach($documentTypes as $index => $documentType)
                                <div class="col-md-4">
                                    <label class="document-option {{ $index === 0 ? 'selected' : '' }}" data-document-id="{{ $documentType->id }}" style="cursor: pointer;">
                                        <input type="radio" name="document_type" value="{{ $documentType->id }}" {{ $index === 0 ? 'checked' : '' }} data-pretty-url="{{ $documentType->pretty_url }}" style="display: none;">
                                        <div class="radio-visual">
                                            <span class="radio-checkmark"></span>
                                        </div>
                                        <div class="document-content">
                                            <h3>{{ $documentType->name }}</h3>
                                            @if($documentType->description)
                                                <p class="category">{{ $documentType->description }}</p>
                                            @endif
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="work-types-section mt-5">
                <h2 class="step-title mb-4" style="font-family: 'Manrope', sans-serif;">
                    <span class="step-number">2</span>
                    Выберите подвиды работ, чтобы узнать точные стоимость и сроки
                </h2>

                <!-- Контейнеры для каждой категории документов (переключаются на фронте) -->
                @foreach($documentTypes as $docIndex => $documentType)
                    <!-- Document {{ $documentType->id }} - {{ $documentType->name }} ({{ $documentType->catalogList ? $documentType->catalogList->count() : 0 }} подвидов) -->
                    <div class="service-content-container" data-document-id="{{ $documentType->id }}" style="display: {{ $docIndex === 0 ? 'block' : 'none' }};">
                        @if(isset($documentType->catalogList) && $documentType->catalogList->count() > 0)
                            <div class="services">
                                <div class="col-12 services__window-documents">
                                    <div>
                                        <div class="row">
                                            <div class="col-sm-10 col-12 service-content-data-list">
                                                <p class="service-content-data-list-head">Чтобы узнать точные стоимость и сроки выберите подвиды работ</p>
                                            </div>

                                            <div class="col-12">
                                                @foreach($documentType->catalogList as $catalogItem)
                                                    @php
                                                        $catalogSubList = $catalogItem->catalogSubList ?? collect();
                                                    @endphp
                                                    <div class="row mb-3">
                                                        <div class="col-12">
                                                            <div class="row service-content-data-list-item">
                                                                <div class="service-content-data-list-item-head">
                                                                    <div class="service-content-data-list-item-head-main-info">
                                                                        <label class="container_checkbox container_checkbox-all">
                                                                            {{$catalogItem->name}}
                                                                            <input type="checkbox"><span class="checkmark"></span>
                                                                        </label>
                                                                        @if(sizeof($catalogSubList) > 0)
                                                                            <div class="service-content-data-list-item-head-point">
                                                                                {{sizeof($catalogSubList)}} @choice('пункт|пункта|пунктов', $catalogSubList)
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="service-content-data-list-item-head-additional-info">
                                                                        <a type="button" class="service-content-data-list-item-head-link services__window-link">
                                                                            <i class="ml-3 bi bi-chevron-down services__window_title-icon"></i>
                                                                        </a>
                                                                        <a type="button" class="service-content-data-list-item-head-link services__window-link hides d-none">
                                                                            <i class="ml-3 bi bi-chevron-up services__window_title-icon"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="services__window_all">
                                                                    <div class="service-content-data-list-item-list services__window_choices d-none">
                                                                        <div class="row">
                                                                            @if(sizeof($catalogSubList) > 0)
                                                                                @foreach($catalogSubList as $catalogSubItem)
                                                                                    @if(sizeof($catalogSubItem->serviceCatalogList) > 0)
                                                                                        <div class="col-12 services__window_choices_layout">
                                                                                            <label class="container_checkbox">{{$catalogSubItem->name}}
                                                                                                <input type="checkbox" data-service-id="{{$catalogSubItem->serviceCatalogList[0]->service_id}}" data-name="{{$catalogSubItem->name}}">
                                                                                                <span class="checkmark"></span>
                                                                                            </label>
                                                                                            @if(!$loop->last)
                                                                                                <hr class="services__window-strip">
                                                                                            @endif
                                                                                        </div>
                                                                                    @endif
                                                                                @endforeach
                                                                            @else
                                                                                @if(sizeof($catalogItem->serviceCatalogList) > 0)
                                                                                    <div class="col-12 services__window_choices_layout">
                                                                                        <label class="container_checkbox">{{$catalogItem->name}}
                                                                                            <input type="checkbox" data-service-id="{{$catalogItem->serviceCatalogList[0]->service_id}}" data-name="{{$catalogItem->name}}">
                                                                                            <span class="checkmark"></span>
                                                                                        </label>
                                                                                    </div>
                                                                                @endif
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <p>Нет доступных подвидов работ для этой категории</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Расчет стоимости и Экспресс-решение -->
    <div class="pricing-section bg-white py-4">
        <div class="container">
            <div class="row">
                <!-- Блок с расчетом и экспресс-решением -->
                <div class="pricing-section">
                    <!-- Расчет стоимости -->
                    <div class="pricing-card pricing-green">
                        <div class="pricing-content">
                            <div class="pricing-header">
                                <div class="circle">3</div>
                                <h2>Расчёт стоимости</h2>
                            </div>
                            <div class="selected-info">Выбрано: <span>3 видов работ</span></div>

                            <div class="pricing-details">
                                <div class="pricing-item">
                                    <div class="label">Стоимость</div>
                                    <div class="value">5 500 500 ₸</div>
                                </div>
                                <div class="pricing-item">
                                    <div class="label">Срок оказания услуг</div>
                                    <div class="value">11 дней</div>
                                </div>
                            </div>

                            <div class="pricing-actions">
                                <button class="btn btn-green orderService" disabled>Заказать услугу</button>
                                <button class="btn btn-gray service-action" data-bs-toggle="modal" data-bs-target="#downloadCommercialOfferModal" disabled>
                                    Скачать КП
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                        <path d="M7 10L12 15L17 10" stroke="#279760" stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12 15V3" stroke="#279760" stroke-width="2" stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                        <path d="M21 15V19C21 19.53 20.79 20.04 20.41 20.41C20.04 20.79 19.53 21 19 21H5C4.47 21 3.96 20.79 3.59 20.41C3.21 20.04 3 19.53 3 19V15"
                                              stroke="#279760" stroke-width="2" stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Экспресс-решение -->
                    <div class="pricing-card pricing-beige">
                        <div class="pricing-content">
                            <div class="pricing-header">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="#FF9500">
                                    <path d="M13 2L3 14H12L11 22L21 10H12L13 2Z"/>
                                </svg>
                                <h2>Экспресс-решение</h2>
                            </div>
                            <div class="selected-info">Если поджимают сроки, воспользуйтесь готовым решением</div>

                            <div class="pricing-details">
                                <div class="pricing-item">
                                    <div class="label">Стоимость</div>
                                    <div class="value">6 000 000 ₸</div>
                                </div>
                                <div class="pricing-item">
                                    <div class="label">Срок оказания услуг</div>
                                    <div class="value">3 дня</div>
                                </div>
                            </div>

                            <div class="pricing-actions">
                                <button class="btn btn-green readyOffer" data-bs-toggle="modal" data-bs-target="#consultModal">Заказать услугу</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="construction-section">
                    <h1 class="construction-title">Строительно-монтажные работы I категория</h1>

                    <p class="construction-description">
                        Начиная с 2005 года в Республике Казахстан были приняты шесть государственных программ,
                        направленные на строительство жилья и повышение доступности жилья для населения:
                    </p>

                    <div class="construction-table">
                        <!-- header row -->
                        <div class="table-row table-head">
                            <div class="col">Услугодатель</div>
                            <div class="col">Срок оказания услуг</div>
                            <div class="col">Стоимость оказания услуг</div>
                        </div>

                        <!-- row -->
                        <div class="table-row">
                            <div class="col">КГУ «Управление градостроительного контроля». / ГУ «Управление контроля и
                                качества городской среды города Нур-Султан»
                            </div>
                            <div class="col">11 дней</div>
                            <div class="col">5 500 500 ₸</div>
                        </div>

                        <div class="table-row">
                            <div class="col">«Управление градостроительного контроля»</div>
                            <div class="col">12 дней</div>
                            <div class="col">4 500 500 ₸</div>
                        </div>
                    </div>
                </div>


                <div class="instructions-section">
                    <div class="instructions-container">
                        <!-- Левая часть -->
                        <div class="instructions-left">
                            <h2 class="instructions-title">Инструкция и требования для получения документов</h2>
                            <button class="download-btn">
                                Скачать требования
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21 15V19C21 19.5 20.8 20 20.4 20.4C20 20.8 19.5 21 19 21H5C4.5 21 4 20.8 3.6 20.4C3.2 20 3 19.5 3 19V15" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7 10L12 15L17 10" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 15V3" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>

                        <!-- Правая часть -->
                        <div class="instructions-right">
                            <div class="accordion" id="instructionsAccordion">
                                <!-- Item 1 -->
                                <div class="accordion-item">
                                    <button class="accordion-header" data-bs-toggle="collapse" data-bs-target="#collapse1">
                                        <span class="step-number">1</span>
                                        <span class="step-text">Инструкции ведения строительной деятельности/регламенты и срок/правила</span>
                                        <span class="icon">+</span>
                                    </button>
                                    <div id="collapse1" class="accordion-collapse collapse" data-bs-parent="#instructionsAccordion">
                                        <div class="accordion-body">
                                            Контент для пункта 1
                                        </div>
                                    </div>
                                </div>

                                <!-- Item 2 -->
                                <div class="accordion-item">
                                    <button class="accordion-header" data-bs-toggle="collapse" data-bs-target="#collapse2">
                                        <span class="step-number">2</span>
                                        <span class="step-text">Оплата государственной пошлины</span>
                                        <span class="icon">+</span>
                                    </button>
                                    <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#instructionsAccordion">
                                        <div class="accordion-body">
                                            Контент для пункта 2
                                        </div>
                                    </div>
                                </div>

                                <!-- Item 3 -->
                                <div class="accordion-item">
                                    <button class="accordion-header" data-bs-toggle="collapse" data-bs-target="#collapse3">
                                        <span class="step-number">3</span>
                                        <span class="step-text">Выбор необходимой категории и подготовка пакета документов</span>
                                        <span class="icon">+</span>
                                    </button>
                                    <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#instructionsAccordion">
                                        <div class="accordion-body">
                                            Контент для пункта 3
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <!-- Services Section - Figma Design -->
                <div class="services-section-new">
                    <div class="services-container">
                        <h2 class="services-main-title">
                            Предоставляем качественные<br>
                            и комплексные <span class="text-green">решения</span><br>
                            для вашего бизнеса
                        </h2>

                        <div class="services-grid">
                            <!-- Card 1 -->
                            <div class="service-card-new" style="background: #F1F7F6;">
                                <div class="service-txt">
                                    <h3 class="service-card-title">Регистрация компании</h3>
                                    <ul class="service-features">
                                        <li>
                                            <svg class="check-icon" width="20" height="20" viewBox="0 0 20 20">
                                                <path d="M7 10L9 12L13 8" stroke="#191E1D" stroke-opacity="0.3" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>Подготовка учредительных документов филиала/представительств</span>
                                        </li>
                                        <li>
                                            <svg class="check-icon" width="20" height="20" viewBox="0 0 20 20">
                                                <path d="M7 10L9 12L13 8" stroke="#191E1D" stroke-opacity="0.3" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>Сдача документов в регистрирующий орган</span>
                                        </li>
                                        <li>
                                            <svg class="check-icon" width="20" height="20" viewBox="0 0 20 20">
                                                <path d="M7 10L9 12L13 8" stroke="#191E1D" stroke-opacity="0.3" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>Заполнение формы на регистрацию</span>
                                        </li>
                                    </ul>
                                </div>
                                <button class="service-btn-new">
                                    <span>Оформить заявку </span>
                                </button>
                                <img src="{{ asset('new/images/icons/documentsIcon.png') }}" alt="Регистрация компании" class="service-image-new">
                            </div>

                            <!-- Card 2 -->
                            <div class="service-card-new" style="background: #DBF1D6;">
                                <div class="service-txt">
                                    <h3 class="service-card-title">Регистрация компаний в СЭЗ и МФЦА</h3>
                                    <ul class="service-features">
                                        <li>
                                            <svg class="check-icon" width="20" height="20" viewBox="0 0 20 20">
                                                <path d="M7 10L9 12L13 8" stroke="#191E1D" stroke-opacity="0.3" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>Регистрация в качестве участника Astana Hub International Technology Park</span>
                                        </li>
                                    </ul>
                                </div>
                                <button class="service-btn-new">
                                    <span>Оформить заявку</span>
                                </button>
                                <img src="{{ asset('new/images/icons/astanahub.png') }}" alt="Регистрация в СЭЗ" class="service-image-new">
                            </div>

                            <!-- Card 3 -->
                            <div class="service-card-new" style="background: #F1F7F6;">
                                <div class="service-txt">
                                    <h3 class="service-card-title">Открытие банковских счетов</h3>
                                    <ul class="service-features">
                                        <li>
                                            <svg class="check-icon" width="20" height="20" viewBox="0 0 20 20">
                                                <path d="M7 10L9 12L13 8" stroke="#191E1D" stroke-opacity="0.3" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>Сбор документов</span>
                                        </li>
                                        <li>
                                            <svg class="check-icon" width="20" height="20" viewBox="0 0 20 20">
                                                <path d="M7 10L9 12L13 8" stroke="#191E1D" stroke-opacity="0.3" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>Подача заявки на открытие счета</span>
                                        </li>
                                    </ul>
                                </div>
                                <button class="service-btn-new">
                                    <span>Оформить заявку</span>
                                </button>
                                <img src="{{ asset('new/images/icons/uslugibank.png') }}" alt="Банковские счета" class="service-image-new">
                            </div>

                            <!-- Card 4 -->
                            <div class="service-card-new" style="background: #EAECEE;">
                                <div class="service-txt">
                                    <h3 class="service-card-title">Лицензирование</h3>
                                    <ul class="service-features">
                                        <li>
                                            <svg class="check-icon" width="20" height="20" viewBox="0 0 20 20">
                                                <path d="M7 10L9 12L13 8" stroke="#191E1D" stroke-opacity="0.3" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>Получение лицензий и разрешительных документов для всех видов деятельности</span>
                                        </li>
                                    </ul>
                                </div>
                                <button class="service-btn-new">
                                    <span>Оформить заявку</span>
                                </button>
                                <img src="{{ asset('new/images/icons/uslugilicense.png') }}" alt="Лицензирование" class="service-image-new">
                            </div>

                            <!-- Card 5 -->
                            <div class="service-card-new" style="background: #F1F7F6;">
                                <div class="service-txt">
                                    <h3 class="service-card-title">Получение визы С3 и С5</h3>
                                    <ul class="service-features">
                                        <li>
                                            <svg class="check-icon" width="20" height="20" viewBox="0 0 20 20">
                                                <path d="M7 10L9 12L13 8" stroke="#191E1D" stroke-opacity="0.3" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>Сбор документов и оформление приглашения</span>
                                        </li>
                                        <li>
                                            <svg class="check-icon" width="20" height="20" viewBox="0 0 20 20">
                                                <path d="M7 10L9 12L13 8" stroke="#191E1D" stroke-opacity="0.3" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>Оформление визы в консульстве РК</span>
                                        </li>
                                    </ul>
                                </div>
                                <button class="service-btn-new">
                                    <span>Оформить заявку</span>

                                </button>
                                <img src="{{ asset('new/images/icons/uslugivisa.png') }}" alt="Визы" class="service-image-new">
                            </div>

                            <!-- Card 6 -->
                            <div class="service-card-new" style="background: #F1EBD6;">
                                <div class="service-txt">
                                    <h3 class="service-card-title">Предоставление отраслевого юриста</h3>
                                    <ul class="service-features">
                                        <li>
                                            <svg class="check-icon" width="20" height="20" viewBox="0 0 20 20">
                                                <path d="M7 10L9 12L13 8" stroke="#191E1D" stroke-opacity="0.3" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>Услуги юриста на аутсорсе для вашего бизнеса</span>
                                        </li>
                                    </ul>
                                </div>
                                <button class="service-btn-new">
                                    <span>Оформить заявку</span>
                                </button>
                                <img src="{{ asset('new/images/icons/uslugilaw.png') }}" alt="Юрист" class="service-image-new">
                            </div>

                            <!-- Card 7 -->
                            <div class="service-card-new" style="background: #E2E8F0;">
                                <div class="service-txt">
                                    <h3 class="service-card-title">Бухгалтерский аутсорсинг</h3>
                                    <ul class="service-features">
                                        <li>
                                            <svg class="check-icon" width="20" height="20" viewBox="0 0 20 20">
                                                <path d="M7 10L9 12L13 8" stroke="#191E1D" stroke-opacity="0.3" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>Подписание документов в банке (работа с менеджером банка)</span>
                                        </li>
                                        <li>
                                            <svg class="check-icon" width="20" height="20" viewBox="0 0 20 20">
                                                <path d="M7 10L9 12L13 8" stroke="#191E1D" stroke-opacity="0.3" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>Сбор данных клиентов</span>
                                        </li>
                                    </ul>
                                </div>
                                <button class="service-btn-new">
                                    <span>Оформить заявку</span>
                                </button>
                                <img src="{{ asset('new/images/icons/uslugibuh.png') }}" alt="Бухгалтерия" class="service-image-new">
                            </div>

                            <!-- Card 8 -->
                            <div class="service-card-new" style="background: #EAECEE;">
                                <div class="service-txt">
                                    <h3 class="service-card-title">Дополнительные услуги</h3>
                                    <ul class="service-features">
                                        <li>
                                            <svg class="check-icon" width="20" height="20" viewBox="0 0 20 20">
                                                <path d="M7 10L9 12L13 8" stroke="#191E1D" stroke-opacity="0.3" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>Получение ИИН, БИН</span>
                                        </li>
                                        <li>
                                            <svg class="check-icon" width="20" height="20" viewBox="0 0 20 20">
                                                <path d="M7 10L9 12L13 8" stroke="#191E1D" stroke-opacity="0.3" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>Получение ЭЦП</span>
                                        </li>
                                        <li>
                                            <svg class="check-icon" width="20" height="20" viewBox="0 0 20 20">
                                                <path d="M7 10L9 12L13 8" stroke="#191E1D" stroke-opacity="0.3" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>Оформление РВП</span>
                                        </li>
                                    </ul>
                                </div>
                                <button class="service-btn-new">
                                    <span>Оформить заявку</span>

                                </button>
                                <img src="{{ asset('new/images/icons/uslugiplus.png') }}" alt="Дополнительные услуги" class="service-image-new">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Что входит в услугу UPPERLICENSE - Figma Design --}}
                <div class="upperlicense-section">
                    <div class="upperlicense-container">
                        <h2 class="upperlicense-title">Что входит в услугу UPPERLICENSE</h2>
                        
                        <div class="upperlicense-grid">
                            <!-- Feature 1 -->
                            <div class="upperlicense-card">
                                <img src="{{ asset('current/img/icon1.png') }}" alt="Feature 1" class="upperlicense-icon">
                                <span class="upperlicense-text">Поиск и подготовка документов по требуемой технике и мат.тех. оснащенности</span>
                            </div>

                            <!-- Feature 2 -->
                            <div class="upperlicense-card">
                                <img src="{{ asset('current/img/icon2.png') }}" alt="Feature 2" class="upperlicense-icon">
                                <span class="upperlicense-text">Оплата суммы Государственной пошлины</span>
                            </div>

                            <!-- Feature 3 -->
                            <div class="upperlicense-card">
                                <img src="{{ asset('current/img/icon3.png') }}" alt="Feature 3" class="upperlicense-icon">
                                <span class="upperlicense-text">Поиск и подготовка необходимого штата специалистов для получения оценки</span>
                            </div>

                            <!-- Feature 4 -->
                            <div class="upperlicense-card">
                                <img src="{{ asset('current/img/icon4.png') }}" alt="Feature 4" class="upperlicense-icon">
                                <span class="upperlicense-text">Заполнение анкет с прикреплением всех необходимых документов</span>
                            </div>

                            <!-- Feature 5 -->
                            <div class="upperlicense-card">
                                <img src="{{ asset('current/img/icon5.png') }}" alt="Feature 5" class="upperlicense-icon">
                                <span class="upperlicense-text">Формирование и сбор документов юр.лица</span>
                            </div>

                            <!-- Feature 6 -->
                            <div class="upperlicense-card">
                                <img src="{{ asset('current/img/icon6.png') }}" alt="Feature 6" class="upperlicense-icon">
                                <span class="upperlicense-text">Подготовка и формирование документов</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Полезная информация - Figma Design --}}
                <div class="useful-info-section">
                    <div class="useful-info-container">
                        <h2 class="useful-info-title">Полезная информация</h2>
                        
                        <div class="useful-info-grid">
                            <!-- Info Card 1 -->
                            <div class="useful-info-card">
                                <div class="useful-info-content">
                                    <svg class="useful-info-icon" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="#279760" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M14 2V8H20" stroke="#279760" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="useful-info-text-wrapper">
                                        <h3 class="useful-info-card-title">Типовые договоры</h3>
                                        <p class="useful-info-description">Шаблоны типовых договоров и документов для ведения строительной деятельности</p>
                                    </div>
                                </div>
                                <div class="useful-info-button-wrapper">
                                    <button class="useful-info-download-btn">
                                        <span>Скачать</span>
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path d="M17.5 12.5V15.8333C17.5 16.2754 17.3244 16.6993 17.0118 17.0118C16.6993 17.3244 16.2754 17.5 15.8333 17.5H4.16667C3.72464 17.5 3.30072 17.3244 2.98816 17.0118C2.67559 16.6993 2.5 16.2754 2.5 15.8333V12.5" stroke="#279760" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5.83334 8.33334L10 12.5L14.1667 8.33334" stroke="#279760" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M10 12.5V2.5" stroke="#279760" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Info Card 2 -->
                            <div class="useful-info-card">
                                <div class="useful-info-content">
                                    <svg class="useful-info-icon" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="#279760" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M14 2V8H20" stroke="#279760" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="useful-info-text-wrapper">
                                        <h3 class="useful-info-card-title">Инструкции и регламенты</h3>
                                        <p class="useful-info-description">Инструкции ведения строительной деятельности/регламенты и срок/правила</p>
                                    </div>
                                </div>
                                <div class="useful-info-button-wrapper">
                                    <button class="useful-info-download-btn">
                                        <span>Скачать</span>
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path d="M17.5 12.5V15.8333C17.5 16.2754 17.3244 16.6993 17.0118 17.0118C16.6993 17.3244 16.2754 17.5 15.8333 17.5H4.16667C3.72464 17.5 3.30072 17.3244 2.98816 17.0118C2.67559 16.6993 2.5 16.2754 2.5 15.8333V12.5" stroke="#279760" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5.83334 8.33334L10 12.5L14.1667 8.33334" stroke="#279760" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M10 12.5V2.5" stroke="#279760" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Info Card 3 -->
                            <div class="useful-info-card">
                                <div class="useful-info-content">
                                    <svg class="useful-info-icon" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="#279760" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M14 2V8H20" stroke="#279760" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="useful-info-text-wrapper">
                                        <h3 class="useful-info-card-title">ГОСТы и СНиПы</h3>
                                        <p class="useful-info-description">Строительные нормы и правила по ним</p>
                                    </div>
                                </div>
                                <div class="useful-info-button-wrapper">
                                    <button class="useful-info-download-btn">
                                        <span>Скачать</span>
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path d="M17.5 12.5V15.8333C17.5 16.2754 17.3244 16.6993 17.0118 17.0118C16.6993 17.3244 16.2754 17.5 15.8333 17.5H4.16667C3.72464 17.5 3.30072 17.3244 2.98816 17.0118C2.67559 16.6993 2.5 16.2754 2.5 15.8333V12.5" stroke="#279760" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5.83334 8.33334L10 12.5L14.1667 8.33334" stroke="#279760" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M10 12.5V2.5" stroke="#279760" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Info Card 4 -->
                            <div class="useful-info-card">
                                <div class="useful-info-content">
                                    <svg class="useful-info-icon" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="#279760" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M14 2V8H20" stroke="#279760" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="useful-info-text-wrapper">
                                        <h3 class="useful-info-card-title">Бухгалтерская учетная политика</h3>
                                        <p class="useful-info-description">Правила, сроки, формы</p>
                                    </div>
                                </div>
                                <div class="useful-info-button-wrapper">
                                    <button class="useful-info-download-btn">
                                        <span>Скачать</span>
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path d="M17.5 12.5V15.8333C17.5 16.2754 17.3244 16.6993 17.0118 17.0118C16.6993 17.3244 16.2754 17.5 15.8333 17.5H4.16667C3.72464 17.5 3.30072 17.3244 2.98816 17.0118C2.67559 16.6993 2.5 16.2754 2.5 15.8333V12.5" stroke="#279760" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5.83334 8.33334L10 12.5L14.1667 8.33334" stroke="#279760" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M10 12.5V2.5" stroke="#279760" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Info Card 5 -->
                            <div class="useful-info-card">
                                <div class="useful-info-content">
                                    <svg class="useful-info-icon" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="#279760" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M14 2V8H20" stroke="#279760" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="useful-info-text-wrapper">
                                        <h3 class="useful-info-card-title">Кадровая учетная политика</h3>
                                        <p class="useful-info-description">Шаблоны типовых договоров и документов для ведения строительной деятельности</p>
                                    </div>
                                </div>
                                <div class="useful-info-button-wrapper">
                                    <button class="useful-info-download-btn">
                                        <span>Скачать</span>
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path d="M17.5 12.5V15.8333C17.5 16.2754 17.3244 16.6993 17.0118 17.0118C16.6993 17.3244 16.2754 17.5 15.8333 17.5H4.16667C3.72464 17.5 3.30072 17.3244 2.98816 17.0118C2.67559 16.6993 2.5 16.2754 2.5 15.8333V12.5" stroke="#279760" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5.83334 8.33334L10 12.5L14.1667 8.33334" stroke="#279760" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M10 12.5V2.5" stroke="#279760" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 reviews_block mb-5">
                        <div class="container my-5">
                            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                                <div class="d-flex align-items-center">
                                    <h2 class="reviews-title mb-0 me-4">Отзывы и кейсы клиентов</h2>
                                    <a href="#" class="see-all-btn">Смотреть все</a>
                                </div>
                                <div class="d-flex align-items-center mt-3 mt-md-0">
                                    <span class="slider-counter me-3">01 / 08</span>
                                    <button class="slider-arrow me-2" aria-label="prev"><span>&lt;</span></button>
                                    <button class="slider-arrow" aria-label="next"><span>&gt;</span></button>
                                </div>
                            </div>
                            <div class="row g-4">
                                <!-- Карточка 1 -->
                                <div class="col-md-4">
                                    <div class="review-card h-100 d-flex flex-column">
                                        <div class="review-thumb position-relative">
                                            <img src="{{ asset('current/img/video-preview.png') }}" alt="Отзыв 1">
                                            <button class="play-btn" aria-label="play video">
                                                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                                    <circle cx="24" cy="24" r="24" fill="rgba(0,0,0,0.5)"/>
                                                    <polygon points="20,16 36,24 20,32" fill="#fff"/>
                                                </svg>
                                            </button>
                                            <span class="review-duration">06:24</span>
                                        </div>
                                        <div class="review-tags mb-2 mt-3">
                                            <span>СТРОИТЕЛЬСТВО</span>
                                            <span class="tag-separator">•</span>
                                            <span>ЛИЦЕНЗИРОВАНИЕ</span>
                                        </div>
                                        <div class="review-title mb-1">Уведомление о начале строительно-монтажных
                                            работ
                                        </div>
                                        <div class="review-desc mb-2">
                                            Кого же привлекает этот новое направление в моде? Неординарные, яркие,
                                            смелые в своих решениях люди, которые не боятся пробовать экспериментировать
                                            со своим образом.
                                        </div>
                                        <div class="review-meta mt-auto">
                                            <span class="review-date">
                                                <svg width="16" height="16" fill="none" stroke="#00B569"
                                                     stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18"
                                                                                                height="18" rx="2"/><path
                                                            d="M16 2v4M8 2v4M3 10h18"/></svg>
                                                10 февраля 2024
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Карточка 2 -->
                                <div class="col-md-4">
                                    <div class="review-card h-100 d-flex flex-column">
                                        <div class="review-thumb position-relative">
                                            <img src="{{ asset('current/img/video-preview2.png') }}" alt="Отзыв 2">
                                            <button class="play-btn" aria-label="play video">
                                                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                                    <circle cx="24" cy="24" r="24" fill="rgba(0,0,0,0.5)"/>
                                                    <polygon points="20,16 36,24 20,32" fill="#fff"/>
                                                </svg>
                                            </button>
                                            <span class="review-duration">06:24</span>
                                        </div>
                                        <div class="review-tags mb-2 mt-3">
                                            <span>СТРОИТЕЛЬСТВО</span>
                                            <span class="tag-separator">•</span>
                                            <span>МЕДИЦИНА</span>
                                        </div>
                                        <div class="review-title mb-1">Медицинские лицензии для расширения спектра
                                            услуг
                                        </div>
                                        <div class="review-desc mb-2">
                                            Кого же привлекает этот новое направление в моде? Неординарные, яркие,
                                            смелые в своих решениях люди, которые не боятся пробовать экспериментировать
                                            со своим образом.
                                        </div>
                                        <div class="review-meta mt-auto">
                                            <span class="review-date">
                                                <svg width="16" height="16" fill="none" stroke="#00B569"
                                                     stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18"
                                                                                                height="18" rx="2"/><path
                                                            d="M16 2v4M8 2v4M3 10h18"/></svg>
                                                10 февраля 2024
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Карточка 3 -->
                                <div class="col-md-4">
                                    <div class="review-card h-100 d-flex flex-column">
                                        <div class="review-thumb position-relative">
                                            <img src="{{ asset('current/img/video-preview3.png') }}" alt="Отзыв 3">
                                            <button class="play-btn" aria-label="play video">
                                                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                                    <circle cx="24" cy="24" r="24" fill="rgba(0,0,0,0.5)"/>
                                                    <polygon points="20,16 36,24 20,32" fill="#fff"/>
                                                </svg>
                                            </button>
                                            <span class="review-duration">06:24</span>
                                        </div>
                                        <div class="review-tags mb-2 mt-3">
                                            <span>ЛИЦЕНЗИРОВАНИЕ</span>
                                            <span class="tag-separator">•</span>
                                            <span>СТРОИТЕЛЬСТВО</span>
                                        </div>
                                        <div class="review-title mb-1">Медицинские лицензии для расширения спектра
                                            услуг
                                        </div>
                                        <div class="review-desc mb-2">
                                            Кого же привлекает этот новое направление в моде? Неординарные, яркие,
                                            смелые в своих решениях люди, которые не боятся пробовать экспериментировать
                                            со своим образом.
                                        </div>
                                        <div class="review-meta mt-auto">
                                            <span class="review-date">
                                                <svg width="16" height="16" fill="none" stroke="#00B569"
                                                     stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18"
                                                                                                height="18" rx="2"/><path
                                                            d="M16 2v4M8 2v4M3 10h18"/></svg>
                                                10 февраля 2024
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-4 d-block d-md-none">
                                <a href="#" class="see-all-btn">Смотреть все</a>
                            </div>
                        </div>
                    </div>

                </div>


                <style>
                    * {
                        font-family: 'Manrope', sans-serif !important;
                    }

                    /* General responsive improvements */
                    .container {
                        max-width: 100%;
                        overflow-x: hidden;
                    }

                    img {
                        max-width: 100%;
                        height: auto;
                    }

                    .row {
                        margin-left: 0;
                        margin-right: 0;
                    }

                    .col-md-4, .col-md-6, .col-md-8 {
                        padding-left: 15px;
                        padding-right: 15px;
                    }

                    .construction-page {
                        background-color: #fff;
                    }

                    .step-section {
                        width: 100%;
                        display: flex;
                        justify-content: center;
                        padding: 40px 0;
                        margin-top: -300px; /* на сколько нужно поднять */
                        position: relative;
                        z-index: 2; /* чтобы перекрывала картинку */
                    }

                    .step-container {
                        box-sizing: border-box;
                        display: flex;
                        flex-direction: column;
                        padding: 25px;
                        gap: 16px;
                        width: 1320px;
                        background: #fff;
                        border: 1px solid #E8E8E8;
                    }

                    .step-header {
                        display: flex;
                        flex-direction: row;
                        align-items: center;
                        gap: 20px;
                    }

                    .step-number {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        width: 36px;
                        height: 36px;
                        background: #F8F8F8;
                        border-radius: 60px;
                        font-family: 'Manrope', sans-serif;
                        font-weight: 600;
                        font-size: 14px;
                        line-height: 20px;
                        color: #222B45;
                    }

                    .step-title {
                        font-family: 'Manrope', sans-serif;
                        font-weight: 500;
                        font-size: 32px;
                        line-height: 120%;
                        letter-spacing: -0.02em;
                        color: #191E1D;
                    }

                    .document-selection {
                        display: flex;
                        flex-direction: row;
                        gap: 20px;
                    }

                    .document-option {
                        box-sizing: border-box;
                        display: flex;
                        flex-direction: row;
                        align-items: center;
                        padding: 20px;
                        gap: 20px;
                        width: 400px;
                        height: 90px;
                        border: 1px solid #E8E8E8;
                        cursor: pointer;
                    }

                    .document-option.selected {
                        background: rgba(39, 151, 96, 0.1);
                        border: 1px solid #279760;
                    }

                    .radio-circle {
                        box-sizing: border-box;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        width: 24px;
                        height: 24px;
                        background: #fff;
                        border: 1px solid #D9D9D9;
                        border-radius: 60px;
                    }

                    .radio-dot {
                        width: 12px;
                        height: 12px;
                        background: #279760;
                        border-radius: 50%;
                    }


                    .document-content {
                        display: flex;
                        flex-direction: column;
                        gap: 10px;
                    }

                    .document-content h3 {
                        font-family: 'Manrope', sans-serif;
                        font-weight: 500;
                        font-size: 20px;
                        line-height: 120%;
                        color: #191E1D;
                    }

                    .document-content .category {
                        font-family: 'Manrope', sans-serif;
                        font-weight: 600;
                        font-size: 16px;
                        line-height: 100%;
                        color: #279760;
                    }


                    .construction-icon {
                        object-fit: contain;
                        transition: transform 0.3s ease;
                    }

                    .construction-icon:hover {
                        transform: scale(1.1);
                    }

                    .description {
                        color: #333;
                        line-height: 1.6;
                        font-size: 1.1rem;
                    }

                    .image-container {
                        margin: 2rem auto;
                        max-width: 800px;
                    }

                    .construction-main-image {
                        width: 100%;
                        height: auto;
                        border-radius: 0px;
                        box-shadow: none;
                        transition: transform 0.3s ease;
                        background: transparent;
                        mix-blend-mode: multiply;
                    }

                    .construction-main-image:hover {
                        transform: scale(1.02);
                    }

                    .step-title {
                        font-size: 24px;
                        font-weight: 500;
                        color: #333;
                        display: flex;
                        align-items: center;
                        gap: 12px;
                    }

                    .step-number {
                        color: #333;
                        margin-right: 8px;
                    }

                    .document-selection {
                        margin-top: 20px;
                    }

                    .document-option {
                        background: #fff;
                        border: 1px solid #E5E7EB;
                        border-radius: 8px;
                        padding: 20px;
                        height: 100%;
                        transition: all 0.3s ease;
                    }

                    .document-option.selected {
                        background: #F0FFF0;
                        border-color: #4CAF50;
                    }

                    .radio-container {
                        display: flex;
                        align-items: flex-start;
                        gap: 12px;
                        cursor: pointer;
                        width: 100%;
                        margin: 0;
                    }

                    .radio-container input[type="radio"] {
                        position: absolute;
                        opacity: 0;
                        cursor: pointer;
                    }

                    .radio-visual {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-shrink: 0;
                    }

                    .radio-checkmark {
                        position: relative;
                        height: 24px;
                        width: 24px;
                        background-color: #fff;
                        border: 2px solid #D9D9D9;
                        border-radius: 50%;
                        flex-shrink: 0;
                        transition: all 0.3s ease;
                    }

                    .document-option input[type="radio"]:checked ~ .radio-visual .radio-checkmark {
                        border-color: #279760;
                    }

                    .document-option input[type="radio"]:checked ~ .radio-visual .radio-checkmark:after {
                        content: "";
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        width: 12px;
                        height: 12px;
                        border-radius: 50%;
                        background: #279760;
                    }

                    .document-content {
                        flex-grow: 1;
                    }

                    .document-content h3 {
                        font-size: 16px;
                        font-weight: 500;
                        color: #333;
                        margin: 0 0 8px 0;
                    }

                    .category {
                        font-size: 14px;
                        color: #279760;
                        margin: 0;
                    }
                    .download-btn {
                        margin-left: 0 !important;
                        display: block;
                    }


                    .document-option:hover {
                        border-color: #279760;
                    }


                    .document-option.selected .radio-checkmark {
                        border-color: #279760;
                    }

                    /* Стили для чекбоксов */
                    .container_checkbox {
                        display: block;
                        position: relative;
                        padding-left: 35px;
                        margin-bottom: 12px;
                        cursor: pointer;
                        font-size: 16px;
                        user-select: none;
                    }

                    .container_checkbox input {
                        position: absolute;
                        opacity: 0;
                        cursor: pointer;
                        height: 0;
                        width: 0;
                    }

                    .checkmark {
                        position: absolute;
                        top: 0;
                        left: 0;
                        height: 24px;
                        width: 24px;
                        background-color: #fff;
                        border: 2px solid #37825D;
                        border-radius: 4px;
                        transition: all 0.3s ease;
                    }

                    .container_checkbox:hover input ~ .checkmark {
                        border-color: #279760;
                    }

                    .container_checkbox input:checked ~ .checkmark {
                        background-color: #37825D;
                        border-color: #37825D;
                    }

                    .checkmark:after {
                        content: "";
                        position: absolute;
                        display: none;
                    }

                    .container_checkbox input:checked ~ .checkmark:after {
                        display: block;
                    }

                    .container_checkbox .checkmark:after {
                        left: 8px;
                        top: 4px;
                        width: 7px;
                        height: 13px;
                        border: solid white;
                        border-width: 0 2px 2px 0;
                        transform: rotate(45deg);
                    }

                    .checkmark_incomplete:after {
                        left: 5px !important;
                        top: 9px !important;
                        width: 12px !important;
                        height: 0 !important;
                        border: solid white !important;
                        border-width: 0 0 2px 0 !important;
                        transform: rotate(0deg) !important;
                    }

                    .services__window_choices_layout {
                        padding: 10px 0;
                    }

                    .services__window-strip {
                        margin: 15px 0;
                        border-top: 1px solid #E8E8E8;
                    }

                    @media (max-width: 992px) {
                        .service-card-info,
                        .info-card {
                            margin: 0 auto 20px auto;
                            max-width: 90%;
                        }

                        .reviews_block .row {
                            margin: 0;
                        }

                        .reviews_block .col-md-4 {
                            margin-bottom: 20px;
                        }
                    }

                    @media (max-width: 768px) {
                        .document-option {
                            margin-bottom: 16px;
                        }

                        .step-title {
                            font-size: 20px;
                            flex-direction: column;
                            align-items: flex-start;
                            gap: 8px;
                        }

                        .work-type-header {
                            flex-direction: column;
                            align-items: flex-start;
                            gap: 15px;
                        }

                        .work-type-header > div:last-child {
                            align-self: flex-end;
                        }

                        .subcategory-item {
                            padding: 12px;
                        }

                        .pricing-card .card-body {
                            padding: 20px;
                        }

                        .section-title {
                            font-size: 24px;
                        }

                        .service-card {
                            height: auto;
                            min-height: 400px;
                        }

                        .card-image {
                            position: relative;
                            right: auto;
                            bottom: auto;
                            width: 100%;
                            height: auto;
                            margin-top: 20px;
                        }

                        .card-image img {
                            max-width: 200px;
                        }

                        /* Additional mobile fixes */
                        .row.g-4 {
                            margin: 0 -10px;
                        }

                        .row.g-4 > * {
                            padding: 0 10px;
                            margin-bottom: 20px;
                        }

                        .d-flex.justify-content-between {
                            flex-direction: column;
                            align-items: flex-start !important;
                        }

                        .d-flex.justify-content-between > * {
                            margin-bottom: 10px;
                        }

                        .d-flex.justify-content-between > *:last-child {
                            margin-bottom: 0;
                        }
                    }

                    .custom-radio-box {
                        transition: box-shadow 0.2s, border-color 0.2s;
                    }

                    .custom-radio-box input[type="radio"]:checked + label,
                    .custom-radio-box input[type="radio"]:checked {
                        border-color: rgb(255, 255, 255) !important;
                        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, .15);
                    }

                    .form-check-input:checked {
                        background-color: rgb(255, 255, 255);
                        border-color: rgb(255, 255, 255);
                    }

                    .form-check-input {
                        margin-top: 0.2em;
                        margin-right: 0.5em;
                        float: none;
                        position: relative;
                        top: 2px;
                    }

                    .work-types-section {
                        box-sizing: border-box;
                        display: flex;
                        flex-direction: column;
                        align-items: flex-start;
                        padding: 40px;
                        gap: 40px;
                        isolation: isolate;
                        width: 1320px;
                        margin: 0 auto;
                        background: #FFFFFF;
                        border: 1px solid #E8E8E8;
                    }

                    .step-title {
                        display: flex;
                        align-items: center;
                        gap: 20px;
                        width: 1240px;
                        font-family: 'Manrope', sans-serif;
                        font-weight: 500;
                        font-size: 32px;
                        line-height: 120%;
                        letter-spacing: -0.02em;
                        color: #191E1D;
                    }

                    .step-number {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        width: 36px;
                        height: 36px;
                        background: #F8F8F8;
                        border-radius: 60px;
                        font-weight: 600;
                        font-size: 14px;
                        color: #222B45;
                    }

                    .work-types-list {
                        display: flex;
                        flex-direction: column;
                        width: 1240px;
                        gap: 0;
                    }

                    .work-type-item {
                        display: flex;
                        flex-direction: column;
                        justify-content: center;
                        padding: 30px 0;
                        gap: 24px;
                        width: 1240px;
                        border-bottom: 1px solid #E1E1E1;
                    }

                    .work-type-header {
                        display: flex;
                        flex-direction: row;
                        align-items: center;
                        justify-content: space-between;
                        gap: 24px;
                        width: 100%;
                    }

                    .work-type-header span {
                        font-family: 'Manrope', sans-serif;
                        font-weight: 500;
                        font-size: 16px;
                        color: #191E1D;
                    }

                    .work-type-header .points {
                        font-weight: 600;
                        font-size: 16px;
                        color: #999999;
                    }

                    .work-type-header .selected {
                        font-weight: 600;
                        font-size: 16px;
                        color: #279760;
                    }

                    .work-type-content {
                        display: flex;
                        flex-direction: column;
                        gap: 20px;
                    }

                    .btn-toggle {
                        width: 24px;
                        height: 24px;
                        border: none;
                        background: none;
                        font-size: 24px;
                        line-height: 1;
                        color: #191E1D;
                        cursor: pointer;
                        padding: 0;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    }

                    /* points/selected are styled under .work-type-header */

                    .subcategory-item {
                        display: flex;
                        flex-direction: row;
                        align-items: flex-start;
                        gap: 12px;
                        padding-left: 36px;
                    }

                    .subcategory-item h4 {
                        font-weight: 500;
                        font-size: 16px;
                        color: #191E1D;
                        margin-bottom: 8px;
                    }

                    .subcategory-item p {
                        font-weight: 500;
                        font-size: 14px;
                        line-height: 150%;
                        color: #999999;
                    }

                    .radio-wrapper input,
                    .checkbox-wrapper input {
                        display: none;
                    }

                    .radio-mark,
                    .checkbox-mark {
                        display: inline-flex;
                        justify-content: center;
                        align-items: center;
                        width: 24px;
                        height: 24px;
                        border: 1px solid #D9D9D9;
                        border-radius: 60px;
                        cursor: pointer;
                    }

                    .custom-radio:checked + .radio-mark,
                    .custom-checkbox:checked + .checkbox-mark {
                        border-color: #279760;
                        background-color: #279760;
                        background-image: url("data:image/svg+xml,%3Csvg width='14' height='10' viewBox='0 0 14 10' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 5L5 9L13 1' stroke='white' stroke-width='2'/%3E%3C/svg%3E");
                        background-repeat: no-repeat;
                        background-position: center;
                    }

                    .pricing-section {
                        display: flex;
                        justify-content: space-between;
                        gap: 20px;
                        width: 1368px;
                        margin: 0 auto;
                    }

                    .pricing-card {
                        width: 650px;
                        height: 372px;
                        padding: 30px;
                        display: flex;
                        flex-direction: column;
                        justify-content: space-between;
                    }

                    .pricing-green {
                        background: #DBF1D6;
                    }

                    .pricing-beige {
                        background: #F1EBD6;
                    }

                    .pricing-header {
                        display: flex;
                        align-items: center;
                        gap: 20px;
                    }

                    .circle {
                        width: 36px;
                        height: 36px;
                        background: #fff;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-family: 'Manrope', sans-serif;
                        font-weight: 600;
                        font-size: 14px;
                        color: #222B45;
                    }

                    .pricing-header h2 {
                        font-family: 'Manrope', sans-serif;
                        font-weight: 500;
                        font-size: 32px;
                        line-height: 120%;
                        color: #191E1D;
                        margin: 0;
                    }

                    .selected-info {
                        margin-top: 16px;
                        font-family: 'Manrope', sans-serif;
                        font-size: 16px;
                        font-weight: 500;
                        line-height: 150%;
                        color: #191E1D;
                    }

                    .selected-info span {
                        color: #279760;
                    }

                    .pricing-details {
                        display: flex;
                        gap: 30px;
                        margin-top: 40px;
                    }

                    .pricing-item {
                        flex: 1;
                        display: flex;
                        flex-direction: column;
                        gap: 10px;
                    }

                    .pricing-item .label {
                        font-size: 16px;
                        font-weight: 500;
                        color: #191E1D;
                    }

                    .pricing-item .value {
                        font-size: 44px;
                        font-weight: 500;
                        color: #191E1D;
                        letter-spacing: -0.02em;
                    }

                    .pricing-actions {
                        display: flex;
                        gap: 10px;
                        margin-top: 40px;
                    }

                    .btn {
                        border: none;
                        border-radius: 60px;
                        padding: 24px;
                        font-family: 'Manrope', sans-serif;
                        font-weight: 600;
                        font-size: 16px;
                        cursor: pointer;
                        display: flex;
                        align-items: center;
                        gap: 10px;
                    }

                    .btn-green {
                        background: #279760;
                        color: #fff;
                    }

                    .btn-gray {
                        background: #F8F8F8;
                        color: #191E1D;
                    }

                    /* Instructions section (Figma) */
                    .instructions-section {
                        display: flex;
                        justify-content: center;
                        background: #fff;
                        padding: 120px 6px 0;
                    }

                    .instructions-container {
                        display: flex;
                        flex-direction: row;
                        gap: 40px;
                        max-width: 1440px;
                        width: 100%;
                    }

                    /* Left column */
                    .instructions-left {
                        display: flex;
                        flex-direction: column;
                        gap: 40px;
                        width: 518px;
                    }

                    .instructions-title {
                        font-family: 'Manrope', sans-serif;
                        font-weight: 500;
                        font-size: 40px;
                        line-height: 100%;
                        letter-spacing: -0.02em;
                        color: #191E1D;
                    }

                    .download-btn {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        gap: 10px;
                        padding: 24px;
                        width: 240px;
                        height: 68px;
                        border: 1px solid #E8E8E8;
                        border-radius: 60px;
                        background: none;
                        font-family: 'Manrope';
                        font-weight: 600;
                        font-size: 16px;
                        color: #191E1D;
                        cursor: pointer;
                    }

                    /* Right column */
                    .instructions-right {
                        width: 762px;
                    }

                    /* Accordion */
                    .accordion-item {
                        border-bottom: 1px solid #E1E1E1;
                    }

                    .accordion-header {
                        display: flex;
                        align-items: center;
                        gap: 12px;
                        width: 100%;
                        padding: 30px 0;
                        background: none;
                        border: none;
                        text-align: left;
                        cursor: pointer;
                    }

                    .accordion-header .step-number {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        width: 36px;
                        height: 36px;
                        background: #F8F8F8;
                        border-radius: 50%;
                        font-weight: 600;
                        font-size: 14px;
                        color: #222B45;
                    }

                    .accordion-header .step-text {
                        font-family: 'Manrope';
                        font-weight: 500;
                        font-size: 16px;
                        color: #191E1D;
                        flex: 1;
                    }

                    .accordion-header .icon {
                        font-size: 18px;
                        font-weight: bold;
                        color: #191E1D;
                    }

                    .accordion-body {
                        font-family: 'Manrope';
                        font-size: 14px;
                        font-weight: 500;
                        line-height: 150%;
                        color: #999;
                        padding: 0 0 30px 48px;
                    }

                    .construction-title {
                        font-family: 'Manrope', sans-serif;
                        font-weight: 500;
                        font-size: 40px;
                        line-height: 100%;
                        letter-spacing: -0.02em;
                        color: #191E1D;
                        margin: 0;
                    }

                    .construction-section {
                        display: flex;
                        flex-direction: column;
                        align-items: flex-start;
                        padding: 120px 6px 0;
                        gap: 40px;
                        max-width: 1440px;
                        margin: 0 auto;
                    }

                    .construction-description {
                        font-family: 'Manrope', sans-serif;
                        font-weight: 500;
                        font-size: 16px;
                        line-height: 120%;
                        color: #191E1D;
                        margin: 0;
                        max-width: 1320px;
                    }

                    .construction-table {
                        display: flex;
                        flex-direction: column;
                        width: 1320px;
                        border: 1px solid #E8E8E8;
                        background: #fff;
                    }

                    .table-head {
                        background: #fff;
                        font-size: 12px;
                        font-weight: 500;
                        color: #999;
                    }

                    .table-row {
                        display: flex;
                        flex-direction: row;
                        align-items: center;
                        gap: 20px;
                        padding: 20px 16px;
                        border-bottom: 1px solid #E8E8E8;
                    }

                    .table-row:not(.table-head) {
                        background: #F8F8F8;
                        font-size: 14px;
                        font-weight: 500;
                        color: #191E1D;
                    }

                    .table-row .col:nth-child(1) {
                        width: 516px;
                    }

                    .table-row .col:nth-child(2),
                    .table-row .col:nth-child(3) {
                        width: 366px;
                    }

                    .pricing-card h2 {
                        font-size: 24px;
                        font-weight: 500;
                        color: #333;
                    }

                    .selected-info, .express-info {
                        color: #666;
                        font-size: 14px;
                    }

                    .price-label {
                        color: #666;
                        font-size: 14px;
                        margin-bottom: 8px;
                    }

                    .price-value {
                        font-size: 24px;
                        font-weight: 500;
                        color: #333;
                    }

                    .btn-success {
                        background-color: #4CAF50;
                        border-color: #4CAF50;
                        padding: 12px 24px;
                        font-weight: 500;
                        border-radius: 25px;
                    }

                    .btn-success:hover {
                        background-color: #45a049;
                        border-color: #45a049;
                    }

                    .btn-outline-success {
                        color: #4CAF50;
                        border-color: #4CAF50;
                        padding: 12px 24px;
                        font-weight: 500;
                        border-radius: 25px;
                    }

                    .btn-outline-success:hover {
                        background-color: #4CAF50;
                        color: #fff;
                    }

                    .fa-bolt {
                        font-size: 24px;
                    }


                    /* New Services Section - Figma Design */
                    .services-section-new {
                        width: 100%;
                        background: #FFFFFF;
                        padding: 120px 0;
                        display: flex;
                        justify-content: center;
                    }

                    .services-container {
                        max-width: 1440px;
                        width: 100%;
                        padding: 0 60px;
                    }

                    .services-main-title {
                        font-family: 'Manrope', sans-serif;
                        font-style: normal;
                        font-weight: 500;
                        font-size: 52px;
                        line-height: 100%;
                        text-align: center;
                        letter-spacing: -0.02em;
                        color: #191E1D;
                        margin-bottom: 60px;
                    }

                    .services-main-title .text-green {
                        color: #279760;
                    }

                    .services-grid {
                        display: grid;
                        grid-template-columns: repeat(2, 650px);
                        gap: 20px;
                        justify-content: center;
                    }

                    .service-card-new {
                        position: relative;
                        width: 650px;
                        height: 520px;
                        padding: 30px;
                        display: flex;
                        flex-direction: column;
                        overflow: hidden;
                    }

                    .service-txt {
                        display: flex;
                        flex-direction: column;
                        gap: 24px;
                        width: 590px;
                        z-index: 2;
                        position: relative;
                    }

                    .service-card-title {
                        font-family: 'Manrope', sans-serif;
                        font-style: normal;
                        font-weight: 500;
                        font-size: 28px;
                        line-height: 120%;
                        letter-spacing: -0.02em;
                        color: #191E1D;
                        margin: 0;
                    }

                    .service-features {
                        display: flex;
                        flex-direction: column;
                        gap: 10px;
                        list-style: none;
                        padding: 0;
                        margin: 0;
                    }

                    .service-features li {
                        display: flex;
                        align-items: flex-start;
                        gap: 4px;
                    }

                    .check-icon {
                        flex-shrink: 0;
                        margin-top: 2px;
                    }

                    .service-features li span {
                        font-family: 'Manrope', sans-serif;
                        font-style: normal;
                        font-weight: 500;
                        font-size: 14px;
                        line-height: 150%;
                        color: #191E1D;
                    }

                    .service-btn-new {
                        display: flex;
                        flex-direction: row;
                        justify-content: center;
                        align-items: center;
                        padding: 24px;
                        gap: 24px;
                        width: 186px;
                        height: 64px;
                        background: #FFFFFF;
                        border-radius: 60px;
                        border: none;
                        cursor: pointer;
                        position: absolute;
                        bottom: 30px;
                        left: 30px;
                        z-index: 2;
                        transition: all 0.3s ease;
                    }

                    .service-btn-new span {
                        font-family: 'Manrope', sans-serif;
                        font-style: normal;
                        font-weight: 600;
                        font-size: 16px;
                        line-height: 100%;
                        text-align: right;
                        color: #191E1D;
                        white-space: nowrap;
                        overflow: hidden;
                        text-overflow: ellipsis;
                        max-width: 138px;
                    }

                    .service-btn-new:hover {
                        background: #279760;
                    }

                    .service-btn-new:hover span {
                        color: #FFFFFF;
                    }

                    .service-btn-new:hover .arrow-icon path {
                        stroke: #FFFFFF;
                    }

                    .arrow-icon {
                        flex-shrink: 0;
                    }

                    .service-image-new {
                        position: absolute;
                        width: 378px;
                        height: 482px;
                        right: 0;
                        top: 130px;
                        object-fit: contain;
                        z-index: 1;
                    }

                    /* Responsive adjustments */
                    @media (max-width: 1440px) {
                        .services-grid {
                            grid-template-columns: repeat(2, 1fr);
                            max-width: 1320px;
                            margin: 0 auto;
                        }

                        .service-card-new {
                            width: 100%;
                            max-width: 650px;
                        }

                        .service-txt {
                            width: 100%;
                            max-width: 590px;
                        }
                    }

                    @media (max-width: 992px) {
                        .services-container {
                            padding: 0 30px;
                        }

                        .services-main-title {
                            font-size: 36px;
                            margin-bottom: 40px;
                        }

                        .services-grid {
                            grid-template-columns: 1fr;
                            gap: 20px;
                        }

                        .service-card-new {
                            height: auto;
                            min-height: 400px;
                            padding: 20px;
                        }

                        .service-txt {
                            width: 100%;
                        }

                        .service-image-new {
                            width: 250px;
                            height: 250px;
                            top: auto;
                            bottom: 80px;
                            right: 20px;
                        }

                        .service-btn-new {
                            left: 20px;
                            bottom: 20px;
                        }
                    }

                    @media (max-width: 768px) {
                        .services-main-title {
                            font-size: 28px;
                        }

                        .service-card-title {
                            font-size: 22px;
                        }

                        .service-card-new {
                            min-height: 350px;
                        }

                        .service-image-new {
                            width: 200px;
                            height: 200px;
                        }
                    }

                    @media (max-width: 480px) {
                        .services-container {
                            padding: 0 15px;
                        }

                        .services-main-title {
                            font-size: 24px;
                        }

                        .service-card-title {
                            font-size: 20px;
                        }

                        .service-btn-new {
                            width: auto;
                            padding: 16px 20px;
                        }

                        .service-btn-new span {
                            font-size: 14px;
                            max-width: 120px;
                        }

                        .service-image-new {
                            width: 150px;
                            height: 150px;
                            bottom: 70px;
                        }
                    }

                    /* Old services section styles (keeping for backward compatibility) */
                    .services-section {
                        padding: 60px 0;
                    }

                    .section-title {
                        font-size: 32px;
                        font-weight: 500;
                        line-height: 1.2;
                        margin-bottom: 8px;
                    }

                    .service-card {
                        background: #F8F9FA;
                        border-radius: 0px;
                        padding: 24px;
                        height: 520px;
                        display: flex;
                        flex-direction: column;
                        position: relative;
                        overflow: hidden;
                    }

                    .service-card.light-green {
                        background: #F0FFF0;
                    }

                    .service-card.light-gray {
                        background: #F8F9FA;
                    }

                    .service-card.light-beige {
                        background: #FFF8F0;
                    }

                    .service-card.light-purple {
                        background: #F8F0FF;
                    }

                    .service-card.light-mint {
                        background: #F0FFF8;
                    }

                    .card-content {
                        flex: 1;
                        z-index: 1;
                        display: flex;
                        flex-direction: column;
                        justify-content: space-between;
                    }

                    .service-card h3 {
                        font-size: 20px;
                        font-weight: 500;
                        margin-bottom: 16px;
                        color: #333;
                    }

                    .service-list {
                        list-style: none;
                        padding: 0;
                        margin: 0 0 24px 0;
                        flex-grow: 1;
                    }

                    .service-list li {
                        position: relative;
                        padding-left: 20px;
                        margin-bottom: 8px;
                        font-size: 14px;
                        color: #666;
                    }

                    .service-list li:before {
                        content: "";
                        position: absolute;
                        left: 0;
                        top: 8px;
                        width: 6px;
                        height: 6px;
                        border-radius: 50%;
                        background: #4CAF50;
                    }

                    .card-image {
                        position: absolute;
                        right: 24px;
                        bottom: -44px;
                        width: 390px;
                        height: 390px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    }

                    .card-image img {
                        max-width: 100%;
                        height: auto;
                    }

                    .btn-outline-dark {
                        border-radius: 20px;
                        padding: 8px 24px;
                        font-size: 14px;
                        font-weight: 500;
                        transition: all 0.3s ease;
                        align-self: flex-start;
                        margin-top: auto;
                    }

                    .btn-outline-dark:hover {
                        background: #333;
                        color: #fff;
                    }

                    /* UPPERLICENSE Section - Figma Design */
                    .upperlicense-section {
                        display: flex;
                        flex-direction: column;
                        align-items: flex-start;
                        padding: 120px 60px 0px;
                        gap: 40px;
                        width: 100%;
                        max-width: 1440px;
                        margin: 0 auto;
                    }

                    .upperlicense-container {
                        display: flex;
                        flex-direction: column;
                        gap: 40px;
                        width: 100%;
                        max-width: 1320px;
                    }

                    .upperlicense-title {
                        font-family: 'Manrope', sans-serif;
                        font-style: normal;
                        font-weight: 500;
                        font-size: 40px;
                        line-height: 100%;
                        letter-spacing: -0.02em;
                        color: #191E1D;
                        margin: 0;
                    }

                    .upperlicense-grid {
                        display: flex;
                        flex-direction: row;
                        flex-wrap: wrap;
                        align-items: center;
                        align-content: flex-start;
                        padding: 0px;
                        gap: 20px;
                        width: 100%;
                        max-width: 1320px;
                    }

                    .upperlicense-card {
                        box-sizing: border-box;
                        display: flex;
                        flex-direction: row;
                        align-items: center;
                        padding: 30px;
                        gap: 20px;
                        width: 650px;
                        height: 140px;
                        background: #FFFFFF;
                        border: 1px solid #E8E8E8;
                        border-radius: 0px;
                        position: relative;
                    }

                    .upperlicense-icon {
                        width: 80px;
                        height: 80px;
                        flex-shrink: 0;
                        object-fit: contain;
                    }

                    .upperlicense-text {
                        font-family: 'Manrope', sans-serif;
                        font-style: normal;
                        font-weight: 500;
                        font-size: 20px;
                        line-height: 120%;
                        letter-spacing: -0.02em;
                        color: #191E1D;
                        flex: 1;
                    }

                    /* Decorative corners (optional - as per Figma) */
                    .upperlicense-card::before,
                    .upperlicense-card::after {
                        content: '';
                        position: absolute;
                        width: 10px;
                        height: 10px;
                        border: 1px solid #279760;
                    }

                    .upperlicense-card::before {
                        top: 30px;
                        left: 30px;
                    }

                    .upperlicense-card::after {
                        bottom: 30px;
                        right: 30px;
                        transform: rotate(180deg);
                    }

                    /* Responsive adjustments */
                    @media (max-width: 1440px) {
                        .upperlicense-section {
                            padding: 100px 40px 0px;
                        }

                        .upperlicense-grid {
                            justify-content: center;
                        }

                        .upperlicense-card {
                            width: calc(50% - 10px);
                            max-width: 650px;
                        }
                    }

                    @media (max-width: 992px) {
                        .upperlicense-section {
                            padding: 80px 30px 0px;
                        }

                        .upperlicense-title {
                            font-size: 32px;
                        }

                        .upperlicense-card {
                            width: 100%;
                            height: auto;
                            min-height: 140px;
                        }

                        .upperlicense-text {
                            font-size: 18px;
                        }
                    }

                    @media (max-width: 768px) {
                        .upperlicense-section {
                            padding: 60px 20px 0px;
                        }

                        .upperlicense-title {
                            font-size: 28px;
                        }

                        .upperlicense-card {
                            padding: 20px;
                            gap: 15px;
                        }

                        .upperlicense-icon {
                            width: 60px;
                            height: 60px;
                        }

                        .upperlicense-text {
                            font-size: 16px;
                        }

                        .upperlicense-card::before {
                            top: 20px;
                            left: 20px;
                        }

                        .upperlicense-card::after {
                            bottom: 20px;
                            right: 20px;
                        }
                    }

                    @media (max-width: 480px) {
                        .upperlicense-section {
                            padding: 40px 15px 0px;
                            gap: 30px;
                        }

                        .upperlicense-title {
                            font-size: 24px;
                        }

                        .upperlicense-card {
                            padding: 15px;
                            gap: 12px;
                            min-height: 120px;
                        }

                        .upperlicense-icon {
                            width: 50px;
                            height: 50px;
                        }

                        .upperlicense-text {
                            font-size: 14px;
                        }
                    }

                    /* Old service-card-info styles (keeping for backward compatibility) */
                    .service-card-info,
                    .info-card {
                        width: 100%;
                        max-width: 100%;
                        min-height: 140px;
                        gap: 20px;
                        opacity: 1;
                        padding: 20px;
                        border-width: 1px;
                        border-style: solid;
                        border-color: #E0E0E0;
                        border-radius: 0px;
                        background: #fff;
                        box-sizing: border-box;
                        display: flex;
                        align-items: center;
                        margin-bottom: 20px;
                        flex-wrap: wrap;
                    }

                    /* Useful Info Section - Figma Design */
                    .useful-info-section {
                        display: flex;
                        flex-direction: column;
                        align-items: flex-start;
                        padding: 120px 60px 0px;
                        gap: 40px;
                        width: 100%;
                        max-width: 1440px;
                        margin: 0 auto;
                    }

                    .useful-info-container {
                        display: flex;
                        flex-direction: column;
                        gap: 40px;
                        width: 100%;
                        max-width: 1320px;
                    }

                    .useful-info-title {
                        font-family: 'Manrope', sans-serif;
                        font-style: normal;
                        font-weight: 500;
                        font-size: 40px;
                        line-height: 100%;
                        letter-spacing: -0.02em;
                        color: #191E1D;
                        margin: 0;
                    }

                    .useful-info-grid {
                        display: flex;
                        flex-direction: row;
                        flex-wrap: wrap;
                        justify-content: space-between;
                        align-items: center;
                        align-content: flex-start;
                        padding: 0px;
                        gap: 20px;
                        width: 100%;
                        max-width: 1320px;
                    }

                    .useful-info-card {
                        box-sizing: border-box;
                        display: flex;
                        flex-direction: row;
                        align-items: flex-start;
                        padding: 30px;
                        gap: 20px;
                        width: 650px;
                        min-height: 128px;
                        background: #FFFFFF;
                        border: 1px solid #E8E8E8;
                        border-radius: 0px;
                    }

                    .useful-info-content {
                        display: flex;
                        flex-direction: row;
                        align-items: flex-start;
                        padding: 0px;
                        gap: 20px;
                        flex: 1;
                    }

                    .useful-info-icon {
                        width: 24px;
                        height: 24px;
                        flex-shrink: 0;
                    }

                    .useful-info-text-wrapper {
                        display: flex;
                        flex-direction: column;
                        align-items: flex-start;
                        padding: 0px;
                        gap: 10px;
                        flex: 1;
                    }

                    .useful-info-card-title {
                        font-family: 'Manrope', sans-serif;
                        font-style: normal;
                        font-weight: 500;
                        font-size: 20px;
                        line-height: 120%;
                        letter-spacing: -0.02em;
                        color: #191E1D;
                        margin: 0;
                    }

                    .useful-info-description {
                        font-family: 'Manrope', sans-serif;
                        font-style: normal;
                        font-weight: 500;
                        font-size: 14px;
                        line-height: 150%;
                        color: #999999;
                        margin: 0;
                    }

                    .useful-info-button-wrapper {
                        display: flex;
                        flex-direction: column;
                        justify-content: center;
                        align-items: center;
                        padding: 0px;
                        gap: 10px;
                        align-self: stretch;
                    }

                    .useful-info-download-btn {
                        box-sizing: border-box;
                        display: flex;
                        flex-direction: row;
                        justify-content: center;
                        align-items: center;
                        padding: 24px;
                        gap: 10px;
                        width: 143px;
                        height: 68px;
                        background: #FFFFFF;
                        border: 1px solid #E8E8E8;
                        border-radius: 60px;
                        cursor: pointer;
                        transition: all 0.3s ease;
                    }

                    .useful-info-download-btn span {
                        font-family: 'Manrope', sans-serif;
                        font-style: normal;
                        font-weight: 600;
                        font-size: 16px;
                        line-height: 100%;
                        text-align: right;
                        color: #191E1D;
                    }

                    .useful-info-download-btn svg {
                        flex-shrink: 0;
                    }

                    .useful-info-download-btn:hover {
                        background: #279760;
                        border-color: #279760;
                    }

                    .useful-info-download-btn:hover span {
                        color: #FFFFFF;
                    }

                    .useful-info-download-btn:hover svg path {
                        stroke: #FFFFFF;
                    }

                    /* Responsive adjustments */
                    @media (max-width: 1440px) {
                        .useful-info-section {
                            padding: 100px 40px 0px;
                        }

                        .useful-info-card {
                            width: calc(50% - 10px);
                            max-width: 650px;
                        }
                    }

                    @media (max-width: 992px) {
                        .useful-info-section {
                            padding: 80px 30px 0px;
                        }

                        .useful-info-title {
                            font-size: 32px;
                        }

                        .useful-info-card {
                            width: 100%;
                            flex-direction: column;
                            min-height: auto;
                        }

                        .useful-info-content {
                            width: 100%;
                        }

                        .useful-info-button-wrapper {
                            width: 100%;
                            align-items: flex-start;
                        }

                        .useful-info-download-btn {
                            width: auto;
                        }
                    }

                    @media (max-width: 768px) {
                        .useful-info-section {
                            padding: 60px 20px 0px;
                        }

                        .useful-info-title {
                            font-size: 28px;
                        }

                        .useful-info-card {
                            padding: 20px;
                            gap: 15px;
                        }

                        .useful-info-card-title {
                            font-size: 18px;
                        }

                        .useful-info-description {
                            font-size: 13px;
                        }

                        .useful-info-download-btn {
                            padding: 20px;
                            height: 60px;
                        }
                    }

                    @media (max-width: 480px) {
                        .useful-info-section {
                            padding: 40px 15px 0px;
                            gap: 30px;
                        }

                        .useful-info-title {
                            font-size: 24px;
                        }

                        .useful-info-card {
                            padding: 15px;
                            gap: 12px;
                        }

                        .useful-info-card-title {
                            font-size: 16px;
                        }

                        .useful-info-description {
                            font-size: 12px;
                        }

                        .useful-info-icon {
                            width: 20px;
                            height: 20px;
                        }

                        .useful-info-download-btn {
                            padding: 16px;
                            height: 52px;
                            font-size: 14px;
                        }
                    }

                    /* Old info-card styles (keeping for backward compatibility) */
                    .info-card {
                        min-height: 136px;
                    }

                    .service-card-info img {
                        width: 48px;
                        height: 48px;
                        margin-right: 20px;
                        flex-shrink: 0;
                    }

                    .info-card .info-img {
                        margin-right: 20px;
                        flex-shrink: 0;
                    }

                    .info-card .info-img img {
                        width: 48px;
                        height: 48px;
                    }

                    .info-card > div:not(.info-img):not(.download-btn) {
                        flex: 1;
                        min-width: 200px;
                    }

                    .download-btn {
                        flex-shrink: 0;
                        margin-left: auto;
                    }

                    @media (max-width: 768px) {
                        .service-card-info,
                        .info-card {
                            flex-direction: column;
                            align-items: flex-start;
                            padding: 15px;
                            min-height: auto;
                        }

                        .service-card-info img,
                        .info-card .info-img {
                            margin-right: 0;
                            margin-bottom: 15px;
                        }

                        .info-card > div:not(.info-img):not(.download-btn) {
                            width: 100%;
                            min-width: unset;
                            margin-bottom: 15px;
                        }

                        .download-btn {
                            margin-left: 0;
                            align-self: flex-start;
                        }
                    }

                    @media (max-width: 480px) {
                        .container {
                            padding-left: 15px;
                            padding-right: 15px;
                        }

                        .construction-title {
                            font-size: 24px;
                        }

                        .step-title {
                            font-size: 18px;
                        }

                        .document-option {
                            padding: 15px;
                        }

                        .work-type-header {
                            padding: 15px;
                        }

                        .subcategory-item {
                            padding: 10px;
                        }

                        .pricing-card .card-body {
                            padding: 15px;
                        }

                        .section-title {
                            font-size: 20px;
                        }

                        .service-card {
                            padding: 15px;
                        }

                        .info-card {
                            padding: 15px;
                        }

                        .reviews-title {
                            font-size: 2rem;
                            text-align: center;
                        }

                        .accordion-button {
                            padding: 15px 0;
                            font-size: 16px;
                        }

                        .accordion-body {
                            padding: 0 0 15px 40px;
                            font-size: 14px;
                        }

                        /* Reviews section mobile fixes */
                        .reviews_block .container {
                            padding-left: 15px;
                            padding-right: 15px;
                        }

                        .reviews_block .d-flex {
                            flex-direction: column;
                            align-items: flex-start !important;
                        }

                        .reviews_block .d-flex .d-flex {
                            margin-top: 15px;
                            width: 100%;
                            justify-content: space-between;
                            align-items: center;
                        }

                        .see-all-btn {
                            padding: 6px 16px;
                            font-size: 13px;
                            margin-right: 0;
                            margin-bottom: 10px;
                        }

                        .slider-arrow {
                            width: 35px;
                            height: 35px;
                            font-size: 1rem;
                        }

                        .slider-counter {
                            font-size: 0.9rem;
                        }

                        .reviews_block .row.g-4 {
                            margin: 0;
                        }

                        .reviews_block .col-md-4 {
                            padding: 0 7.5px;
                            margin-bottom: 20px;
                        }
                    }

                    @media (max-width: 360px) {
                        .container {
                            padding-left: 10px;
                            padding-right: 10px;
                        }

                        .construction-title {
                            font-size: 20px;
                        }

                        .step-title {
                            font-size: 16px;
                        }

                        .section-title {
                            font-size: 18px;
                        }

                        .reviews-title {
                            font-size: 2rem;
                            text-align: center;
                        }

                        .document-option {
                            padding: 12px;
                        }

                        .work-type-header {
                            padding: 12px;
                        }

                        .subcategory-item {
                            padding: 8px;
                        }

                        .pricing-card .card-body {
                            padding: 12px;
                        }

                        .service-card {
                            padding: 12px;
                        }

                        .info-card {
                            padding: 12px;
                        }

                        .review-card {
                            margin-bottom: 15px;
                        }

                        .review-thumb {
                            height: 150px;
                        }

                        .review-title {
                            font-size: 14px;
                        }

                        .review-desc {
                            font-size: 12px;
                        }

                        .reviews_block .col-md-4 {
                            padding: 0 5px;
                            margin-bottom: 15px;
                        }

                        .see-all-btn {
                            padding: 5px 12px;
                            font-size: 12px;
                        }

                        .slider-arrow {
                            width: 30px;
                            height: 30px;
                            font-size: 0.9rem;
                        }

                        .slider-counter {
                            font-size: 0.8rem;
                        }

                        .accordion-button {
                            padding: 12px 0;
                            font-size: 14px;
                        }

                        .accordion-body {
                            padding: 0 0 12px 35px;
                            font-size: 13px;
                        }

                        .accordion-button .number {
                            width: 35px;
                            height: 35px;
                            font-size: 16px;
                        }
                    }

                    .download-btn {
                        display: inline-flex;
                        align-items: center;
                        background: #fff;
                        color: #222;
                        border: 1px solid;
                        border-radius: 24px;
                        padding: 8px 24px;
                        font-weight: 500;
                        font-size: 1rem;
                        text-decoration: none;
                        transition: background 0.2s, color 0.2s, border-color 0.2s;
                        cursor: pointer;
                    }



                    .download-icon {
                        display: flex;
                        align-items: center;
                        margin-left: 10px;
                    }

                    .download-icon svg {
                        display: block;
                        width: 20px;
                        height: 20px;
                        stroke: #00B569;
                    }

                    .reviews-title {
                        font-size: 2rem;
                        font-weight: 500;
                        margin-bottom: 0;
                        text-align: center;
                    }

                    .see-all-btn {
                        background: #fff;
                        border: 1.5px solid #E0E0E0;
                        border-radius: 24px;
                        padding: 12px 32px;
                        color: #222;
                        font-weight: 500;
                        font-size: 16px;
                        text-decoration: none !important;
                        transition: background 0.2s, color 0.2s, border-color 0.2s;
                        margin-right: 16px;
                    }

                    .see-all-btn:hover {
                        background: #e6f9f0;
                        color: #00B569;
                        border-color: #00B569;
                        text-decoration: none !important;
                    }

                    .slider-counter {
                        font-size: 1rem;
                        color: #888;
                        letter-spacing: 0.1em;
                    }

                    .slider-arrow {
                        width: 40px;
                        height: 40px;
                        border-radius: 50%;
                        border: 1.5px solid #E0E0E0;
                        background: #fff;
                        color: #222;
                        font-size: 1.2rem;
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        transition: border-color 0.2s, color 0.2s, background 0.2s;
                        margin-left: 4px;
                        margin-right: 4px;
                        cursor: pointer;
                        box-shadow: none;
                        outline: none;
                        padding: 0;
                    }


                    .review-card {
                        background: #fff;
                        border-radius: 12px;
                        overflow: hidden;
                        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
                        display: flex;
                        flex-direction: column;
                        height: 100%;
                        padding: 0;
                        margin-bottom: 20px;
                    }

                    .review-thumb {
                        position: relative;
                        width: 100%;
                        height: 200px;
                        overflow: hidden;
                    }

                    .review-thumb img {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    }

                    .play-btn {
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        background: rgba(0, 0, 0, 0.5);
                        border-radius: 50%;
                        width: 60px;
                        height: 60px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border: none;
                        cursor: pointer;
                        z-index: 10;
                    }

                    .play-btn svg {
                        width: 30px;
                        height: 30px;
                        fill: #fff;
                    }

                    .review-duration {
                        position: absolute;
                        bottom: 10px;
                        right: 10px;
                        background: rgba(0, 0, 0, 0.5);
                        color: #fff;
                        padding: 4px 8px;
                        border-radius: 12px;
                        font-size: 12px;
                        font-weight: 500;
                        z-index: 10;
                    }

                    .review-tags {
                        display: flex;
                        gap: 8px;
                        margin-bottom: 8px;
                        flex-wrap: wrap;
                        padding: 15px 15px 0 15px;
                    }

                    .review-tags span {
                        background: transparent;
                        color: #00B569;
                        padding: 0;
                        border-radius: 0;
                        font-size: 12px;
                        font-weight: 500;
                    }

                    .tag-separator {
                        color: #999;
                        margin: 0 4px;
                    }

                    .review-title {
                        font-size: 18px;
                        font-weight: 600;
                        color: #333;
                        margin-bottom: 8px;
                        padding: 0 15px;
                        line-height: 1.3;
                    }

                    .review-desc {
                        font-size: 14px;
                        color: #666;
                        line-height: 1.6;
                        margin-bottom: 15px;
                        padding: 0 15px;
                    }

                    .review-meta {
                        display: flex;
                        align-items: center;
                        gap: 10px;
                        font-size: 13px;
                        color: #888;
                        padding: 0 15px 15px 15px;
                        margin-top: auto;
                    }

                    .review-meta svg {
                        width: 16px;
                        height: 16px;
                        fill: #00B569;
                    }

                    .review-date {
                        display: flex;
                        align-items: center;
                        gap: 5px;
                    }

                    .review-date svg {
                        width: 14px;
                        height: 14px;
                        fill: #00B569;
                    }

                    /* Mobile specific styles for review cards */
                    @media (max-width: 768px) {
                        .review-card {
                            margin-bottom: 15px;
                            border-radius: 8px;
                        }

                        .review-thumb {
                            height: 180px;
                        }

                        .play-btn {
                            width: 50px;
                            height: 50px;
                        }

                        .play-btn svg {
                            width: 25px;
                            height: 25px;
                        }

                        .review-duration {
                            font-size: 11px;
                            padding: 3px 6px;
                        }

                        .review-tags {
                            padding: 12px 12px 0 12px;
                            gap: 6px;
                        }

                        .review-tags span {
                            font-size: 11px;
                        }

                        .tag-separator {
                            margin: 0 3px;
                        }

                        .review-title {
                            font-size: 16px;
                            padding: 0 12px;
                            margin-bottom: 6px;
                        }

                        .review-desc {
                            font-size: 13px;
                            padding: 0 12px;
                            margin-bottom: 12px;
                            line-height: 1.5;
                        }

                        .review-meta {
                            padding: 0 12px 12px 12px;
                            font-size: 12px;
                        }
                    }

                    @media (max-width: 480px) {
                        .review-thumb {
                            height: 160px;
                        }

                        .play-btn {
                            width: 45px;
                            height: 45px;
                        }

                        .play-btn svg {
                            width: 20px;
                            height: 20px;
                        }

                        .review-tags {
                            padding: 10px 10px 0 10px;
                        }

                        .review-tags span {
                            font-size: 10px;
                        }

                        .tag-separator {
                            margin: 0 2px;
                        }

                        .review-title {
                            font-size: 15px;
                            padding: 0 10px;
                        }

                        .review-desc {
                            font-size: 12px;
                            padding: 0 10px;
                        }

                        .review-meta {
                            padding: 0 10px 10px 10px;
                            font-size: 11px;
                        }
                    }

                    @media (max-width: 360px) {
                        .review-thumb {
                            height: 140px;
                        }

                        .play-btn {
                            width: 40px;
                            height: 40px;
                        }

                        .play-btn svg {
                            width: 18px;
                            height: 18px;
                        }

                        .review-tags {
                            padding: 8px 8px 0 8px;
                        }

                        .review-title {
                            font-size: 14px;
                            padding: 0 8px;
                        }

                        .review-desc {
                            font-size: 11px;
                            padding: 0 8px;
                        }

                        .review-meta {
                            padding: 0 8px 8px 8px;
                            font-size: 10px;
                        }
                    }

                    /* Accordion Styles */
                    .accordion-item {
                        border: none;
                        border-bottom: 1px solid #E5E7EB;
                        border-radius: 0;
                        margin-bottom: 0;
                        background: #fff;
                    }

                    .accordion-item:last-child {
                        border-bottom: none;
                    }

                    .accordion-button {
                        background: transparent;
                        border: none;
                        padding: 24px 0;
                        font-size: 18px;
                        font-weight: 500;
                        color: #191E1D;
                        text-align: left;
                        width: 100%;
                        display: flex;
                        align-items: center;
                        gap: 16px;
                        cursor: pointer;
                        transition: all 0.3s ease;
                        box-shadow: none;
                        font-family: 'Manrope', sans-serif;
                    }

                    .accordion-button:not(.collapsed) {
                        background: transparent;
                        color: #333;
                        box-shadow: none;
                    }

                    .accordion-button:focus {
                        box-shadow: none;
                        border: none;
                    }

                    .accordion-button .number {
                        width: 40px;
                        height: 40px;
                        background: #F8F9FA;
                        color: #333;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-weight: 600;
                        font-size: 18px;
                        flex-shrink: 0;
                        border: 2px solid #E5E7EB;
                        transition: all 0.3s ease;
                    }

                    .accordion-button:not(.collapsed) .number {
                        background: #4CAF50;
                        color: #fff;
                        border-color: #4CAF50;
                    }

                    .accordion-body {
                        padding: 0 0 24px 56px;
                        background: transparent;
                        color: #666;
                        line-height: 1.6;
                        font-family: 'Manrope', sans-serif;
                        font-size: 16px;
                    }

                    .accordion-button::after {
                        content: '+';
                        font-size: 24px;
                        font-weight: 400;
                        color: #999;
                        margin-left: auto;
                        transition: all 0.3s ease;
                        background: none;
                        border: none;
                        width: auto;
                        height: auto;
                    }

                    .accordion-button:not(.collapsed)::after {
                        content: '−';
                        color: #4CAF50;
                        transform: none;
                    }

                    .info-img {
                        margin-right: 20px;
                    }

                </style>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {

                        const documentOptions = document.querySelectorAll('.document-option');
                        const documentRadios = document.querySelectorAll('input[name="document_type"]');

                        documentRadios.forEach((radio, index) => {
                            radio.addEventListener('change', function () {
                                documentOptions.forEach(opt => opt.classList.remove('selected'));
                                if (this.checked) {
                                    documentOptions[index].classList.add('selected');
                                }
                            });
                        });


                        const workTypeHeaders = document.querySelectorAll('.work-type-header');
                        const workTypeRadios = document.querySelectorAll('input[name="work_type"]');

                        workTypeHeaders.forEach(header => {
                            header.addEventListener('click', function (e) {

                                if (!e.target.classList.contains('custom-radio') &&
                                    !e.target.classList.contains('radio-mark')) {
                                    const workTypeItem = this.closest('.work-type-item');
                                    const toggleButton = workTypeItem.querySelector('.btn-toggle');
                                    const wasActive = workTypeItem.classList.contains('active');


                                    document.querySelectorAll('.work-type-item').forEach(item => {
                                        item.classList.remove('active');
                                        item.querySelector('.btn-toggle').textContent = '+';
                                    });


                                    if (!wasActive) {
                                        workTypeItem.classList.add('active');
                                        toggleButton.textContent = '−';
                                    }
                                }
                            });
                        });


                        workTypeRadios.forEach(radio => {
                            radio.addEventListener('change', function () {
                                const workTypeItem = this.closest('.work-type-item');


                                document.querySelectorAll('.work-type-item').forEach(item => {
                                    item.classList.remove('active');
                                    item.querySelector('.btn-toggle').textContent = '+';
                                });


                                workTypeItem.classList.add('active');
                                workTypeItem.querySelector('.btn-toggle').textContent = '−';
                            });
                        });


                        const checkboxes = document.querySelectorAll('.custom-checkbox');
                        checkboxes.forEach(checkbox => {
                            checkbox.addEventListener('change', function () {
                                const subcategoryItem = this.closest('.subcategory-item');
                                const workTypeItem = this.closest('.work-type-item');


                                if (this.checked) {
                                    subcategoryItem.classList.add('selected');
                                } else {
                                    subcategoryItem.classList.remove('selected');
                                }


                                const selectedCount = workTypeItem.querySelectorAll('.custom-checkbox:checked').length;
                                const countElement = workTypeItem.querySelector('.selected');
                                if (countElement) {
                                    countElement.textContent = `Выбрано: ${selectedCount}`;
                                }


                                updatePricingInfo(selectedCount);
                            });
                        });


                        function updatePricingInfo(selectedCount) {
                            const selectedInfo = document.querySelector('.pricing-card .selected-info .text-success');
                            if (selectedInfo) {
                                selectedInfo.textContent = `${selectedCount} видов работ`;
                            }
                        }


                        const orderButtons = document.querySelectorAll('.btn-success');
                        orderButtons.forEach(button => {
                            button.addEventListener('click', function (e) {
                                e.preventDefault();

                                alert('Заказ оформляется...');
                            });
                        });

                        const downloadButton = document.querySelector('.btn-outline-success');
                        if (downloadButton) {
                            downloadButton.addEventListener('click', function (e) {
                                e.preventDefault();

                                alert('Скачивание КП...');
                            });
                        }
                    });
                </script>

                <script>
                    // Дополнительный JavaScript для интерактивности
                    document.addEventListener('DOMContentLoaded', function () {
                        // Селекторы документов (радио кнопки)
                        const documentOptions = document.querySelectorAll('.document-option');

                        documentOptions.forEach(option => {
                            option.addEventListener('click', function () {
                                // Убираем выделение со всех опций
                                documentOptions.forEach(opt => opt.classList.remove('selected'));
                                // Добавляем выделение к нажатой опции
                                this.classList.add('selected');
                                // Отмечаем соответствующий radio button
                                const radio = this.querySelector('input[type="radio"]');
                                if (radio) {
                                    radio.checked = true;
                                }
                            });
                        });

                        // Аккордионы для подвидов работ
                        const toggleBtns = document.querySelectorAll('.btn-toggle');

                        toggleBtns.forEach(btn => {
                            btn.addEventListener('click', function () {
                                const workTypeItem = this.closest('.work-type-item');
                                const content = workTypeItem.querySelector('.work-type-content');

                                if (workTypeItem.classList.contains('active')) {
                                    // Закрываем аккордион
                                    workTypeItem.classList.remove('active');
                                    this.textContent = '+';
                                    if (content) {
                                        content.style.display = 'none';
                                    }
                                } else {
                                    // Закрываем все остальные аккордионы
                                    document.querySelectorAll('.work-type-item.active').forEach(item => {
                                        item.classList.remove('active');
                                        const itemBtn = item.querySelector('.btn-toggle');
                                        if (itemBtn) itemBtn.textContent = '+';
                                        const itemContent = item.querySelector('.work-type-content');
                                        if (itemContent) itemContent.style.display = 'none';
                                    });

                                    // Открываем текущий аккордион
                                    workTypeItem.classList.add('active');
                                    this.textContent = '−';
                                    if (content) {
                                        content.style.display = 'block';
                                    }
                                }
                            });
                        });

                        // Чекбоксы подкатегорий
                        const subcategoryItems = document.querySelectorAll('.subcategory-item');
                        const subcategoryCheckboxes = document.querySelectorAll('.custom-checkbox');

                        subcategoryItems.forEach(item => {
                            item.addEventListener('click', function (e) {
                                if (e.target.type !== 'checkbox') {
                                    const checkbox = this.querySelector('.custom-checkbox');
                                    if (checkbox) {
                                        checkbox.checked = !checkbox.checked;
                                        updateSubcategorySelection(this, checkbox.checked);
                                    }
                                }
                            });
                        });

                        subcategoryCheckboxes.forEach(checkbox => {
                            checkbox.addEventListener('change', function () {
                                const item = this.closest('.subcategory-item');
                                updateSubcategorySelection(item, this.checked);
                            });
                        });

                        function updateSubcategorySelection(item, isSelected) {
                            if (isSelected) {
                                item.classList.add('selected');
                            } else {
                                item.classList.remove('selected');
                            }
                            updateSelectedCount();
                        }

                        function updateSelectedCount() {
                            const selectedCheckboxes = document.querySelectorAll('.custom-checkbox:checked');
                            const countElements = document.querySelectorAll('.work-type-header .selected');
                            countElements.forEach(el => {
                                if (el.textContent.includes('Выбрано:')) {
                                    el.textContent = `Выбрано: ${selectedCheckboxes.length}`;
                                }
                            });
                        }

                        // Кнопки "Оставить заявку"
                        const applicationBtns = document.querySelectorAll('.btn-success:not(.btn-outline-success)');
                        applicationBtns.forEach(btn => {
                            btn.addEventListener('click', function (e) {
                                e.preventDefault();

                                const serviceName = 'Строительно-монтажные работы';

                                if (confirm(`Оставить заявку на "${serviceName}"?`)) {
                                    showApplicationForm(serviceName);
                                }
                            });
                        });

                        function showApplicationForm(serviceName) {
                            const name = prompt('Введите ваше имя:');
                            if (!name) return;

                            const phone = prompt('Введите ваш телефон:');
                            if (!phone) return;

                            const email = prompt('Введите ваш email (необязательно):') || '';

                            alert(`Заявка принята!\n\nУслуга: ${serviceName}\nИмя: ${name}\nТелефон: ${phone}\nEmail: ${email}\n\nНаш специалист свяжется с вами в течение 30 минут.`);
                        }
                    });
                </script>
@endsection

@section('js')
<script>
$(document).ready(function () {
    // Обработчик для переключения между категориями документов
    $('input[name="document_type"]').on('change', function() {
        const selectedId = $(this).val();
        console.log('=== Переключение документа ===');
        console.log('Выбран документ ID:', selectedId);
        
        // Убираем класс selected со всех document-option
        $('.document-option').removeClass('selected');
        
        // Добавляем класс selected к выбранному
        $(this).closest('.document-option').addClass('selected');
        
        // Скрываем все контейнеры
        console.log('Всего контейнеров:', $('.service-content-container').length);
        $('.service-content-container').each(function() {
            console.log('Контейнер ID:', $(this).data('document-id'), 'Будет скрыт');
        });
        $('.service-content-container').hide();
        
        // Показываем выбранный контейнер
        const targetContainer = $(`.service-content-container[data-document-id="${selectedId}"]`);
        console.log('Целевой контейнер найден:', targetContainer.length);
        if (targetContainer.length > 0) {
            console.log('Показываем контейнер для ID:', selectedId);
            targetContainer.show();
        } else {
            console.error('Контейнер не найден для ID:', selectedId);
        }
        
        // Сбрасываем все чекбоксы
        $('.services__window_all input:checkbox').prop('checked', false);
        
        // Обновляем UI
        disableServiceAction();
        loadServiceCompare();
    });

    // Дополнительный обработчик клика по label документа
    $('.document-option').on('click', function(e) {
        // Предотвращаем двойное срабатывание если кликнули прямо на input
        if (e.target.type === 'radio') {
            return; // input сам обработает клик
        }
        
        e.preventDefault();
        e.stopPropagation();
        
        const radio = $(this).find('input[name="document_type"]');
        console.log('Клик по document-option', e.target.tagName, 'Radio ID:', radio.val(), 'Checked:', radio.is(':checked'));
        
        // Всегда переключаем на этот документ
        if (radio.length) {
            console.log('Переключаем radio на ID:', radio.val());
            
            // Снимаем checked со всех радио
            $('input[name="document_type"]').prop('checked', false);
            
            // Ставим checked на выбранный
            radio.prop('checked', true).trigger('change');
        }
    });

    // Обработчик для раскрытия/скрытия подпунктов (аккордеон)
    $(document).on('click', '.services__window-link', function () {
        let self = this;
        let parent = $(self).parents('.service-content-data-list-item')[0];
        $('.services__window-link', parent).toggleClass('d-none');
        $('.services__window_choices', parent).toggleClass('d-none');
    });

    // Обработчик для "выбрать все" чекбокса
    $(document).on('click', '.container_checkbox-all input', function () {
        let parent = $(this).parents('.service-content-data-list-item')[0];
        
        $('.services__window_all .container_checkbox input:checkbox', parent)
            .prop('checked', $(this).is(':checked'));
        $('.container_checkbox-all .checkmark', parent).removeClass('checkmark_incomplete');
        
        disableServiceAction();
        loadServiceCompare();
    });

    // Обработчик для отдельных чекбоксов
    $(document).on('click', '.services__window_all .container_checkbox input', function (e) {
        console.log('Чекбокс кликнут:', $(this).data('service-id'), 'Checked:', $(this).is(':checked'));
        
        let parent = $(this).parents('.service-content-data-list-item')[0];
        $('.container_checkbox-all input:checkbox', parent).prop('checked', false);
        
        let allItems = $('.container_checkbox input:checkbox', parent).length - 1;
        let selectedItems = $('.container_checkbox input:checkbox:checked', parent).length;
        
        console.log('Всего элементов:', allItems, 'Выбрано:', selectedItems);
        
        if(selectedItems === allItems){
            $('.container_checkbox-all input:checkbox', parent).prop('checked', true);
            $('.container_checkbox-all .checkmark', parent).removeClass('checkmark_incomplete');
        } else if(selectedItems > 0){
            $('.container_checkbox-all .checkmark', parent).addClass('checkmark_incomplete');
        } else {
            $('.container_checkbox-all .checkmark', parent).removeClass('checkmark_incomplete');
        }
        
        disableServiceAction();
        loadServiceCompare();
    });

    // Функция для включения/отключения кнопок действий
    function disableServiceAction() {
        let serviceCount = $('.services__window_all .container_checkbox input:checkbox:checked').length;
        
        console.log('disableServiceAction: выбрано услуг:', serviceCount);
        
        if (serviceCount > 0) {
            // Активируем кнопки
            console.log('Активируем кнопки');
            $('.pricing-green .btn').prop('disabled', false).removeClass('disabled');
        } else {
            // Деактивируем кнопки
            console.log('Деактивируем кнопки');
            $('.pricing-green .btn').prop('disabled', true).addClass('disabled');
        }
    }

    // Функция для загрузки и отображения расчета стоимости
    function loadServiceCompare() {
        let serviceIdList = getServiceIdList();
        
        console.log('loadServiceCompare вызвана, услуг выбрано:', serviceIdList.length);
        
        if (serviceIdList.length === 0) {
            // Сбрасываем значения
            $('.pricing-green .selected-info span').text('0 видов работ');
            $('.pricing-green .pricing-item:eq(0) .value').text('0 ₸');
            $('.pricing-green .pricing-item:eq(1) .value').text('0 дней');
            
            // Деактивируем кнопки
            $('.pricing-green .btn').prop('disabled', true);
            return;
        }

        // Отправляем AJAX запрос для получения стоимости
        $.ajax({
            type: 'POST',
            url: '{{route('api.service-totals-quick')}}',
            data: {
                '_token': "{{ csrf_token() }}",
                'serviceIdList': serviceIdList
            },
            success: function (data) {
                console.log('Результат расчета:', data);
                
                if (data.success) {
                    // Обновляем количество
                    let countText = data.count + ' ' + declension(data.count, ['вид работ', 'вида работ', 'видов работ']);
                    console.log('Обновляем количество:', countText);
                    $('.pricing-green .selected-info span').text(countText);
                    
                    // Обновляем стоимость
                    let formattedCost = Number(data.total_cost).toLocaleString('ru-RU');
                    console.log('Обновляем стоимость:', formattedCost);
                    $('.pricing-green .pricing-item:eq(0) .value').text(formattedCost + ' ₸');
                    
                    // Обновляем срок
                    let daysText = data.total_days + ' ' + declension(data.total_days, ['день', 'дня', 'дней']);
                    console.log('Обновляем срок:', daysText);
                    $('.pricing-green .pricing-item:eq(1) .value').text(daysText);
                    
                    console.log('Элементы обновлены успешно');
                }
            },
            error: function(xhr, status, error) {
                console.error('Ошибка при расчете:', error);
                console.error('Response:', xhr.responseText);
            }
        });
    }

    // Функция для получения списка ID выбранных услуг
    function getServiceIdList() {
        let serviceIdList = [];
        $('.services__window_all .container_checkbox input:checkbox:checked').each(function () {
            serviceIdList.push($(this).data('service-id'));
        });
        return serviceIdList;
    }

    // Функция для правильного склонения слов
    function declension(number, words) {
        let cases = [2, 0, 1, 1, 1, 2];
        return words[(number % 100 > 4 && number % 100 < 20) ? 2 : cases[Math.min(number % 10, 5)]];
    }

    // Обработчик для кнопки "Заказать услугу"
    $(document).on('click', '.orderService', function () {
        let serviceIdList = getServiceIdList();
        if (serviceIdList.length > 0) {
            // Перенаправляем на страницу оплаты с выбранными услугами
            const serviceListParam = serviceIdList.join(',');
            window.location.href = '/paymentInfo?serviceList=' + serviceListParam;
        }
    });

    // Обработчик для формы консультации
    $("#formConsult").submit(function (event) {
        event.preventDefault();
        
        $('#consultModal').modal('hide');
        
        // Очищаем форму
        $('#consultName').val('');
        $('#consultPhone').val('');
        $('#consultEmail').val('');
        $('#consultComment').val('');
    });

    // Обработчик для формы "Скачать КП"
    $("#formDownloadCommercialOffer").submit(function (event) {
        event.preventDefault();
        
        let serviceIdList = getServiceIdList();
        
        if (serviceIdList.length === 0) {
            return;
        }
        
        if (!$('#offerCheck_commercial_offer').is(':checked')) {
            return;
        }

        $('.formDownloadCommercialOffer_submit').attr('disabled', true);

        $.ajax({
            type: 'POST',
            url: '{{route('services.sendCommercialOffer')}}',
            data: {
                '_token': "{{ csrf_token() }}",
                'serviceIdList': serviceIdList,
                'email': $('#commercialOfferEmail').val(),
                'phone': $('#commercialOfferPhone').val(),
                'name': $('#commercialOfferName').val(),
            },
            success: function (data) {
                $('.formDownloadCommercialOffer_submit').attr('disabled', false);

                $('#commercialOfferEmail').val('');
                $('#commercialOfferPhone').val('');
                $('#commercialOfferName').val('');

                $('#downloadCommercialOfferModal').modal('hide');
                
                // Показываем модальное окно подтверждения
                setTimeout(function() {
                    $('#sendEmailConfirmModal').modal('show');
                }, 500);
            },
            error: function(xhr, status, error) {
                $('.formDownloadCommercialOffer_submit').attr('disabled', false);
                console.error('Error:', error);
            }
        });
    });

    // Инициализация при загрузке
    console.log('=== Инициализация страницы строительства ===');
    console.log('Документы на странице:');
    $('input[name="document_type"]').each(function() {
        console.log('- ID:', $(this).val(), 'Название:', $(this).siblings('.document-content').find('h3').text(), 'Checked:', $(this).is(':checked'));
    });
    
    console.log('Контейнеры на странице:');
    $('.service-content-container').each(function() {
        const docId = $(this).data('document-id');
        const visible = $(this).is(':visible');
        const hasServices = $(this).find('.container_checkbox').length;
        console.log('- Document ID:', docId, 'Видимый:', visible, 'Услуг:', hasServices);
    });
    
    disableServiceAction();
});
</script>
@endsection
