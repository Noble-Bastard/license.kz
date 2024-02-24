@if(!is_null($n))
    <div class="row border pt-2 pb-2 mt-2">
        @if($n > 0)
            <div class="col-12">
                <button type="button" class="btn btn-danger btn-sm float-right deleteBlock">@lang('messages.all.delete')</button>
            </div>
        @endif
        <div class="col-12 col-sm-6">
            {!! Form::label('education_place', trans('messages.career_form.career_form_education.place'), ['class' => '']) !!}
            {!! Form::text('education_place['.$n.']', null, array_merge(['class' => $errors->has('education_place.'.$n) ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}
            @if ($errors->has('education_place.'.$n))
                <span class="help-block invalid-feedback">
                <strong>{{ $errors->first('education_place.'.$n) }}</strong>
            </span>
            @endif
        </div>
        <div class="col-12 col-sm-3">
            {!! Form::label('education_start', trans('messages.career_form.career_form_education.start'), ['class' => '']) !!}
            <div class="input-group">
                {!! Form::text('education_start['.$n.']', null, array_merge(['class' => $errors->has('education_start.'.$n) ? 'form-control datepicker is-invalid' : 'form-control datepicker',  'autofocus' => 'autofocus'])) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
            </div>
            @if ($errors->has('education_start.'.$n))
                <span class="help-block invalid-feedback">
                    <strong>{{ $errors->first('education_start.'.$n) }}</strong>
                </span>
            @endif
        </div>
        <div class="col-12 col-sm-3">
            {!! Form::label('education_end', trans('messages.career_form.career_form_education.end'), ['class' => '']) !!}
            <div class="input-group">
                {!! Form::text('education_end['.$n.']', null, array_merge(['class' => $errors->has('education_end.'.$n) ? 'form-control datepicker is-invalid' : 'form-control datepicker',  'autofocus' => 'autofocus'])) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
            </div>
            @if ($errors->has('education_end.'.$n))
                <span class="help-block invalid-feedback">
                    <strong>{{ $errors->first('education_end.'.$n) }}</strong>
                </span>
            @endif
        </div>
        <div class="col-12">
            {!! Form::label('education_description', trans('messages.career_form.career_form_education.description'), ['class' => '']) !!}
            {!! Form::text('education_description['.$n.']', null, array_merge(['class' => $errors->has('education_description.'.$n) ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}
            @if ($errors->has('education_description.'))
                <span class="help-block invalid-feedback">
                    <strong>{{ $errors->first('education_description.'.$n) }}</strong>
                </span>
            @endif
        </div>
    </div>
@else
    <div class="row border pt-2 pb-2 mt-2 {{$default ? 'd-none panel-default' : ''}}">
        @if($default)
            <div class="col-12">
                <button type="button" class="btn btn-danger btn-sm float-right deleteBlock">@lang('messages.all.delete')</button>
            </div>
        @endif
        <div class="col-12 col-sm-6">
            {!! Form::label('education_place', trans('messages.career_form.career_form_education.place'), ['class' => '']) !!}
            {!! Form::text('education_place[]', null, array_merge(['class' => $errors->has('education_place') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}
        </div>
        <div class="col-12 col-sm-3">
            {!! Form::label('desired_position', trans('messages.career_form.career_form_education.start'), ['class' => '']) !!}
            <div class="input-group">
                <input type="text" name="education_start[]" class="form-control datepicker"/>
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-3">
            {!! Form::label('desired_position', trans('messages.career_form.career_form_education.end'), ['class' => '']) !!}
            <div class="input-group">
                <input type="text" name="education_end[]" class="form-control datepicker"/>
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
            </div>
        </div>
        <div class="col-12">
            {!! Form::label('education_description', trans('messages.career_form.career_form_education.description'), ['class' => '']) !!}
            {!! Form::text('education_description[]', null, array_merge(['class' => $errors->has('education_description') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}
        </div>
    </div>
@endif