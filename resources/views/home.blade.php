@extends('new.layouts.app')

@section('title')
    @if(\Illuminate\Support\Facades\App::getLocale() == "ru")
        ЛИЦЕНЗИИ — Электронное лицензирование в Казахстане
    @else
        LICENSES — Electronic Licensing in Kazakhstan
    @endif
@endsection

@section('meta-description')
    @if(\Illuminate\Support\Facades\App::getLocale() == "ru")
        Е-лицензирование ➤ Электронные лицензии ✅ Получения лицензий и разрешений во всех сферах деятельности ➤ Разрешительные документы в Республике Казахстан ➤ Сайт лицензий!
    @else
        E-licensing ➤ Electronic licenses ✅ Obtaining licenses and permits in all areas of activity ➤ Permits in the Republic of Kazakhstan ➤ License site!
    @endif
@endsection

@section('content')
    <div class="home">
        <div class="row ml-0 mr-0">
            <div class="home__list-of-industries col-12 pl-0 pr-0 order-1 order-md-2" id="listOfIndustries">
                <div class="container">
                    <div class="row ml-0 mr-0">
                        <div class="col-12 col-md-10">
                            <div class="row ml-0 mr-0">
                                <div class="home__list-of-industries__header home__section__header col-12 mx-auto text-left pl-0 pr-0  z-index-primary">
                                    @lang('messages.pages.about.in_which_industry_do_you_need_permits')
                                </div>
                                <div class="home__list-of-industries__search col-12 mx-auto">
                                    <img class="home__list-of-industries__search__big-background-picture"
                                         src="{{asset('images/big-lens-background.png')}}">
                                    <form class="home__list-of-industries__search__form  z-index-primary">
                                        <input class="home__list-of-industries__search__form__input">
                                        {{--                            <button class="home__list-of-industries__search__form__search-icon search-icon"><i--}}
                                        {{--                                        class=" far fa-search"></i></button>--}}
                                    </form>
                                </div>
                                <div class="home__list-of-industries__list col-12 mx-auto pl-4  z-index-primary">
                                    @include('services._serviceCategoryPart')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <img class="home__list-of-industries__background"
                     src="{{asset('images/about-us_background/background-section-2.png')}}">
            </div>
        </div>
        <div class="row ml-0 mr-0">
            <div class="home__what-is-upperlicense col-12 order-3 d-md-none">
                <div class="container">
                    <div class="row ml-0 mr-0">
                        <div class="col-12 col-md-10">
                            <div class="row ml-0 mr-0">
                                <div class="col-xl-5 col-md-4 col-12 pl-0 order-md-1 order-2 mt-4 mt-md-0">
                                    <div class="home__what-is-upperlicense__video">
                                        <img src="{{asset('images/video-img.png')}}"
                                             class="home__what-is-upperlicense__video__background">
                                        <img
                                                src="{{asset('images/play-button.png')}}"
                                                data-url="https://www.youtube.com/embed/ZdUFNtPZeXM"
                                                class="home__what-is-upperlicense__video__play-button pulse-animation play-video">
                                    </div>
                                </div>
                                <div class="col-xl-7 col-md-8 col-12 pl-xl-5 pr-xl-0 order-md-2 order-1">
                                    <div class="home__what-is-upperlicense__header">
                                        <h1>@lang('messages.pages.about.what_is')
                                            <img src="{{asset('images/upperLicense.png')}}"></h1></div>
                                    <div class="home__what-is-upperlicense__text">
                                        <span>@lang('messages.pages.about.platform_on_which_you_can_collect_everything_online')</span>
                                    </div>
                                    <div class="mt-3 d-none d-md-block">
                                        <div class="row subLicense__qualification-requirements__share__icons">
                                            @include('components._sharedLinks', ['source' => 'https://www.youtube.com/embed/ZdUFNtPZeXM'])
                                        </div>
                                        <span class="text-primary float-right">@lang('messages.pages.about.share') → </span>
                                    </div>
                                </div>
                                <div class="col-12 mx-auto mt-4 d-block d-md-none share-icons-container  order-3">
                                    <span>@lang('messages.pages.about.share')</span>
                                    <div class="row mr-0 ml-0 mt-3">
                                        @include('components._sharedLinks', ['source' => 'https://www.youtube.com/embed/ZdUFNtPZeXM'])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <img class="home__what-is-upperlicense__background"
                     src="{{asset('images/about-us_background/background-section-2.png')}}">
            </div>
            <div class="home__useful-information col-12 order-1 order-md-2">
                <div class="container">
                    <div class="row ml-0 mr-0">
                        <div class="col-12 col-md-10">
                            <div class="home__useful-information__header home__section__header text-left z-index-primary pt-3 pt-md-0">
                                @lang('messages.pages.about.useful_information_on_licensing_and_development_of_our_product')
                            </div>
                            <div class="home__useful-information__information-container d-md-flex d-none row ml-0 mr-0 justify-content-center">
                                @foreach($newsList as $news)
                                    @if($loop->index == 0)
                                        <div class="col-12">
                                            @include('news._shortNews', ['news' => $news, 'extendContent' => true])
                                        </div>
                                    @else
                                        <div class="col-12 col-sm-6">
                                            @include('news._shortNews', ['news' => $news, 'extendContent' => false])
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div id="mobileUsefulInformationCarousel"
                                 class="carousel slide home__useful-information__mobile-carousel show-neighbors  d-block d-md-none"
                                 data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($newsList as $news)
                                        <div class="carousel-item {{$loop->first ? 'active' : ''}}">
                                            <div class="item__third">
                                                <div class="video">
                                                    <img class="preview"
                                                         src="{{\Illuminate\Support\Facades\Storage::url($news->thumbnail)}}"/>
                                                </div>
                                                <div class="home__useful-information__mobile-carousel__information-date">
                                                    {{\App\Data\Helper\Assistant::formatDate($news->create_date)}}
                                                </div>
                                                <div class="home__useful-information__mobile-carousel__information-title">
                                                    {{$news->lead}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                            <div class="text-center">
                                <a href="{{route('news.list')}}"
                                   class="btn btn-success">
                                    @lang('messages.pages.about.go_to_blog')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="home__get-all-info col-12 order-2 order-md-3">
                <div class="container">
                    <div class="row mr-0 ml-0 col-12 pl-md-0 pr-md-0">
                        <div class="col-xl-7 col-md-8 pl-0 col-12  z-index-primary text-center text-md-left">
                            <span class="home__get-all-info__get-all-the-information">@lang('messages.pages.about.get_all_the_information')</span>
                            <h1 class="mb-0 mt-1 mt-mb-0">@lang('messages.pages.about.in_one_place')</h1>
                            <div class="home__get-all-info__up-to-date-database">
                                <span>@lang('messages.pages.about.always_up-to-date_database')</span>
                            </div>
                            <form class="home__get-all-info__search col-md-10 col-12 pl-0 pr-0">
                                <input class="home__get-all-info__search__input w-100" id="homePageSearch"/>
                                {{--                            <button class="home__get-all-info__search__search-icon search-icon"><i--}}
                                {{--                                        class=" far fa-search"></i></button>--}}
                            </form>
                            <div class="home__get-all-info__section_in_our_catalog">
                                <span>@lang('messages.pages.about.select_the_desired_section_in_our_catalog', ['path' => route('new-index') . '#listOfIndustries'])</span>
                            </div>
                        </div>
                        <div class="col-xl-5  col-md-4 col-12">
                            <img src="data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/‌​svg%22/%3E"
                                 class="home__get-all-info__macbook-background d-md-block d-none"
                                 style="content:url('{{asset('images/about-us_macbook.png')}}')">
                            <img src="data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/‌​svg%22/%3E"
                                 class="home__get-all-info__iphone-background d-block d-md-none"
                                 style="content:url('{{asset('images/about-us_iphone_app.png')}}')"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ml-0 mr-0">
            <div class="col-12 pl-0 pr-0 order-2 order-md-1">
                <div class="container">
                    <div class="home__section-01 row mr-0 ml-0">
                        <div class="col-xl-5 col-md-7 col-11">
                            <div class="home__section-01__section-number section-number">
                                01
                            </div>
                            <div class="home__section-01__left-text  z-index-primary ">
                                <div class="home__section-01__left-text__header home__section__header">
                                    <span>@lang('messages.pages.about.more_than_500_instructions_collected_on_the_platform')</span>
                                </div>
                                <div class="home__section-01__left-text__sub-header mt-2 mt-md-0">
                                    <span>@lang('messages.pages.about.for_obtaining_licenses_and_permits_of_all_types_and_industries')</span>
                                </div>
                                <ul class="home__section-01__left-text__advantages-list">
                                    <li class="home__section-01__left-text__advantages-list__item advantages-list-item">@lang('messages.pages.about.find_the_theme_you_want_using_the_search_bar_or_catalog')</li>
                                    <li class="home__section-01__left-text__advantages-list__item advantages-list-item">@lang('messages.pages.about.download_the_list_of_requirements_for_obtaining_permits_for_free')</li>
                                    <li class="home__section-01__left-text__advantages-list__item advantages-list-item">
                                        <b>@lang('messages.pages.about.we_have_been_collecting_the_database_for_over_1_year')</b>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-7 col-md-5 col-1">
                            <div class="home__section-01__img">
                                <img class="d-md-block d-none"
                                     src="data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/‌​svg%22/%3"
                                     style="content:url('{{asset('images/section-01-content-image.png')}}')"
                                >
                                <img class="d-block d-md-none"
                                     src="data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/‌​svg%22/%3"
                                     style="content:url('{{asset('images/section-01-content-image-mobile.png')}}')"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="home__section-02 row mr-0 ml-0">
                        <div class="col-12 col-md-10">
                            <div class="row">
                                <div class="col-xl-7 col-md-6 col-12 pr-xl-5 pl-xl-0 d-none d-md-block">
                                    <div class="home__section-02__left-video-container mt-5 mt-xl-0">
                                        <div class="home__section-02__left-video-container__header-secondary-text mx-auto">
                                            @lang('messages.pages.about.watch_a_video_from_government_agencies_with_explanations_and_requirements')
                                        </div>
                                        <div class="home__section-02__left-video-container__video">
                                            <div class="home__section-02__left-video-container__video__ipad-screen">
                                                <img src="{{asset('images/ipad-screen.png')}}">
                                                <img
                                                        src="{{asset('images/play-button.png')}}"
                                                        class="home__section-02__left-video-container__video__play-button pulse-animation play-video">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-5 col-md-6 col-12 pl-xl-0 pr-xl-0 ">
                                    <div class="home__section-02__right-content">
                                        <div class="home__section-02__right-content__section-number section-number">
                                            02
                                        </div>
                                        <div class="home__section-02__right-content__header home__section__header   z-index-primary">
                                            @lang('messages.pages.about.information_is_updated_daily')
                                        </div>
                                        <ul class="home__section-02__right-content__advantages-list">
                                            <li class="home__section-02__right-content__advantages-list__item advantages-list-item">@lang('messages.pages.about.we_have_implemented_synchronization_with_government_authorities_so_that_you_always_have_up-to-date_data')</li>
                                            <li class="home__section-02__right-content__advantages-list__item advantages-list-item">@lang('messages.pages.about.no_need_to_look_for_information_in_different_sources_or_call_government_agencies_for_advice')</li>
                                        </ul>
                                        <div class="d-block d-md-none text-center mt-3 mb-4">
                                            <div class="position-relative">
                                                <img src="data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/‌​svg%22/%3"
                                                     class="home__section-02__right-content__video__video-preview mb-4"
                                                     style="content:url('{{asset('images/section-02-preview.png')}}')"
                                                >
                                                <img
                                                        src="{{asset('images/play-button.png')}}"
                                                        class="home__section-02__right-content__video__play-button pulse-animation play-video">

                                            </div>
                                            <span class="home__section-02__right-content__video__watch-more"><a
                                                        href="#"><b>@lang('messages.pages.about.watch_more_videos')</b></a></span>
                                        </div>
                                        <div class="home__section-02__right-content__dialogue-cloud dialogue-cloud ">@lang('messages.pages.about.we_are_the_only_ones_who_receive_video_content_directly_from_government_agencies_with_explanations_and_license_requirements')</div>
                                        <div class="home__section-02__right-content__share mx-auto mt-4 d-block d-md-none share-icons-container ">
                                            <span>@lang('messages.pages.about.share')</span>
                                            <div class="row mr-0 ml-0 mt-3">
                                                @include('components._sharedLinks', ['source' => 'https://www.youtube.com/embed/ZdUFNtPZeXM'])
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="home__section-03 row mr-0 ml-0">
                        <div class="col-xl-6 col-md-7 col-12">
                            <div class="home__section-03__content">
                                <div class="home__section-03__content__section-number section-number">
                                    03
                                </div>
                                <div class="home__section-03__content__header home__section__header z-index-primary">
                                    @lang('messages.pages.about.order_a_license_and_get_it_online_without_leaving_your_home')
                                </div>
                                <div class="home__section-03__content__mobile-img d-block d-md-none">
                                    {{--                                    <img src="{{asset('images/section-03-mobile.png')}}">--}}
                                    <img src="data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/‌​svg%22/%3E"
                                         style="content:url('{{asset('images/section-03-mobile.png')}}')">
                                </div>
                                <ul class="home__seiction-03__content__advantages-list">
                                    <li class="home__section-03__content__advantages-list-item advantages-list-item">@lang('messages.pages.about.we_will_help_you_arrange_any_type_of_permits')</li>
                                    <li class="home__section-03__content__advantages-list-item advantages-list-item">@lang('messages.pages.about.we_will_provide_a_step-by-step_description_of_the_process_of_obtaining_documents')</li>
                                    <li class="home__section-03__content__advantages-list-item advantages-list-item">@lang('messages.pages.about.the_platform_allows_you_to_submit_and_receive_documents_online')</li>
                                </ul>
                                <button class="home__section-03__content_request_button btn mx-auto"
                                        onclick="location.href='#listOfIndustries';">@lang('messages.pages.about.apply_for_a_license')</button>
                            </div>
                        </div>
                        <div class="col-xl-6 col-5 d-none d-md-block">
                            <img src="data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/‌​svg%22/%3E"
                                 class="home__section-03__img "
                                 style="content:url('{{asset('images/section-03.png')}}')">
                        </div>
                    </div>
                </div>

                <div class="home__section-04">
                    <div class="container">

                        <div class="row mr-0 ml-0">
                            <div class="col-12 col-md-10">
                                <div class="row">
                                    <div class="col-xl-7 col-md-6 d-none d-md-block">
                                        <img class="home__section-04__img mx-auto"
                                             src="{{asset('images/desktop_computer_presentation.png')}}">
                                    </div>
                                    <div class="col-xl-5 col-md-6 col-8">
                                        <div class="home__section-04__content">
                                            <div class="home__section-04__content__section-number section-number">04
                                            </div>
                                            <div class="home__section-04__content__header home__section__header z-index-primary">@lang('messages.pages.about.track_the_status_of_the_application_in_your_personal_account')</div>
                                            <ul class="home__section-04__content__advantages-list">
                                                <li class="home__section-04__content__advantages-list__item advantages-list-item">@lang('messages.pages.about.a_personal_account_on_the_platform_allows_you_to_track_the_status_of_obtaining_a_license_in_real_time')</li>
                                                <li class="home__section-04__content__advantages-list__item advantages-list-item">@lang('messages.pages.about.no_need_to_constantly_call_write_to_government_agencies_to_find_out_the_status_of_the_application')</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img class="home__section-04__background d-none d-md-block"
                         src="data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/‌​svg%22/%3"
                         style="content:url('{{asset('images/about-us_background/background-section-2.png')}}')"
                    >
                    <img class="home__section-04__background d-md-none d-block"
                         src="data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/‌​svg%22/%3"
                         style="content:url('{{asset('images/section-04-mobile.png')}}')"
                    >

                </div>
                <div class="container">
                    <div class="home__section-05 row mr-0 ml-0">
                        <div class="col-12 col-md-10">
                            <div class="row">
                                <div class="col-md-8 pr-0 col-12">
                                    <div class="home__section-05__content z-index-primary">
                                        <div class="home__section-05__content__section-number section-number">05</div>
                                        <div class="home__section-05__content__header home__section__header z-index-primary">@lang('messages.pages.about.each_client_is_assigned_a_personal_manager')</div>
                                        <div class="col-md-10 col-7">
                                            <ul class="home__section-05__content__advantages-list">
                                                <li class="home__section-05__content__advantages-list__item advantages-list-item">@lang('messages.pages.about.we_love_technology_but_nothing_can_replace_human_communication')</li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4 col-12">
                                    <img class="home__section-05__img mx-auto" src="{{asset('images/Man_KZ.png')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="home__our-partners">
                    <div class="home__our-partners__dark-green-layer"></div>
                    <div class="home__our-partners__container container z-index-primary">
                        <div class="row ml-0 mr-0 home__our-partners__container__content">
                            <div class="col-12 col-md-10">
                                <div class="row">
                                    <div class="col-xl-7 col-12 pr-xl-5">
                                        <div class="home__our-partners__container__content__header home__section__header text-center text-xl-left">@lang('messages.pages.about.get_special_conditions_for_the_services_of_our_partners')</div>

                                    </div>
                                    <div class="col-xl-5 col-12">
                                        <div id="partnerCarousel"
                                             class="home__our-partners__container__content__carousel carousel slide mx-auto mx-xl-0 d-none d-md-block"
                                             data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                @foreach($partnerList->chunk(2) as $partnerChunk)
                                                    <li data-target="#partnerCarousel" data-slide-to="{{$loop->index}}"
                                                        class="{{$loop->first ? 'active' : ''}}"></li>
                                                @endforeach
                                            </ol>
                                            <div class="carousel-inner">
                                                @foreach($partnerList->chunk(2) as $partnerChunk)
                                                    <div class="carousel-item {{$loop->first ? 'active' : ''}}">
                                                        <div class="row justify-content-center">
                                                            @foreach($partnerChunk as $partner)
                                                                <div class="col-6">
                                                                    <a href="{{$partner->site_url}}" target="_blank"
                                                                       class="home__our-partners__container__content__carousel__partner-logo-circle mx-auto">
                                                                        <img src="{{\Illuminate\Support\Facades\Storage::url($partner->logo_path)}}"
                                                                             alt="{{$partner->name}}"/>
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <a class="carousel-control-prev" href="#partnerCarousel" role="button"
                                               data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#partnerCarousel" role="button"
                                               data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                        <div id="mobilePartnerCarousel"
                                             class="carousel slide home__our-partners__container__content__mobile-carousel show-neighbors d-md-none"
                                             data-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach($partnerList as $partner)
                                                    <div class="carousel-item {{$loop->first ? 'active' : ''}}">
                                                        <div class="item__third">
                                                            <a href="{{$partner->site_url}}" target="_blank"
                                                               class="home__our-partners__container__content__mobile-carousel__partner-logo-circle mx-auto">
                                                                <img src="{{\Illuminate\Support\Facades\Storage::url($partner->logo_path)}}"
                                                                     alt="{{$partner->name}}"/>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="home__our-partners__container__content__watch-all-partner-button btn mx-xl-0  d-block d-xl-inline-block mx-auto"
                                                onclick="location.href='{{route('new-partners')}}';">@lang('messages.pages.about.see_all_partners')</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="home__reviews" id="reviews">
            <div class="container px-0 px-md-2">
                <div class="col-12 col-md-10 px-0 px-md-2">
                    <div class="container text-center text-md-left">
                        <div class="home__reviews__header">
                            <div class="home__section__header text-center text-md-left">@lang('messages.pages.about.feedback_from_those')</div>
                            <div class="home__section__header text-center text-md-left">@lang('messages.pages.about.who_have_already_received_a_license_with_the')
                                <img
                                        src="{{asset('images/upperLicense.png')}}" class="ml-1"></div>
                        </div>
                        <div id="mobileReviewsCarousel"
                             class="carousel slide home__reviews__mobile-carousel show-neighbors  d-block d-md-none"
                             data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($reviewList as $review)
                                    <div class="carousel-item @if($loop->first) active @endif">
                                        <div class="item__third">
                                            <div class="card">
                                                <div class="card-body pl-0 pr-0">
                                                    <h5 class="card-title mb-4">
                                                        <b>{{$review->company_name}}</b>
                                                    </h5>
                                                    <div class="card-video">
                                                        <img
                                                                src="{{asset('images/play-button.png')}}"
                                                                data-url="{{$review->youtube_url}}"
                                                                class="home__reviews__mobile-carousel__card-video__play-button pulse-animation play-video">
                                                        <img class="preview"
                                                             src="{{$review->youtube_preview}}"/>
                                                    </div>
                                                    <ul class=" text-center pl-0 mt-4">
                                                        <li class="d-block">{{$review->company_description}}</li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="home__reviews__share mx-auto mt-4 d-block d-md-none share-icons-container ">
                                                <span>@lang('messages.pages.about.share')</span>
                                                <div class="row mr-0 ml-0 mt-3">
                                                    @include('components._sharedLinks', ['source' => $review->youtube_url])
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="splide home__reviews__carousel d-none d-md-block">
                        <div class="splide__arrows">
                            <button class="splide__arrow splide__arrow--prev carousel-control-prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </button>
                            <button class="splide__arrow splide__arrow--next carousel-control-next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </button>
                        </div>
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach($reviewList as $review)
                                    <li class="splide__slide">
                                        <div class="item">
                                            <div class="row mr-0 ml-0 d-flex justify-content-center">
                                                <div class="home__reviews__carousel__item">
                                                    <div class="video-container">
                                                        <img class="home__reviews__carousel__item__tablet video-container__tablet "
                                                             src="{{asset('images/reviews_slider_item.png')}}">
                                                        <img
                                                                src="{{asset('images/play-button.png')}}"
                                                                data-url="{{$review->youtube_url}}"
                                                                class="home__reviews__carousel__item__play-button pulse-animation play-video">

                                                        <div class="video-container__preview-wrap ">
                                                            <img class="video-container__preview-wrap__preview"
                                                                 src="{{$review->youtube_preview}}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="home__reviews__review-info mx-auto d-flex justify-content-center">
                                                <ul class="pl-0 text-left ml-0 mr-0 mb-0">
                                                    <li class="d-block">
                                                        <span class="list-point">•</span> {{$review->company_name}}
                                                    </li>
                                                    <li class="d-block">
                                                        <span class="list-point">•</span> {{$review->company_description}}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var splide = new Splide('.splide', {
                type: 'loop',
                autoWidth: true,
                focus: 'center',
                // width: '100vw',
                updateOnMove: true,
                drag: false,
                padding: {
                    right: '5rem',
                    left: '5rem',
                },
            }).mount();
        });

        var id_count = 0;

        function scrollToListOfIndustries() {
            var elmnt = document.getElementById("listOfIndustries");
            elmnt.scrollIntoView();
        }

        $(document).keyup(function (e) {
            if (e.keyCode === 27) {
                close_video();
            }
        });

        $('.carousel-item', '.show-neighbors').each(function () {
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));
        }).each(function () {
            var prev = $(this).prev();
            if (!prev.length) {
                prev = $(this).siblings(':last');
            }
            prev.children(':nth-last-child(2)').clone().prependTo($(this));
        });
        $(function () {
          try {
            $("input.home__list-of-industries__search__form__input").autocomplete({
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
              ul.addClass('list-of-industries__autocomplete')
              return $("<li>")
                .append("<div>" + item.name + "</div>")
                .appendTo(ul);
            };
          } catch (e) {

          }
            $("input#homePageSearch").autocomplete({
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
                ul.addClass('list-of-industries__autocomplete')
                return $("<li>")
                    .append("<div>" + item.name + "</div>")
                    .appendTo(ul);
            };

            $('body').scroll(function () {
                $(".ui-autocomplete").hide();
            });
        });

        setTimeout(setPreviewSize, 500);


        function setPreviewSize() {
            $('.video-container__preview-wrap').each(function (index) {
                var previewWrap = $(this);
                var width = previewWrap.width();
                var preview = previewWrap.children(".video-container__preview-wrap__preview");
                preview.css("height", (width * 0.75) + 'px');
            });
        }


        $(window).resize(function () {
            setPreviewSize()
        });

    </script>
@endsection
