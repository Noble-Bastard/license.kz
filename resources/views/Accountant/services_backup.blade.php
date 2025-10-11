@extends('layouts.accountant-app')

@section('content')
<div class="px-6 lg:px-8" x-data="{ 
    searchQuery: '',
    filterServices() {
        const searchQuery = this.searchQuery.toLowerCase();
        const serviceRows = document.querySelectorAll('.service-row');
        
        serviceRows.forEach(row => {
            const serviceNo = row.querySelector('.service-no')?.textContent.toLowerCase() || '';
            const clientName = row.querySelector('.client-name')?.textContent.toLowerCase() || '';
            const managerName = row.querySelector('.manager-name')?.textContent.toLowerCase() || '';
            
            const matchesSearch = serviceNo.includes(searchQuery) || 
                                clientName.includes(searchQuery) || 
                                managerName.includes(searchQuery);
            
            if (matchesSearch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
}">
    <!-- Page Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-text-primary">Услуги</h1>
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
            <button class="status-filter-btn px-3 py-1.5 text-xs font-medium rounded-full bg-transparent text-text-primary transition-colors flex-shrink-0 inline-block">
                Все услуги
            </button>
            <button class="status-filter-btn px-3 py-1.5 text-xs font-medium rounded-full bg-transparent text-text-primary transition-colors flex-shrink-0 inline-block">
                Создание
            </button>
            <button class="status-filter-btn px-3 py-1.5 text-xs font-medium rounded-full bg-transparent text-text-primary transition-colors flex-shrink-0 inline-block">
                Проверка клиента
            </button>
            <button class="status-filter-btn px-3 py-1.5 text-xs font-medium rounded-full bg-transparent text-text-primary transition-colors flex-shrink-0 inline-block">
                Предоплата
            </button>
            <button class="status-filter-btn px-3 py-1.5 text-xs font-medium rounded-full bg-transparent text-text-primary transition-colors flex-shrink-0 inline-block">
                Сбор данных
            </button>
            <button class="status-filter-btn px-3 py-1.5 text-xs font-medium rounded-full bg-transparent text-text-primary transition-colors flex-shrink-0 inline-block">
                Проверка
            </button>
            <button class="status-filter-btn px-3 py-1.5 text-xs font-medium rounded-full bg-transparent text-text-primary transition-colors flex-shrink-0 inline-block">
                Выполнение услуги
            </button>
            <button class="status-filter-btn px-3 py-1.5 text-xs font-medium rounded-full bg-transparent text-text-primary transition-colors flex-shrink-0 inline-block">
                Оплата
            </button>
            <button class="status-filter-btn px-3 py-1.5 text-xs font-medium rounded-full bg-transparent text-text-primary transition-colors flex-shrink-0 inline-block">
                Выполнена
            </button>
            <button class="status-filter-btn px-3 py-1.5 text-xs font-medium rounded-full bg-transparent text-text-primary transition-colors flex-shrink-0 inline-block">
                Выставлен счет
            </button>
            <button class="status-filter-btn px-3 py-1.5 text-xs font-medium rounded-full bg-transparent text-text-primary transition-colors flex-shrink-0 inline-block">
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
    <div class="py-5 pb-20" style="background-color: var(--color-bg-secondary); width: 100vw; margin-left: calc(-50vw + 50%); min-height: calc(100vh - 200px);">
        <div class="px-[40px]">
            <!-- Services Table (desktop) -->
            <div class="hidden md:block">
                <div class="overflow-x-auto px-1">
                    <table class="w-full border-separate" style="border-spacing: 0 14px; table-layout: fixed;">
                <tbody>
                    @if(isset($serviceJournalList) && is_iterable($serviceJournalList) && $serviceJournalList->isNotEmpty())
                        @foreach($serviceJournalList as $service)
                            <tr class="bg-white shadow-sm transition-shadow hover:shadow rounded-lg service-row">
                                <!-- Услуга -->
                                <td class="px-4 py-4 whitespace-nowrap rounded-l-lg" style="width: 140px;">
                                    <div class="text-sm text-text-primary service-no">
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
                                            <div class="text-sm font-medium text-text-primary truncate client-name" title="{{ $service->client_full_name ?? 'N/A' }}">{{ $service->client_full_name ?? 'N/A' }}</div>
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
                                            <div class="text-sm text-text-primary truncate manager-name" title="{{ $service->manager_name ?? 'N/A' }}">{{ $service->manager_name ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium rounded-r-lg" style="width: 140px;">
                                    <div class="flex items-center space-x-2">
                                        <button onclick="openDocumentsModal({{ $service->id }}, '{{ $service->service_no ?? 'N/A' }}', '{{ $service->service_status_name ?? 'Не указан' }}')" class="text-green-600 hover:text-green-700 transition-colors" title="Просмотр документов">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
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
                            <button onclick="openDocumentsModal({{ $service->id }}, '{{ $service->service_no ?? 'N/A' }}', '{{ $service->service_status_name ?? 'Не указан' }}')" class="text-green-600" title="Просмотр документов">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
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

<!-- Documents Modal -->
<div id="documentsModal" class="fixed inset-0 z-50 flex items-center md:items-center items-end justify-center hidden" style="background: rgba(0,0,0,0.4);">
    <div class="bg-white w-full md:w-[90%] max-w-4xl h-[75vh] md:h-[60%] mx-0 md:mx-4 flex flex-col rounded-t-lg md:rounded-lg shadow-xl">
        <!-- Modal Header -->
        <div style="background-color: white;">
            <div class="p-6 pb-4">
                <div class="flex items-start justify-between mb-4">
                    <h3 class="font-semibold text-gray-900 text-xl md:text-[28px]" id="documentsModalTitle" style="margin-left: 20px;">Документы</h3>
                    <button onclick="closeDocumentsModal()" class="text-gray-400 hover:text-gray-600 transition-colors md:ml-[120px]">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <!-- Table headers under title (desktop only) -->
                <div class="hidden md:grid grid-cols-4 gap-4 text-xs font-medium text-gray-500 uppercase tracking-wider pb-2" style="margin-left: 20px;">
                    <div>Номер документа</div>
                    <div>Дата</div>
                    <div>Тип документа</div>
                    <div>Статус</div>
                </div>
            </div>
            <!-- Full width line (desktop only) -->
            <div class="hidden md:block w-full h-px bg-gray-300"></div>
        </div>
        
        <!-- Modal Body -->
        <div class="flex-1 overflow-y-auto p-6 bg-white md:bg-[var(--color-bg-secondary)]">
            <div id="documentsContent">
                <!-- Loading spinner -->
                <div class="flex items-center justify-center h-32">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-green-600"></div>
                </div>
            </div>
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

@media (max-width: 768px) {
    #documentsModal .bg-white {
        max-width: 100%;
        width: 100%;
        height: 75vh;
        border-radius: 1rem 1rem 0 0;
        margin-top: auto;
        display: flex;
        flex-direction: column;
    }
    
    #documentsModal h3 {
        font-size: 20px !important;
    }
    
    #documentsModalHeader {
        padding: 8px 16px 0 16px !important;
    }
    
    #documentsContent {
        flex: 1;
        overflow-y: auto;
        padding: 0 16px 8px 16px;
    }
    
    #documentsContent button {
        min-height: 44px;
        font-size: 14px;
    }
}
</style>

