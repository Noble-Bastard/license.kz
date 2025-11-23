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
        background-color: #279760 !important;
        border-color: #279760 !important;
      }
      #registerFormContainer input[type="checkbox"]:checked + .custom-checkbox::after {
        content: '' !important;
        position: absolute;
        left: 5px;
        top: 2px;
        width: 5px;
        height: 9px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
      }
      /* Also support data-checked attribute */
      #registerFormContainer .custom-checkbox[data-checked="true"] {
        background-color: #279760 !important;
        border-color: #279760 !important;
      }
      #registerFormContainer .custom-checkbox[data-checked="true"]::after {
        content: '' !important;
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
    <div class="offer-acceptance-container" style="display: flex; align-items: flex-start; gap: 0.5rem; margin-top: 1rem;">
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
