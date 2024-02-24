<div class="comment-body {{$currentLevel > 0  ?  'mt-4' : ''}}" style="padding-left: {{120*$currentLevel}}px">
    <div class="comment mb-3">
        <div class="row ">
            <div class="col-1 text-center comment-avatar">
                <img src="{{asset('images/avatarMini.png')}}" class="img-fluid">
            </div>
            <div class="col-11 comment-text">
                <span class="user-name mr-4 ">
                    <b>{{$comment->author->full_name}}</b>
                </span>
                <span class="time-lap">
                                <?php \Carbon\Carbon::setLocale(\Illuminate\Support\Facades\App::getLocale()); ?>
                    {{\Carbon\Carbon::parse($comment->create_date)->diffForHumans()}}
                            </span>
                <div class="mb-1 mt-3 text-comments">
                    {{$comment->comment}}
                </div>
                <div class="mt-3">
                    @if(Auth::check())
                        <div class="comment-addition">
{{--                            <span class="pr-4"><span><i class="fas fa-heart"></i></span> <span--}}
{{--                                        class="pl-2"><b>208</b></span></span>--}}
                            <span class="replay-comment" data-comment-id="{{$comment->id}}" data-comment-text="{{$comment->comment}}">
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                              class="bi bi-arrow-return-right " viewBox="0 0 16 16">
                              <path fill-rule="evenodd"
                                    d="M1.5 1.5A.5.5 0 0 0 1 2v4.8a2.5 2.5 0 0 0 2.5 2.5h9.793l-3.347 3.346a.5.5 0 0 0 .708.708l4.2-4.2a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 8.3H3.5A1.5 1.5 0 0 1 2 6.8V2a.5.5 0 0 0-.5-.5z"/>
                            </svg>

                            <span class="pl-2">@lang('messages.news.comment_answer')</span>
                        </span>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>