@push('scripts')
<script>
let currentServiceId = null;
let currentServiceNo = null;
let currentServiceStatus = null;

function openModal(modalId) {
    document.getElementById(modalId).style.display = 'flex';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

function openDocumentsModal(serviceId, serviceNo, serviceStatus) {
    console.log('Opening documents modal for service:', serviceId, serviceNo, serviceStatus);
    currentServiceId = serviceId;
    currentServiceNo = serviceNo;
    currentServiceStatus = serviceStatus || 'Не указан';
    
    // Update modal title
    document.getElementById('documentsModalTitle').textContent = `Документы №${serviceNo}`;
    
    // Show modal
    document.getElementById('documentsModal').classList.remove('hidden');
    
    // Show loading spinner
    document.getElementById('documentsContent').innerHTML = `
        <div class="flex items-center justify-center h-32">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-green-600"></div>
        </div>
    `;
    
    // Load documents via API
    loadServiceDocuments(serviceId);
}

function closeDocumentsModal() {
    document.getElementById('documentsModal').classList.add('hidden');
    currentServiceId = null;
    currentServiceNo = null;
    currentServiceStatus = null;
}

function loadServiceDocuments(serviceId) {
    const url = `/service_journal/vue/documents/list?serviceJournalId=${serviceId}`;
    console.log('Loading documents from:', url);
    
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(data) {
            console.log('Documents loaded:', data);
            if (data.serviceJournalDocuments) {
                renderDocuments(data.serviceJournalDocuments);
            } else {
                console.error('No documents in response');
                renderError('Ошибка загрузки документов');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading service documents:', error, xhr.responseText);
            renderError('Ошибка загрузки документов: ' + error);
        }
    });
}

