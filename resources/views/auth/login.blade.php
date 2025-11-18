@extends('layouts.auth')

@section('title', 'Вход в систему')

@section('content')
<!-- Modal Overlay with Blur -->
<div id="loginModal" class="fixed inset-0 z-50 flex items-center justify-center" style="display: flex;">
    <!-- Backdrop with blur - shows the page behind with blur effect -->
    <div class="fixed inset-0 bg-black bg-opacity-40 backdrop-blur-lg" onclick="closeLoginModal()" style="z-index: 2;"></div>
    
    <!-- Modal Content -->
    <div class="relative z-50 max-w-md w-full mx-4 space-y-8" style="z-index: 3;">
        <!-- Logo and Header -->
        <div class="text-center">
            <div class="mx-auto mb-6 login-logo flex items-center justify-center">
                <img src="{{ asset('images/green-logo.png') }}" alt="UpperLicense">
            </div>
            <h2 class="text-3xl font-bold text-text-primary">
                Добро пожаловать
            </h2>
            <p class="mt-2 text-sm text-text-secondary">
                Войдите в свой аккаунт для продолжения
            </p>
        </div>

        <!-- Login Form -->
        <div class="bg-white rounded-lg border border-border-light shadow-xl p-6 relative">
            <!-- Close Button -->
            <button onclick="closeLoginModal()" class="absolute top-4 right-4 text-text-secondary hover:text-text-primary transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
            <form method="POST" action="{{ route('login') }}" x-data="loginForm()" @submit.prevent="handleSubmit()">
                @csrf
                
                @php
                    $request = request()->create(redirect()->intended()->getTargetUrl());
                    $locale = app('laravellocalization')->getCurrentLocale() != 'ru' ? app('laravellocalization')->getCurrentLocale() : '';
                    $pathWithLocale = $request->getRequestUri();
                    if(substr($request->getRequestUri(), 1, 2) !== $locale){
                        $pathWithLocale = $locale . $request->getRequestUri();
                    }
                    session()->put('url.intended', $pathWithLocale);
                @endphp

                <div class="space-y-6">
                    <!-- Commercial Offer Section -->
                    @if(app('router')->getRoutes()->match(app('request')->create($pathWithLocale))->getName() == 'Client.services.setPaymentType' || session()->has('setPaymentType'))
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-start space-x-3">
                                <i class="fas fa-info-circle text-blue-600 mt-0.5"></i>
                                <div>
                                    <h4 class="text-sm font-medium text-blue-800">Автоматическое создание аккаунта</h4>
                                    <p class="text-sm text-blue-700 mt-1">{{ trans('messages.auth.generate_account_automate') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-t border-border-light pt-6">
                            <h3 class="text-lg font-medium text-text-primary mb-4">Получить коммерческое предложение</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-text-primary mb-2">
                                        <i class="fas fa-envelope text-text-tertiary mr-2"></i>
                                        {{ trans('messages.services.commercialOffer.non_auth_label') }} *
                                    </label>
                                    <input type="email" 
                                           name="commercialOfferEmail" 
                                           required
                                           class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 bg-white">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-text-primary mb-2">
                                        <i class="fas fa-phone text-text-tertiary mr-2"></i>
                                        {{ trans('messages.services.commercialOffer.phone') }} *
                                    </label>
                                    <input type="text" 
                                           name="commercialOfferPhone" 
                                           required
                                           class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 bg-white">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-text-primary mb-2">
                                        <i class="fas fa-building text-text-tertiary mr-2"></i>
                                        {{ trans('messages.services.commercialOffer.company_name') }}
                                    </label>
                                    <input type="text" 
                                           name="commercialOfferCompanyName"
                                           class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 bg-white">
                                </div>

                                <button type="button" 
                                        @click="submitCommercialOffer()"
                                        class="w-full inline-flex items-center justify-center px-4 py-3 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all duration-200">
                                    <i class="fas fa-download mr-2"></i>
                                    {{ trans('messages.services.commercialOffer.action_download') }}
                                </button>
                            </div>
                        </div>

                        <div class="text-center">
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-border-light"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 bg-white text-text-secondary">или войдите в существующий аккаунт</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Login Fields -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-text-primary mb-2">
                                <i class="fas fa-envelope text-text-tertiary mr-2"></i>
                                Email адрес *
                            </label>
                            <input type="email" 
                                   name="email" 
                                   required 
                                   autofocus
                                   value="{{ old('email') }}"
                                   x-model="form.email"
                                   class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 bg-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-text-primary mb-2">
                                <i class="fas fa-lock text-text-tertiary mr-2"></i>
                                Пароль *
                            </label>
                            <input type="password" 
                                   name="password" 
                                   required
                                   x-model="form.password"
                                   class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 bg-white">
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" 
                                   class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-border rounded"
                                   {{ old('remember') ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-text-secondary">Запомнить меня</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-primary-600 hover:text-primary-500">
                                Забыли пароль?
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            :disabled="loading"
                            class="w-full inline-flex items-center justify-center px-4 py-3 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        <span x-show="!loading">Войти</span>
                        <span x-show="loading" class="flex items-center">
                            <i class="fas fa-spinner fa-spin mr-2"></i>
                            Загрузка...
                        </span>
                    </button>

                    <!-- Register Link -->
                    <div class="text-center">
                        <p class="text-sm text-text-secondary">
                            Нет аккаунта?
                            <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:text-primary-500">
                                Зарегистрируйтесь
                            </a>
                        </p>
                    </div>
                </div>
            </form>
        </div>

        <!-- Additional Info -->
        <div class="text-center mt-6">
            <p class="text-xs text-text-tertiary">
                Продолжая, вы соглашаетесь с нашими
                <a href="#" class="text-primary-600 hover:text-primary-500">условиями использования</a>
                и
                <a href="#" class="text-primary-600 hover:text-primary-500">политикой конфиденциальности</a>
            </p>
        </div>
    </div>
</div>

<style>
    /* Prevent body scroll when modal is open */
    body.modal-open {
        overflow: hidden;
    }
    
    /* Smooth animation for modal */
    #loginModal {
        animation: fadeIn 0.3s ease-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    
    #loginModal > div:last-child {
        animation: slideUp 0.3s ease-out;
    }
    
    @keyframes slideUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    
</style>
@endsection

@section('js')
<script>
function loginForm() {
    return {
        loading: false,
        form: {
            email: '{{ old('email') }}',
            password: ''
        },

        async handleSubmit() {
            this.loading = true;
            
            // Отправляем стандартную форму
            document.querySelector('form').submit();
        },

        async submitCommercialOffer() {
            const email = document.querySelector('input[name="commercialOfferEmail"]').value;
            const phone = document.querySelector('input[name="commercialOfferPhone"]').value;
            const companyName = document.querySelector('input[name="commercialOfferCompanyName"]').value;
            
            if (!email || !phone) {
                showNotification('error', 'Ошибка', 'Заполните обязательные поля');
                return;
            }

            try {
                const response = await fetch('{{ route("newPotentialClient") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        commercialOfferEmail: email,
                        commercialOfferPhone: phone,
                        commercialOfferCompanyName: companyName,
                        setPaymentType: '{{ $pathWithLocale }}'
                    })
                });

                if (response.ok) {
                    showNotification('success', 'Успешно!', 'Коммерческое предложение отправлено на ваш email');
                } else {
                    throw new Error('Ошибка сервера');
                }
            } catch (error) {
                showNotification('error', 'Ошибка!', 'Не удалось отправить коммерческое предложение');
            }
        }
    };
}

