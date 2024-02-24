@extends('new.layouts.app')

{{--@section('header__background')--}}
{{--    <div class="header__background header__background-{{$serviceCategory->id}}"></div>--}}
{{--@endsection--}}
{{--@section('footer__background')footer__background-{{$serviceCategory->id}}@endsection--}}

@section('content')

    <div class="payment-info">
        <div class="payment-info__your-order">
            <div class="container">
                <h1 class="payment-info__your-order__header">@lang('messages.pages.payment-info.your_order'):</h1>
                <div class="row">
                    <div class="col-12 col-md-8">
                        @foreach($serviceList as $service)
                            <input name="serviceId[]" type="hidden" value="{{$service->id}}"/>
                        @endforeach
                        <h6 class="payment-info__your-order__section-header section-header">{{$license->name}}</h6>
                        <div class="payment-info__your-order__section payment-section">
                            <div class="payment-info__your-order__section__info">
                                <div class="mb-3"><b>@lang('messages.pages.services.processing_time'):</b><span
                                            class="pl-3 secondary-txt">{{$serviceTotals->executionWorkDayTotal}}
                                        {{ \App\Data\Helper\Assistant::num2word($serviceTotals->executionWorkDayTotal,  trans('messages.services.one_work_day'),  trans('messages.services.two_work_days'),  trans('messages.services.work_days') )}}</span>
                                </div>
                                <div class="mb-3"><b>@lang('messages.services.cost_of_service'):</b><span
                                            class="pl-3 secondary-txt">{{number_format($serviceTotals->stepCostTotal, 0, ',', ' ')}} {{$serviceTotals->currency->name}}</span>
                                </div>
                                <div class="mb-3"><b>@lang('messages.pages.payment-info.first_payment'):</b><span
                                            class="pl-3 secondary-txt">{{number_format($serviceTotals->stepCostTotal*0.6, 0, ',', ' ')}} {{$serviceTotals->currency->name}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-none d-md-block payment-info__your-order__section payment-section mt-4">
                            <div class="payment-info__your-order__section__contact-form ">
{{--                                <div class="payment-info__your-order__section__contact-form__header mb-4">@lang('messages.pages.payment-info.contact_details')</div>--}}

{{--                                    <input type="text"--}}
{{--                                           class="payment-info__your-order__section__contact-form__input mb-2"--}}
{{--                                           placeholder="@lang('messages.admin.employee.first_name')">--}}
{{--                                    <input type="text" class="payment-info__your-order__section__contact-form__input"--}}
{{--                                           placeholder="@lang('messages.admin.employee.phone')">--}}
{{--                                    <input type="text" class="payment-info__your-order__section__contact-form__input"--}}
{{--                                           placeholder="@lang('messages.admin.employee.email')">--}}
                                    <button class="btn btn-success mt-4 pl-5 pr-5 continueButton">@lang('messages.pages.payment-info.continue')</button>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <h6 class="payment-info__your-order__section-header section-header mt-3 mt-md-0">@lang('messages.all.cost')</h6>
                        <div class="payment-info__your-order__section price-section">
                            <span class="payment-info__your-order__section__total-price">{{number_format($serviceTotals->stepCostTotal, 0, ',', ' ')}} {{$serviceTotals->currency->name}}</span>
                            <hr>
                            <div class="payment-info__your-order__section__price-detail">
                                <div class="mb-3 payment-info__your-order__section__price-detail__header">@lang('messages.pages.payment-info.order_list')
                                    :
                                </div>
                                <div class="row">
                                    <div class="col-7 secondary-txt text-left mb-3">@lang('messages.pages.payment-info.license_registration_service')</div>
                                    <div class="col-5 secondary-txt text-end">
                                        <b>{{number_format($serviceTotals->stepCostTotal, 0, ',', ' ')}} {{$serviceTotals->currency->name}}</b>
                                    </div>
                                    {{--                                    <div class="col-7 secondary-txt text-left mb-3">Бухгалтерский аутсорсинг</div>--}}
                                    {{--                                    <div class="col-5 secondary-txt text-end"><b>35 000 KZT</b></div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-md-none">
                        <div class="payment-info__your-order__section payment-section mt-4">
                        <div class="payment-info__your-order__section__contact-form ">
                            {{--                                <div class="payment-info__your-order__section__contact-form__header mb-4">@lang('messages.pages.payment-info.contact_details')</div>--}}

                                {{--                                    <input type="text"--}}
                                {{--                                           class="payment-info__your-order__section__contact-form__input mb-2"--}}
                                {{--                                           placeholder="@lang('messages.admin.employee.first_name')">--}}
                                {{--                                    <input type="text" class="payment-info__your-order__section__contact-form__input"--}}
                                {{--                                           placeholder="@lang('messages.admin.employee.phone')">--}}
                                {{--                                    <input type="text" class="payment-info__your-order__section__contact-form__input"--}}
                                {{--                                           placeholder="@lang('messages.admin.employee.email')">--}}
                                <button class="btn btn-success mt-4 pl-5 pr-5 continueButton">@lang('messages.pages.payment-info.continue')</button>

                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            {{--            <div class="row">--}}

            {{--                <div class="payment-info__additional-services col-8 ">--}}
            {{--                    <div class="payment-info__your-order__section-header section-header secondary-txt">@lang('messages.pages.payment-info.select_additional_services')</div>--}}
            {{--                    <div class="payment-info__additional-services__section payment-section mb-3">--}}
            {{--                        <div class="payment-info__additional-services__section__header">Бухгалтерский аутсорсинг</div>--}}
            {{--                        <div class="payment-info__additional-services__section__text col-md-10 col-12 pl-0 pr-0">--}}
            {{--                            Описание--}}
            {{--                            услуги,--}}
            {{--                            для чего она нужна и какие преимущества 2-3 строки с описанием--}}
            {{--                            Garumna flumen, a Belgis Matrona et Sequana dividit. Horum omnium fortissimi sunt Belgae--}}
            {{--                        </div>--}}
            {{--                        <a class="payment-info__additional-services__section__link text-primary"--}}
            {{--                           href="#">@lang('messages.pages.partners-network.details') →</a>--}}
            {{--                        <div class="payment-info__additional-services__section__service-price">@lang('messages.pages.services.service_cost')--}}
            {{--                            : <span class="text-primary pl-3"><b>1 325 500 тг</b></span></div>--}}
            {{--                        <div class="text-end">--}}
            {{--                            <button class="ml-auto btn-success btn">@lang('messages.pages.payment-info.add_service')</button>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                    <div class="payment-info__additional-services__section payment-section mb-3">--}}
            {{--                        <div class="payment-info__additional-services__section__header">Бухгалтерский аутсорсинг</div>--}}
            {{--                        <div class="payment-info__additional-services__section__text col-md-10 col-12 pl-0 pr-0">--}}
            {{--                            Описание--}}
            {{--                            услуги,--}}
            {{--                            для чего она нужна и какие преимущества 2-3 строки с описанием--}}
            {{--                            Garumna flumen, a Belgis Matrona et Sequana dividit. Horum omnium fortissimi sunt Belgae--}}
            {{--                        </div>--}}
            {{--                        <a class="payment-info__additional-services__section__link text-primary"--}}
            {{--                           href="#">@lang('messages.pages.partners-network.details') →</a>--}}
            {{--                        <div class="payment-info__additional-services__section__service-price">@lang('messages.pages.services.service_cost')--}}
            {{--                            : <span class="text-primary pl-3"><b>1 325 500 тг</b></span></div>--}}
            {{--                        <div class="text-end">--}}
            {{--                            <button class="ml-auto btn-success btn">@lang('messages.pages.payment-info.add_service')</button>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                    <div class="payment-info__additional-services__section payment-section mb-3">--}}
            {{--                        <div class="payment-info__additional-services__section__header">Бухгалтерский аутсорсинг</div>--}}
            {{--                        <div class="payment-info__additional-services__section__text col-md-10 col-12 pl-0 pr-0">--}}
            {{--                            Описание--}}
            {{--                            услуги,--}}
            {{--                            для чего она нужна и какие преимущества 2-3 строки с описанием--}}
            {{--                            Garumna flumen, a Belgis Matrona et Sequana dividit. Horum omnium fortissimi sunt Belgae--}}
            {{--                        </div>--}}
            {{--                        <a class="payment-info__additional-services__section__link text-primary"--}}
            {{--                           href="#">@lang('messages.pages.partners-network.details') →</a>--}}
            {{--                        <div class="payment-info__additional-services__section__service-price">@lang('messages.pages.services.service_cost')--}}
            {{--                            : <span class="text-primary pl-3"><b>1 325 500 тг</b></span></div>--}}
            {{--                        <div class="text-end">--}}
            {{--                            <button class="ml-auto btn-success btn">@lang('messages.pages.payment-info.add_service')</button>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                    <div class="text-end"><a href="#"> @lang('messages.pages.payment-info.show_more_services') →</a>--}}
            {{--                    </div>--}}

            {{--                </div>--}}

            {{--            </div>--}}
            {{--            <button class="btn btn-success ml-4 pl-5 pr-5">@lang('messages.pages.payment-info.continue')</button>--}}



        </div>

    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function () {

            function getServiceIdList() {
                let serviceIdList = [];
                $('input[name="serviceId[]"]').each(function () {
                    serviceIdList.push($(this)[0].value)
                });
                return serviceIdList;
            }

            $('.continueButton').click(function () {
                event.preventDefault();

                let serviceIdList = getServiceIdList();
                window.location = '{{route('Client.services.setPaymentType')}}?serviceList=' + serviceIdList;
            });
        });
    </script>
@endsection
