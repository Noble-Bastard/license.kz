@extends('new.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 col-md-7 form">
            {!! Form::open(['url' => route('partner.form.store'), 'method' => 'post', 'class' => 'row form-horizontal', 'id'=>'partner_form', 'enctype'=>'multipart/form-data']) !!}
            <div class="col-12">
                <div class="row">
                    <div class="col-12 sub_title">
                        @lang('messages.partner_form.personal_information')
                    </div>

                    <div class="col-12">
                        {{--{{dd($errors)}}--}}
                        <div class="form-group row">
                            {!! Form::label('fio', trans('messages.partner_form.fio'), ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('fio', null, array_merge(['class' => $errors->has('fio') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}
                                @if ($errors->has('fio'))
                                    <span class="help-block invalid-feedback">
                                    <strong>{{ $errors->first('fio') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        {{--{{dd($errors)}}--}}
                        <div class="form-group row">
                            {!! Form::label('position', trans('messages.partner_form.position'), ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('position', null, array_merge(['class' => $errors->has('position') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}
                                @if ($errors->has('position'))
                                    <span class="help-block invalid-feedback">
                                    <strong>{{ $errors->first('position') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        {{--{{dd($errors)}}--}}
                        <div class="form-group row">
                            {!! Form::label('email', trans('messages.partner_form.email'), ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::email('email', null, array_merge(['class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}
                                @if ($errors->has('email'))
                                    <span class="help-block invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        {{--{{dd($errors)}}--}}
                        <div class="form-group row">
                            {!! Form::label('phone', trans('messages.partner_form.phone'), ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('phone', null, array_merge(['class' => $errors->has('phone') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}
                                @if ($errors->has('phone'))
                                    <span class="help-block invalid-feedback">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-12 sub_title">
                        @lang('messages.partner_form.company_information')
                    </div>

                    <div class="col-12">
                        {{--{{dd($errors)}}--}}
                        <div class="form-group row">
                            {!! Form::label('company_name', trans('messages.partner_form.company_name'), ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('company_name', null, array_merge(['class' => $errors->has('company_name') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}
                                @if ($errors->has('company_name'))
                                    <span class="help-block invalid-feedback">
                                    <strong>{{ $errors->first('company_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        {{--{{dd($errors)}}--}}
                        <div class="form-group row">
                            {!! Form::label('company_logo', trans('messages.partner_form.company_logo'), ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                <div class="form-group">

                                    <input type="file" class="custom-file-input form-control" name="company_logo">
                                    <label class="custom-file-label"
                                           for="validatedCustomFile">@lang('messages.all.choose_file')</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        {{--{{dd($errors)}}--}}
                        <div class="form-group row">
                            {!! Form::label('company_site', trans('messages.partner_form.company_site'), ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('company_site', null, array_merge(['class' => $errors->has('company_site') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}
                                @if ($errors->has('company_site'))
                                    <span class="help-block invalid-feedback">
                                    <strong>{{ $errors->first('company_site') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        {{--{{dd($errors)}}--}}
                        <div class="form-group row">
                            {!! Form::label('company_social', trans('messages.partner_form.company_social'), ['class' => 'col-12']) !!}
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    {!! Form::label('company_facebook', 'Facebook', ['class' => '']) !!}
                                    {!! Form::text('company_facebook', null, array_merge(['class' => $errors->has('company_facebook') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                                    @if ($errors->has('company_facebook'))
                                        <span class="help-block invalid-feedback">
                                            <strong>{{ $errors->first('company_facebook') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    {!! Form::label('company_instagram', 'Instagram', ['class' => '']) !!}
                                    {!! Form::text('company_instagram', null, array_merge(['class' => $errors->has('company_instagram') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                                    @if ($errors->has('company_instagram'))
                                        <span class="help-block invalid-feedback">
                                            <strong>{{ $errors->first('company_instagram') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group">
                                    {!! Form::label('company_linkedln', 'Linkedln', ['class' => '']) !!}
                                    {!! Form::text('company_linkedln', null, array_merge(['class' => $errors->has('company_linkedln') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

                                    @if ($errors->has('company_linkedln'))
                                        <span class="help-block invalid-feedback">
                                            <strong>{{ $errors->first('company_linkedln') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        {{--{{dd($errors)}}--}}
                        <div class="form-group row">
                            {!! Form::label('company_location', trans('messages.partner_form.company_location'), ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('company_location', null, array_merge(['class' => $errors->has('company_location') ? 'form-control feedback_city is-invalid' : 'form-control feedback_city',  'autofocus' => 'autofocus'])) !!}
                                @if ($errors->has('company_location'))
                                    <span class="help-block invalid-feedback">
                                    <strong>{{ $errors->first('company_location') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        {{--{{dd($errors)}}--}}
                        <div class="form-group row">
                            {!! Form::label('company_activity', trans('messages.partner_form.company_activity'), ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('company_activity', null, array_merge(['class' => $errors->has('company_activity') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}
                                @if ($errors->has('company_activity'))
                                    <span class="help-block invalid-feedback">
                                    <strong>{{ $errors->first('company_activity') }}</strong>
                                </span>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="col-12">
                        {{--{{dd($errors)}}--}}
                        <div class="form-group row">
                            {!! Form::label('company_phone', trans('messages.partner_form.company_phone'), ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('company_phone', null, array_merge(['class' => $errors->has('company_phone') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}
                                @if ($errors->has('company_phone'))
                                    <span class="help-block invalid-feedback">
                                    <strong>{{ $errors->first('company_phone') }}</strong>
                                </span>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="col-12">
                        {{--{{dd($errors)}}--}}
                        <div class="form-group row">
                            {!! Form::label('company_additionally', trans('messages.partner_form.company_additionally'), ['class' => 'col-sm-3 col-form-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('company_additionally', null, array_merge(['class' => $errors->has('company_additionally') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}
                                @if ($errors->has('company_additionally'))
                                    <span class="help-block invalid-feedback">
                                    <strong>{{ $errors->first('company_additionally') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-success float-right">{{trans('messages.all.send')}}</button>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="xs-hidden col-md-5">
            <img src="{{asset('images/partner.png')}}" class="img-fluid">
        </div>
    </div>
@endsection

@section('js')
    <script>
        //activeTab('partner');

        $(function () {
            $('.datepicker').datepicker();
        });
    </script>
@endsection