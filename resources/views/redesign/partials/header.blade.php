<style>
.header__right__login {
    box-sizing: border-box;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    padding: 16px;
    gap: 6px;
    min-width: 93px;
    width: auto;
    max-width: 140px;
    height: 46px;
    border: 1px solid #E8E8E8;
    border-radius: 60px;
    background: transparent;
    flex: none;
    order: 1;
    flex-grow: 0;
    text-decoration: none;
    font-weight: 500;
    font-size: 14px;
    line-height: 100%;
    color: #191E1D;
    cursor: pointer;
}

.header__right__login .login-text,
.header__right__login span {
    height: 14px;
    font-family: 'Manrope', sans-serif;
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 100%;
    color: #191E1D;
    flex: none;
    order: 1;
    flex-grow: 0;
    white-space: nowrap;
    max-width: 80px;
    overflow: hidden;
    text-overflow: ellipsis;
}

.header__right__login:hover {
    background: rgba(25, 30, 29, 0.05);
    border-color: #191E1D;
}

.header__right__login.dropdown-toggle::after {
    display: none;
}

@media (max-width: 1199.98px) {
    .header__right__login {
        max-width: 120px;
    }
    
    .header__right__login .login-text,
    .header__right__login span {
        max-width: 60px;
        font-size: 13px;
    }
}
</style>

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
                            <li><a href="{{ route('faq') }}">FAQ</a></li>
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
                    @auth
                        <div class="dropdown">
                            <button class="header__right__login dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 7C8.933 7 10.5 5.433 10.5 3.5C10.5 1.567 8.933 0 7 0C5.067 0 3.5 1.567 3.5 3.5C3.5 5.433 5.067 7 7 7Z" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.125 14C13.125 11.186 10.439 8.5 7 8.5C3.561 8.5 0.875 11.186 0.875 14" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="login-text">{{ \Illuminate\Support\Str::limit(Auth::user()->name, 12) }}</span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                @php
                                    $locale = app()->getLocale();
                                    $userProfile = \App\Data\Core\Dal\ProfileDal::getByUserId(Auth::id());
                                    $roleId = $userProfile ? $userProfile->role_id : null;
                                    
                                    // Определяем ссылку на профиль в зависимости от роли
                                    $profileUrl = '#';
                                    switch($roleId) {
                                        case \App\Data\Helper\RoleList::Administrator:
                                            $profileUrl = "/{$locale}/admin/users";
                                            break;
                                        case \App\Data\Helper\RoleList::SaleManager:
                                            $profileUrl = "/{$locale}/salemanager/services";
                                            break;
                                        case \App\Data\Helper\RoleList::Curator:
                                            $profileUrl = "/{$locale}/curator/reviewList";
                                            break;
                                        case \App\Data\Helper\RoleList::Manager:
                                            $profileUrl = "/{$locale}/manager/servicesList";
                                            break;
                                        case \App\Data\Helper\RoleList::Executor:
                                            $profileUrl = "/{$locale}/executor/projects";
                                            break;
                                        case \App\Data\Helper\RoleList::Client:
                                            $profileUrl = "/{$locale}/profile/services";
                                            break;
                                        case \App\Data\Helper\RoleList::Agent:
                                            $profileUrl = "/{$locale}/agent/client";
                                            break;
                                        case \App\Data\Helper\RoleList::Head:
                                            $profileUrl = "/{$locale}/report/";
                                            break;
                                        case \App\Data\Helper\RoleList::Accountant:
                                            $profileUrl = "/{$locale}/accountant/services";
                                            break;
                                        default:
                                            $profileUrl = "/{$locale}/profile/services";
                                    }
                                @endphp
                                <li><a class="dropdown-item" href="{{ $profileUrl }}">{{ __('Личный кабинет') }}</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">{{ __('Выйти') }}</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="javascript:void(0)" onclick="openLoginModal(); return false;" class="header__right__login">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.25 12.25H2.625C2.42609 12.25 2.23532 12.171 2.09467 12.0303C1.95402 11.8897 1.875 11.6989 1.875 11.5V2.5C1.875 2.30109 1.95402 2.11032 2.09467 1.96967C2.23532 1.82902 2.42609 1.75 2.625 1.75H5.25" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9.1875 9.625L12.125 7L9.1875 4.375" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12.125 7H5.25" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="login-text">Войти</span>
                        </a>
                    @endauth
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
            @auth
                <div class="dropdown">
                    <button class="mobile-menu__login-btn dropdown-toggle" type="button" id="mobileUserDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="width: 100%; display: flex; justify-content: space-between; align-items: center; box-sizing: border-box; padding: 16px; gap: 6px; border: 1px solid #E8E8E8; border-radius: 60px; background: transparent; font-weight: 500; font-size: 14px; line-height: 100%; color: #191E1D;">
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 7C8.933 7 10.5 5.433 10.5 3.5C10.5 1.567 8.933 0 7 0C5.067 0 3.5 1.567 3.5 3.5C3.5 5.433 5.067 7 7 7Z" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M13.125 14C13.125 11.186 10.439 8.5 7 8.5C3.561 8.5 0.875 11.186 0.875 14" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>{{ \Illuminate\Support\Str::limit(Auth::user()->name, 12) }}</span>
                        </div>
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 12L10 8L6 4" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="mobileUserDropdown">
                        @php
                            $locale = app()->getLocale();
                            $userProfile = \App\Data\Core\Dal\ProfileDal::getByUserId(Auth::id());
                            $roleId = $userProfile ? $userProfile->role_id : null;
                            
                            // Определяем ссылку на профиль в зависимости от роли
                            $profileUrl = '#';
                            switch($roleId) {
                                case \App\Data\Helper\RoleList::Administrator:
                                    $profileUrl = "/{$locale}/admin/users";
                                    break;
                                case \App\Data\Helper\RoleList::SaleManager:
                                    $profileUrl = "/{$locale}/salemanager/services";
                                    break;
                                case \App\Data\Helper\RoleList::Curator:
                                    $profileUrl = "/{$locale}/curator/reviewList";
                                    break;
                                case \App\Data\Helper\RoleList::Manager:
                                    $profileUrl = "/{$locale}/manager/servicesList";
                                    break;
                                case \App\Data\Helper\RoleList::Executor:
                                    $profileUrl = "/{$locale}/executor/projects";
                                    break;
                                case \App\Data\Helper\RoleList::Client:
                                    $profileUrl = "/{$locale}/profile/services";
                                    break;
                                case \App\Data\Helper\RoleList::Agent:
                                    $profileUrl = "/{$locale}/agent/client";
                                    break;
                                case \App\Data\Helper\RoleList::Head:
                                    $profileUrl = "/{$locale}/report/";
                                    break;
                                case \App\Data\Helper\RoleList::Accountant:
                                    $profileUrl = "/{$locale}/accountant/services";
                                    break;
                                default:
                                    $profileUrl = "/{$locale}/profile/services";
                            }
                        @endphp
                        <li><a class="dropdown-item" href="{{ $profileUrl }}">{{ __('Личный кабинет') }}</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">{{ __('Выйти') }}</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <button class="mobile-menu__login-btn" onclick="openLoginModal(); return false;" data-bs-dismiss="offcanvas">
                    <span>Войти</span>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 12L10 8L6 4" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            @endauth
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
                <span>FAQ</span>
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
@include('new.partials.modal.reset_password')
@include('new.partials.modal.forgot_password')

