@extends('layouts.modern-app')

@section('title', 'Наши услуги')

@section('content')
<div x-data="servicesPage()" x-init="init()">
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-10"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
            <div class="text-center lg:text-left">
                <h1 class="text-4xl lg:text-6xl font-bold text-white mb-6">
                    <span class="block">Получите лицензию</span>
                    <span class="block text-primary-200">в любой отрасли</span>
                </h1>
                
                <p class="text-xl text-primary-100 mb-8 max-w-3xl mx-auto lg:mx-0">
                    <span class="font-semibold text-white">Онлайн</span> с гарантией и соблюдением сроков
                </p>

                <!-- Quick Contact Form -->
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 lg:p-8 max-w-4xl mx-auto lg:mx-0">
                    <p class="text-white mb-6 text-center lg:text-left">
                        @lang('messages.pages.services-page.enter_your_contact_details')
                    </p>
                    
                    <form id="quickContactForm" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <input type="text" 
                                   name="name"
                                   placeholder="@lang('messages.admin.employee.fio_company_name')"
                                   class="w-full px-4 py-3 bg-white/20 border border-white/30 rounded-lg text-white placeholder-white/70 focus:bg-white/30 focus:border-white focus:outline-none transition-all duration-200">
                        </div>
                        
                        <div>
                            <input type="tel" 
                                   name="phone"
                                   placeholder="@lang('messages.admin.employee.phone')"
                                   class="w-full px-4 py-3 bg-white/20 border border-white/30 rounded-lg text-white placeholder-white/70 focus:bg-white/30 focus:border-white focus:outline-none transition-all duration-200">
                        </div>
                        
                        <div>
                            <input type="email" 
                                   name="email"
                                   placeholder="@lang('messages.admin.employee.email')"
                                   class="w-full px-4 py-3 bg-white/20 border border-white/30 rounded-lg text-white placeholder-white/70 focus:bg-white/30 focus:border-white focus:outline-none transition-all duration-200">
                        </div>
                        
                        <div>
                            <button type="submit"
                                    class="w-full px-6 py-3 bg-white text-primary-700 font-semibold rounded-lg hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-primary-600 transition-all duration-200">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Отправить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Service Categories Section -->
    <div class="py-16 lg:py-24 bg-neutral-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-text-primary mb-4">
                    Категории лицензирования
                </h2>
                <p class="text-xl text-text-secondary max-w-3xl mx-auto">
                    Выберите отрасль для получения детальной информации о лицензировании
                </p>
            </div>

            <!-- Categories Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($serviceCategories as $category)
                    <div class="group">
                        <a href="{{ route('services.groupList', ['serviceCategoryId' => $category->pretty_url]) }}" 
                           class="block h-full bg-white rounded-xl border border-border-light shadow-sm hover:shadow-lg hover:border-primary-300 transition-all duration-300 overflow-hidden">
                            
                            <!-- Category Image/Icon -->
                            <div class="h-48 bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center relative overflow-hidden">
                                @if($category->icon_url)
                                    <img src="{{ asset($category->icon_url) }}" 
                                         alt="{{ $category->name }}"
                                         class="w-16 h-16 object-contain group-hover:scale-110 transition-transform duration-300">
                                @else
                                    <div class="w-16 h-16 bg-primary-600 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <i class="fas fa-certificate text-white text-2xl"></i>
                                    </div>
                                @endif
                                
                                <!-- Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>

                            <!-- Category Info -->
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-text-primary mb-2 group-hover:text-primary-700 transition-colors">
                                    {{ $category->name }}
                                </h3>
                                
                                @if($category->description)
                                    <p class="text-sm text-text-secondary mb-4 line-clamp-3">
                                        {{ $category->description }}
                                    </p>
                                @endif

                                <!-- Stats -->
                                <div class="flex items-center justify-between text-xs text-text-tertiary">
                                    <span class="flex items-center">
                                        <i class="fas fa-list mr-1"></i>
                                        {{ $category->services_count ?? 0 }} услуг
                                    </span>
                                    <span class="text-primary-600 group-hover:text-primary-700 font-medium">
                                        Подробнее →
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Benefits Section -->
    <div class="py-16 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-text-primary mb-4">
                    Почему выбирают нас
                </h2>
                <p class="text-xl text-text-secondary">
                    Более 10 лет опыта в сфере лицензирования
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-check text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-text-primary mb-2">Гарантия результата</h3>
                    <p class="text-text-secondary">100% гарантия получения лицензии или возврат средств</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-text-primary mb-2">Соблюдение сроков</h3>
                    <p class="text-text-secondary">Получение лицензии в кратчайшие сроки</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-text-primary mb-2">Опытная команда</h3>
                    <p class="text-text-secondary">Профессиональные юристы и консультанты</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-headset text-orange-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-text-primary mb-2">Поддержка 24/7</h3>
                    <p class="text-text-secondary">Круглосуточная поддержка на всех этапах</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-16 bg-gradient-to-r from-primary-600 to-primary-700">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">
                Готовы получить лицензию?
            </h2>
            <p class="text-xl text-primary-100 mb-8">
                Свяжитесь с нами для бесплатной консультации
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="tel:+77212345678" 
                   class="inline-flex items-center justify-center px-8 py-4 bg-white text-primary-700 font-semibold rounded-lg hover:bg-primary-50 transition-colors">
                    <i class="fas fa-phone mr-2"></i>
                    +7 (721) 234-56-78
                </a>
                <a href="mailto:info@license.kz" 
                   class="inline-flex items-center justify-center px-8 py-4 bg-primary-500 text-white font-semibold rounded-lg hover:bg-primary-400 transition-colors">
                    <i class="fas fa-envelope mr-2"></i>
                    info@license.kz
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
function servicesPage() {
    return {
        init() {
            this.initQuickContactForm();
        },

        initQuickContactForm() {
            const form = document.getElementById('quickContactForm');
            if (form) {
                form.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    
                    const formData = new FormData(form);
                    const data = Object.fromEntries(formData);
                    
                    if (!data.name || !data.phone) {
                        showNotification('error', 'Ошибка', 'Заполните обязательные поля');
                        return;
                    }
                    
                    try {
                        // Here you would typically send the data to your backend
                        // const response = await fetch('/api/quick-contact', {
                        //     method: 'POST',
                        //     headers: {
                        //         'Content-Type': 'application/json',
                        //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        //     },
                        //     body: JSON.stringify(data)
                        // });
                        
                        showNotification('success', 'Успешно!', 'Мы свяжемся с вами в ближайшее время');
                        form.reset();
                    } catch (error) {
                        showNotification('error', 'Ошибка', 'Не удалось отправить заявку');
                    }
                });
            }
        }
    };
}

// Phone input formatting
document.addEventListener('DOMContentLoaded', function() {
    const phoneInputs = document.querySelectorAll('input[name="phone"]');
    phoneInputs.forEach(input => {
        input.placeholder = '+7 (___) ___-__-__';
        
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.startsWith('7')) {
                value = value.substring(1);
            }
            
            let formatted = '+7';
            if (value.length > 0) {
                formatted += ' (' + value.substring(0, 3);
            }
            if (value.length >= 4) {
                formatted += ') ' + value.substring(3, 6);
            }
            if (value.length >= 7) {
                formatted += '-' + value.substring(6, 8);
            }
            if (value.length >= 9) {
                formatted += '-' + value.substring(8, 10);
            }
            
            e.target.value = formatted;
        });
    });
});
</script>
@endsection

<style>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>