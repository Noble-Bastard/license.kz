<div class="row comment-body d-flex justify-content-end" style="padding-left: {{35*$currentLevel}}px">
    <div class="col-12 comment mb-3">
        <div class="row no-gutters">
            <div class="col-1 comment-avatar">
                <img src="{{asset('images/avatarMini.png')}}" class="img-fluid">
            </div>
            <div class="col-11 comment-text">
                <div class="row">
                    <div class="col-12 mb-1">
                            <span class="user-name mr-5">
                                {{$comment->author->full_name}}
                            </span>
                            <span class="time-lap">
                                {{\App\Data\Helper\Assistant::formatDateTime($comment->create_date)}}
                            </span>
                    </div>
                    <div class="col-12 mb-1 text-comments">
                        {{$comment->comment}}
                    </div>
                    <div class="col-12">
                        <span class="delete-comment" data-comment-id="{{$comment->id}}">
                            @lang('messages.all.delete')
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>