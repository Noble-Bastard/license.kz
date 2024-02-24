@extends('new.layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <div class="title-main">
                    {{$serviceJournal->service_no }} {{$serviceJournal->service_name }}
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row pb-3 ">
                            <div class="col-8">
                                <span class="badge badge-info">@lang('messages.manager.service_status') {{$serviceJournal->service_status_name}}</span>
                                <span class="badge badge-primary">@lang('messages.manager.project_status'){{$serviceJournal->project_status_name}}</span>
                            </div>
                            <div class="col-4">
                                <div class="btn-group btn-group-toggle float-right">
                                    @if($serviceJournal->service_status_id == \App\Data\Helper\ServiceStatusList::Check)
                                        <a class="btn btn-info btn-sm"
                                           href="{{route('Manager.services.startExecution', ['servicesJournalId'=>$serviceJournal->id])}}">@lang('messages.manager.start_execution')</a>
                                    @endif
                                    <button class="btn btn-success btn-sm  messageWindowLink"
                                            data-servicejournalid="{{$serviceJournal->id}}" title="Чат c клиентом">
                                        <i class="far fa-comments"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row mainExecutorList">
                            <div class="col-12">
                                <table id="services" class="table table-striped table-responsive-sm col-12">
                                    <thead>
                                    <tr>
                                        <th class="w-10">@lang('messages.manager.number_text')</th>
                                        <th class="w-50">@lang('messages.manager.name')</th>
                                        <th class="w-30">@lang('messages.manager.performers')</th>
                                        <th class="w-10">@lang('messages.manager.date')</th>
                                        <th class="w-20">@lang('messages.all.actions')</th>
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

                                                        <button class="btn btn-success btn-sm  messageTaskWindowLink"
                                                                data-taskid="{{$serviceJournalStep->task_id}}"
                                                                title="Чат c исполнителем">
                                                            <i class="far fa-comments"></i>
                                                        </button>
                                                        <button class="btn btn-info btn-sm dropdown-toggle"
                                                                type="button"
                                                                id="dropdownMenuButton" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-bars"></i>
                                                        </button>

                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item ExecutorEdit"
                                                               data-task_id="{{$serviceJournalStep->task_id}}"
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal bd-example-modal-lg" tabindex="-1" role="dialog" id="messageModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>
    <div class="modal fade" id="ExecutorModal" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalCenterTitle">
                        @lang('messages.manager.performers')
                    </h6>
                  <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="pb-3">
                        {!! Form::open(['url' => route('Manager.services.taskExecutorAdd'), 'method' => 'post', 'class' => 'form-horizontal', 'id'=>'ExecutorForm']) !!}
                        <input name="task_id" type="hidden" value=""/>
                        <div class="">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="executorEdit" name="pickEdit"
                                           class="custom-control-input executorEdit" value="1">
                                    <label class="custom-control-label" for="executorEdit">Исполнитель</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="groupEdit" name="pickEdit"
                                           class="custom-control-input groupEdit" value="2">
                                    <label class="custom-control-label" for="groupEdit">Группа исполнителей</label>
                                </div>
                        </div>
                        <div class="">
                            {!! Form::label('profile_id', trans('messages.manager.performer'), ['class' => 'col-form-label profile_id', 'for' => 'profile_id']) !!}

                            {!! Form::select('profile_id', $executorList, null, array_merge(['placeholder' => '', 'class' => $errors->has('profile_id') ? 'form-control is-invalid profile_id' : 'form-control profile_id'])) !!}
                            @if ($errors->has('profile_id'))
                                <span class="help-block invalid-feedback">
                                        <strong>{{ $errors->first('profile_id') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group ">
                            {!! Form::label('group_id', trans('messages.manager.group_performers'), ['class' => 'col-form-label group_id']) !!}
                            {!! Form::select('group_id', $groupList, null, array_merge(['placeholder' => '', 'class' => $errors->has('group_id') ? 'form-control is-invalid group_id' : 'form-control group_id'])) !!}
                            @if ($errors->has('group_id'))
                                <span class="help-block invalid-feedback">
                                        <strong>{{ $errors->first('group_id') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="text-end mt-3">
                            {!! Form::submit('Добавить', ['class' => 'btn btn-success']) !!}
                        </div>
                        {!! Form::close() !!}

                    </div>
                    <div class="executorList"></div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $(document).on('click', '.ExecutorEdit', function (e) {
                var modal = $('#ExecutorModal');
                $('input[name="task_id"]', modal).val($(this).data('task_id'));
                $('.executorEdit').prop("checked", true);
                $('.group_id').hide();
                $('.profile_id').show();
                $.ajax({
                    type: "GET",
                    url: "{!! route('Manager.services.getTaskExecutorList')!!}",
                    data: {
                        _token: '{!! csrf_token() !!}',
                        taskId: $(this).data('task_id')
                    },
                    success: function (data) {
                        $('.executorList', modal).html(data);
                        modal.modal('show');
                    }
                });
            });
            $(document).on('click', '.deleteExecutor', function (e) {
                var modal = $('#ExecutorModal');
                $.ajax({
                    type: "GET",
                    url: "{!! route('Manager.services.taskExecutorDestroy')!!}",
                    data: {
                        _token: '{!! csrf_token() !!}',
                        id: $(this).data('executor'),
                        taskId: $(this).data('task_id')
                    },
                    success: function (data) {
                        $('.executorList', modal).html(data);
                        $.ajax({
                            type: "GET",
                            url: "{!! route('Manager.services.executorListPart')!!}",
                            data: {
                                _token: '{!! csrf_token() !!}',
                                serviceJournalId: '{!! $serviceJournal->id !!}'
                            },
                            success: function (data) {
                                $('.mainExecutorList').html(data);
                            }
                        });

                    }
                });
            });
            $(document).on('click', '.executorEdit', function (e) {
                if ($(this).prop("checked", true)) {
                    $('.group_id').hide();
                    $('.profile_id').show();
                }
            });
            $(document).on('click', '.groupEdit', function (e) {
                if ($(this).prop("checked", true)) {
                    $('.group_id').show();
                    $('.profile_id').hide();
                }
            });

            $('#ExecutorForm').submit(function () {
                var task_id = $('input[name="task_id"]', this).val();
                var serviceJournalId =
                    $(this).ajaxSubmit({
                        success: function () {
                            $.ajax({
                                type: "GET",
                                url: "{!! route('Manager.services.getTaskExecutorList')!!}",
                                data: {
                                    _token: '{!! csrf_token() !!}',
                                    taskId: task_id
                                },
                                success: function (data) {
                                    $('.executorList', $('#ExecutorModal')).html(data);
                                }
                            });
                            $.ajax({
                                type: "GET",
                                url: "{!! route('Manager.services.executorListPart')!!}",
                                data: {
                                    _token: '{!! csrf_token() !!}',
                                    serviceJournalId: '{!! $serviceJournal->id !!}'
                                },
                                success: function (data) {
                                    $('.mainExecutorList').html(data);
                                }
                            });

                        }
                    });

                return false;
            });

            $(document).on('click', '.messageWindowLink', function (e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: '{!! route('Manager.services.messageList', ['servicesJournalId' => $serviceJournal->id]) !!}',
                    data: {
                        _token: '{!! csrf_token() !!}',
                        serviceJournalId: $(this).data('servicejournalid')
                    },
                    success: function (data) {
                        $('#messageModal .modal-content').html(data);
                        $('#messageModal').modal('show');

                        var scrollToElm = $('.msg_container_base .message.unread').first();
                        if (scrollToElm.length === 0) {
                            scrolToElm = $('.msg_container_base .message').last();
                        }
                        $('.msg_container_base').scrollTo(scrollToElm);
                    }
                });
            });

            $(document).on('click', '.messageTaskWindowLink', function (e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: '{!! route('Manager.services.messageTaskList') !!}',
                    data: {
                        _token: '{!! csrf_token() !!}',
                        taskId: $(this).data('taskid')
                    },
                    success: function (data) {
                        $('#messageModal .modal-content').html(data);
                        $('#messageModal').modal('show');

                        var scrollToElm = $('.msg_container_base .message.unread').first();
                        if (scrollToElm.length === 0) {
                            scrolToElm = $('.msg_container_base .message').last();
                        }
                        $('.msg_container_base').scrollTo(scrollToElm);
                    }
                });
            });


            $(document).on('click', '#sendMessage', function (e) {
                if ($(this).data('servicejournalid')) {
                    $.ajax({
                        type: 'POST',
                        url: '{{route('Manager.service.message.create')}}',
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'serviceJournalId': $(this).data('servicejournalid'),
                            'messageContent': $('#messageContent').val()
                        },
                        success: function (data) {
                            $('.msg_container_base')
                                .html(data)
                                .scrollTo($('.msg_container_base .message').last());

                            $('#messageContent')
                                .val('')
                                .focus();
                        }
                    });
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '{{route('Manager.service.messageTask.create')}}',
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'taskId': $(this).data('taskid'),
                            'messageContent': $('#messageContent').val()
                        },
                        success: function (data) {
                            $('.msg_container_base')
                                .html(data)
                                .scrollTo($('.msg_container_base .message').last());

                            $('#messageContent')
                                .val('')
                                .focus();
                        }
                    });
                }
            });
        });
    </script>
@endsection
