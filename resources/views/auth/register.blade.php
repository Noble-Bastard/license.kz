@extends('new.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mt-3">
                <h1 class="title-main">
                    @lang('messages.auth.registration')
                </h1>
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 col-md-10 mb-5">

                        <div class="title-sub">
                            @lang('messages.auth.for_comfort')
                        </div>
                        <div class="title-sub mb-4">
                            @lang('messages.auth.sign_up_to_enter')
                        </div>

                        <div class="title-sub">
                            @lang('messages.auth.choose_status')
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <a class="btn btn-success"
                                   id="pills-legalentity-tab"
                                   href="{{route('register', ['personType' => 'legal'])}}">
                                    @lang('messages.all.entity')
                                </a>
                                <a class="btn btn-success active"
                                   id="pills-individual-tab"
                                   href="{{route('register', ['personType' => 'individual'])}}">
                                    @lang('messages.all.individual')
                                </a>
                            </div>
                        </div>

                        {!! Form::open(['id'=>'legalentityForm1','url' => route('register'), 'method' => 'post', 'class' => 'form-horizontal']) !!}


                        <input name="profile_state_type_id" type="hidden"
                               value="{{\App\Data\Helper\ProfileStateTypeList::Idividual}}"/>


                        <div class="form-group">
                            {!! Form::label('full_name', trans('messages.all.full_name'), ['class' => 'col-form-label']) !!}

                            {!! Form::text('full_name', null, array_merge(['class' => $errors->has('full_name') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                            @if ($errors->has('full_name'))
                                <span class="help-block invalid-feedback">
                                                <strong>{{ $errors->first('full_name') }}</strong>
                                            </span>
                            @endif
                        </div>

                        <div class="form-row">
                            <div class="form-group col-6">
                                {!! Form::label('phone', trans('messages.all.phone'), ['class' => 'col-form-label', 'style' => 'display:block']) !!}

                                {!! Form::text('phone', null, array_merge(['class' => $errors->has('phone') ? 'form-control is-invalid phone' : 'form-control phone',  'autofocus' => 'autofocus'])) !!}
                                <span class="help-block invalid-feedback hide" id="error-msg">
        </span>
                                @if ($errors->has('phone'))
                                    <span class="help-block invalid-feedback">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                @endif
                            </div>

                            <div class="form-group col-6">
                                {{--                                    {!! Form::label('is_resident', trans('messages.all.is_resident'), ['class' => 'col-form-label']) !!}--}}

                                {{--                                    {!! Form::checkbox('is_resident', 1, array_merge(['class' => $errors->has('is_resident') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}--}}


                                <div class="custom-control custom-checkbox mt-5">
                                    <input type="checkbox" class="custom-control-input" id="is_resident"
                                           name="is_resident" checked>
                                    <label class="custom-control-label"
                                           for="is_resident">@lang('messages.all.is_resident')</label>
                                </div>


                                @if ($errors->has('is_resident'))
                                    <span class="help-block invalid-feedback">
                                            <strong>{{ $errors->first('is_resident') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('email', trans('messages.all.email_address'), ['class' => 'col-form-label']) !!}

                            {!! Form::email('email', null, array_merge(['class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                            @if ($errors->has('email'))
                                <span class="help-block invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                            @endif

                        </div>
                        <div class="form-group">
                            {!! Form::label('password', trans('messages.auth.password'), ['class' => 'col-form-label']) !!}

                            {!! Form::password('password', ['class' => $errors->has('password') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus']) !!}

                            @if ($errors->has('password'))
                                <span class="help-block invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('password_confirmation', trans('messages.auth.confirm_password'), ['class' => 'col-form-label']) !!}

                            {!! Form::password('password_confirmation', ['class' => $errors->has('password_confirmation') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus']) !!}

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block invalid-feedback">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                            @endif
                        </div>

                        <div class="form-row">
                            <div class="col-9">
                                <div class="form-check pl-0">
                                    <input type="checkbox" class="form-check-input" checked id="offerCheck">
                                    <label class="form-check-label" for="offerCheck">
                                        @lang('messages.pages.setPaymentType.i_accept_the_terms_of_the_public_offer_1')
                                        <a href="{{route("offer")}}" target="_blank">
                                            @lang('messages.pages.setPaymentType.i_accept_the_terms_of_the_public_offer_2')
                                        </a>
                                        {{--                                                @lang('messages.pages.setPaymentType.i_accept_the_terms_of_the_public_offer_3')--}}
                                        <span
                                                class="text-danger">*</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-3 text-end">
                                {!! Form::submit(trans('messages.all.submit'), ['class' => 'btn btn-success register_submit']) !!}
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
    <link rel="stylesheet" href="{{asset('libs/intl-tel-input/css/intlTelInput.min.css')}}">

    <style>
        .iti__flag {
            background-image: url({{asset('libs/intl-tel-input/img/flags.png')}});
        }

        @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
            .iti__flag {
                background-image: url({{asset('libs/intl-tel-input/img/flags@2x.png')}});
            }
        }
    </style>
@endsection
@section('js')
    <script src="{{asset('libs/intl-tel-input/js/intlTelInput.min.js')}}"></script>
    <script src="https://www.google.com/recaptcha/api.js?render={{ env('GOOGLE_RECAPTCHA_KEY') }}"></script>
    <script>

        let input = document.querySelector("#phone"),
            errorMsg = document.querySelector("#error-msg");

        // here, the index maps to the error code returned from getValidationError - see readme
        var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

        // initialise plugin
        var iti = window.intlTelInput(input, {
            utilsScript: "{{asset('libs/intl-tel-input/js/utils.js')}}"
        });

        var reset = function () {
            input.classList.remove("is-invalid");
            errorMsg.innerHTML = "";
            errorMsg.classList.add("hide");
            errorMsg.style.display = "none";
        };

        // on blur: validate
        input.addEventListener('blur', function () {
            reset();
            if (input.value.trim()) {
                if (!iti.isValidNumber()) {
                    input.classList.add("is-invalid");
                    var errorCode = iti.getValidationError();
                    errorMsg.innerHTML = errorMap[errorCode];
                    errorMsg.style.display = "block";
                }
            }
        });

        // on keyup / change flag: reset
        input.addEventListener('change', reset);
        input.addEventListener('keyup', reset);

        let input1 = document.querySelector("#phone"),
            errorMsg1 = document.querySelector("#error-msg");

        // initialise plugin
        var iti1 = window.intlTelInput(input1, {
            utilsScript: "{{asset('libs/intl-tel-input/js/utils.js')}}"
        });

        var reset1 = function () {
            input1.classList.remove("is-invalid");
            errorMsg1.innerHTML = "";
            errorMsg1.classList.add("hide");
            errorMsg1.style.display = "none";
        };

        // on blur: validate
        input1.addEventListener('blur', function () {
            reset1();
            if (input1.value.trim()) {
                if (!iti1.isValidNumber()) {
                    input1.classList.add("is-invalid");
                    var errorCode = iti.getValidationError();
                    errorMsg1.innerHTML = errorMap[errorCode];
                    errorMsg1.style.display = "block";
                }
            }
        });

        // on keyup / change flag: reset
        input1.addEventListener('change', reset);
        input1.addEventListener('keyup', reset);

        $("#business_identification_number")
            .mask("000000000000", {
                placeholder: "____________",
                translation: {
                    'Z': {
                        pattern: /[0-9]/, optional: true
                    }
                },
                onComplete: function (phone) {

                },
                onChange: function (phone) {

                }
            });

        $(document).on('change', '#offerCheck', function () {
            $('.register_submit').attr('disabled', !this.checked);
        })


        $(function () {
          $(document).on('submit', '#legalentityForm1', function (event) {
            event.preventDefault();

            grecaptcha.ready(function () {
              grecaptcha.execute("{{ env('GOOGLE_RECAPTCHA_KEY') }}", {action: 'submit'}).then(function (token) {
                $('#legalentityForm1').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
                $(document).off('submit', '#legalentityForm1')
                $('#legalentityForm1').unbind('submit').submit();
              });
            });
          });
        })
    </script>
@endsection
