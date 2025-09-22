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
        <header class="bg-white border-b border-gray-100">
            <div class="max-w-[1440px] mx-auto px-8 py-4">
                <div class="flex items-center justify-between">
                    <!-- Logo and Navigation -->
                    <div class="flex items-center space-x-8">
                        <!-- Logo -->
                        <div class="flex items-center space-x-2">
                            <svg class="w-8 h-8" viewBox="0 0 32 32" fill="none">
                                <path d="M8 8h16v16H8z" fill="#279760"/>
                                <path d="M16 4v8l4-4 4 4V4z" fill="#279760"/>
                            </svg>
                            <div class="text-lg font-semibold">
                                <span class="text-[#279760]">UPPER</span><span class="text-gray-900">LICENSE</span>
                            </div>
                        </div>
                        
                        <!-- Navigation Tabs -->
                        <nav class="hidden md:flex items-center space-x-1">
                            <a href="{{ route('Accountant.services') }}" 
                               class="flex items-center gap-2 px-3 py-2 text-sm rounded-md transition-colors {{ request()->routeIs('Accountant.services') ? 'text-gray-900 bg-gray-50 font-medium' : 'text-gray-600 hover:text-gray-900' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                Услуги
                            </a>
                            <div class="hidden md:flex items-center gap-2 px-3 py-2 text-sm rounded-md transition-colors {{ request()->routeIs('Accountant.document_templates') ? 'text-gray-900 bg-gray-50 font-medium' : 'text-gray-600 hover:text-gray-900' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Шаблоны документов
                            </div>
                        </nav>
                    </div>
                    
                    <!-- User Menu -->
                    <div class="flex items-center">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                        <button type="submit" form="logout-form" class="flex items-center gap-2 px-3 py-2 text-sm text-gray-700 hover:text-gray-900 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Выйти
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>










