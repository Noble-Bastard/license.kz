<div class="modal fade new_modal_login" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel"
     aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <button type="button" class="btn modal_close" data-bs-dismiss="modal" aria-label="Close"><i
          class="bi bi-x modals__icon"></i></button>
      <div class="modal-body">

        <div class="new_modal_login_main_tab_header">
          <div class="new_modal_login_main_tab_header_item active" id="new_modal_login_main_tab_login">Вход
          </div>
          <div class="new_modal_login_main_tab_header_item" id="new_modal_login_main_tab_register">
            Регистрация
          </div>
        </div>

        <div class="new_modal_login_main_tab_pane active" id="login-tab-pane" role="tabpanel"
             aria-labelledby="login-tab"
             tabindex="0">
          <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
              {!! Form::label('email', trans('messages.auth.email_address'), ['for' => 'email']) !!}
              {!! Form::email('email', null, array_merge(['class' =>  $loginError->has('email') ? 'form-control is-invalid' : 'form-control' ,  'autofocus', 'required'])) !!}

              @if ($loginError->has('email'))
                <span class="help-block invalid-feedback">
                                          <strong>{{ $loginError->first('email') }}</strong>
                                      </span>
              @endif
            </div>

            <div class="form-group">
              {!! Form::label('password', trans('messages.auth.password'), ['for' => 'password']) !!}
              {!! Form::password('password', array_merge(['class' =>  $loginError->has('password') ? 'form-control is-invalid' : 'form-control' ,  'autofocus', 'required'])) !!}

              @if ($loginError->has('password'))
                <span class="help-block invalid-feedback">
                                      <strong>{{ $loginError->first('password') }}</strong>
                                  </span>
              @endif
            </div>

            <div class="form-group form-actions">
              <button type="submit" class="btn btn-success">
                @lang('messages.auth.login')
              </button>

              <a class="btn btn-link" href="{{ route('password.request') }}">
                @lang('messages.auth.forgot_password')
              </a>
            </div>
          </form>
        </div>
        <div class="new_modal_login_main_tab_pane" id="registration-tab-pane" role="tabpanel"
             aria-labelledby="registration-tab"
             tabindex="0">
          <div class="new_modal_login_main_tab_pane_sub_caption">Выберите статус</div>
          <div class="new_modal_login_main_tab_pane_sub">
            <a class="btn pills-legalentity-tab" data-form="#legalentityForm">
              @lang('messages.all.entity')
            </a>
            <a class="btn pills-legalentity-tab active" data-form="#legalentityForm1">
              @lang('messages.all.individual')
            </a>
          </div>

          @include('new.partials.modal.register_individal')
          @include('new.partials.modal.register_legal', ["isNewProfile" => true,  'autoFocus' => true, "profileLegal" => new \App\Data\Core\Model\ProfileExt()])

        </div>
      </div>
    </div>
  </div>
</div>

