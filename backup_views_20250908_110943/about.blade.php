@extends('layouts.modern-app')

@section('title', '@lang("messages.pages.about.title")')

@section('page-header')
    <div class="py-16 bg-gradient-to-br from-primary-600 to-primary-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl lg:text-5xl font-bold text-white mb-6">
                О компании UpperLicense
            </h1>
            <p class="text-xl text-primary-100 max-w-3xl mx-auto">
                @lang('messages.pages.about-us.this_is_a_portal_where_you_can_collect_all_the_necessary_information')
            </p>
        </div>
    </div>
@endsection

@section('content')
<div class="space-y-16 lg:space-y-24">
    <!-- Main Info Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl lg:text-4xl font-bold text-text-primary mb-6">
                        Ваш надежный партнер в сфере лицензирования
                    </h2>
                    <div class="space-y-6 text-lg text-text-secondary">
                        <p>
                            UpperLicense — это комплексная платформа для получения лицензий и разрешений 
                            в Республике Казахстан. Мы помогаем предпринимателям и компаниям оформить 
                            все необходимые документы для ведения бизнеса.
                        </p>
                        <p>
                            Более 10 лет мы специализируемся на электронном лицензировании, 
                            предоставляя услуги высочайшего качества с гарантией результата.
                        </p>
                        <p>
                            Наша команда состоит из опытных юристов, которые знают все тонкости 
                            законодательства и помогут вам получить лицензию в кратчайшие сроки.
                        </p>
                    </div>
                </div>
                
                <div class="text-center">
                    <div class="bg-gradient-to-br from-primary-100 to-primary-200 rounded-3xl p-8 lg:p-12">
                        <div class="w-24 h-24 lg:w-32 lg:h-32 bg-primary-600 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-certificate text-white text-4xl lg:text-5xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-primary-800 mb-4">
                            500+ видов лицензий
                        </h3>
                        <p class="text-primary-700">
                            Оказываем услуги по получению лицензий во всех сферах деятельности
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-16 bg-neutral-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12">
                <!-- Mission -->
                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-target text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-text-primary mb-4">Наша миссия</h3>
                    <p class="text-text-secondary leading-relaxed">
                        Упростить процесс лицензирования для предпринимателей Казахстана, 
                        предоставляя качественные и доступные услуги с гарантией результата.
                    </p>
                </div>

                <!-- Vision -->
                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-eye text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-text-primary mb-4">Наше видение</h3>
                    <p class="text-text-secondary leading-relaxed">
                        Стать ведущей платформой электронного лицензирования в Центральной Азии, 
                        обеспечивая прозрачность и эффективность бизнес-процессов.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-text-primary mb-4">
                    Наша команда
                </h2>
                <p class="text-xl text-text-secondary max-w-3xl mx-auto">
                    Профессионалы с многолетним опытом в сфере лицензирования
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Team Member 1 -->
                <div class="text-center group">
                    <div class="w-32 h-32 bg-gradient-to-br from-primary-400 to-primary-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-105 transition-transform">
                        <i class="fas fa-user-tie text-white text-4xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-text-primary mb-2">Юридический отдел</h3>
                    <p class="text-text-secondary text-sm">Опытные юристы-лицензисты</p>
                </div>

                <!-- Team Member 2 -->
                <div class="text-center group">
                    <div class="w-32 h-32 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-105 transition-transform">
                        <i class="fas fa-headset text-white text-4xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-text-primary mb-2">Служба поддержки</h3>
                    <p class="text-text-secondary text-sm">Круглосуточная поддержка клиентов</p>
                </div>

                <!-- Team Member 3 -->
                <div class="text-center group">
                    <div class="w-32 h-32 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-105 transition-transform">
                        <i class="fas fa-cogs text-white text-4xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-text-primary mb-2">IT отдел</h3>
                    <p class="text-text-secondary text-sm">Разработка и поддержка платформы</p>
                </div>

                <!-- Team Member 4 -->
                <div class="text-center group">
                    <div class="w-32 h-32 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-105 transition-transform">
                        <i class="fas fa-chart-line text-white text-4xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-text-primary mb-2">Отдел качества</h3>
                    <p class="text-text-secondary text-sm">Контроль качества услуг</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-16 bg-neutral-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-text-primary mb-4">
                    Наши ценности
                </h2>
                <p class="text-xl text-text-secondary">
                    Принципы, которыми мы руководствуемся в работе
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Value 1 -->
                <div class="bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-handshake text-red-600"></i>
                    </div>
                    <h3 class="text-lg font-bold text-text-primary mb-2">Честность</h3>
                    <p class="text-text-secondary text-sm">Прозрачные условия и честные цены</p>
                </div>

                <!-- Value 2 -->
                <div class="bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-blue-600"></i>
                    </div>
                    <h3 class="text-lg font-bold text-text-primary mb-2">Надежность</h3>
                    <p class="text-text-secondary text-sm">Гарантия результата и качества</p>
                </div>

                <!-- Value 3 -->
                <div class="bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-rocket text-green-600"></i>
                    </div>
                    <h3 class="text-lg font-bold text-text-primary mb-2">Скорость</h3>
                    <p class="text-text-secondary text-sm">Быстрое оформление документов</p>
                </div>

                <!-- Value 4 -->
                <div class="bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-graduation-cap text-purple-600"></i>
                    </div>
                    <h3 class="text-lg font-bold text-text-primary mb-2">Профессионализм</h3>
                    <p class="text-text-secondary text-sm">Высокая квалификация специалистов</p>
                </div>

                <!-- Value 5 -->
                <div class="bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-heart text-orange-600"></i>
                    </div>
                    <h3 class="text-lg font-bold text-text-primary mb-2">Забота</h3>
                    <p class="text-text-secondary text-sm">Индивидуальный подход к каждому клиенту</p>
                </div>

                <!-- Value 6 -->
                <div class="bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-sync text-indigo-600"></i>
                    </div>
                    <h3 class="text-lg font-bold text-text-primary mb-2">Развитие</h3>
                    <p class="text-text-secondary text-sm">Постоянное совершенствование услуг</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-primary-600 to-primary-700">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6">
                Готовы работать с нами?
            </h2>
            <p class="text-xl text-primary-100 mb-8">
                Свяжитесь с нами для получения бесплатной консультации
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contacts') }}" 
                   class="inline-flex items-center justify-center px-8 py-4 bg-white text-primary-700 font-bold rounded-xl hover:bg-primary-50 shadow-xl transition-all duration-300">
                    <i class="fas fa-phone mr-3"></i>
                    Связаться с нами
                </a>
                <a href="{{ route('public.services.index') }}" 
                   class="inline-flex items-center justify-center px-8 py-4 bg-primary-500 text-white font-bold rounded-xl hover:bg-primary-400 shadow-xl transition-all duration-300">
                    <i class="fas fa-list mr-3"></i>
                    Наши услуги
                </a>
            </div>
        </div>
    </section>
</div>
@endsection