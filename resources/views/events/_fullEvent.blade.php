<div class="no-border col-12 mt-6">
    <div class="data-content name-caption" style="min-height: auto; margin-bottom: 15px;">
        {{$event->name}}
    </div>

    <div class="row">
        <div class="col-12 create_date">
            <img src="{{asset('images/calendar.png')}}">
                <?php \Carbon\Carbon::setLocale(\Illuminate\Support\Facades\App::getLocale()); ?>
                {{\Carbon\Carbon::parse($event->event_date)->formatLocalized('%d %B %Y')}}
        </div>
    </div>

    <div class="row">
        <div class="col-12 data-content">
                <img src="{{asset('images/place.png')}}">
                {{$event->city}}, {{$event->place}}
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-4">
            @if(is_null($event->logo_photo))
                <img class="img-fluid" src="{{asset('images/no_image.png')}}"/>
            @else
                <img class="img-fluid" src="{{\Illuminate\Support\Facades\Storage::url($event->logo_photo)}}"/>
            @endif
        </div>
        <div class="description-content col-8">
            {{$event->content}}
        </div>
    </div>
</div>