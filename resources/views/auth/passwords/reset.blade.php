@extends('new.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title-main">
                    @lang('messages.auth.change_password')
                </h1>
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 col-md-10 mb-5">

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                {!! Form::label('email', trans('messages.auth.email_address'), ['class' => 'col-form-label', 'for' => 'email']) !!}
                                {!! Form::email('email', $email, array_merge(['class' =>  $errors->has('email') ? 'form-control is-invalid' : 'form-control' ,  'readonly'])) !!}

                                @if ($errors->has('email'))
                                    <span class="help-block invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="form-group">
                                {!! Form::label('password', trans('messages.auth.password'), ['class' => 'col-form-label', 'for' => 'password']) !!}
                                {!! Form::password('password', array_merge(['class' =>  $errors->has('password') ? 'form-control is-invalid' : 'form-control', 'autofocus', 'required'])) !!}

                                @if ($errors->has('password'))
                                    <span class="help-block invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="form-group">
                                {!! Form::label('password_confirmation', trans('messages.auth.confirm_password'), ['class' => 'col-form-label', 'for' => 'password_confirmation']) !!}
                                {!! Form::password('password_confirmation', array_merge(['class' =>  $errors->has('password_confirmation') ? 'form-control is-invalid' : 'form-control', 'autofocus', 'required'])) !!}



                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block invalid-feedback">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group text-end">
                                <button type="submit" class="btn btn-success">
                                    @lang('messages.auth.change_password')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
