@extends('new.layouts.app')

@section('content')
    <div class="title-main">
        @lang('messages.pages.events.title')

    </div>

    @if(sizeof($eventsList) > 0)
        <div class="row no-gutters events">
            <div class="col-12">
                <div class="card">

                    <div class="events-header">
                        @lang('messages.pages.events.i_come')
                    </div>


                    <div class="card-body">
                        <div class="card-deck">
                            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>

                            <div id="carousel" class="carousel slide" data-ride="carousel" data-interval="false">
                                <div class="carousel-inner">
                                    @foreach($eventsList->chunk(4) as $eventChunk)
                                        <div class="carousel-item @if ($loop->first) active @endif">
                                            <div class="card-deck">
{{--                                                <div class="slide-box">--}}
                                                    @foreach($eventChunk as $event)
                                                        @include('events._shortEvent', ['event' => $event])
                                                    @endforeach
{{--                                                </div>--}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <ol class="carousel-indicators">
                                @foreach ($eventsList->chunk(4) as $indexKey => $event)
                                    <li data-target="#carousel" data-slide-to="{{$indexKey}}"
                                        @if ($loop->first) class="active" @endif></li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row no-gutters events">
                @foreach ($eventsList as $event)
                    <div class="event event_{{$event->id}} mb-3" id="event_{{$event->id}}"
                         style="min-height: 300px;
                            display: none;">
                        @include('events._fullEvent', ['event' => $event])
                    </div>
                @endforeach
        </div>
    @endif

    @if(sizeof($ourEventsList) > 0)
        <div class="row no-gutters events"
             style="border: 0.5px solid #C1C1C1; margin-top: 40px; margin-left: -70px; margin-right: -70px;">
        </div>


        <div class="row no-gutters events mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="events-header">
                        @lang('messages.pages.events.our_event')
                    </div>

                    <div class="card-body">
                        <div class="card-deck">
                            <a class="carousel-control-prev" href="#carouselOur" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselOur" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>

                            <div id="carouselOur" class="carousel slide" data-ride="carousel" data-interval="false">
                                <div class="carousel-inner">
                                    @foreach($ourEventsList->chunk(4) as $eventChunk)
                                        <div class="carousel-item @if ($loop->first) active @endif">
                                            <div class="card-deck">
{{--                                                <div class="slide-box">--}}
                                                    @foreach($eventChunk as $event)
                                                        @include('events._shortEvent', ['event' => $event])
                                                    @endforeach
{{--                                                </div>--}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <ol class="carousel-indicators">
                                @foreach ($ourEventsList->chunk(4) as $indexKey => $event)
                                    <li data-target="#carouselOur" data-slide-to="{{$indexKey}}"
                                        @if ($loop->first) class="active" @endif></li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row no-gutters events">
            @foreach ($ourEventsList as $event)
                <div class="event event_{{$event->id}} mb-3" id="event_{{$event->id}}"
                     style="min-height: 300px; display: none;">
                    @include('events._fullEvent', ['event' => $event])
                </div>
            @endforeach
        </div>
    @endif
@endsection

@section('js')
    <script>
        function showDetails(id) {
            $('.event').hide();
            $('.event_' + id).show();
        }
    </script>
@endsection