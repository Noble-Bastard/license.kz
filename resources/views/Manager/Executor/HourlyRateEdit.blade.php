@extends('new.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="title-main">{{$executor->full_name }}

                </div>

                <div class="card-body">

                    {!! Form::open(['url' => route('Manager.executor.setHourlyRate',$executor->id), 'method' => 'put', 'class' => 'form-horizontal']) !!}
                    <input name="id" type="hidden" value="{{$executor->id}}"/>

                    <div class="form-row">
                        {!! Form::label('hourly_rate', trans('messages.manager.hourly_rate'), ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                        <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                            {!! Form::text('hourly_rate', null, array_merge(['class' => $errors->has('hourly_rate') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                            @if ($errors->has('hourly_rate'))
                                <span class="help-block invalid-feedback">
                                    <strong>{{ $errors->first('hourly_rate') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>



                    <div class="form-row">
                        <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9">
                            <submitfiled>{!! Form::submit('Установить ставку', ['class' => 'btn btn-success']) !!}</submitfiled>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        //activeTab('manager-executor-list');
    </script>
@endsection
