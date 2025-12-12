<header class="header-redesigned">
    <!-- Logo Section - Frame 7 -->
    <div class="header-redesigned__logo-section">
        <a href="{{ route('new-index') }}" class="header-redesigned__logo">
            <img src="{{ asset('/new/images/icons/Frame7.png') }}" alt="Logo" >
        </a>
    </div>

    <!-- Services Section - Frame 9 -->
    <div class="header-redesigned__services-section">
        <a href="{{ route('new-services') }}" class="header-redesigned__services-btn {{ request()->routeIs('new-services') ? 'active' : '' }}" id="servicesToggleBtn">
            <div class="menu-icon" id="servicesMenuIcon" style="{{ request()->routeIs('new-services') ? 'display: none;' : 'display: flex;' }}">
                <svg viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.33 2.92H11.67" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M2.33 7H11.67" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M2.33 11.08H11.67" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </div>
            <div class="close-icon" id="servicesCloseIcon" style="{{ request()->routeIs('new-services') ? 'display: flex;' : 'display: none;' }}">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L13 13M13 1L1 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <span class="services-text" id="servicesText">{{ __('Услуги') }}</span>
        </a>
    </div>

    <!-- Navigation Section - Frame 5 -->
    <div class="header-redesigned__nav-section">
        <a href="{{ route('about') }}" class="header-redesigned__nav-link" style="width: 100px;">
            <span>{{ __('О компании') }}</span>
        </a>
        <a href="{{ route('news.list') }}" class="header-redesigned__nav-link" style="width: 52px;">
            <span>{{ __('Блог') }}</span>
        </a>
        <a href="{{ route('reviews') }}" class="header-redesigned__nav-link" style="width: 72px;">
            <span>{{ __('Отзывы') }}</span>
        </a>
        <a href="{{ route('faq') }}" class="header-redesigned__nav-link" style="width: 44px;">
            <span>{{ __('FAQ') }}</span>
        </a>
        <a href="{{ route('partners') }}" class="header-redesigned__nav-link" style="width: 97px;">
            <span>{{ __('Партнёрам') }}</span>
        </a>
    </div>

    <!-- Contact Section - Frame 6 -->
    <div class="header-redesigned__contact-section">
        <div class="header-redesigned__phone">
            <a href="tel:+77471350000" class="phone-number">7 (747) 135-00-00</a>
            <a href="#" class="callback-link" data-bs-toggle="modal" data-bs-target="#consultModal">{{ __('Заказать звонок') }}</a>
        </div>

        @auth
            <div class="dropdown">
                <button class="header-redesigned__login-btn dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 7C8.933 7 10.5 5.433 10.5 3.5C10.5 1.567 8.933 0 7 0C5.067 0 3.5 1.567 3.5 3.5C3.5 5.433 5.067 7 7 7Z" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M13.125 14C13.125 11.186 10.439 8.5 7 8.5C3.561 8.5 0.875 11.186 0.875 14" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="login-text">{{ Auth::user()->name }}</span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="#">{{ __('Профиль') }}</a></li>
                    <li><a class="dropdown-item" href="#">{{ __('Настройки') }}</a></li>
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
            <a href="javascript:void(0)" onclick="console.log('Login button clicked'); if(typeof window.openLoginModal === 'function') { window.openLoginModal(); } else { console.error('openLoginModal not found'); } return false;" class="header-redesigned__login-btn">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.25 12.25H2.625C2.42609 12.25 2.23532 12.171 2.09467 12.0303C1.95402 11.8897 1.875 11.6989 1.875 11.5V2.5C1.875 2.30109 1.95402 2.11032 2.09467 1.96967C2.23532 1.82902 2.42609 1.75 2.625 1.75H5.25" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9.1875 9.625L12.125 7L9.1875 4.375" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12.125 7H5.25" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="login-text">{{ __('Войти') }}</span>
            </a>
        @endauth
    </div>
</header>

