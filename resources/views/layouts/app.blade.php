<!DOCTYPE html>
<html lang="{{ \Illuminate\Support\Facades\App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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


    <!-- Styles -->
    {{--    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"--}}
    {{--          type="text/css"/>--}}
    {{--    <link href="{{asset('libs/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">--}}
    <link href="{{asset('libs/font-awesome/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{mix('css/app_new.css')}}" rel="stylesheet" type="text/css">
    <link href="{{mix('css/app_1.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('libs/jquery-ui.min.css')}}" rel="stylesheet" type="text/css">
    {{--    <link href="https://db.onlinewebfonts.com/c/13ab13418f633c1b0516fed6e30bedbc?family=Suisse+Int'l" rel="stylesheet" type="text/css"/>--}}
    <link rel="stylesheet" href="{{asset('libs/splide/splide.min.css')}}">

    @if(Auth::check() && !Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client))
        <link href="{{asset('libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet"
              type="text/css">
    @endif

    @yield('css')


    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}"/>


    <!-- Scripts -->
    <script>
        window.Laravel = {"csrfToken": "{!!csrf_token()!!}"};
        window.default_locale = "{{ \Illuminate\Support\Facades\App::getLocale() }}";
        window.fallback_locale = "{{ config('app.fallback_locale') }}";
    </script>

</head>
<body class="d-flex flex-column h-100">

<div id="app" class="flex-shrink-0 ">
    @yield('header__background')

    @include('layouts.header')

    @yield('breadcrumb')

    @yield('content')

    <notifications group="all"></notifications>
</div>

@include('layouts.footer')

<!-- Scripts -->
<div id="ajax-loader">
</div>

@if(Auth::check() && !Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client))
    <script type="text/javascript" src="{{asset('libs/jquery-3.5.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('libs/jquery-ui.min.js')}}"></script>
    {{--    <script type="text/javascript" src="{{asset('libs/popper.min.js')}}"></script>--}}
    {{--    <script type="text/javascript" src="{{asset('libs/bootstrap/js/bootstrap.min.js')}}"></script>--}}

    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ mix('js/manifest.js') }}"></script>

    {{--<script src="{{asset('libs/popper/dist/js/popper.js')}}"></script>--}}

    <script type="text/javascript" src="{{asset('libs/jquerymask/dist/jquery.mask.js')}}"></script>
    <script type="text/javascript" src="{{asset('libs/moment/js/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('libs/jqueryform/dist/jquery.form.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('libs/scrollTo/dist/jQuery.scrollTo.min.js')}}"></script>

    <script src="{{asset('js/numberInWords.js')}}"></script>
    <script type="text/javascript" src="{{asset('libs/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript" src="{{asset('libs/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('libs/bootstrap-datepicker/locales/bootstrap-datepicker.ru.min.js')}}"></script>

    <script src="{{asset('libs/splide/splide.min.js')}}"></script>
    <script src="{{asset('libs/calendar/jquery.simple-calendar.js')}}"></script>
@else
    <script type="text/javascript" src="{{asset('libs/jquery-3.5.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('libs/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('libs/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('libs/bootstrap/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('libs/jquerymask/dist/jquery.mask.js')}}"></script>
    <script type="text/javascript" src="{{asset('libs/moment/js/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('libs/jqueryform/dist/jquery.form.min.js')}}"></script>
    <script src="{{asset('libs/splide/splide.min.js')}}"></script>
    <script src="{{asset('/libs/jquery.inputmask.min.js')}}"></script>
    <script src="{{asset('libs/calendar/jquery.simple-calendar.js')}}"></script>
@endif

