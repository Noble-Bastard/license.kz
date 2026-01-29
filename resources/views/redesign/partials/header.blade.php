<!-- Desktop Header -->
<div class="header d-none d-md-block">
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

<!-- Mobile Header -->
<div class="header-mobile d-md-none">
    <div class="header-mobile__container">
        <div class="header-mobile__logo">
            <a href="{{ route('new-index') }}">
                <img src="{{asset('assets/img/logo.svg')}}" alt="UPPERLICENSE">
            </a>
        </div>
        <div class="header-mobile__actions">
            <a href="tel:+77471350000" class="header-mobile__phone">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122L9.98 10.98s-.787.205-1.994-1.002C6.782 8.774 6.987 7.987 6.987 7.987l.549-1.805a.678.678 0 0 0-.122-.58L5.62 3.295a.678.678 0 0 0-.58-.122z" fill="#191E1D"/>
                </svg>
            </a>
            <button class="header-mobile__menu-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu">
                <svg width="16" height="16" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.33 2.92H11.67" stroke="#279760" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M2.33 7H11.67" stroke="#279760" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M2.33 11.08H11.67" stroke="#279760" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </button>
        </div>
    </div>
</div>

<!-- Mobile Menu Offcanvas -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
    <div class="offcanvas-header">
        <div class="offcanvas-header__left">
            <a href="{{ route('new-index') }}" class="offcanvas-header__logo">
                <img src="{{asset('assets/img/logo.svg')}}" alt="UPPERLICENSE">
            </a>
        </div>
        <div class="offcanvas-header__right">
            <a href="tel:+77471350000" class="offcanvas-header__phone">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122L9.98 10.98s-.787.205-1.994-1.002C6.782 8.774 6.987 7.987 6.987 7.987l.549-1.805a.678.678 0 0 0-.122-.58L5.62 3.295a.678.678 0 0 0-.58-.122z" fill="#191E1D"/>
                </svg>
            </a>
            <button type="button" class="offcanvas-header__close" data-bs-dismiss="offcanvas" aria-label="Close">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L15 15M15 1L1 15" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
    </div>
    <div class="offcanvas-body">
        <!-- Contact Info -->
        <div class="mobile-menu__contact">
            <div class="mobile-menu__phone">7 (747) 135-00-00</div>
            <a href="#" class="mobile-menu__callback" data-bs-toggle="modal" data-bs-target="#consultModal" data-bs-dismiss="offcanvas">Заказать звонок</a>
        </div>
        
        <!-- Login Button -->
        <div class="mobile-menu__login">
            <button class="mobile-menu__login-btn" onclick="openLoginModal(); return false;" data-bs-dismiss="offcanvas">
                <span>Войти</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 12L10 8L6 4" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="mobile-menu__nav">
            <a href="javascript:void(0)" class="mobile-menu__nav-link" onclick="
                var offcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('mobileMenu'));
                if (offcanvas) {
                    offcanvas.hide();
                    setTimeout(function() {
                        toggleServicesModal();
                    }, 300);
                } else {
                    toggleServicesModal();
                }
                return false;
            ">
                <span>Услуги</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 12L10 8L6 4" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            <a href="{{ route('about') }}" class="mobile-menu__nav-link">
                <span>О компании</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 12L10 8L6 4" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            <a href="{{ route('news.list') }}" class="mobile-menu__nav-link">
                <span>Блог</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 12L10 8L6 4" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            <a href="{{ route('new-reviews') }}" class="mobile-menu__nav-link">
                <span>Отзывы</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 12L10 8L6 4" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            <a href="{{ route('faq') }}" class="mobile-menu__nav-link">
                <span>Faq</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 12L10 8L6 4" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            <a href="{{ route('partners') }}" class="mobile-menu__nav-link">
                <span>Партнёрам</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 12L10 8L6 4" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </nav>
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

        // Обработчик для закрытия offcanvas при клике на навигационные ссылки
        var pendingNavigation = null;
        
        $(document).on('click', '.mobile-menu__nav-link', function(e) {
            var href = $(this).attr('href');
            // Проверяем, что это не ссылка "Услуги" (она обрабатывается отдельно)
            if (href && href !== 'javascript:void(0)' && !href.startsWith('#')) {
                e.preventDefault(); // Предотвращаем немедленный переход
                pendingNavigation = href;
                
                var offcanvasEl = document.getElementById('mobileMenu');
                var offcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                if (offcanvas) {
                    // Закрываем offcanvas
                    offcanvas.hide();
                } else {
                    // Если offcanvas уже закрыт, переходим сразу
                    window.location.href = href;
                }
            }
        });
        
        // Переход после закрытия offcanvas
        var offcanvasEl = document.getElementById('mobileMenu');
        if (offcanvasEl) {
            offcanvasEl.addEventListener('hidden.bs.offcanvas', function () {
                if (pendingNavigation) {
                    window.location.href = pendingNavigation;
                    pendingNavigation = null;
                }
            });
        }

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
