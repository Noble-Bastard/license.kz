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
                <h1 class="mb-4" style="font-family: 'Manrope', sans-serif; font-weight: 500;">Строительство</h1>
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
                            <div class="col-md-4">
                                <div class="document-option selected">
                                    <label class="radio-container">
                                        <input type="radio" name="document_type" checked>
                                        <span class="radio-checkmark"></span>
                                        <div class="document-content">
                                            <h3>Строительно-монтажные работы</h3>
                                            <p class="category">I категория</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="document-option">
                                    <label class="radio-container">
                                        <input type="radio" name="document_type">
                                        <span class="radio-checkmark"></span>
                                        <div class="document-content">
                                            <h3>Строительно-монтажные работы</h3>
                                            <p class="category">II категория</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="document-option">
                                    <label class="radio-container">
                                        <input type="radio" name="document_type">
                                        <span class="radio-checkmark"></span>
                                        <div class="document-content">
                                            <h3>Строительно-монтажные работы</h3>
                                            <p class="category">III категория</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="work-types-section mt-5">

                <h2 class="step-title mb-4" style="font-family: 'Manrope', sans-serif;">
                    <span class="step-number">2</span>
                    Выберите подвиды работ, чтобы узнать точные стоимость и сроки
                </h2>

                <div class="work-types-list">
                    <!-- Первый блок (закрытый) -->
                    <div class="work-type-item">
                        <div class="work-type-header">
                            <div class="d-flex align-items-center">
                                <div class="radio-wrapper me-3">
                                    <input type="radio" name="work_type" class="custom-radio">
                                    <span class="radio-mark"></span>
                                </div>
                                <span>Каковы сроки регистрации бизнеса в Казахстане?</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="points me-3">15 пунктов</span>
                                <button class="btn-toggle">+</button>
                            </div>
                        </div>
                    </div>

                    <!-- Второй блок (открытый) -->
                    <div class="work-type-item active">
                        <div class="work-type-header">
                            <div class="d-flex align-items-center">
                                <div class="radio-wrapper me-3">
                                    <input type="radio" name="work_type" class="custom-radio" checked>
                                    <span class="radio-mark"></span>
                                </div>
                                <span>Каковы сроки регистрации бизнеса в Казахстане?</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="selected me-3">Выбрано: 3</span>
                                <button class="btn-toggle">−</button>
                            </div>
                        </div>
                        <div class="work-type-content">
                            <div class="subcategory-list">
                                @for ($i = 1; $i <= 5; $i++)
                                    <div class="subcategory-item @if($i == 3 || $i == 5) selected @endif">
                                        <div class="d-flex align-items-start">
                                            <div class="checkbox-wrapper me-3">
                                                <input type="checkbox" class="custom-checkbox"
                                                       @if($i == 3 || $i == 5) checked @endif>
                                                <span class="checkbox-mark"></span>
                                            </div>
                                            <div>
                                                <h4>СМР I категория.</h4>
                                                <p>Специальные строительные и монтажные работы по прокладке линейных
                                                    сооружений,
                                                    включающие капитальный ремонт и реконструкцию, в том числе:
                                                    магистральных
                                                    линий электропередач с напряжением до 35 кВ и до 110 кВ и выше</p>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <!-- Третий блок (закрытый) -->
                    <div class="work-type-item">
                        <div class="work-type-header">
                            <div class="d-flex align-items-center">
                                <div class="radio-wrapper me-3">
                                    <input type="radio" name="work_type" class="custom-radio">
                                    <span class="radio-mark"></span>
                                </div>
                                <span>Каковы сроки регистрации бизнеса в Казахстане?</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="points me-3">15 пунктов</span>
                                <button class="btn-toggle">+</button>
                            </div>
                        </div>
                    </div>
                </div>
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
                                <button class="btn btn-success">Заказать услугу</button>
                                <button class="btn btn-outline-success">
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
                            <button class="btn btn-success">Заказать услугу</button>
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
                <div class="row mt-5">
                    <div class="col-12">
                        <h2 class="mb-4">Полезная информация</h2>
                    </div>
                    <div class="col-md-6 mb-3 d-flex justify-content-center">
                        <div class="info-card d-flex justify-content-between align-items-center">
                            <div class="info-img me-3">
                                <img src="{{ asset('current/img/note.png') }}" alt="Типовые договоры">
                            </div>
                            <div>
                                <strong>Типовые договоры</strong>
                                <div class="text-muted small">
                                    Шаблоны типовых договоров и документов для ведения строительной деятельности
                                </div>
                            </div>
                            <a href="#" class="download-btn">
                                Скачать
                                <span class="download-icon">
                                    <svg width="20" height="20" fill="none" stroke="#00B569" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M12 5v14M5 12l7 7 7-7"/>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 d-flex justify-content-center">
                        <div class="info-card d-flex justify-content-between align-items-center">
                            <div class="info-img me-3">
                                <img src="{{ asset('current/img/note.png') }}" alt="Инструкции и регламенты">
                            </div>
                            <div>
                                <strong>Инструкции и регламенты</strong>
                                <div class="text-muted small">
                                    Инструкции ведения строительной деятельности/регламенты и срок/правила
                                </div>
                            </div>
                            <a href="#" class="download-btn">
                                Скачать
                                <span class="download-icon">
                                    <svg width="20" height="20" fill="none" stroke="#00B569" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M12 5v14M5 12l7 7 7-7"/>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 d-flex justify-content-center">
                        <div class="info-card d-flex justify-content-between align-items-center">
                            <div class="info-img">
                                <img src="{{ asset('current/img/note.png') }}" alt="ГОСТы и СНиПы">
                            </div>
                            <div>
                                <strong>ГОСТы и СНиПы</strong>
                                <div class="text-muted small">
                                    Строительные нормы и правила по ним
                                </div>
                            </div>
                            <a href="#" class="download-btn">
                                Скачать
                                <span class="download-icon">
                                    <svg width="20" height="20" fill="none" stroke="#00B569" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M12 5v14M5 12l7 7 7-7"/>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 d-flex justify-content-center">
                        <div class="info-card d-flex justify-content-between align-items-center">
                            <div class="info-img">
                                <img src="{{ asset('current/img/note.png') }}" alt="Бухгалтерская учетная политика">
                            </div>
                            <div>
                                <strong>Бухгалтерская учетная политика</strong>
                                <div class="text-muted small">
                                    Правила, сроки, формы
                                </div>
                            </div>
                            <a href="#" class="download-btn">
                                Скачать
                                <span class="download-icon">
                                    <svg width="20" height="20" fill="none" stroke="#00B569" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M12 5v14M5 12l7 7 7-7"/>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 d-flex justify-content-center">
                        <div class="info-card d-flex justify-content-between align-items-center">
                            <div class="info-img me-3">
                                <img src="{{ asset('current/img/note.png') }}" alt="Кадровая учетная политика">
                            </div>
                            <div>
                                <strong>Кадровая учетная политика</strong>
                                <div class="text-muted small">
                                    Шаблоны типовых договоров и документов для ведения строительной деятельности
                                </div>
                            </div>
                            <a href="#" class="download-btn">
                                Скачать
                                <span class="download-icon">
                                    <svg width="20" height="20" fill="none" stroke="#00B569" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M12 5v14M5 12l7 7 7-7"/>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 reviews_block mb-5">
                        <div class="container my-5">
                            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                                <h2 class="reviews-title mb-0">Отзывы и кейсы клиентов</h2>
                                <div class="d-flex align-items-center mt-3 mt-md-0">
                                    <a href="#" class="see-all-btn me-4">Смотреть все</a>
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
                                            <span>ЛИЦЕНЗИРОВАНИЕ</span>
                                        </div>
                                        <div class="review-title mb-1">Уведомление о начале строительно-монтажных работ</div>
                                        <div class="review-desc mb-2">
                                            Кого же привлекает этот новое направление в моде? Неординарные, яркие, смелые в своих решениях люди, которые не боятся пробовать экспериментировать со своим образом.
                                        </div>
                                        <div class="review-meta mt-auto">
                                            <span class="review-date">
                                                <svg width="16" height="16" fill="none" stroke="#00B569" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
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
                                            <span>МЕДИЦИНА</span>
                                        </div>
                                        <div class="review-title mb-1">Медицинские лицензии для расширения спектра услуг</div>
                                        <div class="review-desc mb-2">
                                            Кого же привлекает этот новое направление в моде? Неординарные, яркие, смелые в своих решениях люди, которые не боятся пробовать экспериментировать со своим образом.
                                        </div>
                                        <div class="review-meta mt-auto">
                                            <span class="review-date">
                                                <svg width="16" height="16" fill="none" stroke="#00B569" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
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
                                            <span>СТРОИТЕЛЬСТВО</span>
                                        </div>
                                        <div class="review-title mb-1">Медицинские лицензии для расширения спектра услуг</div>
                                        <div class="review-desc mb-2">
                                            Кого же привлекает этот новое направление в моде? Неординарные, яркие, смелые в своих решениях люди, которые не боятся пробовать экспериментировать со своим образом.
                                        </div>
                                        <div class="review-meta mt-auto">
                                            <span class="review-date">
                                                <svg width="16" height="16" fill="none" stroke="#00B569" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                                                10 февраля 2024
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <style>
                    * {
                        font-family: 'Manrope', sans-serif !important;
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

                    @media (max-width: 768px) {
                        .document-option {
                            margin-bottom: 16px;
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
                        width: 620px;
                        min-width: 620px;
                        max-width: 620px;
                        height: 140px;
                        min-height: 140px;
                        max-height: 140px;
                        gap: 20px;
                        opacity: 1;
                        padding: 30px;
                        border-width: 1px;
                        border-style: solid;
                        border-color: #E0E0E0;
                        border-radius: 0px;
                        background: #fff;
                        box-sizing: border-box;
                        display: flex;
                        align-items: center;
                        margin-bottom: 20px;

                    }

                    .info-card {
                        height: 136px;
                        min-height: 136px;
                        max-height: 136px;
                    }

                    .service-card-info img {
                        width: 48px;
                        height: 48px;
                        margin-right: 20px;
                    }

                    @media (max-width: 700px) {
                        .service-card-info,
                        .info-card {
                            width: 100%;
                            min-width: unset;
                            max-width: 100%;
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
                        font-size: 2.5rem;
                        font-weight: 500;
                        margin-bottom: 0;
                    }

                    .see-all-btn {
                        background: #fff;
                        border: 1.5px solid #E0E0E0;
                        border-radius: 24px;
                        padding: 8px 24px;
                        color: #222;
                        font-weight: 500;
                        text-decoration: none;
                        transition: background 0.2s, color 0.2s, border-color 0.2s;
                        margin-right: 16px;
                    }

                    .see-all-btn:hover {
                        background: #e6f9f0;
                        color: #00B569;
                        border-color: #00B569;
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
                    }

                    .review-thumb {
                        position: relative;
                        width: 100%;
                        height: 200px; /* Adjust as needed */
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
                    }

                    .review-tags span {
                        background: #E0E0E0;
                        color: #333;
                        padding: 4px 10px;
                        border-radius: 12px;
                        font-size: 12px;
                        font-weight: 500;
                    }

                    .review-title {
                        font-size: 18px;
                        font-weight: 600;
                        color: #333;
                        margin-bottom: 8px;
                    }

                    .review-desc {
                        font-size: 14px;
                        color: #666;
                        line-height: 1.6;
                        margin-bottom: 15px;
                    }

                    .review-meta {
                        display: flex;
                        align-items: center;
                        gap: 10px;
                        font-size: 13px;
                        color: #888;
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
                        margin-right: -100px;
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
                                }
                            });
                        });
                        
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
