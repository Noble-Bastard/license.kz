@extends('layouts.client-app')

@section('title', 'Услуги')

@section('content')
<div class="w-full">
    <!-- Page Header -->
    <div class="flex items-center justify-between px-5 py-3" style="padding-left:20px;padding-right:20px;">
        <h1 class="text-[32px] md:text-[39px] leading-[1] font-normal tracking-[-0.02em] text-text-primary">Услуги</h1>
        <div class="hidden md:flex items-center gap-[11px] px-[16px] pr-[22px] py-[11px] h-[46px] border border-border-light rounded-[80px] bg-white mr-2">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.8333 15.8333L13.2083 13.2083" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <input type="text" placeholder="Поиск по номеру услуги или компании" class="bg-transparent border-none outline-none text-[12px] font-medium leading-[1] text-text-primary placeholder:text-text-primary" id="searchInput" />
        </div>
    </div>
    
    <!-- Mobile Search -->
    <div class="md:hidden mb-3 px-5" style="padding-left:20px;padding-right:20px;">
        <div class="flex justify-end">
            <div class="flex items-center justify-center w-[46px] h-[46px] border border-border-light rounded-[80px] bg-white">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.8333 15.8333L13.2083 13.2083" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
        </div>
    </div>

    <!-- Status Filter Tabs -->
    <div class="px-5" style="padding-left:20px;padding-right:20px;">
        <div class="flex items-center gap-[10px] mb-[16px] md:flex-wrap overflow-x-auto md:overflow-x-visible">
            <button onclick="filterServices('all')" 
                    id="filter-all"
                    class="px-[14px] py-[10px] rounded-[80px] text-[12px] font-medium flex-shrink-0 bg-gray-200 text-text-primary">
                Все услуги
            </button>
            <button onclick="filterServices('open')" 
                    id="filter-open"
                    class="px-[14px] py-[10px] rounded-[80px] text-[12px] font-medium flex-shrink-0 text-text-primary">
                Открытые
            </button>
            <button onclick="filterServices('closed')" 
                    id="filter-closed"
                    class="px-[14px] py-[10px] rounded-[80px] text-[12px] font-medium flex-shrink-0 text-text-primary">
                Закрытые
            </button>
        </div>
    </div>

    <!-- Desktop Headers -->
    <div class="hidden md:grid grid-cols-[200px,150px,200px,200px,150px] gap-[60px,120px,60px,60px,0px] items-center mx-5 mb-3 px-5 py-3">
        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Номер услуги</div>
        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Статус</div>
        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Менеджер</div>
        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Выполнение</div>
        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Действие</div>
    </div>

    <!-- Services List -->
    <div class="px-5" style="padding-left:20px;padding-right:20px;">
        @if(isset($serviceJournalList) && $serviceJournalList->isNotEmpty())
            @foreach($serviceJournalList as $service)
                <!-- Desktop Card View -->
                <div class="hidden md:grid grid-cols-[200px,150px,200px,200px,150px] gap-[60px,120px,60px,60px,0px] items-center bg-white rounded-lg shadow-sm mb-3 p-5 service-card">
                    <!-- Service Number -->
                    <div class="flex items-center gap-[10px]">
                        <span class="text-sm font-medium text-[#1E2B28] leading-[1] service-no">УСЛ-{{ $service->service_no }}</span>
                    </div>
                    
                    <!-- Status -->
                    <div class="flex items-center gap-[6px]">
                        @php
                            $statusName = $service->service_status_name ?? 'Неизвестно';
                            $statusClass = 'bg-gray-100 text-gray-800';
                            
                            if (str_contains(strtolower($statusName), 'завершен') || str_contains(strtolower($statusName), 'выполнен') || str_contains(strtolower($statusName), 'выполнено')) {
                                $statusClass = 'bg-green-100 text-green-800';
                            } elseif (str_contains(strtolower($statusName), 'ожидает') || str_contains(strtolower($statusName), 'процесс') || str_contains(strtolower($statusName), 'работе')) {
                                $statusClass = 'bg-yellow-100 text-yellow-800';
                            } elseif (str_contains(strtolower($statusName), 'новый')) {
                                $statusClass = 'bg-blue-100 text-blue-800';
                            } elseif (str_contains(strtolower($statusName), 'отменен')) {
                                $statusClass = 'bg-red-100 text-red-800';
                            }
                        @endphp
                        <div class="w-2 h-2 rounded-full {{ $statusClass }}"></div>
                        <span class="text-[13px] font-medium text-[#1E2B28] leading-[1]">{{ $statusName }}</span>
                    </div>
                    
                    <!-- Manager -->
                    <div class="flex items-center gap-[10px]">
                        @if($service->manager_full_name)
                            <div class="w-[26px] h-[26px] rounded-full bg-neutral-300 overflow-hidden">
                                <div class="w-full h-full bg-neutral-200 flex items-center justify-center">
                                    <span class="text-xs font-medium text-gray-600">{{ substr($service->manager_full_name, 0, 1) }}</span>
                                </div>
                            </div>
                            <span class="text-[13px] font-medium text-[#1E2B28] leading-[1] manager-name">{{ $service->manager_full_name }}</span>
                        @else
                            <div class="w-[26px] h-[26px] rounded-full bg-neutral-300 overflow-hidden">
                                <div class="w-full h-full bg-neutral-200 flex items-center justify-center">
                                    <svg class="h-3 w-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <span class="text-[13px] font-medium text-[#1E2B28] leading-[1]">Не назначен</span>
                        @endif
                    </div>
                    
                    <!-- Process Execution -->
                    <div class="flex items-center gap-[6px]">
                        @php
                            $totalSteps = $service->serviceJournalStepList ? $service->serviceJournalStepList->count() : 0;
                            $completedSteps = $service->serviceJournalStepList ? $service->serviceJournalStepList->where('is_completed', 1)->count() : 0;
                            $processText = $totalSteps > 0 ? "{$completedSteps}/{$totalSteps}" : "0/0";
                        @endphp
                        <span class="text-[13px] font-medium text-[#1E2B28] leading-[1]">{{ $processText }}</span>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-2">
                        <button onclick="openServiceStepsModal({{ $service->id }})" 
                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md border border-border-light text-xs text-text-primary hover:bg-bg-tertiary transition">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Просмотр
                        </button>
                    </div>
                </div>

                <!-- Mobile Card View -->
                <div class="md:hidden bg-white rounded-lg shadow-sm mb-3 p-4 service-card">
                    <!-- Header with service number and status -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-[10px]">
                            <span class="text-base font-medium text-[#1E2B28] leading-[1] service-no">УСЛ-{{ $service->service_no }}</span>
                        </div>
                        <div class="flex items-center gap-[6px] flex-shrink-0">
                            @php
                                $statusName = $service->service_status_name ?? 'Неизвестно';
                                $statusClass = 'bg-gray-100 text-gray-800';
                                if (str_contains(strtolower($statusName), 'завершен') || str_contains(strtolower($statusName), 'выполнен') || str_contains(strtolower($statusName), 'выполнено')) {
                                    $statusClass = 'bg-green-100 text-green-800';
                                } elseif (str_contains(strtolower($statusName), 'ожидает') || str_contains(strtolower($statusName), 'процесс') || str_contains(strtolower($statusName), 'работе')) {
                                    $statusClass = 'bg-yellow-100 text-yellow-800';
                                } elseif (str_contains(strtolower($statusName), 'новый')) {
                                    $statusClass = 'bg-blue-100 text-blue-800';
                                } elseif (str_contains(strtolower($statusName), 'отменен')) {
                                    $statusClass = 'bg-red-100 text-red-800';
                                }
                            @endphp
                            <div class="w-2 h-2 rounded-full {{ $statusClass }}"></div>
                            <span class="text-sm font-medium text-[#1E2B28]">{{ $statusName }}</span>
                        </div>
                    </div>
                    
                    <!-- Details - Vertical Layout -->
                    <div class="space-y-3">
                        <div class="flex flex-col">
                            <span class="text-xs font-medium text-gray-500 mb-1">Менеджер</span>
                            <div class="flex items-center gap-[10px]">
                                @if($service->manager_full_name)
                                    <div class="w-[32px] h-[32px] rounded-full bg-neutral-300 overflow-hidden flex-shrink-0">
                                        <div class="w-full h-full bg-neutral-200 flex items-center justify-center">
                                            <span class="text-sm font-medium text-gray-600">{{ substr($service->manager_full_name, 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <span class="text-sm font-medium text-[#1E2B28] manager-name">{{ $service->manager_full_name }}</span>
                                @else
                                    <div class="w-[32px] h-[32px] rounded-full bg-neutral-300 overflow-hidden flex-shrink-0">
                                        <div class="w-full h-full bg-neutral-200 flex items-center justify-center">
                                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <span class="text-sm font-medium text-[#1E2B28]">Не назначен</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex flex-col">
                            <span class="text-xs font-medium text-gray-500 mb-1">Выполнение</span>
                            @php
                                $totalSteps = $service->serviceJournalStepList ? $service->serviceJournalStepList->count() : 0;
                                $completedSteps = $service->serviceJournalStepList ? $service->serviceJournalStepList->where('is_completed', 1)->count() : 0;
                                $processText = $totalSteps > 0 ? "{$completedSteps}/{$totalSteps}" : "0/0";
                            @endphp
                            <span class="text-sm font-medium text-[#1E2B28]">{{ $processText }}</span>
                        </div>
                        
                        <!-- Actions -->
                        <div class="flex justify-end mt-4">
                            <button onclick="openServiceStepsModal({{ $service->id }})" 
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-md border border-border-light text-sm text-text-primary hover:bg-bg-tertiary transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Просмотр услуги
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="bg-white rounded-lg shadow-sm mb-3 p-5">
                <div class="text-center py-12">
                    <div class="text-text-secondary">
                        <svg class="mx-auto mb-4" width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 3c-3.866 0-7 3.134-7 7v3.5L3 16v1h18v-1l-2-2.5V10c0-3.866-3.134-7-7-7z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 19a3 3 0 006 0" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <p class="text-lg font-medium">Услуги не найдены</p>
                        <p class="mt-1">Попробуйте изменить параметры фильтрации</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Pagination -->
        @if(isset($serviceJournalList) && method_exists($serviceJournalList, 'hasPages') && $serviceJournalList->hasPages())
            <div class="flex justify-center items-center mt-8">
                <div class="flex items-center space-x-2">
                    @php
                        $currentPage = $serviceJournalList->currentPage();
                        $lastPage = $serviceJournalList->lastPage();
                        $startPage = max(1, $currentPage - 2);
                        $endPage = min($lastPage, $currentPage + 2);
                    @endphp
                    
                    @for($i = $startPage; $i <= $endPage; $i++)
                        <button class="w-8 h-8 rounded-full text-sm font-medium {{ $i === $currentPage ? 'bg-[#279760] text-white' : 'bg-white text-text-primary border border-border-light hover:bg-bg-tertiary' }} transition-colors">
                            {{ $i }}
                        </button>
                    @endfor
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Service Steps Modal -->
       <div id="serviceStepsModal" class="fixed inset-0 z-50 hidden items-center justify-center" style="background: rgba(0,0,0,0.4);">
    <div class="bg-white w-full max-w-[800px] h-[600px] max-h-[90vh] mx-4 flex flex-col shadow-2xl md:rounded-none" style="border-radius: 0; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); border: 1px solid var(--color-border-light);">
        <!-- Modal content will be loaded here -->
    </div>
</div>

@endsection

<style>
/* Modal Animation Styles */
#serviceStepsModal {
    transition: opacity 0.3s ease-in-out;
}

#serviceStepsModal .bg-white {
    transform: scale(0.95);
    transition: transform 0.3s ease-in-out;
}

#serviceStepsModal:not(.hidden) .bg-white {
    transform: scale(1);
}

/* Mobile Modal Styles - Bottom Sheet */
@media (max-width: 768px) {
    #serviceStepsModal {
        align-items: flex-end !important;
        justify-content: center !important;
    }
    
    #serviceStepsModal .bg-white {
        width: 100% !important;
        max-width: none !important;
        height: 60vh !important;
        max-height: 60vh !important;
        margin: 0 !important;
        border-radius: 0 !important;
        transform: translateY(100%) !important;
        transition: transform 0.3s ease-in-out !important;
    }
    
    #serviceStepsModal:not(.hidden) .bg-white {
        transform: translateY(0) !important;
    }
}

