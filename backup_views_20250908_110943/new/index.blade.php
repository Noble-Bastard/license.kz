@extends('layouts.modern-app')

@section('title')
    @if(\Illuminate\Support\Facades\App::getLocale() == "ru")
        ЛИЦЕНЗИИ — Электронное лицензирование в Казахстане
    @else
        LICENSES — Electronic Licensing in Kazakhstan
    @endif
@endsection

@section('meta-description')
    @if(\Illuminate\Support\Facades\App::getLocale() == "ru")
        Е-лицензирование ➤ Электронные лицензии ✅ Получения лицензий и разрешений во всех сферах деятельности ➤ Разрешительные документы в Республике Казахстан ➤ Сайт лицензий!
    @else
        E-licensing ➤ Electronic licenses ✅ Obtaining licenses and permits in all areas of activity ➤ Permits in the Republic of Kazakhstan ➤ License site!
    @endif
@endsection

@section('content')
<div x-data="homePage()" x-init="init()">
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-primary-900 via-primary-800 to-primary-600 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                    <span class="block">Электронное</span>
                    <span class="block text-transparent bg-clip-text bg-gradient-to-r from-primary-200 to-primary-100">
                        лицензирование
                    </span>
                    <span class="block text-2xl md:text-3xl lg:text-4xl mt-4 text-primary-100">
                        в Казахстане
                    </span>
                </h1>
                
                <p class="text-xl md:text-2xl text-primary-100 mb-12 leading-relaxed">
                    Получите лицензии и разрешения во всех сферах деятельности
                    <span class="block text-white font-semibold mt-2">быстро, надежно, онлайн</span>
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-16">
                    <a href="{{ route('services') }}" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-white text-primary-700 font-bold rounded-xl hover:bg-primary-50 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                        <i class="fas fa-rocket mr-3"></i>
                        Начать сейчас
                    </a>
                    <a href="#services" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-primary-500/20 backdrop-blur-sm border-2 border-white/30 text-white font-bold rounded-xl hover:bg-white/10 hover:border-white/50 transition-all duration-300">
                        <i class="fas fa-play mr-3"></i>
                        Узнать больше
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 pt-8 border-t border-white/20">
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-white mb-2">500+</div>
                        <div class="text-primary-200 text-sm md:text-base">Видов лицензий</div>
                                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-white mb-2">10+</div>
                        <div class="text-primary-200 text-sm md:text-base">Лет опыта</div>
                                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-white mb-2">5000+</div>
                        <div class="text-primary-200 text-sm md:text-base">Довольных клиентов</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-white mb-2">98%</div>
                        <div class="text-primary-200 text-sm md:text-base">Успешных заявок</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <a href="#services" class="block w-8 h-8 border-2 border-white/50 rounded-full flex items-center justify-center hover:border-white transition-colors">
                <i class="fas fa-chevron-down text-white text-sm"></i>
            </a>
                            </div>
    </section>

    <!-- Search Section (for authenticated users) -->
    @if(Auth::check() && !Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client))
        <section class="py-12 bg-neutral-50">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-text-primary mb-6 text-center">Быстрый поиск лицензий</h2>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-search text-text-tertiary"></i>
                        </div>
                        <input type="text" 
                               class="w-full pl-12 pr-4 py-4 border border-border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent text-lg"
                               placeholder="Введите название лицензии или сферы деятельности..."
                               x-model="searchQuery"
                               @input="performSearch()">
                    </div>
                            </div>
                        </div>
        </section>
    @endif

    <!-- Top Categories -->
    <section id="services" class="py-16 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-text-primary mb-4">
                    Популярные категории лицензирования
                </h2>
                <p class="text-xl text-text-secondary max-w-3xl mx-auto">
                    Выберите вашу сферу деятельности для получения подробной информации
                </p>
                                </div>

            <!-- Categories Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if(isset($topCategoryList))
                    @foreach(collect($topCategoryList)->sortBy('hot_offer_order_no')->take(6) as $category)
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

                                    <!-- CTA -->
                                    <div class="text-sm text-primary-600 group-hover:text-primary-700 font-medium">
                                        Подробнее →
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
                                    </div>
                                </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 lg:py-24 bg-neutral-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-text-primary mb-4">
                    Преимущества работы с нами
                </h2>
                <p class="text-xl text-text-secondary">
                    Почему более 5000 компаний доверяют нам свое лицензирование
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow group">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-shield-check text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-text-primary mb-4">100% гарантия</h3>
                    <p class="text-text-secondary">Гарантируем получение лицензии или полный возврат средств</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow group">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-clock text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-text-primary mb-4">Быстрые сроки</h3>
                    <p class="text-text-secondary">Получение лицензии в кратчайшие сроки благодаря отлаженным процессам</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow group">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-text-primary mb-4">Экспертная команда</h3>
                    <p class="text-text-secondary">Команда профессиональных юристов с 10+ летним опытом</p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow group">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-headset text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-text-primary mb-4">Поддержка 24/7</h3>
                    <p class="text-text-secondary">Круглосуточная поддержка клиентов на всех этапах получения лицензии</p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow group">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-400 to-red-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-laptop text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-text-primary mb-4">Онлайн процесс</h3>
                    <p class="text-text-secondary">Полностью электронный документооборот без посещения офисов</p>
                </div>

                <!-- Feature 6 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow group">
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-400 to-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-money-bill-wave text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-text-primary mb-4">Честные цены</h3>
                    <p class="text-text-secondary">Прозрачное ценообразование без скрытых платежей и доплат</p>
                                                </div>
                                            </div>
                                        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 lg:py-24 bg-gradient-to-r from-primary-600 to-primary-700">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6">
                Готовы начать процесс лицензирования?
            </h2>
            <p class="text-xl text-primary-100 mb-8">
                Получите бесплатную консультацию и узнайте стоимость вашей лицензии
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="tel:+77212345678" 
                   class="inline-flex items-center justify-center px-8 py-4 bg-white text-primary-700 font-bold rounded-xl hover:bg-primary-50 shadow-xl transition-all duration-300">
                    <i class="fas fa-phone mr-3"></i>
                    +7 (721) 234-56-78
                </a>
                <a href="{{ route('services') }}" 
                   class="inline-flex items-center justify-center px-8 py-4 bg-primary-500 text-white font-bold rounded-xl hover:bg-primary-400 shadow-xl transition-all duration-300">
                    <i class="fas fa-rocket mr-3"></i>
                    Выбрать услугу
                </a>
                                </div>
                            </div>
    </section>
    </div>
@endsection

@section('js')
    <script>
function homePage() {
    return {
        searchQuery: '',

        init() {
            // Initialize
        },

        async performSearch() {
            if (this.searchQuery.length < 2) {
                return;
            }
            // Add search functionality here
        }
    };
}

// Smooth scrolling for anchor links
document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
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


