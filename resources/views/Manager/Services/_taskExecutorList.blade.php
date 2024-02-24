<div>
    <table id="executors" class="table table-striped table-responsive-sm col-12">
        <thead>
        <tr>
            <th>@lang('messages.manager.executor_name')</th>
            <th>@lang('messages.all.delete')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($taskExecutorList as $taskExecutor)
            <tr>
                <td>{{$taskExecutor->executor_full_name }}</td>

                <td class="text-center">
                    <a href="#" class="btn btn-success deleteExecutor" data-executor="{!! $taskExecutor->id !!}" data-task_id="{!! $taskExecutor->task_id !!}"><i class="fa fa-minus"></i></a>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>