function renderDocuments(documents) {
    console.log('Rendering documents:', documents, 'isMobile check');
    
    let documentsHtml = '';
    
    if (documents.length === 0) {
        document.getElementById('documentsContent').innerHTML = `
            <div class="text-center py-12">
                <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Нет документов</h3>
                <p class="text-sm text-gray-500">Для данной услуги документы не найдены</p>
            </div>
        `;
        return;
    }
    
    const isMobile = window.innerWidth <= 768;
    
    if (isMobile) {
        // Mobile version - vertical layout
        documentsHtml += '<div class="space-y-2">';
        
        documents.forEach((doc, index) => {
            const documentDate = new Date(doc.document_date).toLocaleDateString('ru-RU');
            
            documentsHtml += `
                <div class="pb-2 ${index < documents.length - 1 ? 'border-b border-gray-300' : ''}">
                    <div class="flex flex-col space-y-1">
                        <div class="flex items-center justify-between">
                            <div class="text-xs font-medium text-gray-500">Номер документа</div>
                            <div class="text-sm font-medium text-gray-900">${doc.document_no}</div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="text-xs font-medium text-gray-500">Дата</div>
                            <div class="text-sm text-gray-500">${documentDate}</div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="text-xs font-medium text-gray-500">Тип документа</div>
                            <div class="text-sm text-gray-500">${doc.document_type_name}</div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="text-xs font-medium text-gray-500">Статус</div>
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                <span class="text-sm text-gray-500">${currentServiceStatus}</span>
                            </div>
                        </div>
                        <div class="flex gap-2 mt-2">
                            <button onclick="downloadDocument(${doc.document_sub_type_id}, ${doc.document_type_id}, 0)" 
                                    class="flex-1 text-white font-medium transition-colors flex items-center justify-center gap-2" style="background-color: var(--color-primary); border-radius: var(--radius-3xl); padding: 4px 24px; min-width: 0;" onmouseover="this.style.backgroundColor='var(--color-primary-dark)'" onmouseout="this.style.backgroundColor='var(--color-primary)'">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Скачать
                            </button>
                            <button onclick="window.open('/service_journal/vue/documents/download?serviceJournalId=${currentServiceId}&documentTypeId=${doc.document_type_id}&documentSubTypeId=${doc.document_sub_type_id}&isCopy=0', '_blank')" 
                                    class="flex-1 font-medium transition-colors flex items-center justify-center gap-2" style="background-color: white; color: #374151; border-radius: var(--radius-3xl); border: 1px solid #d1d5db; padding: 4px 24px; min-width: 0;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='white'">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.023 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Просмотреть
                            </button>
                        </div>
                    </div>
                </div>
            `;
        });
        
        documentsHtml += '</div>';
    } else {
        // Desktop version - grid layout
        documentsHtml += `
            <div class="overflow-x-auto">
                <div class="grid grid-cols-4 gap-4">
        `;
        
        documents.forEach((doc, index) => {
            const documentDate = new Date(doc.document_date).toLocaleDateString('ru-RU');
            
            documentsHtml += `
                <div class="col-span-1 px-3 py-3 text-sm font-medium text-gray-900">${doc.document_no}</div>
                <div class="col-span-1 px-3 py-3 text-sm text-gray-500">${documentDate}</div>
                <div class="col-span-1 px-3 py-3 text-sm text-gray-500">${doc.document_type_name}</div>
                <div class="col-span-1 px-3 py-3 text-sm text-gray-500">
                    <div class="flex items-center gap-2">
                        <button onclick="window.open('/service_journal/vue/documents/download?serviceJournalId=${currentServiceId}&documentTypeId=${doc.document_type_id}&documentSubTypeId=${doc.document_sub_type_id}&isCopy=0', '_blank')" 
                                class="text-gray-400 hover:text-gray-600 transition-colors" 
                                title="Просмотреть">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.023 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-green-500"></div>
                            <span>${currentServiceStatus}</span>
                        </div>
                        <button onclick="downloadDocument(${doc.document_sub_type_id}, ${doc.document_type_id}, 0)" 
                                class="text-gray-400 hover:text-gray-600 transition-colors" 
                                title="Скачать">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            `;
            
            // Add full-width line after each row except the last
            if (index < documents.length - 1) {
                documentsHtml += `<div class="col-span-4 h-px bg-gray-300 ml-3 mr-12"></div>`;
            }
        });
        
        documentsHtml += `
                </div>
            </div>
        `;
    }
    
    document.getElementById('documentsContent').innerHTML = documentsHtml;
}

