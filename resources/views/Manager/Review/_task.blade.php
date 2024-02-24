{{--/**--}}
{{--* Created by PhpStorm.--}}
{{--* User: r.biewald--}}
{{--* Date: 18.08.2018--}}
{{--* Time: 11:53--}}
{{--*/--}}

<div class="row pb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <span class="">
                    <i class="far fa-calendar-alt"></i>
                    {{is_null($task->execution_time) ? "" : " " . \App\Data\Helper\Assistant::formatDateTime($task->execution_time)}}
                </span>

                <span>{{$task->task_relevance_name}}</span>

                <span class="gren">
                    @switch($task->task_status_id)
                        @case(\App\Data\Helper\TaskStatus::Waiting)
                        <i class="far fa-hourglass"></i>
                        @break
                        @case(\App\Data\Helper\TaskStatus::InWork)
                        <i class="far fa-edit"></i>
                        @break
                        @case(\App\Data\Helper\TaskStatus::Closed)
                        <i class="far fa-check-circle"></i>
                        @break
                    @endswitch

                    {{$task->task_status_name}}
                    @if($task->task_status_id == \App\Data\Helper\TaskStatus::Closed)
                            @lang('messages.client.actual_time') - {{$task->execution_time_fact}} ч.
                    @endif
                </span>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <div class="row pb-3">
                            <div class="col-12 pb-3">
                                <h6>@lang('messages.admin.service.description')</h6>
                                {{$task->description}}
                            </div>
                            @if(!is_null($task->result) && $task->result != '')
                                <div class="col-12 pb-3">
                                    <h6>@lang('messages.services.result')</h6>
                                    {{$task->result}}
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h6 class="pb-3">@lang('messages.all.document')</h6>
                                <div class="row">
                                    @foreach($task->documentList as $document)
                                        <div class="col-2 donwloadDocument">
                                            <div>
                                                <a href="/storage_/{{$document->document_path}}"
                                                   target="_blank">
                                                    <div class="img-document">
                                                        <div class="img-document-txt">@lang('messages.all.document')</div>
                                                    </div>
                                                    <div class="name-document">{{$document->document_name}}</div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="btn-group btn-group-sm float-right" role="group">
                                    @if(sizeof($task->reviewCommentList) > 1)
                                        <button class="btn btn-sm btn-info taskReviewCommentList"
                                                data-taskid="{{$task->id}}">@lang('messages.roles.all_comments')
                                        </button>
                                    @endif
                                    <button class="btn btn-sm btn-info taskReviewCommentAdd"
                                            data-taskid="{{$task->id}}">@lang('messages.roles.add_comment')
                                    </button>
                                </div>
                            </div>
                        </div>

                        @if(sizeof($task->reviewCommentList) > 0)
                            <div class="row">
                                <div class="col-12">
                                    <ol>
                                        @foreach($task->reviewCommentList->take(3) as $reviewComment)
                                            <li>
                                                <small>{{\App\Data\Helper\Assistant::formatDateTime($reviewComment->create_date)}}</small>
                                                <p>{{$reviewComment->comment}}</p>
                                            </li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
