@extends('layouts.figma-sales')

@section('title', 'Коммерческие предложения')

@section('content')
<div class="py-6 px-4 md:px-10">
    <!-- Local header (ensures logo and nav visible) -->
    <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
        <!-- Left: Logo + Nav -->
        <div class="flex items-center gap-3 w-full md:w-auto">
            <img src="{{ asset('images/green-logo.png') }}" alt="UpperLicense" class="h-[31px] w-auto" style="width:150px;height:31px;"/>
            <nav class="flex items-center gap-[10px] overflow-x-auto md:overflow-visible -mx-4 px-4 md:mx-0 md:px-0">
                <a href="{{ route('sale_manager.service.list') }}" class="flex items-center gap-[6px] px-[12px] py-[8px] rounded-[60px] text-text-primary text-xs font-medium leading-[1.4] hover:bg-bg-tertiary {{ request()->routeIs('sale_manager.service.*') ? 'bg-bg-tertiary' : '' }}">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.5 5H6.66667" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17.5 10H6.66667" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17.5 15H6.66667" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2.5 5H2.50833" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2.5 10H2.50833" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2.5 15H2.50833" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Услуги
                </a>
                <a href="{{ route('sale_manager.potential_client.index') }}" class="flex items-center gap-[6px] px-[12px] py-[8px] rounded-[60px] text-text-primary text-xs font-medium leading-[1.4] hover:bg-bg-tertiary {{ request()->routeIs('sale_manager.potential_client.*') ? 'bg-bg-tertiary' : '' }}">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.3333 17.5V15.8333C13.3333 14.9493 12.9821 14.1014 12.357 13.4763C11.7319 12.8512 10.884 12.5 10 12.5H5C4.11594 12.5 3.2681 12.8512 2.64297 13.4763C2.01785 14.1014 1.66667 14.9493 1.66667 15.8333V17.5" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7.5 9.16667C9.34095 9.16667 10.8333 7.67428 10.8333 5.83333C10.8333 3.99238 9.34095 2.5 7.5 2.5C5.65905 2.5 4.16667 3.99238 4.16667 5.83333C4.16667 7.67428 5.65905 9.16667 7.5 9.16667Z" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Потенциальные клиенты
                </a>
                <a href="{{ route('sale_manager.commercial_offer.index') }}" class="flex items-center gap-[6px] px-[12px] py-[8px] rounded-[60px] text-text-primary text-xs font-medium leading-[1.4] hover:bg-bg-tertiary {{ request()->routeIs('sale_manager.commercial_offer.*') ? 'bg-bg-tertiary' : '' }}">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 3.33333H15C15.4602 3.33333 15.8333 3.70643 15.8333 4.16667V15.8333C15.8333 16.2936 15.4602 16.6667 15 16.6667H5C4.53976 16.6667 4.16667 16.2936 4.16667 15.8333V4.16667C4.16667 3.70643 4.53976 3.33333 5 3.33333Z" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.66667 6.66667H13.3333" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.66667 10H13.3333" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.66667 13.3333H10.8333" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    КП
                </a>
            </nav>
        </div>
        <!-- Right: Logout -->
        <div class="flex items-center gap-2 ml-auto md:ml-0">
            <form id="logout-form-sales" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            <button type="submit" form="logout-form-sales"
                    class="flex items-center gap-[6px] px-4 py-4 rounded-[60px] border border-border-light text-text-primary text-sm font-medium leading-[1] hover:bg-bg-tertiary">
                <svg width="12" height="12" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.25 12.25H2.625C2.42609 12.25 2.23532 12.171 2.09467 12.0303C1.95402 11.8897 1.875 11.6989 1.875 11.5V2.5C1.875 2.30109 1.95402 2.11032 2.09467 1.96967C2.23532 1.82902 2.42609 1.75 2.625 1.75H5.25" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9.1875 9.625L12.125 7L9.1875 4.375" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12.125 7H5.25" stroke="#191E1D" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Выйти
            </button>
        </div>
    </div>
    <div class="">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-[24px] leading-[1.2] font-semibold text-text-primary">Коммерческие предложения</h1>
            </div>
            <div class="flex items-center gap-3">
                <!-- Search -->
                <div class="relative w-full md:max-w-[360px]">
                    <input type="text" placeholder="Поиск по имени"
                           class="w-full h-[48px] rounded-[14px] border border-border-light bg-white pl-12 pr-4 text-sm text-text-primary placeholder-text-muted outline-none focus:ring-2 focus:ring-primary/20"/>
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.58333 16.25C13.0651 16.25 15.9167 13.3984 15.9167 9.91667C15.9167 6.43492 13.0651 3.58333 9.58333 3.58333C6.10158 3.58333 3.25 6.43492 3.25 9.91667C3.25 13.3984 6.10158 16.25 9.58333 16.25Z" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16.75 17.0833L14.4167 14.75" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <!-- Create KP Button -->
                <a href="#" onclick="openModal('create-commercial-offer')" class="inline-flex items-center gap-2 px-5 py-3 rounded-[14px] bg-primary text-white text-sm font-medium hover:bg-primary-700 transition">
                    <i class="fas fa-plus text-sm"></i>
                    Создать КП
                </a>
            </div>
        </div>
    </div>
    
    <div x-data="commercialOffers()" x-init="loadOffers()">

        <!-- Status pills -->
        <div class="flex items-center gap-2 mb-5 overflow-x-auto md:flex-wrap md:overflow-x-visible">
            <button class="status-filter-btn px-[14px] py-[8px] rounded-[60px] text-xs font-medium transition flex-shrink-0 bg-[#279760] text-white">
                Все КП
            </button>
            <button class="status-filter-btn px-[14px] py-[8px] rounded-[60px] text-xs font-medium transition flex-shrink-0 text-text-primary hover:bg-bg-tertiary">
                Новые
            </button>
            <button class="status-filter-btn px-[14px] py-[8px] rounded-[60px] text-xs font-medium transition flex-shrink-0 text-text-primary hover:bg-bg-tertiary">
                В работе
            </button>
            <button class="status-filter-btn px-[14px] py-[8px] rounded-[60px] text-xs font-medium transition flex-shrink-0 text-text-primary hover:bg-bg-tertiary">
                Отправлены
            </button>
            <button class="status-filter-btn px-[14px] py-[8px] rounded-[60px] text-xs font-medium transition flex-shrink-0 text-text-primary hover:bg-bg-tertiary">
                Приняты
            </button>
            <button class="status-filter-btn px-[14px] py-[8px] rounded-[60px] text-xs font-medium transition flex-shrink-0 text-text-primary hover:bg-bg-tertiary">
                Отклонены
            </button>
        </div>

        <!-- Table -->

        <!-- Desktop Headers -->
        <div class="hidden md:grid grid-cols-[200px,200px,200px,200px,200px,150px] gap-[60px,60px,60px,60px,60px,0px] items-center bg-white mx-5 px-5 py-3 rounded-t-lg">
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Дата</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Имя</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Email</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Телефон</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Тип</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider text-right pr-5">Лицензии</div>
        </div>

        @if(isset($commercialOfferList) && $commercialOfferList->isNotEmpty())
            @foreach($commercialOfferList as $commercialOffer)
                <!-- Desktop Card View -->
                <div class="hidden md:grid grid-cols-[200px,200px,200px,200px,200px,150px] gap-[60px,60px,60px,60px,60px,0px] items-center bg-white rounded-lg shadow-sm mx-5 mb-3 p-5">
                    <!-- Date -->
                    <div class="flex items-center gap-[10px]">
                        <span class="text-[13px] font-medium text-[#1E2B28] leading-[1]">{{ \App\Data\Helper\Assistant::formatDate($commercialOffer->created_at) }}</span>
                    </div>
                    
                    <!-- Name -->
                    <div class="flex items-center gap-[10px]">
                        <span class="text-[13px] font-medium text-[#1E2B28] leading-[1]">{{ $commercialOffer->name }}</span>
                    </div>
                    
                    <!-- Email -->
                    <div class="flex items-center gap-[10px]">
                        <a href="mailto:{{ $commercialOffer->email }}" class="text-[13px] font-medium text-[#1E2B28] leading-[1] hover:underline">{{ $commercialOffer->email }}</a>
                    </div>
                    
                    <!-- Phone -->
                    <div class="flex items-center gap-[10px]">
                        <a href="tel:{{ $commercialOffer->phone }}" class="text-[13px] font-medium text-[#1E2B28] leading-[1] hover:underline">{{ $commercialOffer->phone }}</a>
                    </div>
                    
                    <!-- Type -->
                    <div class="flex items-center gap-[10px]">
                        @php
                            $typeName = $commercialOffer->type->name ?? 'Неизвестно';
                            $badgeVariant ='default';
                            if (str_contains(strtolower($typeName), 'кп')) {
                                $badgeVariant = 'primary';
                            } elseif (str_contains(strtolower($typeName), 'требования')) {
                                $badgeVariant = 'warning';
                            } elseif (str_contains(strtolower($typeName), 'консультация')) {
                                $badgeVariant = 'info';
                            }
                        @endphp
                        @component('components.modern.badge', ['variant' => $badgeVariant, 'content' => $typeName])
                                </div>
                    
                    <!-- Services -->
                    <div class="flex items-center justify-end gap-[6px] pr-5">
                        @php
                            $servicesText = collect($commercialOffer->serviceList ?? [])->map(function($s){
                                return optional($s->service)->name;
                            })->filter()->implode(', ');
                        @endphp
                        <span class="text-[13px] font-medium text-[#1E2B28] leading-[1] truncate" title="{{ $servicesText }}">{{ \Illuminate\Support\Str::limit($servicesText, 30) }}</span>
                                </div>
                            </div>
                
                <!-- Mobile Card View -->
                <div class="md:hidden bg-white rounded-lg shadow-sm mx-4 mb-3 p-4">
                    <!-- Header with name and date -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-[10px]">
                            <span class="text-base font-medium text-[#1E2B28] leading-[1]">{{ $commercialOffer->name }}</span>
                                </div>
                        <div class="flex items-center gap-[6px] flex-shrink-0">
                            <span class="text-sm font-medium text-[#1E2B28] leading-[1]">{{ \App\Data\Helper\Assistant::formatDate($commercialOffer->created_at) }}</span>
                                </div>
                            </div>
                    
                    <!-- Details - Vertical Layout -->
                    <div class="space-y-2">
                        <div class="flex flex-col">
                            <span class="text-xs font-medium text-gray-500 mb-1">Email</span>
                            <a href="mailto:{{ $commercialOffer->email }}" class="text-sm font-medium text-[#1E2B28] hover:underline">{{ $commercialOffer->email }}</a>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs font-medium text-gray-500 mb-1">Телефон</span>
                            <a href="tel:{{ $commercialOffer->phone }}" class="text-sm font-medium text-[#1E2B28] hover:underline">{{ $commercialOffer->phone }}</a>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs font-medium text-gray-500 mb-1">Тип</span>
                            @php
                                $typeName = $commercialOffer->type->name ?? 'Неизвестно';
                                $badgeVariant ='default';
                                if (str_contains(strtolower($typeName), 'кп')) {
                                    $badgeVariant = 'primary';
                                } elseif (str_contains(strtolower($typeName), 'требования')) {
                                    $badgeVariant = 'warning';
                                } elseif (str_contains(strtolower($typeName), 'консультация')) {
                                    $badgeVariant = 'info';
                                }
                            @endphp
                            @component('components.modern.badge', ['variant' => $badgeVariant, 'content' => $typeName])
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs font-medium text-gray-500 mb-1">Лицензии</span>
                            @php
                                $servicesText = collect($commercialOffer->serviceList ?? [])->map(function($s){
                                    return optional($s->service)->name;
                                })->filter()->implode(', ');
                            @endphp
                            <span class="text-sm font-medium text-[#1E2B28] truncate" title="{{ $servicesText }}">{{ \Illuminate\Support\Str::limit($servicesText, 50) }}</span>
                        </div>
                            </div>
                                </div>
            @endforeach
        @else
            <div class="text-center py-12">
                            <div class="text-text-secondary">
                    <svg class="mx-auto mb-4" width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 3c-3.866 0-7 3.134-7 7v3.5L3 16v1h18v-1l-2-2.5V10c0-3.866-3.134-7-7-7z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 19a3 3 0 006 0" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <p class="text-lg font-medium">КП не найдены</p>
                    <p class="mt-1">Попробуйте изменить параметры фильтрации</p>
                                </div>
                            </div>
        @endif

        <!-- Pagination -->
        @if($commercialOfferList->hasPages())
            @component('components.modern.pagination', ['paginator' => $commercialOfferList])
            @endcomponent
        @endif
    </div>
