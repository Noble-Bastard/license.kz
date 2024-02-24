@extends('new.layouts.app')

@section('title')
    @lang('messages.pages.about.feedback_from_those') @lang('messages.pages.about.who_have_already_received_a_license_with_the') UpperLicense
@endsection

@section('content')
    <div class="home">
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
                                @foreach($reviewList->where('review_type_id', \App\Data\Helper\ReviewTypeList::Video)->all() as $review)
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
                                @foreach($reviewList->where('review_type_id', \App\Data\Helper\ReviewTypeList::Video)->all() as $review)
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
        @if(count($reviewList->where('review_type_id', \App\Data\Helper\ReviewTypeList::Paper)->all()) > 0)
            <div class="container px-0 px-md-2 py-3">
                <div class="col-12 col-md-10 px-0 px-md-2">
                    <div class="row">
                        @foreach($reviewList->where('review_type_id', \App\Data\Helper\ReviewTypeList::Paper)->all() as $review)
                            <div class="col-12 col-md-3 mb-3">
                                <div class="card">
                                    <div class="card-img">
                                        <a href="{{Storage::url($review->file_path)}}" target="_blank">
                                            <img
                                                    class="img-fluid"
                                                    src="{{Storage::url($review->file_path)}}"
                                                    alt="{{$review->company_name}}"
                                                    title="{{$review->company_name}}"
                                            />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
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

        $(document).keyup(function (e) {
            if (e.keyCode === 27) {
                close_video();
            }
        });

        setTimeout(setPreviewSize, 100);


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