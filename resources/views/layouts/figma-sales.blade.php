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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-oqVuAfXRKap7fdgcCY5uykM6+R9GqQ8K/ux0ZtK6xZbVjQm0wW1G5GJbG4Gx7nQ8yYk6n4I1lqXfZCwZ0j+8Q==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <style>[x-cloak]{ display:none !important; }</style>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @yield('head')
    @stack('head')
    @stack('table-styles')
</head>

<body class="h-full font-sans antialiased" style="font-family: 'Manrope', sans-serif;">
    <div class="min-h-full bg-bg-secondary">
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
