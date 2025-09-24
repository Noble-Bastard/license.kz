@extends('layouts.figma-sales')

@section('content')
    <div class="px-5 py-6" style="padding-left: 40px; padding-right: 40px;">
        <!-- Page title and search -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-[24px] leading-[1.2] font-semibold text-text-primary">Услуги</h1>
            </div>
            <div class="flex items-center gap-3">
                <!-- Search -->
                <div class="relative w-full md:max-w-[360px]">
                    <input type="text" placeholder="Поиск по номеру, клиенту или менеджеру"
                           class="w-full h-[48px] rounded-[14px] border border-border-light bg-white pl-12 pr-4 text-sm text-text-primary placeholder-text-muted outline-none focus:ring-2 focus:ring-primary/20"/>
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.58333 16.25C13.0651 16.25 15.9167 13.3984 15.9167 9.91667C15.9167 6.43492 13.0651 3.58333 9.58333 3.58333C6.10158 3.58333 3.25 6.43492 3.25 9.91667C3.25 13.3984 6.10158 16.25 9.58333 16.25Z" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16.75 17.0833L14.4167 14.75" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Status pills -->
        <div class="flex items-center gap-2 mb-5 overflow-x-auto md:flex-wrap md:overflow-x-visible">
            @foreach($statusList as $status)
                <a href="{{ route('sale_manager.service.list_by_status', ['service_status_id' => $status->id]) }}"
                   class="px-[14px] py-[8px] rounded-[60px] text-xs font-medium transition flex-shrink-0 {{ ($service_status_id ?? null) == $status->id ? 'bg-bg-tertiary text-text-primary' : 'text-text-primary hover:bg-bg-tertiary' }}">
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
                    <div class="hidden md:grid grid-cols-[200px,200px,200px,200px,200px,150px] gap-[60px,60px,60px,60px,60px,0px] items-center bg-white rounded-lg shadow-sm mb-3 p-5">
                        <!-- Service Number -->
                        <div class="flex items-center gap-[10px]">
                            <span class="text-sm font-medium text-[#1E2B28] leading-[1]">{{ $service->service_no }}</span>
                        </div>
                        
                        <!-- Client -->
                        <div class="flex items-center gap-[10px]">
                            <span class="text-[13px] font-medium text-[#1E2B28] leading-[1]">{{ $service->client_full_name }}</span>
                        </div>
                        
                        <!-- Manager -->
                        <div class="flex items-center gap-[10px]">
                            <span class="text-[13px] font-medium text-[#1E2B28] leading-[1]">{{ $service->manager_full_name ?? 'Не назначен' }}</span>
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
                            <a href="#" data-service-id="{{ $service->id }}" class="js-open-service-modal inline-flex items-center gap-2 px-3 py-2 rounded-[10px] border border-border-light text-sm text-text-primary hover:bg-bg-tertiary transition">
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
                                    <a href="#" data-service-id="{{ $service->id }}" class="js-open-service-modal inline-flex items-center gap-2 px-3 py-2 rounded-[10px] border border-border-light text-sm text-text-primary hover:bg-bg-tertiary transition">
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
    })();
</script>
@endpush