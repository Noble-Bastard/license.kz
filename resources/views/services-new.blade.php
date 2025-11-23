@extends('new-redesign.layouts.app')
@section('content')

  @php
    // Определяем маппинг разделов меню к категориям из БД
    $sectionConfigs = [
      'Лицензирование' => ['icon' => '/new/images/icons/uslugilicense.png', 'keywords' => ['лицензи']],
      'Регистрация компании' => ['icon' => '/new/images/icons/home-02.png', 'keywords' => ['регистрац', 'компани']],
      'Юридическое сопровождение' => ['icon' => '/new/images/icons/uslugilaw.png', 'keywords' => ['юридическ']],
      'Бухгалтерский аутсорсинг' => ['icon' => '/new/images/icons/uslugibuh.png', 'keywords' => ['бухгалтер', 'аутсорс']],
      'Получение визы С3 и С5' => ['icon' => '/new/images/icons/uslugivisa.png', 'keywords' => ['виза']],
      'Дополнительные услуги' => ['icon' => '/new/images/icons/uslugiplus.png', 'keywords' => []],
      'Регистрация компании в СЭЗ и МФЦА' => ['icon' => '/new/images/icons/home-02.png', 'keywords' => ['сэз', 'мфца']],
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
  @endphp

  <div class="services-new-page">
    <div class="row g-0 mx-0">
      <!-- Left sidebar with sections -->
      <div class="col-auto services-sidebar">
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
                    <div class="services-categories-grid">
                      @foreach($allCategoriesWithCatalogs as $categoryIndex => $categoryData)
                        @if($categoryData['catalogItems']->count() > 0)
                          @php
                            $items = $categoryData['catalogItems'];
                            $visibleItems = $items->take(4);
                            $hiddenItems = collect($items->all())->slice(4)->values();
                          @endphp
                          <div class="services-category-column">
                            <h3 class="services-category-title-inline">
                              {{ $categoryData['category']->name }}
                            </h3>
                            <div class="services-list-grid">
                              @foreach($visibleItems as $catalogItem)
                                <a href="{{route('new.services-group.info', ['serviceCategoryId'=>$catalogItem->pretty_url])}}" class="service-item-link">
                                  {{$catalogItem->name}}
                                </a>
                              @endforeach
                              @if($hiddenItems->count() > 0)
                                <div class="services-hidden-items" data-category-index="{{ $categoryIndex }}" style="display: none;">
                                  @foreach($hiddenItems as $catalogItem)
                                    <a href="{{route('new.services-group.info', ['serviceCategoryId'=>$catalogItem->pretty_url])}}" class="service-item-link">
                                      {{$catalogItem->name}}
                                    </a>
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
    .services-new-page {
      min-height: calc(100vh - 200px);
      margin: 0;
      padding: 0;
      width: 100%;
    }

    .services-new-page .row {
      margin-left: 0 !important;
      margin-right: 0 !important;
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
      padding-top: 48px;
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
      padding: 20px 0;
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
    }
    
    .service-item-link:hover {
      color: var(--color-text-primary, #191E1D);
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
    
  </style>

@endsection
@section('services-js')
  <script>
    $(document).ready(function() {
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
          $hiddenItems.slideUp(200);
          $btn.text('Еще').removeClass('expanded');
          } else {
          $hiddenItems.slideDown(200);
          $btn.text('Скрыть').addClass('expanded');
        }
      });
    });
  </script>
@endsection
