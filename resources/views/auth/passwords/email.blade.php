@extends('new.layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title-main">
                    @lang('messages.auth.set_password')
                </h1>
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 col-md-10 mb-5">

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group">
                                {!! Form::label('email', trans('messages.auth.email_address'), ['class' => 'col-form-label', 'for' => 'email']) !!}
                                {!! Form::email('email', null, array_merge(['class' =>  $errors->has('email') ? 'form-control is-invalid' : 'form-control' ,  'autofocus', 'required'])) !!}

                                @if ($errors->has('email'))
                                    <span class="help-block invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="form-group text-end">
                                <button type="submit" class="btn btn-success">
                                    @lang('messages.auth.send_link')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