function renderError(message) {
    document.getElementById('documentsContent').innerHTML = `
        <div class="text-center py-12">
            <svg class="w-12 h-12 text-red-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Ошибка</h3>
            <p class="text-sm text-gray-500">${message}</p>
        </div>
    `;
}

function downloadDocument(documentSubTypeId, documentTypeId, isCopy) {
    const url = `/service_journal/vue/documents/download?serviceJournalId=${currentServiceId}&documentTypeId=${documentTypeId}&documentSubTypeId=${documentSubTypeId}&isCopy=${isCopy}`;
    
    // Создаем временную ссылку для скачивания
    const link = document.createElement('a');
    link.href = url;
    link.target = '_blank';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function openConfirmPaymentModal(serviceJournalId, invoiceTypeId, amount, currency) {
    console.log('Opening confirm payment modal for service:', serviceJournalId, 'invoiceType:', invoiceTypeId);

    // Store current payment data
    currentPaymentData = {
        serviceJournalId: serviceJournalId,
        invoiceTypeId: invoiceTypeId,
        amount: amount,
        currency: currency
    };

    // Set modal content
    const modalTitle = document.getElementById('confirmPaymentModalTitle');
    const paymentTypeText = invoiceTypeId === 2 ? 'предоплаты' : 'полной оплаты';
    modalTitle.textContent = `Подтверждение ${paymentTypeText}`;

    const amountText = document.getElementById('confirmPaymentAmount');
    amountText.textContent = `Сумма: ${Number(amount).toLocaleString('ru-RU')} ${currency}`;

    // Clear form fields
    document.getElementById('confirmPaymentDocumentNo').value = '';
    document.getElementById('confirmPaymentDocumentDate').value = new Date().toISOString().split('T')[0];

    // Show modal
    document.getElementById('confirmPaymentModal').classList.remove('hidden');
}

function closeConfirmPaymentModal() {
    document.getElementById('confirmPaymentModal').classList.add('hidden');
    currentPaymentData = null;
}

function confirmPayment() {
    if (!currentPaymentData) {
        console.error('No payment data available');
        return;
    }

    const documentNo = document.getElementById('confirmPaymentDocumentNo').value.trim();
    const documentDate = document.getElementById('confirmPaymentDocumentDate').value;

    if (!documentNo || !documentDate) {
        alert('Пожалуйста, заполните номер счета и дату оплаты');
        return;
    }

    console.log('Confirming payment:', {
        serviceJournalId: currentPaymentData.serviceJournalId,
        invoiceTypeId: currentPaymentData.invoiceTypeId,
        documentNo: documentNo,
        documentDate: documentDate
    });

    // Show loading state
    const confirmBtn = document.querySelector('#confirmPaymentModal button[type="submit"]');
    const originalText = confirmBtn.textContent;
    confirmBtn.textContent = 'Подтверждаем...';
    confirmBtn.disabled = true;

    // Send AJAX request
    $.ajax({
        url: `/accountant/vue/services/confirmPayment`,
        type: 'POST',
        data: {
            serviceJournalId: currentPaymentData.serviceJournalId,
            invoiceTypeId: currentPaymentData.invoiceTypeId,
            documentNo: documentNo,
            documentDate: documentDate,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(data) {
            console.log('Payment confirmed:', data);

            // Close modal
            closeConfirmPaymentModal();

            // Show success message
            showNotification('Оплата успешно подтверждена', 'success');

            // Reload current status data to update the UI
            const activeStatus = document.querySelector('.status-filter-btn.bg-gray-200')?.textContent?.trim() || 'Все услуги';
            loadServicesByStatus(activeStatus);
        },
        error: function(xhr, status, error) {
            console.error('Error confirming payment:', error, xhr.responseText);

            // Reset button
            confirmBtn.textContent = originalText;
            confirmBtn.disabled = false;

            // Show error message
            showNotification('Ошибка при подтверждении оплаты: ' + error, 'error');
        }
    });
}

function showNotification(message, type) {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg transition-all duration-300 ${
        type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    }`;
    notification.textContent = message;

    document.body.appendChild(notification);

    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
    if (event.target.id === 'documentsModal') {
        closeDocumentsModal();
    }
    if (event.target.id === 'confirmPaymentModal') {
        closeConfirmPaymentModal();
    }
}

// Status filter functionality
function filterByStatus(status, clickedBtn) {
    console.log('Filtering by status:', status);

    // Make all filters transparent (no background)
    document.querySelectorAll('.status-filter-btn').forEach(btn => {
        // remove any bg-* classes
        [...btn.classList].forEach(cls => { if (cls.startsWith('bg-')) btn.classList.remove(cls); });
        btn.classList.add('bg-transparent');
        btn.classList.add('text-text-primary');
    });

    // Set active (gray background) on clicked
    clickedBtn.classList.remove('bg-transparent');
    clickedBtn.classList.add('bg-gray-200', 'text-text-primary');

    // Load data from server based on status
    loadServicesByStatus(status);
}

function loadServicesByStatus(status) {
    console.log('Loading services for status:', status);

    // Show loading spinner
    const servicesContainer = document.querySelector('.py-5.pb-20');
    servicesContainer.innerHTML = `
        <div class="flex items-center justify-center h-32">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-green-600"></div>
        </div>
    `;

    // Determine serviceStatusId based on status text
    let serviceStatusId = 0; // Default for "Все услуги"

    if (status === 'Создание') serviceStatusId = 1;
    else if (status === 'Проверка клиента') serviceStatusId = 2;
    else if (status === 'Предоплата') serviceStatusId = 8;
    else if (status === 'Сбор данных') serviceStatusId = 3;
    else if (status === 'Проверка') serviceStatusId = 4;
    else if (status === 'Выполнение услуги') serviceStatusId = 5;
    else if (status === 'Оплата') serviceStatusId = 6;
    else if (status === 'Выполнена') serviceStatusId = 7;
    else if (status === 'Выставлен счет') serviceStatusId = 9;
    else if (status === 'Отклонена') serviceStatusId = 10;

    // Make AJAX request to server
    $.ajax({
        url: `/accountant/vue/services/list`,
        type: 'GET',
        data: {
            serviceStatusId: serviceStatusId
        },
        dataType: 'json',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(data) {
            console.log('Services loaded:', data);
            if (data.serviceJournalList) {
                renderServicesTable(data.serviceJournalList, servicesContainer);
            } else {
                console.error('No services in response');
                renderError('Ошибка загрузки услуг', servicesContainer);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading services:', error, xhr.responseText);
            renderError('Ошибка загрузки услуг: ' + error, servicesContainer);
        }
    });
}

function renderServicesTable(services, container) {
    console.log('Rendering services table with', services.length, 'services');

    let tableHtml = '';

    if (services.length === 0) {
        tableHtml = `
            <div class="text-center py-12">
                <svg class="w-12 h-12 text-text-muted mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        `;
    } else {
        // Desktop table
        tableHtml = `
            <div class="px-[40px]">
                <div class="hidden md:block">
                    <div class="overflow-x-auto px-1">
                        <table class="w-full border-separate" style="border-spacing: 0 14px; table-layout: fixed;">
                            <tbody>
        `;

        services.forEach(service => {
            tableHtml += `
                <tr class="bg-white shadow-sm transition-shadow hover:shadow rounded-lg service-row">
                    <!-- Услуга -->
                    <td class="px-4 py-4 whitespace-nowrap rounded-l-lg" style="width: 140px;">
                        <div class="text-sm text-text-primary service-no">
                            ${service.service_no || 'N/A'}
                        </div>
                    </td>
                    <!-- ФИО/Название компании -->
                    <td class="px-4 py-4" style="width: auto;">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-sm font-medium text-green-600">
                                    ${service.client_full_name ? service.client_full_name.charAt(0) : 'N'}
                                </span>
                            </div>
                            <div class="ml-3 min-w-0">
                                <div class="text-sm font-medium text-text-primary truncate client-name" title="${service.client_full_name || 'N/A'}">${service.client_full_name || 'N/A'}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap" style="width: 140px;">
                        <div class="text-sm font-medium text-text-primary">
                            ${service.amount ? Number(service.amount).toLocaleString('ru-RU') : '0'} ₸
                        </div>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap" style="width: 120px;">
                        <div class="text-sm text-text-muted">
                            ${service.deadline ? new Date(service.deadline).toLocaleDateString('ru-RU') : 'N/A'}
                        </div>
                    </td>
                    <td class="px-4 py-4" style="width: 160px;">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white border border-border-light text-text-primary">
                            <svg class="w-3 h-3 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="truncate">${service.service_status_name || 'N/A'}</span>
                        </span>
                    </td>
                    <td class="px-4 py-4" style="width: 180px;">
                        <div class="flex items-center">
                            <div class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-xs font-medium text-gray-600">
                                    ${service.manager_full_name ? service.manager_full_name.charAt(0) : 'N'}
                                </span>
                            </div>
                            <div class="ml-2 min-w-0">
                                <div class="text-sm text-text-primary truncate manager-name" title="${service.manager_full_name || 'N/A'}">${service.manager_full_name || 'N/A'}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap" style="width: 120px;">
                        ${service.is_prepayment_paid == 0 && service.prepayment_amount ?
                            `<div class="flex items-center justify-between p-2 bg-red-50 border border-red-200 rounded-lg">
                                <div class="text-xs">
                                    <div class="font-medium text-red-800">${Number(service.prepayment_amount).toLocaleString('ru-RU')} ₸</div>
                                    <div class="text-red-600">Предоплата</div>
                                </div>
                                <button onclick="openConfirmPaymentModal(${service.id}, 2, '${service.prepayment_amount}', '${service.currency_name}')" class="text-green-600 hover:text-green-700 transition-colors" title="Подтвердить предоплату">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </button>
                            </div>` :
                            `<div class="text-center text-green-600">
                                <svg class="w-5 h-5 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <div class="text-xs mt-1">Оплачено</div>
                            </div>`
                        }
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap" style="width: 120px;">
                        ${service.is_final_paid == 0 && service.final_amount ?
                            `<div class="flex items-center justify-between p-2 bg-red-50 border border-red-200 rounded-lg">
                                <div class="text-xs">
                                    <div class="font-medium text-red-800">${Number(service.final_amount).toLocaleString('ru-RU')} ₸</div>
                                    <div class="text-red-600">Полная оплата</div>
                                </div>
                                <button onclick="openConfirmPaymentModal(${service.id}, 3, '${service.final_amount}', '${service.currency_name}')" class="text-green-600 hover:text-green-700 transition-colors" title="Подтвердить полную оплату">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </button>
                            </div>` :
                            `<div class="text-center text-green-600">
                                <svg class="w-5 h-5 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <div class="text-xs mt-1">Оплачено</div>
                            </div>`
                        }
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium rounded-r-lg" style="width: 140px;">
                        <div class="flex items-center space-x-2">
                            <button onclick="openDocumentsModal(${service.id}, '${service.service_no || 'N/A'}', '${service.service_status_name || 'Не указан'}')" class="text-green-600 hover:text-green-700 transition-colors" title="Просмотр документов">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </button>

                        </div>
                    </td>
                </tr>
            `;
        });

        tableHtml += `
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Mobile cards -->
                <div class="md:hidden space-y-3">
        `;

        services.forEach(service => {
            tableHtml += `
                <div class="bg-white rounded-lg shadow-sm px-4 py-3">
                    <!-- Top: Услуга + Стоимость -->
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-sm font-medium text-text-primary">УСЛ-${service.service_no || 'N/A'}</div>
                        <div class="text-sm font-semibold text-text-primary">${service.amount ? Number(service.amount).toLocaleString('ru-RU') : '0'} ₸</div>
                    </div>
                    <!-- Клиент -->
                    <div class="mb-2">
                        <div class="text-[11px] text-text-muted mb-1">ФИО/Название компании</div>
                        <div class="flex items-center">
                            <div class="w-7 h-7 bg-primary-100 rounded-full flex items-center justify-center">
                                <span class="text-xs font-medium text-green-600">${service.client_full_name ? service.client_full_name.charAt(0) : 'N'}</span>
                            </div>
                            <div class="ml-2 text-sm text-text-primary">${service.client_full_name || 'N/A'}</div>
                        </div>
                    </div>
                    <!-- Срок и Статус -->
                    <div class="flex items-center justify-between mb-2">
                        <div>
                            <div class="text-[11px] text-text-muted mb-1">Срок</div>
                            <div class="text-sm text-text-primary">${service.deadline ? new Date(service.deadline).toLocaleDateString('ru-RU') : 'N/A'}</div>
                        </div>
                        <div>
                            <div class="text-[11px] text-text-muted mb-1">Статус</div>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-white border border-border-light text-text-primary">${service.service_status_name || 'N/A'}</span>
                        </div>
                    </div>
                    <!-- Менеджер и Действия -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center">
                                <span class="text-[10px] font-medium text-gray-600">${service.manager_full_name ? service.manager_full_name.charAt(0) : 'N'}</span>
                            </div>
                            <div class="ml-2 text-sm text-text-primary">${service.manager_full_name || 'N/A'}</div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button onclick="openDocumentsModal(${service.id}, '${service.service_no || 'N/A'}', '${service.service_status_name || 'Не указан'}')" class="text-green-600" title="Просмотр документов">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </button>
                            <button class="text-text-muted" title="Редактировать">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </button>
                            <button class="text-red-600" title="Удалить">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            `;
        });

        tableHtml += `
                </div>
            </div>
        `;
    }

    container.innerHTML = tableHtml;
    console.log('Services table rendered');
}

function renderError(message, container) {
    container.innerHTML = `
        <div class="text-center py-12">
            <svg class="w-12 h-12 text-red-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Ошибка</h3>
            <p class="text-sm text-gray-500">${message}</p>
        </div>
    `;
}

// Initialize event listeners when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Add click handlers for status filter buttons
    const statusFilterButtons = document.querySelectorAll('.status-filter-btn');
    statusFilterButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            const status = this.textContent.trim();
            filterByStatus(status, this);
        });
    });

    // Initialize default active: first button ("Все услуги") gray, others transparent
    if (statusFilterButtons.length > 0) {
        // reset all to transparent
        statusFilterButtons.forEach(btn => {
            [...btn.classList].forEach(cls => { if (cls.startsWith('bg-')) btn.classList.remove(cls); });
            btn.classList.add('bg-transparent');
        });
        statusFilterButtons[0].classList.remove('bg-transparent');
        statusFilterButtons[0].classList.add('bg-gray-200');
    }

    // Load initial data - all services (serviceStatusId = 0)
    loadServicesByStatus('Все услуги');

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

    // Add click handlers for "Add Service" buttons
    const addServiceButtons = document.querySelectorAll('button');
    addServiceButtons.forEach(button => {
        if (button.textContent.includes('Добавить')) {
            button.onclick = function() {
                openModal('add-service-modal');
            };
        }
    });
});

