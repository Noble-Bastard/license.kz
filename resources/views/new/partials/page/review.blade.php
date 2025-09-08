{{--<!-- reviews -->--}}
{{--<div class="col-12 main__reviews_window_layout">--}}

{{--    <div class="container">--}}

{{--        <div class="col-12">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-8 col-12">--}}
{{--                    <p class="main__reviews_title-head">--}}
{{--                        Отзывы тех, кто уже получил лицензию с--}}
{{--                        <span class="main__reviews_title-span">upperlicense</span>--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}

{{--    <nav class="hide-mobile-dark">--}}


{{--        <div class="col-12 text-center main__reviews_carousel_big">--}}
{{--            <div class="container">--}}

{{--                <div id="carouselReviewControl" class="carousel slide" data-bs-ride="carousel">--}}
{{--                    <div class="carousel-inner">--}}

{{--                        <!-- first element for carousel -->--}}
{{--                        @foreach($reviewList->where('review_type_id', \App\Data\Helper\ReviewTypeList::Video)->chunk(3) as $reviewChunk)--}}

{{--                        <div class="carousel-item @if($loop->index == 0) active @endif">--}}

{{--                            <div class="row">--}}

{{--                                @if(sizeof($reviewChunk) > 0)--}}
{{--                                <div class="col-8 main__reviews_photo">--}}
{{--                                    <img src="{{$reviewChunk[$loop->index*3]->youtube_preview}}"--}}
{{--                                         class="main__reviews_photo-main">--}}
{{--                                    <a target="_blank" href="{{$reviewChunk[$loop->index*3]->youtube_url}}"><img--}}
{{--                                                src="{{asset('/new/images/icons/arrowIcon.png')}}"--}}
{{--                                                class="main__reviews_photo-play"/></a>--}}
{{--                                </div>--}}
{{--                                @endif--}}
{{--                                <div class="col-4">--}}
{{--                                    @if(sizeof($reviewChunk) > 1)--}}
{{--                                    <div class="col-12 main__reviews_layout_1">--}}
{{--                                        <a target="_blank" href="{{$reviewChunk[$loop->index*3 + 1]->youtube_url}}">--}}
{{--                                            <img src="{{$reviewChunk[$loop->index*3 + 1]->youtube_preview}}"--}}
{{--                                                 class="main__reviews_photo-mini">--}}
{{--                                            <div class="col-12 main__reviews_title-description-head_layout_1">--}}
{{--                                                <p class="main__reviews_title-description-head_1">--}}
{{--                                                    {{$reviewChunk[$loop->index*3 + 1]->company_name}}--}}
{{--                                                </p>--}}
{{--                                                <p class="main__reviews_title-description-body_1">--}}
{{--                                                    {{$reviewChunk[$loop->index*3 + 1]->company_description}}</p>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                    @endif--}}
{{--                                    @if(sizeof($reviewChunk) > 2)--}}
{{--                                    <div class="col-12 main__reviews_layout_2">--}}
{{--                                        <a target="_blank" href="{{$reviewChunk[$loop->index*3 + 2]->youtube_url}}">--}}
{{--                                            <img src="{{$reviewChunk[$loop->index*3 + 2]->youtube_preview}}"--}}
{{--                                                 class="main__reviews_photo-mini">--}}
{{--                                            <div class="col-12 main__reviews_title-description-head_layout_2">--}}
{{--                                                <p class="main__reviews_title-description-head_2">--}}
{{--                                                    {{$reviewChunk[$loop->index*3 + 2]->company_name}}--}}
{{--                                                </p>--}}
{{--                                                <p class="main__reviews_title-description-body_2">--}}
{{--                                                    {{$reviewChunk[$loop->index*3 + 2]->company_description}}--}}
{{--                                                </p>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!-- Arrows for carousel -->--}}
{{--                <div class="col-12 main__reviews_carousel_arrows">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-auto">--}}
{{--                            <a type="button" data-bs-target="#carouselReviewControl" data-bs-slide="prev">--}}
{{--                                <i class="bi bi-arrow-left main__partners_carousel_arrows-design"></i>--}}
{{--                            </a>--}}
{{--                        </div>--}}

{{--                        <div class="col-auto">--}}
{{--                            <a type="button" data-bs-target="#carouselReviewControl" data-bs-slide="next">--}}
{{--                                <i class="bi bi-arrow-right main__partners_carousel_arrows-design"></i>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </nav>--}}

{{--    <!-- Reviews mobile -->--}}
{{--    <nav class="show-mobile-dark">--}}

{{--        <nav class="show-mobile-service">--}}

{{--            <div class="col-12 text-center justify-content-center main__reviews_carousel">--}}
{{--                <div id="carouselReviewsMini" class="carousel slide show-reviews pointer-event col-12"--}}
{{--                     data-bs-ride="carousel">--}}

{{--                    <div class="carousel-inner">--}}



{{--                        <div class="carousel-item active">--}}

{{--                            <div class="item_reviews">--}}

{{--                                <div class="carousel-reviews-element">--}}

{{--                                    <div class="row">--}}

{{--                                        <div class="col-4 main__news_window_news-content">--}}
{{--                                            <div class="col-12 main__reviews_size">--}}
{{--                                                <a target="_blank" href="{{$reviewList[2]->youtube_url}}">--}}
{{--                                                    <img src="{{$reviewList[2]->youtube_preview}}"--}}
{{--                                                         class="main__reviews_photo-mini">--}}
{{--                                                    <div class="col-12 main__reviews_title-description-layout_mini_1">--}}
{{--                                                        <p class="main__reviews_title-description-head_1_mini">--}}
{{--                                                            {{$reviewList[2]->company_name}}--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-12 main__reviews_title-description-layout_mini_2">--}}
{{--                                                        <p class="main__reviews_title-description-body_1_mini">--}}
{{--                                                            {{$reviewList[2]->company_description}}--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-4 main__news_window_news-content">--}}
{{--                                            <div class="col-12 main__reviews_photo">--}}
{{--                                                <img src="{{$reviewList[0]->youtube_preview}}"--}}
{{--                                                     class="main__reviews_photo-main">--}}
{{--                                                <div class="main__reviews_photo-play_mini">--}}
{{--                                                    <a href="{{$reviewList[0]->youtube_url}}"><img--}}
{{--                                                                src="{{asset('/new/images/icons/arrowIcon.png')}}"--}}
{{--                                                                class="main__reviews_photo-play_mini_icon"/></a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-4 main__news_window_news-content">--}}
{{--                                            <div class="col-12 main__reviews_size">--}}
{{--                                                <a target="_blank" href="{{$reviewList[1]->youtube_url}}">--}}
{{--                                                    <img src="{{$reviewList[1]->youtube_preview}}"--}}
{{--                                                         class="main__reviews_photo-mini">--}}
{{--                                                    <div class="col-12 main__reviews_title-description-layout_mini_1">--}}
{{--                                                        <p class="main__reviews_title-description-head_1_mini">--}}
{{--                                                            {{$reviewList[1]->company_name}}--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-12 main__reviews_title-description-layout_mini_2">--}}
{{--                                                        <p class="main__reviews_title-description-body_1_mini">--}}
{{--                                                            {{$reviewList[1]->company_description}}--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div> <!-- Carousel item -->--}}

{{--                        <div class="carousel-item">--}}

{{--                            <div class="item_reviews">--}}

{{--                                <div class="carousel-reviews-element">--}}

{{--                                    <div class="row">--}}

{{--                                        <div class="col-4 main__news_window_news-content">--}}
{{--                                            <div class="col-12 main__reviews_photo">--}}
{{--                                                <img src="{{$reviewList[0]->youtube_preview}}"--}}
{{--                                                     class="main__reviews_photo-main">--}}
{{--                                                <div class="main__reviews_photo-play_mini">--}}
{{--                                                    <a href="{{$reviewList[0]->youtube_url}}"><img--}}
{{--                                                                src="{{asset('/new/images/icons/arrowIcon.png')}}"--}}
{{--                                                                class="main__reviews_photo-play_mini_icon"/></a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-4 main__news_window_news-content">--}}
{{--                                            <div class="col-12 main__reviews_size">--}}
{{--                                                <a target="_blank" href="{{$reviewList[1]->youtube_url}}">--}}
{{--                                                    <img src="{{$reviewList[1]->youtube_preview}}"--}}
{{--                                                         class="main__reviews_photo-mini">--}}
{{--                                                    <div class="col-12 main__reviews_title-description-layout_mini_1">--}}
{{--                                                        <p class="main__reviews_title-description-head_1_mini">--}}
{{--                                                            {{$reviewList[1]->company_name}}--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-12 main__reviews_title-description-layout_mini_2">--}}
{{--                                                        <p class="main__reviews_title-description-body_1_mini">--}}
{{--                                                            {{$reviewList[1]->company_description}}--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-4 main__news_window_news-content">--}}
{{--                                            <div class="col-12 main__reviews_size">--}}
{{--                                                <a target="_blank" href="{{$reviewList[2]->youtube_url}}">--}}
{{--                                                    <img src="{{$reviewList[2]->youtube_preview}}"--}}
{{--                                                         class="main__reviews_photo-mini">--}}
{{--                                                    <div class="col-12 main__reviews_title-description-layout_mini_1">--}}
{{--                                                        <p class="main__reviews_title-description-head_1_mini">--}}
{{--                                                            {{$reviewList[2]->company_name}}--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-12 main__reviews_title-description-layout_mini_2">--}}
{{--                                                        <p class="main__reviews_title-description-body_1_mini">--}}
{{--                                                            {{$reviewList[2]->company_description}}--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div> <!-- Carousel item -->--}}

{{--                        <div class="carousel-item">--}}

{{--                            <div class="item_reviews">--}}

{{--                                <div class="carousel-reviews-element">--}}

{{--                                    <div class="row">--}}

{{--                                        <div class="col-4 main__news_window_news-content">--}}
{{--                                            <div class="col-12 main__reviews_size">--}}
{{--                                                <a target="_blank" href="{{$reviewList[1]->youtube_url}}">--}}
{{--                                                    <img src="{{$reviewList[1]->youtube_preview}}"--}}
{{--                                                         class="main__reviews_photo-mini">--}}
{{--                                                    <div class="col-12 main__reviews_title-description-layout_mini_1">--}}
{{--                                                        <p class="main__reviews_title-description-head_1_mini">--}}
{{--                                                            {{$reviewList[1]->company_name}}--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-12 main__reviews_title-description-layout_mini_2">--}}
{{--                                                        <p class="main__reviews_title-description-body_1_mini">--}}
{{--                                                            {{$reviewList[1]->company_description}}--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-4 main__news_window_news-content">--}}
{{--                                            <div class="col-12 main__reviews_size">--}}
{{--                                                <a target="_blank" href="{{$reviewList[2]->youtube_url}}">--}}
{{--                                                    <img src="{{$reviewList[2]->youtube_preview}}"--}}
{{--                                                         class="main__reviews_photo-mini">--}}
{{--                                                    <div class="col-12 main__reviews_title-description-layout_mini_1">--}}
{{--                                                        <p class="main__reviews_title-description-head_1_mini">--}}
{{--                                                            {{$reviewList[2]->company_name}}--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-12 main__reviews_title-description-layout_mini_2">--}}
{{--                                                        <p class="main__reviews_title-description-body_1_mini">--}}
{{--                                                            {{$reviewList[2]->company_description}}--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-4 main__news_window_news-content">--}}
{{--                                            <div class="col-12 main__reviews_photo">--}}
{{--                                                <img src="{{$reviewList[0]->youtube_preview}}"--}}
{{--                                                     class="main__reviews_photo-main">--}}
{{--                                                <div class="main__reviews_photo-play_mini">--}}
{{--                                                    <a href="{{$reviewList[0]->youtube_url}}"><img--}}
{{--                                                                src="{{asset('/new/images/icons/arrowIcon.png')}}"--}}
{{--                                                                class="main__reviews_photo-play_mini_icon"/></a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div> <!-- Carousel item -->--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <!-- Arrows for carousel -->--}}
{{--            <div class="container">--}}
{{--                <div class="col-12 main__reviews_carousel_arrows">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-auto">--}}
{{--                            <a type="button" data-bs-target="#carouselReviewsMini" data-bs-slide="prev">--}}
{{--                                <i class="bi bi-arrow-left main__reviews_carousel_arrows-design"></i>--}}
{{--                            </a>--}}
{{--                        </div>--}}

{{--                        <div class="col-auto">--}}
{{--                            <a type="button" data-bs-target="#carouselReviewsMini" data-bs-slide="next">--}}
{{--                                <i class="bi bi-arrow-right main__reviews_carousel_arrows-design"></i>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </nav>--}}

{{--    </nav>--}}

{{--    @isset($showAllReviewsBtn)--}}
{{--        @if($showAllReviewsBtn)--}}
{{--            <div class="container">--}}
{{--                <div class="col-12 text-center main__reviews_button">--}}
{{--                    <a href="{{route('new-reviews')}}" type="button" class="btn btn-success main__partners_button">Отзывы--}}
{{--                        довольных клиентов</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    @endisset--}}
{{--</div> <!-- Reviews window -->--}}
