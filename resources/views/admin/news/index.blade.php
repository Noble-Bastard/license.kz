@extends('new.layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <div class="title-main">
                    @lang('messages.admin.news.newses')

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-3">
                            <div class="col-12">
                                <a class="btn btn-success" href="{{route('admin.news.create')}}"><i
                                            class="fa fa-plus-square"></i> @lang('messages.all.add')</a>
                            </div>
                        </div>
                        <div>
                            <table id="news" class="table table-striped table-responsive-sm col-12">
                                <thead>
                                <tr>
                                    <th>@lang('messages.admin.news.header')</th>
                                    <th>@lang('messages.admin.news.news')</th>
                                    <th>@lang('messages.admin.news.news_is_actual')</th>
                                    <th>@lang('messages.all.order_num')</th>
                                    <th>@lang('messages.admin.countries.country')</th>
                                    <th>@lang('messages.all.actions')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($newsList as $news)
                                    <tr>
                                        <td>{{$news->header }}</td>
                                        <td>
                                            {!! App\Data\Helper\Assistant::subStrCutByWord(str_replace(array("\n","\r"), '', strip_tags($news->content)), 300) !!}
                                            ...
                                        </td>
                                        <td class="text-center">{{($news->is_actual  == 1) ? trans('messages.all.yes') : trans('messages.all.no')}}</td>
                                        <td>{{$news->orderNum }}</td>
                                        <td>{{$news->country_name }}</td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-success dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-bars"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item changePreviewPhoto" href="#"
                                                       data-news-id="{{$news->id}}">@lang('messages.all.previewPhoto')</a>
                                                    <a class="dropdown-item"
                                                       href="{{route('admin.news.edit', ['id' => $news->id])}}">@lang('messages.all.edit')</a>
                                                    <a class="dropdown-item"
                                                       href="{{route('admin.news.destroy', $news->id)}}"
                                                       data-method="delete">@lang('messages.all.delete')</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item"
                                                       href="{{route('admin.news.commentList', ['id' => $news->id])}}">@lang('messages.news.comments')</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row padding-t-15">
                                <div class="col">
                                    {{ $newsList->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="changePreviewPhotoModal" tabindex="-1" role="dialog"
             aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="form-horizontal" id="changePreviewPhotoForm" method="post"
                              action="{{route('admin.news.previewPhoto')}}"
                              enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <input type="hidden" name="newsId" id="newsId" value=""/>

                            <div class="form-group">
                                <label for="ClientRequestResponseTime">@lang('messages.all.previewPhoto')</label>
                                <input class="form-control" type="file" name="previewPhoto"/>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-12 col-lg-12 col-sm-12">
                                    <button type="submit" class="btn btn-success float-right">
                                        @lang('messages.all.set')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        //activeTab('news-list');

        $(function () {
            $(document).on('click', '.changePreviewPhoto', function (e) {
                let modal = $('#changePreviewPhotoModal');

                $('#newsId').val($(this).data('news-id'));

                modal.modal('show');
            });

            $('#changePreviewPhotoForm').submit(function () {
                $(this).ajaxSubmit({
                    success: function () {
                        $('#changePreviewPhotoModal').modal('hide');
                    }
                });

                return false;
            });
        })
    </script>
@endsection