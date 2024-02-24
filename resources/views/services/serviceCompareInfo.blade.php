@extends('new.layouts.app')

@section('title')
    {{$license->name}}
@endsection

@section('meta-description')
    {{$license->name}}
@endsection

@section('header__background')
    <div class="header__background header__background-{{$serviceCategory->id}}"></div>
@endsection
@section('footer__background')footer__background-{{$serviceCategory->id}}@endsection

@section('content')
    <div class="subLicense">
        <div class="subLicense__description-and-requirements">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                    href="{{route('new-index') . '#listOfIndustries'}}">@lang('messages.layouts.services')</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                    href="{{route('services.groupList', ['Id' => $serviceCategory->id])}}">{{$serviceCategory->description}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{$license->name}}</li>
                    </ol>
                </nav>
                <div class="subLicense__description-and-requirements__header">
                    <span class="subLicense__description-and-requirements__header__description">@lang('messages.pages.services.description_and_requirements_for_obtaining_a_license'):</span>
                    <h1>
                        {{$license->name}}
                    </h1>
                </div>
                <div class="subLicense__description-and-requirements__container row">
                    <div class="col-md-7 col-12 subLicense__description-and-requirements__container__when-necessary">

                        <div class="row">
                            <h4 class="subLicense__description-and-requirements__container__when-necessary__header offset-1 col-md-11 col-6">
                                @lang('messages.pages.services.when_is_it_necessary_to_obtain_a_license')
                            </h4>
                            <div class="col-5 d-md-none d-block">
                                <img src="{{asset('images/services/when-necessary-background-img.png')}}"
                                     class="subLicense__description-and-requirements__container__when-necessary__header__img">
                            </div>
                            <div class="col-1 ">
                                <div class="subLicense__description-and-requirements__container__when-necessary__check-icon">
                                    <i class="fal fa-check"></i></div>
                            </div>
                            <div class="col-11 mb-4">
                                <span class="subLicense__description-and-requirements__container__when-necessary__text col-md-9 col-10 pl-0 pr-0">
                                    @lang('messages.pages.about.find_the_theme_you_want_using_the_search_bar_or_catalog')
                                </span>
                            </div>
                            <div class="col-1 ">
                                <div class="subLicense__description-and-requirements__container__when-necessary__check-icon">
                                    <i class="fal fa-check"></i></div>
                            </div>
                            <div class="col-11 mb-4 ">
                                <span class="subLicense__description-and-requirements__container__when-necessary__text col-md-9 col-10 pl-0 pr-0">
                                    @lang('messages.pages.about.download_the_list_of_requirements_for_obtaining_permits_for_free')
                                </span>
                            </div>
                            <div class="col-1 ">
                                <div class="subLicense__description-and-requirements__container__when-necessary__check-icon">
                                    <i class="fal fa-check"></i></div>
                            </div>
                            <div class="col-11 mb-4 ">
                                <span class="subLicense__description-and-requirements__container__when-necessary__text col-md-9 col-10 pl-0 pr-0">
                                    <b>@lang('messages.pages.about.we_have_been_collecting_the_database_for_over_1_year')</b>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-12 subLicense__description-and-requirements__container__subtypes-licenses">
                        <div class="accordion subLicense__description-and-requirements__container__subtypes-licenses__list "
                             id="accordion-subLicense-list">

                            <div class="subLicense-list_header-title accordion__header" data-toggle="collapse"
                                 data-target="#subLicense-list" aria-expanded="false"
                                 aria-controls="subLicense-list">
                                @lang('messages.pages.services.selected_subtypes_of_licenses')
                            </div>

                            <div id="subLicense-list" class="subLicense-list_body collapse mt-3  pb-3"
                                 aria-labelledby="subLicense-list-heading"
                                 data-parent="#accordion-subLicense-list"
                            >
                                @foreach($serviceList as $service)
                                    <div class="subLicense-list-item">
                                        {!! $service->name !!}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

            </div>
        </div>

        <div class="subLicense__qualification-requirements">
            <img class="about-us__about-owner__background"
                 src="{{asset('images/about-us_background/background-section-2.png')}}">
            <div class="container">
                <div class="subLicense__qualification-requirements__header mb-5">
                    <h1 class="mb-3">@lang('messages.pages.services.qualification_requirements_for_obtaining_license')</h1>
                    {{--                    <button class="btn-like-href" type="button" data-toggle="modal"--}}
                    {{--                            data-target="#modalDownloadRequirement">--}}
                    {{--                        @lang('messages.pages.services.download_requirements') →--}}
                    {{--                    </button>--}}

                    @foreach($serviceList->groupBy('npa_link') as $link => $serviceList)
                        <div class="mb-3">
                            <a href="{!! $link !!}" target="_blank">@lang('messages.pages.services.npa_link') →</a>

                            <div class="accordion subLicense__description-and-requirements__container__subtypes-licenses__list "
                                 id="accordion-npa_link-list_{{$loop->index}}">

                                <div class="subLicense-list_header-title accordion__header" data-toggle="collapse"
                                     data-target="#npa_link-list_{{$loop->index}}" aria-expanded="false"
                                     aria-controls="npa_link-list_{{$loop->index}}">
                                    @lang('messages.pages.services.subtypes_of_licenses')
                                </div>

                                <div id="npa_link-list_{{$loop->index}}"
                                     class="subLicense-list_body collapse mt-3  pb-3"
                                     aria-labelledby="npa_link-list-heading"
                                     data-parent="#accordion-npa_link-list_{{$loop->index}}"
                                >
                                    @foreach($serviceList as $service)
                                        <div class="npa_link-list-item mb-3">
                                            {!! $service->name !!}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="subLicense__qualification-requirements__addition-requirements ">
                    @foreach($serviceAdditionalRequirements->groupBy('name') as $type => $valueList)
                        <div class="accordion subLicense__qualification-requirements__addition-requirements__list collapsed mb-5">
                            <div class=" subLicense__qualification-requirements__addition-requirements__list__header-title accordion__header"
                                 id="additionRequirements-{{$loop->index}}" data-toggle="collapse"
                                 data-target="#additionRequirementsBody-{{$loop->index}}" aria-expanded="false"
                                 aria-controls="additionRequirementsBody">
                                {{$type}}
                            </div>

                            <div class="subLicense__qualification-requirements__addition-requirements__list__body ml-4 mt-4 collapse"
                                 id="additionRequirementsBody-{{$loop->index}}" class="collapse"
                                 aria-labelledby="additionRequirements-{{$loop->index}}"
                                 data-parent="#additionRequirements-{{$loop->index}}">
                                <div class="row col-11 pl-0 pr-0">
                                    @foreach($valueList->sortBy('description')->chunk(ceil($valueList->count()/2)) as $chunkValue)
                                        <div class="col-md-6 col-12 subLicense__qualification-requirements__addition-requirements__list__body__text">
                                            @foreach($chunkValue as $value)
                                                <div>{{$value->description}}</div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


                <div class="subLicense__qualification-requirements__info">
                    <div class="row col-md-9 col-11 pl-0 pr-0">
                        <div class="col-md-6 col-12 mb-md-3">
                            <span>@lang('messages.pages.services.issuing_authority'):</span></div>
                        <div class="col-md-6 col-12 mb-3 mb-md-0">
                            @foreach($serviceList->unique('executive_agency') as $serviceItem)
                                <div><span><b>{{$serviceItem->executive_agency}}</b></span></div>
                            @endforeach
                        </div>
                        <div class="col-md-6 col-12 mb-md-3">
                            <span>@lang('messages.pages.services.additional_approvals'):</span>

                        </div>
                        <div class="col-md-6 col-12 mb-3 mb-md-0"><span>
                                   @foreach($serviceList->unique('additional_approvals') as $serviceItem)
                                    <div><span><b>{{$serviceItem->additional_approvals ?? trans('messages.pages.services.not_required')}}</b></span></div>
                                @endforeach
                        </span>
                        </div>
                        <div class="col-md-6 col-12 mb-md-3">
                            <span>@lang('messages.pages.services.national_tax'):</span>
                        </div>
                        <div class="col-md-6 col-12 mb-3 mb-md-0">
                            <span><b>{{number_format($serviceTotals->stepTaxMRPTotal, 0, ',', ' ')}} @lang('messages.admin.systemConstant.mrp') ({{number_format($serviceTotals->stepTaxTotal, 0, ',', ' ')}} {{$serviceTotals->currency->name}})</b></span>
                        </div>
                    </div>
                    <img class="subLicense__qualification-requirements__info__background"
                         src="{{asset('images/services/qualification-requirements-info-background.png')}}">
                    <button class="btn btn-success  d-block d-md-none w-100" type="button" data-toggle="modal"
                            data-target="#modalDownloadRequirement">
                        @lang('messages.pages.services.download_requirements')
                    </button>
                </div>
                <div class="mt-5 pt-3 d-none d-md-block">
                    <button class="btn btn-success" type="button" data-toggle="modal"
                            data-target="#modalDownloadRequirement">
                        @lang('messages.pages.services.download_requirements')
                    </button>
                </div>
            </div>
        </div>
        <div class="subLicense__order-license">
            <div class="container">
                <div class="subLicense__order-license__about">
                    <div class="subLicense__order-license__about__header z-index-primary">@lang('messages.pages.services.order_a_license_online_on_our_platform')</div>
                    <div class="row">
                        <div class="col-md-5 col-9 z-index-primary">
                            <div class="row">
                                <div class="col-lg-1 col-2">
                                    <div class="subLicense__description-and-requirements__container__when-necessary__check-icon">
                                        <i class="fal fa-check"></i></div>
                                </div>
                                <div class="pl-lg-4 pl-1 col-lg-11 col-10 mb-3">
                                    <span class="subLicense__order-license__about__text">
                                        @lang('messages.pages.services-page.we_will_help_you_in_obtaining_all_the_documents_required_for_a_license')
                                    </span>
                                </div>
                                <div class="col-lg-1 col-2">
                                    <div class="subLicense__description-and-requirements__container__when-necessary__check-icon">
                                        <i class="fal fa-check"></i></div>
                                </div>
                                <div class="pl-lg-4 pl-1 col-lg-11 col-10 mb-3">
                                    <span class="subLicense__order-license__about__text">
                                        @lang('messages.pages.services-page.you_dont_need_to_go_anywhere_all_documents_are_submitted_online')
                                    </span>
                                </div>
                                <div class="col-lg-1 col-2">
                                    <div class="subLicense__description-and-requirements__container__when-necessary__check-icon">
                                        <i class="fal fa-check"></i></div>
                                </div>
                                <div class="pl-lg-4 pl-1 col-lg-11 col-10 mb-3">
                                    <span class="subLicense__order-license__about__text">
                                        @lang('messages.pages.services.you_can_track_the_process_of_obtaining_a_license_in_your_personal_account')
                                    </span>
                                </div>
                                <div class="col-lg-1 col-2">
                                    <div class="subLicense__description-and-requirements__container__when-necessary__check-icon">
                                        <i class="fal fa-check"></i></div>
                                </div>
                                <div class="pl-lg-4 pl-1 col-lg-11 col-10 mb-3">
                                    <span class="subLicense__order-license__about__text">
                                        @lang('messages.pages.services.a_personal_manager_will_be_assigned_to_you_always_ready_to_answer_your_questions')
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-3 position-relative">
                            <img class="subLicense__order-license__about__background d-md-block d-none"
                                 src="{{asset('images/services/order-license-background.png')}}">
                            <img class="subLicense__order-license__about__mobile-background d-md-none d-block"
                                 src="{{asset('images/services/order-license-mobile-background.png')}}">
                        </div>
                    </div>
                </div>
                <div class="subLicense__order-license__registration-of-license">
                    <div class="subLicense__order-license__registration-of-license__header">
                        <div class="mb-3"><b>@lang('messages.pages.services-page.type_of_the_issued_license')</b>
                            <span class="secondary-txt pl-md-3">{{$license->name}}</span></div>
                        <div class="mb-3">
                            <b>@lang('messages.pages.services.are_you_a_resident_of_the_Republic_of_Kazakhstan')</b>
                            <div class="d-none d-sm-block d-xl-none mt-sm-2">
                                <div class="form-check form-check-inline mt-2 mt-md-0">
                                    <input class="form-check-input" type="radio" name="isResident"
                                           id="isResidentCheckBox-lg-1"
                                           value="1">
                                    <label class="form-check-label" for="isResidentCheckBox-lg-1"><span
                                                class="secondary-txt">@lang('messages.pages.services.i_am_resident')</span></label>
                                </div>
                                <div class="form-check form-check-inline mt-2 mt-md-0">
                                    <input class="form-check-input" type="radio" name="isResident"
                                           id="isResidentCheckBox-lg-2"
                                           value="0">
                                    <label class="form-check-label" for="isResidentCheckBox-lg-2"><span
                                                class="secondary-txt">@lang('messages.pages.services.i_am_not_resident')</span></label>
                                </div>
                            </div>
                            <div class="d-none d-xl-inline">
                                <div class="form-check form-check-inline mt-2 mt-md-0">
                                    <input class="form-check-input" type="radio" name="isResident"
                                           id="isResidentCheckBox-1"
                                           value="1">
                                    <label class="form-check-label" for="isResidentCheckBox-1"><span
                                                class="secondary-txt">@lang('messages.pages.services.i_am_resident')</span></label>
                                </div>
                                <div class="form-check form-check-inline mt-2 mt-md-0">
                                    <input class="form-check-input" type="radio" name="isResident"
                                           id="isResidentCheckBox-2"
                                           value="0">
                                    <label class="form-check-label" for="isResidentCheckBox-2"><span
                                                class="secondary-txt">@lang('messages.pages.services.i_am_not_resident')</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <b class="pr-3">@lang('messages.pages.services.processing_time'):</b>
                            <button class="btn-like-href ">
                                {{$serviceTotals->executionWorkDayTotal}}
                                {{ \App\Data\Helper\Assistant::num2word($serviceTotals->executionWorkDayTotal,  trans('messages.services.one_work_day'),  trans('messages.services.two_work_days'),  trans('messages.services.work_days') )}}
                            </button>
                        </div>
                    </div>
                    <div class="row  subLicense__order-license__registration-of-license__list">
                        @foreach($serviceStepList as $index => $serviceStep)

                            <div class="col-lg-1 col-2 ">
                                <div class="subLicense__description-and-requirements__container__when-necessary__check-icon ml-auto">{{$index+1}}</div>
                            </div>
                            <div class="col-lg-11 col-10 pl-0 lg-3 mt-1">
                                <div>
                                    <b>{{$serviceStep->serviceStepWithLastCostHist->description}}</b>
                                </div>
                                @if(sizeof($serviceStep->serviceStepWithLastCostHist->serviceStepRequiredDocumentList) > 0)
                                    <div class="accordion collapsed pl-3">
                                        <div class="accordion__header text-green"
                                             id="requiredDocument-{{$loop->index}}" data-toggle="collapse"
                                             data-target="#requiredDocumentBody-{{$loop->index}}" aria-expanded="false"
                                             aria-controls="requiredDocumentBody">
                                            @lang('messages.pages.services.list_of_documents')
                                        </div>

                                        <div class="subLicense__qualification-requirements__addition-requirements__list__body ml-4 collapse"
                                             id="requiredDocumentBody-{{$loop->index}}" class="collapse"
                                             aria-labelledby="requiredDocument-{{$loop->index}}"
                                             data-parent="#requiredDocument-{{$loop->index}}">
                                            <div class="row col-11 pl-0 pr-0">
                                                <ul>
                                                    @foreach($serviceStepRequiredDocumentList->where('service_step_id', $serviceStep->service_step_id)->all() as $curStepRequiredDocument)

                                                        @php
                                                            $description=str_replace(")", "</i>)",str_replace("(", "(<i>", $curStepRequiredDocument->serviceRequiredDocumentWithTranslate->description));
                                                            $description=str_replace(":",": </br>",$description);
                                                            $description=str_replace(";","; </br>",$description);
                                                        @endphp
                                                        <li>{!!$description!!}</li>
                                                        {{--                                                    {{$curStepRequiredDocument->document_template_path}}--}}
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    {{--                                <div class="pl-3">--}}
                                    {{--                                    <button class="btn-like-href"><b>@lang('messages.pages.services.list_of_documents')</b></button>--}}
                                    {{--                                </div>--}}




                                @endif


                                @if($serviceStep->serviceStepWithLastCostHist->execution_work_day_cnt!=0)
                                    <div class="pl-3">
                                        <span><b>@lang('messages.services.registration_term'): </b></span>
                                        <span class="secondary-txt">
                                                                                {{$serviceStep->serviceStepWithLastCostHist->execution_work_day_cnt}}
                                            {{ \App\Data\Helper\Assistant::num2word($serviceStep->serviceStepWithLastCostHist->execution_work_day_cnt,  trans('messages.services.one_work_day'),  trans('messages.services.two_work_days'),  trans('messages.services.work_days') )}}
                                                                            </span>
                                    </div>
                                @endif
                                {{--                                @if($serviceStep->serviceStepWithLastCostHist->tax != 0 )--}}
                                {{--                                <div class="pl-3">--}}
                                {{--                                    <span><b>@lang('messages.services.tax_of_service'): </b></span>--}}
                                {{--                                    <span class="secondary-txt"> {{number_format($serviceTotals->stepTaxTotal, 0, ',', ' ')}} {{$serviceTotals->currency->name}}</span>--}}
                                {{--                                </div>--}}
                                {{--                                @endif--}}
                                <div class="pl-3">
                                    @foreach($serviceStepResultList->where('service_step_id', $serviceStep->service_step_id)->all() as $serviceStepResult)

                                        @if ($loop->first)
                                            <span><b>@lang('messages.services.result'):</b></span>
                                        @endif

                                        <span class="secondary-txt">{{$serviceStepResult->serviceResultWithTrans->description}}.</span>

                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @foreach($serviceList as $service)
                        <input name="serviceId[]" type="hidden" value="{{$service->id}}"/>
                    @endforeach

                    <div class="  subLicense__order-license__registration-of-license__payment">
                        <div class="mb-3 mt-3 subLicense__order-license__registration-of-license__payment__total">
                            <span><b>@lang('messages.pages.services.service_cost'):</b></span>
                            <span class="ml-md-3 ml-2 text-primary">
                                <b>{{number_format($serviceTotals->stepCostTotal, 0, ',', ' ')}} {{$serviceTotals->currency->name}}</b>
                                    @if($serviceCategory->id == 65 || $serviceCategory->id == 77)
                                    *
                                @endif
                            </span>
                            @if($serviceCategory->id == 65 || $serviceCategory->id == 77)
                                <div>
                                    <span class="secondary-txt">
                                        @lang('messages.pages.services.cost_description_import_export')
                                    </span>
                                </div>
                            @endif
                        </div>

                        <div class="pl-5 subLicense__order-license__registration-of-license__payment__prepayment">
                            @php
                                $prepaymentCost = round(\App\Data\Core\Dal\SettingDal::getPrepaymentCost());
                            @endphp
                            <div><b>@lang('messages.accountant.is_prepayment_paid'):</b> <span
                                        class="secondary-txt">{{number_format($serviceTotals->stepCostTotal * $prepaymentCost/100, 0, ',', ' ')}} {{$serviceTotals->currency->name}} ({{$prepaymentCost}}% @lang('messages.pages.services.from_the_sum'))</span>
                            </div>
                            <div><b>2 @lang('messages.pages.services.payment'):</b> <span
                                        class="secondary-txt">{{number_format($serviceTotals->stepCostTotal * (100 - $prepaymentCost) / 100, 0, ',', ' ')}} {{$serviceTotals->currency->name}} ({{100-$prepaymentCost}}% @lang('messages.pages.services.from_the_sum'))</span>
                            </div>
                        </div>
                    </div>
                    <div class="subLicense__order-license__registration-of-license__after">
                        <img src="{{asset('images/services/registration-of-license-after.png')}}">
                    </div>

                </div>
                <div class="row subLicense__order-license__under-block">
                    <div class="col-md-6 col-12 text-center">
                        <div class="subLicense__order-license__under-block__text-under-button">
                            @lang('messages.pages.services.order_license_and_get_it_guaranteed_and_on_time')
                        </div>
                        <button class="btn btn-success orderService" type="button" data-toggle="modal"
                                data-target="#modalOrderService">{{trans('messages.pages.services-page.order_a_license')}}</button>
                    </div>
                    <div class="col-md-6 col-12 mt-4 mt-md-0 text-center mb-md-5">
                        <div class="subLicense__order-license__under-block__text-under-button">
                            @lang('messages.pages.services.download_commercial_offer_with_detailed_description_of_the_service')
                        </div>
                        <button class="btn btn-success mr-md-3 " type="button" data-toggle="modal"
                                data-target="#modalDownloadCommercialOffer">{{trans('messages.pages.services.download_commercial_offer')}}</button>
                    </div>
                    {{--                    <div class="col-12 mt-5 text-center">--}}
                    {{--                        <button class="btn-like-href">@lang('messages.pages.services.learn_more_about_the_process_of_obtaining_license_through_the_UPPERLICENSE_platform')--}}
                    {{--                            →--}}
                    {{--                        </button>--}}
                    {{--                    </div>--}}
                </div>
            </div>


        </div>
    </div>


    <div class="modal fade" id="modalDownloadCommercialOffer" tabindex="-1" role="dialog"
         aria-labelledby="modalDownloadCommercialOfferLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            @include('services._sendCommercialOffer', ['isModal' => true])
        </div>
    </div>

    <div class="modal fade" id="modalSendEmailConfirm" tabindex="-1" role="dialog"
         aria-labelledby="modalSendEmailConfirmLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            @include('services._sendEmailConfirm')
        </div>
    </div>

    <div class="modal fade" id="modalDownloadRequirement" tabindex="-1" role="dialog"
         aria-labelledby="modalDownloadRequirementLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" id="formDownloadRequirement"
                  action="{{route('services.sendServiceRequirement')}}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"
                            id="modalDownloadRequirementLabel">{{trans('messages.services.serviceRequirement.title')}}</h5>
                      <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button>
                    </div>
                    <div class="modal-body">

                        @if(\Illuminate\Support\Facades\Auth::guest())
                            <label>{{trans('messages.services.serviceRequirement.non_auth_label')}}</label>
                            <input class="form-control mb-2" type="email"
                                   id="serviceRequirementEmail"
                                   placeholder="{{trans('messages.services.serviceRequirement.email')}}"
                                   required value=""/>
                            <input class="form-control mb-2" type="tel"
                                   id="serviceRequirementPhone"
                                   placeholder="{{trans('messages.services.serviceRequirement.phone')}}"
                                   required value=""/>
                            <input class="form-control" type="text" id="serviceRequirementName"
                                   placeholder="{{trans('messages.services.commercialOffer.name')}}"
                                   value=""/>
                        @else
                            <label>{{trans('messages.services.serviceRequirement.auth_label')}}</label>
                            <input class="form-control mb-2" type="email"
                                   id="serviceRequirementEmail"
                                   placeholder="{{trans('messages.services.serviceRequirement.email')}}"
                                   required
                                   value="{{\Illuminate\Support\Facades\Auth::user()->email}}"/>
                            <input class="form-control mb-2" type="tel"
                                   id="serviceRequirementPhone"
                                   placeholder="{{trans('messages.services.serviceRequirement.phone')}}"
                                   required
                                   value="{{\Illuminate\Support\Facades\Auth::user()->profile->phone}}"/>
                            <input class="form-control mb-2" type="text"
                                   id="serviceRequirementName"
                                   placeholder="{{trans('messages.services.serviceRequirement.name')}}"
                                   value="{{\Illuminate\Support\Facades\Auth::user()->name}}"/>
                        @endif
                        <div class="form-check pl-0 mt-2">
                            <input type="checkbox" class="form-check-input" checked id="offerCheck">
                            <label class="form-check-label" for="offerCheck">
                                @lang('messages.pages.setPaymentType.i_accept_the_terms_of_the_public_offer_1')
                                <a href="{{route("offer")}}" target="_blank">
                                    @lang('messages.pages.setPaymentType.i_accept_the_terms_of_the_public_offer_2')
                                </a>
                                {{--                                                @lang('messages.pages.setPaymentType.i_accept_the_terms_of_the_public_offer_3')--}}
                                <span
                                        class="text-danger">*</span>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                                data-bs-dismiss="modal">{{trans('messages.all.cancel')}}</button>
                        <button type="submit"
                                class="btn btn-success formDownloadRequirement_submit">{{trans('messages.all.send')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('js')
    <script>
        // //activeTab('services');

        function getServiceIdList() {
            let serviceIdList = [];
            // $('.service').each(function () {
            //     serviceIdList.push($(this).data('service-id'));
            // });
            $('input[name="serviceId[]"]').each(function () {
                serviceIdList.push($(this)[0].value)
            });

            return serviceIdList;
        }

        function getServiceStepIdList() {
            let serviceStepIdList = [];
            // $('input[type="checkbox"]:checked').each(function () {
            //     serviceStepIdList.push($(this)[0].value)
            // });
            $('input[name="serviceStepId[]"]').each(function () {
                serviceStepIdList.push($(this)[0].value)
            });

            return serviceStepIdList;
        }

        $(document).ready(function () {
            $("#formDownloadCommercialOffer").submit(function (event) {
                let serviceIdList = getServiceIdList();

                $('.formDownloadCommercialOffer_submit').attr('disabled', true);

                setTimeout(() => {
                  $('.formDownloadCommercialOffer_submit').attr('disabled', false);
                  $('#modalDownloadCommercialOffer').modal('hide');
                  $('#modalSendEmailConfirm').modal('show');
                }, 20000)

                $.ajax({
                    type: 'POST',
                    url: '{{route('services.sendCommercialOffer')}}',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'serviceIdList': serviceIdList,
                        'email': $('#commercialOfferEmail').val(),
                        'phone': $('#commercialOfferPhone').val(),
                        'name': $('#commercialOfferName').val(),
                    },
                    success: function (data) {
                        gtag('event', 'send', {'event_category': 'kp'});
                    }
                });

                event.preventDefault();
            });
            $("#formDownloadRequirement").submit(function (event) {
                let serviceIdList = getServiceIdList();

                $('.formDownloadRequirement_submit').attr('disabled', true);

                $.ajax({
                    type: 'POST',
                    url: '{{route('services.sendServiceRequirement')}}',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'serviceIdList': serviceIdList,
                        'email': $('#serviceRequirementEmail').val(),
                        'phone': $('#serviceRequirementPhone').val(),
                        'name': $('#serviceRequirementName').val(),
                    },
                    success: function (data) {
                        gtag('event', 'send', {'event_category': 'trebovaniya'});
                        $('.formDownloadRequirement_submit').attr('disabled', false);
                        $('#modalDownloadRequirement').modal('hide');
                        $('#modalSendEmailConfirm').modal('show');
                    }
                });

                event.preventDefault();
            });

            $('.orderService').click(function (event) {
                event.preventDefault();

                let serviceStepIdList = getServiceStepIdList();
                let serviceIdList = getServiceIdList();
                window.location = '{{route('Client.services.paymentInfo')}}?serviceList=' + serviceIdList;
            });

            $(document).on('change', '#offerCheck', function () {
                $('.formDownloadRequirement_submit').attr('disabled', !this.checked);
            })

            $(document).on('change', '#offerCheck_commercial_offer', function () {
                $('.formDownloadCommercialOffer_submit').attr('disabled', !this.checked);
            })
        });

    </script>
@endsection
