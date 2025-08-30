@extends('layouts.auth')

@section('title', 'Регистрация')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 via-white to-neutral-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Logo and Header -->
        <div class="text-center mb-8">
            <div class="mx-auto h-16 w-16 bg-primary-100 rounded-full flex items-center justify-center mb-6">
                <img src="{{ asset('images/green-logo.png') }}" alt="UpperLicense" class="h-10 w-auto">
            </div>
            <h1 class="text-3xl font-bold text-text-primary">
                Создание аккаунта
                </h1>
            <p class="mt-2 text-sm text-text-secondary">
                Выберите тип лица для регистрации в системе
            </p>
                        </div>

        @if(!request('personType'))
            <!-- Person Type Selection -->
            <div class="max-w-3xl mx-auto">
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Individual Person -->
                    <div class="bg-white rounded-lg border border-border-light shadow-md hover:shadow-lg transition-all duration-200">
                        <a href="{{ route('register', ['personType' => 'individual']) }}" 
                           class="block p-8 text-center group">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors">
                                <i class="fas fa-user text-2xl text-blue-600"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-text-primary mb-2">Физическое лицо</h3>
                            <p class="text-text-secondary">
                                Регистрация для индивидуальных предпринимателей и частных лиц
                            </p>
                        </a>
                        </div>

                    <!-- Legal Entity -->
                    <div class="bg-white rounded-lg border border-border-light shadow-md hover:shadow-lg transition-all duration-200">
                        <a href="{{ route('register', ['personType' => 'legal']) }}" 
                           class="block p-8 text-center group">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-200 transition-colors">
                                <i class="fas fa-building text-2xl text-green-600"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-text-primary mb-2">Юридическое лицо</h3>
                            <p class="text-text-secondary">
                                Регистрация для компаний, организаций и предприятий
                            </p>
                                </a>
                            </div>
                        </div>
            </div>
        @endif

        <!-- Registration Form -->
        @if(request('personType'))
            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-lg border border-border-light shadow-md p-8">
                    <form method="POST" action="{{ route('register') }}" x-data="registrationForm()" @submit.prevent="handleSubmit()">
                        @csrf
                        <input type="hidden" name="personType" value="{{ request('personType') }}">

                        <div class="space-y-8">
                            <!-- Form Header -->
                            <div class="text-center">
                                <h2 class="text-xl font-semibold text-text-primary">
                                    @if(request('personType') === 'legal')
                                        Регистрация юридического лица
                                    @else
                                        Регистрация физического лица
                                    @endif
                                </h2>
                                <p class="mt-1 text-sm text-text-secondary">
                                    Заполните все обязательные поля для создания аккаунта
                                </p>
                            </div>

                            <!-- Account Information -->
                            <div>
                                <h3 class="text-lg font-medium text-text-primary mb-4 flex items-center">
                                    <i class="fas fa-user-circle mr-2 text-primary-600"></i>
                                    Информация об аккаунте
                                </h3>
                                
                                <div class="grid md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-text-primary mb-2">
                                            Email адрес *
                                        </label>
                                        <input type="email" 
                                               name="email" 
                                               value="{{ old('email') }}"
                                               x-model="form.email"
                                               required
                                               class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-text-primary mb-2">
                                            Телефон *
                                        </label>
                                        <input type="text" 
                                               name="phone"
                                               value="{{ old('phone') }}"
                                               x-model="form.phone"
                                               required
                                               class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-text-primary mb-2">
                                            Пароль *
                                        </label>
                                        <input type="password" 
                                               name="password"
                                               x-model="form.password"
                                               required
                                               class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-text-primary mb-2">
                                            Подтверждение пароля *
                                        </label>
                                        <input type="password" 
                                               name="password_confirmation"
                                               x-model="form.password_confirmation"
                                               required
                                               class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                                    </div>
                                </div>
                        </div>

                            @if(request('personType') === 'legal')
                                <!-- Legal Entity Information -->
                                <div>
                                    <h3 class="text-lg font-medium text-text-primary mb-4 flex items-center">
                                        <i class="fas fa-building mr-2 text-primary-600"></i>
                                        Информация о компании
                                    </h3>
                                    
                                    <div class="grid md:grid-cols-2 gap-4">
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-text-primary mb-2">
                                                Наименование организации *
                                            </label>
                                            <input type="text" 
                                                   name="company_name"
                                                   value="{{ old('company_name') }}"
                                                   x-model="form.company_name"
                                                   required
                                                   class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                            </div>

                                        <div>
                                            <label class="block text-sm font-medium text-text-primary mb-2">
                                                БИН *
                                            </label>
                                            <input type="text" 
                                                   name="bin"
                                                   value="{{ old('bin') }}"
                                                   x-model="form.bin"
                                                   required
                                                   maxlength="12"
                                                   class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                                </div>

                                        <div>
                                            <label class="block text-sm font-medium text-text-primary mb-2">
                                                ИИК
                                            </label>
                                            <input type="text" 
                                                   name="iik"
                                                   value="{{ old('iik') }}"
                                                   x-model="form.iik"
                                                   class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                                        </div>

                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-text-primary mb-2">
                                                Юридический адрес *
                                            </label>
                                            <textarea name="legal_address"
                                                      x-model="form.legal_address"
                                                      required
                                                      rows="3"
                                                      class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">{{ old('legal_address') }}</textarea>
                                        </div>
                            </div>
                        </div>

                                <!-- Contact Person -->
                                <div>
                                    <h3 class="text-lg font-medium text-text-primary mb-4 flex items-center">
                                        <i class="fas fa-user-tie mr-2 text-primary-600"></i>
                                        Контактное лицо
                                    </h3>
                                    
                                    <div class="grid md:grid-cols-3 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-text-primary mb-2">
                                                Фамилия *
                                            </label>
                                            <input type="text" 
                                                   name="last_name"
                                                   value="{{ old('last_name') }}"
                                                   x-model="form.last_name"
                                                   required
                                                   class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-text-primary mb-2">
                                                Имя *
                                            </label>
                                            <input type="text" 
                                                   name="first_name"
                                                   value="{{ old('first_name') }}"
                                                   x-model="form.first_name"
                                                   required
                                                   class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-text-primary mb-2">
                                                Отчество
                                            </label>
                                            <input type="text" 
                                                   name="middle_name"
                                                   value="{{ old('middle_name') }}"
                                                   x-model="form.middle_name"
                                                   class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-text-primary mb-2">
                                                ИИН *
                                            </label>
                                            <input type="text" 
                                                   name="iin"
                                                   value="{{ old('iin') }}"
                                                   x-model="form.iin"
                                                   required
                                                   maxlength="12"
                                                   class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-text-primary mb-2">
                                                Должность *
                                            </label>
                                            <input type="text" 
                                                   name="position"
                                                   value="{{ old('position') }}"
                                                   x-model="form.position"
                                                   required
                                                   class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                                        </div>
                                    </div>
                        </div>
                            @else
                                <!-- Individual Person Information -->
                                <div>
                                    <h3 class="text-lg font-medium text-text-primary mb-4 flex items-center">
                                        <i class="fas fa-id-card mr-2 text-primary-600"></i>
                                        Персональная информация
                                    </h3>
                                    
                                    <div class="grid md:grid-cols-3 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-text-primary mb-2">
                                                Фамилия *
                                            </label>
                                            <input type="text" 
                                                   name="last_name"
                                                   value="{{ old('last_name') }}"
                                                   x-model="form.last_name"
                                                   required
                                                   class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-text-primary mb-2">
                                                Имя *
                                            </label>
                                            <input type="text" 
                                                   name="first_name"
                                                   value="{{ old('first_name') }}"
                                                   x-model="form.first_name"
                                                   required
                                                   class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-text-primary mb-2">
                                                Отчество
                                            </label>
                                            <input type="text" 
                                                   name="middle_name"
                                                   value="{{ old('middle_name') }}"
                                                   x-model="form.middle_name"
                                                   class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-text-primary mb-2">
                                                ИИН *
                                            </label>
                                            <input type="text" 
                                                   name="iin"
                                                   value="{{ old('iin') }}"
                                                   x-model="form.iin"
                                                   required
                                                   maxlength="12"
                                                   class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                        </div>

                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-text-primary mb-2">
                                                Адрес регистрации *
                                    </label>
                                            <input type="text" 
                                                   name="registration_address"
                                                   value="{{ old('registration_address') }}"
                                                   x-model="form.registration_address"
                                                   required
                                                   class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                                        </div>
                                </div>
                            </div>
                            @endif

                            <!-- Terms and Conditions -->
                            <div class="border-t border-border-light pt-6">
                                <label class="flex items-start">
                                    <input type="checkbox" 
                                           name="terms_accepted" 
                                           required
                                           class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-border rounded mt-1">
                                    <span class="ml-3 text-sm text-text-secondary">
                                        Я согласен с 
                                        <a href="#" class="text-primary-600 hover:text-primary-500">условиями использования</a>
                                        и 
                                        <a href="#" class="text-primary-600 hover:text-primary-500">политикой конфиденциальности</a>
                                    </span>
                                </label>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="flex flex-col sm:flex-row-reverse sm:space-x-reverse sm:space-x-3 space-y-3 sm:space-y-0">
                                <button type="submit" 
                                        :disabled="loading"
                                        class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <i class="fas fa-user-plus mr-2"></i>
                                    <span x-show="!loading">Создать аккаунт</span>
                                    <span x-show="loading" class="flex items-center">
                                        <i class="fas fa-spinner fa-spin mr-2"></i>
                                        Регистрация...
                                    </span>
                                </button>

                                <a href="{{ route('register') }}" 
                                   class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-white border border-border-light text-text-primary font-medium rounded-lg hover:bg-neutral-50 focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all duration-200">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    Назад
                                </a>
                        </div>

                            <!-- Login Link -->
                            <div class="text-center">
                                <p class="text-sm text-text-secondary">
                                    Уже есть аккаунт?
                                    <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:text-primary-500">
                                        Войти
                                    </a>
                                </p>
                    </div>
                </div>
                    </form>
            </div>
            </div>
        @endif
        </div>
    </div>