</div>

<!-- Create Commercial Offer Modal -->
<div id="create-commercial-offer" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Создать КП</h3>
            <button onclick="closeModal('create-commercial-offer')" class="modal-close">&times;</button>
        </div>
        <div class="modal-body">
            @include('SaleManager.commercial_offer.partials._create_modal')
        </div>
    </div>
</div>

<!-- JavaScript для модальных окон и аккордеона -->
<script>
function openModal(modalId) {
    document.getElementById(modalId).style.display = 'block';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

function toggleAccordion(index) {
    const row = document.getElementById('accordion-row-' + index);
    const icon = document.getElementById('accordion-icon-' + index);
    
    if (row.style.display === 'none' || row.style.display === '') {
        row.style.display = 'table-row';
        icon.className = 'fas fa-chevron-up';
    } else {
        row.style.display = 'none';
        icon.className = 'fas fa-chevron-down';
    }
}

// Закрытие модального окна при клике вне его
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
}
</script>

<!-- CSS для модальных окон -->
<style>
.modal {
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    background-color: white;
    margin: 5% auto;
    border-radius: 8px;
    width: 90%;
    max-width: 600px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 24px;
    border-bottom: 1px solid #e5e7eb;
}

.modal-title {
    font-size: 18px;
    font-weight: 600;
    color: #111827;
    margin: 0;
}

.modal-close {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #6b7280;
    padding: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-close:hover {
    color: #374151;
}

.modal-body {
    padding: 24px;
}
</style>
@endsection