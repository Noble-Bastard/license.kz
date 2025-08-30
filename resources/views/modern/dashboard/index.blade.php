@extends('layouts.modern-app')

@section('title', 'Панель управления')

@section('page-header')
    <div class="py-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-text-primary">
                    Добро пожаловать, {{ Auth::user()->profile->first_name }}!
                </h1>
                <p class="mt-1 text-sm text-text-secondary">
                    Вот обзор вашей деятельности за сегодня
                </p>
            </div>
            <div class="flex items-center space-x-3">
                @component('components.modern.button', [
                    'variant' => 'outline',
                    'icon' => 'fas fa-download'
                ])
                    Экспорт
                @endcomponent
                
                @component('components.modern.button', [
                    'variant' => 'primary',
                    'icon' => 'fas fa-plus'
                ])
                    Новая задача
                @endcomponent
            </div>
        </div>
    </div>
@endsection

@section('content')
<div x-data="dashboard()" x-init="loadDashboardData()">
    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-modern.stat-card 
            title="Активные услуги"
            value="24"
            change="+12%"
            changeType="positive"
            icon="fas fa-concierge-bell"
            iconColor="primary"
            href="{{ route('manager.services.list') }}" />

        @component('components.modern.stat-card', [
            'title' => 'Новые клиенты',
            'value' => '8',
            'change' => '+3',
            'changeType' => 'positive',
            'icon' => 'fas fa-users',
            'iconColor' => 'success'
        ])
        @endcomponent

        @component('components.modern.stat-card', [
            'title' => 'Доходы',
            'value' => '₸2,840,000',
            'change' => '+8.2%',
            'changeType' => 'positive',
            'icon' => 'fas fa-chart-line',
            'iconColor' => 'warning'
        ])
        @endcomponent

        @component('components.modern.stat-card', [
            'title' => 'Конверсия',
            'value' => '68%',
            'change' => '-2%',
            'changeType' => 'negative',
            'icon' => 'fas fa-percentage',
            'iconColor' => 'info'
        ])
        @endcomponent
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Activities -->
        <div class="lg:col-span-2">
            @component('components.modern.card', [
                'header' => '<div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-text-primary">Последние действия</h3>
                    <a href="#" class="text-sm text-primary-600 hover:text-primary-500">Показать все</a>
                </div>',
                'content' => '

                <div class="flow-root">
                    <ul role="list" class="-mb-8">
                        <template x-for="(activity, index) in recentActivities" :key="activity.id">
                            <li>
                                <div class="relative pb-8" x-show="index < recentActivities.length - 1">
                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-border-light" aria-hidden="true"></span>
                                </div>
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span class="h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white"
                                              :class="getActivityIconColor(activity.type)">
                                            <i :class="getActivityIcon(activity.type)" class="text-sm"></i>
                                        </span>
                                    </div>
                                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                        <div>
                                            <p class="text-sm text-text-primary" x-html="activity.description"></p>
                                        </div>
                                        <div class="whitespace-nowrap text-right text-sm text-text-secondary">
                                            <time x-text="formatTime(activity.created_at)"></time>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </template>
                    </ul>
                </div>
            @endcomponent
        </div>

        <!-- Quick Stats and Actions -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            @component('components.modern.card')
                <x-slot name="header">
                    <h3 class="text-lg font-medium text-text-primary">Быстрые действия</h3>
                </x-slot>

                <div class="space-y-3">
                    <a href="{{ route('sale_manager.commercial_offer.create') }}" 
                       class="flex items-center p-3 rounded-lg border border-border-light hover:bg-neutral-50 transition-colors">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-file-contract text-primary-600 text-sm"></i>
                            </div>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-text-primary">Создать КП</p>
                            <p class="text-xs text-text-secondary">Новое коммерческое предложение</p>
                        </div>
                    </a>

                    <a href="{{ route('manager.services.create') }}" 
                       class="flex items-center p-3 rounded-lg border border-border-light hover:bg-neutral-50 transition-colors">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-success-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-plus text-green-600 text-sm"></i>
                            </div>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-text-primary">Новая услуга</p>
                            <p class="text-xs text-text-secondary">Добавить услугу в каталог</p>
                        </div>
                    </a>

                    <a href="{{ route('manager.executor.list') }}" 
                       class="flex items-center p-3 rounded-lg border border-border-light hover:bg-neutral-50 transition-colors">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-user-tie text-yellow-600 text-sm"></i>
                            </div>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-text-primary">Исполнители</p>
                            <p class="text-xs text-text-secondary">Управление командой</p>
                        </div>
                    </a>
                </div>
            @endcomponent

            <!-- Status Summary -->
            @component('components.modern.card')
                <x-slot name="header">
                    <h3 class="text-lg font-medium text-text-primary">Статус услуг</h3>
                </x-slot>

                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            @component('components.modern.badge', ['variant' => 'success', 'dot' => true])
                                Выполнено
                            @endcomponent
                        </div>
                        <span class="text-sm font-medium text-text-primary">12</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            @component('components.modern.badge', ['variant' => 'warning', 'dot' => true])
                                В работе
                            @endcomponent
                        </div>
                        <span class="text-sm font-medium text-text-primary">8</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            @component('components.modern.badge', ['variant' => 'info', 'dot' => true])
                                Проверка
                            @endcomponent
                        </div>
                        <span class="text-sm font-medium text-text-primary">4</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            @component('components.modern.badge', ['variant' => 'danger', 'dot' => true])
                                Отклонено
                            @endcomponent
                        </div>
                        <span class="text-sm font-medium text-text-primary">2</span>
                    </div>
                </div>
            @endcomponent

            <!-- Calendar Widget -->
            @component('components.modern.card')
                <x-slot name="header">
                    <h3 class="text-lg font-medium text-text-primary">Календарь</h3>
                </x-slot>

                <div class="text-center">
                    <div class="text-3xl font-bold text-text-primary" x-text="getCurrentDate()"></div>
                    <div class="text-sm text-text-secondary" x-text="getCurrentMonth()"></div>
                </div>

                <div class="mt-4 space-y-2">
                    <div class="text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-text-secondary">Сегодня задач:</span>
                            <span class="font-medium text-text-primary">5</span>
                        </div>
                    </div>
                    <div class="text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-text-secondary">На неделе:</span>
                            <span class="font-medium text-text-primary">18</span>
                        </div>
                    </div>
                </div>
            @endcomponent
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
function dashboard() {
    return {
        recentActivities: [],
        stats: {},
        loading: false,

        async loadDashboardData() {
            this.loading = true;
            try {
                // Simulate API call
                await new Promise(resolve => setTimeout(resolve, 1000));
                
                this.recentActivities = [
                    {
                        id: 1,
                        type: 'service_created',
                        description: '<strong>Иван Иванов</strong> создал новую услуга <strong>УСЛ-000319</strong>',
                        created_at: new Date(Date.now() - 5 * 60 * 1000) // 5 minutes ago
                    },
                    {
                        id: 2,
                        type: 'document_signed',
                        description: '<strong>Данил Минин</strong> подписал документ <strong>Agreement.docx</strong>',
                        created_at: new Date(Date.now() - 15 * 60 * 1000) // 15 minutes ago
                    },
                    {
                        id: 3,
                        type: 'payment_received',
                        description: 'Получен платеж <strong>₸3,600,000</strong> по счету №000123',
                        created_at: new Date(Date.now() - 30 * 60 * 1000) // 30 minutes ago
                    },
                    {
                        id: 4,
                        type: 'client_registered',
                        description: 'Новый клиент <strong>ТОО "VIP ПРОЕКТЫ"</strong> зарегистрирован',
                        created_at: new Date(Date.now() - 2 * 60 * 60 * 1000) // 2 hours ago
                    },
                    {
                        id: 5,
                        type: 'service_completed',
                        description: 'Услуга <strong>УСЛ-000295</strong> завершена исполнителем',
                        created_at: new Date(Date.now() - 4 * 60 * 60 * 1000) // 4 hours ago
                    }
                ];
            } catch (error) {
                console.error('Error loading dashboard data:', error);
                showNotification('error', 'Ошибка', 'Не удалось загрузить данные дашборда');
            } finally {
                this.loading = false;
            }
        },

        getActivityIcon(type) {
            const icons = {
                service_created: 'fas fa-plus',
                document_signed: 'fas fa-file-signature',
                payment_received: 'fas fa-credit-card',
                client_registered: 'fas fa-user-plus',
                service_completed: 'fas fa-check'
            };
            return icons[type] || 'fas fa-info';
        },

        getActivityIconColor(type) {
            const colors = {
                service_created: 'bg-primary-500 text-white',
                document_signed: 'bg-green-500 text-white',
                payment_received: 'bg-yellow-500 text-white',
                client_registered: 'bg-blue-500 text-white',
                service_completed: 'bg-green-500 text-white'
            };
            return colors[type] || 'bg-gray-500 text-white';
        },

        formatTime(date) {
            const now = new Date();
            const diffMs = now - date;
            const diffMins = Math.floor(diffMs / 60000);
            const diffHours = Math.floor(diffMins / 60);
            const diffDays = Math.floor(diffHours / 24);

            if (diffMins < 60) {
                return diffMins === 0 ? 'Только что' : `${diffMins} мин назад`;
            } else if (diffHours < 24) {
                return `${diffHours} ч назад`;
            } else {
                return `${diffDays} дн назад`;
            }
        },

        getCurrentDate() {
            return new Date().getDate();
        },

        getCurrentMonth() {
            const months = [
                'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
            ];
            return months[new Date().getMonth()] + ' ' + new Date().getFullYear();
        }
    };
}
</script>
@endsection

