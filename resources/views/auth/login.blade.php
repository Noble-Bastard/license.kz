@extends('new.layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-12 mt-3">
                <div class="row justify-content-center align-items-center">
                    @php
                        $request = request()->create(redirect()->intended()->getTargetUrl());
                        $locale = app('laravellocalization')->getCurrentLocale() != 'ru' ? app('laravellocalization')->getCurrentLocale() : '';

                        $pathWithLocale = $request->getRequestUri();
                        if(substr($request->getRequestUri(), 1, 2) !== $locale){
                            $pathWithLocale = $locale . $request->getRequestUri();
                        }
                        if(app('router')->getRoutes()->match(app('request')->create($pathWithLocale))->getName() == 'Client.services.setPaymentType'){
                            session()->put('setPaymentType', $pathWithLocale);
                        }

                        session()->put('url.intended', $pathWithLocale);
                    @endphp
                    <div class="d-none">{{$pathWithLocale}}</div>
                    <div class="d-none">{{$pathWithLocale}}</div>
                    @if(app('router')->getRoutes()->match(app('request')->create($pathWithLocale))->getName() == 'Client.services.setPaymentType' || session()->has('setPaymentType'))
                        <div class="col-12 col-md-10 mb-3">
                        <hr/>
                        </div>
                        <div class="col-12 col-md-10 mb-3">
                            <h3 class="message-info text-center">
                                {{trans('messages.auth.generate_account_automate')}}
                            </h3>
                        </div>
                        <div class="col-12 col-md-10 mb-3">
                            <form method="post" id="formDownloadCommercialOffer"
                                  action="{{route('newPotentialClient')}}">
                                @csrf
                                <input type="hidden" name="setPaymentType" value="{{$pathWithLocale}}">
                                <div class="form-group">
                                    {!! Form::label('commercialOfferEmail', trans('messages.services.commercialOffer.non_auth_label'), ['class' => 'col-form-label', 'for' => 'commercialOfferEmail']) !!}
                                    {!! Form::email('commercialOfferEmail', null, array_merge(['class' =>  $errors->has('commercialOfferEmail') ? 'form-control is-invalid' : 'form-control' ,  'autofocus', 'required'])) !!}

                                    @if ($errors->has('commercialOfferEmail'))
                                        <span class="help-block invalid-feedback">
                                        <strong>{{ $errors->first('commercialOfferEmail') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::label('commercialOfferPhone', trans('messages.services.commercialOffer.phone'), ['class' => 'col-form-label', 'for' => 'commercialOfferPhone']) !!}
                                    {!! Form::text('commercialOfferPhone', null, array_merge(['class' =>  $errors->has('commercialOfferPhone') ? 'form-control is-invalid' : 'form-control' ,  'autofocus', 'required'])) !!}

                                    @if ($errors->has('commercialOfferPhone'))
                                        <span class="help-block invalid-feedback">
                                        <strong>{{ $errors->first('commercialOfferPhone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::label('commercialOfferName', trans('messages.services.commercialOffer.name'), ['class' => 'col-form-label', 'for' => 'commercialOfferName']) !!}
                                    {!! Form::text('commercialOfferName', null, array_merge(['class' =>  $errors->has('commercialOfferName') ? 'form-control is-invalid' : 'form-control' ,  'autofocus', 'required'])) !!}

                                    @if ($errors->has('commercialOfferName'))
                                        <span class="help-block invalid-feedback">
                                        <strong>{{ $errors->first('commercialOfferName') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="text-center text-md-right mt-3">
                                    <button type="submit"
                                            class="btn btn-success">{{trans('messages.all.send')}}</button>
                                </div>
                            </form>
                            <div class="row mt-5 mb-5 justify-content-center align-items-center" id="formDownloadCommercialOfferSuccess" style="display: none">
                              <div class="col-12 col-md-10 text-center">
                                @lang('messages.client.service_create')
                              </div>
                            </div>
                        </div>
                    @endif
                </div>
                <h1 class="title-main">
                    @lang('messages.auth.authorization')
                </h1>
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 col-md-10 mb-3">
                        <span class="message-info">
                            {{trans('messages.auth.create_account')}}
                        </span>
                    </div>
                    <div class="col-12 col-md-10">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
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

                            <div class="form-group">
                                {!! Form::label('password', trans('messages.auth.password'), ['class' => 'col-form-label', 'for' => 'password']) !!}
                                {!! Form::password('password', array_merge(['class' =>  $errors->has('password') ? 'form-control is-invalid' : 'form-control' ,  'autofocus', 'required'])) !!}

                                @if ($errors->has('password'))
                                    <span class="help-block invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group mt-3">
                                <a href="{{ route('register') }}"
                                   class="btn btn-success mb-3">@lang('messages.auth.registration')</a>

                                <button type="submit" class="btn btn-success float-right mb-3">
                                    @lang('messages.auth.login')
                                </button>

                                <a class="btn btn-link float-right mr-3" href="{{ route('password.request') }}">
                                    @lang('messages.auth.forgot_password')
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
  <script>
    $(function () {
      $('#formDownloadCommercialOffer').submit(function () {
        $(this).ajaxSubmit({
          success: function () {

          }
        })

        $(this).hide()
        $('#formDownloadCommercialOfferSuccess').show()

        event.preventDefault();
      })
    })
  </script>
@endsection
