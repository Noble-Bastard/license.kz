@extends('new.layouts.app')

@section('title')
    @lang('messages.pages.about.title')
@endsection

@section('content')
    <div class="about-us">
        <div class="about-us__get-all-info">
            <div class="container">
                <div class="row mr-0 ml-0 col-12 pl-0 pr-0">
                    <div class="col-lg-8  pl-0 pr-0 pr-lg-3 col-12  z-index-primary text-left order-lg-first order-second">
                        <div class="about-us__get-all-info__header col-7 col-lg-12 pl-0 pr-2">
                            <h1>
                                UPPERLICENSE-
                            </h1>
                            <span class="about-us__get-all-info__header__header-text">
                                @lang('messages.pages.about-us.this_is_a_portal_where_you_can_collect_all_the_necessary_information')
                            </span>
                        </div>
                        <div class="about-us__get-all-info__icons row col-12 col-lg-10 pl-0 pr-0">
                            <div class="col-4 text-center">
                                <img src="{{asset('images/about-us_explanatory-icons/1.png')}}"
                                     class="about-us__get-all-info__icons__icon d-block mx-auto">
                                <span class="mt-3 d-block">@lang('messages.pages.about-us.free_access_to_information')</span>
                            </div>
                            <div class="col-4 text-center">
                                <img src="{{asset('images/about-us_explanatory-icons/2.png')}}"
                                     class="about-us__get-all-info__icons__icon d-block mx-auto">
                                <span class="mt-3 d-block">@lang('messages.pages.about-us.always_up-to-date_data')</span>
                            </div>
                            <div class="col-4 text-center">
                                <img src="{{asset('images/about-us_explanatory-icons/3.png')}}"
                                     class="about-us__get-all-info__icons__icon d-block mx-auto">
                                <span class="mt-2 d-block">@lang('messages.pages.about-us.everything_you_need_to_get_a_license_in_one_place')</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 order-first order-lg-second">
                        <img src="{{asset('images/about-us_macbook.png')}}"
                             class="about-us__get-all-info__macbook-background d-lg-block d-none">
                        <img src="{{asset('images/about-us_background/about-us-mobile-phone.png')}}"
                             class="about-us__get-all-info__iphone-background d-block d-lg-none">
                    </div>
                </div>
            </div>
        </div>
        <div class="about-us__what-is-upperlicense">
            <div class="container">
                <div class="row ml-0 mr-0">
                    <div class="col-lg-5 col-md-4 col-12 pl-0 order-md-1 order-2 mt-4 mt-md-0">
                        <div class="about-us__what-is-upperlicense__video">
                            <img src="{{asset('images/video-img.png')}}"
                                 class="about-us__what-is-upperlicense__video__background">
                            <img
                                    src="{{asset('images/play-button.png')}}"
                                    data-url="https://www.youtube.com/embed/ZdUFNtPZeXM"
                                    class="about-us__what-is-upperlicense__video__play-button pulse-animation play-video">
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-8 col-12 pl-lg-5 pr-lg-0 order-md-2 order-1">
                        <div class="about-us__what-is-upperlicense__header"><h1>@lang('messages.pages.about.what_is')
                                <img src="{{asset('images/upperLicense.png')}}"></h1></div>
                        <div class="about-us__what-is-upperlicense__text">
                            <span>@lang('messages.pages.about.platform_on_which_you_can_collect_everything_online')</span>
                        </div>
                    </div>
                </div>
            </div>
            <img class="about-us__what-is-upperlicense__background"
                 src="{{asset('images/about-us_background/background-section-2.png')}}">
        </div>
        <div class="about-us__here-you-will-find">
            <div class="container ">
                <div class="about-us__here-you-will-find__header">
                    <h1><b>@lang('messages.pages.about-us.here_you_will_find_everything')</b></h1>
                    <span class="about-us__here-you-will-find__header__mini">@lang('messages.pages.about-us.what_is_needed_to_obtain_licenses_and_permits')</span>
                </div>
                <div class="about-us__here-you-will-find__list-of-adv row z-index-primary">
                    <div class="col-lg-3 col-12 row ml-0 mr-0  pr-0 about-us__here-you-will-find__list-of-adv__adv-col">
                        <div class="col-2 pr-2">
                            <div class="about-us__here-you-will-find__list-of-adv__adv-number">1</div>
                        </div>
                        <div class="col-10 pl-2">
                            <h5 class="mb-2 pb-1"><span
                                        class="about-us__here-you-will-find__list-of-adv__adv-header">@lang('messages.pages.about-us.information')</span>
                            </h5>
                            <span class="about-us__here-you-will-find__list-of-adv__adv-text">@lang('messages.pages.about-us.you_no_longer_need_to_collect_information_from_different_sources_and_check_its_accuracy_and_relevance')</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12 row ml-0 mr-0 pr-0 about-us__here-you-will-find__list-of-adv__adv-col">
                        <div class="col-2">
                            <div class="about-us__here-you-will-find__list-of-adv__adv-number">2</div>
                        </div>
                        <div class="col-10 pr-1">
                            <h5 class="mb-2 pb-1"><span
                                        class="about-us__here-you-will-find__list-of-adv__adv-header">@lang('messages.pages.about-us.services')</span>
                            </h5>
                            <span class="about-us__here-you-will-find__list-of-adv__adv-text">@lang('messages.pages.about-us.You_do_not_need_to_collect_documents_yourself_to_submit')</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12 row ml-0 mr-0 pr-0 pl-lg-0 about-us__here-you-will-find__list-of-adv__adv-col">
                        <div class="col-2">
                            <div class="about-us__here-you-will-find__list-of-adv__adv-number">3</div>
                        </div>
                        <div class="col-10 pr-0">
                            <h5 class="mb-2 pb-1"><span
                                        class="about-us__here-you-will-find__list-of-adv__adv-header">@lang('messages.pages.about-us.accompanying_services')</span>
                            </h5>
                            <span class="about-us__here-you-will-find__list-of-adv__adv-text">@lang('messages.pages.about-us.we_have_selected_companies_with_useful_services_and_agreed_with_them')</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12 row ml-0 mr-0 pr-0 about-us__here-you-will-find__list-of-adv__adv-col d-none d-lg-flex">
                        <div class="col-2">
                            <div class="about-us__here-you-will-find__list-of-adv__adv-number">4</div>
                        </div>
                        <div class="col-10 pr-0">
                            <h5 class="mb-2 pb-1"><span
                                        class="about-us__here-you-will-find__list-of-adv__adv-header ">@lang('messages.pages.about-us.video_content_from_government_agencies')</span>
                            </h5>
                            <span class="about-us__here-you-will-find__list-of-adv__adv-text">@lang('messages.pages.about-us.we_cooperate_with_government_agencies')</span>
                        </div>
                    </div>
                </div>
            </div>
            <img class="about-us__here-you-will-find__background"
                 src="{{asset('images/about-us_background/bg-here-you-will-find.png')}}">
        </div>
        <div class="about-us__about-owner">
            <div class="container ">
                <div class="about-us__about-owner__header z-index-primary">
                    <div class="about-us__about-owner__header__logo">
                        <a href="https://uppercase.group" target="_blank">
                            <img src="{{asset('images/dark-logo.png')}}">
                        </a>
                    </div>
                    <div class="about-us__about-owner__header__text">
                        @lang('messages.pages.about-us.owner_and_developer_of_the_UPPERLICENSE_product')
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-12 about-us__about-owner__col mb-lg-5  row ml-0 mr-0 pl-0">
                        <div class="col-3 text-center"><img src="{{asset('images/about-owner-icons/1.png')}}"></div>
                        <div class="col-9 pl-lg-4 pr-0">@lang('messages.pages.about-us.more_than_10_years')</div>
                    </div>
                    <div class="col-lg-5 col-12 about-us__about-owner__col row ml-0 mr-0">
                        <div class="col-3 text-center"><img src="{{asset('images/about-owner-icons/2.png')}}"></div>
                        <div class="col-9">@lang('messages.pages.about-us.more_than_2500_clients')</div>
                    </div>
                    <div class="col-lg-4 col-12 about-us__about-owner__col row ml-0 mr-0 pr-0">
                        <div class="col-3 text-center"><img src="{{asset('images/about-owner-icons/3.png')}}"></div>
                        <div class="col-9">@lang('messages.pages.about-us.8_branches')</div>
                    </div>
                    <div class="col-lg-3 col-12 about-us__about-owner__col row ml-0 mr-0 pl-0 pr-0">
                        <div class="col-3 text-center"><img src="{{asset('images/about-owner-icons/4.png')}}"></div>
                        <div class="col-9 pl-lg-4 pr-0">@lang('messages.pages.about-us.it_solutions_developer')</div>
                    </div>
                    <div class="col-lg-5 col-12 about-us__about-owner__col row ml-0 mr-0">
                        <div class="col-3 text-center"><img src="{{asset('images/about-owner-icons/5.png')}}"></div>
                        <div class="col-9">@lang('messages.pages.about-us.3_offices_in_Kazakhstan')</div>
                    </div>
                    <div class="col-lg-4 col-12 about-us__about-owner__col row ml-0 mr-0">
                        <div class="col-3 text-center"><img src="{{asset('images/about-owner-icons/6.png')}}"></div>
                        <div class="col-9">@lang('messages.pages.about-us.head_office_in_the_UAE')</div>
                    </div>
                </div>
            </div>
            <img class="about-us__about-owner__background"
                 src="{{asset('images/about-us_background/background-section-2.png')}}">
        </div>
        <div class="about-us__near-footer">
            <div class="container text-center">
                <div class="about-us__near-footer__container z-index-primary">
                    <div class="about-us__near-footer__container__header mb-lg-4 mb-3">
                        <h1><b>@lang('messages.pages.about-us.we_make_it_easier_to_get')</b></h1>

                    </div>
                    <div class="about-us__near-footer__container__join">
                        <div class="about-us__near-footer__container__join__text ">
                            @lang('messages.pages.about-us.join')
                        </div>

                        <div class="text-center ">
                            <a class="btn btn-success about-us__near-footer__container__join__button" href="{{route('new-index') . '#listOfIndustries'}}">
                                @lang('messages.layouts.become_client')
                            </a>
                            <a class="btn btn-success about-us__near-footer__container__join__button" href="{{route('new-partners')}}">
                                @lang('messages.layouts.become_partner')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <img class="about-us__near-footer__background"
                 src="{{asset('images/about-us_background/bg-near-footer.png')}}">
        </div>
    </div>
@endsection

@section('js')
    <script>
        var id_count = 0;

        $(function () {


        });
    </script>
@endsection