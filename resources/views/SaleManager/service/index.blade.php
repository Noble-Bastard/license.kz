@extends('layouts.figma-sales')

@section('content')
    <div class="px-5 py-6" style="padding-left: 40px; padding-right: 40px;">
        <!-- Page title + Search on same row -->
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-[24px] leading-[1.2] font-semibold text-text-primary">Услуги</h1>
            <div class="hidden md:flex items-center gap-[11px] px-[16px] pr-[22px] py-[11px] h-[46px] border border-border-light rounded-[80px] bg-white mr-2">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.8333 15.8333L13.2083 13.2083" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <input id="sm-services-search" type="text" placeholder="Поиск по номеру, клиенту или менеджеру" class="bg-transparent border-none outline-none text-[12px] font-medium leading-[1] text-text-primary placeholder:text-text-primary" />
            </div>
        </div>

        <!-- Status pills -->
        <div class="flex items-center gap-2 mb-5 overflow-x-auto md:flex-wrap md:overflow-x-visible">
            @foreach($statusList as $status)
                <a href="{{ route('sale_manager.service.list_by_status', ['service_status_id' => $status->id]) }}"
                   class="px-[14px] py-[8px] rounded-[60px] text-xs font-medium transition flex-shrink-0 {{ ($service_status_id ?? null) == $status->id ? 'bg-gray-200 text-text-primary' : 'text-text-primary hover:bg-bg-tertiary' }}">
                    {{ $status->name }}
                </a>
            @endforeach
        </div>

        <!-- Desktop Headers -->
        <div class="hidden md:grid grid-cols-[200px,200px,200px,200px,200px,150px] gap-[60px,60px,60px,60px,60px,0px] items-center bg-white px-5 py-3 mx-5 mb-3">
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Номер услуги</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Клиент</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Менеджер</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Статус</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Дата</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider text-right pr-5">Действие</div>
        </div>

        <!-- Gray background section -->
        <div class="py-5 pb-20" style="background-color: var(--color-bg-secondary); width: 100vw; margin-left: calc(-50vw + 50%); min-height: calc(100vh - 200px);">
            <div class="px-[40px]">
                <!-- Services List -->
                <div class="mb-6">

            @if(isset($serviceJournalList) && $serviceJournalList->isNotEmpty())
                @foreach($serviceJournalList as $service)
                    <!-- Desktop Card View -->
                    <div class="hidden md:grid grid-cols-[200px,200px,200px,200px,200px,150px] gap-[60px,60px,60px,60px,60px,0px] items-center bg-white rounded-lg shadow-sm mb-3 p-5 service-card">
                        <!-- Service Number -->
                        <div class="flex items-center gap-[10px]">
                            <span class="text-sm font-medium text-[#1E2B28] leading-[1] service-no">{{ $service->service_no }}</span>
                        </div>
                        
                        <!-- Client -->
                        <div class="flex items-center gap-[10px]">
                            <span class="text-[13px] font-medium text-[#1E2B28] leading-[1] company-name">{{ $service->client_full_name }}</span>
                        </div>
                        
                        <!-- Manager -->
                        <div class="flex items-center gap-[10px]">
                            <span class="text-[13px] font-medium text-[#1E2B28] leading-[1] manager-name">{{ $service->manager_full_name ?? 'Не назначен' }}</span>
                        </div>
                        
                        <!-- Status -->
                        <div class="flex items-center gap-[6px]">
                            @php
                                $__statusName = $service->project_status_name ?? $service->service_status_name ?? '';
                                $__dotColor = '#C2BFBF';
                                if (stripos($__statusName, 'работ') !== false) { $__dotColor = '#279760'; }
                                elseif (stripos($__statusName, 'провер') !== false) { $__dotColor = '#AD6A00'; }
                                elseif (stripos($__statusName, 'заверш') !== false || stripos($__statusName, 'готов') !== false) { $__dotColor = '#279760'; }
                            @endphp
                            <div class="w-2 h-2 rounded-full" style="background-color: {{ $__dotColor }}"></div>
                            <span class="text-[13px] font-medium text-[#1E2B28] leading-[1]">{{ $service->service_status_name }}</span>
                        </div>
                        
                        <!-- Date -->
                        <div class="flex items-center gap-[10px]">
                            <span class="text-[13px] font-medium text-[#1E2B28] leading-[1]">
                                {{ \App\Data\Helper\Assistant::formatDate($service->create_date) }}
                            </span>
                        </div>
                        
                        <!-- Action -->
                        <div class="flex items-center justify-end gap-[6px] pr-5">
                            <a href="{{ route('sale_manager.service.detail', ['serviceJournalId' => $service->id]) }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-[10px] border border-border-light text-sm text-text-primary hover:bg-bg-tertiary transition">
                                <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.66666 10C1.66666 10 4.99999 3.33334 9.99999 3.33334C15 3.33334 18.3333 10 18.3333 10C18.3333 10 15 16.6667 9.99999 16.6667C4.99999 16.6667 1.66666 10 1.66666 10Z" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10 12.5C11.3807 12.5 12.5 11.3807 12.5 10C12.5 8.61929 11.3807 7.5 10 7.5C8.61929 7.5 7.5 8.61929 7.5 10C7.5 11.3807 8.61929 12.5 10 12.5Z" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Детали
                            </a>
                        </div>
                    </div>
                    
                    <!-- Mobile Card View -->
                    <div class="md:hidden bg-white rounded-lg shadow-sm mb-3 p-4">
                        <!-- Header with service number and date -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-[10px]">
                                <span class="text-base font-medium text-[#1E2B28] leading-[1]">{{ $service->service_no }}</span>
                            </div>
                            <div class="flex items-center gap-[6px] flex-shrink-0">
                                <span class="text-sm font-medium text-[#1E2B28] leading-[1]">{{ \App\Data\Helper\Assistant::formatDate($service->create_date) }}</span>
                            </div>
                        </div>
                        
                        <!-- Details - Vertical Layout -->
                        <div class="space-y-2">
                            <div class="flex flex-col">
                                <span class="text-xs font-medium text-gray-500 mb-1">Клиент</span>
                                <span class="text-sm font-medium text-[#1E2B28]">{{ $service->client_full_name }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs font-medium text-gray-500 mb-1">Менеджер</span>
                                <span class="text-sm font-medium text-[#1E2B28]">{{ $service->manager_full_name ?? 'Не назначен' }}</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs font-medium text-gray-500 mb-1">Статус</span>
                                <div class="flex items-center gap-[6px]">
                                    @php
                                        $__statusName = $service->project_status_name ?? $service->service_status_name ?? '';
                                        $__dotColor = '#C2BFBF';
                                        if (stripos($__statusName, 'работ') !== false) { $__dotColor = '#279760'; }
                                        elseif (stripos($__statusName, 'провер') !== false) { $__dotColor = '#AD6A00'; }
                                        elseif (stripos($__statusName, 'заверш') !== false || stripos($__statusName, 'готов') !== false) { $__dotColor = '#279760'; }
                                    @endphp
                                    <div class="w-2 h-2 rounded-full" style="background-color: {{ $__dotColor }}"></div>
                                    <span class="text-sm font-medium text-[#1E2B28]">{{ $service->service_status_name }}</span>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs font-medium text-gray-500 mb-1">Действие</span>
                                    <a href="{{ route('sale_manager.service.detail', ['serviceJournalId' => $service->id]) }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-[10px] border border-border-light text-sm text-text-primary hover:bg-bg-tertiary transition">
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.66666 10C1.66666 10 4.99999 3.33334 9.99999 3.33334C15 3.33334 18.3333 10 18.3333 10C18.3333 10 15 16.6667 9.99999 16.6667C4.99999 16.6667 1.66666 10 1.66666 10Z" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M10 12.5C11.3807 12.5 12.5 11.3807 12.5 10C12.5 8.61929 11.3807 7.5 10 7.5C8.61929 7.5 7.5 8.61929 7.5 10C7.5 11.3807 8.61929 12.5 10 12.5Z" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Детали
                                    </a>
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
                        <p class="text-lg font-medium">Услуги не найдены</p>
                        <p class="mt-1">Попробуйте изменить параметры фильтрации</p>
                    </div>
            </div>
            @endif

            <!-- Pagination -->
            @if(isset($serviceJournalList) && $serviceJournalList->hasPages())
                <div class="mt-4">
                    {{ $serviceJournalList->links('components.manager-pagination') }}
                </div>
            @endif
                </div>
            </div>
        </div>

        <!-- Modal root -->
        <div id="sm-service-modal" class="hidden fixed inset-0 z-50">
            <div class="absolute inset-0 bg-black/40"></div>
            <div class="relative z-10 flex items-start justify-center min-h-full p-6">
                <div class="w-full max-w-[860px] rounded-[16px] bg-white border border-border-light shadow-xl">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-border-light">
                        <div class="text-base font-semibold text-text-primary">Детали услуги</div>
                        <button type="button" class="js-close-service-modal inline-flex items-center justify-center w-9 h-9 rounded-full hover:bg-bg-tertiary">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 5L5 15" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round"/><path d="M5 5L15 15" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round"/></svg>
                        </button>
                    </div>
                    <div id="sm-service-modal-body" class="p-6">
                        <div class="py-10 text-center text-text-secondary">Загрузка...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    (function(){
        const modal = document.getElementById('sm-service-modal');
        const body = document.getElementById('sm-service-modal-body');
        const base = '{{ url('/') }}';
        const locale = '{{ app()->getLocale() }}';
        const searchInput = document.getElementById('sm-services-search');

        function openModal() {
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }
        function closeModal() {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            body.innerHTML = '<div class="py-10 text-center text-text-secondary">Загрузка...</div>';
        }

        document.addEventListener('click', function(e){
            const openBtn = e.target.closest('.js-open-service-modal');
            if (openBtn) {
                e.preventDefault();
                const id = openBtn.getAttribute('data-service-id');
                if (!id) return;
                openModal();
                fetch(`${base}/${locale}/salemanager/vue/servicesJournal/${id}/modal`, { headers: { 'X-Requested-With': 'XMLHttpRequest' }})
                    .then(r => r.text())
                    .then(html => { body.innerHTML = html; })
                    .catch(() => { body.innerHTML = '<div class="py-10 text-center text-status-error">Ошибка загрузки</div>'; });
            }
            if (e.target.closest('.js-close-service-modal') || e.target === modal.querySelector('.absolute.inset-0')) {
                closeModal();
            }
        });
        // Client-side filtering like manager's
        if (searchInput) {
            searchInput.addEventListener('input', function(){
                const q = this.value.toLowerCase();
                const cards = document.querySelectorAll('.service-card');
                cards.forEach(card => {
                    const no = card.querySelector('.service-no')?.textContent.toLowerCase() || '';
                    const company = card.querySelector('.company-name')?.textContent.toLowerCase() || '';
                    const manager = card.querySelector('.manager-name')?.textContent.toLowerCase() || '';
                    const match = no.includes(q) || company.includes(q) || manager.includes(q);
                    card.style.display = match ? '' : 'none';
                });
            });
        }
    })();
</script>
@endpush
