@extends('new-redesign.layouts.app')
@section('content')

  @php
    // Определяем маппинг разделов меню к категориям из БД
    $sectionConfigs = [
      'Лицензирование' => ['icon' => '/new/images/icons/uslugilicense.png', 'keywords' => ['лицензи']],
      'Регистрация компании' => ['icon' => '/new/images/icons/03b375c18b171e19614532b0cdee72ca6e55971b.png', 'keywords' => ['регистрац', 'компани']],
      'Юридическое сопровождение' => ['icon' => '/new/images/icons/uslugilaw.png', 'keywords' => ['юридическ']],
      'Бухгалтерский аутсорсинг' => ['icon' => '/new/images/icons/uslugibuh.png', 'keywords' => ['бухгалтер', 'аутсорс']],
      'Получение визы С3 и С5' => ['icon' => '/new/images/icons/uslugivisa.png', 'keywords' => ['виза']],
      'Дополнительные услуги' => ['icon' => '/new/images/icons/uslugiplus.png', 'keywords' => []],
      'Регистрация компании в СЭЗ и МФЦА' => ['icon' => '/new/images/icons/5dc86ec46fe074b98a02e0993dc9458c53e8509e.png', 'keywords' => ['сэз', 'мфца']],
      'Открытие банковских счетов' => ['icon' => '/new/images/icons/uslugibank.png', 'keywords' => ['банковск', 'счет']]
    ];
    
    // Находим категорию для каждого раздела
    $sections = [];
    foreach ($sectionConfigs as $sectionName => $config) {
      $categoryId = null;
      
      if (!empty($config['keywords'])) {
        foreach ($categoryList as $category) {
          $categoryNameLower = mb_strtolower($category->name);
          $matched = false;
          foreach ($config['keywords'] as $keyword) {
            if (strpos($categoryNameLower, $keyword) !== false) {
              $matched = true;
              break;
            }
          }
          if ($matched) {
            $categoryId = $category->id;
            break;
          }
        }
      }
      
      // Если не нашли по ключевым словам, проверяем маппинг
      if (!$categoryId && isset($categoryMapping[mb_strtolower($sectionName)])) {
        $categoryId = $categoryMapping[mb_strtolower($sectionName)];
      }
      
      // Если не нашли категорию, проверяем все категории по частичному совпадению
      if (!$categoryId) {
        $sectionNameLower = mb_strtolower($sectionName);
        foreach ($categoryList as $category) {
          $categoryNameLower = mb_strtolower($category->name);
          // Ищем частичное совпадение в любом направлении
          if (strpos($sectionNameLower, $categoryNameLower) !== false || 
              strpos($categoryNameLower, $sectionNameLower) !== false ||
              similar_text($sectionNameLower, $categoryNameLower) / max(mb_strlen($sectionNameLower), mb_strlen($categoryNameLower)) > 0.5) {
            $categoryId = $category->id;
            break;
          }
        }
      }
      
      // Если это первый раздел и не нашли категорию, берем первую из списка
      if (!$categoryId && $sectionName === 'Лицензирование' && $categoryList->count() > 0) {
        $categoryId = $categoryList->first()->id;
      }
      
      // Для всех остальных разделов без категории, используем первую доступную
      if (!$categoryId && $categoryList->count() > 0) {
        $categoryId = $categoryList->first()->id;
      }
      
      $sections[] = [
        'name' => $sectionName,
        'icon' => $config['icon'],
        'categoryId' => $categoryId
      ];
    }
    
    // Используем первую категорию как активную по умолчанию
    $activeCategoryId = $defaultCategoryId;
    $customGroupOrders = [
      'лицензирование' => [
        'Безопасность',
        'Естественные монополии',
        'Защита конкуренции',
        'Здравоохранение',
        'Земельные отношения',
        'Экспорт товаров',
        'Импорт товаров',
        'Культура'
      ]
    ];
    
    $categoryDataMap = [];
    if(isset($allCategoriesWithCatalogs) && count($allCategoriesWithCatalogs) > 0) {
      foreach($allCategoriesWithCatalogs as $categoryDataItem) {
        $categoryNameKey = mb_strtolower(trim($categoryDataItem['category']->name));
        $groupedItems = [];
        foreach($categoryDataItem['catalogItems'] as $catalogItem) {
          $childNodes = collect($catalogItem->childNodeList ?? [])
            ->where('is_visible', 1)
            ->sortBy('name')
            ->values();
          
          if ($childNodes->count() > 0) {
            $groupedItems[] = [
              'title' => $catalogItem->name,
              'items' => $childNodes->map(function($childNode) {
                return [
                  'name' => $childNode->name,
                  'pretty_url' => $childNode->pretty_url,
                  'description' => $childNode->description ?? ''
                ];
              })
            ];
          } else {
            $groupedItems[] = [
              'title' => null,
              'items' => collect([$catalogItem])->map(function($node) {
                return [
                  'name' => $node->name,
                  'pretty_url' => $node->pretty_url,
                  'description' => $node->description ?? ''
                ];
              })
            ];
          }
        }
        
        if (isset($customGroupOrders[$categoryNameKey])) {
          $orderMap = [];
          foreach ($customGroupOrders[$categoryNameKey] as $orderIndex => $orderTitle) {
            $orderMap[mb_strtolower($orderTitle)] = $orderIndex;
          }
          
          usort($groupedItems, function($a, $b) use ($orderMap) {
            $aKey = $a['title'] ? mb_strtolower($a['title']) : null;
            $bKey = $b['title'] ? mb_strtolower($b['title']) : null;
            $aOrder = array_key_exists($aKey, $orderMap) ? $orderMap[$aKey] : PHP_INT_MAX;
            $bOrder = array_key_exists($bKey, $orderMap) ? $orderMap[$bKey] : PHP_INT_MAX;
            if ($aOrder === $bOrder) {
              return 0;
            }
            return $aOrder < $bOrder ? -1 : 1;
          });
        }
        
        $categoryDataMap[$categoryDataItem['category']->id] = array_merge($categoryDataItem, [
          'groupedItems' => $groupedItems
        ]);
      }
    }
  @endphp

  <div class="services-new-page">
    <div class="services-inline-header-wrapper">
      <div class="services-inline-header d-lg-none">
        <a href="{{ route('new-index') }}" class="services-inline-header__logo">
          <img src="{{ asset('/new/images/icons/Frame7.png') }}" alt="UPPERLICENSE">
        </a>
        <div class="services-inline-header__actions">
          <a href="tel:+77471350000" class="services-inline-header__icon">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122L9.98 10.98s-.787.205-1.994-1.002C6.782 8.774 6.987 7.987 6.987 7.987l.549-1.805a.678.678 0 0 0-.122-.58L5.62 3.295a.678.678 0 0 0-.58-.122z" fill="#191E1D"/>
            </svg>
          </a>
          <button type="button" class="services-inline-header__icon" data-close-inline-header onclick="var path = window.location.pathname.split('/').filter(function(p){return p.length>0}); var locale = (path.length>0 && ['en','ru','kz'].includes(path[0])) ? path[0] : 'en'; window.location.href = '/' + locale; return false;">
            <svg width="12" height="12" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M1 1L13 13" stroke="#279760" stroke-width="1.4" stroke-linecap="round"/>
              <path d="M13 1L1 13" stroke="#279760" stroke-width="1.4" stroke-linecap="round"/>
            </svg>
          </button>
        </div>
      </div>
    </div>
    <div class="services-inline-subheader d-lg-none">
      <a href="#services-menu" class="services-inline-subheader__btn">&lt; {{ __('Услуги') }}</a>
    </div>

    <div class="row g-0 mx-0">
      <!-- Left sidebar with sections -->
      <div class="col-auto services-sidebar" id="services-menu">
          <nav class="services-sidebar-nav">
            <ul class="services-sidebar-list">
              @foreach($sections as $index => $section)
                <li>
                  <a href="#" 
                     class="services-sidebar-item {{ ($index === 0 && $activeCategoryId) ? 'active' : '' }}"
                     data-category-id="{{ $index === 0 ? $section['categoryId'] : null }}">
                    <img src="{{ asset($section['icon']) }}" alt="{{ $section['name'] }}" class="services-sidebar-icon" onerror="this.style.display='none'">
                    <span class="services-sidebar-text">{{ $section['name'] }}</span>
                    @if($index === 0 && $activeCategoryId)
                      <i class="bi bi-chevron-right services-sidebar-arrow"></i>
                    @endif
                  </a>
                </li>
              @endforeach
            </ul>
          </nav>
                </div>

        <!-- Main content area -->
        <div class="col services-content">
          <div class="services__window-documents">
            <div class="container">
              <!-- Content will be loaded dynamically here -->
              <div id="services-content-area">
                @if(isset($allCategoriesWithCatalogs) && count($allCategoriesWithCatalogs) > 0)
                  <div class="services-categories-container">
                    <div class="services-categories-mobile d-lg-none">
                      <div class="services-mobile-section-list" data-mobile-sections>
                        @foreach($sections as $sectionIndex => $section)
                          @php
                            $categoryData = isset($section['categoryId'], $categoryDataMap[$section['categoryId']])
                              ? $categoryDataMap[$section['categoryId']]
                              : null;
                          @endphp
                          @if($categoryData && !empty($categoryData['groupedItems']))
                            <button class="services-mobile-section-link" type="button" data-mobile-open="{{ $sectionIndex }}">
                              <span class="services-mobile-section-link__icon">
                                <img src="{{ asset($section['icon']) }}" alt="{{ $section['name'] }}" onerror="this.style.visibility='hidden'">
                              </span>
                              <span class="services-mobile-section-link__label">{{ $section['name'] }}</span>
                              <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 12L10 8L6 4" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                            </button>
                          @endif
                        @endforeach
                      </div>

                      @foreach($sections as $sectionIndex => $section)
                        @php
                          $categoryData = isset($section['categoryId'], $categoryDataMap[$section['categoryId']])
                            ? $categoryDataMap[$section['categoryId']]
                            : null;
                        @endphp
                        @if($categoryData && !empty($categoryData['groupedItems']))
                          <div class="services-mobile-detail" data-mobile-detail="{{ $sectionIndex }}">
                            <div class="services-mobile-detail__header">
                              <button type="button" class="services-mobile-back-btn" data-mobile-back>
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M11 14L5 8L11 2" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span>{{ __('Назад') }}</span>
                              </button>
                              <span class="services-mobile-detail__title">{{ $section['name'] }}</span>
                            </div>
                            <div class="services-mobile-detail__content">
                              <div class="services-mobile-subsection-list">
                                @php
                                  $sectionNameLower = mb_strtolower($section['name']);
                                  $subsectionTitles = [];
                                  
                                  // Для Лицензирования используем названия из customGroupOrders
                                  if (isset($customGroupOrders[$sectionNameLower])) {
                                    $subsectionTitles = $customGroupOrders[$sectionNameLower];
                                  } else {
                                    // Для других разделов используем названия из groupedItems
                                    foreach($categoryData['groupedItems'] as $group) {
                                      $groupTitle = $group['title'] ?: __('Прочие услуги');
                                      if ($groupTitle && !in_array($groupTitle, $subsectionTitles)) {
                                        $subsectionTitles[] = $groupTitle;
                                      }
                                    }
                                  }
                                @endphp
                                @foreach($subsectionTitles as $subsectionTitle)
                                  <button type="button" class="services-mobile-subsection-link">
                                    <span>{{ $subsectionTitle }}</span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M6 12L10 8L6 4" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                  </button>
                                @endforeach
                              </div>
                            </div>
                          </div>
                        @endif
                      @endforeach
                    </div>

                    <div class="services-categories-grid">
                      @foreach($allCategoriesWithCatalogs as $categoryIndex => $categoryData)
                        @if($categoryData['catalogItems']->count() > 0)
                          @php
                            $items = $categoryData['catalogItems'];
                            $visibleItems = $items->take(4);
                            $hiddenItems = collect($items->all())->slice(4)->values();
                          @endphp
                          <div class="services-category-column">
                            <h3 class="services-category-title-inline"
                                data-category-toggle="{{ $categoryIndex }}"
                                role="button"
                                tabindex="0">
                              {{ $categoryData['category']->name }}
                            </h3>
                            <div class="services-list-grid"
                                 id="services-category-{{ $categoryIndex }}">
                              @foreach($visibleItems as $itemIndex => $catalogItem)
                                @php
                                  $descriptionHtml = $catalogItem->description ?? '';
                                  $hasDescription = !empty(trim(strip_tags($descriptionHtml)));
                                  $itemId = "service-desc-{$categoryIndex}-primary-{$itemIndex}";
                                @endphp
                                <div class="service-item" data-service-item>
                                  <a href="{{route('new.services-group.info', ['serviceCategoryId'=>$catalogItem->pretty_url])}}"
                                     class="service-item-link"
                                     data-service-toggle="{{ $itemId }}"
                                     data-service-has-description="{{ $hasDescription ? 'true' : 'false' }}">
                                    {{$catalogItem->name}}
                                  </a>
                                  @if($hasDescription)
                                    <div class="service-item-description" id="{{ $itemId }}">
                                      {!! $descriptionHtml !!}
                                      <a href="{{route('new.services-group.info', ['serviceCategoryId'=>$catalogItem->pretty_url])}}" class="service-item-description__link">
                                        {{ __('Подробнее') }}
                                      </a>
                                    </div>
                                  @endif
                                </div>
                              @endforeach
                              @if($hiddenItems->count() > 0)
                                <div class="services-hidden-items" data-category-index="{{ $categoryIndex }}" style="display: none;">
                                  @foreach($hiddenItems as $hiddenIndex => $catalogItem)
                                    @php
                                      $descriptionHtml = $catalogItem->description ?? '';
                                      $hasDescription = !empty(trim(strip_tags($descriptionHtml)));
                                      $itemId = "service-desc-{$categoryIndex}-hidden-{$hiddenIndex}";
                                    @endphp
                                    <div class="service-item" data-service-item>
                                      <a href="{{route('new.services-group.info', ['serviceCategoryId'=>$catalogItem->pretty_url])}}"
                                         class="service-item-link"
                                         data-service-toggle="{{ $itemId }}"
                                         data-service-has-description="{{ $hasDescription ? 'true' : 'false' }}">
                                        {{$catalogItem->name}}
                                      </a>
                                      @if($hasDescription)
                                        <div class="service-item-description" id="{{ $itemId }}">
                                          {!! $descriptionHtml !!}
                                          <a href="{{route('new.services-group.info', ['serviceCategoryId'=>$catalogItem->pretty_url])}}" class="service-item-description__link">
                                            {{ __('Подробнее') }}
                                          </a>
                                        </div>
                                      @endif
                                    </div>
                                  @endforeach
                                </div>
                              @endif
                            </div>
                            @if($hiddenItems->count() > 0)
                              <button type="button" class="services-more-btn" data-category-index="{{ $categoryIndex }}">
                                Еще
                              </button>
                            @endif
                          </div>
                        @endif
                      @endforeach
                    </div>
                  </div>
                @elseif(isset($defaultRootNode) && $defaultRootNode)
                  @include('new.partials.page.catalogNodes', ['catalogRootNode' => $defaultRootNode])
                @else
                  <div class="row">
                    <div class="col-sm-9 col-12 services__window_head_layout">
                      <p class="services__window_title-head">Выберите раздел для просмотра услуг</p>
                    </div>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>

  <style>
    @media (max-width: 991.98px) {
      .header-redesigned,
      .header-redesigned__mobile {
        display: none !important;
      }
      .services-inline-header {
        display: block;
      }
    }

    .services-inline-header-wrapper {
      width: 100%;
      max-width: 100%;
      margin-left: 0;
      margin-right: 0;
      padding-left: 0;
      padding-right: 0;
    }

    .services-inline-header {
      display: flex;
      padding: 2px 16px 0 16px;
      background: #ffffff;
      border-bottom: 1px solid #E8E8E8;
      align-items: flex-start;
      justify-content: space-between;
      gap: 16px;
      width: 100%;
      max-width: 100%;
      margin-left: 0;
      margin-right: 0;
      box-sizing: border-box;
    }

    .services-inline-header__logo img {
      width: 192px;
      height: auto;
      display: block;
    }
    
    .services-inline-header__logo {
      margin-top: -48px;
      margin-left: -12px;
    }

    .services-inline-header__actions {
      margin-left: auto;
      margin-top: -48px;
      display: flex;
      gap: 8px;
      align-items: center;
      transform: translateX(-6px);
    }

    .services-inline-header__icon {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      border: 1px solid #E8E8E8;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #ffffff;
    }

    .services-inline-header__icon[data-close-inline-header] {
      border: 1px solid #279760;
      cursor: pointer;
      position: relative;
      z-index: 10;
      pointer-events: auto !important;
    }

    .services-inline-header__icon svg {
      display: block;
      pointer-events: none;
    }

    .services-inline-subheader {
      display: none;
      padding: 32px 0 14px;
      background: #ffffff;
      display: flex;
      align-items: center;
      justify-content: flex-start;
    }

    @media (max-width: 991.98px) {
      .services-inline-subheader {
        display: flex;
      }
    }

    .services-inline-subheader__btn {
      font-family: 'Manrope', sans-serif;
      font-size: 22px;
      color: #191E1D;
      text-decoration: none;
      padding-left: 22px;
    }

    .services-new-page {
      min-height: calc(100vh - 200px);
      margin: 0;
      padding: 0;
      width: 100%;
      max-width: 100%;
      overflow-x: hidden;
    }

    .services-new-page .row {
      margin-left: 0 !important;
      margin-right: 0 !important;
      max-width: 100%;
    }

    .services-sidebar {
      background: var(--color-bg-primary, #FFFFFF);
      border-right: none;
      min-height: calc(100vh - 68px);
      padding: 0 !important;
      margin-left: 0 !important;
      padding-left: 64px !important;
      width: auto;
      max-width: fit-content;
      flex-shrink: 0;
    }

    .services-sidebar-nav {
      padding: var(--spacing-6, 24px) 0;
    }
    
    .services-sidebar-list li:first-child .services-sidebar-item {
      padding-top: var(--spacing-6, 24px);
    }

    .services-sidebar-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .services-sidebar-list li {
      margin: 0;
      padding: 0;
    }

    .services-sidebar-item {
      display: flex;
      align-items: center;
      padding: var(--spacing-4, 16px) var(--spacing-6, 24px);
      text-decoration: none;
      color: var(--color-text-muted, #6F6F6F);
      font-family: var(--font-family-sans, 'Manrope', sans-serif);
      font-size: 16px;
      font-weight: var(--font-weight-normal, 400);
      line-height: 1.4em;
      transition: all 0.2s ease;
      border-left: 3px solid transparent;
      position: relative;
      gap: var(--spacing-4, 16px);
    }

    .services-sidebar-item:hover {
      color: var(--color-text-primary, #191E1D);
      text-decoration: none;
    }

    .services-sidebar-item.active {
      color: var(--color-text-primary, #191E1D);
      font-weight: var(--font-weight-medium, 500);
      border-left: 3px solid transparent;
      background-color: transparent;
    }

    .services-sidebar-item.active .services-sidebar-arrow {
      display: inline-block;
      color: var(--color-text-primary, #191E1D);
    }

    .services-sidebar-icon {
      width: 64px;
      height: 64px;
      flex-shrink: 0;
      object-fit: contain;
      display: block;
    }

    .services-sidebar-text {
      display: inline;
      white-space: normal;
    }

    .services-sidebar-arrow {
      display: none;
      font-size: 14px;
      margin-left: 4px;
      flex-shrink: 0;
      vertical-align: middle;
    }
    
    .services-sidebar-item.active .services-sidebar-arrow {
      display: inline-block;
    }

    .services-content {
      padding: 0;
      padding-top: 0;
    }

    #services-content-area {
      min-height: 400px;
    }
    
    .services__window-documents {
      padding-top: 0;
    }

    .loading-indicator {
      text-align: center;
      padding: 40px;
      color: var(--color-text-muted, #6F6F6F);
    }
    
    .services-categories-container {
      padding: 0;
    }
    
    .services-categories-mobile {
      display: none;
    }

    .services-mobile-section-list {
      display: flex;
      flex-direction: column;
    }

    .services-mobile-section-list.is-hidden {
      display: none;
    }

    .services-mobile-section-link {
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      padding: 18px 0;
      padding-left: 20px;
      border: none;
      border-top: 1px solid #E8E8E8;
      border-bottom: 1px solid #E8E8E8;
      border-radius: 0;
      background: none;
      font-family: 'Manrope', sans-serif;
      font-size: 18px;
      font-weight: 600;
      color: #191E1D;
      margin-bottom: -1px;
    }

    .services-mobile-section-list .services-mobile-section-link:last-child {
      border-bottom: none;
      margin-bottom: 0;
    }

    .services-mobile-section-link svg {
      flex-shrink: 0;
      margin-right: 20px;
    }

    .services-mobile-section-link__icon {
      width: 48px;
      height: 48px;
      border-radius: 12px;
      background: #F5F5F5;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      flex-shrink: 0;
    }

    .services-mobile-section-link__icon img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      display: block;
    }

    .services-mobile-section-link__label {
      flex: 1;
      text-align: left;
    }

    .services-mobile-detail {
      display: none;
      flex-direction: column;
      min-height: calc(100vh - 120px);
    }

    .services-mobile-detail.is-visible {
      display: flex;
    }

    .services-mobile-detail__header {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 0 16px;
      padding-left: 20px;
      border-bottom: 1px solid #E8E8E8;
    }

    .services-mobile-detail__header .services-mobile-back-btn span {
      display: none;
    }

    .services-mobile-back-btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      border: none;
      background: none;
      font-family: 'Manrope', sans-serif;
      font-size: 16px;
      color: #191E1D;
      padding: 0;
    }

    .services-mobile-detail__title {
      font-family: 'Manrope', sans-serif;
      font-size: 18px;
      font-weight: 700;
      color: #191E1D;
    }

    .services-mobile-detail__content {
      padding: 16px 0;
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .services-mobile-subsection-list {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .services-mobile-subsection-list.is-hidden {
      display: none;
    }

    .services-mobile-subsection-link {
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 16px 0;
      padding-left: 20px;
      border: none;
      background: none;
      border-bottom: 1px solid #E8E8E8;
      font-family: 'Manrope', sans-serif;
      font-size: 16px;
      font-weight: 600;
      color: #191E1D;
    }

    .services-mobile-subsection-link:last-child {
      border-bottom: none;
    }

    .services-mobile-subsection-link svg {
      flex-shrink: 0;
      margin-right: 20px;
    }

    .services-mobile-subsection-detail {
      display: none !important;
      flex-direction: column;
      gap: 16px;
    }

    .services-mobile-subsection-detail.is-visible {
      display: flex !important;
    }

    .services-mobile-subsection-detail__header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      padding-bottom: 12px;
      border-bottom: 1px solid #E8E8E8;
    }

    .services-mobile-subsection-detail__title {
      font-family: 'Manrope', sans-serif;
      font-size: 16px;
      font-weight: 700;
      color: #191E1D;
    }

    .services-mobile-subsection__list {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .services-mobile-detail__item {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 12px;
      padding: 12px 0;
      text-decoration: none;
      border-bottom: 1px solid #F2F2F2;
    }

    .services-mobile-detail__item:last-child {
      border-bottom: none;
    }

    .services-mobile-detail__item-text {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .services-mobile-detail__item-title {
      font-size: 15px;
      font-weight: 600;
      color: #191E1D;
    }

    .services-mobile-detail__item-description {
      font-size: 13px;
      line-height: 1.5;
      color: #5C5C5C;
    }

    .services-mobile-subsection-more-btn {
      background: none;
      color: var(--color-primary, #279760);
      border: none;
      padding: 12px 0 0;
      font-family: var(--font-family-sans, 'Manrope', sans-serif);
      font-size: var(--font-size-base, 14px);
      font-weight: var(--font-weight-medium, 500);
      cursor: pointer;
      transition: color 0.2s ease;
      width: fit-content;
      text-align: left;
    }

    .services-mobile-subsection-more-btn:hover {
      color: var(--color-primary-dark, #1e7a50);
    }

    .services-mobile-subsection-more-btn.expanded {
      margin-top: 8px;
    }

    .services-mobile-subsection-hidden-items {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    /* Мобильный grid с колонками сверху вниз */
    .services-mobile-categories-grid {
      display: flex;
      flex-direction: column;
      gap: 32px;
      width: 100%;
    }

    .services-mobile-category-column {
      display: flex;
      flex-direction: column;
      width: 100%;
    }

    .services-mobile-category-title {
      font-family: var(--font-family-sans, 'Manrope', sans-serif);
      font-size: var(--font-size-lg, 16px);
      font-weight: var(--font-weight-bold, 700);
      color: var(--color-text-primary, #191E1D);
      margin: 0 0 16px 0;
      padding: 0 0 12px 0;
      border-bottom: 1px solid var(--color-border-light, #E8E8E8);
    }

    .services-mobile-list-grid {
      display: flex;
      flex-direction: column;
      gap: 8px;
      margin-bottom: 20px;
    }

    .services-mobile-item-link {
      display: block;
      text-decoration: none;
      color: var(--color-text-muted, #6F6F6F);
      font-family: var(--font-family-sans, 'Manrope', sans-serif);
      font-size: var(--font-size-base, 14px);
      font-weight: var(--font-weight-normal, 400);
      line-height: 1.6em;
      transition: color 0.2s ease;
      padding: 0;
      width: 100%;
    }

    .services-mobile-item-link:hover {
      color: var(--color-text-primary, #191E1D);
      text-decoration: none;
    }

    .services-mobile-hidden-items {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .services-mobile-more-btn {
      background: none;
      color: var(--color-primary, #279760);
      border: none;
      padding: 0;
      font-family: var(--font-family-sans, 'Manrope', sans-serif);
      font-size: var(--font-size-base, 14px);
      font-weight: var(--font-weight-medium, 500);
      cursor: pointer;
      transition: color 0.2s ease;
      margin-top: 8px;
      width: fit-content;
      text-align: left;
    }

    .services-mobile-more-btn:hover {
      color: var(--color-primary-dark, #1e7a50);
    }

    .services-mobile-more-btn.expanded {
      margin-top: 16px;
    }
    
    @media (max-width: 991.98px) {
      .services-sidebar {
        display: none !important;
      }

      .services-content {
        padding-top: 16px;
      }

      .services-categories-mobile {
        display: flex;
        flex-direction: column;
        gap: 12px;
      }

      .services-categories-grid {
        display: none !important;
      }
    }
    
    .services-categories-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 32px 40px;
      align-items: start;
    }
    
    @media (max-width: 1200px) {
      .services-categories-grid {
        grid-template-columns: repeat(3, 1fr);
      }
    }
    
    @media (max-width: 768px) {
      .services-categories-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }
    
    @media (max-width: 480px) {
      .services-categories-grid {
        grid-template-columns: 1fr;
      }
    }
    
    .services-category-column {
      display: flex;
      flex-direction: column;
    }
    
    .services-category-title-inline {
      font-family: var(--font-family-sans, 'Manrope', sans-serif);
      font-size: var(--font-size-lg, 16px);
      font-weight: var(--font-weight-bold, 700);
      color: var(--color-text-primary, #191E1D);
      margin: 0 0 16px 0;
      padding: 0 0 12px 0;
      border-bottom: 1px solid var(--color-border-light, #E8E8E8);
      white-space: nowrap;
    }
    
    .services-list-grid {
      display: flex;
      flex-direction: column;
      gap: 8px;
      margin-bottom: 20px;
    }
    
    .service-item-link {
      display: block;
      text-decoration: none;
      color: var(--color-text-muted, #6F6F6F);
      font-family: var(--font-family-sans, 'Manrope', sans-serif);
      font-size: var(--font-size-base, 14px);
      font-weight: var(--font-weight-normal, 400);
      line-height: 1.6em;
      transition: color 0.2s ease;
      padding: 0;
      width: 100%;
      position: relative;
    }
    
    .service-item-link:hover {
      color: var(--color-text-primary, #191E1D);
      text-decoration: none;
    }

    .service-item {
      width: 100%;
    }

    .service-item-description {
      display: none;
      padding: 8px 0 0;
      font-size: 14px;
      line-height: 1.5;
      color: #4B4B4B;
    }

    .service-item-description__link {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      margin-top: 10px;
      font-size: 14px;
      font-weight: 600;
      color: #279760;
      text-decoration: none;
    }
    
    .services-hidden-items {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    
    .services-more-btn {
      background: none;
      color: var(--color-primary, #279760);
      border: none;
      padding: 0;
      font-family: var(--font-family-sans, 'Manrope', sans-serif);
      font-size: var(--font-size-base, 14px);
      font-weight: var(--font-weight-medium, 500);
      cursor: pointer;
      transition: color 0.2s ease;
      margin-top: 8px;
      width: fit-content;
    }
    
    .services-more-btn:hover {
      color: var(--color-primary-dark, #1e7a50);
    }
    
    .services-more-btn.expanded {
      margin-top: 16px;
    }

    @media (max-width: 991.98px) {
      .services-category-column {
        width: 100%;
        padding: 16px 0;
        border-bottom: 1px solid #E8E8E8;
        align-items: flex-start;
      }

      .services-category-column:last-child {
        border-bottom: none;
      }

      .services-category-title-inline {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        padding: 0;
        margin: 0;
      }

      .services-category-title-inline::after {
        content: '';
        width: 16px;
        height: 16px;
        margin-left: 12px;
        background-repeat: no-repeat;
        background-size: contain;
        background-image: url("data:image/svg+xml,%3Csvg width='16' height='16' viewBox='0 0 16 16' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M6 12L10 8L6 4' stroke='%23191E1D' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
        flex-shrink: 0;
        transition: transform 0.2s ease;
      }

      .services-category-title-inline.expanded::after {
        transform: rotate(90deg);
      }

      .services-list-grid {
        padding-left: 0;
        text-align: left;
        display: none;
      }

      .services-list-grid.is-visible {
        display: flex;
      }

      .service-item-link {
        padding-left: 0;
        display: flex;
        align-items: center;
        gap: 12px;
      }

      .service-item-link::after {
        content: '';
        width: 12px;
        height: 12px;
        margin-left: auto;
        background-repeat: no-repeat;
        background-size: contain;
        background-image: url("data:image/svg+xml,%3Csvg width='12' height='12' viewBox='0 0 16 16' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M6 12L10 8L6 4' stroke='%23191E1D' stroke-width='1.2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
        transition: transform 0.2s ease;
      }

      .service-item.is-open .service-item-link::after {
        transform: rotate(90deg);
      }

      .service-item-description {
        font-size: 13px;
        padding: 12px 0 8px;
      }

      .service-item-description.is-visible {
        display: block;
      }
    }
    
  </style>

@endsection
@section('services-js')
  <script>
    const servicesMoreLabel = @json(__('Еще'));
    const servicesHideLabel = @json(__('Скрыть'));
    const homeUrl = @json(route('new-index'));

    // Функция для получения URL главной страницы с учетом локали (доступна везде)
    function getHomeUrl() {
      // Получаем текущий путь
      var currentPath = window.location.pathname;
      console.log('Текущий путь:', currentPath);
      
      var pathParts = currentPath.split('/').filter(function(part) {
        return part.length > 0;
      });
      console.log('Части пути:', pathParts);
      
      // Извлекаем локаль из пути (первая часть пути)
      var locale = 'en'; // по умолчанию
      if (pathParts.length > 0 && ['en', 'ru', 'kz'].includes(pathParts[0])) {
        locale = pathParts[0];
      }
      console.log('Определенная локаль:', locale);
      
      // Формируем URL главной страницы с локалью
      var homeUrl = '/' + locale;
      console.log('Сформированный URL главной:', homeUrl);
      return homeUrl;
    }

    document.addEventListener('DOMContentLoaded', function () {
      var closeBtn = document.querySelector('[data-close-inline-header]');
      var servicesBtn = document.querySelector('.services-inline-subheader__btn');
      var categoryToggles = document.querySelectorAll('[data-category-toggle]');
      var categoryLists = document.querySelectorAll('.services-list-grid');
      var serviceLinks = document.querySelectorAll('.service-item-link');
      var mobileSectionList = document.querySelector('[data-mobile-sections]');
      var mobileSectionButtons = document.querySelectorAll('[data-mobile-open]');
      var mobileDetailPanels = document.querySelectorAll('[data-mobile-detail]');
      var mobileBackButtons = document.querySelectorAll('[data-mobile-back]');

      function isMobileView() {
        return window.matchMedia('(max-width: 991.98px)').matches;
      }

      function resetServiceItems(list) {
        if (!list) {
          return;
        }
        list.querySelectorAll('.service-item').forEach(function(item) {
          item.classList.remove('is-open');
        });
        list.querySelectorAll('.service-item-description').forEach(function(desc) {
          desc.classList.remove('is-visible');
        });
      }

      function resetCategoryLists() {
        categoryLists.forEach(function(list) {
          list.classList.remove('is-visible');
          resetServiceItems(list);
          var column = list.closest('.services-category-column');
          if (column) {
            var hiddenBlocks = column.querySelectorAll('.services-hidden-items');
            hiddenBlocks.forEach(function(block) {
              block.style.display = 'none';
            });
            var moreBtn = column.querySelector('.services-more-btn');
            if (moreBtn) {
              moreBtn.classList.remove('expanded');
              moreBtn.textContent = servicesMoreLabel;
            }
          }
        });
        categoryToggles.forEach(function(toggle) {
          toggle.classList.remove('expanded');
        });
      }

      function showAllCategoriesDesktop() {
        categoryLists.forEach(function(list) {
          list.classList.add('is-visible');
          resetServiceItems(list);
        });
        categoryToggles.forEach(function(toggle) {
          toggle.classList.add('expanded');
        });
      }

      function activateCategory(targetId, clickedToggle) {
        if (!isMobileView()) {
          return;
        }
        var targetList = document.getElementById(targetId);
        if (!targetList) {
          return;
        }
        var wasVisible = targetList.classList.contains('is-visible');
        resetCategoryLists();
        if (!wasVisible) {
          targetList.classList.add('is-visible');
          if (clickedToggle) {
            clickedToggle.classList.add('expanded');
          }
        }
      }

      function attachCategoryHandlers() {
        categoryToggles.forEach(function(toggle) {
          toggle.addEventListener('click', function () {
            if (!isMobileView()) {
              return;
            }
            var index = this.getAttribute('data-category-toggle');
            activateCategory('services-category-' + index, this);
          });
          toggle.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
              e.preventDefault();
              this.click();
            }
          });
        });
      }

      function attachServiceLinkHandlers() {
        serviceLinks.forEach(function(link) {
          link.addEventListener('click', function(e) {
            var hasDescription = this.getAttribute('data-service-has-description') === 'true';
            if (!isMobileView() || !hasDescription) {
              return;
            }
            e.preventDefault();
            var targetId = this.getAttribute('data-service-toggle');
            var description = document.getElementById(targetId);
            var serviceItem = this.closest('.service-item');
            var parentList = this.closest('.services-list-grid');
            if (!description || !serviceItem || !parentList) {
              return;
            }
            var alreadyOpen = serviceItem.classList.contains('is-open');
            parentList.querySelectorAll('.service-item').forEach(function(item) {
              item.classList.remove('is-open');
            });
            parentList.querySelectorAll('.service-item-description').forEach(function(desc) {
              desc.classList.remove('is-visible');
            });
            if (!alreadyOpen) {
              serviceItem.classList.add('is-open');
              description.classList.add('is-visible');
            }
          });
        });
      }

      function showMobileSectionList() {
        if (mobileSectionList) {
          mobileSectionList.classList.remove('is-hidden');
        }
        // Показываем кнопку "< Услуги" когда возвращаемся к списку разделов
        var subheader = document.querySelector('.services-inline-subheader');
        if (subheader) {
          subheader.style.display = 'flex';
        }
        mobileDetailPanels.forEach(function(panel) {
          panel.classList.remove('is-visible');
        });
      }

      function openMobileDetail(targetId) {
        if (!isMobileView()) {
          return;
        }
        if (mobileSectionList) {
          mobileSectionList.classList.add('is-hidden');
        }
        // Скрываем кнопку "< Услуги" когда открываем раздел
        var subheader = document.querySelector('.services-inline-subheader');
        if (subheader) {
          subheader.style.display = 'none';
        }
        mobileDetailPanels.forEach(function(panel) {
          if (panel.getAttribute('data-mobile-detail') === targetId) {
            panel.classList.add('is-visible');
            panel.scrollTop = 0;
          } else {
            panel.classList.remove('is-visible');
          }
        });
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }


      function attachMobileSectionHandlers() {
        mobileSectionButtons.forEach(function(button) {
          button.addEventListener('click', function () {
            openMobileDetail(this.getAttribute('data-mobile-open'));
          });
        });
        mobileBackButtons.forEach(function(button) {
          button.addEventListener('click', function () {
            showMobileSectionList();
          });
        });
      }

      // Обработчик кнопки закрытия
      if (closeBtn) {
        // Отключаем pointer events на SVG внутри кнопки
        var svgInside = closeBtn.querySelector('svg');
        if (svgInside) {
          svgInside.style.pointerEvents = 'none';
        }
        
        // Убеждаемся, что кнопка кликабельна
        closeBtn.style.cursor = 'pointer';
        closeBtn.style.pointerEvents = 'auto';
        closeBtn.style.zIndex = '1000';
        
        // Обработчик клика - используем обычный обработчик без capture phase
        closeBtn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          e.stopImmediatePropagation();
          
          // Получаем URL главной страницы с учетом текущей локали
          var redirectUrl = getHomeUrl();
          console.log('Кнопка закрытия нажата, переход на:', redirectUrl);
          
          // Используем window.location для надежного редиректа
          window.location.href = redirectUrl;
          
          return false;
        });
        
        // Также добавляем обработчик через onclick для надежности
        closeBtn.onclick = function(e) {
          e.preventDefault();
          e.stopPropagation();
          var redirectUrl = getHomeUrl();
          console.log('onclick сработал, переход на:', redirectUrl);
          window.location.href = redirectUrl;
          return false;
        };
      } else {
        console.warn('Кнопка закрытия не найдена! Селектор: [data-close-inline-header]');
      }
      if (servicesBtn) {
        servicesBtn.addEventListener('click', function (e) {
          e.preventDefault();
          // Делаем кнопку "< Услуги" такой же кнопкой меню, как бургер:
          // открываем offcanvas с id="mobileMenu", если он есть на странице.
          var mobileMenu = document.getElementById('mobileMenu');
          if (mobileMenu && window.bootstrap && window.bootstrap.Offcanvas) {
            var offcanvas = window.bootstrap.Offcanvas.getOrCreateInstance(mobileMenu);
            offcanvas.show();
          } else {
            // запасной вариант: просто кликаем по бургеру, если он есть
            var burgerBtn = document.querySelector('[data-bs-toggle="offcanvas"][data-bs-target="#mobileMenu"]');
            if (burgerBtn) {
              burgerBtn.click();
            }
          }
        });
      }

      attachCategoryHandlers();
      attachServiceLinkHandlers();
      attachMobileSectionHandlers();

      window.addEventListener('resize', function() {
        if (isMobileView()) {
          resetCategoryLists();
          showMobileSectionList();
        } else {
          showAllCategoriesDesktop();
          showMobileSectionList();
        }
      });

      if (isMobileView()) {
        resetCategoryLists();
        showMobileSectionList();
      } else {
        showAllCategoriesDesktop();
        showMobileSectionList();
      }
    });

    $(document).ready(function() {
      // Обработчик кнопки закрытия через jQuery (как резервный вариант)
      $('[data-close-inline-header]').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var redirectUrl = getHomeUrl();
        console.log('jQuery обработчик сработал, переход на:', redirectUrl);
        window.location.href = redirectUrl;
        return false;
      });
      
      // Отключаем переключение между разделами - только Лицензирование активно
      $('.services-sidebar-item').on('click', function(e) {
        e.preventDefault();
        // Ничего не делаем - только Лицензирование остается активным
        return false;
      });
      
      // Обработка кнопки "Еще"
      $('.services-more-btn').on('click', function(e) {
        e.stopPropagation();
        const categoryIndex = $(this).data('category-index');
        const $hiddenItems = $('.services-hidden-items[data-category-index="' + categoryIndex + '"]');
        const $btn = $(this);
        
        if ($hiddenItems.is(':visible')) {
          $hiddenItems.slideUp(200, function() {
            $(this).find('.service-item').removeClass('is-open');
            $(this).find('.service-item-description').removeClass('is-visible');
          });
          $btn.text(servicesMoreLabel).removeClass('expanded');
          } else {
          $hiddenItems.slideDown(200);
          $btn.text(servicesHideLabel).addClass('expanded');
        }
      });
    });
  </script>
@endsection
