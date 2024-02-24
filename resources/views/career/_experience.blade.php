@if(!is_null($n))
    <div class="row border pt-2 pb-2 mt-2">
        @if($n > 0)
            <div class="col-12">
                <button type="button" class="btn btn-danger btn-sm float-right deleteBlock">@lang('messages.all.delete')</button>
            </div>
        @endif
        <div class="col-12 col-sm-6">
            {!! Form::label('experience_place', trans('messages.career_form.career_form_experience.place'), ['class' => '']) !!}
            {!! Form::text('experience_place['.$n.']', null, array_merge(['class' => $errors->has('experience_place.'.$n) ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}
            @if ($errors->has('experience_place.'.$n))
                <span class="help-block invalid-feedback">
                    <strong>{{ $errors->first('experience_place.'.$n) }}</strong>
                </span>
            @endif
        </div>

        <div class="col-12 col-sm-3">
            {!! Form::label('experience_start', trans('messages.career_form.career_form_experience.start'), ['class' => '']) !!}
            <div class="input-group">
                {!! Form::text('experience_start['.$n.']', null, array_merge(['class' => $errors->has('experience_start.'.$n) ? 'form-control datepicker is-invalid' : 'form-control datepicker',  'autofocus' => 'autofocus'])) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
            </div>
            @if ($errors->has('experience_start.'.$n))
                <span class="help-block invalid-feedback">
                    <strong>{{ $errors->first('experience_start.'.$n) }}</strong>
                </span>
            @endif
        </div>
        <div class="col-12 col-sm-3">
            {!! Form::label('experience_end', trans('messages.career_form.career_form_experience.end'), ['class' => '']) !!}
            <div class="input-group">
                {!! Form::text('experience_end['.$n.']', null, array_merge(['class' => $errors->has('experience_end.'.$n) ? 'form-control datepicker is-invalid' : 'form-control datepicker',  'autofocus' => 'autofocus'])) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
            </div>
            @if ($errors->has('experience_end.'.$n))
                <span class="help-block invalid-feedback">
                    <strong>{{ $errors->first('experience_end.'.$n) }}</strong>
                </span>
            @endif
        </div>

        <div class="col-12">
            {!! Form::label('experience_main_responsibilities', trans('messages.career_form.career_form_experience.main_responsibilities'), ['class' => '']) !!}
            {!! Form::text('experience_main_responsibilities['.$n.']', null, array_merge(['class' => $errors->has('experience_main_responsibilities.'.$n) ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}
            @if ($errors->has('experience_main_responsibilities.'.$n))
                <span class="help-block invalid-feedback">
                    <strong>{{ $errors->first('experience_main_responsibilities.'.$n) }}</strong>
                </span>
            @endif
        </div>
        <div class="col-12">
            {!! Form::label('experience_merits', trans('messages.career_form.career_form_experience.merits'), ['class' => '']) !!}
            {!! Form::text('experience_merits['.$n.']', null, array_merge(['class' => $errors->has('experience_merits.'.$n) ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}
            @if ($errors->has('experience_merits.'.$n))
                <span class="help-block invalid-feedback">
                    <strong>{{ $errors->first('experience_merits.'.$n) }}</strong>
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
            {!! Form::label('experience_place', trans('messages.career_form.career_form_experience.place'), ['class' => '']) !!}
            <input type="text" name="experience_place[]" class="form-control"/>
        </div>
        <div class="col-12 col-sm-3">
            {!! Form::label('desired_position', trans('messages.career_form.career_form_experience.start'), ['class' => '']) !!}
            <div class="input-group">
                <input type="text" name="experience_start[]" class="form-control datepicker"/>
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-3">
            {!! Form::label('desired_position', trans('messages.career_form.career_form_experience.end'), ['class' => '']) !!}
            <div class="input-group">
                <input type="text" name="experience_end[]" class="form-control datepicker"/>
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
            </div>
        </div>
        <div class="col-12">
            {!! Form::label('desired_position', trans('messages.career_form.career_form_experience.main_responsibilities'), ['class' => '']) !!}
            <input type="text" name="experience_main_responsibilities[]" class="form-control"/>
        </div>
        <div class="col-12">
            {!! Form::label('desired_position', trans('messages.career_form.career_form_experience.merits'), ['class' => '']) !!}
            <input type="text" name="experience_merits[]" class="form-control"/>
        </div>
    </div>
@endif