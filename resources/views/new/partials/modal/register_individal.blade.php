<form class="form-horizontal new_modal_login_main_tab_pane_register active" method="POST" id='legalentityForm1'
      action="{{ route('register') }}">
  @csrf

  <input name="profile_state_type_id" type="hidden"
         value="{{\App\Data\Helper\ProfileStateTypeList::Idividual}}"/>


  <div class="form-group">
    <label for="full_name" style="display: block; color: #191E1D; font-size: 0.875rem; font-weight: 500; margin-bottom: 0.5rem;">
      Полное имя
    </label>

    {!! Form::text('full_name', null, array_merge([
        'class' => $registerError->has('full_name') ? 'form-control is-invalid' : 'form-control',  
        'autofocus' => 'autofocus',
        'placeholder' => 'Ф.И.О.',
        'style' => 'border-color: #D9D9D9; color: #191E1D; background-color: #FFFFFF;'
    ])) !!}
    
    <style>
      #registerFormContainer input::placeholder {
        color: rgba(111, 111, 111, 0.6);
      }
    </style>

    @if ($registerError->has('full_name'))
      <span class="help-block invalid-feedback">
                    <strong>{{ $registerError->first('full_name') }}</strong>
                </span>
    @endif
  </div>

  <div class="form-group">
    <label for="phone" style="display: block; color: #191E1D; font-size: 0.875rem; font-weight: 500; margin-bottom: 0.5rem;">
      {{ trans('messages.all.phone') }}
    </label>

    {!! Form::text('phone', null, array_merge([
        'class' => $registerError->has('phone') ? 'form-control is-invalid phone' : 'form-control phone',  
        'autofocus' => 'autofocus',
        'placeholder' => '+7(___)___-__-__',
        'style' => 'border-color: #D9D9D9; color: #191E1D; background-color: #FFFFFF;'
    ])) !!}
    <span class="help-block invalid-feedback hide" id="error-msg"></span>
    @if ($registerError->has('phone'))
      <span class="help-block invalid-feedback">
                    <strong>{{ $registerError->first('phone') }}</strong>
                </span>
    @endif
  </div>

  <div class="form-group">
    <div style="display: flex; align-items: center; gap: 0.5rem;">
      <label style="position: relative; display: inline-block; cursor: pointer; margin: 0;">
        <input type="checkbox" 
               id="is_resident"
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
    
    <style>
      #registerFormContainer input[type="checkbox"]:checked + .custom-checkbox {
        background-color: #279760;
        border-color: #279760;
      }
      #registerFormContainer input[type="checkbox"]:checked + .custom-checkbox::after {
        content: '';
        position: absolute;
        left: 5px;
        top: 2px;
        width: 5px;
        height: 9px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
      }
    </style>

    @if ($registerError->has('is_resident'))
      <span class="help-block invalid-feedback">
                    <strong>{{ $registerError->first('is_resident') }}</strong>
                </span>
    @endif
  </div>

  <div class="form-group">
    {!! Form::label('email', trans('messages.all.email_address')) !!}

    {!! Form::email('email', null, array_merge(['class' => $registerError->has('email') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

    @if ($registerError->has('email'))
      <span class="help-block invalid-feedback">
                    <strong>{{ $registerError->first('email') }}</strong>
                </span>
    @endif

  </div>
  <div class="form-group">
    {!! Form::label('password', trans('messages.auth.password')) !!}

    {!! Form::password('password', ['class' => $registerError->has('password') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus']) !!}

    @if ($registerError->has('password'))
      <span class="help-block invalid-feedback">
                                          <strong>{{ $registerError->first('password') }}</strong>
                                      </span>
    @endif
  </div>
  <div class="form-group">
    {!! Form::label('password_confirmation', trans('messages.auth.confirm_password')) !!}

    {!! Form::password('password_confirmation', ['class' => $registerError->has('password_confirmation') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus']) !!}

    @if ($registerError->has('password_confirmation'))
      <span class="help-block invalid-feedback">
                                          <strong>{{ $registerError->first('password_confirmation') }}</strong>
                                      </span>
    @endif
  </div>

  <div class="form-group">
    <div class="form-check ps-0">
      <input type="checkbox" class="form-check-input" checked id="offerCheck">
      <label class="form-check-label" for="offerCheck">
        @lang('messages.pages.setPaymentType.i_accept_the_terms_of_the_public_offer_1')
        <a href="{{route("offer")}}" target="_blank">
          @lang('messages.pages.setPaymentType.i_accept_the_terms_of_the_public_offer_2')
        </a>
        <span class="text-danger">*</span>
      </label>
    </div>
  </div>
  <div class="form-group form-actions">
    {!! Form::submit(trans('messages.all.submit'), ['class' => 'btn btn-success register_submit']) !!}
  </div>
</form>
