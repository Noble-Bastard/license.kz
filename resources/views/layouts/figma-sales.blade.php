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
                        // Primary scale aliases used by components
                        'primary-50': 'var(--color-primary-50, #F3FBF7)',
                        'primary-100': 'var(--color-primary-100, #E7F5EE)',
                        'primary-300': 'var(--color-primary-300, #9FD8BF)',
                        'primary-500': 'var(--color-primary-500, #2EA26A)',
                        'primary-600': 'var(--color-primary-600, #279760)',
                        'primary-700': 'var(--color-primary-700, #1F7A4E)',
                        'primary-800': 'var(--color-primary-800, #176141)',
                        'primary-900': 'var(--color-primary-900, #124F35)',
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

    <style>[x-cloak]{ display:none !important; }</style>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @yield('head')
    @stack('head')
</head>

<body class="h-full font-sans antialiased" style="font-family: 'Manrope', sans-serif;">
    <div class="min-h-full bg-bg-secondary">
        <!-- Header -->
        <header class="bg-bg-primary">
            <div class="w-full">
                <!-- Top section with logo, navigation, and user controls -->
                <div class="flex items-center justify-between gap-5 px-5 py-2" style="padding-left: 40px; padding-right: 40px;">
                    <!-- Logo -->
                    <div class="flex items-center gap-5">
                        <img src="{{ asset('images/green-logo.png') }}" alt="UpperLicense" class="h-[31px] w-auto" style="width:150px;height:31px;"/>
                    </div>

                    <!-- Navigation Pills (Sale Manager) -->
                    <div class="flex items-center gap-[10px] px-4 py-4">
                        <!-- Услуги -->
                        <a href="{{ Route::has('sale_manager.service.list') ? route('sale_manager.service.list') : '#' }}"
                           class="flex items-center gap-[6px] px-[18px] py-[13px] rounded-[60px] text-text-primary text-xs font-medium leading-[1.4] hover:bg-bg-tertiary transition-colors {{ request()->routeIs('sale_manager.service.*') ? 'bg-bg-tertiary' : '' }}">
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

                        <!-- Потенциальные клиенты -->
                        <a href="{{ Route::has('sale_manager.potential_client.index') ? route('sale_manager.potential_client.index') : '#' }}"
                           class="flex items-center gap-[6px] px-[12px] py-[10px] rounded-[60px] text-text-primary text-xs font-medium leading-[1.4] hover:bg-bg-tertiary transition-colors {{ request()->routeIs('sale_manager.potential_client.*') ? 'bg-bg-tertiary' : '' }}">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.3333 17.5V15.8333C13.3333 14.9493 12.9821 14.1014 12.357 13.4763C11.7319 12.8512 10.884 12.5 10 12.5H5C4.11594 12.5 3.2681 12.8512 2.64297 13.4763C2.01785 14.1014 1.66667 14.9493 1.66667 15.8333V17.5" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7.5 9.16667C9.34095 9.16667 10.8333 7.67428 10.8333 5.83333C10.8333 3.99238 9.34095 2.5 7.5 2.5C5.65905 2.5 4.16667 3.99238 4.16667 5.83333C4.16667 7.67428 5.65905 9.16667 7.5 9.16667Z" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Потенциальные клиенты
                        </a>

                        <!-- Коммерческие предложения -->
                        <a href="{{ Route::has('sale_manager.commercial_offer.index') ? route('sale_manager.commercial_offer.index') : '#' }}"
                           class="flex items-center gap-[6px] px-[12px] py-[10px] rounded-[60px] text-text-primary text-xs font-medium leading-[1.4] hover:bg-bg-tertiary transition-colors {{ request()->routeIs('sale_manager.commercial_offer.*') ? 'bg-bg-tertiary' : '' }}">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 3.33333H15C15.4602 3.33333 15.8333 3.70643 15.8333 4.16667V15.8333C15.8333 16.2936 15.4602 16.6667 15 16.6667H5C4.53976 16.6667 4.16667 16.2936 4.16667 15.8333V4.16667C4.16667 3.70643 4.53976 3.33333 5 3.33333Z" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.66667 6.66667H13.3333" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.66667 10H13.3333" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.66667 13.3333H10.8333" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            КП
                        </a>
                    </div>

                    <!-- Right side controls -->
                    <div class="flex items-center gap-5 px-4 py-4">
                        <!-- Notifications -->
                        <div class="relative">
                            <button class="flex items-center justify-center w-[46px] h-[46px] rounded-[60px] border border-border-light hover:bg-bg-tertiary transition-colors">
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
    @stack('scripts')
</body>
</html>