/* Custom scrollbar for modal content */
#serviceStepsModal .overflow-y-auto::-webkit-scrollbar {
    width: 6px;
}

#serviceStepsModal .overflow-y-auto::-webkit-scrollbar-track {
    background: var(--color-bg-secondary);
}

#serviceStepsModal .overflow-y-auto::-webkit-scrollbar-thumb {
    background: var(--color-border-medium);
    border-radius: 3px;
}

#serviceStepsModal .overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: var(--color-border-muted);
}

/* Clean text styling */
.modal-step-text {
    transition: color 0.2s ease-in-out;
}
</style>

<script>
let currentServiceId = null;
let currentServiceData = null;

function openServiceStepsModal(serviceId) {
    console.log('Opening service steps modal for service:', serviceId);
    currentServiceId = serviceId;
    // Show modal
    document.getElementById('serviceStepsModal').classList.remove('hidden');
    document.getElementById('serviceStepsModal').classList.add('flex');
    
    // Load modal content via AJAX
    fetch(`/client/service-steps/${serviceId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                currentServiceData = data.service || null;
                renderServiceSteps(data.steps);
            } else {
                console.error('Error loading service steps:', data.error);
                renderError(data.error);
            }
        })
        .catch(error => {
            console.error('Error loading service steps:', error);
            renderError('Ошибка загрузки шагов услуги');
        });
}

function closeServiceStepsModal() {
    document.getElementById('serviceStepsModal').classList.add('hidden');
    document.getElementById('serviceStepsModal').classList.remove('flex');
    currentServiceId = null;
    currentServiceData = null;
}

function getServiceCreationDate() {
    if (currentServiceData && currentServiceData.created_at) {
        const date = new Date(currentServiceData.created_at);
        return date.toLocaleDateString('ru-RU');
    }
    return 'дата неизвестна';
}

function getManagerName() {
    if (currentServiceData && currentServiceData.manager_full_name) {
        return currentServiceData.manager_full_name;
    }
    return 'Не назначен';
}

function getManagerInitial() {
    if (currentServiceData && currentServiceData.manager_full_name) {
        return currentServiceData.manager_full_name.charAt(0).toUpperCase();
    }
    return '?';
}


function renderServiceSteps(steps) {
    const modalContent = document.querySelector('#serviceStepsModal .bg-white');
    
    let stepsHtml = '';
    if (steps && steps.length > 0) {
        steps.forEach((step, index) => {
            // Показываем описание только если оно есть
            if (step.description && step.description.trim() !== '') {
                const stepDate = step.created_at ? new Date(step.created_at).toLocaleDateString('ru-RU') : '';
                
                // Определяем статус шага и соответствующую иконку
                let stepIcon = '';
                let iconColor = '';
                
                if (step.is_completed) {
                    // Выполнен - галочка
                    stepIcon = `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>`;
                    iconColor = 'var(--color-primary)';
                } else if (step.execution_start_date) {
                    // В процессе - часы
                    stepIcon = `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                        <path d="M12 6V12L16 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>`;
                    iconColor = 'var(--color-status-error)';
                } else {
                    // Не начат - пустой круг
                    stepIcon = `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                    </svg>`;
                    iconColor = 'var(--color-text-muted)';
                }
                
                stepsHtml += `
                    <div class="mb-4 modal-step-text" style="margin-bottom: var(--spacing-4); margin-left: var(--spacing-4); position: relative;">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start gap-3" style="flex: 1; margin-right: var(--spacing-4);">
                                <div class="flex-shrink-0" style="color: var(--color-text-muted); position: relative;">
                                    ${stepIcon}
                                </div>
                                <p style="color: var(--color-text-primary); font-family: var(--font-family-sans); font-weight: var(--font-weight-medium); font-size: var(--font-size-sm); line-height: var(--line-height-normal);">${step.description}</p>
                            </div>
                            ${stepDate ? `<p style="color: var(--color-text-muted); font-family: var(--font-family-sans); font-size: var(--font-size-sm); margin: 0; white-space: nowrap;">${stepDate}</p>` : ''}
                        </div>
                        ${index < steps.length - 1 ? '<div style="position: absolute; top: 20px; left: 7px; width: 2px; height: calc(100% - 12px); background-color: var(--color-border-medium);"></div>' : ''}
                    </div>
                `;
            }
        });
        
        // Если после фильтрации не осталось шагов с описанием
        if (stepsHtml.trim() === '') {
            stepsHtml = `
                <div class="text-center py-8" style="color: var(--color-text-muted); padding: var(--spacing-20) 0;">
                    <p style="font-family: var(--font-family-sans); font-size: var(--font-size-base); color: var(--color-text-muted);">Описания шагов отсутствуют</p>
                </div>
            `;
        }
    } else {
        stepsHtml = `
            <div class="text-center py-8" style="color: var(--color-text-muted); padding: var(--spacing-20) 0;">
                <p style="font-family: var(--font-family-sans); font-size: var(--font-size-base); color: var(--color-text-muted);">Шаги не найдены</p>
            </div>
        `;
    }
    
    modalContent.innerHTML = `
        <div class="flex items-start justify-between p-6" style="padding: var(--spacing-6);">
            <div style="margin-left: var(--spacing-4); margin-top: var(--spacing-4);">
                <h3 class="text-lg font-medium" style="color: var(--color-text-primary); font-family: var(--font-family-sans); font-weight: var(--font-weight-medium); font-size: 36px; margin: 0;">УСЛ-${currentServiceId}</h3>
                <p style="color: var(--color-text-muted); font-family: var(--font-family-sans); font-size: var(--font-size-sm); margin: 0; margin-top: var(--spacing-2);">Создана ${getServiceCreationDate()}</p>
                <div class="flex items-center justify-between" style="margin-top: var(--spacing-3); gap: var(--spacing-4);">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-neutral-300 overflow-hidden flex-shrink-0" style="width: 32px; height: 32px; border-radius: 50%; background: var(--color-bg-tertiary); overflow: hidden; flex-shrink: 0;">
                            <div class="w-full h-full bg-neutral-200 flex items-center justify-center" style="width: 100%; height: 100%; background: var(--color-bg-secondary); display: flex; align-items: center; justify-content: center;">
                                <span class="text-sm font-medium text-gray-600" style="font-size: var(--font-size-sm); font-weight: var(--font-weight-medium); color: var(--color-text-muted);">${getManagerInitial()}</span>
                            </div>
                        </div>
                        <span style="font-family: var(--font-family-sans); font-size: var(--font-size-sm); font-weight: var(--font-weight-medium); color: var(--color-text-primary);">${getManagerName()}</span>
                    </div>
                           <a href="{{ route('Client.service.message.list') }}" class="px-3 py-1.5 text-white font-medium transition-colors" style="background-color: var(--color-primary); font-family: var(--font-family-sans); font-size: var(--font-size-sm); font-weight: var(--font-weight-medium); padding: var(--spacing-2) var(--spacing-3); border-radius: var(--radius-3xl); text-decoration: none;" onmouseover="this.style.backgroundColor='var(--color-primary-dark)'" onmouseout="this.style.backgroundColor='var(--color-primary)'">
                               Связаться
                           </a>
                </div>
            </div>
            <button onclick="closeServiceStepsModal()" class="text-gray-400 hover:text-gray-600 transition-colors" style="color: var(--color-text-muted); margin-right: var(--spacing-4);">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto p-6" style="padding: var(--spacing-6); background: var(--color-bg-primary); padding-top: 4px;">
            <div class="space-y-4" style="gap: var(--spacing-4);">
                ${stepsHtml}
            </div>
        </div>
    `;
}

