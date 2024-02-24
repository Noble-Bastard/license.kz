{{--{{dd($serviceCarouselList)}}--}}
@if(sizeof($serviceCarouselList) > 0)

        <div class="row services-background">
            <div class="col-12">
                <div id="carouselService" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($serviceCarouselList as $indexKey => $serviceCarousel)
                            <li data-target="#carouselService" data-slide-to="{{$indexKey}}"
                                class="{{$indexKey==0 ? "active" : ""}}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach($serviceCarouselList as $indexKey => $item)
                            <div class="carousel-item {{$indexKey==0 ? "active" : ""}}">
                                <a href="{{route('services.serviceInfo', ['servicesId'=>$item->service_id])}}">
                                    <img class="d-block w-100"
                                         srcset="/serviceCarouselImage/{{$item->id}}/1 1400w,
                                                 /serviceCarouselImage/{{$item->id}}/2 1200w,
                                                 /serviceCarouselImage/{{$item->id}}/3 992w,
                                                 /serviceCarouselImage/{{$item->id}}/4 768w,
                                                 /serviceCarouselImage/{{$item->id}}/5 576w
                                                 "
                                         src="/serviceCarouselImage/{{$item->id}}/1"
                                         srcset=""
                                         alt="{{$item->service_name}}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    @if(sizeof($serviceCarouselList) > 1)
                        <a class="carousel-control-prev" href="#carouselService" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">@lang('messages.services.previous')</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselService" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">@lang('messages.services.next')</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>

@endif