<script>
    let isSideMenuOpen = false

    $(document).ready(function () {
        $(document).on('change', '.custom-file-input', function () {
            //get the file name
            var fileName = this.files[0].name;
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });

        $('input[name="phone"]').inputmask("+7 (999) 999-99-99");


        $('.callMe').submit(function () {
            $(this).ajaxSubmit({
                success: function () {
                    gtag('event', 'send', {'event_category': 'callback'});
                    alert("@lang('messages.client.service_create')")
                }
            })

            return false
        })
        $("#menuToggle").click(function () {
            menuToggle();
        });
        $(document).click(function (event) {
            var clickover = $(event.target);
            var _opened = $(".navbar-collapse").hasClass("show");
            if (_opened === true && !clickover.hasClass("navbar")) {
                $("#menuToggle").click();
            }
        });

        let id_count = 0;

        $('.play-video').on('click', function (e) {
            let videoUrl = $(this).data('url') ?? "https://www.youtube.com/embed/ZdUFNtPZeXM"

            e.preventDefault();
            var frame = $('<iframe width="560" height="315" src="' + videoUrl + '" frameborder="0" allow="autoplay; fullscreen" id="iframe-' + id_count + '"></iframe>');
            $("#video-overlay").append(frame);
            $('#video-overlay').addClass('open');
            setTimeout(add_autoplay_for_iframe(id_count), 100);
            id_count++;

        });

        $('.video-overlay, .video-overlay-close').on('click', function (e) {
            e.preventDefault();
            close_video();
        });
        var $calendar;
        let container = $("#container").simpleCalendar({
            fixedStartDay: 1, // begin weeks by monday
            disableEmptyDetails: true,
            events: [
                //generate new event after tomorrow for one hour
                // {
                //     startDate: new Date(new Date().setHours(new Date().getHours() + 24)).toDateString(),
                //     endDate: new Date(new Date().setHours(new Date().getHours() + 25)).toISOString(),
                //     summary: 'Всем юридическим и физическим лицам, имеющим на своем балансе источники ионизирующего излучения, необходимо представлять в Комитет атомного и энергетического надзора и контроля отчеты  в соответствии с приказом и.о.  Министра энергетики Республики Казахстан от 12 февраля 2016 года №59  «Об утверждении Правил государственного учета источников ионизирующего излучения» (Зарегистрирован в Министерстве юстиции Республики Казахстан 15 марта 2016 года №13458).'
                // },
                // // generate new event for yesterday at noon
                // {
                //     startDate: new Date(new Date().setHours(new Date().getHours() - new Date().getHours() - 12, 0)).toISOString(),
                //     endDate: new Date(new Date().setHours(new Date().getHours() - new Date().getHours() - 11)).getTime(),
                //     summary: 'Restaurant'
                // },
                // // generate new event for the last two days
                // {
                //     startDate: new Date(new Date().setHours(new Date().getHours() - 48)).toISOString(),
                //     endDate: new Date(new Date().setHours(new Date().getHours() - 24)).getTime(),
                //     summary: 'Visit of the Louvre'
                // }
            ],

        });
        $calendar = container.data('plugin_simpleCalendar')

        $('.side-menu__show-hide-btn').click(() => {
            toogleSideMenu()
        })

        $(document).scroll(function () {
            initSideMenu()
        });

        $(document).click(function() {
           $('.event').remove()
        });

        initSideMenu()
    });
    function initSideMenu(){
        if(window.location.pathname === '/' && window.scrollY <= 50){
            isSideMenuOpen = false
        } else {
            isSideMenuOpen = true
        }

        if(window.window.innerWidth < 576){
            isSideMenuOpen = true
        }
        toogleSideMenu()
    }

    function toogleSideMenu() {
        if (isSideMenuOpen) {
            $('.side-menu__big-version').addClass('d-none')
            $('.side-menu__small-version').removeClass('d-none')
            isSideMenuOpen = false
        } else {
            $('.side-menu__small-version').addClass('d-none')
            $('.side-menu__big-version').removeClass('d-none')
            isSideMenuOpen = true
        }
    }

    function menuToggle() {
        if ($(".navbar").hasClass("dark-menu")) {
            $(".navbar").removeClass("dark-menu");
            $(".fa-bars").removeClass("d-none");
            $(".navbar .fa-times").addClass("d-none");
            $("#menuDarkBrand").removeClass("d-none");
            $("#menuWhiteBrand").addClass("d-none");
        } else {
            $(".navbar").addClass("dark-menu");
            $(".fa-bars").addClass("d-none");
            $(".navbar .fa-times").removeClass("d-none");
            $("#menuDarkBrand").addClass("d-none");
            $("#menuWhiteBrand").removeClass("d-none");

        }
    }

    function add_autoplay_for_iframe(id_count) {
        var frame = document.getElementById('iframe-' + id_count);
        frame.src = frame.src + '?autoplay=1';
    }

    function close_video() {
        $('.video-overlay.open').removeClass('open').find('iframe').remove();
    };
    $(function () {
      try {
        $(".search-mobile-modal #SearchMobileModal").autocomplete({
          source: function (request, response) {
            $.get("{{route('service.search')}}", {
              query: request.term
            }, function (data) {
              response(data);
            });
          },
          minLength: 3,
          delay: 500,
          select: function (event, ui) {
            window.location = "/searchSelected/" + ui.item.catalog[0].catalog_id + "/" + ui.item.catalog[0].service_id;
          }
        }).data("ui-autocomplete")._renderItem = function (ul, item) {
          ul.addClass('search-mobile-modal__autocomplete')
          return $("<li>")
            .append("<div>" + item.name + "</div>")
            .appendTo(ul);
        };
      } catch (e) {

      }
    });


</script>
@yield('js')

@include('layouts.metrix')
</body>
</html>
