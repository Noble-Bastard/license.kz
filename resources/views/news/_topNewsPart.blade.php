@isset($news)
    <div class="news row">
        <div class="news-header col-12">
            {{$news->header}}
        </div>
        <div class="news-body col-12">
            {!! substr(str_replace(array("\n","\r"), '', strip_tags($news->content)), 0, 150) !!} ...
        </div>
        <div class="news-footer col-12 align-self-end padding-t-15">
            <a href="{{route('news.get', ['id' => $news->id])}}"
               class="btn btn-success">@lang('messages.news.more')</a>
        </div>
    </div>
@endisset