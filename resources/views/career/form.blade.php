@extends('new.layouts.app')

@section('content')
    {!! Form::open(['url' => route('career.form.store'), 'method' => 'post', 'class' => 'form-horizontal', 'id'=>'career_form', 'enctype'=>'multipart/form-data']) !!}
    <div class="col-12">
        <div class="row">
            <div class="col-12 col-md-6">
                {{--{{dd($errors)}}--}}
                <div class="form-group">
                    {!! Form::label('fio', trans('messages.career_form.fio'), ['class' => '']) !!}
                    {!! Form::text('fio', null, array_merge(['class' => $errors->has('fio') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus', 'enctype'=>'multipart/form-data'])) !!}

                    @if ($errors->has('fio'))
                        <span class="help-block invalid-feedback">
                                <strong>{{ $errors->first('fio') }}</strong>
                            </span>
                    @endif
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div>
                    {!! Form::label('photo', trans('messages.career_form.photo_path'), ['class' => '']) !!}
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">

                            <input type="file" class="custom-file-input form-control" name="photo">
                            <label class="custom-file-label"
                                   for="validatedCustomFile">@lang('messages.all.choose_file')</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    {!! Form::label('dob', trans('messages.career_form.dob'), ['class' => '']) !!}

                    <div class="input-group">
                        {!! Form::text('dob', null, array_merge(['class' => $errors->has('dob') ? 'form-control datepicker is-invalid' : 'form-control datepicker',  'autofocus' => 'autofocus'])) !!}
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                    </div>

                    @if ($errors->has('dob'))
                        <span class="help-block invalid-feedback">
                                <strong>{{ $errors->first('dob') }}</strong>
                            </span>
                    @endif

                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    {!! Form::label('desired_position', trans('messages.career_form.desired_position'), ['class' => '']) !!}
                    {!! Form::text('desired_position', null, array_merge(['class' => $errors->has('desired_position') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                    @if ($errors->has('desired_position'))
                        <span class="help-block invalid-feedback">
                                <strong>{{ $errors->first('desired_position') }}</strong>
                            </span>
                    @endif

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 panel-block">
                <div class="row">
                    <div class="col-8">
                        <h6>@lang('messages.career_form.career_form_education.title')</h6>
                    </div>
                    <div class="col-4">
                        <button type="button"
                                class="btn btn-success btn-sm float-right addBlock">@lang('messages.all.add')</button>
                    </div>
                </div>
                @include('career._education_place', ['n' => null, 'default' => true])
                <div class="row card-body">
                    <div class="col-12">
                        @if(!is_null(\Illuminate\Support\Facades\Input::old('education_place')))
                            @foreach(\Illuminate\Support\Facades\Input::old('education_place') as $n => $item)
                                @include('career._education_place', ['default' => false])
                            @endforeach
                        @else
                            @include('career._education_place', ['n' => null, 'default' => false])
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 panel-block">
                <div class="row">
                    <div class="col-8">
                        <h6>@lang('messages.career_form.career_form_experience.title')</h6>
                    </div>
                    <div class="col-4">
                        <button type="button"
                                class="btn btn-success btn-sm float-right addBlock">@lang('messages.all.add')</button>
                    </div>
                </div>
                @include('career._experience', ['n' => null, 'default' => true])
                <div class="row card-body">
                    <div class="col-12">
                        @if(!is_null(\Illuminate\Support\Facades\Input::old('experience_place')))
                            @foreach(\Illuminate\Support\Facades\Input::old('experience_place') as $n => $item)
                                @include('career._experience', ['default' => false])
                            @endforeach
                        @else
                            @include('career._experience', ['n' => null, 'default' => false])
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 panel-block">
                <div class="row">
                    <div class="col-8">
                        <h6>@lang('messages.career_form.career_form_lang_knowledge.title')</h6>
                    </div>
                    <div class="col-4">
                        <button type="button"
                                class="btn btn-success btn-sm float-right addBlock">@lang('messages.all.add')</button>
                    </div>
                </div>
                @include('career._lang_knowledge', ['n' => null, 'default' => true])
                <div class="row card-body">
                    <div class="col-12">
                        @if(!is_null(\Illuminate\Support\Facades\Input::old('lang_knowledge_lang_name')))
                            @foreach(\Illuminate\Support\Facades\Input::old('lang_knowledge_lang_name') as $n => $item)
                                @include('career._lang_knowledge', ['default' => false])
                            @endforeach
                        @else
                            @include('career._lang_knowledge', ['n' => null, 'default' => false])
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 panel-block">
                <h6>@lang('messages.career_form.career_form_editor_speed.title')</h6>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-6 col-sm-3">
                        {!! Form::label('desired_position', 'Word', ['class' => '']) !!}
                        {!! Form::number('word_editor_speed', null, array_merge(['class' => $errors->has('word_editor_speed') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus', 'min' => '1', 'max' => '10'])) !!}
                        @if ($errors->has('word_editor_speed'))
                            <span class="help-block invalid-feedback">
                                <strong>{{ $errors->first('word_editor_speed') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-6 col-sm-3">
                        {!! Form::label('desired_position', 'Excel', ['class' => '']) !!}
                        {!! Form::number('excel_editor_speed', null, array_merge(['class' => $errors->has('excel_editor_speed') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus', 'min' => '1', 'max' => '10'])) !!}
                        @if ($errors->has('excel_editor_speed'))
                            <span class="help-block invalid-feedback">
                                <strong>{{ $errors->first('excel_editor_speed') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <div class="form-group">
                    {!! Form::label('useful_skills', trans('messages.career_form.useful_skills'), ['class' => '']) !!}
                    {!! Form::text('useful_skills', null, array_merge(['class' => $errors->has('useful_skills') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                    @if ($errors->has('useful_skills'))
                        <span class="help-block invalid-feedback">
                                <strong>{{ $errors->first('useful_skills') }}</strong>
                            </span>
                    @endif
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    {!! Form::label('books_read_cnt', trans('messages.career_form.books_read_cnt'), ['class' => '']) !!}
                    {!! Form::number('books_read_cnt', null, array_merge(['class' => $errors->has('books_read_cnt') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                    @if ($errors->has('books_read_cnt'))
                        <span class="help-block invalid-feedback">
                                <strong>{{ $errors->first('books_read_cnt') }}</strong>
                            </span>
                    @endif
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    {!! Form::label('sport_attitude', trans('messages.career_form.sport_attitude'), ['class' => '']) !!}
                    {!! Form::text('sport_attitude', null, array_merge(['class' => $errors->has('sport_attitude') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                    @if ($errors->has('sport_attitude'))
                        <span class="help-block invalid-feedback">
                                <strong>{{ $errors->first('sport_attitude') }}</strong>
                            </span>
                    @endif
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    {!! Form::label('self_describe', trans('messages.career_form.self_describe'), ['class' => '']) !!}
                    {!! Form::text('self_describe', null, array_merge(['class' => $errors->has('self_describe') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                    @if ($errors->has('self_describe'))
                        <span class="help-block invalid-feedback">
                                <strong>{{ $errors->first('self_describe') }}</strong>
                            </span>
                    @endif
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    {!! Form::label('contribute_development', trans('messages.career_form.contribute_development'), ['class' => '']) !!}
                    {!! Form::text('contribute_development', null, array_merge(['class' => $errors->has('contribute_development') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                    @if ($errors->has('contribute_development'))
                        <span class="help-block invalid-feedback">
                                <strong>{{ $errors->first('contribute_development') }}</strong>
                            </span>
                    @endif
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    {!! Form::label('self_see', trans('messages.career_form.self_see'), ['class' => '']) !!}
                    {!! Form::text('self_see', null, array_merge(['class' => $errors->has('self_see') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                    @if ($errors->has('self_see'))
                        <span class="help-block invalid-feedback">
                                <strong>{{ $errors->first('self_see') }}</strong>
                            </span>
                    @endif
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    {!! Form::label('salary', trans('messages.career_form.salary'), ['class' => '']) !!}
                    {!! Form::number('salary', null, array_merge(['class' => $errors->has('salary') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                    @if ($errors->has('salary'))
                        <span class="help-block invalid-feedback">
                                <strong>{{ $errors->first('salary') }}</strong>
                            </span>
                    @endif
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    {!! Form::label('want_our_team', trans('messages.career_form.want_our_team'), ['class' => '']) !!}
                    {!! Form::text('want_our_team', null, array_merge(['class' => $errors->has('want_our_team') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                    @if ($errors->has('want_our_team'))
                        <span class="help-block invalid-feedback">
                                <strong>{{ $errors->first('want_our_team') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-group">
                    {!! Form::label('city_location', trans('messages.career_form.city_location'), ['class' => '']) !!}
                    {!! Form::text('city_location', null, array_merge(['class' => $errors->has('city_location') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                    @if ($errors->has('city_location'))
                        <span class="help-block invalid-feedback">
                                <strong>{{ $errors->first('city_location') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-group">
                    {!! Form::label('social_status', trans('messages.career_form.social_status'), ['class' => '']) !!}
                    {!! Form::text('social_status', null, array_merge(['class' => $errors->has('social_status') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                    @if ($errors->has('social_status'))
                        <span class="help-block invalid-feedback">
                                <strong>{{ $errors->first('social_status') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-group">
                    {!! Form::label('phone', trans('messages.career_form.phone'), ['class' => '']) !!}
                    {!! Form::text('phone', null, array_merge(['class' => $errors->has('phone') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                    @if ($errors->has('phone'))
                        <span class="help-block invalid-feedback">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-group">
                    {!! Form::label('email', trans('messages.career_form.email'), ['class' => '']) !!}
                    {!! Form::text('email', null, array_merge(['class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                    @if ($errors->has('email'))
                        <span class="help-block invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <h6>@lang('messages.career_form.career_form_social.title')</h6>
            </div>
            <div class="col-12 col-sm-4">
                <div class="form-group">
                    {!! Form::label('facebook', 'Facebook', ['class' => '']) !!}
                    {!! Form::text('facebook', null, array_merge(['class' => $errors->has('facebook') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                    @if ($errors->has('facebook'))
                        <span class="help-block invalid-feedback">
                                <strong>{{ $errors->first('facebook') }}</strong>
                            </span>
                    @endif
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="form-group">
                    {!! Form::label('instagram', 'Instagram', ['class' => '']) !!}
                    {!! Form::text('instagram', null, array_merge(['class' => $errors->has('instagram') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                    @if ($errors->has('instagram'))
                        <span class="help-block invalid-feedback">
                                <strong>{{ $errors->first('instagram') }}</strong>
                            </span>
                    @endif
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="form-group">
                    {!! Form::label('linkedln', 'Linkedln', ['class' => '']) !!}
                    {!! Form::text('linkedln', null, array_merge(['class' => $errors->has('linkedln') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                    @if ($errors->has('linkedln'))
                        <span class="help-block invalid-feedback">
                                <strong>{{ $errors->first('linkedln') }}</strong>
                            </span>
                    @endif
                </div>
            </div>

        </div>

    </div>
    <div class="col-12 mt-3">
        <button type="submit" class="btn btn-success float-right">{{trans('messages.all.send')}}</button>
    </div>
    {!! Form::close() !!}

@endsection

@section('js')
    <script>
        //activeTab('career');

        $(function () {
            $('.datepicker').datepicker();

            $('.addBlock').click(function () {
                let block = $($(this).parents('.panel-block')[0]);
                let body = $('.card-body>.col-12', block).append($('.panel-default', block).clone());

                $('.panel-default', body).removeClass('d-none').removeClass('panel-default');

                $('.datepicker', body).datepicker();
            });

            $(document).on('click', '.deleteBlock', function () {
                $($(this).parents('.row')[0]).remove();
            });

            $('#career_form').submit(function(){
                $('.panel-default').remove();
                return true;
            })
        });
    </script>
@endsection