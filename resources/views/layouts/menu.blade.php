@if(Auth::check())
    @if(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Administrator))
        <li class="" data-menutag="user-list">
            <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('admin.users.list')}}">
                @lang('messages.layouts.users')
            </a>
        </li>
{{--        <li class="" data-menutag="news-list">--}}
{{--            <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('admin.news.list')}}">--}}
{{--                @lang('messages.news.news')--}}
{{--            </a>--}}
{{--        </li>--}}
        <li class="dropdown header-new__menu-item">
            <a class="nav-link dropdown-toggle" href="#" id="additionally" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @lang('messages.layouts.additionally')
            </a>

            <ul class="dropdown-menu" aria-labelledby="additionally">
                <li class="dropdown-item">
                    <a href="{{route('admin.workingCalendar.list')}}">
                        @lang('messages.layouts.working_calendar')
                    </a>
                </li>
                <li class="dropdown-item">
                    <a href="{{route('admin.article.list')}}">
                        @lang('messages.layouts.pages')
                    </a>
                </li>
                {{--                <li class="dropdown-item">--}}
                {{--                    <a href="{{route('admin.mainServiceCarousel.list')}}">--}}
                {{--                        @lang('messages.layouts.service_carousel')--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                <li class="dropdown-item">
                    <a href="{{route('admin.countries.list')}}">
                        @lang('messages.layouts.countries')
                    </a>
                </li>
                <li class="dropdown-item">
                    <a href="{{route('admin.constants.index')}}">
                        @lang('messages.layouts.constants')
                    </a>
                </li>
                <li class="dropdown-item">
                    <a href="{{route('admin.employee')}}">
                        @lang('messages.admin.employee.employee_list')
                    </a>
                </li>
                <li class="dropdown-item">
                    <a href="{{route('admin.event')}}">
                        @lang('messages.admin.event.event_list')
                    </a>
                </li>
                <li class="dropdown-item dropdown-submenu">
                    <a class="dropdown-toggle-no-arrow"
                       data-toggle="dropdown"
                       aria-haspopup="true"
                       aria-expanded="false" href="#" id="dropdown_catalog">
                        @lang('messages.layouts.dictionary.title')
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown_catalog">
                        <li class="dropdown-item">
                            <a href="{{route('admin.dictionary.counter')}}">
                                @lang('messages.layouts.dictionary.counter')
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="{{route('admin.dictionary.city')}}">
                                @lang('messages.layouts.dictionary.city')
                            </a>
                        </li>
                        {{--                        <li class="dropdown-item">--}}
                        {{--                            <a href="{{route('admin.dictionary.company')}}">--}}
                        {{--                                @lang('messages.layouts.dictionary.company')--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                        <li class="dropdown-item">
                            <a href="{{route('admin.dictionary.licenseType')}}">
                                @lang('messages.layouts.dictionary.licenseType')
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="{{route('admin.dictionary.serviceAdditionalRequirementsType')}}">
                                @lang('messages.layouts.dictionary.serviceAdditionalRequirementsType')
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="{{route('admin.dictionary.serviceAdditionalRequirements')}}">
                                @lang('messages.layouts.dictionary.serviceAdditionalRequirements')
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="{{route('admin.dictionary.serviceRequiredDocument')}}">
                                @lang('messages.layouts.dictionary.serviceRequiredDocument')
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="{{route('admin.dictionary.serviceResult')}}">
                                @lang('messages.layouts.dictionary.serviceResult')
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown-item dropdown-submenu">
                    <a class="dropdown-toggle-no-arrow"
                       data-toggle="dropdown"
                       aria-haspopup="true"
                       aria-expanded="false" href="#" id="dropdown_catalog">

                        @lang('messages.layouts.catalog')
                        <i class="fa fa-caret-down"></i>

                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown_catalog">
                        <li class="dropdown-item">
                            <a href="{{route('admin.service_category')}}">
                                @lang('messages.layouts.service_categories')
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="{{route('admin.service_thematic_group')}}">
                                @lang('messages.layouts.thematic_groups')
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="{{route('admin.catalog')}}">
                                @lang('messages.layouts.catalog')
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="{{route('admin.service_list')}}">
                                @lang('messages.all.services')
                            </a>
                        </li>
                        {{--                        <li class="dropdown-item">--}}
                        {{--                            <a href="{{route('admin.service_step_list')}}">--}}
                        {{--                                @lang('messages.all.serviceStepList')--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                        <li class="dropdown-item">
                            <a href="{{route('admin.service_import')}}">
                                @lang('messages.admin.service.import.title')
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown-item">
                    <a href="{{route('admin.faq.list')}}">
                        @lang('messages.layouts.faq')
                    </a>
                </li>
            </ul>

        </li>

        <li class="dropdown header-new__menu-item">
            <a class="nav-link dropdown-toggle" href="#" id="registration_form" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @lang('messages.layouts.registration_form')
            </a>

            <ul class="dropdown-menu" aria-labelledby="registration_form">
                <li class="dropdown-item">
                    <a href="{{route('admin.registrationFormTemplate.optionsetType.index')}}">
                        @lang('messages.layouts.title')
                    </a>
                </li>
                <li class="dropdown-item">
                    <a href="{{route('admin.registrationFormTemplate.parameterGroup.index')}}">
                        @lang('messages.layouts.parameterGroupName')
                    </a>
                </li>
                <li class="dropdown-item">
                    <a href="{{route('admin.registrationFormTemplate.index')}}">
                        @lang('messages.layouts.registrationForm')
                    </a>
                </li>
            </ul>
        </li>
        <li class="dropdown header-new__menu-item">
            <a class="nav-link dropdown-toggle" href="#" id="standartСontractTemplate" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @lang('messages.layouts.standartСontractTemplate')
            </a>

            <ul class="dropdown-menu" aria-labelledby="standartСontractTemplate">
                <li class="dropdown-item">
                    <a href="{{route('company.standart_contract_template_type')}}">
                        @lang('messages.layouts.standartСontractTemplateType')
                    </a>
                </li>
                <li class="dropdown-item">
                    <a href="{{route('company.standart_contract_template')}}">
                        @lang('messages.layouts.standartСontractTemplate')
                    </a>
                </li>
            </ul>
        </li>
    @elseif(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::SaleManager))
        <li class="" data-menutag="service-list">
            <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('sale_manager.service.list')}}">
                @lang('messages.all.services')
            </a>
        </li>
        <li class="" data-menutag="commercial-offer-list">
            <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('sale_manager.potential_client.index')}}">
                @lang('messages.all.potential_client')
            </a>
        </li>
        <li class="" data-menutag="commercial-offer-list">
            <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('sale_manager.commercial_offer.index')}}">
                @lang('messages.all.commercial_offer')
            </a>
        </li>
    @elseif(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Curator))
        <li class="" data-menutag="curator-review-list">
            <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('curator.review.list')}}">
                @lang('messages.all.services')
            </a>
        </li>
        <li class="" data-menutag="client-list">
            <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('sale_manager.client.index')}}">
                @lang('messages.sale_manager.clients')
            </a>
        </li>
    @elseif(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Curator))
        <li class="" data-menutag="curator-review-list">
            <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('curator.review.list')}}">
                @lang('messages.all.services')
            </a>
        </li>
    @elseif(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Manager) || Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Partner))

        <li class="" data-menutag="manager-executor-list">
            <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('manager.executor.list')}}">
                @lang('messages.layouts.performers')
            </a>
        </li>
        <li class="" data-menutag="manager-groups-list">
            <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('manager.groups.list')}}">
                @lang('messages.layouts.groups')
            </a>
        </li>
        <li class="" data-menutag="manager-services-list">
            <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('manager.services.list')}}">
                @lang('messages.all.services')
            </a>
        </li>
    @elseif(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Executor))
        <li class="" data-menutag="executor-project-list">
            <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('executor.project.list')}}">
                @lang('messages.layouts.projects')
            </a>
        </li>
    @elseif(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client))
        <li class="" data-menutag="main">
            <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('new-index')}}">
                @lang('messages.layouts.main')
            </a>
        </li>
        <li class="" data-menutag="about">
            <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('new-about')}}">
                @lang('messages.layouts.about')
            </a>
        </li>
{{--        <li class="" data-menutag="service-list">--}}
{{--            <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('services')}}">--}}
{{--                @lang('messages.all.services')--}}
{{--            </a>--}}
{{--        </li>--}}
        <li class="" data-menutag="partner">
            <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('new-partners')}}">
                @lang('messages.layouts.partner')
            </a>
        </li>
{{--        <li class="dropdown header-new__menu-item">--}}
{{--            <a class="nav-link dropdown-toggle" href="#" id="license_school" role="button"--}}
{{--               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                @lang('messages.layouts.license_school')--}}
{{--            </a>--}}

