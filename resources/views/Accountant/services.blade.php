@extends('layouts.accountant-app')

@section('content')
<div class="px-6 lg:px-8">
    <!-- Page Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-text-primary">Услуги</h1>
            <div class="relative w-[320px]">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" placeholder="Поиск по услугам..." class="block w-full pl-10 pr-3 py-3 border border-border-medium rounded-[20px] text-sm placeholder-text-muted focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="mb-6">
        
        <!-- Status Filters -->
        <div class="flex items-center gap-2 mb-4 overflow-x-auto whitespace-nowrap md:flex-wrap md:whitespace-normal scroll-smooth -mx-1 px-1" style="scrollbar-width: none; -ms-overflow-style: none;">
            <style>
                /* hide scrollbar in webkit */
                .overflow-x-auto::-webkit-scrollbar{display:none}
            </style>
            <button class="status-filter-btn px-3 py-1.5 text-xs font-medium rounded-full text-white transition-colors flex-shrink-0 inline-block" style="background-color: #279760;" onmouseover="this.style.backgroundColor='#1e7a50'" onmouseout="this.style.backgroundColor='#279760'">
                Все услуги
            </button>
            <button class="status-filter-btn px-3 py-1.5 text-xs font-medium rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors flex-shrink-0 inline-block">
                Создание
            </button>
            <button class="status-filter-btn px-3 py-1.5 text-xs font-medium rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors flex-shrink-0 inline-block">
                Проверка клиента
            </button>
            <button class="status-filter-btn px-3 py-1.5 text-xs font-medium rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors flex-shrink-0 inline-block">
                Предоплата
            </button>
            <button class="status-filter-btn px-3 py-1.5 text-xs font-medium rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors flex-shrink-0 inline-block">
                Сбор данных
            </button>
            <button class="status-filter-btn px-3 py-1.5 text-xs font-medium rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors flex-shrink-0 inline-block">
                Проверка
            </button>
            <button class="status-filter-btn px-3 py-1.5 text-xs font-medium rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors flex-shrink-0 inline-block">
                Выполнение услуги
            </button>
            <button class="status-filter-btn px-3 py-1.5 text-xs font-medium rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors flex-shrink-0 inline-block">
                Оплата
            </button>
            <button class="status-filter-btn px-3 py-1.5 text-xs font-medium rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors flex-shrink-0 inline-block">
                Выполнена
            </button>
            <button class="status-filter-btn px-3 py-1.5 text-xs font-medium rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors flex-shrink-0 inline-block">
                Выставлен счет
            </button>
            <button class="status-filter-btn px-3 py-1.5 text-xs font-medium rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors flex-shrink-0 inline-block">
                Отклонена
            </button>
        </div>
    </div>

    <!-- Desktop Headers -->
    <div class="hidden md:grid bg-white px-4 py-3 text-xs font-semibold text-text-muted uppercase tracking-wider" style="grid-template-columns: 140px 1fr 140px 120px 160px 180px 140px; gap: 20px;">
        <div>Услуга</div>
        <div>ФИО/Название компании</div>
        <div>Стоимость</div>
        <div>Срок</div>
        <div>Статус</div>
        <div>Менеджер</div>
        <div>Действия</div>
    </div>

    <!-- Services List -->
    <div class="mx-[-100vw] px-[100vw] py-5" style="background-color: var(--color-bg-secondary);">
        <div class="px-[40px]">
            <!-- Services Table (desktop) -->
            <div class="hidden md:block">
                <div class="overflow-x-auto px-1">
                    <table class="w-full border-separate" style="border-spacing: 0 14px; table-layout: fixed;">
                <tbody>
                    @if(isset($serviceJournalList) && is_iterable($serviceJournalList) && $serviceJournalList->isNotEmpty())
                        @foreach($serviceJournalList as $service)
                            <tr class="bg-white shadow-sm transition-shadow hover:shadow rounded-lg">
                                <!-- Услуга -->
                                <td class="px-4 py-4 whitespace-nowrap rounded-l-lg" style="width: 140px;">
                                    <div class="text-sm text-text-primary">
                                        {{ $service->service_no ?? 'N/A' }}
                                    </div>
                                </td>
                                <!-- ФИО/Название компании -->
                                <td class="px-4 py-4" style="width: auto;">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0">
                                            <span class="text-sm font-medium text-green-600">
                                                {{ substr($service->client_full_name ?? 'N/A', 0, 1) }}
                                            </span>
                                        </div>
                                        <div class="ml-3 min-w-0">
                                            <div class="text-sm font-medium text-text-primary truncate" title="{{ $service->client_full_name ?? 'N/A' }}">{{ $service->client_full_name ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap" style="width: 140px;">
                                    <div class="text-sm font-medium text-text-primary">
                                        {{ number_format($service->amount ?? 0, 0, ',', ' ') }} ₸
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap" style="width: 120px;">
                                    <div class="text-sm text-text-muted">
                                        {{ $service->deadline ? \Carbon\Carbon::parse($service->deadline)->format('d.m.Y') : 'N/A' }}
                                    </div>
                                </td>
                                <td class="px-4 py-4" style="width: 160px;">
                                    @php
                                        $statusConfig = [
                                            'active' => ['text' => 'text-green-700', 'border' => 'border-green-200', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                            'completed' => ['text' => 'text-blue-700', 'border' => 'border-blue-200', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                            'pending' => ['text' => 'text-yellow-700', 'border' => 'border-yellow-200', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                                            'cancelled' => ['text' => 'text-red-700', 'border' => 'border-red-200', 'icon' => 'M6 18L18 6M6 6l12 12'],
                                            'execution' => ['text' => 'text-blue-700', 'border' => 'border-blue-200', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                                            'client_check' => ['text' => 'text-purple-700', 'border' => 'border-purple-200', 'icon' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
                                            'prepayment' => ['text' => 'text-orange-700', 'border' => 'border-orange-200', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1'],
                                            'payment' => ['text' => 'text-green-700', 'border' => 'border-green-200', 'icon' => 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z'],
                                            'rejected' => ['text' => 'text-red-700', 'border' => 'border-red-200', 'icon' => 'M6 18L18 6M6 6l12 12']
                                        ];
                                        $statusName = strtolower($service->service_status_name ?? 'pending');
                                        $statusConfig = $statusConfig[$statusName] ?? $statusConfig['pending'];
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white border border-border-light text-text-primary">
                                        <svg class="w-3 h-3 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $statusConfig['icon'] }}"></path>
                                        </svg>
                                        <span class="truncate">{{ $service->service_status_name ?? 'N/A' }}</span>
                                    </span>
                                </td>
                                <td class="px-4 py-4" style="width: 180px;">
                                    <div class="flex items-center">
                                        <div class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center flex-shrink-0">
                                            <span class="text-xs font-medium text-gray-600">
                                                {{ substr($service->manager_name ?? 'N/A', 0, 1) }}
                                            </span>
                                        </div>
                                        <div class="ml-2 min-w-0">
                                            <div class="text-sm text-text-primary truncate" title="{{ $service->manager_name ?? 'N/A' }}">{{ $service->manager_name ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium rounded-r-lg" style="width: 140px;">
                                    <div class="flex items-center space-x-2">
                                        <button class="text-green-600 hover:text-green-700 transition-colors" title="Просмотр">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </button>
                                        <button class="text-text-muted hover:text-text-primary transition-colors" title="Редактировать">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                        <button class="text-text-muted hover:text-red-600 transition-colors" title="Удалить">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-text-muted mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <h3 class="text-lg font-medium text-text-primary mb-2">Нет услуг</h3>
                                    <p class="text-sm text-text-muted mb-4">У вас пока нет добавленных услуг</p>
                                    <button class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Добавить первую услугу
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
                    </table>
                </div>
            </div>

            <!-- Services List (mobile cards) -->
            <div class="md:hidden space-y-3">
        @if(isset($serviceJournalList) && is_iterable($serviceJournalList) && $serviceJournalList->isNotEmpty())
            @foreach($serviceJournalList as $service)
                <div class="bg-white rounded-lg shadow-sm px-4 py-3">
                    <!-- Top: Услуга + Стоимость -->
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-sm font-medium text-text-primary">УСЛ-{{ $service->service_no ?? 'N/A' }}</div>
                        <div class="text-sm font-semibold text-text-primary">{{ number_format($service->amount ?? 0, 0, ',', ' ') }} ₸</div>
                    </div>
                    <!-- Клиент -->
                    <div class="mb-2">
                        <div class="text-[11px] text-text-muted mb-1">ФИО/Название компании</div>
                        <div class="flex items-center">
                            <div class="w-7 h-7 bg-primary-100 rounded-full flex items-center justify-center">
                                <span class="text-xs font-medium text-green-600">{{ substr($service->client_full_name ?? 'N/A', 0, 1) }}</span>
                            </div>
                            <div class="ml-2 text-sm text-text-primary">{{ $service->client_full_name ?? 'N/A' }}</div>
                        </div>
                    </div>
                    <!-- Срок и Статус -->
                    <div class="flex items-center justify-between mb-2">
                        <div>
                            <div class="text-[11px] text-text-muted mb-1">Срок</div>
                            <div class="text-sm text-text-primary">{{ $service->deadline ? \Carbon\Carbon::parse($service->deadline)->format('d.m.Y') : 'N/A' }}</div>
                        </div>
                        <div>
                            <div class="text-[11px] text-text-muted mb-1">Статус</div>
                            @php
                                $statusName = strtolower($service->service_status_name ?? 'pending');
                                $textClass = 'text-text-primary';
                                if (str_contains($statusName,'выполн')||str_contains($statusName,'заверш')) $textClass='text-green-700';
                                elseif (str_contains($statusName,'ожид')||str_contains($statusName,'pending')) $textClass='text-yellow-700';
                                elseif (str_contains($statusName,'откл')||str_contains($statusName,'cancel')) $textClass='text-red-700';
                                elseif (str_contains($statusName,'провер')||str_contains($statusName,'client')) $textClass='text-purple-700';
                            @endphp
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-white border border-border-light {{ $textClass }}">{{ $service->service_status_name ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <!-- Менеджер и Действия -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center">
                                <span class="text-[10px] font-medium text-gray-600">{{ substr($service->manager_name ?? 'N/A', 0, 1) }}</span>
                            </div>
                            <div class="ml-2 text-sm text-text-primary">{{ $service->manager_name ?? 'N/A' }}</div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="text-green-600" title="Просмотр">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                            <button class="text-text-muted" title="Редактировать">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 113 3L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </button>
                            <button class="text-red-600" title="Удалить">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
            @else
                <div class="bg-white rounded-lg shadow-sm px-4 py-6 text-center text-sm text-text-secondary">Нет услуг</div>
            @endif
            </div>

            <!-- Pagination -->
            @if(isset($serviceJournalList) && method_exists($serviceJournalList, 'hasPages') && $serviceJournalList->hasPages())
                <div class="mt-6">
                    @include('components.manager-pagination', ['paginator' => $serviceJournalList])
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Add Service Modal -->
<div id="add-service-modal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Добавить новую услугу</h3>
            <button class="modal-close" onclick="closeModal('add-service-modal')">&times;</button>
        </div>
        <div class="modal-body">
            <form>
                <div class="space-y-4">
                    <div>
                        <label for="service_name" class="block text-sm font-medium text-text-primary mb-1">Название услуги</label>
                        <input type="text" id="service_name" name="service_name" class="block w-full px-3 py-2 border border-border-medium rounded-lg text-sm placeholder-text-muted focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="Введите название услуги">
                    </div>
                    
                    <div>
                        <label for="service_description" class="block text-sm font-medium text-text-primary mb-1">Описание</label>
                        <textarea id="service_description" name="service_description" rows="3" class="block w-full px-3 py-2 border border-border-medium rounded-lg text-sm placeholder-text-muted focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="Описание услуги"></textarea>
                    </div>
                    
                    <div>
                        <label for="service_status" class="block text-sm font-medium text-text-primary mb-1">Статус</label>
                        <select id="service_status" name="service_status" class="block w-full px-3 py-2 border border-border-medium rounded-lg text-sm text-text-primary bg-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            @if(isset($serviceStatuses) && $serviceStatuses->isNotEmpty())
                                @foreach($serviceStatuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            @else
                                <option value="1">Создание</option>
                                <option value="2">Оплата</option>
                                <option value="3">Сбор данных</option>
                                <option value="4">Проверка</option>
                                <option value="5">Выполнение</option>
                                <option value="6">Завершено</option>
                                <option value="8">Предоплата</option>
                                <option value="10">Отклонено</option>
                            @endif
                        </select>
                    </div>
                </div>
                
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeModal('add-service-modal')" class="px-4 py-2 border border-border-medium text-sm font-medium text-text-primary bg-white rounded-lg hover:bg-neutral-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                        Отмена
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                        Добавить услугу
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.modal {
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-content {
    background-color: white;
    border-radius: 8px;
    width: 90%;
    max-width: 500px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.modal-header {
    padding: 20px 24px;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-title {
    font-size: 18px;
    font-weight: 600;
    color: #191E1D;
    margin: 0;
}

.modal-close {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #6F6F6F;
    padding: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 4px;
    transition: background-color 0.2s;
}

.modal-close:hover {
    background-color: #f3f4f6;
}

.modal-body {
    padding: 24px;
}
</style>

@push('scripts')
<script>
function openModal(modalId) {
    document.getElementById(modalId).style.display = 'flex';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
}

// Status filter functionality
function filterByStatus(status, clickedBtn) {
    // Remove active state from all status buttons
    document.querySelectorAll('.status-filter-btn').forEach(btn => {
        btn.classList.remove('text-white');
        btn.classList.add('bg-gray-100', 'text-gray-700');
        btn.style.backgroundColor = '';
        btn.onmouseover = null;
        btn.onmouseout = null;
    });
    
    // Add active state to clicked button
    clickedBtn.classList.remove('bg-gray-100', 'text-gray-700');
    clickedBtn.classList.add('text-white');
    clickedBtn.style.backgroundColor = '#279760';
    clickedBtn.onmouseover = function() { this.style.backgroundColor = '#1e7a50'; };
    clickedBtn.onmouseout = function() { this.style.backgroundColor = '#279760'; };
    
    // Filter table rows based on status
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        if (status === 'Все') {
            row.style.display = '';
        } else {
            const statusCell = row.querySelector('td:nth-child(6)'); // Status column
            if (statusCell) {
                const rowStatus = statusCell.textContent.trim();
                if (rowStatus.includes(status)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        }
    });
    
    console.log('Filtering by status:', status);
}

// Add click handlers for the "Add Service" buttons
document.addEventListener('DOMContentLoaded', function() {
    const addServiceButtons = document.querySelectorAll('button');
    addServiceButtons.forEach(button => {
        if (button.textContent.includes('Добавить')) {
            button.onclick = function() {
                openModal('add-service-modal');
            };
        }
    });
    
    // Add click handlers for status filter buttons
    const statusFilterButtons = document.querySelectorAll('.status-filter-btn');
    statusFilterButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            const status = this.textContent.trim();
            filterByStatus(status, this);
        });
    });
    
    // Add search functionality
    const searchInput = document.querySelector('input[placeholder="Поиск по услугам..."]');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                const cells = row.querySelectorAll('td');
                let shouldShow = false;
                
                // Search in client name, service, and ID
                if (cells.length > 0) {
                    const id = cells[0].textContent.toLowerCase();
                    const client = cells[1].textContent.toLowerCase();
                    const service = cells[2].textContent.toLowerCase();
                    
                    if (id.includes(searchTerm) || 
                        client.includes(searchTerm) || 
                        service.includes(searchTerm)) {
                        shouldShow = true;
                    }
                }
                
                row.style.display = shouldShow || searchTerm === '' ? '' : 'none';
            });
        });
    }
});
</script>
@endpush
@endsection