@extends('new-redesign.layouts.app')

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
                <h1 class="mb-4" style="font-family: 'Manrope', sans-serif; font-weight: 500;">{{ $rootNode->category->name ?? 'Строительство' }}</h1>
                <p class="mb-5 mx-auto" style="
                    max-width: 800px;
                    font-family: 'Manrope', sans-serif;
                    font-weight: 500;
                    font-style: normal;
                    font-size: 16px;
                    line-height: 150%;
                    letter-spacing: 0%;
                    text-align: center;
                ">
                    {{ $rootNode->category->description ?? 'Строительная сфера — одна из значимых составляющих экономики Казахстана, остается в числе наиболее привлекательных для инвесторов. Это отрасль, в которой за последние 10 лет наблюдается быстрый рост' }}
                </p>
                <div class="image-container">
                    @if(!empty($rootNode->category->img))
                        <img
                                src="{{ \Illuminate\Support\Facades\Storage::url($rootNode->category->img) }}"
                                class="construction-main-image"
                                alt="{{ $rootNode->category->name }}"
                        >
                    @else
                        <img
                                src="{{ asset('new/images/icons/constructionmain.png') }}"
                                class="construction-main-image"
                                alt="Строительство"
                        >
                    @endif
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
                                    <div class="document-option {{ $index === 0 ? 'selected' : '' }}" data-document-id="{{ $documentType->id }}">
                                        <label class="radio-container">
                                            <input type="radio" name="document_type" value="{{ $documentType->id }}" {{ $index === 0 ? 'checked' : '' }} data-pretty-url="{{ $documentType->pretty_url }}">
                                            <span class="radio-checkmark"></span>
                                            <div class="document-content">
                                                <h3>{{ $documentType->name }}</h3>
                                                @if($documentType->description)
                                                    <p class="category">{{ $documentType->description }}</p>
                                                @endif
                                            </div>
                                        </label>
                                    </div>
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
                <!-- Расчет стоимости -->
                <div class="col-md-6">
                    <div class="pricing-card bg-light-green">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <span class="step-number">3</span>
                                <h2 class="mb-0 ms-2">Расчёт стоимости</h2>
                            </div>
                            <div class="selected-info mt-2">
                                Выбрано: <span class="text-success">3 видов работ</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="price-info mb-2">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="price-label">Стоимость</div>
                                        <div class="price-value">5 500 500 ₸</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="price-label">Срок оказания услуг</div>
                                        <div class="price-value">11 дней</div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-3 mt-4">
                                <button class="btn btn-success orderService" disabled>Заказать услугу</button>
                                <button class="btn btn-outline-success service-action" data-bs-toggle="modal" data-bs-target="#downloadCommercialOfferModal" disabled>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">
                                        <path d="M21 15V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V15" stroke="#4CAF50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M7 10L12 15L17 10" stroke="#4CAF50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12 15V3" stroke="#4CAF50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Скачать КП
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Экспресс-решение -->
                <div class="col-md-6">
                    <div class="pricing-card bg-light-beige">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" fill="#FFC107" stroke="#FFC107" stroke-width="2" stroke-linejoin="round"/>
                                </svg>
                                <h2 class="mb-0 ms-2">Экспресс-решение</h2>
                            </div>
                            <div class="express-info mt-2">
                                Если поджимают сроки, воспользуйтесь готовым решением
                            </div>
                        </div>
                        <div class="card-body">


                            <div class="price-info mb-4">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="price-label">Стоимость</div>
                                        <div class="price-value">6 000 000 ₸</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="price-label">Срок оказания услуг</div>
                                        <div class="price-value">3 дня</div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success readyOffer" data-bs-toggle="modal" data-bs-target="#consultModal">Заказать услугу</button>
                        </div>
                    </div>
                </div>


                <div class="construction-page bg-white">
                    <div class="container py-4">
                        <h1 class="construction-title mb-4" style="font-family: 'Manrope', sans-serif; font-weight: 500;">Строительно-монтажные работы I категория</h1>

                        <p class="construction-description mb-4" style="font-family: 'Manrope', sans-serif;">
                            Начиная с 2005 года в Республике Казахстан были приняты шесть государственных программ,
                            направленные на строительство жилья и повышение доступности жилья для населения:
                        </p>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Услугодатель</th>
                                    <th>Срок оказания услуг</th>
                                    <th>Стоимость оказания услуг</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>КГУ «Управление градостроительного контроля». / ГУ «Управление контроля и
                                        качества городской среды города Нур-Султан»
                                    </td>
                                    <td>11 дней</td>
                                    <td>5 500 500 ₸</td>
                                </tr>
                                <tr>
                                    <td>«Управление градостроительного контроля»</td>
                                    <td>12 дней</td>
                                    <td>4 500 500 ₸</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="instructions-section my-5 bg-white">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <h2 class="instructions-title mb-4" style="font-family: 'Manrope', sans-serif; font-weight: 500; font-size: 32px; color: #333;">Инструкция и требования для получения документов</h2>
                                <div class="download-btn-wrapper mb-4">
                                    <button class="btn btn-outline-dark download-btn" style="font-family: 'Manrope', sans-serif;">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">
                                            <path d="M21 15V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V15" stroke="#333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M7 10L12 15L17 10" stroke="#333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M12 15V3" stroke="#333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Скачать требования
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="accordion" id="instructionsAccordion">
                                    <!-- Item 1 -->
                                    <div class="accordion-item">
                                        <h3 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse1">
                                                <span class="number">1</span>
                                                <span class="button-text">Инструкции ведения строительной деятельности/регламенты и срок/правила</span>
                                            </button>
                                        </h3>
                                        <div id="collapse1" class="accordion-collapse collapse"
                                             data-bs-parent="#instructionsAccordion">
                                            <div class="accordion-body">
                                                <!-- Content for item 1 -->
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Item 2 -->
                                    <div class="accordion-item">
                                        <h3 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse2">
                                                <span class="number">2</span>
                                                Оплата государственной пошлины
                                            </button>
                                        </h3>
                                        <div id="collapse2" class="accordion-collapse collapse show"
                                             data-bs-parent="#instructionsAccordion">
                                            <div class="accordion-body">
                                                Предоставим быстрое и эффективное открытие и ведение бизнеса в
                                                Казахстане. В остальных случаях расчётный счет можно открыть за один
                                                день. Сразу после подачи заявки вы получите реквизиты и сможете
                                                выставлять счета на оплату. После встречи с представителем банка
                                                появится возможность принимать деньги и совершать исходящие платежи.
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Item 3 -->
                                    <div class="accordion-item">
                                        <h3 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse3">
                                                <span class="number">3</span>
                                                Выбор необходимой категории и подготовка пакета документов для нужной
                                                категории лицензии
                                            </button>
                                        </h3>
                                        <div id="collapse3" class="accordion-collapse collapse"
                                             data-bs-parent="#instructionsAccordion">
                                            <div class="accordion-body">
                                                <!-- Content for item 3 -->
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Item 4 -->
                                    <div class="accordion-item">
                                        <h3 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse4">
                                                <span class="number">4</span>
                                                Подготовка необходимого штата инженерно-технических работников, их
                                                аттестация и внесение в Государственный реестр
                                            </button>
                                        </h3>
                                        <div id="collapse4" class="accordion-collapse collapse"
                                             data-bs-parent="#instructionsAccordion">
                                            <div class="accordion-body">
                                                <!-- Content for item 4 -->
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Item 5 -->
                                    <div class="accordion-item">
                                        <h3 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse5">
                                                <span class="number">5</span>
                                                Подготовка требуемой техники и материально - технической оснащенности
                                            </button>
                                        </h3>
                                        <div id="collapse5" class="accordion-collapse collapse"
                                             data-bs-parent="#instructionsAccordion">
                                            <div class="accordion-body">
                                                <!-- Content for item 5 -->
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Item 6 -->
                                    <div class="accordion-item">
                                        <h3 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse6">
                                                <span class="number">6</span>
                                                Регистрация на портале elicense.kz и подача заявления на лицензию онлайн
                                                с прикреплением всех документов
                                            </button>
                                        </h3>
                                        <div id="collapse6" class="accordion-collapse collapse"
                                             data-bs-parent="#instructionsAccordion">
                                            <div class="accordion-body">
                                                <!-- Content for item 6 -->
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Item 7 -->
                                    <div class="accordion-item">
                                        <h3 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse7">
                                                <span class="number">7</span>
                                                Получение оригинального комплекта документов (личное присутствие не
                                                требуется)*
                                            </button>
                                        </h3>
                                        <div id="collapse7" class="accordion-collapse collapse"
                                             data-bs-parent="#instructionsAccordion">
                                            <div class="accordion-body">
                                                <!-- Content for item 7 -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
                                        <button class="btn btn-outline-dark rounded-pill">Оформить заявку</button>
                                    </div>
                                    <div class="card-image">
                                        <img src="{{ asset('new/images/icons/documentsIcon.png') }}"
                                             alt="Регистрация компании">
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="col-md-6">
                                <div class="service-card light-green">
                                    <div class="card-content">
                                        <h3>Регистрация компаний в СЭЗ и МФЦА</h3>
                                        <ul class="service-list">
                                            <li>Регистрация в качестве участника Astana Hub International Technology
                                                Park
                                            </li>
                                        </ul>
                                        <button class="btn btn-outline-dark rounded-pill">Оформить заявку</button>
                                    </div>
                                    <div class="card-image">
                                        <img src="{{ asset('new/images/icons/astanahub.png') }}"
                                             alt="Регистрация в СЭЗ">
                                    </div>
                                </div>
                            </div>

                            <!-- Card 3 -->
                            <div class="col-md-6">
                                <div class="service-card">
                                    <div class="card-content">
                                        <h3>Открытие банковских счетов</h3>
                                        <ul class="service-list">
                                            <li>Сбор документов</li>
                                            <li>Подача заявки на открытие счета</li>
                                        </ul>
                                        <button class="btn btn-outline-dark rounded-pill">Оформить заявку</button>
                                    </div>
                                    <div class="card-image">
                                        <img src="{{ asset('new/images/icons/uslugibank.png') }}"
                                             alt="Банковские счета">
                                    </div>
                                </div>
                            </div>

                            <!-- Card 4 -->
                            <div class="col-md-6">
                                <div class="service-card light-gray">
                                    <div class="card-content">
                                        <h3>Лицензирование</h3>
                                        <ul class="service-list">
                                            <li>Получение лицензий и разрешительных документов для всех видов
                                                деятельности
                                            </li>
                                        </ul>
                                        <button class="btn btn-outline-dark rounded-pill">Оформить заявку</button>
                                    </div>
                                    <div class="card-image">
                                        <img src="{{ asset('new/images/icons/uslugilicense.png') }}"
                                             alt="Лицензирование">
                                    </div>
                                </div>
                            </div>

                            <!-- Card 5 -->
                            <div class="col-md-6">
                                <div class="service-card">
                                    <div class="card-content">
                                        <h3>Получение визы С3 и С5</h3>
                                        <ul class="service-list">
                                            <li>Сбор документов и оформление приглашения</li>
                                            <li>Оформление визы в консульстве РК</li>
                                        </ul>
                                        <button class="btn btn-outline-dark rounded-pill">Оформить заявку</button>
                                    </div>
                                    <div class="card-image">
                                        <img src="{{ asset('new/images/icons/uslugivisa.png') }}" alt="Визы">
                                    </div>
                                </div>
                            </div>

                            <!-- Card 6 -->
                            <div class="col-md-6">
                                <div class="service-card light-beige">
                                    <div class="card-content">
                                        <h3>Предоставление отраслевого юриста</h3>
                                        <ul class="service-list">
                                            <li>Услуги юриста на аутсорсе для вашего бизнеса</li>
                                        </ul>
                                        <button class="btn btn-outline-dark rounded-pill">Оформить заявку</button>
                                    </div>
                                    <div class="card-image">
                                        <img src="{{ asset('new/images/icons/uslugilaw.png') }}" alt="Юрист">
                                    </div>
                                </div>
                            </div>

                            <!-- Card 7 -->
                            <div class="col-md-6">
                                <div class="service-card light-purple">
                                    <div class="card-content">
                                        <h3>Бухгалтерский аутсорсинг</h3>
                                        <ul class="service-list">
                                            <li>Подписание документов в банке (работа с менеджером банка)</li>
                                            <li>Сбор данных клиентов</li>
                                        </ul>
                                        <button class="btn btn-outline-dark rounded-pill">Оформить заявку</button>
                                    </div>
                                    <div class="card-image">
                                        <img src="{{ asset('new/images/icons/uslugibuh.png') }}" alt="Бухгалтерия">
                                    </div>
                                </div>
                            </div>

                            <!-- Card 8 -->
                            <div class="col-md-6">
                                <div class="service-card light-mint">
                                    <div class="card-content">
                                        <h3>Дополнительные услуги</h3>
                                        <ul class="service-list">
                                            <li>Получение ИИН, БИН</li>
                                            <li>Получение ЭЦП</li>
                                            <li>Оформление РВП</li>
                                        </ul>
                                        <button class="btn btn-outline-dark rounded-pill">Оформить заявку</button>
                                    </div>
                                    <div class="card-image">
                                        <img src="{{ asset('new/images/icons/uslugiplus.png') }}"
                                             alt="Дополнительные услуги">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Что входит в услугу UPPERLICENSE --}}
                <div class="row mt-5">
                    <div class="col-12">
                        <h2 class="mb-4">Что входит в услугу UPPERLICENSE</h2>
                    </div>
                    <div class="col-md-6 mb-3 d-flex justify-content-center">
                        <div class="service-card-info">
                            <img src="{{ asset('current/img/icon1.png') }}" alt="" class="me-3">
                            <span>Поиск и подготовка документов по требуемой технике и мат.тех. оснащенности</span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 d-flex justify-content-center">
                        <div class="service-card-info">
                            <img src="{{ asset('current/img/icon2.png') }}" alt="" class="me-3">
                            <span>Оплата суммы Государственной пошлины</span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 d-flex justify-content-center">
                        <div class="service-card-info">
                            <img src="{{ asset('current/img/icon3.png') }}" alt="" class="me-3">
                            <span>Поиск и подготовка необходимого штата специалистов для получения оценки</span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 d-flex justify-content-center">
                        <div class="service-card-info">
                            <img src="{{ asset('current/img/icon4.png') }}" alt="" class="me-3">
                            <span>Заполнение анкет с прикреплением всех необходимых документов</span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 d-flex justify-content-center">
                        <div class="service-card-info">
                            <img src="{{ asset('current/img/icon5.png') }}" alt="" class="me-3">
                            <span>Формирование и сбор документов юр.лица</span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 d-flex justify-content-center">
                        <div class="service-card-info">
                            <img src="{{ asset('current/img/icon6.png') }}" alt="" class="me-3">
                            <span>Подготовка и формирование документов</span>
                        </div>
                    </div>
                </div>

                {{-- Полезная информация --}}
                @if($usefulInformationList && $usefulInformationList->count() > 0)
                <div class="row mt-5">
                    <div class="col-12">
                        <h2 class="mb-4">Полезная информация</h2>
                    </div>
                    @foreach(collect($usefulInformationList)->sortBy('order_no') as $usefulInfo)
                        <div class="col-md-6 mb-3 d-flex justify-content-center">
                            <div class="info-card d-flex justify-content-between align-items-center">
                                <div class="info-img me-3">
                                    <img src="{{ asset('current/img/note.png') }}" alt="{{ $usefulInfo->name }}">
                                </div>
                                <div>
                                    <strong>{{ $usefulInfo->name }}</strong>
                                    @if($usefulInfo->short_description)
                                        <div class="text-muted small">
                                            {!! $usefulInfo->short_description !!}
                                        </div>
                                    @endif
                                </div>
                                @if(!is_null($usefulInfo->btn_name) && !is_null($usefulInfo->file_path))
                                    <a href="{{ \Illuminate\Support\Facades\Storage::url($usefulInfo->file_path) }}" class="download-btn" download>
                                        {{ $usefulInfo->btn_name }}
                                        <span class="download-icon">
                                            <svg width="20" height="20" fill="none" stroke="#00B569" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                                <path d="M12 5v14M5 12l7 7 7-7"/>
                                            </svg>
                                        </span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif    <div class="col-12 reviews_block mb-5">
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
                                @if($reviewList && $reviewList->count() > 0)
                                    @foreach($reviewList as $review)
                                        <div class="col-md-4">
                                            <div class="review-card h-100 d-flex flex-column">
                                                <div class="review-thumb position-relative">
                                                    @if($review->preview_image)
                                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($review->preview_image) }}" alt="{{ $review->title }}">
                                                    @else
                                                        <img src="{{ asset('current/img/video-preview.png') }}" alt="{{ $review->title }}">
                                                    @endif
                                                    <button class="play-btn" aria-label="play video" data-video-url="{{ $review->video_url }}">
                                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                                            <circle cx="24" cy="24" r="24" fill="rgba(0,0,0,0.5)"/>
                                                            <polygon points="20,16 36,24 20,32" fill="#fff"/>
                                                        </svg>
                                                    </button>
                                                    @if($review->duration)
                                                        <span class="review-duration">{{ $review->duration }}</span>
                                                    @endif
                                                </div>
                                                <div class="review-tags mb-2 mt-3">
                                                    @if($review->tags)
                                                        @foreach(explode(',', $review->tags) as $index => $tag)
                                                            @if($index > 0)<span class="tag-separator">•</span>@endif
                                                            <span>{{ trim(strtoupper($tag)) }}</span>
                                                        @endforeach
                                                    @else
                                                        <span>СТРОИТЕЛЬСТВО</span>
                                                    @endif
                                                </div>
                                                <div class="review-title mb-1">{{ $review->title }}</div>
                                                @if($review->description)
                                                    <div class="review-desc mb-2">
                                                        {{ Str::limit($review->description, 150) }}
                                                    </div>
                                                @endif
                                                <div class="review-meta mt-auto">
                                                    <span class="review-date">
                                                        <svg width="16" height="16" fill="none" stroke="#00B569" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                                                        {{ $review->created_at ? $review->created_at->format('d.m.Y') : '' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <!-- Fallback to mock data if no reviews -->
                                    <div class="col-md-4">
                                        <div class="review-card h-100 d-flex flex-column">
                                            <div class="review-thumb position-relative">
                                                <img src="{{ asset('current/img/video-preview.png') }}" alt="Отзыв">
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
                                            <div class="review-title mb-1">Уведомление о начале строительно-монтажных работ</div>
                                            <div class="review-desc mb-2">
                                                Отзыв клиента о получении строительной лицензии
                                            </div>
                                            <div class="review-meta mt-auto">
                                                <span class="review-date">
                                                    <svg width="16" height="16" fill="none" stroke="#00B569" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                                                    {{ now()->format('d.m.Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="text-center mt-4 d-block d-md-none">
                                <a href="#" class="see-all-btn">Смотреть все</a>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Модальные окна для КП и заказа услуг -->
                <!-- Modal: Скачать КП -->
                <div class="modal fade" id="downloadCommercialOfferModal" tabindex="-1" role="dialog" aria-labelledby="downloadCommercialOfferModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="col-12">
                                    <div class="row justify-content-end">
                                        <div class="col-lg-1 col-auto text-start">
                                            <button type="button" class="btn btn-x" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="bi bi-x-circle modals__icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="modal-body">
                                    <p class="modals__title-head">Скачать коммерческое предложение</p>
                                    <form method="post" id="formDownloadCommercialOffer">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    @if(\Illuminate\Support\Facades\Auth::guest())
                                                        <label>Укажите ваши контактные данные для получения КП</label>
                                                        <input class="form-control modals__input" type="email" id="commercialOfferEmail" placeholder="Email" required value=""/>
                                                        <input class="form-control modals__input" type="tel" name="phone" id="commercialOfferPhone" placeholder="Телефон" required value=""/>
                                                        <input class="form-control modals__input" type="text" id="commercialOfferName" placeholder="Имя" value=""/>
                                                    @else
                                                        <label>Коммерческое предложение будет отправлено на ваш email</label>
                                                        <input class="form-control modals__input" type="email" id="commercialOfferEmail" placeholder="Email" required value="{{\Illuminate\Support\Facades\Auth::user()->email}}"/>
                                                        <input class="form-control modals__input" type="tel" name="phone" id="commercialOfferPhone" placeholder="Телефон" required value="{{\Illuminate\Support\Facades\Auth::user()->profile->phone ?? ''}}"/>
                                                        <input class="form-control modals__input" type="text" id="commercialOfferName" placeholder="Имя" value="{{\Illuminate\Support\Facades\Auth::user()->name}}"/>
                                                    @endif
                                                    <div class="form-check pl-0 mt-2">
                                                        <input type="checkbox" class="form-check-input" checked id="offerCheck_commercial_offer">
                                                        <label class="form-check-label" for="offerCheck_commercial_offer">
                                                            Я принимаю условия <a href="{{route("offer")}}" target="_blank">публичной оферты</a> <span class="text-danger">*</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success modals__success_btn formDownloadCommercialOffer_submit">Отправить</button>
                                        <p class="modals__title-description">Нажимая кнопку отправить вы даете разрешение на обработку персональных данных</p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal: Подтверждение отправки -->
                <div class="modal fade" id="sendEmailConfirmModal" tabindex="-1" role="dialog" aria-labelledby="sendEmailConfirmModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="col-12">
                                    <div class="row justify-content-end">
                                        <div class="col-lg-1 col-auto text-start">
                                            <button type="button" class="btn btn-x" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="bi bi-x-circle modals__icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="modal-body text-center">
                                    <i class="bi bi-check-circle text-success" style="font-size: 64px;"></i>
                                    <p class="modals__title-head mt-3">Отправлено!</p>
                                    <p class="modals__title-description">Документ был отправлен на указанный email</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal: Консультация -->
                <div class="modal fade" id="consultModal" tabindex="-1" role="dialog" aria-labelledby="consultModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="col-12">
                                    <div class="row justify-content-end">
                                        <div class="col-lg-1 col-auto text-start">
                                            <button type="button" class="btn btn-x" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="bi bi-x-circle modals__icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="modal-body">
                                    <p class="modals__title-head">Заказать услугу</p>
                                    <p class="modals__title-description">Оставьте заявку и наш специалист свяжется с вами в течение 30 минут</p>
                                    <form method="post" id="formConsult">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <input class="form-control modals__input" type="text" id="consultName" placeholder="Имя" required value=""/>
                                                    <input class="form-control modals__input" type="tel" id="consultPhone" placeholder="Телефон" required value=""/>
                                                    <input class="form-control modals__input" type="email" id="consultEmail" placeholder="Email (необязательно)" value=""/>
                                                    <textarea class="form-control modals__input" id="consultComment" placeholder="Комментарий" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success modals__success_btn">Отправить заявку</button>
                                        <p class="modals__title-description">Нажимая кнопку отправить вы даете разрешение на обработку персональных данных</p>
                                    </form>
                                </div>
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

                    .radio-checkmark {
                        position: relative;
                        height: 20px;
                        width: 20px;
                        background-color: #fff;
                        border: 2px solid #4CAF50;
                        border-radius: 50%;
                        flex-shrink: 0;
                        margin-top: 4px;
                    }

                    .radio-container input[type="radio"]:checked ~ .radio-checkmark:after {
                        content: "";
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        width: 10px;
                        height: 10px;
                        border-radius: 50%;
                        background: #4CAF50;
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
                        color: #4CAF50;
                        margin: 0;
                    }


                    .document-option:hover {
                        border-color: #4CAF50;
                    }


                    .document-option.selected .radio-checkmark {
                        border-color: #4CAF50;
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
                        margin-bottom: 40px;
                    }

                    .step-title {
                        font-size: 24px;
                        font-weight: 500;
                        color: #333;
                        display: flex;
                        align-items: center;
                        gap: 12px;
                    }

                    .work-type-item {
                        border: 1px solid #E5E7EB;
                        border-radius: 8px;
                        margin-bottom: 16px;
                        background: #fff;
                    }

                    .work-type-header {
                        padding: 20px;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        cursor: pointer;
                    }

                    .work-type-content {
                        display: none;
                        padding: 0 20px 20px;
                        border-top: 1px solid #E5E7EB;
                    }

                    .work-type-item.active .work-type-content {
                        display: block;
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

                    .points {
                        color: #6B7280;
                        font-size: 14px;
                    }

                    .selected {
                        color: #4CAF50;
                        font-size: 14px;
                    }

                    .subcategory-item {
                        padding: 16px;
                        border: 1px solid #E5E7EB;
                        border-radius: 8px;
                        margin-top: 12px;
                    }

                    .subcategory-item.selected {
                        background-color: #F0FFF0;
                        border-color: #4CAF50;
                    }

                    .subcategory-item h4 {
                        font-size: 16px;
                        font-weight: 500;
                        margin-bottom: 8px;
                        color: #333;
                    }

                    .subcategory-item p {
                        font-size: 14px;
                        line-height: 1.5;
                        margin: 0;
                        color: #6B7280;
                    }

                    .radio-wrapper {
                        position: relative;
                        width: 20px;
                        height: 20px;
                        flex-shrink: 0;
                    }

                    .custom-radio {
                        position: absolute;
                        opacity: 0;
                        width: 100%;
                        height: 100%;
                        cursor: pointer;
                    }

                    .radio-mark {
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 20px;
                        height: 20px;
                        border: 2px solid #4CAF50;
                        border-radius: 50%;
                        background: #fff;
                    }

                    .custom-radio:checked + .radio-mark:after {
                        content: '';
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        width: 10px;
                        height: 10px;
                        background: #4CAF50;
                        border-radius: 50%;
                    }

                    .checkbox-wrapper {
                        position: relative;
                        width: 20px;
                        height: 20px;
                        flex-shrink: 0;
                    }

                    .custom-checkbox {
                        position: absolute;
                        opacity: 0;
                        width: 100%;
                        height: 100%;
                        cursor: pointer;
                    }

                    .checkbox-mark {
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 20px;
                        height: 20px;
                        border: 2px solid #4CAF50;
                        border-radius: 4px;
                        background: #fff;
                    }

                    .custom-checkbox:checked + .checkbox-mark {
                        background: #4CAF50;
                    }

                    .custom-checkbox:checked + .checkbox-mark:after {
                        content: '';
                        position: absolute;
                        top: 2px;
                        left: 6px;
                        width: 5px;
                        height: 10px;
                        border: solid white;
                        border-width: 0 2px 2px 0;
                        transform: rotate(45deg);
                    }

                    .pricing-section {
                        padding: 40px 0;
                    }

                    .pricing-card {
                        border-radius: 12px;
                        overflow: hidden;
                        height: 100%;
                    }

                    .bg-light-green {
                        background-color: #F0FFF0;
                    }

                    .bg-light-beige {
                        background-color: #FFF8F0;
                    }

                    .pricing-card .card-header {
                        padding: 24px;
                        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
                    }

                    .pricing-card .card-body {
                        padding: 40px;
                        gap: 40px;
                    }

                    .step-number {
                        width: 32px;
                        height: 32px;
                        background: #fff;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-weight: 500;
                        color: #333;
                    }

                    .construction-title {
                        font-size: 32px;
                        font-weight: 500;
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
                        border: 1.5px solid #00B569;
                        border-radius: 24px;
                        padding: 8px 24px;
                        font-weight: 500;
                        font-size: 1rem;
                        text-decoration: none;
                        transition: background 0.2s, color 0.2s, border-color 0.2s;
                        cursor: pointer;
                    }

                    .download-btn:hover {
                        background: #e6f9f0;
                        color: #00B569;
                        border-color: #00B569;
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

                    /* Стили для секции с подвидами работ */
                    .services__window-documents {
                        background: #fff;
                        padding: 20px 0;
                    }

                    .service-content-data-total {
                        background: #00B569;
                        color: #fff;
                        padding: 20px 0;
                        margin-bottom: 30px;
                        position: sticky;
                        top: 0;
                        z-index: 100;
                    }

                    .service-content-data-total-panel {
                        display: flex;
                        gap: 30px;
                        flex-wrap: wrap;
                    }

                    .service-content-data-total-panel-item {
                        display: flex;
                        align-items: center;
                        gap: 10px;
                    }

                    .service-content-data-total-panel-item-title {
                        font-size: 14px;
                        opacity: 0.9;
                    }

                    .service-content-data-total-panel-item-description {
                        font-size: 18px;
                        font-weight: 600;
                    }

                    .service-content-data-total-panel-item-icon img {
                        width: 24px;
                        height: 24px;
                    }

                    .service-content-data-total-btn {
                        display: flex;
                        gap: 15px;
                        justify-content: flex-end;
                    }

                    .service-content-data-total-btn .btn {
                        padding: 10px 24px;
                        border-radius: 25px;
                        font-weight: 500;
                    }

                    .service-content-data-list-head {
                        font-size: 16px;
                        color: #666;
                        margin-bottom: 20px;
                    }

                    .service-content-data-list-item {
                        border: 1px solid #E5E7EB;
                        border-radius: 8px;
                        margin-bottom: 16px;
                        background: #fff;
                    }

                    .service-content-data-list-item-head {
                        padding: 20px;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        cursor: pointer;
                    }

                    .service-content-data-list-item-head-main-info {
                        display: flex;
                        align-items: center;
                        gap: 15px;
                        flex: 1;
                    }

                    .service-content-data-list-item-head-point {
                        color: #6B7280;
                        font-size: 14px;
                    }

                    .service-content-data-list-item-head-additional-info {
                        display: flex;
                        align-items: center;
                        gap: 10px;
                    }

                    .services__window-link {
                        color: #00B569;
                        text-decoration: none;
                        cursor: pointer;
                        font-size: 24px;
                        line-height: 1;
                        transition: color 0.2s;
                    }

                    .services__window-link:hover {
                        color: #008f52;
                    }

                    .services__window_choices {
                        padding: 0 20px 20px;
                        border-top: 1px solid #E5E7EB;
                    }

                    .services__window_choices_layout {
                        padding: 12px 0;
                    }

                    .services__window-strip {
                        margin: 12px 0;
                        border-color: #E5E7EB;
                    }

                    .container_checkbox {
                        display: flex;
                        align-items: flex-start;
                        position: relative;
                        padding-left: 35px;
                        cursor: pointer;
                        font-size: 16px;
                        user-select: none;
                        line-height: 1.5;
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
                        top: 2px;
                        left: 0;
                        height: 20px;
                        width: 20px;
                        background-color: #fff;
                        border: 2px solid #00B569;
                        border-radius: 4px;
                    }

                    .container_checkbox:hover input ~ .checkmark {
                        background-color: #f0fff0;
                    }

                    .container_checkbox input:checked ~ .checkmark {
                        background-color: #00B569;
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
                        left: 6px;
                        top: 2px;
                        width: 5px;
                        height: 10px;
                        border: solid white;
                        border-width: 0 2px 2px 0;
                        transform: rotate(45deg);
                    }

                    .checkmark_incomplete {
                        background-color: #00B569 !important;
                        opacity: 0.5;
                    }

                    .loader-line {
                        height: 3px;
                        background: linear-gradient(90deg, transparent, #fff, transparent);
                        animation: loading 1.5s infinite;
                    }

                    @keyframes loading {
                        0% { transform: translateX(-100%); }
                        100% { transform: translateX(100%); }
                    }

                    @media (max-width: 768px) {
                        .service-content-data-total-panel {
                            flex-direction: column;
                            gap: 15px;
                        }

                        .service-content-data-total-btn {
                            flex-direction: column;
                            width: 100%;
                        }

                        .service-content-data-total-btn .btn {
                            width: 100%;
                        }

                        .service-content-data-list-item-head {
                            flex-direction: column;
                            align-items: flex-start;
                            gap: 15px;
                        }

                        .service-content-data-list-item-head-additional-info {
                            align-self: flex-end;
                        }
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
                            option.addEventListener('click', function() {
                                // Убираем выделение со всех опций
                                documentOptions.forEach(opt => opt.classList.remove('selected'));
                                // Добавляем выделение к нажатой опции
                                this.classList.add('selected');
                                // Отмечаем соответствующий radio button
                                const radio = this.querySelector('input[type="radio"]');
                                if (radio) {
                                    radio.checked = true;
                                    
                                    // Переключаем видимость контейнеров (без AJAX)
                                    const documentId = radio.value;
                                    switchServiceContent(documentId);
                                }
                            });
                        });
                        
                        // Функция для переключения контейнеров на фронте
                        function switchServiceContent(documentId) {
                            // Скрываем все контейнеры
                            const allContainers = document.querySelectorAll('.service-content-container');
                            allContainers.forEach(container => {
                                container.style.display = 'none';
                            });
                            
                            // Показываем нужный контейнер
                            const targetContainer = document.querySelector(`.service-content-container[data-document-id="${documentId}"]`);
                            if (targetContainer) {
                                targetContainer.style.display = 'block';
                                
                                // Прокручиваем к секции с подвидами работ
                                const workTypesSection = document.querySelector('.work-types-section');
                                if (workTypesSection) {
                                    const header = document.querySelector('.header-new');
                                    const headerHeight = header ? header.offsetHeight : 0;
                                    const position = workTypesSection.offsetTop - headerHeight - 20;
                                    window.scrollTo({
                                        top: position,
                                        behavior: 'smooth'
                                    });
                                }
                            }
                        }
                        
                        // Аккордионы для подвидов работ
                        const toggleBtns = document.querySelectorAll('.btn-toggle');
                        
                        toggleBtns.forEach(btn => {
                            btn.addEventListener('click', function() {
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
                            item.addEventListener('click', function(e) {
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
                            checkbox.addEventListener('change', function() {
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
                            btn.addEventListener('click', function(e) {
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
    // Обработчик для раскрытия/скрытия подпунктов (аккордеон)
    $(document).on('click', '.services__window-link', function () {
        let self = this
        let parent = $(self).parents('.service-content-data-list-item')[0]
        $('.services__window-link', parent).toggleClass('d-none')
        $('.services__window_choices', parent).toggleClass('d-none')
    });

    // Обработчик для "выбрать все" чекбокса
    $(document).on('click', '.container_checkbox-all input', function () {
        let parent = $(this).parents('.service-content-data-list-item')[0];
        
        $('.services__window_all .container_checkbox input:checkbox', parent)
            .prop('checked', $(this).is(':checked'));
        $('.container_checkbox-all .checkmark', parent).removeClass('checkmark_incomplete');
        
        disableServiceAction()
        loadServiceCompare()
    })

    // Обработчик для отдельных чекбоксов
    $(document).on('click', '.services__window_all .container_checkbox input', function () {
        console.log('Чекбокс кликнут:', $(this).data('service-id'));
        
        let parent = $(this).parents('.service-content-data-list-item')[0];
        $('.container_checkbox-all input:checkbox', parent).prop('checked', false)
        
        let allItems = $('.container_checkbox input:checkbox', parent).length - 1
        let selectedItems = $('.container_checkbox input:checkbox:checked', parent).length
        
        if(selectedItems === allItems){
            $('.container_checkbox-all input:checkbox', parent).prop('checked', true)
            $('.container_checkbox-all .checkmark', parent).removeClass('checkmark_incomplete');
        } else if(selectedItems > 0){
            $('.container_checkbox-all .checkmark', parent).addClass('checkmark_incomplete');
        } else {
            $('.container_checkbox-all .checkmark', parent).removeClass('checkmark_incomplete');
        }
        
        disableServiceAction()
        loadServiceCompare()
    })

    // Функция для включения/отключения кнопок действий
    function disableServiceAction() {
        if ($('.services__window_all .container_checkbox input:checkbox:checked').length > 0) {
            $('.service-action').prop('disabled', false)
        } else {
            $('.service-action').prop('disabled', true)
        }
    }

    // Функция для загрузки расчета стоимости (БЫСТРЫЙ API)
    function loadServiceCompare() {
        let selectedCount = $('.services__window_all .container_checkbox input:checkbox:checked').length;
        console.log('loadServiceCompare вызвана, выбрано услуг:', selectedCount);
        
        if (selectedCount > 0) {
            let serviceIds = getServiceIdList();
            console.log('ID выбранных услуг:', serviceIds);
            
            // Показываем индикатор загрузки
            $('.service-content-data-total .loader-line').removeClass('d-none')
            
            // Используем НОВЫЙ СУПЕР-БЫСТРЫЙ API endpoint (один SQL запрос)
            $.ajax({
                type: 'POST',
                url: '{{route('api.service-totals-quick')}}',
                data: {
                    '_token': "{{ csrf_token() }}",
                    'serviceId': serviceIds
                },
                success: function (response) {
                    console.log('✅ Получены данные от сервера (JSON):', response);
                    $('.service-content-data-total .loader-line').addClass('d-none')
                    
                    if (response.success) {
                        // Обновляем количество выбранных услуг в оригинальной секции "Расчет стоимости"
                        $('.pricing-card .selected-info .text-success').text(response.count + ' видов работ')
                        console.log('Обновлено количество:', response.count);
                        
                        // Обновляем стоимость
                        console.log('Рассчитана стоимость:', response.total_cost);
                        $('.pricing-card .price-value').first().text(response.total_cost.toLocaleString('ru-RU') + ' ₸')
                        
                        // Обновляем срок
                        console.log('Рассчитан срок:', response.total_days);
                        $('.pricing-card .price-value').eq(1).text(response.total_days + ' дней')
                        
                        // Обновляем в верхней панели (если есть)
                        $('.service-content-data-total-panel .cnt span').text(response.count)
                        $('.service-content-data-total-panel .price span').text(response.total_cost.toLocaleString('ru-RU'))
                        $('.service-content-data-total-panel .day_cnt span').text(response.total_days)
                        
                        // Активируем кнопки в секции "Расчет стоимости"
                        $('.pricing-card .btn').prop('disabled', false)
                        console.log('✅ Кнопки активированы');

                        // Также активируем кнопки в верхней панели
                        $('.service-content-data-total-btn .btn').prop('disabled', false)
                        console.log('✅ Кнопки в верхней панели активированы');
                    } else {
                        console.error('❌ Ошибка в ответе:', response.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('❌ Ошибка при расчете:', error);
                    console.error('Статус:', status);
                    console.error('Ответ сервера:', xhr.responseText);
                    $('.service-content-data-total .loader-line').addClass('d-none')
                }
            });
        } else {
            console.log('Нет выбранных услуг, сбрасываем значения');
            // Сбрасываем значения
            $('.pricing-card .selected-info .text-success').text('0 видов работ')
            $('.pricing-card .price-value').first().text('0 ₸')
            $('.pricing-card .price-value').eq(1).text('0 дней')
            $('.service-content-data-total-panel .cnt span').text('0')
            $('.service-content-data-total-panel .price span').text('0')
            $('.service-content-data-total-panel .day_cnt span').text('0')
            
            // Деактивируем кнопки
            $('.pricing-card .btn').prop('disabled', true)
            $('.service-content-data-total-btn .btn').prop('disabled', true)
        }
    }

    // Функция для получения списка ID выбранных услуг
    function getServiceIdList() {
        let serviceIdList = [];
        $('.services__window_all .container_checkbox input:checkbox:checked').each(function () {
            serviceIdList.push($(this).data('service-id'))
        });
        return serviceIdList;
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

                $('#commercialOfferEmail').val('')
                $('#commercialOfferPhone').val('')
                $('#commercialOfferName').val('')

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

    // Функция для получения имен выбранных услуг
    function getServiceNameList() {
        let result = '<ul>';
        $('.services__window_all .container_checkbox input:checkbox:checked').each(function () {
            result += "<li>" + $(this).data('name') + "</li>";
        });
        result += '</ul>';
        return result;
    }
});
</script>
@endsection
