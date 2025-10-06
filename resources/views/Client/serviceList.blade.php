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
<div id="serviceStepsModal" class="fixed inset-0 z-50 flex items-center justify-center hidden" style="background: rgba(0,0,0,0.4);">
    <div class="bg-white w-[800px] h-[600px] mx-4 flex flex-col rounded-lg">
        <!-- Modal content will be loaded here -->
    </div>
</div>

@endsection

<script>
let currentServiceId = null;

function openServiceStepsModal(serviceId) {
    console.log('Opening service steps modal for service:', serviceId);
    currentServiceId = serviceId;
    // Show modal
    document.getElementById('serviceStepsModal').classList.remove('hidden');
    
    // Load modal content via AJAX
    fetch(`/client/service-steps/${serviceId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
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
    currentServiceId = null;
}

function renderServiceSteps(steps) {
    const modalContent = document.querySelector('#serviceStepsModal .bg-white');
    
    let stepsHtml = '';
    if (steps && steps.length > 0) {
        steps.forEach((step, index) => {
            const statusClass = step.is_completed ? 'bg-green-50 border-green-200' : 'bg-gray-50 border-gray-200';
            const iconClass = step.is_completed ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-600';
            const statusText = step.is_completed ? 'Завершен' : 'Не начато';
            const statusBadgeClass = step.is_completed ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800';
            
            stepsHtml += `
                <div class="border border-gray-200 rounded-lg p-4 ${statusClass}">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center ${iconClass}">
                                ${step.is_completed ? 
                                    '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>' :
                                    `<span class="text-sm font-medium">${step.step_number || (index + 1)}</span>`
                                }
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h5 class="text-base font-medium text-gray-900 mb-2">${step.description || 'Шаг ' + (index + 1)}</h5>
                                    <div class="space-y-2">
                                        ${step.start_date || step.end_date ? `
                                            <div class="flex items-center text-sm text-gray-600">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <span>${formatDateRange(step.start_date, step.end_date)}</span>
                                            </div>
                                        ` : ''}
                                        ${step.executor_name ? `
                                            <div class="flex items-center text-sm text-gray-600">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                                <span>Исполнитель: ${step.executor_name}</span>
                                            </div>
                                        ` : ''}
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium ${statusBadgeClass}">
                                        ${statusText}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });
    } else {
        stepsHtml = `
            <div class="text-center py-8 text-gray-500">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <p class="mt-2 text-sm">Шаги не найдены</p>
            </div>
        `;
    }
    
    modalContent.innerHTML = `
        <div class="flex items-center justify-between p-6 border-b">
            <h3 class="text-lg font-medium text-gray-900">Шаги услуги УСЛ-${currentServiceId}</h3>
            <button onclick="closeServiceStepsModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto p-6">
            <div class="space-y-4">
                ${stepsHtml}
            </div>
        </div>
    `;
}

function renderError(error) {
    const modalContent = document.querySelector('#serviceStepsModal .bg-white');
    modalContent.innerHTML = `
        <div class="flex items-center justify-between p-6 border-b">
            <h3 class="text-lg font-medium text-gray-900">Ошибка</h3>
            <button onclick="closeServiceStepsModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto p-6">
            <div class="text-center py-8 text-red-500">
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