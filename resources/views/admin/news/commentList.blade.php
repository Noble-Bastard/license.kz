@extends('new.layouts.app')

@section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="title-main">@lang('messages.news.comments')

                    </div>

                    <div class="card-body">
                        <div class="row pb-3">
                            <div class="col-12">
                                <h5>{{$news->header}}</h5>
                            </div>
                        </div>
                        <div>
                            <div class="row mt-5">
                                <div class="col-12 comments">
                                    @include('admin.news._newsCommentList', ['commentList' => $news->comments, 'currentId' => null, 'currentLevel' => 0])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('js')
    <script>
        //activeTab('news-list');

        $(document).on('click', '.delete-comment', function(){
            $.ajax({
                type: 'POST',
                url: '{{route('admin.news.deleteComment')}}',
                data: {
                    '_token': "{{ csrf_token() }}",
                    'commentId': $(this).data('comment-id')
                },
                success: function (data) {
                    $('.comments').html(data);
                }
            });
        });
    </script>
@endsection