<!-- Callback Modal -->
<div class="modal fade" id="consultModal" tabindex="-1" aria-labelledby="consultModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 520px; margin-top: 80px;">
        <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15); overflow: hidden;">
            <button type="button" class="btn modal_close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; top: 16px; right: 16px; z-index: 10; width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center; background: #F5F5F5; border-radius: 50%; border: none; cursor: pointer; transition: all 0.2s;">
                <i class="bi bi-x" style="font-size: 18px; color: #191E1D;"></i>
            </button>
            <div class="modal-body" style="padding: 40px 32px 32px;">
                <h3 class="modals__title-head" style="font-family: 'Manrope', sans-serif; font-size: 24px; font-weight: 600; color: #191E1D; margin-bottom: 24px; line-height: 1.3; text-align: center;">Менеджер перезвонит и проконсультирует вас</h3>
                {!! Form::open(['url' => route('callMe'), 'method' => 'post', 'class' => 'callMe']) !!}
                <input type="hidden" name="tags" value="Callback">
                <input type="hidden" name="comment" value="Заказ звонка">
                <input type="hidden" name="source_page" id="callback_source_page" value="">
                <input type="hidden" name="button_text" id="callback_button_text" value="">
                <div class="col-12" style="margin-bottom: 20px;">
                    <div class="row" style="gap: 16px; margin: 0;">
                        <div class="col-12" style="padding: 0;">
                            <input type="text" class="form-control modals__input" name="name"
                                   placeholder="Ваше имя" required
                                   style="width: 100%; padding: 14px 16px; border: 1px solid #E8E8E8; border-radius: 8px; font-family: 'Manrope', sans-serif; font-size: 14px; color: #191E1D; background: #FFFFFF; transition: all 0.2s; margin-bottom: 0;">
                        </div>
                        <div class="col-12" style="padding: 0;">
                            <input type="text" class="form-control modals__input" name="phone"
                                   placeholder="Ваш телефон*" required
                                   style="width: 100%; padding: 14px 16px; border: 1px solid #E8E8E8; border-radius: 8px; font-family: 'Manrope', sans-serif; font-size: 14px; color: #191E1D; background: #FFFFFF; transition: all 0.2s;">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success modals__success_btn" style="width: 100%; padding: 14px; background: #279760; color: #FFFFFF; border: none; border-radius: 8px; font-family: 'Manrope', sans-serif; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.2s; margin-bottom: 16px;">Отправить</button>
                <p class="modals__title-description" style="font-family: 'Manrope', sans-serif; font-size: 12px; color: #6F6F6F; text-align: center; margin: 0; line-height: 1.4;">Нажимая кнопку отправить вы даете разрешение на обработку персональных данных</p>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<style>
    #consultModal .modal-dialog {
        margin-top: 80px !important;
    }
    
    #consultModal .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.5);
    }
    
    #consultModal .modals__input:focus {
        outline: none;
        border-color: #279760;
        box-shadow: 0 0 0 3px rgba(39, 151, 96, 0.1);
    }
    
    #consultModal .modals__success_btn:hover {
        background: #1e7a50 !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(39, 151, 96, 0.3);
    }
    
    #consultModal .modals__success_btn:active {
        transform: translateY(0);
    }
    
    #consultModal .modal_close:hover {
        background: #E8E8E8 !important;
    }
    
    @media (max-width: 576px) {
        #consultModal .modal-dialog {
            margin: 20px;
            max-width: calc(100% - 40px);
        }
        
        #consultModal .modal-body {
            padding: 32px 24px 24px !important;
        }
    }
</style>

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

        // Обработчик кликов на телефонные ссылки
        $(document).on('click', 'a[href^="tel:"]', function(e) {
            e.preventDefault();
            var $link = $(this);
            var buttonText = $link.text().trim() || $link.find('span').text().trim() || 'Телефон';
            var sourcePage = window.location.href;
            
            // Заполняем скрытые поля формы
            $('#callback_source_page').val(sourcePage);
            $('#callback_button_text').val(buttonText);
            
            // Открываем модальное окно
            var modal = new bootstrap.Modal(document.getElementById('consultModal'));
            modal.show();
            
            // Отправляем событие в Google Analytics
            if (typeof gtag !== 'undefined') {
                gtag('event', 'click', {
                    'event_category': 'phone',
                    'event_label': buttonText,
                    'page_path': sourcePage
                });
            }
        });

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
