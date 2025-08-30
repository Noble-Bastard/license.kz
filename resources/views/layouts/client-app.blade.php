<!doctype html>
<html lang="{{ \Illuminate\Support\Facades\App::getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('meta-description')">
    <meta name="title" content="@yield('title')">

    <meta property="og:title" content="@yield('title')"/>
    <meta property="og:url" content="{{url()->full()}}"/>
    <meta property="og:description" content="@yield('meta-description')">
    <meta property="og:type" content="article"/>
    <meta property="og:locale" content="ru_RU"/>
    <meta property="og:locale:alternate" content="en_US"/>
    <meta name="google-site-verification" content="CyI7FtHPkEl2j3NlCIHdjhD9PBEdD3Z9nCYD3I44FY8" />
    <meta name="facebook-domain-verification" content="q94r2el0gik2luew169nft0lnmyy5j" />

    @stack('css')
    {{-- <link href="{{mix('new/css/app.css')}}" rel="stylesheet"> --}}
    
    <!-- Tailwind CSS для страниц клиента -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js для интерактивности -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <link href="{{asset('libs/jquery-ui.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('libs/font-awesome/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}"/>

    <!-- Variables CSS -->
    <link href="{{ asset('css/variables.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {"csrfToken": "{!!csrf_token()!!}"};
        window.default_locale = "{{ \Illuminate\Support\Facades\App::getLocale() }}";
        window.fallback_locale = "{{ config('app.fallback_locale') }}";
    </script>

    @yield('css')
</head>

