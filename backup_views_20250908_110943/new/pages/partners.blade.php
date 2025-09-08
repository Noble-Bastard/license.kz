@extends('new.layouts.app')
@section('content')
    <div class="partners">

        <nav class="hide-mobile-dark">
            <div class="col-12 text-center partners__conditions_layout">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="partners__conditions_window">

                            <div class="col-12 partners__conditions_content">
                                <div class="row">

                                    <div class="col-8 text-start">
                                        <!-- head -->
                                        <div class="col-11 partners__conditions_title">
                                            <p class="partners__conditions_title-head"> Специальные условия от партнеров
                                                <span class="partners__conditions_title-span">UPPERLICENSE</span>
                                            </p>
                                        </div>
                                        <!-- description -->
                                        <div class="col-9 text-start">
                                            <p class="partners__conditions_title-description">
                                                Мы знаем, какие услуги вам понадобятся вместе с получением лицензии,
                                                и уже договорились, чтобы вы получили на них лучшие условия
                                            </p>
                                        </div>
                                        <!-- buttons -->
                                        <div class="col-auto partners__buttons_layout">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <a type="button" href="#partners__list_window"
                                                       class="btn btn-success partners__conditions_button">
                                                        @lang('messages.pages.partners-network.get_special_conditions')
                                                    </a>
                                                </div>

                                                <div class="col-auto">
                                                    <button type="button"
                                                            class="btn btn-outline-success partners__conditions_button-second"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#becomePartnerModal"
                                                            aria-expanded="false">
                                                        @lang('messages.layouts.become_partner')
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- cards -->
                                    <div class="col-4 partners__cards">

                                        <div class="row">
                                            @foreach($partnerList->chunk(4) as $partnerListChunk)
                                                @if($loop->index < 2)
                                                    @php
                                                        $partnerListChunkIndex = $loop->index;
                                                    @endphp
                                                    <div class="col-6">
                                                        <div class="partners__cards_left">
                                                            @foreach($partnerListChunk as $partner)
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <img src="{{\Illuminate\Support\Facades\Storage::url($partner->logo_path)}}"
                                                                             class="main__partner_cards-photo_par card-img-overlay">
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Cards mini -->
        <nav class="show-mobile-dark">
            <div class="col-12">
                <div class="container">

                    <div class="row justify-content-center">
                        <div class="col-12 partners__conditions_window_mini">

                            <div class="row">

                                <div class="col-12 text-start">
                                    <!-- head -->
                                    <div class="col-sm-11 col-10 partners__conditions_title">
                                        <p class="partners__conditions_title-head"> Специальные условия от партнеров
                                            <span class="partners__conditions_title-span">UPPERLICENSE</span>
                                        </p>
                                    </div>
                                    <!-- description -->
                                    <div class="col-sm-11 col-10 text-start">
                                        <p class="partners__conditions_title-description">
                                            Наши партнеры предоставляют специальные условия для наших клиентов
                                        </p>
                                    </div>
                                </div>

                                <!-- cards -->
                                <div class="col-12 partners__cards_mini">

                                    <div class="row justify-content-center">
                                        @foreach($partnerList->chunk(3) as $partnerListChunk)
                                            @if($loop->index < 2)
                                                @php
                                                    $partnerListChunkIndex = $loop->index;
                                                @endphp
                                                <div class="col-sm-4 col-5">
                                                    <div class="partners__cards_left_mini">
                                                        @foreach($partnerListChunk as $partner)
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <img src="{{\Illuminate\Support\Facades\Storage::url($partner->logo_path)}}"
                                                                         class="main__partner_cards-photo_par card-img-overlay">
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                                <!-- buttons -->
                                <div class="col-12 partners__buttons_layout">
                                    <div class="row justify-content-center">
                                        <div class="col-md-auto col-sm-8 col-12 partners__buttons_mini">
                                            <a type="button" href="#partners__list_window"
                                               class="btn btn-success partners__conditions_button_mini">
                                                @lang('messages.pages.partners-network.get_special_conditions')
                                            </a>
                                        </div>

                                        <div class="col-md-auto col-sm-8 col-12">
                                            <button type="button"
                                               class="btn btn-outline-success partners__conditions_button_mini_outline"
                                               data-bs-toggle="modal"
                                               data-bs-target="#becomePartnerModal"
                                               aria-expanded="false">
                                                @lang('messages.layouts.become_partner')
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div id="partners__list_window"></div>
        <nav class="hide-mobile-dark1">
            <div class="col-12 partners__list_layout">
                <div class="container">

                    <div class="col-12">
                        <p class="partners__list_window_title-head">Наши партнеры</p>
                    </div>

                    <div class="col-12 partners__list_window">
                        <div class="container justify-content-center">

                            <!-- cards -->
                            @foreach($partnerList as $partner)
                                <div class="partners__list_cards">
                                    <div class="card">
                                        <div class="card-body">

                                            <a href="{{$partner->site_url}}" target="_blank">
                                                <img src="{{\Illuminate\Support\Facades\Storage::url($partner->logo_path)}}"
                                                     alt="{{$partner->name}}" class="main__partner_cards-photo_par"/>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </nav>

        <nav class="show-mobile-dark d-none">
            <div class="col-12 partners__list_layout">
                <div class="container">

                    <div class="col-sm-8 col-11">
                        <p class="partners__list_window_title-head_mini">Специальные условия на услуги <span
                                    class="partners__list_window_title-span_mini"> наших партнеров</span></p>
                    </div>

                    <div class="col-12 partners__list_window">
                        <div class="container justify-content-center">

                            <!-- cards -->
                            @for($i = 0; $i < 10; $i++)
                                <div class="partners__list_cards">
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="{{asset("/new/images/icons/partnerIcon.png")}}"
                                                 class="main__partner_cards-photo_par">
                                        </div>
                                    </div>
                                </div>
                            @endfor

                        </div>
                    </div>

                </div>
            </div>
        </nav>

        <!-- Reviews -->
        @include('new.partials.page.review', ['showAllReviewsBtn' => true])

        <div class="modals">
            <div class="modal fade" id="becomePartnerModal" tabindex="-1" aria-labelledby="becomePartnerModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="col-12">
                                <div class="row justify-content-end">
                                    <div class="col-lg-1 col-auto text-start">
                                        <button type="button" class="btn btn-x" data-bs-dismiss="modal"
                                                aria-label="Close"><i
                                                    class="bi bi-x-circle modals__icon"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="modal-body">
                                <p class="modals__title-head">@lang('messages.layouts.become_partner')</p>
                                {!! Form::open(['url' => route('becomePartner'), 'method' => 'post', 'class' => 'col-12 becomePartner']) !!}
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <input class="form-control modals__input" id="partnerName" name="name"
                                               type="text" placeholder="@lang('messages.becomePartner.name')" required/>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input class="form-control modals__input" id="partnerCompanyName"
                                               name="companyName" type="text"
                                               placeholder="@lang('messages.becomePartner.companyName')" required/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <input class="form-control modals__input" id="bin" name="bin" type="number"
                                               placeholder="@lang('messages.becomePartner.bin')" required/>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input class="form-control modals__input" id="phone" name="phone"
                                               placeholder="@lang('messages.becomePartner.phone')" type="tel" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <input class="form-control modals__input" id="email" name="email" type="email"
                                               placeholder="@lang('messages.becomePartner.email')" required/>

                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input class="form-control modals__input" id="services" name="services"
                                               type="text" placeholder="@lang('messages.becomePartner.services')">
                                    </div>
                                </div>
                                <button type="submit"
                                        class="btn btn-success modals__success_btn">@lang('messages.all.send')</button>
                                <p class="modals__title-description">Нажимая кнопку отправить вы даете разрешение на <a
                                            href="{{route("offer")}}" target="_blank">обработку
                                        персональных данных</a></p>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
