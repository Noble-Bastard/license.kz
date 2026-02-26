<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-bg-secondary">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Админ-панель') - {{ config('app.name', 'Laravel') }}</title>

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

    <!-- Variables CSS -->
    <link href="{{ asset('css/variables.css') }}?v={{filemtime(public_path('css/variables.css'))}}" rel="stylesheet">
    <link href="{{ asset('css/app_new.css') }}?v={{filemtime(public_path('css/app_new.css'))}}" rel="stylesheet">
    <link href="{{ asset('new/css/app.css') }}?v={{filemtime(public_path('new/css/app.css'))}}" rel="stylesheet">
    <link href="{{ asset('new/css/app_1.css') }}?v={{filemtime(public_path('new/css/app_1.css'))}}" rel="stylesheet">
    <link href="{{ asset('libs/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="{{ asset('libs/font-awesome/css/all.min.css') }}" rel="stylesheet">

    @yield('head')
    @stack('css')
</head>
<body class="h-full font-sans antialiased" style="font-family: 'Manrope', sans-serif;">
    <div class="min-h-full bg-bg-secondary">
        <!-- Header -->
        <header class="bg-white sticky top-0 z-50 shadow-sm">
            <div class="w-full">
                <div class="flex items-center justify-between gap-3 px-8 py-4" style="padding-left: 32px; padding-right: 32px;">
                    <!-- Logo -->
                    <div class="flex items-center gap-3">
                        <a href="{{ route('new-index') }}">
                            <img src="{{ asset('images/green-logo.png') }}" alt="UpperLicense" class="h-[31px] w-auto" style="width:150px;height:31px;"/>
                        </a>
                        <!-- Admin Navigation -->
                        <nav class="hidden md:flex items-center gap-1 px-2 py-2">
                            @php
                                $locale = app()->getLocale();
                            @endphp
                            <!-- Пользователи -->
                            <a href="/{{ $locale }}/admin/users" 
                               class="flex items-center gap-[6px] px-[18px] py-[13px] rounded-[60px] text-text-primary text-xs font-medium leading-[1.4] transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-gray-200' : '' }}">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.6667 17.5V15.8333C16.6667 14.9493 16.3155 14.1014 15.6904 13.4763C15.0652 12.8512 14.2174 12.5 13.3333 12.5H6.66667C5.78261 12.5 4.93477 12.8512 4.30964 13.4763C3.68452 14.1014 3.33333 14.9493 3.33333 15.8333V17.5" stroke="#279760" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10 9.16667C11.8409 9.16667 13.3333 7.67428 13.3333 5.83333C13.3333 3.99238 11.8409 2.5 10 2.5C8.15905 2.5 6.66667 3.99238 6.66667 5.83333C6.66667 7.67428 8.15905 9.16667 10 9.16667Z" stroke="#279760" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Пользователи
                            </a>

                            <!-- Категории услуг -->
                            <a href="/{{ $locale }}/admin/service_category" 
                               class="flex items-center gap-[6px] px-[10px] py-[10px] rounded-[60px] text-text-primary text-xs font-medium leading-[1.4] transition-colors {{ request()->routeIs('admin.service_category') ? 'bg-gray-200' : '' }}">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18.3333 15C18.3333 15.442 18.1577 15.866 17.845 16.1785C17.5323 16.491 17.1087 16.6667 16.6667 16.6667H3.33333C2.89131 16.6667 2.46738 16.491 2.15482 16.1785C1.84226 15.866 1.66667 15.442 1.66667 15V5C1.66667 4.55797 1.84226 4.13405 2.15482 3.82149C2.46738 3.50893 2.89131 3.33333 3.33333 3.33333H7.5L9.16667 5.83333H16.6667C17.1087 5.83333 17.5323 6.00893 17.845 6.32149C18.1577 6.63405 18.3333 7.05797 18.3333 7.5V15Z" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Категории услуг
                            </a>

                            <!-- Список услуг -->
                            <a href="/{{ $locale }}/admin/service_list" 
                               class="flex items-center gap-[6px] px-[10px] py-[10px] rounded-[60px] text-text-primary text-xs font-medium leading-[1.4] transition-colors {{ request()->routeIs('admin.service_list') || request()->routeIs('admin.service.*') ? 'bg-gray-200' : '' }}">
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

                            <!-- Импорт услуг -->
                            <a href="/{{ $locale }}/admin/service_import" 
                               class="flex items-center gap-[6px] px-[10px] py-[10px] rounded-[60px] text-text-primary text-xs font-medium leading-[1.4] transition-colors {{ request()->routeIs('admin.service_import') ? 'bg-gray-200' : '' }}">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 2.5V17.5" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M17.5 10L10 2.5L2.5 10" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Импорт
                            </a>
                        </nav>
                    </div>

                    <!-- Right side controls -->
                    <div class="flex items-center gap-2 px-2 py-2">
                        <!-- User info -->
                        @auth
                            <div class="flex items-center gap-2">
                                <span class="text-sm text-text-primary">{{ \Illuminate\Support\Str::limit(Auth::user()->name, 20) }}</span>
                            </div>
                        @endauth

                        <!-- Logout -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                        <button type="submit" form="logout-form" 
                           class="flex items-center gap-[6px] px-4 py-4 rounded-[60px] border border-border-light text-text-primary text-sm font-medium leading-[1] hover:bg-bg-tertiary transition-colors">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.25 12.25H2.625C2.42609 12.25 2.23532 12.171 2.09467 12.0303C1.95402 11.8897 1.875 11.6989 1.875 11.5V2.5C1.875 2.30109 1.95402 2.11032 2.09467 1.96967C2.23532 1.82902 2.42609 1.75 2.625 1.75H5.25" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9.1875 9.625L12.125 7L9.1875 4.375" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12.125 7H5.25" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Выйти
                        </button>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Divider -->
        <div class="w-full h-px bg-gray-300"></div>

        <!-- Breadcrumbs -->
        @include('components.breadcrumbs-cabinet')

        <!-- Main Content -->
        <main class="flex-1 bg-bg-secondary" style="min-height: calc(100vh - 200px);">
            <div class="container-fluid py-4">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('libs/jquery-3.5.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    @if(Auth::check() && !Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client))
        <!-- Vue.js and admin scripts -->
        <script src="{{ asset('js/manifest.js') }}"></script>
        <script src="{{ asset('js/vendor.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>

        <script type="text/javascript" src="{{asset('libs/jquerymask/dist/jquery.mask.js')}}"></script>
        <script type="text/javascript" src="{{asset('libs/jquery.inputmask.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('libs/jqueryform/dist/jquery.form.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/customScript1.js')}}"></script>
        <script type="text/javascript" src="{{asset('libs/jquery-ui.min.js')}}"></script>
        <script src="{{asset('libs/splide/splide.min.js')}}"></script>

        <script type="text/javascript" src="{{asset('libs/moment/js/moment.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('libs/scrollTo/dist/jQuery.scrollTo.min.js')}}"></script>

        <script src="{{asset('js/numberInWords.js')}}"></script>
        <script type="text/javascript" src="{{asset('libs/ckeditor/ckeditor.js')}}"></script>
        <script type="text/javascript" src="{{asset('libs/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
        <script type="text/javascript" src="{{asset('libs/bootstrap-datepicker/locales/bootstrap-datepicker.ru.min.js')}}"></script>

        <script src="{{asset('libs/calendar/jquery.simple-calendar.js')}}"></script>
    @endif

    @yield('header-js')
    @yield('footer-js')
    @yield('element-js')
    @yield('services-js')
    @yield('js')

    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
</body>
</html>
