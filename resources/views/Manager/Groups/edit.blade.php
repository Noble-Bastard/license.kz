@extends('new.layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="title-main">{{$executorGroup->name }}

        </div>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-body">

            {!! Form::open(['url' => route('Manager.groups.update',$executorGroup->id), 'method' => 'put', 'class' => 'form-horizontal']) !!}
            <input name="id" type="hidden" value="{{$executorGroup->id}}"/>

            <div class="form-row">
              {!! Form::label('name', trans('messages.manager.name', ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label'])) !!}
              <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                {!! Form::text('name', $executorGroup->name, array_merge(['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                @if ($errors->has('name'))
                  <span class="help-block invalid-feedback">
                                    <strong>{!! $errors->first('name') !!}</strong>
                                </span>
                @endif
              </div>
            </div>

            <div class="form-row">
              <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9">
                {!! Form::submit(trans('messages.all.change'), ['class' => 'btn btn-success']) !!}
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
    //activeTab('manager-groups-list');
  </script>
@endsection
