@extends('layouts.figma-sales')

@section('title', 'Коммерческие предложения')

@section('content')
<div class="py-6 px-4 md:px-10">
    <!-- Local header (ensures logo and nav visible) -->
    <div class="flex flex-wrap items-center justify-between gap-3 mb-4 px-8 py-4" style="padding-left: 32px; padding-right: 32px;">
        <!-- Left: Logo + Nav -->
        <div class="flex items-center gap-3 w-full md:w-auto">
            <img src="{{ asset('images/green-logo.png') }}" alt="UpperLicense" class="h-[31px] w-auto" style="width:150px;height:31px;"/>
            <nav class="flex items-center gap-[10px] overflow-x-auto md:overflow-visible -mx-4 px-4 md:mx-0 md:px-0">
                <a href="{{ route('sale_manager.service.list') }}" class="flex items-center gap-[6px] px-[12px] py-[8px] rounded-[60px] text-text-primary text-xs font-medium leading-[1.4] transition-colors {{ request()->routeIs('sale_manager.service.*') ? 'bg-gray-200' : '' }}">
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
                <a href="{{ route('sale_manager.potential_client.index') }}" class="flex items-center gap-[6px] px-[12px] py-[8px] rounded-[60px] text-text-primary text-xs font-medium leading-[1.4] transition-colors {{ request()->routeIs('sale_manager.potential_client.*') ? 'bg-gray-200' : '' }}">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.3333 17.5V15.8333C13.3333 14.9493 12.9821 14.1014 12.357 13.4763C11.7319 12.8512 10.884 12.5 10 12.5H5C4.11594 12.5 3.2681 12.8512 2.64297 13.4763C2.01785 14.1014 1.66667 14.9493 1.66667 15.8333V17.5" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7.5 9.16667C9.34095 9.16667 10.8333 7.67428 10.8333 5.83333C10.8333 3.99238 9.34095 2.5 7.5 2.5C5.65905 2.5 4.16667 3.99238 4.16667 5.83333C4.16667 7.67428 5.65905 9.16667 7.5 9.16667Z" stroke="#C2BFBF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Потенциальные клиенты
                </a>
                <a href="{{ route('sale_manager.commercial_offer.index') }}" class="flex items-center gap-[6px] px-[12px] py-[8px] rounded-[60px] text-text-primary text-xs font-medium leading-[1.4] transition-colors {{ request()->routeIs('sale_manager.commercial_offer.*') ? 'bg-gray-200' : '' }}">
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

    <!-- Divider -->
    <div class="w-full h-px bg-gray-300 mb-4"></div>

    <div class="px-8" style="padding-left: 32px; padding-right: 32px;">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-[24px] leading-[1.2] font-semibold text-text-primary">Коммерческие предложения</h1>
            <div class="flex items-center gap-3">
                <!-- Search -->
                <div class="hidden md:flex items-center gap-[11px] px-[16px] pr-[22px] py-[11px] h-[46px] border border-border-light rounded-[80px] bg-white">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.8333 15.8333L13.2083 13.2083" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <input id="sm-co-search" type="text" placeholder="Поиск по имени, email, телефону" class="bg-transparent border-none outline-none text-[12px] font-medium leading-[1] text-text-primary placeholder:text-text-primary" />
                </div>
                
                <!-- Create KP Button -->
                <button onclick="openKpModal()" style="padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 14px;">
                    + Создать КП
                </button>
            </div>
        </div>
    </div>
    
    <div x-data="commercialOffers()" x-init="loadOffers()">

        <!-- Status pills -->
        <div class="flex items-center gap-2 mb-5 overflow-x-auto md:flex-wrap md:overflow-x-visible px-8" style="padding-left: 32px; padding-right: 32px;">
            <button class="status-filter-btn px-[14px] py-[8px] rounded-[60px] text-xs font-medium transition flex-shrink-0 text-text-primary bg-transparent" data-status="all">
                Все КП
            </button>
            <button class="status-filter-btn px-[14px] py-[8px] rounded-[60px] text-xs font-medium transition flex-shrink-0 text-text-primary bg-transparent" data-status="new">
                Новые
            </button>
            <button class="status-filter-btn px-[14px] py-[8px] rounded-[60px] text-xs font-medium transition flex-shrink-0 text-text-primary bg-transparent" data-status="in_work">
                В работе
            </button>
            <button class="status-filter-btn px-[14px] py-[8px] rounded-[60px] text-xs font-medium transition flex-shrink-0 text-text-primary bg-transparent" data-status="sent">
                Отправлены
            </button>
            <button class="status-filter-btn px-[14px] py-[8px] rounded-[60px] text-xs font-medium transition flex-shrink-0 text-text-primary bg-transparent" data-status="accepted">
                Приняты
            </button>
            <button class="status-filter-btn px-[14px] py-[8px] rounded-[60px] text-xs font-medium transition flex-shrink-0 text-text-primary bg-transparent" data-status="rejected">
                Отклонены
            </button>
        </div>

        <!-- Mobile Create Button -->
        <div class="md:hidden px-8 mb-4" style="padding-left: 32px; padding-right: 32px;">
            <button onclick="openKpModal()" style="width: 100%; padding: 12px 20px; background: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 14px;">
                + Создать КП
            </button>
        </div>

        <!-- Desktop Headers -->
        <div class="hidden md:grid grid-cols-[200px,200px,200px,200px,200px,150px] gap-[60px,60px,60px,60px,60px,0px] items-center bg-white px-8 py-3 mb-3" style="padding-left: 32px; padding-right: 32px;">
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Дата</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Имя</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Email</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Телефон</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Тип</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider text-right pr-5">Лицензии</div>
        </div>

        <!-- Gray background section -->
        <div class="py-5 pb-20" style="background-color: var(--color-bg-secondary); width: 100vw; margin-left: calc(-50vw + 50%); min-height: calc(100vh - 200px);">
            <div class="px-8" style="padding-left: 32px; padding-right: 32px;">
                @if(isset($commercialOfferList) && $commercialOfferList->isNotEmpty())
                @foreach($commercialOfferList as $commercialOffer)
                    <!-- Desktop Card View -->
                    <div class="hidden md:grid grid-cols-[200px,200px,200px,200px,200px,150px] gap-[60px,60px,60px,60px,60px,0px] items-center bg-white rounded-lg shadow-sm mb-3 p-5 co-row">
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
                <div class="md:hidden bg-white rounded-lg shadow-sm mb-3 p-4">
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
            <div class="mt-4">
                {{ $commercialOfferList->links('components.manager-pagination') }}
            </div>
        @endif
            </div>
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