<body class="h-full font-sans antialiased" style="font-family: 'Manrope', sans-serif;" x-data="clientHeader()" x-init="init()">
    <div class="min-h-full bg-gray-50">
        <!-- Header -->
        <header class="bg-white border-b border-gray-200">
            <div class="w-full">
                <!-- Top section with logo, navigation, and user controls -->
                <div class="flex items-center justify-between gap-5 px-5 py-2" style="padding-left: 40px; padding-right: 40px;">
                    <!-- Logo -->
                    <div class="flex items-center gap-5">
                        <img src="{{ asset('images/green-logo.png') }}" alt="UpperLicense" class="h-[31px] w-auto" style="width:150px;height:31px;"/>
                    </div>

                    <!-- Navigation Pills -->
                    <div class="flex items-center gap-[10px] px-4 py-4">
                        <!-- Услуги -->
                        <a href="{{ route('Client.service.list') }}" 
                           class="flex items-center gap-[6px] px-[18px] py-[13px] rounded-[60px] text-gray-600 text-xs font-medium leading-[1.4] hover:bg-gray-100 transition-colors {{ request()->routeIs('Client.service.list') ? 'bg-gray-100 text-green-600' : '' }}">
                            <!-- Service icon -->
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.5 5H6.66667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M17.5 10H6.66667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M17.5 15H6.66667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2.5 5H2.50833" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2.5 10H2.50833" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2.5 15H2.50833" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Услуги
                        </a>

                        <!-- Документы -->
                        <a href="{{ route('profile.documentList') }}" 
                           class="flex items-center gap-[6px] px-[18px] py-[13px] rounded-[60px] text-gray-600 text-xs font-medium leading-[1.4] hover:bg-gray-100 transition-colors {{ request()->routeIs('profile.documentList') ? 'bg-gray-100 text-green-600' : '' }}">
                            <!-- Document icon -->
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.6667 1.66667H5C4.55797 1.66667 4.13405 1.84226 3.82149 2.15482C3.50893 2.46738 3.33333 2.89131 3.33333 3.33333V16.6667C3.33333 17.1087 3.50893 17.5326 3.82149 17.8452C4.13405 18.1577 4.55797 18.3333 5 18.3333H15C15.442 18.3333 15.866 18.1577 16.1785 17.8452C16.491 17.5326 16.6667 17.1087 16.6667 16.6667V6.66667L11.6667 1.66667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M11.6667 1.66667V6.66667H16.6667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Документы
                        </a>

                        <!-- Бухгалтерия -->
                        <a href="{{ route('profile.bookkeeping') }}" 
                           class="flex items-center gap-[6px] px-[18px] py-[13px] rounded-[60px] text-gray-600 text-xs font-medium leading-[1.4] hover:bg-gray-100 transition-colors {{ request()->routeIs('profile.bookkeeping') ? 'bg-gray-100 text-green-600' : '' }}">
                            <!-- Calculator icon -->
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.8333 3.33333H4.16667C3.24619 3.33333 2.5 4.07952 2.5 5V15C2.5 15.9205 3.24619 16.6667 4.16667 16.6667H15.8333C16.7538 16.6667 17.5 15.9205 17.5 15V5C17.5 4.07952 16.7538 3.33333 15.8333 3.33333Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.66667 6.66667H13.3333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.66667 10H6.675" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 10H10.0083" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M13.3333 10H13.3417" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.66667 13.3333H6.675" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 13.3333H10.0083" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M13.3333 13.3333H13.3417" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Бухгалтерия
                        </a>

                        <!-- Сообщения -->
                        <a href="{{ route('Client.service.message.list') }}" 
                           class="flex items-center gap-[6px] px-[18px] py-[13px] rounded-[60px] text-gray-600 text-xs font-medium leading-[1.4] hover:bg-gray-100 transition-colors {{ request()->routeIs('Client.service.message.list') ? 'bg-gray-100 text-green-600' : '' }}">
                            <!-- Message icon -->
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.5 12.5C17.5 13.163 17.2366 13.7989 16.7678 14.2678C16.2989 14.7366 15.663 15 15 15H5L2.5 17.5V5C2.5 4.33696 2.76339 3.70107 3.23223 3.23223C3.70107 2.76339 4.33696 2.5 5 2.5H15C15.663 2.5 16.2989 2.76339 16.7678 3.23223C17.2366 3.70107 17.5 4.33696 17.5 5V12.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Сообщения
                        </a>
                    </div>

                    <!-- Right side controls -->
                    <div class="flex items-center gap-5 px-4 py-4">
                        <!-- Notifications -->
                        <div class="relative">
                            <button class="flex items-center justify-center w-[46px] h-[46px] rounded-[60px] border border-gray-300 hover:bg-gray-100 transition-colors">
                                <!-- Bell icon -->
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 6.66667C15 5.34058 14.4732 4.06881 13.5355 3.13114C12.5979 2.19348 11.3261 1.66667 10 1.66667C8.67392 1.66667 7.40215 2.19348 6.46447 3.13114C5.52678 4.06881 5 5.34058 5 6.66667C5 12.5 2.5 14.1667 2.5 14.1667H17.5C17.5 14.1667 15 12.5 15 6.66667Z" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11.4417 17.5C11.2952 17.7526 11.0849 17.9622 10.8319 18.1088C10.5789 18.2553 10.292 18.333 10 18.333C9.70804 18.333 9.42117 18.2553 9.16816 18.1088C8.91515 17.9622 8.70486 17.7526 8.55835 17.5" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <!-- Notification dot -->
                                <div class="absolute top-1 right-1 w-[10px] h-[10px] bg-red-500 rounded-full"></div>
                            </button>
                        </div>

                        <!-- User Profile -->
                        <div class="relative">
                            <button @click="showProfileModal = !showProfileModal" 
                                    class="flex items-center justify-center w-[46px] h-[46px] rounded-[60px] border border-gray-300 hover:bg-gray-100 transition-colors">
                                @if(Auth::check() && Auth::user()->profile && Auth::user()->profile->photo_id != null)
                                    <img src="/storage_/{{Auth::user()->profile->photo_path}}" 
                                         class="w-[40px] h-[40px] rounded-full object-cover">
                                @else
                                    <!-- User icon -->
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.6667 17.5V15.8333C16.6667 14.9493 16.3155 14.1014 15.6904 13.4763C15.0652 12.8512 14.2174 12.5 13.3333 12.5H6.66667C5.78261 12.5 4.93477 12.8512 4.30964 13.4763C3.68452 14.1014 3.33333 14.9493 3.33333 15.8333V17.5" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M10 9.16667C11.8409 9.16667 13.3333 7.67428 13.3333 5.83333C13.3333 3.99238 11.8409 2.5 10 2.5C8.15905 2.5 6.66667 3.99238 6.66667 5.83333C6.66667 7.67428 8.15905 9.16667 10 9.16667Z" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                @endif
                            </button>
                        </div>

                        <!-- Logout Button -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                        <button type="submit" form="logout-form"
                                class="flex items-center gap-[6px] px-4 py-4 rounded-[60px] border border-gray-300 text-gray-600 text-sm font-medium leading-[1] hover:bg-gray-100 transition-colors">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.25 12.25H2.625C2.42609 12.25 2.23532 12.171 2.09467 12.0303C1.95402 11.8897 1.875 11.6989 1.875 11.5V2.5C1.875 2.30109 1.95402 2.11032 2.09467 1.96967C2.23532 1.82902 2.42609 1.75 2.625 1.75H5.25M9.625 9.625L12.25 7M12.25 7L9.625 4.375M12.25 7H5.25" stroke="currentColor" stroke-width="1.31" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Выйти
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Profile Modal -->
        @include('Client.partials.profile-modal')

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{asset('libs/jquery/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    @stack('scripts')

    <script>
    function clientHeader() {
        return {
            showProfileModal: false,
            
            init() {
                // Initialize header functionality
            }
        }
    }
    </script>
    
    @include('layouts.metrix')
</body>
</html>
