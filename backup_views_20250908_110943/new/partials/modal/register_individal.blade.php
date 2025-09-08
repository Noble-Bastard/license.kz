<form class="form-horizontal new_modal_login_main_tab_pane_register active" method="POST" id='legalentityForm1'
      action="{{ route('register') }}">
  @csrf

  <input name="profile_state_type_id" type="hidden"
         value="{{\App\Data\Helper\ProfileStateTypeList::Idividual}}"/>


  <div class="form-group">
    {!! Form::label('full_name', trans('messages.all.full_name')) !!}

    {!! Form::text('full_name', null, array_merge(['class' => $registerError->has('full_name') ? 'form-control is-invalid' : 'form-control',  'autofocus' => 'autofocus'])) !!}

    @if ($registerError->has('full_name'))
      <span class="help-block invalid-feedback">
                    <strong>{{ $registerError->first('full_name') }}</strong>
                </span>
    @endif
  </div>

  <div class="form-group">
    {!! Form::label('phone', trans('messages.all.phone'), ['style' => 'display:block']) !!}

    {!! Form::text('phone', null, array_merge(['class' => $registerError->has('phone') ? 'form-control is-invalid phone' : 'form-control phone',  'autofocus' => 'autofocus'])) !!}
    <span class="help-block invalid-feedback hide" id="error-msg"></span>
    @if ($registerError->has('phone'))
      <span class="help-block invalid-feedback">
                    <strong>{{ $registerError->first('phone') }}</strong>
                </span>
    @endif
  </div>

  <div class="form-group">
    <div class="custom-control custom-checkbox">
      <input type="checkbox" class="custom-control-input" id="is_resident"
             name="is_resident" checked>
      <label class="custom-control-label"
             for="is_resident">@lang('messages.all.is_resident')</label>
    </div>

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
