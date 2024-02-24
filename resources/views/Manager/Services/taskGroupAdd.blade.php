@extends('new.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="title-main">{{$task->description }}

                </div>

                <div class="card-body">
                <div class="pb-3">
                    {!! Form::open(['url' => route('Manager.services.taskGroupUpdate',$task->id), 'method' => 'put', 'class' => 'form-horizontal']) !!}
                    <input name="task_id" type="hidden" value="{{$task->id}}"/>

                    <div class="form-row">
                        {!! Form::label('group_id', 'Группа исполнителей', ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                        <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                            {!! Form::select('group_id', $groupList, null, array_merge(['placeholder' => '', 'class' => $errors->has('group_id') ? 'form-control is-invalid' : 'form-control'])) !!}
                            @if ($errors->has('group_id'))
                                <span class="help-block invalid-feedback">
                                        <strong>{{ $errors->first('group_id') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9">
                            <submitfiled>{!! Form::submit('Добавить', ['class' => 'btn btn-success']) !!}</submitfiled>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                    <div>
                        <table id="executors" class="table table-striped table-responsive-sm col-12">
                            <thead>
                            <tr>
                                <th>@lang('messages.manager.executor_name')</th>
                                <th>@lang('messages.all.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($taskExecutorList as $taskExecutor)
                                <tr>
                                    <td>{{$taskExecutor->executor_full_name }}</td>

                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-success dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                <a class="dropdown-item"
                                                   href="{{route('Manager.services.taskExecutorDestroyGroup', $taskExecutor->id)}}"
                                                   data-method="delete">@lang('messages.all.delete')</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{--<div class="row padding-t-15">--}}
                            {{--<div class="col">--}}
                                {{--{{ $executorGroupBodyList->links() }}--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        //activeTab('manager-services-list');
    </script>
@endsection
