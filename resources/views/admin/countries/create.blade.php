@extends('new.layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <div class="title-main">
                    @lang('messages.admin.countries.create_country')
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['url' => route('admin.countries.store'), 'method' => 'post', 'class' => 'form-horizontal']) !!}
                        <input name="id" type="hidden" value=""/>
                        <div class="form-row">
                            {!! Form::label('code', trans('messages.admin.countries.country_code'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                            <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                                {!! Form::text('code', null, array_merge(['class' => $errors->has('code') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                                @if ($errors->has('code'))
                                    <span class="help-block invalid-feedback">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            {!! Form::label('name', trans('messages.admin.countries.country_name'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                            <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                                {!! Form::text('name', null, array_merge(['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                                @if ($errors->has('name'))
                                    <span class="help-block invalid-feedback">
                                    <strong>{!! $errors->first('name') !!}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            {!! Form::label('name_en', trans('messages.admin.countries.country_name_en'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                            <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                                {!! Form::text('name_en', null, array_merge(['class' => $errors->has('name_en') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                                @if ($errors->has('name_en'))
                                    <span class="help-block invalid-feedback">
                                    <strong>{!! $errors->first('name_en') !!}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            {!! Form::label('is_visible', trans('messages.all.is_visible'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                            <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                                {!! Form::checkbox('is_visible', null, array_merge(['class' => ''])) !!}

                                @if ($errors->has('is_visible'))
                                    <span class="help-block invalid-feedback">
                                    <strong>{!! $errors->first('is_visible') !!}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9">
                                <submitfiled>{!! Form::submit(trans('messages.all.submit'), ['class' => 'btn btn-success']) !!}</submitfiled>
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
        //activeTab('countries-list');
    </script>
@endsection