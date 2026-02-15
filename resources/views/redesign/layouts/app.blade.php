<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}"/>
    <title>@yield('title', 'UPPERLICENSE')</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/normalize.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        /* Global Link Styles - Убираем синий цвет и подчеркивание при клике */
        a,
        a:link,
        a:visited,
        a:active {
            text-decoration: none !important;
            color: inherit;
        }
        
        a:hover {
            text-decoration: none !important;
        }
    </style>
    @yield('css')
</head>
<body>
    @include('redesign.partials.header')
    
    @yield('content')
    
    @include('new.partials.footer')
    
    @yield('header-js')
    
    <!-- Scripts -->
    <script>
        window.Laravel = {"csrfToken": "{!!csrf_token()!!}"};
        window.default_locale = "{{ \Illuminate\Support\Facades\App::getLocale() }}";
        
        // Define login modal functions immediately
        window.openLoginModal = function() {
            try {
                var modal = document.getElementById('loginModal');
                if (modal) {
                    modal.style.display = 'block';
                    document.body.classList.add('modal-open');
                    document.body.style.overflow = 'hidden';
                }
            } catch (e) {
                console.error('Error opening login modal:', e);
            }
            return false;
        };
        
        window.closeLoginModal = function() {
            try {
                var modal = document.getElementById('loginModal');
                if (modal) {
                    modal.style.animation = 'fadeOut 0.3s ease-out';
                    setTimeout(function() {
                        modal.style.display = 'none';
                        modal.style.animation = '';
                        document.body.classList.remove('modal-open');
                        document.body.style.overflow = '';
                    }, 300);
                }
            } catch (e) {
                console.error('Error closing login modal:', e);
            }
            return false;
        };
        
        // Unified function to check if services modal is open
        window.isServicesModalOpen = function() {
            try {
                var modal = document.getElementById('servicesModal');
                var modalDisplay = modal ? (modal.style.display || window.getComputedStyle(modal).display) : 'none';
                return modalDisplay === 'block';
            } catch (e) {
                console.error('Error checking modal state:', e);
                return false;
            }
        };
        
        // Toggle services modal function
        window._servicesModalToggling = false;
        window.toggleServicesModal = function() {
            try {
                if (window._servicesModalToggling) {
                    return false;
                }
                window._servicesModalToggling = true;
                var isModalOpen = window.isServicesModalOpen();
                if (isModalOpen) {
                    if (typeof window.closeServicesModal === 'function') {
                        window.closeServicesModal();
                    } else {
                        window._servicesModalToggling = false;
                    }
                } else {
                    if (typeof window.openServicesModal === 'function') {
                        window.openServicesModal();
                    } else {
                        var pathParts = window.location.pathname.split('/').filter(function(part) {
                            return part.length > 0;
                        });
                        var locale = 'en';
                        if (pathParts.length > 0 && ['en', 'ru', 'kz'].includes(pathParts[0])) {
                            locale = pathParts[0];
                        }
                        window._servicesModalToggling = false;
                        window.location.href = '/' + locale + '/new-services';
                    }
                }
            } catch (e) {
                console.error('Error in toggleServicesModal:', e);
                window._servicesModalToggling = false;
            }
            return false;
        };
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>
    @yield('js')
</body>
</html>
