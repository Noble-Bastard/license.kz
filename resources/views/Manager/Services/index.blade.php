@extends('layouts.figma-app')

@section('content')
<div class="w-full" x-data="{ 
    searchQuery: '',
    filterServices() {
        const searchQuery = this.searchQuery.toLowerCase();
        const serviceCards = document.querySelectorAll('.service-card');
        
        serviceCards.forEach(card => {
            const serviceNo = card.querySelector('.service-no')?.textContent.toLowerCase() || '';
            const managerName = card.querySelector('.manager-name')?.textContent.toLowerCase() || '';
            const companyName = card.querySelector('.company-name')?.textContent.toLowerCase() || '';
            
            const matchesSearch = serviceNo.includes(searchQuery) || 
                                managerName.includes(searchQuery) || 
                                companyName.includes(searchQuery);
            
            if (matchesSearch) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }
}">
    <div class="flex items-center justify-between px-8 py-3" style="padding-left:32px;padding-right:32px;">
        <h1 class="text-[32px] md:text-[39px] leading-[1] font-normal tracking-[-0.02em] text-text-primary">Услуги</h1>
        <div class="hidden md:flex items-center gap-[11px] px-[16px] pr-[22px] py-[11px] h-[46px] border border-border-light rounded-[80px] bg-white mr-2">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.8333 15.8333L13.2083 13.2083" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <input type="text" placeholder="Поиск по номеру услуги или компании" class="bg-transparent border-none outline-none text-[12px] font-medium leading-[1] text-text-primary placeholder:text-text-primary" x-model="searchQuery" @input="filterServices()" />
        </div>
    </div>
    
    <!-- Mobile Search -->
    <div class="md:hidden mb-3 px-8" style="padding-left:32px;padding-right:32px;">
        <div class="flex justify-end mr-4">
            <div class="flex items-center justify-center w-[46px] h-[46px] border border-border-light rounded-[80px] bg-white">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.8333 15.8333L13.2083 13.2083" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
        </div>
    </div>

    <div class="px-8" style="padding-left:32px;padding-right:32px;">
        <div class="flex items-center gap-[10px] mb-[16px] overflow-x-auto md:flex-wrap md:overflow-x-visible">
            @php $active = request('status_id'); @endphp
            <a href="{{ route('manager.services.list') }}" class="px-[14px] py-[10px] rounded-[60px] text-[12px] font-medium flex-shrink-0 {{ !$active ? 'bg-gray-200 text-text-primary' : 'bg-white text-text-primary border border-border-light' }}">Все услуги</a>
            @if(isset($statusList))
                @foreach($statusList as $status)
                    <a href="{{ route('manager.services.list', ['status_id' => $status->id]) }}" class="px-[14px] py-[10px] rounded-[60px] text-[12px] font-medium flex-shrink-0 {{ $active == $status->id ? 'bg-gray-200 text-text-primary' : 'bg-white text-text-primary border border-border-light' }}">{{ $status->name }}</a>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Desktop Headers -->
    <div class="hidden md:grid grid-cols-[200px,150px,200px,200px,200px,150px,150px,150px,50px] gap-[60px,120px,60px,60px,60px,60px,60px,0px,0px] items-center bg-white mx-5 px-5 py-3">
        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Номер услуги</div>
        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Статус</div>
        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Дата обращения</div>
        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Исполнитель</div>
        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Клиент</div>
        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Проверка клиента</div>
        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Предоплата</div>
        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider text-right pr-5">Полная оплата</div>
        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider"></div>
    </div>

    <!-- Services List -->
    <div class="py-5" style="background-color: var(--color-bg-secondary); width: 100vw; margin-left: calc(-50vw + 50%);">
        <div class="px-[40px]">

        @if(isset($serviceJournalList) && $serviceJournalList->isNotEmpty())
            @foreach($serviceJournalList as $service)
                <!-- Desktop Card View -->
                <div onclick="openServiceModal({{ $service->id }})" class="hidden md:grid grid-cols-[200px,150px,200px,200px,200px,150px,150px,150px,50px] gap-[60px,120px,60px,60px,60px,60px,60px,0px,0px] items-center bg-white rounded-lg shadow-sm mb-3 p-5 cursor-pointer hover:bg-gray-50 transition-colors service-card">
                    <!-- Service Number -->
                    <div class="flex items-center gap-[10px]">
                        <span class="text-sm font-medium text-[#1E2B28] leading-[1] service-no">УСЛ-{{ $service->id }}</span>
                    </div>
                    
                    <!-- Status -->
                    <div class="flex items-center gap-[6px]">
                        @php
                            $statusName = $service->projectStatus->name ?? 'Неизвестен';
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
                    
                    <!-- Date -->
                    <div class="flex items-center gap-[10px]">
                        <span class="text-[13px] font-medium text-[#1E2B28] leading-[1]">
                            {{ $service->created_at ? $service->created_at->format('d.m.Y') : 'N/A' }}
                                        </span>
                                            </div>
                    
                    <!-- Executor -->
                    <div class="flex items-center gap-[10px]">
                        @if($service->executor)
                            <div class="w-[26px] h-[26px] rounded-full bg-neutral-300 overflow-hidden">
                                                    @if($service->executor->profile->photo_id)
                                                        <img src="/storage_/{{ $service->executor->profile->photo_path }}" 
                                                             alt="Executor" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-neutral-200 flex items-center justify-center">
                                        <svg class="h-3 w-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <span class="text-[13px] font-medium text-[#1E2B28] leading-[1] manager-name">
                                {{ $service->executor->profile->first_name }} {{ $service->executor->profile->last_name }}
                            </span>
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
                    
                    <!-- Client -->
                    <div class="flex items-center gap-[10px]">
                        @php
                            $clientName = '';
                            if (isset($service->client)) {
                                $profile = $service->client->profile ?? null;
                                if ($profile) {
                                    $clientName = $profile->user_name
                                        ?: trim(($profile->first_name ?? '') . ' ' . ($profile->last_name ?? ''));
                                }
                                if (!$clientName) {
                                    $clientName = $service->client->user_name
                                        ?? ($service->client->email ?? '');
                                }
                            }
                        @endphp
                        <span class="text-[13px] font-medium text-[#1E2B28] leading-[1] company-name">{{ $clientName !== '' ? $clientName : 'Не указан' }}</span>
                    </div>
                    
                    <!-- Client Verification -->
                    <div class="flex items-center gap-[6px]">
                        @if($service->client_verification_status)
                            <div class="w-2 h-2 rounded-full bg-green-100"></div>
                            <span class="text-[13px] font-medium text-green-800 leading-[1]">Проверен</span>
                                        @else
                            <div class="w-2 h-2 rounded-full bg-yellow-100"></div>
                            <span class="text-[13px] font-medium text-yellow-800 leading-[1]">Требует проверки</span>
                                        @endif
                                            </div>
                    
                    <!-- Prepayment -->
                    <div class="flex items-center gap-[6px]">
                        @if($service->prepayment_status)
                            <div class="w-2 h-2 rounded-full bg-green-100"></div>
                            <span class="text-[13px] font-medium text-green-800 leading-[1]">Оплачено</span>
                                        @else
                            <div class="w-2 h-2 rounded-full bg-yellow-100"></div>
                            <span class="text-[13px] font-medium text-yellow-800 leading-[1]">Ожидается</span>
                                        @endif
                    </div>
                    
                    <!-- Full Payment -->
                    <div class="flex items-center gap-[6px]">
                        @if($service->full_payment_status)
                            <div class="w-2 h-2 rounded-full bg-green-100"></div>
                            <span class="text-[13px] font-medium text-green-800 leading-[1]">Оплачено</span>
                        @else
                            <div class="w-2 h-2 rounded-full bg-red-100"></div>
                            <span class="text-[13px] font-medium text-red-800 leading-[1]">Не оплачено</span>
                        @endif
                    </div>
                    
                    <!-- Empty space for grid alignment -->
                    <div></div>
                </div>
                
                <!-- Mobile Card View -->
                <div onclick="openServiceModal({{ $service->id }})" class="md:hidden bg-white rounded-lg shadow-sm mb-3 p-4 cursor-pointer hover:bg-gray-50 transition-colors service-card">
                    <!-- Header with service number and date (right) -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-[10px]">
                            <span class="text-base font-medium text-[#1E2B28] leading-[1] service-no">УСЛ-{{ $service->id }}</span>
                        </div>
                        <div class="flex items-center gap-[10px] flex-shrink-0">
                            <span class="text-sm font-medium text-[#1E2B28] leading-[1]">{{ $service->created_at ? $service->created_at->format('d.m.Y') : 'N/A' }}</span>
                        </div>
                    </div>
                    
                    <!-- Details - Vertical Layout -->
                    <div class="space-y-2">
                        <div class="flex flex-col">
                            <span class="text-xs font-medium text-gray-500 mb-1">Статус</span>
                            @php
                                $statusName = $service->projectStatus->name ?? 'Неизвестен';
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
                            <div class="flex items-center gap-[6px]">
                                <div class="w-2 h-2 rounded-full {{ $statusClass }}"></div>
                                <span class="text-sm font-medium text-[#1E2B28]">{{ $statusName }}</span>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs font-medium text-gray-500 mb-1">Исполнитель</span>
                            <div class="flex items-center gap-[10px]">
                                @if($service->executor)
                                    <div class="w-[32px] h-[32px] rounded-full bg-neutral-300 overflow-hidden flex-shrink-0">
                                        @if($service->executor->profile->photo_id)
                                            <img src="/storage_/{{ $service->executor->profile->photo_path }}" 
                                                 alt="Executor" 
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-neutral-200 flex items-center justify-center">
                                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <span class="text-sm font-medium text-[#1E2B28] manager-name">
                                        {{ $service->executor->profile->first_name }} {{ $service->executor->profile->last_name }}
                                    </span>
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
                            <span class="text-xs font-medium text-gray-500 mb-1">Клиент</span>
                            @php
                                $clientName = '';
                                if (isset($service->client)) {
                                    $profile = $service->client->profile ?? null;
                                    if ($profile) {
                                        $clientName = $profile->user_name
                                            ?: trim(($profile->first_name ?? '') . ' ' . ($profile->last_name ?? ''));
                                    }
                                    if (!$clientName) {
                                        $clientName = $service->client->user_name
                                            ?? ($service->client->email ?? '');
                                    }
                                }
                            @endphp
                            <span class="text-sm font-medium text-[#1E2B28] company-name">{{ $clientName !== '' ? $clientName : 'Не указан' }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex flex-col">
                                <span class="text-xs font-medium text-gray-500 mb-1">Проверка клиента</span>
                                <div class="flex items-center gap-[6px]">
                                    @if($service->client_verification_status)
                                        <div class="w-2 h-2 rounded-full bg-green-100"></div>
                                        <span class="text-sm font-medium text-green-800">Проверен</span>
                                    @else
                                        <div class="w-2 h-2 rounded-full bg-yellow-100"></div>
                                        <span class="text-sm font-medium text-yellow-800">Требует проверки</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs font-medium text-gray-500 mb-1">Предоплата</span>
                                <div class="flex items-center gap-[6px]">
                                    @if($service->prepayment_status)
                                        <div class="w-2 h-2 rounded-full bg-green-100"></div>
                                        <span class="text-sm font-medium text-green-800">Оплачено</span>
                                    @else
                                        <div class="w-2 h-2 rounded-full bg-yellow-100"></div>
                                        <span class="text-sm font-medium text-yellow-800">Ожидается</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs font-medium text-gray-500 mb-1">Полная оплата</span>
                            <div class="flex items-center gap-[6px]">
                                @if($service->full_payment_status)
                                    <div class="w-2 h-2 rounded-full bg-green-100"></div>
                                    <span class="text-sm font-medium text-green-800">Оплачено</span>
                                            @else
                                    <div class="w-2 h-2 rounded-full bg-red-100"></div>
                                    <span class="text-sm font-medium text-red-800">Не оплачено</span>
                                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center py-12">
                                    <div class="text-text-secondary">
                                        <svg class="mx-auto mb-4" width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 3c-3.866 0-7 3.134-7 7v3.5L3 16v1h18v-1l-2-2.5V10c0-3.866-3.134-7-7-7z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 19a3 3 0 006 0" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <p class="text-lg font-medium">Услуги не найдены</p>
                                        <p class="mt-1">Попробуйте изменить параметры фильтрации</p>
                                    </div>
            </div>
        @endif

        <!-- Pagination -->
        @if(isset($serviceJournalList) && $serviceJournalList->hasPages())
            <div class="flex justify-center items-center mt-8">
                <div class="flex items-center space-x-2">
                    @php
                        $currentPage = $serviceJournalList->currentPage();
                        $lastPage = $serviceJournalList->lastPage();
                        $startPage = max(1, $currentPage - 2);
                        $endPage = min($lastPage, $currentPage + 2);
                    @endphp

                    @for($i = $startPage; $i <= $endPage; $i++)
                        <button onclick="loadServicesPage({{ $i }}, '{{ $statusId ?? 'null' }}')"
                                class="w-8 h-8 rounded-full text-sm font-medium {{ $i === $currentPage ? 'bg-[#279760] text-white' : 'bg-white text-text-primary border border-border-light hover:bg-bg-tertiary' }} transition-colors cursor-pointer">
                            {{ $i }}
                        </button>
                    @endfor
                </div>
            </div>
        @endif
        </div>
    </div>
</div>

<!-- Service Modal -->
<div id="serviceModal" class="fixed inset-0 z-50 flex items-center justify-center hidden" style="background: rgba(0,0,0,0.4);">
    <div class="bg-white w-[600px] h-[600px] mx-4 flex flex-col">
        <!-- Modal content will be loaded here -->
    </div>
</div>

@endsection

@section('js')
<script>
let currentServiceId = null;

function openServiceModal(serviceId) {
    currentServiceId = serviceId;
    // Show modal
    document.getElementById('serviceModal').classList.remove('hidden');
    
    // Load modal content via AJAX
    fetch(`{{ url('manager/services') }}/${serviceId}`)
        .then(response => response.text())
        .then(html => {
            // Extract only the modal content from the response
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const modalContent = doc.querySelector('.fixed.inset-0');
            
            if (modalContent) {
                document.querySelector('#serviceModal .bg-white').innerHTML = modalContent.querySelector('.bg-white').innerHTML;
                // Initialize modal functionality after content is loaded
                initializeModalFunctionality();
            }
        })
        .catch(error => {
            console.error('Error loading modal:', error);
        });
}

function loadServicesPage(page, statusId) {
    // Build URL with current filters and search query
    let url = '{{ route("manager.services.list") }}?page=' + page;

    // Add status filter if present
    if (statusId && statusId !== 'null') {
        url += '&status_id=' + statusId;
    }

    // Add search query if present
    const searchInput = document.querySelector('input[x-model="searchQuery"]');
    if (searchInput && searchInput.value.trim()) {
        url += '&search=' + encodeURIComponent(searchInput.value.trim());
    }

    // Show loading state
    const servicesContainer = document.querySelector('.py-5');
    servicesContainer.style.opacity = '0.5';
    servicesContainer.style.pointerEvents = 'none';

    // Load new content via AJAX
    fetch(url)
        .then(response => response.text())
        .then(html => {
            // Extract the services list and pagination from the response
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            // Get the services list content
            const newServicesContent = doc.querySelector('.py-5');
            if (newServicesContent) {
                // Replace current content
                servicesContainer.innerHTML = newServicesContent.innerHTML;

                // Reinitialize search functionality after content replacement
                reinitializeSearch();
            }
        })
        .catch(error => {
            console.error('Error loading services page:', error);
            alert('Ошибка загрузки страницы');
        })
        .finally(() => {
            // Remove loading state
            servicesContainer.style.opacity = '1';
            servicesContainer.style.pointerEvents = 'auto';
        });
}

function reinitializeSearch() {
    // Reinitialize Alpine.js search functionality after content replacement
    document.querySelectorAll('[x-model="searchQuery"]').forEach(input => {
        // Remove existing listeners to avoid duplicates
        const newInput = input.cloneNode(true);
        input.parentNode.replaceChild(newInput, input);

        // Add new listener
        newInput.addEventListener('input', function() {
            const searchQuery = this.value.toLowerCase();
            const serviceCards = document.querySelectorAll('.service-card');

            serviceCards.forEach(card => {
                const serviceNo = card.querySelector('.service-no')?.textContent.toLowerCase() || '';
                const managerName = card.querySelector('.manager-name')?.textContent.toLowerCase() || '';
                const companyName = card.querySelector('.company-name')?.textContent.toLowerCase() || '';

                const matchesSearch = serviceNo.includes(searchQuery) ||
                                    managerName.includes(searchQuery) ||
                                    companyName.includes(searchQuery);

                if (matchesSearch) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
}

function initializeModalFunctionality() {
    // Tab switching
    $('#tasks-tab').off('click').on('click', function() {
        // Update tab styles
        $('#tasks-tab').removeClass('text-text-muted').addClass('bg-gray-200 text-text-primary');
        $('#messages-tab').removeClass('bg-gray-200 text-text-primary').addClass('text-text-muted');
        
        // Show/hide content
        $('#tasks-content').removeClass('hidden');
        $('#messages-content').addClass('hidden');
    });
    
    $('#messages-tab').off('click').on('click', function() {
        // Update tab styles
        $('#messages-tab').removeClass('text-text-muted').addClass('bg-gray-200 text-text-primary');
        $('#tasks-tab').removeClass('bg-gray-200 text-text-primary').addClass('text-text-muted');
        
        // Show/hide content
        $('#messages-content').removeClass('hidden');
        $('#tasks-content').addClass('hidden');
    });
    
    // Send comment
    $('#send-comment-btn').off('click').on('click', function() {
        const input = $('#comment-input');
        const message = input.val().trim();
        if (message) {
            // Add comment to the list immediately
            addCommentToChat(message);
            // Add your comment sending logic here
            console.log('Sending comment:', message);
            input.val('');
        }
    });

    // Allow Enter key to send comment
    $('#comment-input').off('keypress').on('keypress', function(e) {
        if (e.which === 13) {
            $('#send-comment-btn').click();
        }
    });
    
    // Send message
    $('#send-message-btn').off('click').on('click', function() {
        console.log('Send message button clicked');
        const input = $('#message-input');
        const message = input.val().trim();
        console.log('Message text:', message);
        if (message) {
            // Add message to the list immediately
            addMessageToChat(message);
            
            // Send message to server
            console.log('Sending AJAX request to:', '{{ route("Manager.service.message.create") }}');
            $.ajax({
                url: '{{ route("Manager.service.message.create") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    serviceJournalId: currentServiceId,
                    message: message
                },
                success: function(response) {
                    console.log('Message sent successfully:', response);
                },
                error: function(xhr, status, error) {
                    console.error('Error sending message:', error);
                    console.error('Response:', xhr.responseText);
                    alert('Ошибка отправки сообщения: ' + error);
                }
            });
            
            input.val('');
        }
    });

    // Allow Enter key to send message
    $('#message-input').off('keypress').on('keypress', function(e) {
        if (e.which === 13) {
            $('#send-message-btn').click();
        }
    });
}

// Function to add message to chat
function addMessageToChat(messageText) {
    console.log('Adding message to chat:', messageText);
    const now = new Date();
    const timeString = now.toLocaleDateString('ru-RU') + ' ' + now.toLocaleTimeString('ru-RU', {hour: '2-digit', minute: '2-digit'});
    
    // Remove empty state if it exists
    $('.text-center.py-2').remove();
    
    const messageHtml = `
        <div class="flex items-start gap-2.5">
            <div class="w-[32px] h-[32px] rounded-full bg-neutral-300 overflow-hidden flex-shrink-0">
                <div class="w-full h-full bg-primary flex items-center justify-center">
                    <svg class="h-3.5 w-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            </div>
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-0.5">
                    <span class="text-[12px] font-medium text-text-primary">Вы</span>
                    <span class="text-[11px] text-text-muted">${timeString}</span>
                </div>
                <p class="text-[11px] text-text-secondary">${messageText}</p>
            </div>
        </div>
    `;
    
    console.log('Appending message HTML to #messages-list');
    $('#messages-list').append(messageHtml);
    console.log('Message added successfully');
    
    // Auto scroll to bottom
    const messagesList = $('#messages-list')[0];
    messagesList.scrollTop = messagesList.scrollHeight;
}

// Function to add comment to chat
function addCommentToChat(commentText) {
    const now = new Date();
    const timeString = now.toLocaleDateString('ru-RU') + ' ' + now.toLocaleTimeString('ru-RU', {hour: '2-digit', minute: '2-digit'});
    
    const commentHtml = `
        <div class="flex items-start gap-2">
            <div class="w-[20px] h-[20px] rounded-full bg-neutral-300 overflow-hidden flex-shrink-0">
                <div class="w-full h-full bg-primary flex items-center justify-center">
                    <svg class="h-2.5 w-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            </div>
            <div class="flex-1">
                <div class="flex items-center justify-between mb-0.5">
                    <span class="text-[10px] font-medium text-text-primary">Вы</span>
                    <span class="text-[9px] text-text-muted">${timeString}</span>
                </div>
                <p class="text-[10px] text-text-secondary">${commentText}</p>
            </div>
        </div>
    `;
    
    // Check if there are existing comments or empty state
    const commentsList = $('#comments-list');
    if (commentsList.find('.text-[10px].text-text-secondary').length === 0) {
        // If no comments exist, remove the empty state message
        commentsList.find('.text-center.py-8, .flex.items-start.gap-3').remove();
    }
    
    commentsList.append(commentHtml);
    // Auto scroll to bottom
    const commentsListElement = commentsList[0];
    commentsListElement.scrollTop = commentsListElement.scrollHeight;
}

// Close modal when clicking outside
document.getElementById('serviceModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeServiceModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeServiceModal();
    }
});
</script>
@endsection
