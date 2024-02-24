<div class="col-12">
    <table id="services" class="table table-striped table-responsive-sm col-12">
        <thead>
        <tr>
            <th>@lang('messages.manager.number_text')</th>
            <th>@lang('messages.manager.name')</th>
            <th>@lang('messages.manager.performers')</th>
            <th>@lang('messages.manager.date')</th>
            <th>@lang('messages.all.actions')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($serviceJournalStepList as $serviceJournalStep)
            <tr>
                <td>
                    {{$serviceJournalStep->service_step_no}}
                </td>
                <td>
                    {{$serviceJournalStep->service_step_description}}
                </td>
                <td>
                    @foreach($taskExecutorList->where('task_id',$serviceJournalStep->task_id) as $taskExecutor)
                        {{$taskExecutor->executor_full_name}};
                    @endforeach
                </td>
                <td class="text-center">{{\App\Data\Helper\Assistant::formatDate($serviceJournalStep->execution_start_date) }}</td>
                <td class="text-center">
                    <div class="dropdown">
                        <div class="btn-group btn-group-toggle float-right">

                            <button class="btn btn-success btn-sm  messageTaskWindowLink" data-taskid="{{$serviceJournalStep->task_id}}" title="Чат c исполнителем">
                                <i class="far fa-comments"></i>
                            </button>
                            <button class="btn btn-info btn-sm dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bars"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item ExecutorEdit" data-task_id="{{$serviceJournalStep->task_id}}"
                                   href="#">
                                    @lang('messages.manager.performers')</a>

                            </div>
                        </div>
                    </div>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{--<div class="row padding-t-15">--}}
    {{--<div class="col">--}}
    {{--{{ $serviceJournalStepList->links() }}--}}
    {{--</div>--}}
    {{--</div>--}}
</div>