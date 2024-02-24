@extends('new.layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <div class="title-main">
                    {{$article->type->name}}
                </div>
            </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    {!! Form::open(['url' => route('admin.article.update'), 'method' => 'put', 'class' => 'form-horizontal']) !!}
                    <input name="id" type="hidden" value="{{$article->id}}"/>

                    <div class="form-row">
                        {!! Form::label('country_id', trans('messages.admin.countries.country'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                        <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                            {!! Form::select('country_id', $countryList, $article->country_id, array_merge(['placeholder' => '', 'class' => $errors->has('country_id') ? 'form-control is-invalid' : 'form-control'])) !!}
                            @if ($errors->has('country_id'))
                                <span class="help-block invalid-feedback">
                                        <strong>{{ $errors->first('country_id') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        {!! Form::label('article_type', trans('messages.admin.article.type'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                        <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                            {!! Form::select('article_type', $articleTypeList, $article->article_type, array_merge(['placeholder' => '', 'class' => $errors->has('article_type') ? 'form-control is-invalid' : 'form-control'])) !!}
                            @if ($errors->has('article_type'))
                                <span class="help-block invalid-feedback">
                                        <strong>{{ $errors->first('article_type') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        {!! Form::label('content', trans('messages.admin.article.content'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                        <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                            {!! Form::textarea('content', $article->content, array_merge(['class' => $errors->has('content') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

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
                            {!! Form::textarea('content_en', $article->content_en, array_merge(['class' => $errors->has('content_en') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                            @if ($errors->has('content_en'))
                                <span class="help-block invalid-feedback">
                                    <strong>{!! $errors->first('content_en') !!}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        {!! Form::label('orderNum', trans('messages.admin.article.order_num'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                        <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                            {!! Form::text('orderNum', $article->orderNum, array_merge(['class' => $errors->has('orderNum') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

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
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('content', {
            filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
            filebrowserUploadUrl: '{{ route('ckfinder_connector') }}?command=QuickUpload&type=Files'
        });
        CKEDITOR.replace('content_en', {
            filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
            filebrowserUploadUrl: '{{ route('ckfinder_connector') }}?command=QuickUpload&type=Files'
        });

        //activeTab('article-list');
    </script>
@endsection
