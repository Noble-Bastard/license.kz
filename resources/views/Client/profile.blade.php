@extends('layouts.modern-app')

@section('title', 'Мой профиль')

@section('page-header')
    <div class="py-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-text-primary">@lang('messages.client.personal_area')</h1>
                <p class="mt-1 text-sm text-text-secondary">
                    Управляйте вашей личной информацией и настройками
                </p>
            </div>
            <div class="flex items-center space-x-3">
                @component('components.modern.button', [
                    'variant' => 'outline',
                    'icon' => 'fas fa-edit'
                ])
                    Редактировать профиль
                @endcomponent
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="space-y-8">
    <!-- Profile Overview -->
    <div>
        @component('components.modern.card')
            <div class="flex items-start space-x-6">
                <!-- Profile Photo -->
                <div class="flex-shrink-0">
                    <div class="relative">
                        @if($profile->photo_id != null)
                            <img src="/storage_/{{$profile->photo_path}}" 
                                 alt="Profile" 
                                 class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-lg">
                        @else
                            <div class="w-24 h-24 rounded-full bg-primary-100 border-4 border-white shadow-lg flex items-center justify-center">
                                <i class="fas fa-user text-primary-600 text-2xl"></i>
                            </div>
                        @endif
                        
                        <button class="absolute bottom-0 right-0 w-8 h-8 bg-primary-600 rounded-full text-white hover:bg-primary-700 transition-colors flex items-center justify-center uploadphotomodalopen">
                            <i class="fas fa-camera text-sm"></i>
                        </button>
                    </div>
                </div>

                <!-- Basic Info -->
                <div class="flex-1 min-w-0">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-lg font-semibold text-text-primary">
                                    {{ $profile->user_name }}
                                </h3>
                                <p class="text-sm text-text-secondary">
                                    {{ $profile->profile_state_type_name }}
                                </p>
                            </div>
                            
                            <div class="space-y-3">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-envelope w-5 text-text-tertiary"></i>
                                    <span class="text-sm text-text-primary">{{ $profile->email }}</span>
                                </div>
                                
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-phone w-5 text-text-tertiary"></i>
                                    <span class="text-sm text-text-primary">{{ $profile->phone }}</span>
                                </div>
                                
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-globe w-5 text-text-tertiary"></i>
                                    <span class="text-sm text-text-primary">
                                        {{ $profile->is_resident == 1 ? trans('messages.all.resident') : trans('messages.all.non_resident') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start">
                            @if($profile->profile_state_type_id == \App\Data\Helper\ProfileStateTypeList::Idividual)
                                @include('components.messageManagerClientBtn', ['messageCnt' => $messageCnt])
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endcomponent
    </div>

    <!-- Legal Person Additional Info -->
    @if($profile->profile_state_type_id == \App\Data\Helper\ProfileStateTypeList::LegalPerson)
        <div>
            @component('components.modern.card')
                <x-slot name="header">
                    <h3 class="text-lg font-medium text-text-primary">
                        <i class="fas fa-building mr-2 text-primary-600"></i>
                        Информация о компании
                    </h3>
                </x-slot>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div>
                            <dt class="text-sm font-medium text-text-tertiary">@lang('messages.all.BIN')</dt>
                            <dd class="mt-1 text-sm text-text-primary font-mono">{{ $profile->business_identification_number }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-text-tertiary">
                                {{ $profile->profile_state_type_id == 1 ? trans("messages.all.bik") : trans("messages.all.iik") }}
                            </dt>
                            <dd class="mt-1 text-sm text-text-primary font-mono">{{ $profile->bank_code }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-text-tertiary">@lang('messages.all.director_name')</dt>
                            <dd class="mt-1 text-sm text-text-primary">{{ $profile->director_name }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-text-tertiary">@lang('messages.all.legal_address')</dt>
                            <dd class="mt-1 text-sm text-text-primary">{{ $profile->legal_address }}</dd>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        <div>
                            <dt class="text-sm font-medium text-text-tertiary">@lang('messages.all.activity')</dt>
                            <dd class="mt-1 text-sm text-text-primary">{{ $profile->scope_activity }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-text-tertiary">@lang('messages.all.contact_person')</dt>
                            <dd class="mt-1 text-sm text-text-primary">{{ $profile->contact_person }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-text-tertiary">@lang('messages.all.position')</dt>
                            <dd class="mt-1 text-sm text-text-primary">{{ $profile->position }}</dd>
                        </div>
                        
                        <div class="pt-4">
                            @include('components.messageManagerClientBtn', ['messageCnt' => $messageCnt])
                        </div>
                    </div>
                </div>
            @endcomponent
        </div>
    @endif

    <!-- Profile Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @component('components.modern.stat-card', [
            'title' => 'Услуг заказано',
            'value' => $profile->services_count ?? 0,
            'icon' => 'fas fa-concierge-bell',
            'iconColor' => 'primary',
            'href' => route('Client.service.list')
        ])
        @endcomponent

        @component('components.modern.stat-card', [
            'title' => 'Документов получено',
            'value' => $profile->documents_count ?? 0,
            'icon' => 'fas fa-file-alt',
            'iconColor' => 'success',
            'href' => route('profile.documentList')
        ])
        @endcomponent

        @component('components.modern.stat-card', [
            'title' => 'Активных проектов',
            'value' => $profile->active_projects_count ?? 0,
            'icon' => 'fas fa-tasks',
            'iconColor' => 'warning'
        ])
        @endcomponent
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Services -->
        <div>
            @component('components.modern.card')
                <x-slot name="header">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-text-primary">Последние услуги</h3>
                        <a href="{{ route('Client.service.list') }}" class="text-sm text-primary-600 hover:text-primary-500">
                            Показать все
                        </a>
                    </div>
                </x-slot>

                @if(isset($recentServices) && $recentServices->isNotEmpty())
                    <div class="space-y-4">
                        @foreach($recentServices->take(3) as $service)
                            <div class="flex items-center space-x-4 p-3 rounded-lg hover:bg-neutral-50 transition-colors">
                                <div class="flex-shrink-0 w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-concierge-bell text-primary-600 text-sm"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-text-primary truncate">
                                        УСЛ-{{ $service->service_no }}
                                    </p>
                                    <p class="text-sm text-text-secondary truncate">
                                        {{ $service->service_name }}
                                    </p>
                                </div>
                                <div class="flex-shrink-0">
                                    @component('components.modern.badge', ['variant' => 'outline-primary', 'size' => 'sm'])
                                        {{ $service->status }}
                                    @endcomponent
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-text-secondary">
                        <i class="fas fa-concierge-bell text-2xl mb-2"></i>
                        <p>Нет заказанных услуг</p>
                    </div>
                @endif
            @endcomponent
        </div>

        <!-- Account Security -->
        <div>
            @component('components.modern.card')
                <x-slot name="header">
                    <h3 class="text-lg font-medium text-text-primary">Безопасность аккаунта</h3>
                </x-slot>

                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 rounded-lg bg-green-50 border border-green-200">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-shield-alt text-green-600"></i>
                            <div>
                                <p class="text-sm font-medium text-green-800">Email подтвержден</p>
                                <p class="text-xs text-green-600">{{ $profile->email }}</p>
                            </div>
                        </div>
                        <i class="fas fa-check text-green-600"></i>
                    </div>

                    @if($profile->phone_verified_at)
                        <div class="flex items-center justify-between p-3 rounded-lg bg-green-50 border border-green-200">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-mobile-alt text-green-600"></i>
                                <div>
                                    <p class="text-sm font-medium text-green-800">Телефон подтвержден</p>
                                    <p class="text-xs text-green-600">{{ $profile->phone }}</p>
                                </div>
                            </div>
                            <i class="fas fa-check text-green-600"></i>
                        </div>
                    @else
                        <div class="flex items-center justify-between p-3 rounded-lg bg-yellow-50 border border-yellow-200">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-mobile-alt text-yellow-600"></i>
                                <div>
                                    <p class="text-sm font-medium text-yellow-800">Подтвердите телефон</p>
                                    <p class="text-xs text-yellow-600">{{ $profile->phone }}</p>
                                </div>
                            </div>
                            @component('components.modern.button', ['variant' => 'outline', 'size' => 'xs'])
                                Подтвердить
                            @endcomponent
                        </div>
                    @endif

                    <div class="pt-4 border-t border-border-light">
                        @component('components.modern.button', ['variant' => 'outline', 'icon' => 'fas fa-key'])
                            Изменить пароль
                        @endcomponent
                    </div>
                </div>
            @endcomponent
        </div>
    </div>
</div>

<!-- Upload Photo Modal (оставляем существующий) -->
@if(isset($uploadPhotoModal))
    {!! $uploadPhotoModal !!}
@endif
@endsection

@section('js')
<script>
    // Логика для загрузки фото и других действий профиля
    document.addEventListener('DOMContentLoaded', function() {
        // Обработчик для кнопки загрузки фото
        const uploadButtons = document.querySelectorAll('.uploadphotomodalopen');
        uploadButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                // Открываем модальное окно загрузки фото
                // Здесь должна быть логика открытия существующей модалки
                console.log('Open upload photo modal');
            });
        });

        // Анимация статистических карточек
        const statCards = document.querySelectorAll('[data-stat-card]');
        statCards.forEach((card, index) => {
            setTimeout(() => {
                card.classList.add('animate-fade-in');
            }, index * 100);
        });
    });
</script>
@endsection