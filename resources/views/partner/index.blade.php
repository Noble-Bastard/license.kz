@extends('new.layouts.app')

@section('content')
    <div class="partners-network">
        <div class="partners-network__about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-12 pr-0 text-center text-lg-left">
                        <h1 class="partners-network__about__header mb-4">@lang('messages.pages.partners-network.get_special_conditions_from')</h1>
                        <div class="partners-network__about__text">
                            @lang('messages.pages.partners-network.we_know_what_services_you_will_need_along_with_obtaining')
                        </div>
                        <div class="partners-network__about__become-partner">
                            <a href="#become_partner" class="btn btn-success">@lang('messages.layouts.become_partner')</a>
                        </div>
                        <a href="#partnerList" class="btn btn-success partners-network__about__get-special">
                            @lang('messages.pages.partners-network.get_special_conditions')
                        </a>
                    </div>
                    <div class="col-lg-7 col-12">
                        <img class="partners-network__about__case-img "
                             src="{{asset('images/partners-network/case-img.png')}}">
                    </div>
                </div>
            </div>
        </div>

        <div id="partnerList">
            @if(sizeof($partnerList->where('external_partner_category_id', 4)) > 0)
                <div class="partners-network__certification">
                    <div class="container">
                        <div class="partners-network__header">
                            <h1>
                                <b>@lang('messages.pages.partners-network.InformationSystem') </b>
                                <img src="{{asset('images/partners-network/certification-icon.png')}}"/>
                            </h1>
                        </div>
                        <div class="row justify-content-center">
                            @foreach($partnerList->where('external_partner_category_id', 4) as $partner)
                                <div class="col-lg-3 col-12 mb-5 mb-lg-0">
                                    <div class="partners-network__partner text-center pt-1">
                                        <div class="partners-network__partner-main">
                                            <div class="partners-network__partner__img partners-img">
                                                <div>
                                                    <img src="{{\Illuminate\Support\Facades\Storage::url($partner->logo_path)}}"
                                                         alt="{{$partner->name}}"/>
                                                </div>
                                            </div>
                                            <div class="partners-network__partner__text partners-text">
                                                {{$partner->short_info}}
                                            </div>
                                        </div>
                                        <div class="card mx-auto">
                                            <div class="card-body p-0">
                                                <h3 class="card-title">{{$partner->name}}</h3>
                                                <span class="card-text">{!! $partner->offer !!}</span>
                                                <div>
                                                    <button
                                                            class="btn btn-success mx-auto partners-network__details"
                                                            data-id="{{$partner->id}}"
                                                            data-name="{{$partner->name}}"
                                                            data-site="{{$partner->site_url}}"
                                                    >
                                                        @lang('messages.pages.partners-network.details')
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <img class="partners-network__certification__background"
                         src="{{asset('images/about-us_background/background-section-2.png')}}">
                </div>
            @endif
            @if(sizeof($partnerList->where('external_partner_category_id', 1)) > 0)
                <div class="partners-network__medicine">
                    <div class="container">
                        <div class="partners-network__header">
                            <h1>
                                <b>@lang('messages.pages.partners-network.Medicine') </b>
                                <img
                                        src="{{asset('images/partners-network/medicine-icon.png')}}"/>
                            </h1>
                        </div>
                        <div class="row justify-content-center">
                            @foreach($partnerList->where('external_partner_category_id', 1) as $partner)
                                <div class="col-lg-3 col-12 mb-5 mb-lg-0">
                                    <div class="partners-network__partner text-center pt-1">
                                        <div class="partners-network__partner-main">
                                            <div class="partners-network__partner__img partners-img">
                                                <div>
                                                    <img src="{{\Illuminate\Support\Facades\Storage::url($partner->logo_path)}}"
                                                         alt="{{$partner->name}}"/>
                                                </div>
                                            </div>
                                            <div class="partners-network__partner__text partners-text">
                                                {{$partner->short_info}}
                                            </div>
                                        </div>
                                        <div class="card mx-auto">
                                            <div class="card-body p-0">
                                                <h3 class="card-title">{{$partner->name}}</h3>
                                                <span class="card-text">{!! $partner->offer !!}</span>
                                                <div>
                                                    <button
                                                            class="btn btn-success mx-auto partners-network__details"
                                                            data-id="{{$partner->id}}"
                                                            data-name="{{$partner->name}}"
                                                            data-site="{{$partner->site_url}}"
                                                    >
                                                        @lang('messages.pages.partners-network.details')
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <img class="about-us__about-owner__background"
                             src="{{asset('images/about-us_background/background-section-2.png')}}"/>
                    </div>
                </div>
            @endif
            @if(sizeof($partnerList->where('external_partner_category_id', 2)) > 0)
                    <div class="partners-network__leasing">
                        <div class="container">
                            <div class="partners-network__leasing__header"><h1>
                                    <b>@lang('messages.pages.partners-network.industry') </b> <img
                                            src="{{asset('images/partners-network/industry.png')}}"></h1></div>
                            <div class="row justify-content-center">
                                @foreach($partnerList->where('external_partner_category_id', 2) as $partner)
                                    <div class="col-lg-3 col-12 mb-5 mb-lg-0">
                                        <div class="partners-network__partner text-center pt-1">
                                            <div class="partners-network__partner-main">
                                                <div class="partners-network__partner__img partners-img">
                                                    <div>
                                                        <img src="{{\Illuminate\Support\Facades\Storage::url($partner->logo_path)}}"
                                                             alt="{{$partner->name}}"/>
                                                    </div>
                                                </div>
                                                <div class="partners-network__partner__text partners-text">
                                                    {{$partner->short_info}}
                                                </div>
                                            </div>
                                            <div class="card mx-auto">
                                                <div class="card-body p-0">
                                                    <h3 class="card-title">{{$partner->name}}</h3>
                                                    <span class="card-text">{!! $partner->offer !!}</span>
                                                    <div>
                                                        <button
                                                                class="btn btn-success mx-auto partners-network__details"
                                                                data-id="{{$partner->id}}"
                                                                data-name="{{$partner->name}}"
                                                                data-site="{{$partner->site_url}}"
                                                        >
                                                            @lang('messages.pages.partners-network.details')
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @if(sizeof($partnerList->where('external_partner_category_id', 3)) > 0)
                    <div class="partners-network__leasing">
                        <div class="container">
                            <div class="partners-network__leasing__header"><h1>
                                    <b>@lang('messages.pages.partners-network.bankruptcy_procedure') </b> <img
                                            src="{{asset('images/partners-network/leasing-icon.png')}}"></h1></div>
                            <div class="row justify-content-center">
                                @foreach($partnerList->where('external_partner_category_id', 3) as $partner)
                                    <div class="col-lg-3 col-12 mb-5 mb-lg-0">
                                        <div class="partners-network__partner text-center pt-1">
                                            <div class="partners-network__partner-main">
                                                <div class="partners-network__partner__img partners-img">
                                                    <div>
                                                        <img src="{{\Illuminate\Support\Facades\Storage::url($partner->logo_path)}}"
                                                             alt="{{$partner->name}}"/>
                                                    </div>
                                                </div>
                                                <div class="partners-network__partner__text partners-text">
                                                    {{$partner->short_info}}
                                                </div>
                                            </div>
                                            <div class="card mx-auto">
                                                <div class="card-body p-0">
                                                    <h3 class="card-title">{{$partner->name}}</h3>
                                                    <span class="card-text">{!! $partner->offer !!}</span>
                                                    <div>
                                                        <button
                                                                class="btn btn-success mx-auto partners-network__details"
                                                                data-id="{{$partner->id}}"
                                                                data-name="{{$partner->name}}"
                                                                data-site="{{$partner->site_url}}"
                                                        >
                                                            @lang('messages.pages.partners-network.details')
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
            @endif
            @if(sizeof($partnerList->where('external_partner_category_id', 5)) > 0)
                    <div class="partners-network__leasing">
                        <div class="container">
                            <div class="partners-network__leasing__header"><h1>
                                    <b>@lang('messages.pages.partners-network.geological_exploration') </b> <img
                                            src="{{asset('images/partners-network/industry.png')}}"></h1></div>
                            <div class="row justify-content-center">
                                @foreach($partnerList->where('external_partner_category_id', 5) as $partner)
                                    <div class="col-lg-3 col-12 mb-5 mb-lg-0">
                                        <div class="partners-network__partner text-center pt-1">
                                            <div class="partners-network__partner-main">
                                                <div class="partners-network__partner__img partners-img">
                                                    <div>
                                                        <img src="{{\Illuminate\Support\Facades\Storage::url($partner->logo_path)}}"
                                                             alt="{{$partner->name}}"/>
                                                    </div>
                                                </div>
                                                <div class="partners-network__partner__text partners-text">
                                                    {{$partner->short_info}}
                                                </div>
                                            </div>
                                            <div class="card mx-auto">
                                                <div class="card-body p-0">
                                                    <h3 class="card-title">{{$partner->name}}</h3>
                                                    <span class="card-text">{!! $partner->offer !!}</span>
                                                    <div>
                                                        <button
                                                                class="btn btn-success mx-auto partners-network__details"
                                                                data-id="{{$partner->id}}"
                                                                data-name="{{$partner->name}}"
                                                                data-site="{{$partner->site_url}}"
                                                        >
                                                            @lang('messages.pages.partners-network.details')
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
            @endif
        </div>

        <div class="partners-network__near-footer">
            <div class="container text-center">
                <div class="partners-network__near-footer__container z-index-primary" id="become_partner">
                    <div class="partners-network__near-footer__container__header ">
                        <h1><b>@lang('messages.pages.partners-network.want_to_become_partner')</b></h1>

                    </div>
                    <div class="partners-network__near-footer__container__join">
                        <div class="partners-network__near-footer__container__join__text ">
                            @lang('messages.pages.partners-network.enter_information_about_your_company_and_we_will_contact_you')
                        </div>

                        <div class="text-center ">
                            <button class="btn btn-success about-us__near-footer__container__join__button become_partner"
                            >@lang('messages.layouts.become_partner')
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="partners-network__near-footer__background">
                <img class=""
                     src="{{asset('images/about-us_background/bg-near-footer.png')}}">
            </div>
        </div>
    </div>
    <div class="modal partners-network__details-modal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                  <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>

    <div class="modal become_partner-modal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('messages.layouts.become_partner')</h5>
                  <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => route('becomePartner'), 'method' => 'post', 'class' => 'col-12 becomePartner']) !!}
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="partnerName">@lang('messages.becomePartner.name')</label>
                                <input class="form-control" id="partnerName" name="name" type="text" required/>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="partnerCompanyName">@lang('messages.becomePartner.companyName')</label>
                                <input class="form-control" id="partnerCompanyName" name="companyName" type="text" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="bin">@lang('messages.becomePartner.bin')</label>
                                <input class="form-control" id="bin" name="bin" type="number" required/>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="partnerName">@lang('messages.becomePartner.phone')</label>
                                <input class="form-control" id="phone" name="phone" placeholder="+7 (xxx) xxx xx xx" type="tel" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="email">@lang('messages.becomePartner.email')</label>
                                <input class="form-control" id="email" name="email" type="email" required/>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="services">@lang('messages.becomePartner.services')</label>
                                <input class="form-control" id="services" name="services" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-9">
                            <div class="form-check pl-0">
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
                        <div class="col-3">
                            <div class="form-group text-end">
                                <button class="btn btn-success becomePartner_submit"
                                        type="submit">@lang('messages.all.send')</button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.partners-network__details').on('click', function () {
                let self = this
                $.ajax({
                    type: 'GET',
                    url: 'partner/info/' + $(self).data('id'),
                    success: function (data) {
                        let modal = $('.partners-network__details-modal')

                        $('.modal-title', modal).html($(self).data('name'))
                        $('.modal-body', modal).html(data)
                        $(modal).modal('show')
                    }
                })
            })

            $('.become_partner').on('click', function () {
                let modal = $('.become_partner-modal')
                $(modal).modal('show')
            })

            $('.becomePartner').submit(function () {
                $(this).ajaxSubmit({
                    success: function () {
                        alert("@lang('messages.client.service_create')")
                        $('.become_partner-modal').modal('hide')
                    }
                })

                return false
            })


            $(document).on('change', '#offerCheck', function () {
                $('.becomePartner_submit').attr('disabled', !this.checked);
            })
        })
    </script>
@endsection