// Обработка кликов по фильтрам статуса
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.status-filter-btn');
    const url = new URL(window.location);
    const currentStatus = url.searchParams.get('status') || 'all';
    const searchInput = document.getElementById('sm-co-search');

    // Инициализация активной кнопки по параметру URL
    filterButtons.forEach(btn => {
        // убрать любые bg-* классы, затем сделать прозрачным по умолчанию
        [...btn.classList].forEach(cls => { if (cls.startsWith('bg-')) btn.classList.remove(cls); });
        btn.classList.add('bg-transparent');
        const isActive = (btn.getAttribute('data-status') === currentStatus);
        if (isActive) {
            btn.classList.remove('bg-transparent');
            btn.classList.add('bg-gray-200');
        }
        btn.classList.add('text-text-primary');
    });
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Убираем активный класс со всех кнопок
            filterButtons.forEach(btn => {
                // убрать любые bg-* классы, затем выставить прозрачный фон у неактивных
                [...btn.classList].forEach(cls => { if (cls.startsWith('bg-')) btn.classList.remove(cls); });
                btn.classList.add('bg-transparent');
                btn.classList.add('text-text-primary');
            });
            
            // Добавляем активный класс к нажатой кнопке
            this.classList.remove('bg-transparent');
            this.classList.add('bg-gray-200', 'text-text-primary');
            
            // Получаем статус из data-атрибута
            const status = this.getAttribute('data-status');
            
            // Здесь можно добавить логику фильтрации
            console.log('Selected status:', status);
            
            // Пример: перезагрузка страницы с параметром статуса
            const url = new URL(window.location);
            if (status === 'all') {
                url.searchParams.delete('status');
            } else {
                url.searchParams.set('status', status);
            }
            window.location.href = url.toString();
        });
    });

    // Client-side filtering for list
    if (searchInput) {
        searchInput.addEventListener('input', function(){
            const q = this.value.toLowerCase();
            const rows = document.querySelectorAll('.co-row');
            rows.forEach(row => {
                const date = row.querySelector(':scope > div:nth-child(1)')?.textContent.toLowerCase() || '';
                const name = row.querySelector(':scope > div:nth-child(2)')?.textContent.toLowerCase() || '';
                const email = row.querySelector(':scope > div:nth-child(3) a, :scope > div:nth-child(3)')?.textContent.toLowerCase() || '';
                const phone = row.querySelector(':scope > div:nth-child(4) a, :scope > div:nth-child(4)')?.textContent.toLowerCase() || '';
                const match = date.includes(q) || name.includes(q) || email.includes(q) || phone.includes(q);
                row.style.display = match ? '' : 'none';
            });
        });
    }
});
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

