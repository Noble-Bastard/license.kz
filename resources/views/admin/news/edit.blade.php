@extends('new.layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <div class="title-main">
                    {{$news->header }}
                </div>
            </div>
        </div>
        <div class="row mb-5 justify-content-center align-items-center">
            <div class="col-12 col-md-10">
                <div class="card">

                    <div class="card-body">

                        {!! Form::open(['url' => route('admin.news.update',$news->id), 'method' => 'put', 'class' => 'form-horizontal']) !!}
                        <input name="id" type="hidden" value="{{$news->id}}"/>

                        <div class="form-row">
                            {!! Form::label('country_id', trans('messages.admin.countries.country'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                            <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                                {!! Form::select('country_id', $countryList, $news->country_id, array_merge(['placeholder' => '', 'class' => $errors->has('country_id') ? 'form-control is-invalid' : 'form-control'])) !!}
                                @if ($errors->has('country_id'))
                                    <span class="help-block invalid-feedback">
                                        <strong>{{ $errors->first('country_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            {!! Form::label('header', trans('messages.admin.news.header'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                            <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                                {!! Form::text('header', $news->header, array_merge(['class' => $errors->has('header') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                                @if ($errors->has('header'))
                                    <span class="help-block invalid-feedback">
                                    <strong>{{ $errors->first('header') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            {!! Form::label('header_en', trans('messages.admin.news.header_en'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                            <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                                {!! Form::text('header_en', $news->header_en, array_merge(['class' => $errors->has('header') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                                @if ($errors->has('header_en'))
                                    <span class="help-block invalid-feedback">
                                    <strong>{{ $errors->first('header_en') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-row">
                            {!! Form::label('content', trans('messages.admin.news.content'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                            <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                                {!! Form::textarea('content', $news->content, array_merge(['class' => $errors->has('content') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                                @if ($errors->has('content'))
                                    <span class="help-block invalid-feedback">
                                    <strong>{!! $errors->first('content') !!}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            {!! Form::label('content_en', trans('messages.admin.news.content_en'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                            <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                                {!! Form::textarea('content_en', $news->content_en, array_merge(['class' => $errors->has('content_en') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                                @if ($errors->has('content_en'))
                                    <span class="help-block invalid-feedback">
                                    <strong>{!! $errors->first('content_en') !!}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            {!! Form::label('news_is_actual', trans('messages.admin.news.news_is_actual'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                            <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                                {!! Form::checkbox('news_is_actual', $news->is_actual, ($news->is_actual  == 1), array_merge(['class' => ''])) !!}
                            </div>
                        </div>
                        <div class="form-row">
                            {!! Form::label('orderNum', trans('messages.all.order_num'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                            <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                                {!! Form::text('orderNum', $news->orderNum, array_merge(['class' => $errors->has('orderNum') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                                @if ($errors->has('orderNum'))
                                    <span class="help-block invalid-feedback">
                                    <strong>{{ $errors->first('orderNum') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9">
                                <submitfiled>{!! Form::submit(trans('messages.all.change'), ['class' => 'btn btn-success']) !!}</submitfiled>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        CKEDITOR.replace('content', {
            filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
            filebrowserUploadUrl: '{{ route('ckfinder_connector') }}?command=QuickUpload&type=Files'
        });
        CKEDITOR.replace('content_en', {
            filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
            filebrowserUploadUrl: '{{ route('ckfinder_connector') }}?command=QuickUpload&type=Files'
        });

        //activeTab('news-list');
    </script>
@endsection
