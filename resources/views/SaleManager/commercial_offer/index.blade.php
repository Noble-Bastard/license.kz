@extends('layouts.figma-sales')

@section('title', 'Коммерческие предложения')

@section('content')
<div class="px-6 lg:px-8">
    <div class="py-6">
        <div class="flex items-center justify-between pb-6">
            <h1 class="text-2xl font-bold text-text-primary">@lang('messages.sale_manager.commercial_offer.title')</h1>
            <div class="flex items-center gap-3">
                @component('components.modern.input', [
                    'type' => 'text',
                    'name' => 'search',
                    'placeholder' => 'Поиск по имени',
                    'icon' => 'fas fa-search',
                    'attributes' => 'x-model="filters.search" @input.debounce.300ms="applyFilters()"'
                ])
                @component('components.modern.button', [
                    'variant' => 'primary',
                    'icon' => 'fas fa-plus',
                    'attributes' => 'onclick="openModal(\'create-commercial-offer\')" type="button"',
                    'content' => 'Создать КП'
                ])
            </div>
        </div>
    </div>
    
    <div x-data="commercialOffers()" x-init="loadOffers()">

        <!-- Table -->

        <!-- Commercial Offers Table -->
        <div class="mb-6 rounded-lg overflow-x-auto border border-border-medium shadow-sm">
            @component('components.modern.table', ['hoverable' => true, 'size' => 'lg'])
                @slot('head')
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-text-muted">Дата создания</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-text-muted">Имя</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-text-muted">E-mail</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-text-muted">Телефон</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-text-muted">Тип</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-text-muted">Лицензии</th>
                    </tr>
                @endslot

                @forelse($commercialOfferList as $commercialOffer)
                    <tr class="bg-white border-b border-border-light last:border-b-0">
                        <td class="px-4 py-3">
                            <div class="text-sm">
                                <div class="font-medium text-text-primary">
                                    {{ \App\Data\Helper\Assistant::formatDate($commercialOffer->created_at) }}
                                </div>
                                <div class="text-text-muted text-xs">
                                    {{ $commercialOffer->created_at->format('H:i') }}
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0 w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-primary-600 text-sm"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-text-primary">{{ $commercialOffer->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <a href="mailto:{{ $commercialOffer->email }}"
                               class="text-primary-600 hover:underline text-sm">
                                {{ $commercialOffer->email }}
                            </a>
                        </td>
                        <td class="px-4 py-3">
                            <a href="tel:{{ $commercialOffer->phone }}"
                               class="text-primary-600 hover:underline text-sm">
                                {{ $commercialOffer->phone }}
                            </a>
                        </td>
                        <td class="px-4 py-3">
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
                        <td class="px-4 py-3 relative">
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
                                <div class="text-sm text-text-primary whitespace-pre-line">
                                    {{ $servicesText }}
                                </div>
                            </td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="6" class="table-td text-center py-12">
                            <div class="text-text-secondary">
                                <i class="fas fa-file-contract text-4xl mb-4"></i>
                                <p class="text-lg font-medium">Коммерческие предложения не найдены</p>
                                <p class="mt-1">Создайте первое коммерческое предложение для начала работы</p>
                                <div class="mt-6">
                                    @component('components.modern.button', [
                                        'variant' => 'primary',
                                        'attributes' => 'onclick="openModal(\'create-commercial-offer\')" type="button"',
                                        'icon' => 'fas fa-plus',
                                        'content' => 'Создать КП'
                                    ])
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            @endcomponent
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