{{--/**--}}
{{--* Created by PhpStorm.--}}
{{--* User: r.biewald--}}
{{--* Date: 18.08.2018--}}
{{--* Time: 12:12--}}
{{--*/--}}
<div class="task-list">
    {{--<div class="row">--}}
    {{--<div class="col-12 btn-task-list">--}}
    {{--<button class="btn btn-default"><span><i class="fa fa-align-left"></i></span> Добавить--}}
    {{--примечание--}}
    {{--</button>--}}
    {{--<button class="btn btn-default"><span><i class="far fa-clock"></i></span>Добавить задачу--}}
    {{--</button>--}}
    {{--</div>--}}
    {{--</div>--}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="task-list">
                        @foreach($taskList as $task)
                            @include('Executor.Task._task', ['task' => $task])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="upload_files" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">@lang('messages.executor.download_document')</h5>
              <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post"
                      action="{{route('executor.taskDocument.add')}}"
                      enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <input type="hidden" name="taskId" value=""/>
                    <div class="form-row">
                        <label for="doc" class="col-xl-3 col-lg-3 col-sm-3 control-label">@lang('messages.executor.path')</label>
                        <div class="col-xl-9 col-lg-9 col-sm-9 elementinline pb-3">
                            <input type="file" name="doc"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="docName" class="col-xl-3 col-lg-3 col-sm-3 control-label">@lang('messages.all.decsription')</label>
                        <div class="col-xl-9 col-lg-9 col-sm-9 elementinline pb-3 modalDocName">
                            <input type="text" name="docName" id="docName"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-xl-12 col-lg-12 col-sm-12">
                            <button type="submit" class="btn btn-success">
                                @lang('messages.executor.upload')
                            </button>
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>

<div class="modal fade" id="close_task" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">@lang('messages.executor.finish_task')</h5>
              <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post"
                      action="{{route('executor.taskDocument.close')}}"
                      enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <input type="hidden" name="taskId" value=""/>
                    <div class="form-group">
                        <label for="execution_time_fact">@lang('messages.executor.actual_time_hours')</label>
                        <input type="number" class="form-control" required="required" name="execution_time_fact"/>
                    </div>
                    <div class="form-group">
                        <label for="result">@lang('messages.all.result')</label>
                        <textarea class="form-control" name="result"></textarea>
                    </div>
                    <div class="form-row mt-3">
                        <div class="col-xl-12 col-lg-12 col-sm-12">
                            <button type="submit" class="btn btn-success float-right">
                                @lang('messages.executor.finish_task')
                            </button>
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>

<div class="modal bd-example-modal-lg" tabindex="-1" role="dialog" id="messageModal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>

@section('js')
    <script>
        $(document).on('click', '.uploadFilesModalOpen', function (e) {
            var modal = $('#upload_files');
            $('input[name="taskId"]', modal).val($(this).data('taskid'));
            modal.modal('show');
        });

        $(document).on('click', '.close_task', function (e) {
            var modal = $('#close_task');
            $("input[name='taskId']", modal).val($(this).data('taskid'));
            modal.modal('show');
        });


        $(document).on('click', '.messageWindowLink', function(e){
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '{!! route('executor.task.messageList') !!}',
                data: {
                    _token : '{!! csrf_token() !!}',
                    taskId : $(this).data('taskid')
                },
                success: function(data){
                    $('#messageModal .modal-content').html(data);
                    $('#messageModal').modal('show');

                    var scrollToElm = $('.msg_container_base .message.unread').first();
                    if(scrollToElm.length === 0){
                        scrolToElm = $('.msg_container_base .message').last();
                    }
                    $('.msg_container_base').scrollTo(scrollToElm);
                }
            });
        });

        $(document).on('click', '#sendMessage', function(e){
            $.ajax({
                type: 'POST',
                url: '{{route('executor.task.message.create')}}',
                data: {
                    '_token' : "{{ csrf_token() }}",
                    'taskId' : $(this).data('taskid'),
                    'messageContent' : $('#messageContent').val()
                },
                success: function(data){
                    $('.msg_container_base')
                        .html(data)
                        .scrollTo($('.msg_container_base .message').last());

                    $('#messageContent')
                        .val('')
                        .focus();
                }
            });
        });

    </script>
@endsection
