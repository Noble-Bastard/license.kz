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

    <link href="{{asset('libs/font-awesome/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}"/>

    <!-- Scripts -->
    <script>
        window.Laravel = {"csrfToken": "{!!csrf_token()!!}"};
        window.default_locale = "{{ \Illuminate\Support\Facades\App::getLocale() }}";
        window.fallback_locale = "{{ config('app.fallback_locale') }}";
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