// Modal functions
function closeLoginModal() {
    const modal = document.getElementById('loginModal');
    
    if (modal) {
        modal.style.animation = 'fadeOut 0.3s ease-out';
        setTimeout(() => {
            modal.style.display = 'none';
            document.body.classList.remove('modal-open');
            // Redirect to previous page or home
            if (document.referrer && document.referrer !== window.location.href) {
                window.history.back();
            } else {
                window.location.href = '{{ route("new-index") }}';
            }
        }, 300);
    }
}

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeLoginModal();
    }
});

// Prevent modal from closing when clicking inside
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('loginModal');
    if (modal) {
        const modalContent = modal.querySelector('.relative.z-50');
        if (modalContent) {
            modalContent.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }
        
        // Add body class to prevent scrolling
        document.body.classList.add('modal-open');
        
        // If we're on the login page directly, open the modal
        if (window.location.pathname.includes('/login')) {
            openLoginModal();
        }
    }
    
    // Маски для телефона
    const phoneInputs = document.querySelectorAll('input[name="commercialOfferPhone"]');
    phoneInputs.forEach(input => {
        // Здесь можно добавить маску для телефона
        input.placeholder = '+7 (___) ___-__-__';
    });
});

// Add fadeOut animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeOut {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);
</script>
@endsection