{{--            <ul class="dropdown-menu" aria-labelledby="license_school">--}}
{{--                <li class="dropdown-item" data-menutag="publications_npa">--}}
{{--                    <a href="{{route('news.npa.list')}}">--}}
{{--                        @lang('messages.layouts.npa_news')--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="dropdown-item" data-menutag="news">--}}
{{--                    <a href="{{route('news.list')}}">--}}
{{--                        @lang('messages.layouts.news')--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="dropdown-item" data-menutag="publications_news">--}}
{{--                    <a href="{{route('news.expert.list')}}">--}}
{{--                        @lang('messages.layouts.publications_news')--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="dropdown-item" data-menutag="publications_government_agencies">--}}
{{--                    <a href="{{route('news.government_agencies.list')}}">--}}
{{--                        @lang('messages.layouts.government_agencies_news')--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="dropdown-item" data-menutag="faq">--}}
{{--                    <a href="{{route('news.faq.list')}}">--}}
{{--                        @lang('messages.layouts.faq')--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
    @elseif(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Head))
        <li class="" data-menutag="report-index">
            <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('Report.index')}}">
                @lang('messages.layouts.analytics')
            </a>
        </li>
        <li class="" data-menutag="career-index">
            <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('head.career.index')}}">
                @lang('messages.layouts.career')
            </a>
        </li>
        <li class="" data-menutag="partner-index">
            <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('head.partner.index')}}">
                @lang('messages.layouts.potential_partner')
            </a>
        </li>
        <li class="" data-menutag="head-services">
            <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('head.services')}}">
                @lang('messages.head.services.name')
            </a>
        </li>
    @elseif(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Accountant))
        <li class="" data-menutag="accountant-bills">
            <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('Accountant.services')}}">
                @lang('messages.accountant.services')
            </a>
        </li>
        <li class="" data-menutag="document-template">
            <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('company.document_template')}}">
                @lang('messages.layouts.document_template')
            </a>
        </li>
    @endif
