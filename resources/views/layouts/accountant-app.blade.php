<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (CDN) -->
    <script>
        window.tailwind = window.tailwind || {};
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#279760',
                        'text-primary': '#191E1D',
                        'text-secondary': '#1E2B28',
                        'text-muted': '#6F6F6F',
                        'text-white': '#FFFFFF',
                        'bg-primary': '#FFFFFF',
                        'bg-secondary': '#F5F5F5',
                        'bg-tertiary': '#F3FBF7',
                        'border-light': '#E8E8E8',
                        'border-medium': '#D9D9D9',
                        'border-muted': '#C2BFBF',
                        'status-error': '#FF4444'
                    },
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', '-apple-system', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'Noto Sans', 'sans-serif']
                    }
                }
            }
        };
    </script>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Variables CSS served from public -->
    <link href="{{ asset('css/variables.css') }}" rel="stylesheet">

    @stack('head')
</head>

<body class="h-full font-sans antialiased" style="font-family: 'Inter', sans-serif;">
    <div class="min-h-full bg-white">
        <!-- Header -->
        <header class="bg-white">
            <div class="w-full px-8 py-4" style="padding-left: 32px; padding-right: 32px;">
                <div class="flex items-center justify-between">
                    <!-- Logo and Navigation -->
                    <div class="flex items-center space-x-8">
                        <!-- Logo -->
                        <div class="flex items-center space-x-2">
                            <img src="{{ asset('images/green-logo.png') }}" alt="UpperLicense" class="h-[31px] w-auto" style="width:150px;height:31px;"/>
                        </div>
                        
                        <!-- Navigation Tabs -->
                        <nav class="hidden md:flex items-center space-x-1">
                            <a href="{{ route('Accountant.services') }}" 
                               class="flex items-center gap-[6px] px-[18px] py-[13px] rounded-[60px] text-text-primary text-xs font-medium leading-[1.4] transition-colors {{ request()->routeIs('Accountant.services') ? 'bg-gray-200' : '' }}">
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
                            <a href="{{ route('Accountant.document_templates') }}" 
                               class="flex items-center gap-[6px] px-[18px] py-[13px] rounded-[60px] text-text-primary text-xs font-medium leading-[1.4] transition-colors {{ request()->routeIs('Accountant.document_templates') ? 'bg-gray-200' : '' }}">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18.3333 15C18.3333 15.442 18.1577 15.866 17.845 16.1785C17.5323 16.491 17.1087 16.6667 16.6667 16.6667H3.33333C2.89131 16.6667 2.46738 16.491 2.15482 16.1785C1.84226 15.866 1.66667 15.442 1.66667 15V5C1.66667 4.55797 1.84226 4.13405 2.15482 3.82149C2.46738 3.50893 2.89131 3.33333 3.33333 3.33333H7.5L9.16667 5.83333H16.6667C17.1087 5.83333 17.5323 6.00893 17.845 6.32149C18.1577 6.63405 18.3333 7.05797 18.3333 7.5V15Z" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Шаблоны документов
                            </a>
                        </nav>
                    </div>
                    
                    <!-- User Menu -->
                    <div class="flex items-center gap-3">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                        <button type="submit" form="logout-form" class="flex items-center gap-[6px] px-4 py-4 rounded-[60px] border border-border-light text-text-primary text-sm font-medium leading-[1] transition-colors">
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
                <div class="w-screen h-px bg-gray-300 mt-4" style="margin-left: calc(-50vw + 50%);"></div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('libs/jquery-3.5.1.min.js') }}"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>















