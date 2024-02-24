<div class="news-card card {{$extendContent ? 'news-card__full' : 'news-card__short'}}">
    <a href="{{route('news.get', ['id' => $news->id])}}">
        <img src="{{\Illuminate\Support\Facades\Storage::url($news->thumbnail)}}" class="card-img card-img-top">
        @if($extendContent)
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-10">
                        <div class="card-title">{{$news->header}}</div>
                    </div>
                    <div class="col-12 col-lg-2 text-end">
                        <div class="card-date">
                            {{\App\Data\Helper\Assistant::formatDate($news->create_date)}}
                        </div>
                    </div>
                </div>
                <p class="card-text">{{$news->lead}}</p>
            </div>
        @else
            <div class="card-img-overlay">
                <div class="card-title">{{$news->header}}</div>
                <p class="card-text">{{$news->lead}}</p>
            </div>
        @endif
    </a>
</div>