function renderError(error) {
    const modalContent = document.querySelector('#serviceStepsModal .bg-white');
    modalContent.innerHTML = `
        <div class="flex items-center justify-end p-6" style="padding: var(--spacing-6);">
            <button onclick="closeServiceStepsModal()" class="text-gray-400 hover:text-gray-600 transition-colors" style="color: var(--color-text-muted);">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto p-6" style="padding: var(--spacing-6); background: var(--color-bg-primary);">
            <div class="text-center py-8" style="color: var(--color-status-error); font-family: var(--font-family-sans);">
                <p>${error}</p>
            </div>
        </div>
    `;
}

function formatDateRange(startDate, endDate) {
    if (!startDate && !endDate) return '';
    
    const formatDate = (date) => {
        if (!date) return '';
        const d = new Date(date);
        return d.toLocaleDateString('ru-RU', { 
            day: '2-digit', 
            month: '2-digit', 
            year: 'numeric' 
        });
    };
    
    if (startDate && endDate) {
        return `${formatDate(startDate)} - ${formatDate(endDate)}`;
    } else if (startDate) {
        return `с ${formatDate(startDate)}`;
    } else if (endDate) {
        return `до ${formatDate(endDate)}`;
    }
    
    return '';
}

function filterServices(status) {
    // Update button styles
    document.querySelectorAll('[id^="filter-"]').forEach(btn => {
        btn.classList.remove('bg-gray-200', 'text-text-primary');
        btn.classList.add('text-text-primary');
    });
    
    const activeBtn = document.getElementById(`filter-${status}`);
    if (activeBtn) {
        activeBtn.classList.add('bg-gray-200', 'text-text-primary');
        activeBtn.classList.remove('text-text-primary');
    }
    
    // Filter logic would go here
    console.log('Filtering by status:', status);
}

// Close modal when clicking outside
document.getElementById('serviceStepsModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeServiceStepsModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeServiceStepsModal();
    }
});

// Search functionality
document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchQuery = e.target.value.toLowerCase();
    const serviceCards = document.querySelectorAll('.service-card');
    
    serviceCards.forEach(card => {
        const serviceNo = card.querySelector('.service-no')?.textContent.toLowerCase() || '';
        const managerName = card.querySelector('.manager-name')?.textContent.toLowerCase() || '';
        
        const matchesSearch = serviceNo.includes(searchQuery) || managerName.includes(searchQuery);
        
        if (matchesSearch) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
});
</script>