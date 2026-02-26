<!doctype html>
<html lang="{{ \Illuminate\Support\Facades\App::getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Prevent caching -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

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
    <link href="{{asset('css/variables.css')}}?v={{filemtime(public_path('css/variables.css'))}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/app_new.css')}}?v={{filemtime(public_path('css/app_new.css'))}}" rel="stylesheet" type="text/css">
    <link href="{{asset('new/css/app.css')}}?v={{filemtime(public_path('new/css/app.css'))}}" rel="stylesheet">
    <link href="{{asset('new/css/app_1.css')}}?v={{filemtime(public_path('new/css/app_1.css'))}}" rel="stylesheet">
    <link href="{{asset('libs/jquery-ui.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- Tailwind CSS for modal backdrop blur -->
    <script src="https://cdn.tailwindcss.com"></script>

    @if(Auth::check() && !Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client))
        <link href="{{asset('libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet"
              type="text/css">
    @endif

    @yield('css')

    <link href="{{asset('libs/font-awesome/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}"/>

    <!-- Scripts -->
    <script>
        window.Laravel = {"csrfToken": "{!!csrf_token()!!}"};
        window.default_locale = "{{ \Illuminate\Support\Facades\App::getLocale() }}";
        window.fallback_locale = "{{ config('app.fallback_locale') }}";
        
        // Define login modal functions immediately - must be available before page loads
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
        @include('new.partials.header')
        <div id="app" class="wrapper wrapper-{{ optional(request()->route())->getName() }}">
            @yield('content')
            @include('new.partials.footer')
        </div>
    </div>
    @include('new.partials.modal.login')
    @include('new.partials.modal.reset_password')
    @include('new.partials.modal.forgot_password')
    @include('new-redesign.partials.modal.services')

    <!-- Callback Modal — кастомная модалка как Войти -->
    <div id="consultModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; z-index: 999999; width: 100vw; height: 100vh; overflow: auto; background: rgba(0,0,0,0.4); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);" onclick="if(event.target === this) closeConsultModal();">
        <div style="display: flex; align-items: center; justify-content: center; min-height: 100%; padding: 20px;">
            <div style="position: relative; max-width: 520px; width: 100%; margin: auto;" onclick="event.stopPropagation();">
                <div style="background: #FFFFFF; border-radius: 16px; border: none; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15); overflow: hidden; position: relative;">
                    <button type="button" onclick="closeConsultModal(); return false;" style="position: absolute; top: 16px; right: 16px; z-index: 10; width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center; background: #F5F5F5; border-radius: 50%; border: none; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#E8E8E8'" onmouseout="this.style.background='#F5F5F5'">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 4L4 12M4 4L12 12" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <div style="padding: 40px 32px 32px;">
                        <h3 style="font-family: 'Manrope', sans-serif; font-size: 24px; font-weight: 600; color: #191E1D; margin-bottom: 24px; line-height: 1.3; text-align: center;">Менеджер перезвонит и проконсультирует вас</h3>
                        {!! Form::open(['url' => route('callMe'), 'method' => 'post', 'class' => 'callMe', 'id' => 'consultForm']) !!}
                        <input type="hidden" name="tags" value="Callback">
                        <input type="hidden" name="comment" value="Заказ звонка">
                        <input type="hidden" name="source_page" id="callback_source_page" value="">
                        <input type="hidden" name="button_text" id="callback_button_text" value="">
                        <div style="margin-bottom: 20px;">
                            <div style="display: flex; flex-direction: column; gap: 16px;">
                                <input type="text" class="form-control" name="name" placeholder="Ваше имя" required
                                       style="width: 100%; padding: 14px 16px; border: 1px solid #E8E8E8; border-radius: 8px; font-family: 'Manrope', sans-serif; font-size: 14px; color: #191E1D; background: #FFFFFF; transition: all 0.2s; outline: none;"
                                       onfocus="this.style.borderColor='#279760'; this.style.boxShadow='0 0 0 3px rgba(39,151,96,0.1)'"
                                       onblur="this.style.borderColor='#E8E8E8'; this.style.boxShadow='none'">
                                <input type="text" class="form-control" name="phone" placeholder="Ваш телефон*" required
                                       style="width: 100%; padding: 14px 16px; border: 1px solid #E8E8E8; border-radius: 8px; font-family: 'Manrope', sans-serif; font-size: 14px; color: #191E1D; background: #FFFFFF; transition: all 0.2s; outline: none;"
                                       onfocus="this.style.borderColor='#279760'; this.style.boxShadow='0 0 0 3px rgba(39,151,96,0.1)'"
                                       onblur="this.style.borderColor='#E8E8E8'; this.style.boxShadow='none'">
                            </div>
                        </div>
                        <button type="submit" class="btn modals__success_btn" style="width: 100%; padding: 14px; background: #279760; color: #FFFFFF !important; border: none; border-radius: 8px; font-family: 'Manrope', sans-serif; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.2s; margin-bottom: 16px;" onmouseover="this.style.background='#1e7a50'" onmouseout="this.style.background='#279760'">Отправить</button>
                        <p style="font-family: 'Manrope', sans-serif; font-size: 12px; color: #6F6F6F; text-align: center; margin: 0; line-height: 1.4;">Нажимая кнопку отправить вы даете разрешение на обработку персональных данных</p>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        if (typeof window.openConsultModal === 'undefined') {
            window.openConsultModal = function() {
                var modal = document.getElementById('consultModal');
                if (modal) { modal.style.display = 'block'; document.body.style.overflow = 'hidden'; }
            };
        }
        if (typeof window.closeConsultModal === 'undefined') {
            window.closeConsultModal = function() {
                var modal = document.getElementById('consultModal');
                if (modal) {
                    modal.style.display = 'none';
                    document.body.style.overflow = '';
                    document.body.classList.remove('modal-open');
                    document.body.style.paddingRight = '';
                }
                // Удаляем ВСЕ Bootstrap backdrop-ы
                document.querySelectorAll('.modal-backdrop').forEach(function(el) { el.remove(); });
            };
        }
        document.addEventListener('click', function(e) {
            var el = e.target.closest('[data-bs-target="#consultModal"]');
            if (el) {
                e.preventDefault(); e.stopImmediatePropagation();
                var srcPage = document.getElementById('callback_source_page');
                if (srcPage) srcPage.value = window.location.href;
                var btnText = document.getElementById('callback_button_text');
                if (btnText) btnText.value = el.textContent.trim();
                openConsultModal();
            }
        }, true);
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                var modal = document.getElementById('consultModal');
                if (modal && modal.style.display === 'block') closeConsultModal();
            }
        });
    </script>
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
    
    // Функции для работы с модалкой услуг
    if (typeof window.toggleServicesModal === 'undefined') {
        window.toggleServicesModal = function() {
            var modal = document.getElementById('servicesModal');
            if (modal) {
                var bsModal = bootstrap.Modal.getInstance(modal);
                if (bsModal) {
                    bsModal.toggle();
                } else {
                    bsModal = new bootstrap.Modal(modal);
                    bsModal.show();
                }
            }
        };
    }
    
    if (typeof window.isServicesModalOpen === 'undefined') {
        window.isServicesModalOpen = function() {
            var modal = document.getElementById('servicesModal');
            if (modal) {
                return modal.classList.contains('show');
            }
            return false;
        };
    }
</script>
    @include('layouts.metrix')
</body>
</html>
