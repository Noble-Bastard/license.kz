<div class="header ">
    <div class="container sticky-top ">
        <nav class="navbar navbar-expand-lg pl-0 pr-0 pb-0 pt-0 z-index-primary">

            <div class="navbar-toggler pt-2 pb-2 text-center pr-1 w-100 pl-0">

                <a class="nav-item float-left" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                   aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation" id="menuToggle">
                    <i class="nav-link fal fa-bars"></i>
                    <i class="nav-link fal fa-times d-none"></i>
                </a>
                <a class="navbar-brand mr-0" href="{{route('new-index')}}">
                    <img src="{{asset('images/green-logo.png')}}" id="menuDarkBrand">
                    <img src="{{asset('images/white-green-logo.png')}}" class="d-none" id="menuWhiteBrand">
                </a>
                <div class="nav-item dropdown position-static float-right">
                    <a class="p-2" href="#" id="phoneDropdown" role="button" data-toggle="dropdown"
                       aria-haspopup="false" aria-expanded="false">
                        <img src="{{asset('images/call_icon.png')}}">
                    </a>
                    <div class="dropdown-menu rounded-0 w-100 phone-dropdown" aria-labelledby="phoneDropdown">
                            {!! Form::open(['url' => route('callMe'), 'method' => 'post', 'class' => 'form-inline col-12 callMe']) !!}
                            <div class="input-group">
                                <input class="form-control" type="text" name="phone" placeholder="+7 (xxx) xxx xx xx">
                                <div class="input-group-append">
                                    <button class="btn btn-success"
                                            type="submit">@lang('messages.layouts.order_call')</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <div class="collapse navbar-collapse" id="navbarCollapse" >
                <a class="navbar-brand d-none d-lg-block" href="{{route('new-index')}}"><img
                            src="{{asset('images/green-logo.png')}}"></a>
                <ul class="navbar-nav menu mx-auto">
                    @include('layouts.menu')
                </ul>
                <ul class="navbar-nav mobile-navbar-nav mt-4 mt-lg-0">
                    <li class="nav-item dropdown mobile-nav-item   d-block d-lg-none">
                        <a href="https://instagram.com/upperlicense?igshid=6p3og64hk5wh" class="header_social_media-icon social_media-icon"><img
                                    src="{{asset('images/social_network/instagram-white.png')}}"></a>
                    </li>
                    <li class="nav-item dropdown mobile-nav-item d-block d-lg-none">
                        <a href="https://t.me/joinchat/AAAAAE-dclw09LmhUPEw2w" class="header_social_media-icon social_media-icon"><img
                                    src="{{asset('images/social_network/tele-white.png')}}"></a>
                    </li>
                    <li class="nav-item dropdown mobile-nav-item d-block d-lg-none">
                        <a href="https://m.facebook.com/pages/category/Business-Consultant/Upperlicense-110297470775409/" class="header_social_media-icon social_media-icon"><img
                                    src="{{asset('images/social_network/facebook_white.png')}}"></a>
                    </li>
                    <li class="nav-item dropdown mobile-nav-item d-block d-lg-none">
                        <a href="https://kz.linkedin.com/company/upperlicense?trk=similar-pages_result-card_full-click" class="header_social_media-icon social_media-icon"><img
                                    src="{{asset('images/social_network/linkedin-white.png')}}"></a>
                    </li>
                    <li class="nav-item dropdown mobile-nav-item d-block d-lg-none ">
                        <a href="https://www.youtube.com/channel/UCvnqkPSxZjcqQ8cuKOyQj4A" class="header_social_media-icon social_media-icon"><img class="mr-0"
                                    src="{{asset('images/social_network/youtube-white.png')}}"></a>
                    </li>
                    <li class="nav-item dropdown mobile-nav-item ml-auto ml-xl-0">
                        <a class="nav-link" href="#" id="localeDropdown" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            @if(\Illuminate\Support\Facades\App::getLocale() == "ru")
                                <i class="fas fa-chevron-down"></i> Ru
                            @else
                                <i class="fas fa-chevron-down"></i> Eng
                            @endif

                        </a>
                        <div class="dropdown-menu menu-locale" aria-labelledby="localeDropdown">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <a class="dropdown-item select-locale" rel="alternate" hreflang="{{ $localeCode }}"
                                   href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
{{--                                    <img src="{{asset('images/flag-'.strtolower($properties['native']).'.svg')}}"/>--}}
                                    {{ucfirst($localeCode)}}
                                </a>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item dropdown mobile-nav-item">
                        <a class="nav-link" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                           aria-haspopup="false" aria-expanded="false">
                            <i class="menu-icon far fa-search"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right  search-mobile-modal" style="width: 350px"
                             aria-labelledby="searchDropdown">
                            <form class="col-12" action="#" method="POST">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="SearchMobileModal" placeholder="@lang('messages.all.search')">
{{--                                    <div class="input-group-append">--}}
{{--                                        <button type="button"--}}
{{--                                                class="btn btn-success float-right">@lang('messages.all.search')</button>--}}
{{--                                    </div>--}}
                                </div>
                            </form>
                        </div>
                    </li>
                    @if(Auth::check())
                        <li class="nav-item dropdown profile  mobile-nav-item ">
                            <a class="nav-link" href="#" id="profileDropdown" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                @if(Auth::user()->profile->photo_id !=null)
                                    <img src="/storage_/{{Auth::user()->profile->photo_path}}"
                                         class="profile-photo_icon rounded-circle">
                                @else
                                    <i class="menu-icon fal fa-user-circle"></i>
                                @endif
                            </a>
                            <div class="dropdown-menu" aria-labelledby="profileDropdown">

                                @if(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client))
                                    <a class="dropdown-item"
                                       href="{{route('Client.service.list')}}">@lang('messages.layouts.personal_services')</a>
                                    <a class="dropdown-item"
                                       href="{{route('profile.documentList')}}">@lang('messages.layouts.personal_documents')</a>
                                    <a class="dropdown-item"
                                       href="{{route('profile.bookkeeping')}}">@lang('messages.layouts.personal_bookkeeping')</a>
                                    <a class="dropdown-item"
                                       href="{{route('profile')}}">@lang('messages.layouts.personal_area')</a>

                                @endif

                                <a class="dropdown-item" href="{{route('logout')}}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                >
                                    @lang('messages.layouts.logout')</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="nav-item   profile mobile-nav-item ">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="menu-icon fal fa-user-circle"></i>
                            </a>
                        </li>
                    @endif
                </ul>
                @if((Auth::check() && Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client)) || !Auth::check())
                    <div class=" ml-lg-1 pl-lg-3 navbar-ordercall d-none d-lg-block dropdown ">
                        <button class="btn btn-success my-2 my-sm-0 order-call-btn " id="phoneDropdown"
                                role="button"
                                data-toggle="dropdown"
                                aria-haspopup="false" aria-expanded="false"><span
                                    class="d-none d-xl-block">@lang('messages.layouts.order_call')</span> <img
                                    class="d-xl-none d-block" src="{{asset('images/call_icon.png')}}"></button>

                        <div class="dropdown-menu  dropdown-menu-right " style="width: 350px"
                             aria-labelledby="phoneDropdown">
                            {!! Form::open(['url' => route('callMe'), 'method' => 'post', 'class' => 'col-12 callMe']) !!}
                            <div class="input-group">
                                <input class="form-control" type="text" name="phone"
                                       placeholder="+7 (xxx) xxx xx xx">
                                <div class="input-group-append">
                                    <button class="btn btn-success"
                                            type="submit">@lang('messages.layouts.order_call')</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endif
            </div>
        </nav>
    </div>
</div>
{{--<div class="whatsapp-button">--}}
{{--    <a href="https://wa.me/77471350000" onclick="gtag('event', 'click', {'event_category': 'WhatsApp'});">--}}
{{--        <img src="{{asset('images/whatsapp-icon.svg')}}">--}}
{{--    </a>--}}
{{--</div>--}}
<div id="video-overlay" class="video-overlay">
    <a class="video-overlay-close">&times;</a>
</div>

@if(!Auth::check() || Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client))
@include('layouts.sideMenu')
@endif