@else
    <li class="" data-menutag="main">
        <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('new-index')}}">
            @lang('messages.layouts.main')
        </a>
    </li>
    <li class="" data-menutag="about">
        <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('new-about')}}">
            @lang('messages.layouts.about')
        </a>
    </li>
{{--    <li class="" data-menutag="service-list">--}}
{{--        <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('services')}}">--}}
{{--            @lang('messages.all.services')--}}
{{--        </a>--}}
{{--    </li>--}}
    <li class="" data-menutag="partner">
        <a class="nav-link px-2 header-new__menu-item px-2" href="{{route('new-partners')}}">
            @lang('messages.layouts.partner')
        </a>
    </li>
{{--    <li class="dropdown header-new__menu-item">--}}
{{--        <a class="nav-link dropdown-toggle" href="#" id="license_school" role="button"--}}
{{--           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--            @lang('messages.layouts.license_school')--}}
{{--        </a>--}}

{{--        <ul class="dropdown-menu" aria-labelledby="license_school">--}}
{{--            <li class="dropdown-item" data-menutag="publications_npa">--}}
{{--                <a href="{{route('news.npa.list')}}">--}}
{{--                    @lang('messages.layouts.npa_news')--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="dropdown-item" data-menutag="news">--}}
{{--                <a href="{{route('news.list')}}">--}}
{{--                    @lang('messages.layouts.news')--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="dropdown-item" data-menutag="publications_news">--}}
{{--                <a href="{{route('news.expert.list')}}">--}}
{{--                    @lang('messages.layouts.publications_news')--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="dropdown-item" data-menutag="publications_government_agencies">--}}
{{--                <a href="{{route('news.government_agencies.list')}}">--}}
{{--                    @lang('messages.layouts.government_agencies_news')--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="dropdown-item" data-menutag="faq">--}}
{{--                <a href="{{route('news.faq.list')}}">--}}
{{--                    @lang('messages.layouts.faq')--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </li>--}}
@endif

