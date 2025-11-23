<form class="form-horizontal new_modal_login_main_tab_pane_register" method="POST" id='legalentityForm'
      action="{{ route('register') }}">
  @csrf

  <input name="profile_state_type_id" type="hidden"
         value="{{\App\Data\Helper\ProfileStateTypeList::LegalPerson}}"/>


  <div class="form-group">
    {!! Form::label('full_name', trans('messages.all.company_name'), ['class' => 'col-form-label ', 'for' => 'full_name', 'style' => 'text-align: left; padding-left: 0;']) !!}
    {!! Form::text('full_name', $profileLegal->profile_company_name, array_merge([
        'class' => $errors->has('full_name') ? 'form-control is-invalid' : 'form-control',  
        $autoFocus ? 'autofocus' : '',
        'placeholder' => 'Введите наименование',
        'style' => 'border-color: #D9D9D9; color: #191E1D; background-color: #FFFFFF;'
    ])) !!}
    @if ($errors->has('full_name'))
      <span class="help-block invalid-feedback">
                <strong>{{ $errors->first('full_name') }}</strong>
            </span>
    @endif
  </div>

  <div class="form-group">
    {!! Form::label('legal_address', trans('messages.all.legal_address'), ['class' => 'col-form-label', 'for' => 'legal_address', 'style' => 'text-align: left; padding-left: 0;']) !!}
    {!! Form::text('legal_address', $profileLegal->legal_address, array_merge([
        'class' => $errors->has('legal_address') ? 'form-control is-invalid' : 'form-control',  
        $autoFocus ? 'autofocus' : '',
        'placeholder' => 'Введите адрес',
        'style' => 'border-color: #D9D9D9; color: #191E1D; background-color: #FFFFFF;'
    ])) !!}
    @if ($errors->has('legal_address'))
      <span class="help-block invalid-feedback">
                <strong>{{ $errors->first('legal_address') }}</strong>
            </span>
    @endif
  </div>


  <div class="form-group">
    {!! Form::label('business_identification_number', trans('messages.all.BIN'), ['class' => 'col-form-label', 'for' => 'business_identification_number', 'style' => 'text-align: left; padding-left: 0;']) !!}
    {!! Form::text('business_identification_number', $profileLegal->business_identification_number, array_merge([
        'class' => $errors->has('business_identification_number') ? 'form-control is-invalid' : 'form-control',  
        $autoFocus ? 'autofocus' : '',
        'MaxLength' => '12', 
        'pattern' => '^([0-9]{12})?$', 
        'data-mask' => '999999999999',
        'placeholder' => 'Введите адрес',
        'style' => 'border-color: #D9D9D9; color: #191E1D; background-color: #FFFFFF;'
    ])) !!}

    @if ($errors->has('business_identification_number'))
      <span class="help-block invalid-feedback">
            <strong>{{ $errors->first('business_identification_number') }}</strong>
        </span>
    @endif
  </div>

  <div class="form-group">
    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
      <label class="form-check-label" style="margin: 0; cursor: pointer;">
        <input type="radio" class="form-check-input" style="margin-right: 0.25rem;"
               {{(is_null($profileLegal->bank_code_type_id) or $profileLegal->bank_code_type_id == 1) ? "checked = 'checked'" : ""}} name="bank_code_type_id"
               value="1">@lang("messages.all.bik")
      </label>
      <span style="color: #191E1D;">|</span>
      <label class="form-check-label" style="margin: 0; cursor: pointer;">
        <input type="radio" class="form-check-input" style="margin-right: 0.25rem;"
               {{($profileLegal->bank_code_type_id == 2) ? "checked = 'checked'" : ""}} name="bank_code_type_id"
               value="2">@lang("messages.all.iik")
      </label>
    </div>

    {!! Form::text('bank_code', $profileLegal->bank_code, array_merge([
        'class' => $errors->has('bank_code') ? 'form-control is-invalid' : 'form-control',  
        $autoFocus ? 'autofocus' : '',
        'placeholder' => 'Введите адрес',
        'style' => 'border-color: #D9D9D9; color: #191E1D; background-color: #FFFFFF;'
    ])) !!}

    @if ($errors->has('bank_code'))
      <span class="help-block invalid-feedback">
            <strong>{{ $errors->first('bank_code') }}</strong>
        </span>
    @endif
  </div>

  <div class="form-group">
    {!! Form::label('scope_activity', trans('messages.all.activity'), ['class' => 'col-form-label', 'for' => 'scope_activity', 'style' => 'text-align: left; padding-left: 0;']) !!}
    {!! Form::text('scope_activity', $profileLegal->scope_activity, array_merge([
        'class' => $errors->has('scope_activity') ? 'form-control is-invalid' : 'form-control',  
        $autoFocus ? 'autofocus' : '',
        'placeholder' => 'Введите сферу деятельности',
        'style' => 'border-color: #D9D9D9; color: #191E1D; background-color: #FFFFFF;'
    ])) !!}

    @if ($errors->has('scope_activity'))
      <span class="help-block invalid-feedback">
            <strong>{{ $errors->first('scope_activity') }}</strong>
        </span>
    @endif
  </div>

  @if($isNewProfile)
      <div class="form-group">
      <label for="phone" style="display: block; color: #191E1D; font-size: 0.875rem; font-weight: 500; margin-bottom: 0.5rem; text-align: left;">
        {{ trans('messages.all.phone') }}
      </label>
      {!! Form::text('phone', null, array_merge([
          'class' => $errors->has('phone') ? 'form-control phone1 is-invalid' : 'form-control phone1',  
          $autoFocus ? 'autofocus' : '',
          'placeholder' => '+7(___)___-__-__',
          'style' => 'border-color: #D9D9D9; color: #191E1D; background-color: #FFFFFF;'
      ])) !!}
        <span class="help-block invalid-feedback hide" id="error-msg1">
        </span>

        @if ($errors->has('phone'))
          <span class="help-block invalid-feedback">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
      </div>

    <div class="form-group">
      <div style="display: flex; align-items: center; gap: 0.5rem;">
        <label style="position: relative; display: inline-block; cursor: pointer; margin: 0;">
          <input type="checkbox" 
                 id="is_resident1"
                 name="is_resident" 
                 checked
                 style="position: absolute; opacity: 0; cursor: pointer; width: 0; height: 0;">
          <span class="custom-checkbox" style="
            display: inline-block;
            width: 18px;
            height: 18px;
            border: 1px solid #D9D9D9;
            background-color: #FFFFFF;
            border-radius: 2px;
            position: relative;
            vertical-align: middle;
          "></span>
          <span style="color: #191E1D; font-size: 0.875rem; margin-left: 0.5rem; vertical-align: middle;">
            @lang('messages.all.is_resident')
          </span>
        </label>
        </div>

        @if ($errors->has('is_resident'))
          <span class="help-block invalid-feedback">
                <strong>{{ $errors->first('is_resident') }}</strong>
            </span>
        @endif
    </div>
  @endif

    <div class="form-group">
    {!! Form::label('contact_person', trans('messages.all.contact_person'), ['class' => 'col-form-label', 'style' => 'text-align: left; padding-left: 0;']) !!}
    {!! Form::text('contact_person', $profileLegal->contact_person, array_merge([
        'class' => $errors->has('contact_person') ? 'form-control is-invalid' : 'form-control',  
        $autoFocus ? 'autofocus' : '',
        'placeholder' => 'Ф.И.О. контактного лица',
        'style' => 'border-color: #D9D9D9; color: #191E1D; background-color: #FFFFFF;'
    ])) !!}

      @if ($errors->has('contact_person'))
        <span class="help-block invalid-feedback">
                <strong>{{ $errors->first('contact_person') }}</strong>
            </span>
      @endif
    </div>

    <div class="form-group">
    {!! Form::label('position', trans('messages.all.position'), ['class' => 'col-form-label', 'style' => 'text-align: left; padding-left: 0;']) !!}
    {!! Form::text('position', $profileLegal->position, array_merge([
        'class' => $errors->has('position') ? 'form-control is-invalid' : 'form-control',  
        $autoFocus ? 'autofocus' : '',
        'placeholder' => 'Укажите должность контактного лица',
        'style' => 'border-color: #D9D9D9; color: #191E1D; background-color: #FFFFFF;'
    ])) !!}

      @if ($errors->has('position'))
        <span class="help-block invalid-feedback">
                <strong>{{ $errors->first('position') }}</strong>
            </span>
      @endif
  </div>

  <div class="form-group">
    <label for="director_name" style="display: block; color: #191E1D; font-size: 0.875rem; font-weight: 500; margin-bottom: 0.5rem; text-align: left; padding-left: 0;">Директор (Ф.И.О)</label>
    {!! Form::text('director_name', $profileLegal->director_name, array_merge([
        'class' => $errors->has('director_name') ? 'form-control is-invalid' : 'form-control',  
        $autoFocus ? 'autofocus' : '',
        'placeholder' => 'Полное имя директора компании',
        'style' => 'border-color: #D9D9D9; color: #191E1D; background-color: #FFFFFF;'
    ])) !!}

    @if ($errors->has('director_name'))
      <span class="help-block invalid-feedback">
            <strong>{{ $errors->first('director_name') }}</strong>
        </span>
    @endif
  </div>

  @if($isNewProfile)
    <div class="form-group">
      <label for="email" style="display: block; color: #191E1D; font-size: 0.875rem; font-weight: 500; margin-bottom: 0.5rem; text-align: left; padding-left: 0;">Электронная почта</label>
      {!! Form::email('email', null, array_merge([
          'class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control',  
          $autoFocus ? 'autofocus' : '',
          'placeholder' => 'example@gmail.com',
          'style' => 'border-color: #D9D9D9; color: #191E1D; background-color: #FFFFFF;'
      ])) !!}

      @if ($errors->has('email'))
        <span class="help-block invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
      @endif
    </div>

    <div class="form-group">
      <label for="password" style="display: block; color: #191E1D; font-size: 0.875rem; font-weight: 500; margin-bottom: 0.5rem; text-align: left; padding-left: 0;">Придумайте пароль</label>
      {!! Form::password('password', [
          'class' => $errors->has('password') ? 'form-control is-invalid' : 'form-control',  
          $autoFocus ? 'autofocus' : '',
          'style' => 'border-color: #D9D9D9; color: #191E1D; background-color: #FFFFFF;'
      ]) !!}

      @if ($errors->has('password'))
        <span class="help-block invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
      @endif
    </div>

    <div class="form-group">
      {!! Form::label('confirmed', trans('messages.auth.confirm_password'), ['class' => 'col-form-label', 'style' => 'text-align: left; padding-left: 0;']) !!}
      {!! Form::password('password_confirmation', [
          'class' => $errors->has('password_confirmation') ? 'form-control is-invalid' : 'form-control',  
          $autoFocus ? 'autofocus' : '',
          'style' => 'border-color: #D9D9D9; color: #191E1D; background-color: #FFFFFF;'
      ]) !!}

      @if ($errors->has('password'))
        <span class="help-block invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
      @endif
    </div>
  @endif

  <div class="form-group">
    <div class="offer-acceptance-container" style="display: flex; align-items: flex-start; gap: 0.5rem; margin-top: 1.5rem;">
      <label style="position: relative; display: inline-flex; align-items: flex-start; cursor: pointer; margin: 0; flex-shrink: 0; padding-top: 2px;">
        <input type="checkbox" 
               id="offerCheck"
               name="offerCheck" 
               checked
               style="position: absolute; opacity: 0; cursor: pointer; width: 0; height: 0;">
        <span class="custom-checkbox" style="
          display: inline-block;
          width: 18px;
          height: 18px;
          border: 1px solid #D9D9D9;
          background-color: #FFFFFF;
          border-radius: 2px;
          position: relative;
          vertical-align: middle;
          flex-shrink: 0;
        "></span>
      </label>
      <div class="offer-acceptance-text" style="color: #6F6F6F; font-size: 0.75rem; line-height: 1.4; margin: 0;">
        <span class="offer-text-part1">@lang('messages.pages.setPaymentType.i_accept_the_terms_of_the_public_offer_1')</span>
        <span class="offer-text-part2"><a href="{{route("offer")}}" target="_blank" style="color: #6F6F6F; text-decoration: underline;">@lang('messages.pages.setPaymentType.i_accept_the_terms_of_the_public_offer_2')</a></span>
      </div>
    </div>
    <style>
      .offer-acceptance-text {
        display: inline;
      }
      .offer-text-part1::after {
        content: ' ';
      }
      @media (max-width: 768px) {
        .offer-acceptance-container {
          align-items: flex-start !important;
        }
        .offer-acceptance-text {
          display: flex;
          flex-direction: column;
          gap: 0.25rem;
        }
        .offer-text-part1::after {
          content: '';
        }
      }
    </style>
  </div>
  <div class="form-group form-actions">
    {!! Form::submit(trans('messages.all.submit'), ['class' => 'btn btn-success register_submit', 'style' => 'padding: 0.75rem 2rem; border-radius: 25px; font-size: 1rem;']) !!}
  </div>

</form>
