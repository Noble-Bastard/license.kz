<div class="side-menu">
    <div class="side-menu__big-version d-none">
        <div class="side-menu__video">
                <img src="https://img.youtube.com/vi/57HJSav5fEU/maxres1.jpg" class="side-menu__video-preview">
                <img src="{{asset('images/side-menu_icons/side-menu-play-icon.png')}}" data-url="https://www.youtube.com/embed/57HJSav5fEU" class="side-menu__video-play-button play-video">
        </div>
        <div class="px-4 mt-4 pt-2">
            <div class="side-menu-item" href="#">
                <div class="side-menu-item__icon  "><img src="{{asset('images/side-menu_icons/links-icon.png')}}"></div>
                <div class="side-menu-item__content ">
                    <div
                            class="cursor-pointer d-inline-block"
                            data-toggle="collapse"
                            href="#sideMenuLinksContainer"
                            role="button"
                            aria-expanded="false"
                            aria-controls="sideMenuLinksContainer">@lang('messages.layouts.license_school')
                    </div>
                    <div class="collapse  pl-3" id="sideMenuLinksContainer">
                        <a class="side-menu-item__link pt-2"
                           href="{{route('news.npa.list')}}"> @lang('messages.layouts.npa_news')</a>
                        <a class="side-menu-item__link pt-1"
                           href="{{route('news.expert.list')}}">@lang('messages.layouts.publications_news')</a>
                        <a class="side-menu-item__link pt-1"
                           href="{{route('news.government_agencies.list')}}">@lang('messages.layouts.government_agencies_news')</a>
                        {{--                        <a class="side-menu-item__link pt-1" href="#">Вопрос-Ответ (FAQ)</a>--}}
                    </div>
                </div>
            </div>
            <a class="side-menu-item" href="{{route('news.list')}}">
                <div class="side-menu-item__icon"><img src="{{asset('images/side-menu_icons/news-icon.png')}}"></div>
                <div class="side-menu-item__content  ">@lang('messages.layouts.news')</div>
            </a>
            <a class="side-menu-item" href="{{route('new-reviews')}}">
                <div class="side-menu-item__icon"><img src="{{asset('images/side-menu_icons/review-icon.png')}}"></div>
                <div class="side-menu-item__content  ">@lang('messages.layouts.review')</div>
            </a>
            <a class="side-menu-item" href="{{route('faq')}}">
                <div class="side-menu-item__icon"><img src="{{asset('images/side-menu_icons/chat-icon.png')}}"></div>
                <div class="side-menu-item__content ">@lang('messages.layouts.faq')</div>
            </a>
            <a class="side-menu-item" href="{{route('oked.index')}}">
                <div class="side-menu-item__icon"><img src="{{asset('images/side-menu_icons/search-icon.png')}}"></div>
                <div class="side-menu-item__content">ТНВЭД</div>
            </a>
            <a class="side-menu-item" href="{{route('check_partner.index')}}">
                <div class="side-menu-item__icon"><img src="{{asset('images/side-menu_icons/search-icon.png')}}"></div>
                <div class="side-menu-item__content ">Проверка партнера</div>
            </a>
            <a class="side-menu-item" data-toggle="collapse" href="#calendarContainer" role="button"
               aria-expanded="false"
               aria-controls="calendarContainer">
                <div class="side-menu-item__icon"><img src="{{asset('images/side-menu_icons/calendar-icon.png')}}">
                </div>
                <div class="side-menu-item__content">Календарь событий</div>
            </a>
            <div class="collapse mt-3" id="calendarContainer">
                <div id="container" class="calendar-container"></div>
            </div>
            <div class="row mx-0 mt-5">
                <div class="col-7 " id="sideMenuSocialMediaContainer">
                    <div class="side-menu__icons ">
                        <div class="row">
                            <div class="col-4">
                                <div class="side-menu__icon">
                                    <a href="https://m.facebook.com/pages/category/Business-Consultant/Upperlicense-110297470775409/">
                                        <img src="{{asset('images/social_network/facebook_black.png')}}"/>
                                    </a>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="side-menu__icon">
                                    <a href="#">
                                        <img src="{{asset('images/social_network/vk.png')}}"/>
                                    </a>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="side-menu__icon">
                                    <a href="https://t.me/joinchat/AAAAAE-dclw09LmhUPEw2w">
                                        <img src="{{asset('images/social_network/tele.png')}}"/>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-5 text-end" id="showHideSideMenuContainer">
                    <button class="side-menu__show-hide-btn btn">
                        <img src="{{asset('images/side-menu_icons/hide-show-icon.png')}}">
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="side-menu__small-version">
        <div class="px-4 mt-4 pt-2 d-none d-sm-block">
            <div class="side-menu-item text-center" href="#">
                <div class="side-menu-item__icon  pr-0"><img src="{{asset('images/side-menu_icons/video-play.png')}}">
                </div>
            </div>
            <div class="side-menu-item text-center" href="#">
                <div class="side-menu-item__icon  pr-0"><img src="{{asset('images/side-menu_icons/links-icon.png')}}">
                </div>
            </div>
            <a class="side-menu-item text-center" href="#">
                <div class="side-menu-item__icon  pr-0"><img src="{{asset('images/side-menu_icons/news-icon.png')}}">
                </div>
            </a>
            <a class="side-menu-item" href="{{route('new-reviews')}}">
                <div class="side-menu-item__icon  pr-0"><img src="{{asset('images/side-menu_icons/review-icon.png')}}"></div>
            </a>
            <a class="side-menu-item text-center" href="#">
                <div class="side-menu-item__icon  pr-0"><img src="{{asset('images/side-menu_icons/chat-icon.png')}}">
                </div>
            </a>
            <a class="side-menu-item text-center" href="{{route('oked.index')}}">
                <div class="side-menu-item__icon pr-0"><img src="{{asset('images/side-menu_icons/search-icon.png')}}">
                </div>
            </a>
            <a class="side-menu-item text-center" href="{{route('check_partner.index')}}">
                <div class="side-menu-item__icon pr-0"><img src="{{asset('images/side-menu_icons/search-icon.png')}}">
                </div>
            </a>
            <a class="side-menu-item text-center" data-toggle="collapse" href="#calendarContainer" role="button"
               aria-expanded="false"
               aria-controls="calendarContainer">
                <div class="side-menu-item__icon pr-0"><img src="{{asset('images/side-menu_icons/calendar-icon.png')}}">
                </div>
            </a>

            <div class="side-menu__icons text-center mt-4 pt-2">
                <div class="row">
                    <div class="col-12">
                        <div class="side-menu__icon">
                            <a href="https://m.facebook.com/pages/category/Business-Consultant/Upperlicense-110297470775409/">
                                <img src="{{asset('images/social_network/facebook_black.png')}}"/>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 ">
                        <div class="side-menu__icon mt-4">
                            <a href="#">
                                <img src="{{asset('images/social_network/vk.png')}}"/>
                            </a>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="side-menu__icon mt-4">
                            <a href="https://t.me/joinchat/AAAAAE-dclw09LmhUPEw2w">
                                <img src="{{asset('images/social_network/tele.png')}}"/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 px-0 text-center mt-5">
                <button class="side-menu__show-hide-btn btn fa-rotate-180">
                    <img src="{{asset('images/side-menu_icons/hide-show-icon.png')}}">
                </button>
            </div>
        </div>
        <div class="d-flex d-sm-none side-menu__show-hide-panel">
            <button class="side-menu__show-hide-btn btn fa-rotate-180">
            </button>
        </div>
    </div>
</div>
