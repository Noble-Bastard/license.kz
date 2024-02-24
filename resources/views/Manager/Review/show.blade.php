@extends('new.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="title-main">@lang('messages.all.service') - {{$project->description}}

                </div>

                <div class="card-body">
                    <div class="row pb-3">
                        <div class="col-12">
                            <div class="btn-group btn-group-sm float-right" role="group">
                                <a href="{{route('manager.review.setStatus', [
                                            "statusId" => \App\Data\Helper\ProjectReviewStatus::Fail,
                                            "projectId" => $project->id
                                ])}}" class="btn btn-sm btn-danger">@lang('messages.roles.has_comments')
                                </a>
                                <a href="{{route('manager.review.setStatus', [
                                            "statusId" => \App\Data\Helper\ProjectReviewStatus::Success,
                                            "projectId" => $project->id
                                ])}}" class="btn btn-sm btn-info">@lang('messages.roles.succssfully')
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row pb-3">
                        <div class="col-12 task-list">
                            @foreach($taskList as $task)
                                @include('Manager.Review._task', ['task' => $task])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal bd-example-modal-lg" tabindex="-1" role="dialog" id="taskReviewCommentListModal">
        <div class="modal-dialog modal-dialog-centered modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">@lang('messages.roles.comments')</h5>
                  <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="addTaskReviewCommentModal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">@lang('messages.roles.add_comment')</h5>
                  <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post"
                          action="{{route('manager.review.addComment')}}"
                          enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <input type="hidden" name="taskId" value=""/>
                        <div class="form-group">
                            <textarea class="form-control" name="comment" rows="5"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-12 col-lg-12 col-sm-12">
                                <button type="submit" class="btn btn-success float-right">
                                    Добавить
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        //activeTab('manager-review-list');

        $(function () {
            $(document).on('click', '.taskReviewCommentList', function () {
                var modal = $('#taskReviewCommentListModal');

                $.ajax({
                    type: 'GET',
                    url: '{!! route('manager.review.comments') !!}',
                    data: {
                        _token: '{!! csrf_token() !!}',
                        taskId: $(this).data('taskid')
                    },
                    success: function (data) {
                        $('.modal-body', modal).html(data);
                        modal.modal('show');
                    }
                });
            });
            $(document).on('click', '.taskReviewCommentAdd', function () {
                var modal = $('#addTaskReviewCommentModal');

                $('input[name="taskId"]', modal).val($(this).data('taskid'));
                $('textarea', modal).val('');

                modal.modal('show');
            });

        });
    </script>
@endsection