console.log('Accountant services page loaded and initialized');

</script>
@endpush

<!-- Confirm Payment Modal -->
<div id="confirmPaymentModal" class="modal hidden">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="confirmPaymentModalTitle" class="modal-title">Подтверждение оплаты</h3>
            <button type="button" class="modal-close" onclick="closeConfirmPaymentModal()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <div class="mb-4">
                <div id="confirmPaymentAmount" class="text-lg font-semibold text-gray-900 mb-4"></div>

                <div class="mb-4">
                    <label for="confirmPaymentDocumentNo" class="block text-sm font-medium text-gray-700 mb-2">
                        Номер счета на оплату
                    </label>
                    <input type="text" id="confirmPaymentDocumentNo" name="confirmPaymentDocumentNo"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                           placeholder="Введите номер счета">
                </div>

                <div class="mb-4">
                    <label for="confirmPaymentDocumentDate" class="block text-sm font-medium text-gray-700 mb-2">
                        Дата оплаты
                    </label>
                    <input type="date" id="confirmPaymentDocumentDate" name="confirmPaymentDocumentDate"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeConfirmPaymentModal()">
                Отмена
            </button>
            <button type="submit" class="btn btn-primary" onclick="confirmPayment()">
                Подтвердить оплату
            </button>
        </div>
    </div>
