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
                            @lang('messages.executor.actual_time') - {{$task->execution_time_fact}} ч.
                    @endif
                </span>
                <div class="btn-group btn-group-sm float-right" role="group">
                    @if($task->task_status_id != \App\Data\Helper\TaskStatus::Closed)
                        @if($task->task_status_id == \App\Data\Helper\TaskStatus::Waiting)
                            <a href="{{route('executor.task.start', ['taskId' => $task->id])}}"
                               class="btn btn-success start_task" data-taskid="{{$task->id}}">
                                @lang('messages.executor.start')
                            </a>
                        @elseif($task->task_status_id == \App\Data\Helper\TaskStatus::InWork)
                            <button class="btn btn-success close_task" data-taskid="{{$task->id}}">
                                @lang('messages.executor.finish')
                            </button>
                        @endif
                    @endif
                        <button class="btn btn-info messageWindowLink" data-taskid="{{$task->id}}" title="Чат">
                            <i class="far fa-comments"></i>
                        </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row pb-3">
                    <div class="col-12 pb-3">
                        <h6>@lang('messages.all.decsription')</h6>
                        {{$task->description}}
                    </div>
                    @if(!is_null($task->result) && $task->result != '')
                        <div class="col-12 pb-3">
                            <h6>@lang('messages.all.result')</h6>
                            {{$task->result}}
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-9">
                        <h6 class="pb-3">@lang('messages.all.documents')</h6>
                        <div class="row">
                            @foreach($task->documentList as $document)
                                <div class="col-2 donwloadDocument">
                                    <div>
                                        @if($task->task_status_id == \App\Data\Helper\TaskStatus::InWork)
                                            <div class="btn-document">
                                                <a href="{{route('executor.taskDocument.delete', [$task->id,$document->document_id])}}">
                                                    <i class="fa fa-times delete-document"></i>
                                                </a>
                                            </div>
                                        @endif
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
                    <div class="col-3">
                        @if($task->task_status_id == \App\Data\Helper\TaskStatus::InWork)
                            <button type="button"
                                    class="btn btn-success uploadFilesModalOpen text-end float-right"
                                    data-taskid="{{$task->id}}"
                            >
                                Загрузить документ
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
