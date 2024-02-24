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
                                <a class="btn btn-success active"
                                   id="pills-legalentity-tab"
                                   href="{{route('register', ['personType' => 'legal'])}}">
                                    @lang('messages.all.entity')
                                </a>
                                <a class="btn btn-success"
                                   id="pills-individual-tab"
                                   href="{{route('register', ['personType' => 'individual'])}}">
                                    @lang('messages.all.individual')
                                </a>
                            </div>
                        </div>

                        {!! Form::open(['id'=>'legalentityForm','url' => route('register'), 'method' => 'post', 'class' => 'form-horizontal']) !!}

                        @include('_legalProfileCard', ["isNewProfile" => true,  'autoFocus' => true, "profileLegal" => new \App\Data\Core\Model\ProfileExt()])

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
          $(document).on('submit', '#legalentityForm', function (event) {
            event.preventDefault();

            grecaptcha.ready(function () {
              grecaptcha.execute("{{ env('GOOGLE_RECAPTCHA_KEY') }}", {action: 'subscribe_register'}).then(function (token) {
                $('#legalentityForm').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
                $(document).off('submit', '#legalentityForm')
                $('#legalentityForm').unbind('submit').submit();
              });
            });
          });
        })
    </script>
@endsection
