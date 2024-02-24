<div class="col-12 overflow-hidden">

    <div class="container">
        <div class="col-xl-5 col-lg-7 col-12">
            <p class="main__partners_window_title-head"> Специальные условия на услуги
                <span class="main__partners_window_title-span"> наших партнеров </span>
            </p>
        </div>
    </div>

    <nav class="hide-mobile-dark">

        <!-- partners - cards -->
        <div class="col-12 main__partners_cards">
            <div class="row carousel_row justify-content-center">

                <!-- cards - carousel -->
                <div id="carouselExampleControl" class="carousel slide" data-bs-ride="carousel">

                    @foreach($partnerList->chunk(10) as $partnerListChunk)
                        <div class="carousel-item active">
                            <div class="row main__partner_cards_big">

                                @foreach($partnerListChunk as $partner)
                                    <div class="card">
                                        <div class="card-body h-100">
                                            <img src="{{\Illuminate\Support\Facades\Storage::url($partner->logo_path)}}"
                                                 alt="{{$partner->name}}" class="main__partner_cards-photo_par"/>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>

        @if(sizeof($partnerList) > 10)
            <div class="container">
                <div class="col-12 main__partners_carousel_arrows">
                    <div class="row">
                        <div class="col-auto">
                            <a type="button" data-bs-target="#carouselExampleControl" data-bs-slide="prev">
                                <i class="bi bi-arrow-left main__partners_carousel_arrows-design"></i>
                            </a>
                        </div>

                        <div class="col-auto">
                            <a type="button" data-bs-target="#carouselExampleControl" data-bs-slide="next">
                                <i class="bi bi-arrow-right main__partners_carousel_arrows-design"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </nav>

    <div class="row" style="justify-content: center">

        <nav class="show-mobile-dark">
            <div class="col-12 text-center justify-content-center main__partners_carousel">
                <div id="carouselPartners" class="carousel slide show-partners pointer-event col-12"
                     data-bs-ride="carousel">

                    <div class="carousel-inner">

                        @foreach($partnerList->chunk(2) as $partnerListChunk)
                        <div class="carousel-item {{$loop->index == 0 ? 'active' : ''}}">
                            <div class="item_partners">
                                <div class="carousel-partners-element">
                                    <nav class="show-mobile-service">
                                        <div class="row">
                                            @foreach($partnerListChunk as $partner)
                                            <div class="col-auto main__news_window_news-content">
                                                <div class="main__partner_cards">
                                                    <div class="btn card">
                                                        <div class="card-body">
                                                            <img src="{{\Illuminate\Support\Facades\Storage::url($partner->logo_path)}}"
                                                                 alt="{{$partner->name}}" class="main__partner_cards-photo_par"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </nav>

                                </div>

                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="col-12 main__partners_carousel_arrows">
                    <div class="row">
                        <div class="col-auto">
                            <a type="button" data-bs-target="#carouselPartners" data-bs-slide="prev">
                                <i class="bi bi-arrow-left main__partners_carousel_arrows-design"></i>
                            </a>
                        </div>

                        <div class="col-auto">
                            <a type="button" data-bs-target="#carouselPartners" data-bs-slide="next">
                                <i class="bi bi-arrow-right main__partners_carousel_arrows-design"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

    </div>

    <div class="col-12 text-center">
        <div class="container">
            <a href="{{route('new-partners')}}" type="button" class="btn btn-success main__partners_button">Все
                партнеры</a>
        </div>
    </div>

</div>