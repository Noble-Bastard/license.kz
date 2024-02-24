@foreach($commentList->where('parent_comment_id', $currentId) as $comment)
    @include('admin.news._newsComment', ['comment' => $comment, 'currentLevel' => $currentLevel, 'answerCnt' => sizeof($commentList->where('parent_comment_id', $comment->id))])
    @include('admin.news._newsCommentList', ['commentList' => $commentList, 'currentId' => $comment->id, 'currentLevel' => $currentLevel+1])
@endforeach