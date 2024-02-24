@extends('new.layouts.app')

@section('content')
    <div class="services__get-license">
        <img class="position-absolute services__get-license__background"
             src="{{asset('/images/services/BG-first-part.png')}}">
        <img class="position-absolute services__get-license__background"
             src="{{asset('/images/services/BG-second-part.png')}}">
        <img class="position-absolute services__get-license__background"
             src="{{asset('/images/services/mobile-bg.png')}}">
        <div class="container">

            <div class="row services-background justify-content-center mt-5">
                <div class="col-12 text-justify">
                    <p>@lang('messages.pages.services-page.consultation.form.data1')</p>
                    <p>@lang('messages.pages.services-page.consultation.form.data1')</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <ol class="services__process-for-obtaining-license__timeline">
                        <li>
                            <h3>@lang('messages.pages.services-page.consultation.form.steps.step1.title')</h3>
                            <span class="services__process-for-obtaining-license__timeline__small-text">
                                @lang('messages.pages.services-page.consultation.form.steps.step1.detail')
                            </span>
                        </li>
                        <li>
                            <h3>@lang('messages.pages.services-page.consultation.form.steps.step2.title')</h3>
                            <span class="services__process-for-obtaining-license__timeline__small-text">
                                @lang('messages.pages.services-page.consultation.form.steps.step2.detail')
                            </span>
                        </li>
                        <li>
                            <h3>@lang('messages.pages.services-page.consultation.form.steps.step3.title')</h3>
                            <span class="services__process-for-obtaining-license__timeline__small-text">
                                @lang('messages.pages.services-page.consultation.form.steps.step3.detail')
                            </span>
                        </li>
                        <li>
                            <h3>@lang('messages.pages.services-page.consultation.form.steps.step4.title')</h3>
                            <span class="services__process-for-obtaining-license__timeline__small-text">
                                @lang('messages.pages.services-page.consultation.form.steps.step4.detail')
                            </span>
                        </li>
                        <li>
                            <h3>@lang('messages.pages.services-page.consultation.form.steps.step5.title')</h3>
                        </li>
                    </ol>
                </div>
                <div class="col-12 col-md-6">
                    <h4>Заполните форму</h4>
                    <form method="post" class="new_question" action="{{route('service.consultation.new_question')}}">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control {{ $errors->has('question') ? ' is-invalid' : '' }}" placeholder="Ваш вопрос" name="question"></textarea>

                            @if ($errors->has('question'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('question') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input class="form-control {{ $errors->has('activity') ? ' is-invalid' : '' }}" type="text" placeholder="Сфера деятельности (краткое описание)"
                                   name="activity"/>
                            @if ($errors->has('activity'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('activity') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" placeholder="Ф.И.О" name="name"/>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" type="tel" placeholder="Контактный телефон" name="phone"
                                   id="phone"/>
                            @if ($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group text-center">
                            <b class="text-primary">Стоимость услуги {{round(\App\Data\Core\Dal\SettingDal::getConsultationServiceCost())}} тенге</b>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-success" type="submit">Оплатить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="{{asset('/libs/jquery.inputmask.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('#phone').inputmask("+7 (999) 999-99-99");
        })
    </script>
@endsection