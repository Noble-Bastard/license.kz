@extends('new.layouts.app')
@section('content')
<div class="reviews">

    @include('new.partials.page.review')

    <!-- Certificates -->
    <nav class="hide-mobile-dark">

        <div class="container">
            <div class="col-12">
                <div class="col-9">
                    <p class="reviews__window_title">Все наши сотрудники - профессионалы!
                        Мы собрали все их сертификаты в одном месте</p>
                </div>
            </div>
        </div>

        <div class="col-12 reviews__carousel">
            <div class="container">

                <div id="carouselCertificates" class="carousel slide show-certificates pointer-event col-12" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">

                            <div class="row justify-content-center">
                                @for($i = 0; $i < 10; $i++)
                                    <div class="reviews__list_cards">
                                        <div class="card">
                                            <img src="{{asset("/new/images/icons/certificate.png")}}" class="reviews__partner_cards-photo">
                                        </div>
                                    </div>
                                @endfor
                            </div>

                        </div>

                        <div class="carousel-item">

                            <div class="row justify-content-center">
                                @for($i = 0; $i < 10; $i++)
                                    <div class="reviews__list_cards">
                                        <div class="card">
                                            <img src="{{asset("/new/images/icons/certificate.png")}}" class="reviews__partner_cards-photo">
                                        </div>
                                    </div>
                                @endfor
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-12 main__reviews_carousel_arrows">
                    <div class="row">
                        <div class="col-auto">
                            <a type="button" data-bs-target="#carouselCertificates" data-bs-slide="prev">
                                <i class="bi bi-arrow-left main__reviews_carousel_arrows-design"></i>
                            </a>
                        </div>

                        <div class="col-auto">
                            <a type="button" data-bs-target="#carouselCertificates" data-bs-slide="next">
                                <i class="bi bi-arrow-right main__reviews_carousel_arrows-design"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </nav>

    <!-- Carousel Mobile -->
    <nav class="show-mobile-dark">

        <div class="container">
            <div class="col-12">
                <div class="col-10">
                    <p class="reviews__window_title_mini">Все наши сотрудники - <span class="reviews__window_title_span">профессионалы!</span>
                        Мы собрали все их сертификаты в одном месте</p>
                </div>
            </div>
        </div>

        <div class="col-12 reviews__carousel_mini justify-content-center">
            <div id="carouselCertificatesMini" class="carousel slide show-certificates pointer-event col-12" data-bs-ride="carousel">

                <div class="carousel-inner">

                    <div class="carousel-item active">

                        <div class="item_certificates">

                            <div class="carousel-certificate-element">

                                    <div class="row justify-content-center">
                                        @for($i = 0; $i < 4; $i++)
                                            <div class="reviews__list_cards">
                                                <div class="card">
                                                    <img src="{{asset("/new/images/icons/certificate.png")}}" class="reviews__partner_cards-photo">
                                                </div>
                                            </div>
                                        @endfor
                                    </div>

                                    <div class="row justify-content-center">
                                        @for($i = 0; $i < 4; $i++)
                                            <div class="reviews__list_cards">
                                                <div class="card">
                                                    <img src="{{asset("/new/images/icons/certificate.png")}}" class="reviews__partner_cards-photo">
                                                </div>
                                            </div>
                                        @endfor
                                    </div>

                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">

                        <div class="item_certificates">

                            <div class="carousel-certificate-element">

                                <div class="row justify-content-center">
                                    @for($i = 0; $i < 4; $i++)
                                        <div class="reviews__list_cards">
                                            <div class="card">
                                                <img src="{{asset("/new/images/icons/certificate.png")}}" class="reviews__partner_cards-photo">
                                            </div>
                                        </div>
                                    @endfor
                                </div>

                                <div class="row justify-content-center">
                                    @for($i = 0; $i < 4; $i++)
                                        <div class="reviews__list_cards">
                                            <div class="card">
                                                <img src="{{asset("/new/images/icons/certificate.png")}}" class="reviews__partner_cards-photo">
                                            </div>
                                        </div>
                                    @endfor
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 reviews__certificates_carousel_arrows">
            <div class="container">
                <div class="row">
                    <div class="col-auto">
                        <a type="button" data-bs-target="#carouselCertificatesMini" data-bs-slide="prev">
                            <i class="bi bi-arrow-left reviews__certificates_carousel_arrows-design"></i>
                        </a>
                    </div>

                    <div class="col-auto">
                        <a type="button" data-bs-target="#carouselCertificatesMini" data-bs-slide="next">
                            <i class="bi bi-arrow-right reviews__certificates_carousel_arrows-design"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>


</div>
@endsection
