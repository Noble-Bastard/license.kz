@extends('new.layouts.app')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-12">
                <div class="title-main">@lang('messages.manager.group_creation')

                </div>
            </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['url' => route('Manager.groups.store'), 'method' => 'post', 'class' => 'form-horizontal']) !!}
                    <input name="id" type="hidden" value=""/>

                    <div class="form-row">
                        {!! Form::label('name', trans('messages.manager.name'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
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