@endsection

@section('js')
<script>
function registrationForm() {
    return {
        loading: false,
        form: {
            email: '',
            phone: '',
            password: '',
            password_confirmation: '',
            first_name: '',
            last_name: '',
            middle_name: '',
            iin: '',
            company_name: '',
            bin: '',
            iik: '',
            legal_address: '',
            position: '',
            registration_address: ''
        },

        async handleSubmit() {
            this.loading = true;
            
            // Валидация паролей
            if (this.form.password !== this.form.password_confirmation) {
                showNotification('error', 'Ошибка', 'Пароли не совпадают');
                this.loading = false;
                return;
            }
            
            // Отправляем стандартную форму
            document.querySelector('form').submit();
        }
    };
}

// Маски для полей
document.addEventListener('DOMContentLoaded', function() {
    // Маска для телефона
    const phoneInputs = document.querySelectorAll('input[name="phone"]');
    phoneInputs.forEach(input => {
        input.placeholder = '+7 (___) ___-__-__';
    });

    // Маска для ИИН
    const iinInputs = document.querySelectorAll('input[name="iin"]');
    iinInputs.forEach(input => {
        input.placeholder = '____________';
        input.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, '').substring(0, 12);
        });
    });

    // Маска для БИН
    const binInputs = document.querySelectorAll('input[name="bin"]');
    binInputs.forEach(input => {
        input.placeholder = '____________';
        input.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, '').substring(0, 12);
              });
            });
          });
    </script>
@endsection
