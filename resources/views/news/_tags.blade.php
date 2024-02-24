@foreach(explode('#', $news->tags) as $tag)
    @if($tag)
        <a href="{{route('news.list').'?tags[]='.trim($tag)}}"
           class="card-tags__item">#{{trim($tag)}}</a>
    @endif
@endforeach