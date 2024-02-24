@if(sizeof($task->reviewCommentList) > 0)
    <div class="row">
        <div class="col-12">
            <ol>
                @foreach($task->reviewCommentList as $reviewComment)
                    <li>
                        <small>{{\App\Data\Helper\Assistant::formatDateTime($reviewComment->create_date)}}</small>
                        <p>{{$reviewComment->comment}}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
@endif