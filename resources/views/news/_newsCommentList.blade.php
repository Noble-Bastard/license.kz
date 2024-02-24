@foreach($commentList->where('parent_comment_id', $currentId) as $comment)
    @include('news._newsComment', ['comment' => $comment, 'currentLevel' => $currentLevel, 'answerCnt' => sizeof($commentList->where('parent_comment_id', $comment->id))])
    @include('news._newsCommentList', ['commentList' => $commentList, 'currentId' => $comment->id, 'currentLevel' => $currentLevel+1])
    @if($currentLevel == 0)
        <div class="col-11 offset-1 mt-5 mb-5">
            <hr class=" w-65 ml-0">
        </div>
    @endif
@endforeach