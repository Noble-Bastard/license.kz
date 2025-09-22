<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-bg-secondary">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (CDN) -->
    <script>
        window.tailwind = window.tailwind || {};
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#279760',
                        'text-primary': 'var(--color-text-primary)',
                        'text-secondary': 'var(--color-text-secondary)',
                        'text-muted': 'var(--color-text-muted)',
                        'text-white': 'var(--color-text-white)',
                        'bg-primary': 'var(--color-bg-primary)',
                        'bg-secondary': 'var(--color-bg-secondary)',
                        'bg-tertiary': 'var(--color-bg-tertiary)',
                        'border-light': 'var(--color-border-light)',
                        'border-medium': 'var(--color-border-medium)',
                        'border-muted': 'var(--color-border-muted)',
                        'status-error': 'var(--color-status-error)'
                    },
                    fontFamily: {
                        sans: ['Manrope', 'ui-sans-serif', 'system-ui', '-apple-system', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'Noto Sans', 'sans-serif']
                    }
                }
            }
        };
    </script>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Variables CSS served from public -->
    <link href="{{ asset('css/variables.css') }}" rel="stylesheet">

    @yield('head')
</head>

<body class="h-full font-sans antialiased" style="font-family: 'Manrope', sans-serif;">
    <div class="min-h-full bg-bg-secondary">
        <!-- Header -->
        <header class="bg-bg-primary">
            <div class="w-full">
                <!-- Top section with logo, navigation, and user controls -->
                <div class="flex items-center justify-between gap-3 px-3 py-2" style="padding-left: 10px; padding-right: 10px;">
                    <!-- Logo -->
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/green-logo.png') }}" alt="UpperLicense" class="h-[31px] w-auto" style="width:150px;height:31px;"/>
                        <!-- Navigation Pills (aligned left next to logo) -->
                        <nav class="hidden md:flex items-center gap-1 px-2 py-2">
                        <!-- Исполнители - Active -->
                        <a href="{{ Route::has('manager.executor.list') ? route('manager.executor.list') : '#' }}" 
                           class="flex items-center gap-[6px] px-[18px] py-[13px] rounded-[60px] text-text-primary text-xs font-medium leading-[1.4] hover:bg-bg-tertiary transition-colors {{ request()->routeIs('manager.executor.list') ? 'bg-bg-tertiary' : '' }}">
                            <!-- User icon -->
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.6667 17.5V15.8333C16.6667 14.9493 16.3155 14.1014 15.6904 13.4763C15.0652 12.8512 14.2174 12.5 13.3333 12.5H6.66667C5.78261 12.5 4.93477 12.8512 4.30964 13.4763C3.68452 14.1014 3.33333 14.9493 3.33333 15.8333V17.5" stroke="#279760" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 9.16667C11.8409 9.16667 13.3333 7.67428 13.3333 5.83333C13.3333 3.99238 11.8409 2.5 10 2.5C8.15905 2.5 6.66667 3.99238 6.66667 5.83333C6.66667 7.67428 8.15905 9.16667 10 9.16667Z" stroke="#279760" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Исполнители
                        </a>

                        <!-- Группы -->
                        <a href="{{ Route::has('manager.groups.list') ? route('manager.groups.list') : '#' }}" 
                           class="flex items-center gap-[6px] px-[10px] py-[10px] rounded-[60px] text-text-primary text-xs font-medium leading-[1.4] hover:bg-bg-tertiary transition-colors {{ request()->routeIs('manager.groups.list') ? 'bg-bg-tertiary' : '' }}">
                            <!-- Folder icon -->
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.3333 15C18.3333 15.442 18.1577 15.866 17.845 16.1785C17.5323 16.491 17.1087 16.6667 16.6667 16.6667H3.33333C2.89131 16.6667 2.46738 16.491 2.15482 16.1785C1.84226 15.866 1.66667 15.442 1.66667 15V5C1.66667 4.55797 1.84226 4.13405 2.15482 3.82149C2.46738 3.50893 2.89131 3.33333 3.33333 3.33333H7.5L9.16667 5.83333H16.6667C17.1087 5.83333 17.5323 6.00893 17.845 6.32149C18.1577 6.63405 18.3333 7.05797 18.3333 7.5V15Z" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Группы
                        </a>

                        <!-- Услуги -->
                        <a href="{{ Route::has('manager.services.list') ? route('manager.services.list') : '#' }}" 
                           class="flex items-center gap-[6px] px-[10px] py-[10px] rounded-[60px] text-text-primary text-xs font-medium leading-[1.4] hover:bg-bg-tertiary transition-colors {{ request()->routeIs('manager.services.*') ? 'bg-bg-tertiary' : '' }}">
                            <!-- List icon -->
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.5 5H6.66667" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M17.5 10H6.66667" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M17.5 15H6.66667" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2.5 5H2.50833" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2.5 10H2.50833" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2.5 15H2.50833" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Услуги
                        </a>

                        <!-- Сообщения -->
                        <a href="{{ Route::has('Manager.service.message.list') ? route('Manager.service.message.list') : '#' }}" 
                           class="flex items-center gap-[6px] px-[18px] py-[13px] {{ request()->routeIs('Manager.service.message.list') ? 'bg-bg-tertiary' : '' }} rounded-[60px] text-text-primary text-xs font-medium leading-[1.4] hover:bg-bg-tertiary transition-colors">
                            <!-- Message icon -->
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.5 12.5C17.5 13.163 17.2366 13.7989 16.7678 14.2678C16.2989 14.7366 15.663 15 15 15H5L2.5 17.5V5C2.5 4.33696 2.76339 3.70107 3.23223 3.23223C3.70107 2.76339 4.33696 2.5 5 2.5H15C15.663 2.5 16.2989 2.76339 16.7678 3.23223C17.2366 3.70107 17.5 4.33696 17.5 5V12.5Z" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Сообщения
                        </a>
                        </nav>
                    </div>

                    <!-- Right side controls -->
                    <div class="flex items-center gap-2 px-2 py-2">
                        <!-- Notifications -->
                        <div class="relative hidden md:flex">
                            <button class="flex items-center justify-center w-[40px] h-[40px] rounded-[60px] border border-border-light hover:bg-bg-tertiary transition-colors">
                                <!-- Bell icon -->
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 6.66667C15 5.34058 14.4732 4.06881 13.5355 3.13114C12.5979 2.19348 11.3261 1.66667 10 1.66667C8.67392 1.66667 7.40215 2.19348 6.46447 3.13114C5.52678 4.06881 5 5.34058 5 6.66667C5 12.5 2.5 14.1667 2.5 14.1667H17.5C17.5 14.1667 15 12.5 15 6.66667Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.4417 17.5C11.2952 17.7526 11.0849 17.9622 10.8319 18.1088C10.5789 18.2553 10.292 18.333 10 18.333C9.70804 18.333 9.42117 18.2553 9.16816 18.1088C8.91515 17.9622 8.70486 17.7526 8.55835 17.5" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <!-- Notification dot -->
                                <div class="absolute top-1 right-1 w-[10px] h-[10px] bg-status-error rounded-full"></div>
                            </button>
                        </div>

                        <!-- User/Logout -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                        <button type="submit" form="logout-form" 
                           class="flex items-center gap-[6px] px-4 py-4 rounded-[60px] border border-border-light text-text-primary text-sm font-medium leading-[1] hover:bg-bg-tertiary transition-colors">
                            <!-- Login icon -->
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.25 12.25H2.625C2.42609 12.25 2.23532 12.171 2.09467 12.0303C1.95402 11.8897 1.875 11.6989 1.875 11.5V2.5C1.875 2.30109 1.95402 2.11032 2.09467 1.96967C2.23532 1.82902 2.42609 1.75 2.625 1.75H5.25" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9.1875 9.625L12.125 7L9.1875 4.375" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12.125 7H5.25" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Выйти
                        </button>
                    </div>
                </div>

                <!-- Divider -->
                <div class="w-full h-px bg-border-medium"></div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 bg-bg-secondary">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('libs/jquery-3.5.1.min.js') }}"></script>
    @yield('js')
</body>
</html>
