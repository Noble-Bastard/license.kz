<style>
.header-redesigned__login-btn {
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
}

.header-redesigned__login-btn .login-text {
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

.header-redesigned__login-btn:hover {
  background: rgba(25, 30, 29, 0.05);
  border-color: #191E1D;
}

@media (max-width: 1199.98px) {
  .header-redesigned__login-btn {
    max-width: 120px;
  }
  
  .header-redesigned__login-btn .login-text {
    max-width: 60px;
    font-size: 13px;
  }
}
</style>

<header class="header-redesigned">
    <!-- Logo Section - Frame 7 -->
    <div class="header-redesigned__logo-section">
        <a href="{{ route('new-index') }}" class="header-redesigned__logo">
            <img src="{{ asset('/new/images/icons/Frame7.png') }}" alt="Logo" >
        </a>
    </div>

    <!-- Services Section - Frame 9 -->
    <div class="header-redesigned__services-section">
        <div class="dropdown">
            <button class="header-redesigned__services-btn" type="button" id="servicesDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="menu-icon">
                    <svg viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.33 2.92H11.67" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M2.33 7H11.67" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M2.33 11.08H11.67" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </div>
                <span class="services-text">{{ __('Услуги') }}</span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                <li><a class="dropdown-item" href="{{ route('new-construction') }}">{{ __('Строительство') }}</a></li>
                <li><a class="dropdown-item" href="{{ route('new-services') }}">{{ __('Все услуги') }}</a></li>
            </ul>
        </div>
    </div>

    <!-- Navigation Section - Frame 5 -->
    <div class="header-redesigned__nav-section">
        <a href="{{ route('new-about') }}" class="header-redesigned__nav-link" style="width: 100px;">
            <span>{{ __('О компании') }}</span>
        </a>
        <a href="{{ route('news.list') }}" class="header-redesigned__nav-link" style="width: 52px;">
            <span>{{ __('Блог') }}</span>
        </a>
        <a href="{{ route('new-reviews') }}" class="header-redesigned__nav-link" style="width: 72px;">
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
            <a href="#" class="callback-link">{{ __('Заказать звонок') }}</a>
        </div>

        @auth
            <div class="dropdown">
                <button class="header-redesigned__login-btn dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 7C8.933 7 10.5 5.433 10.5 3.5C10.5 1.567 8.933 0 7 0C5.067 0 3.5 1.567 3.5 3.5C3.5 5.433 5.067 7 7 7Z" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M13.125 14C13.125 11.186 10.439 8.5 7 8.5C3.561 8.5 0.875 11.186 0.875 14" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="login-text">{{ \Illuminate\Support\Str::limit(Auth::user()->name, 12) }}</span>
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
            <a href="{{ route('login') }}" class="header-redesigned__login-btn">
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
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo" height="32">
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
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="mobileMenuLabel">{{ __('Меню') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <!-- Services -->
        <div class="mb-3">
            <button class="btn w-100" style="background: #279760; color: white; border: none; border-radius: 8px;">
                <svg viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="me-2">
                    <path d="M2.33 2.92H11.67" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M2.33 7H11.67" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M2.33 11.08H11.67" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
                {{ __('Услуги') }}
            </button>
        </div>

        <!-- Navigation -->
        <nav class="nav flex-column">
            <a class="nav-link" href="{{ route('new-about') }}" style="color: #191E1D; font-family: 'Manrope', sans-serif;">{{ __('О компании') }}</a>
            <a class="nav-link" href="{{ route('news.list') }}" style="color: #191E1D; font-family: 'Manrope', sans-serif;">{{ __('Блог') }}</a>
            <a class="nav-link" href="{{ route('new-reviews') }}" style="color: #191E1D; font-family: 'Manrope', sans-serif;">{{ __('Отзывы') }}</a>
            <a class="nav-link" href="{{ route('faq') }}" style="color: #191E1D; font-family: 'Manrope', sans-serif;">{{ __('FAQ') }}</a>
            <a class="nav-link" href="{{ route('partners') }}" style="color: #191E1D; font-family: 'Manrope', sans-serif;">{{ __('Партнёрам') }}</a>
        </nav>

        <hr>

        <!-- Contact -->
        <div class="mb-3">
            <div style="font-family: 'Manrope', sans-serif; font-weight: 500; color: #000;">7 (747) 135-00-00</div>
            <a href="#" style="color: #279760; text-decoration: none; font-family: 'Manrope', sans-serif;">{{ __('Заказать звонок') }}</a>
        </div>

        <!-- Login/Profile -->
        @auth
            <div class="d-grid gap-2">
                <a href="#" class="btn btn-outline-secondary">{{ __('Профиль') }}</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100">{{ __('Выйти') }}</button>
                </form>
            </div>
        @else
            <div class="d-grid">
                <a href="{{ route('login') }}" class="btn" style="background: #279760; color: white; border: none;">{{ __('Войти') }}</a>
            </div>
        @endauth
    </div>
</div>

