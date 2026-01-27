<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-9">
                <div class="header__left">
                    <div class="header__logo">
                        <a href="{{ route('new-index') }}">
                            <img src="{{asset('assets/img/logo.svg')}}" alt="">
                        </a>
                    </div>
                    <div class="header__burger" id="servicesToggleBtn" onclick="toggleServicesModal(); return false;" style="cursor: pointer;">
                        Услуги
                    </div>
                    <div class="header__menu">
                        <ul>
                            <li><a href="{{ route('about') }}">О компании</a></li>
                            <li><a href="{{ route('news.list') }}">Блог</a></li>
                            <li><a href="{{ route('new-reviews') }}">Отзывы</a></li>
                            <li><a href="{{ route('faq') }}">Faq</a></li>
                            <li><a href="{{ route('partners') }}">Партнёрам</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="header__right">
                    <div class="header__right__tel">
                        <div class="header__right__tel__number">7 (747) 135-00-00</div>
                        <a href="#" class="header__right__tel__link" data-bs-toggle="modal" data-bs-target="#consultModal">Заказать звонок</a>
                    </div>
                    <div class="header__right__login" onclick="openLoginModal(); return false;" style="cursor: pointer;">
                        <img src="{{asset('assets/img/login.svg')}}" alt="">
                        <span>Войти</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@php
    $_categoryList = App\Data\Service\Dal\ServiceCategoryDal::getServiceCategoryWithoutSystemList(false, false, 1);
    foreach($_categoryList as $_category){
        $_catalogRootNode = App\Data\Catalog\Dal\ServiceCategoryCatalogDal::getByServiceCategory($_category->id, true);
        $_category->catalogItemList = collect($_catalogRootNode->childNodeList->where('is_visible', 1)->all())->sortBy('name');
    }
@endphp

<!-- Services Modal -->
@include('new-redesign.partials.modal.services')

<!-- Login Modal -->
@php
    $loginError = $loginError ?? (isset($errors) && $errors->has('login') ? $errors->getBag('login') : collect());
    $registerError = $registerError ?? (isset($errors) && $errors->has('register') ? $errors->getBag('register') : collect());
@endphp
@include('new.partials.modal.login', ['loginError' => $loginError, 'registerError' => $registerError])

<!-- Callback Modal -->
<div class="modal fade" id="consultModal" tabindex="-1" aria-labelledby="consultModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <button type="button" class="btn modal_close" data-bs-dismiss="modal" aria-label="Close"><i
                class="bi bi-x modals__icon"></i></button>
            <div class="modal-body">
                <p class="modals__title-head">Менеджер перезвонит и проконсультирует вас</p>
                {!! Form::open(['url' => route('callMe'), 'method' => 'post', 'class' => 'callMe']) !!}
                <input type="hidden" name="tags" value="Callback">
                <input type="hidden" name="comment" value="Заказ звонка">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <input type="text" class="form-control modals__input" name="name"
                                   placeholder="Ваше имя" required>
                        </div>
                        <div class="col-lg-6 col-12">
                            <input type="text" class="form-control modals__input" name="phone"
                                   placeholder="Ваш телефон*" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success modals__success_btn">Отправить</button>
                <p class="modals__title-description">Нажимая кнопку отправить вы даете разрешение на обработку
                    персональных данных</p>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@section('header-js')
<script src="https://www.google.com/recaptcha/api.js?render={{ env('GOOGLE_RECAPTCHA_KEY') }}"></script>
<script>
    function showLoginTab(activeTabId, clickedElm){
        $('.new_modal_login_main_tab_header_item').removeClass('active')
        $(clickedElm).addClass('active')

        $('.new_modal_login_main_tab_pane').removeClass('active')
        $(activeTabId).addClass('active')
    }

    function setRecaptcha(formId){
        grecaptcha.ready(function () {
            grecaptcha.execute("{{ env('GOOGLE_RECAPTCHA_KEY') }}", {action: 'submit'}).then(function (token) {
                $(formId).prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
                $(document).off('submit', formId)
                $(formId).unbind('submit').submit();
            });
        });
    }

    $(document).ready(function () {
        $('input[name="phone"]').inputmask("+7 (999) 999-99-99");

        $('.callMe').submit(function () {
            $('.modals__success_btn', this).attr('disabled', true);
            $(this).ajaxSubmit({
                success: function () {
                    gtag('event', 'send', {'event_category': 'callback'});
                    $('#consultModal .modals__success_btn').attr('disabled', false);
                    $('#consultModal input').val('')
                    $('#consultModal .btn-x').click()
                    setTimeout(() => {
                        alert("@lang('messages.client.service_create')")
                    }, 500);
                }
            })
            return false
        })

        $('#new_modal_login_main_tab_login').click(function () {
            showLoginTab('#login-tab-pane', this)
        })

        $('#new_modal_login_main_tab_register').click(function () {
            showLoginTab('#registration-tab-pane', this)
        })

        $('.pills-legalentity-tab').click(function () {
            $('.pills-legalentity-tab').removeClass('active')
            $(this).addClass('active')
            $('.new_modal_login_main_tab_pane_register').removeClass('active')
            $($(this).data('form')).addClass('active')
        })

        @if(isset($loginError) && sizeof($loginError) > 0 || isset($registerError) && sizeof($registerError) > 0 )
            showLoginTab('{{isset($registerError) && sizeof($registerError) > 0 ? '#registration-tab-pane' : '#login-tab-pane'}}', '{{isset($registerError) && sizeof($registerError) > 0 ? '#new_modal_login_main_tab_register' : '#new_modal_login_main_tab_login'}}')
            openLoginModal();
        @endif

        $(document).on('submit', '#legalentityForm1', function (event) {
            event.preventDefault();
            setRecaptcha('#legalentityForm1')
        });

        $(document).on('submit', '#legalentityForm', function (event) {
            event.preventDefault();
            setRecaptcha('#legalentityForm')
        });
    });

    function setAdditionalDataToSendForm(tag, comment) {
        let parent = $('#consultModal');
        $('input[name="tags"]', parent).val(tag)
        $('input[name="comment"]', parent).val(comment)
    }
</script>
@endsection
