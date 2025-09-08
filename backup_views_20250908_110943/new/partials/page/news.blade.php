@if(sizeof($newsList) > 0)
    <nav>
        <div class="col-12 main__news_window">
            <div class="container" style="max-width: 90rem">
                <div class="row" style="align-items: center">
                    @php
                        $firstNews = $newsList[0];
                    @endphp
                    <div class="col-lg-6 col-12 main__news_window_photo">
                        <img src="{{\Illuminate\Support\Facades\Storage::url($firstNews->thumbnail)}}"
                             class="main__news_big_photo">
                        <div class="main__news_small_rectangle text-center">
                            <p class="main__news_window_title-time">{{\App\Data\Helper\Assistant::formatDate($firstNews->create_date)}}</p>
                        </div>
                    </div>

                    <div class="col-lg-6 col-12 main__news_window_context">

                        <div class="col-8">
                            <p class="main__news_window_title-head">{{$firstNews->header}}</p>
                        </div>

                        <div class="col-10 main__news_window_paragraph">
                            <p class="main__news_window_title-description">
                                {{$firstNews->lead}}
                            </p>
                        </div>

                        <div class="10">
                            <a href="{{route('news.get', ['id' => $firstNews->id])}}" class="main__news_window_link">Читать
                                новость</a>
                        </div>

                        <div class="col-12 main__news_window_news d-none d-md-block">
                            <div class="row">
                                @foreach($newsList as $news)
                                    @if($loop->index > 0)
                                        <div class="col-4 main__news_window_news-content">
                                            <a href="{{route('news.get', ['id' => $news->id])}}">
                                            <div class="col-12 text-start">
                                                <span class="main__news_window_title-numbers">0{{$loop->index}}</span>
                                            </div>
                                            <div class="col-12 main__news_window_news_dates">
                                                <img src="{{\Illuminate\Support\Facades\Storage::url($news->thumbnail)}}"
                                                     class="main__news_window_news-icons">
                                                <div class="main__news_small_rectangle_news text-center align-items-center">
                                                    <p class="main__news_window_title-time_news">{{\App\Data\Helper\Assistant::formatDate($news->create_date)}}</p>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <p class="main__news_window_title-news">{{$news->header}}</p>
                                            </div>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <nav class="d-block d-md-none">
                            <div class="col-12 text-center justify-content-center main__news_carousel">
                                <div id="carouselNews" class="carousel slide show-news pointer-event"
                                     data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($newsList->filter(function ($news, $key) {
                                                                               return $key > 0;
                                                                           }) as $news)
                                            <div class="carousel-item {{$loop->index == 0 ? "active" : ""}}">
                                                <div class="item_news">
                                                    <div class="carousel-news-element">
                                                        <div class="row no-gutters">
                                                            <div class="col-11 main__news_window_news-content ps-3">
                                                                <a href="{{route('news.get', ['id' => $news->id])}}">
                                                                    <div class="row">
                                                                        <div class="col-12 text-start">
                                                                            <span class="main__news_window_title-numbers ps-1">0{{$loop->index + 1}}</span>
                                                                        </div>
                                                                        <div class="col-12 image">
                                                                            <img src="{{\Illuminate\Support\Facades\Storage::url($news->thumbnail)}}"
                                                                                 class="main__news_window_news-icons">
                                                                            <div class="main__news_small_rectangle_news_carousel text-center align-items-center">
                                                                                <p class="main__news_window_title-time_news">{{\App\Data\Helper\Assistant::formatDate($news->create_date)}}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <p class="main__news_window_title-news">{{$news->header}}</p>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </nav>
@endif