{{--    <ul class="navbar-nav ul-light-theme d-block d-sm-none">--}}
{{--        <li class=" dropdown border-cabinet" data-menutag="Location">--}}
{{--            <a class="nav-link no-line" data-toggle="dropdown" aria-haspopup="true"--}}
{{--               aria-expanded="false" href="#" id="dropdown02">--}}

{{--                <div class="text-nowrap d-flex justify-content-between">--}}
{{--                    {{$country->name}}--}}
{{--                    <i class="fas fa-map-marker-alt"></i>--}}

{{--                </div>--}}
{{--            </a>--}}
{{--            <div class="dropdown-menu" aria-labelledby="dropdown02">--}}
{{--                @foreach($_countryList as $countries)--}}
{{--                    <a class="dropdown-item" href="{{asset('setLocationCountry')}}"--}}
{{--                       data-location_country_code="{{$countries->code}}"--}}
{{--                       onclick="event.preventDefault(); document.getElementById('selectcountry-form{{$countries->code}}').submit();">--}}
{{--                        {{$countries->name}}--}}
{{--                    </a>--}}

{{--                    <form id="selectcountry-form{{$countries->code}}"--}}
{{--                          action="{{ asset('setLocationCountry') }}" method="POST"--}}
{{--                          style="display: none;">--}}
{{--                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>--}}
{{--                        <input type="hidden" name="location_country_code"--}}
{{--                               value="{{$countries->code}}"/>--}}
{{--                    </form>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </li>--}}
{{--        <li class=" dropdown border-cabinet" data-menutag="profile">--}}
{{--            @if (Auth::check())--}}
{{--                <a class="nav-link xs-top-30" data-toggle="dropdown" aria-haspopup="true"--}}
{{--                   aria-expanded="false" href="#" id="dropdown01">--}}
{{--                    <div class="text-nowrap d-flex justify-content-between">--}}
{{--                        @lang('messages.layouts.personal_area')--}}
{{--                        <i class="far fa-user-circle"></i>--}}
{{--                    </div>--}}

{{--                </a>--}}
{{--                <div class="dropdown-menu" aria-labelledby="dropdown01">--}}
{{--                    <a class="dropdown-item"--}}
{{--                       href="{{route('profile')}}">@lang('messages.layouts.personal_area')</a>--}}
{{--                    <a class="dropdown-item" href="{{asset('logout')}}"--}}
{{--                       onclick="event.preventDefault();--}}
{{--                                                                document.getElementById('logout-form').submit();">--}}
{{--                        @lang('messages.layouts.logout') </a>--}}

{{--                    <form id="logout-form" action="{{ \LaravelLocalization::localizeURL('/logout') }}" method="POST"--}}
{{--                          style="display: none;">--}}
{{--                        {{ csrf_field() }}--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            @else--}}
{{--                <a class="nav-link xs-top-30" aria-haspopup="true" aria-expanded="false"--}}
{{--                   href="{{ route('login') }}" id="dropdown01">--}}

{{--                    <div class="text-nowrap d-flex justify-content-between">--}}
{{--                        @lang('messages.layouts.personal_area')--}}
{{--                        <i class="far fa-user-circle"></i>--}}
{{--                    </div>--}}

{{--                </a>--}}
{{--            @endif--}}
{{--        </li>--}}
{{--    </ul>--}}