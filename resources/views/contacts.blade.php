@extends('layouts.modern-app')

@section('title', '@lang("messages.pages.contacts.title")')

@section('page-header')
    <div class="py-16 bg-gradient-to-br from-primary-600 to-primary-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl lg:text-5xl font-bold text-white mb-6">
                @lang('messages.pages.contacts.title')
            </h1>
            <p class="text-xl text-primary-100 max-w-3xl mx-auto">
                Свяжитесь с нами любым удобным способом. Мы всегда готовы помочь!
            </p>
        </div>
    </div>
@endsection

@section('content')
<div class="space-y-16">
    <!-- Quick Contact Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Contact Methods -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="text-center lg:text-left">
                        <h2 class="text-2xl font-bold text-text-primary mb-4">
                            Способы связи
                        </h2>
                        <p class="text-text-secondary">
                            Выберите удобный способ связи с нашими специалистами
                        </p>
                    </div>

                    <!-- Phone -->
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border border-green-200">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-phone text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-green-800">Телефон</h3>
                                <a href="tel:+77212345678" class="text-green-700 hover:text-green-800 font-medium">
                                    +7 (721) 234-56-78
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 border border-blue-200">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-blue-800">Email</h3>
                                <a href="mailto:info@license.kz" class="text-blue-700 hover:text-blue-800 font-medium">
                                    info@license.kz
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- WhatsApp -->
                    <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-xl p-6 border border-emerald-200">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-emerald-600 rounded-full flex items-center justify-center">
                                <i class="fab fa-whatsapp text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-emerald-800">WhatsApp</h3>
                                <a href="https://wa.me/77212345678" class="text-emerald-700 hover:text-emerald-800 font-medium">
                                    +7 (721) 234-56-78
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Working Hours -->
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 border border-purple-200">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-clock text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-purple-800">Режим работы</h3>
                                <p class="text-purple-700 text-sm">Пн-Пт: 9:00-18:00</p>
                                <p class="text-purple-700 text-sm">Сб-Вс: 10:00-16:00</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl border border-border-light shadow-lg p-8">
                        <h3 class="text-2xl font-bold text-text-primary mb-6">
                            Отправить сообщение
                        </h3>
                        
                        <form id="contactForm" x-data="contactForm()" @submit.prevent="submitForm()" class="space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-text-primary mb-2">
                                        Имя *
                                    </label>
                                    <input type="text" 
                                           name="name"
                                           x-model="form.name"
                                           required
                                           class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-text-primary mb-2">
                                        Email *
                                    </label>
                                    <input type="email" 
                                           name="email"
                                           x-model="form.email"
                                           required
                                           class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-text-primary mb-2">
                                        Телефон
                                    </label>
                                    <input type="tel" 
                                           name="phone"
                                           x-model="form.phone"
                                           class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-text-primary mb-2">
                                        Тема обращения
                                    </label>
                                    <select name="subject" 
                                            x-model="form.subject"
                                            class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                                        <option value="">Выберите тему</option>
                                        <option value="license">Получение лицензии</option>
                                        <option value="consultation">Консультация</option>
                                        <option value="support">Техническая поддержка</option>
                                        <option value="partnership">Партнерство</option>
                                        <option value="other">Другое</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-text-primary mb-2">
                                    Сообщение *
                                </label>
                                <textarea name="message"
                                          x-model="form.message"
                                          required
                                          rows="6"
                                          class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                                          placeholder="Опишите ваш вопрос или запрос..."></textarea>
                            </div>

                            <button type="submit" 
                                    :disabled="loading"
                                    class="w-full md:w-auto inline-flex items-center justify-center px-8 py-4 bg-primary-600 hover:bg-primary-700 disabled:bg-neutral-300 text-white font-semibold rounded-lg transition-colors disabled:cursor-not-allowed">
                                <span x-show="!loading" class="flex items-center">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Отправить сообщение
                                </span>
                                <span x-show="loading" class="flex items-center">
                                    <i class="fas fa-spinner fa-spin mr-2"></i>
                                    Отправка...
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Offices Section -->
    @if(isset($countryList) && count($countryList) > 0)
        <section class="py-16 bg-neutral-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-text-primary mb-4">
                        Наши офисы
                    </h2>
                    <p class="text-xl text-text-secondary">
                        Мы работаем в нескольких странах для вашего удобства
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($countryList as $country)
                        @if(sizeof($country->company_address) > 0)
                            <div class="bg-white rounded-2xl border border-border-light shadow-lg p-6 hover:shadow-xl transition-shadow">
                                <div class="flex items-center space-x-3 mb-4">
                                    <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-map-marker-alt text-primary-600"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-text-primary">
                                            {{ $country->name }}
                                        </h3>
                                        <p class="text-sm text-text-secondary">
                                        @if(sizeof($country->company_address) > 1)
                                                {{ count($country->company_address) }} офиса
                                        @else
                                                1 офис
                                        @endif
                                        </p>
                                    </div>
                                                                    </div>

                                <div class="space-y-4">
                                    @foreach($country->company_address as $address)
                                        <div class="border-l-4 border-primary-200 pl-4">
                                            <div class="text-sm text-text-primary font-medium mb-1">
                                                {{ $address->city }}
                                                                </div>
                                            <div class="text-sm text-text-secondary mb-2">
                                                {{ $address->address }}
                                                    </div>
                                            @if($address->phone)
                                                <div class="text-sm text-primary-600">
                                                    <i class="fas fa-phone mr-1"></i>
                                                    {{ $address->phone }}
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- FAQ Section -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-text-primary mb-4">
                    Часто задаваемые вопросы
                </h2>
                <p class="text-xl text-text-secondary">
                    Ответы на популярные вопросы о наших услугах
                </p>
            </div>

            <div class="space-y-4" x-data="faqAccordion()">
                <!-- FAQ Item 1 -->
                <div class="border border-border-light rounded-lg">
                    <button @click="toggle(1)" 
                            class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-neutral-50 transition-colors">
                        <span class="font-medium text-text-primary">Сколько времени занимает получение лицензии?</span>
                        <i class="fas fa-chevron-down transition-transform" :class="open === 1 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="open === 1" x-transition class="px-6 pb-4">
                        <p class="text-text-secondary">
                            Срок получения лицензии зависит от типа деятельности и составляет от 5 до 30 рабочих дней. 
                            Мы всегда стараемся оформить документы в кратчайшие сроки.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="border border-border-light rounded-lg">
                    <button @click="toggle(2)" 
                            class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-neutral-50 transition-colors">
                        <span class="font-medium text-text-primary">Какие документы нужны для получения лицензии?</span>
                        <i class="fas fa-chevron-down transition-transform" :class="open === 2 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="open === 2" x-transition class="px-6 pb-4">
                        <p class="text-text-secondary">
                            Пакет документов зависит от вида деятельности. Базовый набор включает: 
                            справку о государственной регистрации, учредительные документы, 
                            справки о налоговой задолженности. Полный список мы предоставим при консультации.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="border border-border-light rounded-lg">
                    <button @click="toggle(3)" 
                            class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-neutral-50 transition-colors">
                        <span class="font-medium text-text-primary">Есть ли гарантия получения лицензии?</span>
                        <i class="fas fa-chevron-down transition-transform" :class="open === 3 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="open === 3" x-transition class="px-6 pb-4">
                        <p class="text-text-secondary">
                            Да, мы предоставляем 100% гарантию получения лицензии. 
                            В случае отказа мы возвращаем полную стоимость услуг или 
                            дорабатываем документы бесплатно до положительного результата.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
@endsection

@section('js')
    <script>
function contactForm() {
    return {
        loading: false,
        form: {
            name: '',
            email: '',
            phone: '',
            subject: '',
            message: ''
        },

        async submitForm() {
            this.loading = true;
            
            try {
                // Here you would send the form data to your backend
                // const response = await fetch('/contact', {
                //     method: 'POST',
                //     headers: {
                //         'Content-Type': 'application/json',
                //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                //     },
                //     body: JSON.stringify(this.form)
                // });
                
                // Simulate API call
                await new Promise(resolve => setTimeout(resolve, 1000));
                
                showNotification('success', 'Успешно!', 'Ваше сообщение отправлено. Мы свяжемся с вами в ближайшее время.');
                this.resetForm();
            } catch (error) {
                showNotification('error', 'Ошибка', 'Не удалось отправить сообщение. Попробуйте позже.');
            } finally {
                this.loading = false;
            }
        },

        resetForm() {
            this.form = {
                name: '',
                email: '',
                phone: '',
                subject: '',
                message: ''
            };
        }
    };
}

function faqAccordion() {
    return {
        open: null,
        
        toggle(id) {
            this.open = this.open === id ? null : id;
        }
    };
}
    </script>
@endsection