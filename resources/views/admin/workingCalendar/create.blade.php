@extends('new.layouts.app')

@section('content')

    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <div class="title-main">
                    @lang('messages.all.creat')
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['url' => route('admin.workingCalendar.store'), 'method' => 'post', 'class' => 'form-horizontal']) !!}
                        <input name="id" type="hidden" value=""/>


                        <div class="form-row">
                            {!! Form::label('decsription', trans('messages.all.decsription'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                            <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                                {!! Form::text('decsription', null, array_merge(['class' => $errors->has('decsription') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                                @if ($errors->has('decsription'))
                                    <span class="help-block invalid-feedback">
                                    <strong>{!! $errors->first('decsription') !!}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            {!! Form::label('start_date', trans('messages.admin.workingCalendar.start_date'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                            <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                                {!! Form::text('start_date', null, array_merge(['class' => $errors->has('start_date') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus','data-provide'=>'datepicker'])) !!}

                                @if ($errors->has('start_date'))
                                    <span class="help-block invalid-feedback">
                                    <strong>{!! $errors->first('start_date') !!}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            {!! Form::label('end_date', trans('messages.admin.workingCalendar.end_date'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                            <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                                {!! Form::text('end_date', null, array_merge(['class' => $errors->has('end_date') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus','data-provide'=>'datepicker'])) !!}

                                @if ($errors->has('end_date'))
                                    <span class="help-block invalid-feedback">
                                    <strong>{!! $errors->first('end_date') !!}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            {!! Form::label('aps_day_type_id', trans('messages.admin.workingCalendar.type'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                            <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                                {!! Form::select('aps_day_type_id', $dayTypeList, null, array_merge(['placeholder' => '', 'class' => $errors->has('country_id') ? 'form-control is-invalid' : 'form-control'])) !!}
                                @if ($errors->has('aps_day_type_id'))
                                    <span class="help-block invalid-feedback">
                                        <strong>{{ $errors->first('aps_day_type_id') }}</strong>
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
@section('css')
    <link href="{{asset('libs/font-awesome/css/all.min.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('js')
    <script>
        //activeTab('workingCalendar-list');

        $("#start_date").datepicker({
            format: 'yyyy-mm-dd',
            zIndexOffset: 9999
        }).on('changeDate', function (selected) {
            let minDate = new Date(selected.date.valueOf());
            $("#end_date").prop('disabled', false);
            $('#end_date').datepicker('setStartDate', minDate);
            $("#end_date").datepicker('setDate', $("#start_date").val());
        });

        $("#end_date").prop('disabled', true);
        $("#end_date").datepicker({
            format: 'yyyy-mm-dd',
            zIndexOffset: 9999
        });

    </script>
@endsection