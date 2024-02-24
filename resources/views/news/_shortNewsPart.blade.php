@if($newsList->count() > 0)
    <div class="row news-list">
        <div class="col-12">
            <div class="row">
                <div class="col-12 news-heder">
                    @lang('messages.news.news')
                </div>

                @foreach($newsList as $news)
                    <div class="col-12 news-content">
                        <div>
                            <a href="{{route('news.get', ['id' => $news->id])}}">{{$news->header}} ></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif