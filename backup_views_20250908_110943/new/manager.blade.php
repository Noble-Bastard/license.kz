<!doctype html>
<html lang="{{ \Illuminate\Support\Facades\App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="{{asset('libs/font-awesome/css/all.min.css')}}" rel="stylesheet" type="text/css">
    
    <!-- Custom CSS -->
    <link href="{{asset('css/manager_dashboard.css')}}" rel="stylesheet" type="text/css">
    
    @stack('css')
    @yield('css')
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
</head>
<body>
    <header class="manager-header">
        <div class="header-container">
            <div class="logo-section">
                <img src="{{ asset('new/images/manager/logo-main.svg') }}" alt="UPPERLICENSE" class="logo-icon" />
            </div>
            
            <nav class="navigation-menu">
                <a href="{{ route('manager.executor.list') }}" class="nav-item {{ request()->routeIs('manager.executor.*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <img src="{{ asset('new/images/manager/icon-executors.svg') }}" alt="Executors" />
                    </div>
                    <span>Исполнители</span>
                </a>
                
                <a href="{{ route('manager.groups.list') }}" class="nav-item {{ request()->routeIs('manager.groups.*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <img src="{{ asset('new/images/manager/icon-groups.svg') }}" alt="Groups" />
                    </div>
                    <span>Группы</span>
                </a>
                
                <a href="{{ route('manager.services.list') }}" class="nav-item {{ request()->routeIs('manager.services.*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <img src="{{ asset('new/images/manager/icon-services.svg') }}" alt="Services" />
                    </div>
                    <span>Услуги</span>
                </a>
                
                <a href="{{ route('Manager.service.message.list') }}" class="nav-item {{ request()->routeIs('Manager.service.message.*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <img src="{{ asset('new/images/manager/icon-messages.svg') }}" alt="Messages" />
                    </div>
                    <span>Сообщения</span>
                </a>
            </nav>
            
            <div class="header-actions">
                <button class="notification-bell">
                    <img src="{{ asset('new/images/manager/icon-bell.svg') }}" alt="Notifications" />
                    <span class="notification-dot"></span>
                </button>
                
                <a href="{{ route('logout') }}" class="logout-btn"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <img src="{{ asset('new/images/manager/icon-logout.svg') }}" alt="Logout" />
                    <span>Выйти</span>
                </a>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
        
        <!-- Divider line -->
        <div style="height: 1px; background: #D9D9D9;"></div>
    </header>

    <main class="manager-content">
        <div class="content-container">
            @yield('content')
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Custom Scripts -->
    @stack('js')
    @yield('js')
</body>
</html>
