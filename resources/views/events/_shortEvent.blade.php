<div class="card events-item no-border col-12 col-sm-3 col-lg-3">
    @if(is_null($event->preview_photo))
        <img class="card-img-top img-fluid" src="{{asset('images/no_image.png')}}"/>
    @else
        <img class="card-img-top img-fluid" src="{{\Illuminate\Support\Facades\Storage::url($event->preview_photo)}}"/>
    @endif
    <div class="card-body">
        <div class="create_date date-caption">
            <?php \Carbon\Carbon::setLocale(\Illuminate\Support\Facades\App::getLocale()); ?>
            {{\Carbon\Carbon::parse($event->event_date)->formatLocalized('%d %B %Y')}}
        </div>
        <div class="data-content name-caption">
            {!!  \App\Data\Helper\Assistant::subStrCutByWord(strip_tags($event->name), 128)!!}
        </div>

        <div class="splitter">
        </div>

        <div class="data-content city-caption">
            {{$event->city}}
        </div>


        <span class="calendar-circle">
            <img src="{{asset('images/calendar_white.png')}}" style="margin-top: 5px;margin-left: 8px;"/>
        </span>
        <button class="btn btn-more" onclick="showDetails({{$event->id}})" data-details="{{$event->id}}">Подробнее</button>
    </div>
</div>