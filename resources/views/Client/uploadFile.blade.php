{{--@extends('new.layouts.app')--}}

{{--@section('content')--}}
<div class="card">
    <div class="card-body">
        <div class="preamble">
            <p class="text-center">@lang('messages.client.here_download_files')</p>
            <p class="text-center">
                <button type="button" class="btn btn-success uploadFilesModalOpen">@lang('messages.client.download_files')</button>
            </p>
        </div>
    </div>
</div>
<div class="modal fade" id="uploadfiles" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">@lang('messages.client.download_in_process')</h5>
              <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn-close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="{{route('profile.document.add')}}"
                      enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class="form-row">
                        <label for="doc" class="col-xl-3 col-lg-3 col-sm-3 control-label">@lang('messages.client.path')</label>
                        <div class="col-xl-9 col-lg-9 col-sm-9 elementinline pb-3">
                            <input class="form-control" type="file" name="doc"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="docName" class="col-xl-3 col-lg-3 col-sm-3 control-label">@lang('messages.all.decsription')</label>
                        <div class="col-xl-9 col-lg-9 col-sm-9 elementinline pb-3">
                            <input class="form-control" type="text" name="docName"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-xl-12 col-lg-12 col-sm-12">
                            <button type="submit" class="btn btn-success">
                                @lang('messages.client.upload')
                            </button>
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
{{--@endsection--}}
@section('js')
    @parent
    <script>
        $(function () {
            $(document).on('click', '.uploadFilesModalOpen', function (e) {
                var modal = $('#uploadfiles');
                modal.modal('show');
            });

            $('#uploadfiles form').submit(function() {
                $(this).ajaxSubmit({
                    success: function(data){
                        $('.document-list').html(data);

                        $('#uploadfiles').modal('hide');
                    }
                });

                return false;
            });
        });
    </script>
@endsection

