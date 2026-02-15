<!doctype html>
<html lang="{{ \Illuminate\Support\Facades\App::getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <meta name="keywords"
          content="@yield('keywords')">
    <meta name="description" content="@yield('meta-description')">
    <meta name="title" content="@yield('title')">

    <meta property="og:title" content="@yield('title')"/>
    <meta property="og:url" content="{{url()->full()}}"/>
    <meta property="og:description" content="@yield('meta-description')">
    {{--    <meta property="og:image" content="{{asset('/img/share_icon.jpg')}}">--}}
    <meta property="og:type" content="article"/>
    <meta property="og:locale" content="ru_RU"/>
    <meta property="og:locale:alternate" content="en_US"/>
    <meta name="google-site-verification" content="CyI7FtHPkEl2j3NlCIHdjhD9PBEdD3Z9nCYD3I44FY8" />
    <meta name="facebook-domain-verification" content="q94r2el0gik2luew169nft0lnmyy5j" />

    @stack('css')
    <link href="{{asset('css/app_new.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('libs/jquery-ui.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    @if(Auth::check() && !Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client))
        <link href="{{asset('libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet"
              type="text/css">
    @endif

    @yield('css')

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

    <link href="{{asset('libs/font-awesome/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}"/>
    <!-- Prefetch services page for faster modal loading -->
    <link rel="prefetch" href="{{ route('new-services') }}" as="document">
    <!-- Tailwind CSS for modal backdrop blur -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = {"csrfToken": "{!!csrf_token()!!}"};
        window.default_locale = "{{ \Illuminate\Support\Facades\App::getLocale() }}";
        window.fallback_locale = "{{ config('app.fallback_locale') }}";
        
        // Define modal functions immediately - must be available before page loads
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
        
        // Define reset password modal functions
        window.openResetPasswordModal = function(email, token) {
            try {
                var modal = document.getElementById('resetPasswordModal');
                if (modal) {
                    // Set email and token if provided
                    if (email) {
                        var emailInput = modal.querySelector('#email');
                        if (emailInput) {
                            emailInput.value = email;
                        }
                    }
                    if (token) {
                        var tokenInput = modal.querySelector('input[name="token"]');
                        if (tokenInput) {
                            tokenInput.value = token;
                        }
                    }
                    modal.style.display = 'block';
                    document.body.classList.add('modal-open-reset-password');
                    document.body.style.overflow = 'hidden';
                }
            } catch (e) {
                console.error('Error opening reset password modal:', e);
            }
            return false;
        };
        
        window.closeResetPasswordModal = function() {
            try {
                var modal = document.getElementById('resetPasswordModal');
                if (modal) {
                    modal.style.animation = 'fadeOut 0.3s ease-out';
                    setTimeout(function() {
                        modal.style.display = 'none';
                        modal.style.animation = '';
                        document.body.classList.remove('modal-open-reset-password');
                        document.body.style.overflow = '';
                    }, 300);
                }
            } catch (e) {
                console.error('Error closing reset password modal:', e);
            }
            return false;
        };
        
        window.closeResetPasswordModal = function() {
            try {
                var modal = document.getElementById('resetPasswordModal');
                if (modal) {
                    modal.style.animation = 'fadeOut 0.3s ease-out';
                    setTimeout(function() {
                        modal.style.display = 'none';
                        modal.style.animation = '';
                        document.body.classList.remove('modal-open-reset-password');
                        document.body.style.overflow = '';
                    }, 300);
                }
            } catch (e) {
                console.error('Error closing reset password modal:', e);
            }
            return false;
        };
        
        // Define forgot password modal functions
        window.openForgotPasswordModal = function() {
            try {
                var modal = document.getElementById('forgotPasswordModal');
                if (modal) {
                    // Close login modal if open
                    if (typeof window.closeLoginModal === 'function') {
                        window.closeLoginModal();
                    }
                    modal.style.display = 'block';
                    document.body.classList.add('modal-open-forgot-password');
                    document.body.style.overflow = 'hidden';
                }
            } catch (e) {
                console.error('Error opening forgot password modal:', e);
            }
            return false;
        };
        
        window.closeForgotPasswordModal = function() {
            try {
                var modal = document.getElementById('forgotPasswordModal');
                if (modal) {
                    modal.style.animation = 'fadeOut 0.3s ease-out';
                    setTimeout(function() {
                        modal.style.display = 'none';
                        modal.style.animation = '';
                        document.body.classList.remove('modal-open-forgot-password');
                        document.body.style.overflow = '';
                    }, 300);
                }
            } catch (e) {
                console.error('Error closing forgot password modal:', e);
            }
            return false;
        };
        
        // Unified function to check if services modal is open
        // This solves problem #2: single source of truth for modal state
        window.isServicesModalOpen = function() {
            try {
                var modal = document.getElementById('servicesModal');
                var appWrapper = document.getElementById('app');
                
                // Check iframe modal
                var modalDisplay = modal ? (modal.style.display || window.getComputedStyle(modal).display) : 'none';
                var isIframeModalOpen = modalDisplay === 'block';
                
                // Check direct access modal
                var appPosition = appWrapper ? (appWrapper.style.position || window.getComputedStyle(appWrapper).position) : '';
                var isDirectAccessOpen = appPosition === 'fixed';
                
                return isIframeModalOpen || isDirectAccessOpen;
            } catch (e) {
                console.error('Error checking modal state:', e);
                return false;
            }
        };
        
        // Toggle services modal function - improved version
        // Define it early so it's available when header loads
        window._servicesModalToggling = false; // Flag to prevent double toggling
        window.toggleServicesModal = function() {
            try {
                // Prevent double toggling - improved: use requestAnimationFrame for better timing
                if (window._servicesModalToggling) {
                    console.log('Toggle already in progress, skipping...');
                    return false;
                }
                
                // Set flag immediately
                window._servicesModalToggling = true;
                
                // Use unified function to check state
                var isModalOpen = window.isServicesModalOpen();
                
                console.log('toggleServicesModal: isModalOpen=', isModalOpen);
                
                if (isModalOpen) {
                    // Close modal
                    console.log('Closing modal...');
                    if (typeof window.closeServicesModal === 'function') {
                        window.closeServicesModal();
                        // Flag will be reset in closeServicesModal after operation completes
                    } else {
                        console.error('closeServicesModal function not found!');
                        window._servicesModalToggling = false;
                    }
                } else {
                    // Open modal
                    console.log('Opening modal...');
                    if (typeof window.openServicesModal === 'function') {
                        window.openServicesModal();
                        // Flag will be reset in openServicesModal after operation completes
                    } else {
                        // Fallback: redirect to services page
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
        
        // Ensure body is not blocked on page load
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                document.body.classList.remove('modal-open');
                document.body.classList.remove('modal-open-reset-password');
                document.body.style.overflow = '';
                
                // Check if we're on services page and open modal instead
                checkAndOpenServicesModal();
            });
        } else {
            document.body.classList.remove('modal-open');
            document.body.classList.remove('modal-open-reset-password');
            document.body.style.overflow = '';
            
            // Check if we're on services page and open modal instead
            checkAndOpenServicesModal();
        }
        
        // Function to check URL and open services modal if needed
        function checkAndOpenServicesModal() {
            var currentPath = window.location.pathname;
            // Check if path ends with /new-services
            if (currentPath.match(/\/new-services$/)) {
                // Get locale from path
                var pathParts = currentPath.split('/').filter(function(part) {
                    return part.length > 0;
                });
                var locale = 'en';
                if (pathParts.length > 0 && ['en', 'ru', 'kz'].includes(pathParts[0])) {
                    locale = pathParts[0];
                }
                
                // Change URL to home page without reload FIRST
                var homeUrl = '/' + locale;
                window.history.replaceState({}, '', homeUrl);
                
                // Hide footer, keep header visible
                var footer = document.querySelector('footer, .footer, [class*="footer"]');
                if (footer) footer.style.display = 'none';
                
                // Make the services page content fullscreen (as modal)
                var appWrapper = document.getElementById('app');
                if (appWrapper) {
                    // Check if mobile view
                    var isMobile = window.matchMedia('(max-width: 991.98px)').matches;
                    
                    // Keep header exactly as on main page - ensure it's above modal
                    // BUT hide it on mobile devices
                    var header = document.querySelector('header.header-redesigned');
                    if (header) {
                        if (isMobile) {
                            // Hide header on mobile - services-inline-header will be shown instead
                            header.style.display = 'none';
                            header.style.visibility = 'hidden';
                            header.style.height = '0';
                            header.style.overflow = 'hidden';
                            header.style.margin = '0';
                            header.style.padding = '0';
                            header.style.opacity = '0';
                            header.style.pointerEvents = 'none';
                        } else {
                            // Keep header visible and above modal content on desktop
                            header.style.display = 'flex';
                            header.style.position = 'sticky';
                            header.style.top = '0';
                            header.style.zIndex = '10000'; // Higher than appWrapper (9999)
                            header.style.background = '#FFFFFF';
                        }
                    }
                    
                    // Start modal content below header (not from top: 0)
                    appWrapper.style.position = 'fixed';
                    if (isMobile) {
                        // On mobile, start from top since header is hidden
                        appWrapper.style.top = '0';
                        appWrapper.style.height = '100%';
                    } else {
                        // On desktop, start below header
                        appWrapper.style.top = '78px'; // Start below header (header height is 78px)
                        appWrapper.style.height = 'calc(100% - 78px)'; // Full height minus header
                    }
                    appWrapper.style.left = '0';
                    appWrapper.style.width = '100%';
                    appWrapper.style.zIndex = '9999';
                    appWrapper.style.background = '#ffffff';
                    appWrapper.style.overflow = 'auto';
                    appWrapper.style.margin = '0';
                    appWrapper.style.padding = '0';
                    
                    // Add padding-top to show content
                    var servicesPage = appWrapper.querySelector('.services-new-page');
                    if (servicesPage) {
                        servicesPage.style.marginTop = '0';
                        if (isMobile) {
                            servicesPage.style.paddingTop = '0'; // No padding on mobile since header is hidden
                        } else {
                            servicesPage.style.paddingTop = '20px'; // Less padding since header is already above
                        }
                    } else {
                        // If services-new-page not found, add padding to wrapper
                        if (!isMobile) {
                            appWrapper.style.paddingTop = '20px';
                        }
                    }
                    
                    // Update services button state (the onclick in header will handle closing)
                    setTimeout(function() {
                        var servicesBtn = document.getElementById('servicesToggleBtn');
                        if (servicesBtn) {
                            servicesBtn.classList.add('active');
                            var menuIcon = document.getElementById('servicesMenuIcon');
                            var closeIcon = document.getElementById('servicesCloseIcon');
                            if (menuIcon) menuIcon.style.display = 'none';
                            if (closeIcon) closeIcon.style.display = 'flex';
                            // Don't override onclick - let the header's onclick handle it
                            // It will detect that appWrapper.position === 'fixed' and call closeServicesModal
                        }
                    }, 100);
                    
                    document.body.style.overflow = 'hidden';
                }
            }
        }
        
        // Override closeServicesModal to restore page when closing from direct access
        var originalCloseServicesModal = window.closeServicesModal;
        window.closeServicesModal = function() {
            console.log('closeServicesModal called');
            var appWrapper = document.getElementById('app');
            var modal = document.getElementById('servicesModal');
            
            // Check if we're in direct access mode (appWrapper is fixed)
            // Check both inline style and computed style
            var appPosition = appWrapper ? (appWrapper.style.position || window.getComputedStyle(appWrapper).position) : '';
            var isDirectAccess = appWrapper && appPosition === 'fixed';
            
            // Or if iframe modal is open
            var modalDisplay = modal ? (modal.style.display || window.getComputedStyle(modal).display) : '';
            var isIframeModal = modal && modalDisplay === 'block';
            
            console.log('closeServicesModal: isDirectAccess=', isDirectAccess, 'isIframeModal=', isIframeModal, 'appPosition=', appPosition);
            
            if (isDirectAccess) {
                console.log('Closing direct access modal');
                // Check if mobile view
                var isMobile = window.matchMedia('(max-width: 991.98px)').matches;
                
                // Restore page from direct access mode
                appWrapper.style.position = '';
                appWrapper.style.top = '';
                appWrapper.style.left = '';
                appWrapper.style.width = '';
                appWrapper.style.height = '';
                appWrapper.style.zIndex = '';
                appWrapper.style.background = '';
                appWrapper.style.overflow = '';
                appWrapper.style.margin = '';
                appWrapper.style.padding = '';
                
                // Reset services page padding
                var servicesPage = appWrapper.querySelector('.services-new-page');
                if (servicesPage) {
                    servicesPage.style.paddingTop = '';
                }
                
                var footer = document.querySelector('footer, .footer, [class*="footer"]');
                if (footer) footer.style.display = '';
                
                // Restore header - remove any inline styles we might have added
                var header = document.querySelector('header.header-redesigned');
                if (header) {
                    if (isMobile) {
                        // On mobile, keep header hidden
                        header.style.display = 'none';
                        header.style.visibility = 'hidden';
                        header.style.height = '0';
                        header.style.overflow = 'hidden';
                        header.style.margin = '0';
                        header.style.padding = '0';
                        header.style.opacity = '0';
                        header.style.pointerEvents = 'none';
                    } else {
                        // On desktop, restore header styles
                        header.style.display = '';
                        header.style.position = '';
                        header.style.top = '';
                        header.style.zIndex = '';
                        header.style.background = '';
                        header.style.visibility = '';
                        header.style.height = '';
                        header.style.overflow = '';
                        header.style.margin = '';
                        header.style.padding = '';
                        header.style.opacity = '';
                        header.style.pointerEvents = '';
                    }
                }
                
                document.body.style.overflow = '';
                
                // Update services button state
                var servicesBtn = document.getElementById('servicesToggleBtn');
                if (servicesBtn) {
                    servicesBtn.classList.remove('active');
                    var menuIcon = document.getElementById('servicesMenuIcon');
                    var closeIcon = document.getElementById('servicesCloseIcon');
                    if (menuIcon) menuIcon.style.display = 'flex';
                    if (closeIcon) closeIcon.style.display = 'none';
                    
                    // Restore toggle function
                    servicesBtn.setAttribute('onclick', 'toggleServicesModal(); return false;');
                }
                
                // Redirect to home
                var pathParts = window.location.pathname.split('/').filter(function(part) {
                    return part.length > 0;
                });
                var locale = 'en';
                if (pathParts.length > 0 && ['en', 'ru', 'kz'].includes(pathParts[0])) {
                    locale = pathParts[0];
                }
                // Problem #3 solution: Add delay before redirect to allow animation to complete
                setTimeout(function() {
                    window.location.href = '/' + locale;
                }, 300); // Match animation duration
            } else if (isIframeModal) {
                // Use original function for iframe modal
                if (originalCloseServicesModal) {
                    originalCloseServicesModal();
                }
            }
            return false;
        };
    </script>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-5JG58R4B');</script>
	<!-- End Google Tag Manager -->
</head>
<body>
    <div class="client-app">
        @include('new-redesign.partials.header')
        <div id="app" class="wrapper wrapper-{{ optional(request()->route())->getName() }}">
            @yield('content')
            @include('new-redesign.partials.footer')
        </div>
    </div>
    @include('new-redesign.partials.modal.services')
    @include('new.partials.modal.login')
    @include('new.partials.modal.reset_password')
    @include('new.partials.modal.forgot_password')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    @if(Auth::check() && !Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client))
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/app.js') }}"></script>
        <script src="{{ mix('js/manifest.js') }}"></script>

        <script type="text/javascript" src="{{asset('libs/jquerymask/dist/jquery.mask.js')}}"></script>
        <script type="text/javascript" src="{{asset('libs/jquery.inputmask.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('libs/jqueryform/dist/jquery.form.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/customScript1.js')}}"></script>
        <script type="text/javascript" src="{{asset('libs/jquery-ui.min.js')}}"></script>
        <script src="{{asset('libs/splide/splide.min.js')}}"></script>

        <script type="text/javascript" src="{{asset('libs/moment/js/moment.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('libs/jqueryform/dist/jquery.form.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('libs/scrollTo/dist/jQuery.scrollTo.min.js')}}"></script>

        <script src="{{asset('js/numberInWords.js')}}"></script>
        <script type="text/javascript" src="{{asset('libs/ckeditor/ckeditor.js')}}"></script>
        <script type="text/javascript" src="{{asset('libs/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
        <script type="text/javascript"
                src="{{asset('libs/bootstrap-datepicker/locales/bootstrap-datepicker.ru.min.js')}}"></script>


        <script src="{{asset('libs/calendar/jquery.simple-calendar.js')}}"></script>
    @else

        <script type="text/javascript" src="{{asset('libs/jquery-3.5.1.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('libs/bootstrap/js/bootstrap.min.js')}}"></script>

        <script type="text/javascript" src="{{asset('libs/jquerymask/dist/jquery.mask.js')}}"></script>
        <script type="text/javascript" src="{{asset('libs/jquery.inputmask.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('libs/jqueryform/dist/jquery.form.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/customScript.js')}}"></script>
        <script type="text/javascript" src="{{asset('libs/jquery-ui.min.js')}}"></script>
        <script src="{{asset('libs/splide/splide.min.js')}}"></script>

        <script type="text/javascript" src="{{asset('libs/moment/js/moment.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('libs/jqueryform/dist/jquery.form.min.js')}}"></script>
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
    $(document).ready(function () {

        let id_count = 0;

        $('.play-video').on('click', function (e) {
            let videoUrl = $(this).data('url') ?? "https://www.youtube.com/embed/ZdUFNtPZeXM"

            e.preventDefault();
            let frame = $('<iframe width="560" height="315" src="' + videoUrl + '" frameborder="0" allow="autoplay; fullscreen" id="iframe-' + id_count + '"></iframe>');
            $("#video-overlay").append(frame);
            $('#video-overlay').addClass('open');
            setTimeout(add_autoplay_for_iframe(id_count), 100);
            id_count++;

        });

        $('.video-overlay, .video-overlay-close').on('click', function (e) {
            e.preventDefault();
            close_video();
        });
    })

    function add_autoplay_for_iframe(id_count) {
        let frame = document.getElementById('iframe-' + id_count);
        frame.src = frame.src + '?autoplay=1';
    }

    function close_video() {
        $('.video-overlay.open').removeClass('open').find('iframe').remove();
    };
</script>
    @include('layouts.metrix')
</body>
</html>
