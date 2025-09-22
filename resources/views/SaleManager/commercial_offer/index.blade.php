@extends('layouts.figma-sales')

@section('title', 'Коммерческие предложения')

@section('content')
<div class="px-5 py-6" style="padding-left: 40px; padding-right: 40px;">
    <!-- Local header (ensures logo and nav visible) -->
    <div class="flex items-center justify-between gap-3 mb-4">
        <!-- Left: Logo + Nav -->
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/green-logo.png') }}" alt="UpperLicense" class="h-[31px] w-auto" style="width:150px;height:31px;"/>
            <nav class="flex items-center gap-[10px]">
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
        <div class="flex items-center gap-2">
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
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-text-primary">@lang('messages.sale_manager.commercial_offer.title')</h1>
            <div class="flex items-center gap-3">
                @component('components.modern.input', [
                    'type' => 'text',
                    'name' => 'search',
                    'placeholder' => 'Поиск по имени',
                    'icon' => 'fas fa-search',
                    'attributes' => 'x-model="filters.search" @input.debounce.300ms="applyFilters()"'
                ])
                @endcomponent
                @component('components.modern.button', [
                    'variant' => 'primary',
                    'icon' => 'fas fa-plus',
                    'attributes' => 'onclick="openModal(\'create-commercial-offer\')" type="button"',
                    'content' => 'Создать КП'
                ])
                @endcomponent
            </div>
        </div>
    </div>
    
    <div x-data="commercialOffers()" x-init="loadOffers()">

        <!-- Table -->

        <!-- Commercial Offers Table (styled like potential_client) -->
        <div class="bg-white rounded-[14px] border border-border-light overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-bg-secondary">
                    <tr>
                        <th class="text-left text-xs font-medium text-text-secondary px-6 py-3">Дата</th>
                        <th class="text-left text-xs font-medium text-text-secondary px-6 py-3">Имя</th>
                        <th class="text-left text-xs font-medium text-text-secondary px-6 py-3">Email</th>
                        <th class="text-left text-xs font-medium text-text-secondary px-6 py-3">Телефон</th>
                        <th class="text-left text-xs font-medium text-text-secondary px-6 py-3">Тип</th>
                        <th class="text-left text-xs font-medium text-text-secondary px-6 py-3">Лицензии</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light">
                    @forelse($commercialOfferList as $commercialOffer)
                        <tr class="hover:bg-bg-tertiary/30">
                            <td class="px-6 py-4 text-sm text-text-primary">
                                <div class="text-sm">
                                    <div class="font-medium text-text-primary">{{ \App\Data\Helper\Assistant::formatDate($commercialOffer->created_at) }}</div>
                                    <div class="text-text-secondary text-xs">{{ $commercialOffer->created_at->format('H:i') }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-text-primary">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-primary-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-text-primary">{{ $commercialOffer->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-text-primary">
                                <a href="mailto:{{ $commercialOffer->email }}" class="text-primary hover:underline">{{ $commercialOffer->email }}</a>
                            </td>
                            <td class="px-6 py-4 text-sm text-text-primary">
                                <a href="tel:{{ $commercialOffer->phone }}" class="text-primary hover:underline">{{ $commercialOffer->phone }}</a>
                            </td>
                            <td class="px-6 py-4 text-sm text-text-primary">
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
                            </td>
                            <td class="px-6 py-4 text-sm text-text-primary">
                                @php
                                    $servicesText = collect($commercialOffer->serviceList ?? [])->map(function($s){
                                        return optional($s->service)->name;
                                    })->filter()->implode(', ');
                                @endphp
                                <div class="flex items-center justify-between">
                                    <div class="text-sm text-text-primary line-clamp-1" title="{{ $servicesText }}">{{ $servicesText }}</div>
                                    @if(strlen($servicesText) > 50)
                                        <button onclick="toggleAccordion({{ $loop->index }})" class="ml-2 flex-shrink-0 text-text-muted hover:text-text-primary">
                                            <i class="fas fa-chevron-down" id="accordion-icon-{{ $loop->index }}"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @if(strlen($servicesText) > 50)
                            <tr id="accordion-row-{{ $loop->index }}" style="display: none;">
                                <td colspan="6" class="px-6 py-4 bg-bg-secondary border-b border-border-light last:border-b-0">
                                    <div class="text-sm text-text-primary whitespace-pre-line">{{ $servicesText }}</div>
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-sm text-text-secondary">Нет записей для отображения.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

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