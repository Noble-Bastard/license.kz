<input name="profile_state_type_id" type="hidden"
       value="{{\App\Data\Helper\ProfileStateTypeList::LegalPerson}}"/>

<div class="form-row">
    <div class="form-group col-md-6">
        {!! Form::label('full_name', trans('messages.all.company_name'), ['class' => 'col-form-label ', 'for' => 'full_name']) !!}
        {!! Form::text('full_name', $profileLegal->profile_company_name, array_merge(['class' => $errors->has('full_name') ? 'form-control is-invalid' : 'form-control',  $autoFocus ? 'autofocus' : ''])) !!}
        @if ($errors->has('full_name'))
            <span class="help-block invalid-feedback">
                <strong>{{ $errors->first('full_name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-md-6">
        {!! Form::label('legal_address', trans('messages.all.legal_address'), ['class' => 'col-form-label', 'for' => 'legal_address']) !!}
        {!! Form::text('legal_address', $profileLegal->legal_address, array_merge(['class' =>$errors->has('legal_address') ? 'form-control is-invalid' : 'form-control' ,  $autoFocus ? 'autofocus' : ''])) !!}
        @if ($errors->has('legal_address'))
            <span class="help-block invalid-feedback">
                <strong>{{ $errors->first('legal_address') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    {!! Form::label('business_identification_number', trans('messages.all.BIN'), ['class' => 'col-form-label', 'for' => 'business_identification_number']) !!}
    {!! Form::text('business_identification_number', $profileLegal->business_identification_number, array_merge(['class' =>$errors->has('business_identification_number') ? 'form-control is-invalid' : 'form-control' ,  $autoFocus ? 'autofocus' : '','MaxLength'=>'12', 'pattern'=>'^([0-9]{12})?$', 'data-mask'=>'999999999999'])) !!}

    @if ($errors->has('business_identification_number'))
        <span class="help-block invalid-feedback">
            <strong>{{ $errors->first('business_identification_number') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">

    <div class="form-check form-check-inline pl-3 mr-3">
        <label class="form-check-label">
            <input type="radio" class="form-check-input"
                   {{(is_null($profileLegal->bank_code_type_id) or $profileLegal->bank_code_type_id == 1) ? "checked = 'checked'" : ""}} name="bank_code_type_id"
                   value="1">@lang("messages.all.bik")
        </label>
    </div>
    <div class="form-check form-check-inline">
        <label class="form-check-label">
            <input type="radio" class="form-check-input"
                   {{($profileLegal->bank_code_type_id == 2) ? "checked = 'checked'" : ""}} name="bank_code_type_id"
                   value="2">@lang("messages.all.iik")
        </label>
    </div>

    {!! Form::text('bank_code', $profileLegal->bank_code, array_merge(['class' =>$errors->has('bank_code') ? 'form-control is-invalid' : 'form-control' ,  $autoFocus ? 'autofocus' : ''])) !!}

    @if ($errors->has('bank_code'))
        <span class="help-block invalid-feedback">
            <strong>{{ $errors->first('bank_code') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    {!! Form::label('scope_activity', trans('messages.all.activity'), ['class' => 'col-form-label', 'for' => 'scope_activity']) !!}
    {!! Form::text('scope_activity', $profileLegal->scope_activity, array_merge(['class' =>  $errors->has('scope_activity') ? 'form-control is-invalid' : 'form-control' ,  $autoFocus ? 'autofocus' : ''])) !!}

    @if ($errors->has('scope_activity'))
        <span class="help-block invalid-feedback">
            <strong>{{ $errors->first('scope_activity') }}</strong>
        </span>
    @endif
</div>

@if($isNewProfile)
    <div class="form-row">
        <div class="form-group col-6">
            {!! Form::label('phone', trans('messages.all.phone'), ['class' => 'col-form-label', 'style' => 'display:block']) !!}
            {!! Form::text('phone', null, array_merge(['class' => $errors->has('phone') ? 'form-control phone1 is-invalid' : 'form-control phone1',  $autoFocus ? 'autofocus' : ''])) !!}
            <span class="help-block invalid-feedback hide" id="error-msg1">
        </span>

            @if ($errors->has('phone'))
                <span class="help-block invalid-feedback">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group col-6">
            {{--        {!! Form::label('is_resident', trans('messages.all.is_resident'), ['class' => 'col-form-label']) !!}--}}
            {{--        {!! Form::checkbox('is_resident', 1, array_merge(['class' => $errors->has('is_resident') ? 'form-control is-invalid' :  'form-control',  $autoFocus ? 'autofocus' : ''])) !!}--}}

            <div class="custom-control custom-checkbox mt-5">
                <input type="checkbox" class="custom-control-input" id="is_resident1"
                       name="is_resident" checked>
                <label class="custom-control-label"
                       for="is_resident1">@lang('messages.all.is_resident')</label>
            </div>

            @if ($errors->has('is_resident'))
                <span class="help-block invalid-feedback">
                <strong>{{ $errors->first('is_resident') }}</strong>
            </span>
            @endif
        </div>
    </div>
@endif

<div class="form-row">
    <div class="form-group col-md-6">
        {!! Form::label('contact_person', trans('messages.all.contact_person'), ['class' => 'col-form-label']) !!}
        {!! Form::text('contact_person', $profileLegal->contact_person, array_merge(['class' => $errors->has('contact_person') ? 'form-control is-invalid' : 'form-control' ,  $autoFocus ? 'autofocus' : ''])) !!}

        @if ($errors->has('contact_person'))
            <span class="help-block invalid-feedback">
                <strong>{{ $errors->first('contact_person') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-md-6">
        {!! Form::label('position', trans('messages.all.position'), ['class' => 'col-form-label']) !!}
        {!! Form::text('position', $profileLegal->position, array_merge(['class' => $errors->has('position') ? 'form-control is-invalid' : 'form-control',  $autoFocus ? 'autofocus' : ''])) !!}

        @if ($errors->has('position'))
            <span class="help-block invalid-feedback">
                <strong>{{ $errors->first('position') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    {!! Form::label('director_name', trans('messages.all.director_name'), ['class' => 'col-form-label']) !!}
    {!! Form::text('director_name', $profileLegal->director_name, array_merge(['class' => $errors->has('director_name') ? 'form-control is-invalid' : 'form-control' ,  $autoFocus ? 'autofocus' : ''])) !!}

    @if ($errors->has('director_name'))
        <span class="help-block invalid-feedback">
            <strong>{{ $errors->first('director_name') }}</strong>
        </span>
    @endif
</div>

@if($isNewProfile)
    <div class="form-group">
        {!! Form::label('email', trans('messages.all.email_address'), ['class' => 'col-form-label']) !!}
        {!! Form::email('email', null, array_merge(['class' =>  $errors->has('email') ? 'form-control is-invalid' : 'form-control',  $autoFocus ? 'autofocus' : ''])) !!}

        @if ($errors->has('email'))
            <span class="help-block invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        {!! Form::label('password', trans('messages.auth.password'), ['class' => 'col-form-label']) !!}
        {!! Form::password('password', ['class' => $errors->has('password') ? 'form-control is-invalid' : 'form-control',  $autoFocus ? 'autofocus' : '']) !!}

        @if ($errors->has('password'))
            <span class="help-block invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        {!! Form::label('confirmed', trans('messages.auth.confirm_password'), ['class' => 'col-form-label']) !!}
        {!! Form::password('password_confirmation',['class' => $errors->has('password_confirmation') ? 'form-control is-invalid' : 'form-control',  $autoFocus ? 'autofocus' : '']) !!}

        @if ($errors->has('password'))
            <span class="help-block invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
@endif
