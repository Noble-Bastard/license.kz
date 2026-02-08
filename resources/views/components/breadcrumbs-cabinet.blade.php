@php
    // Показываем breadcrumbs только если пользователь залогинен и не на главной странице
    $showBreadcrumbs = Auth::check() && !request()->routeIs('new-index') && !request()->routeIs('new-home');
    
    $locale = app()->getLocale();
    $localePrefix = $locale && $locale !== 'ru' ? "/{$locale}" : '';
    
    // Определяем текущую страницу и название
    $currentRoute = request()->route()->getName();
    $currentPageName = '';
    $currentPageUrl = '';
    
    // Маппинг роутов на названия страниц
    $routeNames = [];
    
    // Client routes
    if (Route::has('Client.service.list')) {
        $routeNames['Client.service.list'] = ['name' => 'Услуги', 'url' => route('Client.service.list')];
    }
    if (Route::has('profile.documentList')) {
        $routeNames['profile.documentList'] = ['name' => 'Документы', 'url' => route('profile.documentList')];
    }
    if (Route::has('profile.bookkeeping')) {
        $routeNames['profile.bookkeeping'] = ['name' => 'Бухгалтерия', 'url' => route('profile.bookkeeping')];
    }
    if (Route::has('Client.service.message.list')) {
        $routeNames['Client.service.message.list'] = ['name' => 'Сообщения', 'url' => route('Client.service.message.list')];
    }
    if (Route::has('profile')) {
        $routeNames['profile'] = ['name' => 'Профиль', 'url' => route('profile')];
    }
    
    // Executor routes
    if (Route::has('executor.projects')) {
        $routeNames['executor.projects'] = ['name' => 'Проекты', 'url' => route('executor.projects')];
    }
    if (Route::has('executor.project.list')) {
        $routeNames['executor.project.list'] = ['name' => 'Проекты', 'url' => route('executor.project.list')];
    }
    if (Route::has('executor.messages')) {
        $routeNames['executor.messages'] = ['name' => 'Сообщения', 'url' => route('executor.messages')];
    }
    
    // Manager routes
    if (Route::has('manager.servicesList')) {
        $routeNames['manager.servicesList'] = ['name' => 'Услуги', 'url' => route('manager.servicesList')];
    }
    if (Route::has('manager.services.list')) {
        $routeNames['manager.services.list'] = ['name' => 'Услуги', 'url' => route('manager.services.list')];
    }
    if (Route::has('manager.clients')) {
        $routeNames['manager.clients'] = ['name' => 'Клиенты', 'url' => route('manager.clients')];
    }
    if (Route::has('manager.executor.list')) {
        $routeNames['manager.executor.list'] = ['name' => 'Исполнители', 'url' => route('manager.executor.list')];
    }
    if (Route::has('manager.groups.list')) {
        $routeNames['manager.groups.list'] = ['name' => 'Группы', 'url' => route('manager.groups.list')];
    }
    if (Route::has('Manager.service.message.list')) {
        $routeNames['Manager.service.message.list'] = ['name' => 'Сообщения', 'url' => route('Manager.service.message.list')];
    }
    
    // SaleManager routes
    if (Route::has('salemanager.services')) {
        $routeNames['salemanager.services'] = ['name' => 'Услуги', 'url' => route('salemanager.services')];
    }
    if (Route::has('salemanager.clients')) {
        $routeNames['salemanager.clients'] = ['name' => 'Клиенты', 'url' => route('salemanager.clients')];
    }
    
    // Curator routes
    if (Route::has('curator.reviewList')) {
        $routeNames['curator.reviewList'] = ['name' => 'На проверке', 'url' => route('curator.reviewList')];
    }
    
    // Administrator routes
    if (Route::has('admin.users')) {
        $routeNames['admin.users'] = ['name' => 'Пользователи', 'url' => route('admin.users')];
    }
    if (Route::has('admin.services')) {
        $routeNames['admin.services'] = ['name' => 'Услуги', 'url' => route('admin.services')];
    }
    
    // Accountant routes
    if (Route::has('accountant.services')) {
        $routeNames['accountant.services'] = ['name' => 'Услуги', 'url' => route('accountant.services')];
    }
    
    // Head routes
    if (Route::has('report.index')) {
        $routeNames['report.index'] = ['name' => 'Отчеты', 'url' => route('report.index')];
    }
    
    // Agent routes
    if (Route::has('agent.client')) {
        $routeNames['agent.client'] = ['name' => 'Клиенты', 'url' => route('agent.client')];
    }
    
    // Проверяем точное совпадение
    if (isset($routeNames[$currentRoute])) {
        $currentPageName = $routeNames[$currentRoute]['name'];
        $currentPageUrl = $routeNames[$currentRoute]['url'];
    } else {
        // Проверяем паттерны роутов (например, executor.project.*)
        $matched = false;
        foreach ($routeNames as $routePattern => $routeInfo) {
            // Проверяем, начинается ли текущий роут с паттерна
            if (strpos($currentRoute, str_replace('.*', '', $routePattern)) === 0) {
                $currentPageName = $routeInfo['name'];
                $currentPageUrl = $routeInfo['url'];
                $matched = true;
                break;
            }
        }
        
        if (!$matched) {
            // Fallback - используем title из секции или название роута
            $currentPageName = $title ?? 'Личный кабинет';
        }
    }
@endphp

@if($showBreadcrumbs)
<nav aria-label="breadcrumb" class="w-full bg-white border-b border-gray-200">
    <div class="px-8 py-3" style="padding-left: 32px; padding-right: 32px;">
        <ul class="breadscrumb__list" style="list-style-type: none; margin: 0; padding: 0; display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
            <li>
                <a href="{{ route('new-index') }}" 
                   style="display: flex; align-items: center; text-decoration: none; color: #999999; font-family: 'Manrope', sans-serif; font-weight: 500; font-size: 12px; line-height: 100%; transition: color 0.2s;">
                    <img src="{{ asset('new/images/icons/home-02.png') }}" alt="Главная" style="width: 11px; height: 11px; margin-right: 4px;">
                    Главная
                </a>
            </li>
            @if($currentPageName)
                <li style="display: flex; align-items: center; gap: 4px;">
                    <div class="elipsis" style="width: 4px; height: 4px; border-radius: 50%; background: #D9D9D9;"></div>
                    <span style="color: #191E1D; font-family: 'Manrope', sans-serif; font-weight: 500; font-size: 12px; line-height: 100%;">
                        {{ $currentPageName }}
                    </span>
                </li>
            @endif
        </ul>
    </div>
</nav>

<style>
    .breadscrumb__list a:hover {
        color: #191E1D !important;
    }
    
    @media (max-width: 768px) {
        .breadscrumb__list {
            gap: 6px !important;
        }
        
        .breadscrumb__list a,
        .breadscrumb__list span {
            font-size: 11px !important;
        }
        
        .breadscrumb__list img {
            width: 10px !important;
            height: 10px !important;
        }
    }
</style>
@endif