<!-- Mobile Header (for responsive design) -->
<div class="header-redesigned__mobile d-lg-none">
    <div class="container-fluid">
        <div class="row align-items-center py-2">
            <!-- Mobile Menu Button -->
            <div class="col-auto">
                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu">
                    <svg viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                        <path d="M2.33 2.92H11.67" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M2.33 7H11.67" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M2.33 11.08H11.67" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>

            <!-- Logo -->
            <div class="col">
                <a href="{{ route('new-index') }}" class="text-decoration-none">
                    <img src="{{ asset('/new/images/icons/Frame7.png') }}" alt="Logo" height="32">
                </a>
            </div>

            <!-- Phone -->
            <div class="col-auto">
                <a href="tel:+77471350000" class="btn btn-outline-secondary btn-sm">
                    <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122L9.98 10.98s-.787.205-1.994-1.002C6.782 8.774 6.987 7.987 6.987 7.987l.549-1.805a.678.678 0 0 0-.122-.58L5.62 3.295a.678.678 0 0 0-.58-.122z" stroke="currentColor" stroke-width="1.2"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Offcanvas Menu -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
    <div class="offcanvas-header" style="padding-left: 0; border-bottom: 1px solid #E8E8E8; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); display: flex; align-items: center; gap: 12px;">
        <a href="{{ route('new-index') }}" class="text-decoration-none" style="margin-left: -30px;">
            <img src="{{ asset('/new/images/icons/Frame7.png') }}" alt="Logo" height="32">
        </a>
        <a href="tel:+77471350000" style="display: flex; align-items: center; justify-content: center; width: 50px; height: 50px; background: white; border-radius: 50%; border: 1px solid #E8E8E8;">
            <svg width="12" height="12" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122L9.98 10.98s-.787.205-1.994-1.002C6.782 8.774 6.987 7.987 6.987 7.987l.549-1.805a.678.678 0 0 0-.122-.58L5.62 3.295a.678.678 0 0 0-.58-.122z" fill="#191E1D"/>
            </svg>
        </a>
        <div style="display: flex; align-items: center; justify-content: center; width: 50px; height: 50px; background: white; border-radius: 50%; border: 1px solid #E8E8E8;">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" style="opacity: 1; filter: brightness(0) saturate(100%) invert(48%) sepia(79%) saturate(2476%) hue-rotate(123deg) brightness(95%) contrast(85%); transform: scale(0.5); margin-left: -6px;"></button>
        </div>
    </div>
    <div class="offcanvas-body">
        <!-- Contact -->
        <div class="mb-3" style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-family: 'Manrope', sans-serif; font-weight: 500; color: #000;">7 (747) 135-00-00</div>
                <a href="#" style="color: #279760; text-decoration: none; font-family: 'Manrope', sans-serif;" data-bs-toggle="modal" data-bs-target="#consultModal">{{ __('Заказать звонок') }}</a>
            </div>
            @auth
                <div class="dropdown">
                    <button class="header-redesigned__login-btn dropdown-toggle" type="button" id="mobileUserDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 7C8.933 7 10.5 5.433 10.5 3.5C10.5 1.567 8.933 0 7 0C5.067 0 3.5 1.567 3.5 3.5C3.5 5.433 5.067 7 7 7Z" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M13.125 14C13.125 11.186 10.439 8.5 7 8.5C3.561 8.5 0.875 11.186 0.875 14" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="login-text">{{ Auth::user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="mobileUserDropdown">
                        <li><a class="dropdown-item" href="#">{{ __('Профиль') }}</a></li>
                        <li><a class="dropdown-item" href="#">{{ __('Настройки') }}</a></li>
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
                <a href="javascript:void(0)" onclick="openLoginModal(); return false;" class="header-redesigned__login-btn">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.25 12.25H2.625C2.42609 12.25 2.23532 12.171 2.09467 12.0303C1.95402 11.8897 1.875 11.6989 1.875 11.5V2.5C1.875 2.30109 1.95402 2.11032 2.09467 1.96967C2.23532 1.82902 2.42609 1.75 2.625 1.75H5.25" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9.1875 9.625L12.125 7L9.1875 4.375" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12.125 7H5.25" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="login-text">{{ __('Войти') }}</span>
                </a>
            @endauth
        </div>

        <!-- Navigation -->
        <nav class="nav flex-column">
            <a class="nav-link" href="{{ route('new-services') }}" style="color: #191E1D; font-family: 'Manrope', sans-serif; border-bottom: 1px solid #E8E8E8; padding: 0.75rem 0; display: flex; justify-content: space-between; align-items: center;">
                <span>{{ __('Услуги') }}</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 12L10 8L6 4" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            <a class="nav-link" href="{{ route('about') }}" style="color: #191E1D; font-family: 'Manrope', sans-serif; border-bottom: 1px solid #E8E8E8; padding: 0.75rem 0; display: flex; justify-content: space-between; align-items: center;">
                <span>{{ __('О компании') }}</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 12L10 8L6 4" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            <a class="nav-link" href="{{ route('news.list') }}" style="color: #191E1D; font-family: 'Manrope', sans-serif; border-bottom: 1px solid #E8E8E8; padding: 0.75rem 0; display: flex; justify-content: space-between; align-items: center;">
                <span>{{ __('Блог') }}</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 12L10 8L6 4" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            <a class="nav-link" href="{{ route('reviews') }}" style="color: #191E1D; font-family: 'Manrope', sans-serif; border-bottom: 1px solid #E8E8E8; padding: 0.75rem 0; display: flex; justify-content: space-between; align-items: center;">
                <span>{{ __('Отзывы') }}</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 12L10 8L6 4" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            <a class="nav-link" href="{{ route('faq') }}" style="color: #191E1D; font-family: 'Manrope', sans-serif; border-bottom: 1px solid #E8E8E8; padding: 0.75rem 0; display: flex; justify-content: space-between; align-items: center;">
                <span>{{ __('FAQ') }}</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 12L10 8L6 4" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            <a class="nav-link" href="{{ route('partners') }}" style="color: #191E1D; font-family: 'Manrope', sans-serif; border-bottom: 1px solid #E8E8E8; padding: 0.75rem 0; display: flex; justify-content: space-between; align-items: center;">
                <span>{{ __('Партнёрам') }}</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 12L10 8L6 4" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </nav>
    </div>
</div>

<style>
/* Services Button Active State */
.header-redesigned__services-btn {
    border: 1px solid transparent;
    transition: all 0.3s ease;
    text-decoration: none;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    padding: 16px;
    gap: 6px;
    width: 98px;
    height: 46px;
    background: #279760;
    border-radius: 60px;
    cursor: pointer;
}

.header-redesigned__services-btn:hover {
    background: #228854;
}

.header-redesigned__services-btn.active {
    background: #FFFFFF;
    border: 1px solid #279760;
}

.header-redesigned__services-btn.active:hover {
    background: #F5F5F5;
}

.header-redesigned__services-btn.active .services-text {
    color: #279760;
}

.header-redesigned__services-btn.active .menu-icon svg path {
    stroke: #279760;
}

.header-redesigned__services-btn .close-icon {
    width: 14px;
    height: 14px;
    display: none;
    align-items: center;
    justify-content: center;
}

.header-redesigned__services-btn .close-icon svg {
    width: 14px;
    height: 14px;
    color: #279760;
}
</style>