<!-- МОДАЛКА СОЗДАНИЯ КП -->
<div id="kpModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 10000;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 30px; border-radius: 8px; width: 600px; max-width: 90%; max-height: 90vh; overflow-y: auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="margin: 0;">Создать КП</h3>
            <button onclick="closeKpModal()" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #999;">&times;</button>
        </div>
        
        <form id="kpForm">
            @csrf
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">ID *</label>
                <div style="display: flex; gap: 10px;">
                    <input type="text" name="service_ids" id="service_ids" placeholder="Укажите ID подвидов через ";*"" style="flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                    <button type="button" onclick="fillByServiceId()" style="padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; white-space: nowrap;">Заполнить по ID</button>
                </div>
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Наименование разрешительного документа</label>
                <input type="text" name="license_name" id="license_name" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Выбранные подвиды</label>
                <input type="text" name="subspecies" id="subspecies" placeholder="Укажите наименования подвидов через ";*"" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Уполномоченный орган</label>
                <input type="text" name="authorized_body" id="authorized_body" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Дополнительные требования</label>
                <textarea name="additional_requirements" id="additional_requirements" placeholder="Укажите перечисление групп через "Л"" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; height: 60px; resize: vertical;"></textarea>
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Необходимые документы</label>
                <textarea name="required_documents" id="required_documents" placeholder="Укажите наименование документов через "."" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; height: 60px; resize: vertical;"></textarea>
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Стоимость государственной пошлины (МРП)</label>
                <input type="text" name="state_duty_cost" id="state_duty_cost" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Срок оказания услуги</label>
                <input type="text" name="service_period" id="service_period" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Стоимость</label>
                <input type="text" name="cost" id="cost" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Email (куда будет осуществлена отправка)</label>
                <input type="email" name="client_email" id="client_email" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Телефон</label>
                <input type="text" name="client_phone" id="client_phone" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Имя</label>
                <input type="text" name="client_name" id="client_name" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            
            <div style="text-align: center;">
                <button type="submit" style="padding: 12px 40px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">Отправить</button>
            </div>
        </form>
    </div>
</div>

<script>
// ПРОСТЕЙШИЙ JAVASCRIPT
function openKpModal() {
    console.log('openKpModal called');
    var modal = document.getElementById('kpModal');
    console.log('Modal element:', modal);
    if (modal) {
        modal.style.display = 'block';
        console.log('Modal opened');
    } else {
        console.error('Modal not found!');
    }
}

function closeKpModal() {
    console.log('closeKpModal called');
    var modal = document.getElementById('kpModal');
    if (modal) {
        modal.style.display = 'none';
        console.log('Modal closed');
    }
}

// Функция заполнения по ID
function fillByServiceId() {
    const serviceIds = document.getElementById('service_ids').value;
    if (!serviceIds) {
        alert('Укажите ID подвидов');
        return;
    }
    
    fetch('{{ route("sale_manager.commercial_offer.prepareServiceById") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ ids: serviceIds })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('license_name').value = data.data.license_name || '';
            document.getElementById('subspecies').value = data.data.subspecies || '';
            document.getElementById('authorized_body').value = data.data.authorized_body || '';
            document.getElementById('additional_requirements').value = data.data.additional_requirements || '';
            document.getElementById('required_documents').value = data.data.required_documents || '';
            document.getElementById('state_duty_cost').value = data.data.state_duty_cost || '';
            document.getElementById('service_period').value = data.data.service_period || '';
            document.getElementById('cost').value = data.data.cost || '';
        } else {
            alert('Ошибка: ' + (data.error || 'Не удалось загрузить данные'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Ошибка при загрузке данных');
    });
}

// Ждем загрузки DOM
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded');
    
    // Отправка формы
    var form = document.getElementById('kpForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Form submitted');
            
            var formData = new FormData(this);
            
            fetch('{{ route("sale_manager.commercial_offer.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Response:', data);
                if (data.success) {
                    alert('КП создано!');
                    closeKpModal();
                    location.reload();
                } else {
                    alert('Ошибка: ' + (data.error || 'Не удалось создать КП'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ошибка при создании КП');
            });
        });
    }
    
    // Закрытие по Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeKpModal();
        }
    });
    
    // Закрытие по клику на фон
    var modal = document.getElementById('kpModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeKpModal();
            }
        });
    }
    
    console.log('Event listeners attached');
});
</script>
@endsection