</div>

@endsection.modal.hidden { display: none !important; }
function openConfirmPaymentModal(serviceJournalId, invoiceTypeId, amount, currency) {\r\n    console.log(\x27Opening confirm payment modal for service:\x27, serviceJournalId, \x27invoiceType:\x27, invoiceTypeId);\r\n\r\n    // Validate parameters\r\n    if (!serviceJournalId || !invoiceTypeId || !amount || !currency) {\r\n        console.error(\x27Invalid parameters for openConfirmPaymentModal:\x27, { serviceJournalId, invoiceTypeId, amount, currency });\r\n        return;\r\n    }\r\n\r\n    // Store current payment data\r\n    currentPaymentData = {\r\n        serviceJournalId: serviceJournalId,\r\n        invoiceTypeId: invoiceTypeId,\r\n        amount: amount,\r\n        currency: currency\r\n    };\r\n\r\n    // Set modal content\r\n    const modalTitle = document.getElementById(\x27confirmPaymentModalTitle\x27);\r\n    const paymentTypeText = invoiceTypeId === 2 ? \x27����������\x27 : \x27������ ������\x27;\r\n    modalTitle.textContent = \x60������������� \x60;\r\n\r\n    const amountText = document.getElementById(\x27confirmPaymentAmount\x27);\r\n    amountText.textContent = \x60�����:  \x60;\r\n\r\n    // Clear form fields\r\n    document.getElementById(\x27confirmPaymentDocumentNo\x27).value = \x27\x27;\r\n    document.getElementById(\x27confirmPaymentDocumentDate\x27).value = new Date().toISOString().split(\x27T\x27)[0];\r\n\r\n    // Show modal\r\n    document.getElementById(\x27confirmPaymentModal\x27).classList.remove(\x27hidden\x27);\r\n}
    // Check if modal exists\r\n    const modal = document.getElementById(\x27confirmPaymentModal\x27);\r\n    if (!modal) {\r\n        console.error(\x27Confirm payment modal not found\x27);\r\n        return;\r\n    }\r\n\r\n    // Show modal\r\n    modal.classList.remove(\x27hidden\x27);
\r\n// Enhanced confirm payment modal function with parameter validation\r\nfunction openConfirmPaymentModal(serviceJournalId, invoiceTypeId, amount, currency) {\r\n    console.log(\x27Opening confirm payment modal for service:\x27, serviceJournalId, \x27invoiceType:\x27, invoiceTypeId);\r\n\r\n    // Validate parameters - prevent automatic calls without parameters\r\n    if (!serviceJournalId || !invoiceTypeId || !amount || !currency) {\r\n        console.error(\x27Invalid or missing parameters for openConfirmPaymentModal:\x27, {\r\n            serviceJournalId: serviceJournalId,\r\n            invoiceTypeId: invoiceTypeId,\r\n            amount: amount,\r\n            currency: currency\r\n        });\r\n        return;\r\n    }\r\n\r\n    // Additional check - ensure modal exists\r\n    const modal = document.getElementById(\x27confirmPaymentModal\x27);\r\n    if (!modal) {\r\n        console.error(\x27Confirm payment modal element not found\x27);\r\n        return;\r\n    }\r\n\r\n    // Store current payment data\r\n    currentPaymentData = {\r\n        serviceJournalId: serviceJournalId,\r\n        invoiceTypeId: invoiceTypeId,\r\n        amount: amount,\r\n        currency: currency\r\n    };\r\n\r\n    // Set modal content\r\n    const modalTitle = document.getElementById(\x27confirmPaymentModalTitle\x27);\r\n    if (modalTitle) {\r\n        const paymentTypeText = invoiceTypeId === 2 ? \x27����������\x27 : \x27������ ������\x27;\r\n        modalTitle.textContent = \x60������������� \x60;\r\n    }\r\n\r\n    const amountText = document.getElementById(\x27confirmPaymentAmount\x27);\r\n    if (amountText) {\r\n        amountText.textContent = \x60�����:  \x60;\r\n    }\r\n\r\n    // Clear form fields with null checks\r\n    const docNoInput = document.getElementById(\x27confirmPaymentDocumentNo\x27);\r\n    const docDateInput = document.getElementById(\x27confirmPaymentDocumentDate\x27);\r\n    if (docNoInput) docNoInput.value = \x27\x27;\r\n    if (docDateInput) docDateInput.value = new Date().toISOString().split(\x27T\x27)[0];\r\n\r\n    // Show modal\r\n    modal.classList.remove(\x27hidden\x27);\r\n    console.log(\x27Confirm payment modal opened successfully\x27);\r\n}\r\n
\r\n    // Ensure confirm payment modal is hidden on page load\r\n    const confirmPaymentModal = document.getElementById(\x27confirmPaymentModal\x27);\r\n    if (confirmPaymentModal) {\r\n        confirmPaymentModal.classList.add(\x27hidden\x27);\r\n        console.log(\x27Confirm payment modal hidden on page load\x27);\r\n    }\r\n\r\n    // Reset payment data\r\n    currentPaymentData = null;
