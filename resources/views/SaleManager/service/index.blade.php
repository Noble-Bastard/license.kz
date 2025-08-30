@extends('layouts.figma-sales')

@section('content')
    <div class="px-5 py-6" style="padding-left: 40px; padding-right: 40px;">
        <!-- Page title and actions -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-[24px] leading-[1.2] font-semibold text-text-primary">Услуги</h1>
                <p class="mt-1 text-sm text-text-secondary">Список услуг и их статусов</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('sale_manager.service.list') }}" class="px-4 py-2 rounded-[10px] border border-border-light text-sm text-text-primary hover:bg-bg-tertiary transition">Обновить</a>
            </div>
        </div>

        <!-- Filters row: search + status pills -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-5">
            <!-- Search -->
            <div class="relative w-full md:max-w-[360px]">
                <input type="text" placeholder="Поиск по номеру, клиенту или менеджеру"
                       class="w-full h-[48px] rounded-[14px] border border-border-light bg-white pl-12 pr-4 text-sm text-text-primary placeholder-text-muted outline-none focus:ring-2 focus:ring-primary/20"/>
                <svg class="absolute left-4 top-1/2 -translate-y-1/2" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.58333 16.25C13.0651 16.25 15.9167 13.3984 15.9167 9.91667C15.9167 6.43492 13.0651 3.58333 9.58333 3.58333C6.10158 3.58333 3.25 6.43492 3.25 9.91667C3.25 13.3984 6.10158 16.25 9.58333 16.25Z" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16.75 17.0833L14.4167 14.75" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <!-- Status pills -->
            <div class="flex items-center flex-wrap gap-2">
                @foreach($statusList as $status)
                    <a href="{{ route('sale_manager.service.list_by_status', ['service_status_id' => $status->id]) }}"
                       class="px-[14px] py-[8px] rounded-[60px] text-xs font-medium transition {{ ($service_status_id ?? null) == $status->id ? 'bg-bg-tertiary text-text-primary' : 'text-text-primary hover:bg-bg-tertiary' }}">
                        {{ $status->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Card with table -->
        <div class="bg-white rounded-[14px] border border-border-light overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-bg-secondary">
                        <tr>
                            <th class="text-left text-xs font-medium text-text-secondary px-6 py-3">ID</th>
                            <th class="text-left text-xs font-medium text-text-secondary px-6 py-3">Клиент</th>
                            <th class="text-left text-xs font-medium text-text-secondary px-6 py-3">Менеджер</th>
                            <th class="text-left text-xs font-medium text-text-secondary px-6 py-3">Статус</th>
                            <th class="text-left text-xs font-medium text-text-secondary px-6 py-3">Дата</th>
                            <th class="text-left text-xs font-medium text-text-secondary px-6 py-3">Действия</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-light">
                        @forelse(($serviceJournalList ?? collect()) as $service)
                            <tr class="hover:bg-bg-tertiary/30">
                                <td class="px-6 py-4 text-sm text-text-primary">{{ $service->service_no }}</td>
                                <td class="px-6 py-4 text-sm text-text-primary">{{ $service->client_full_name }}</td>
                                <td class="px-6 py-4 text-sm text-text-primary">{{ $service->manager_full_name ?? 'Не назначен' }}</td>
                                <td class="px-6 py-4 text-sm text-text-primary">
                                    @php
                                        $__statusName = $service->project_status_name ?? $service->service_status_name ?? '';
                                        $__dotColor = '#C2BFBF';
                                        if (stripos($__statusName, 'работ') !== false) { $__dotColor = '#279760'; }
                                        elseif (stripos($__statusName, 'провер') !== false) { $__dotColor = '#AD6A00'; }
                                        elseif (stripos($__statusName, 'заверш') !== false || stripos($__statusName, 'готов') !== false) { $__dotColor = '#279760'; }
                                    @endphp
                                    <span class="inline-flex items-center gap-2">
                                        <span class="inline-block w-2.5 h-2.5 rounded-full" style="background-color: {{ $__dotColor }}"></span>
                                        <span>{{ $service->service_status_name }}</span>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-text-primary">{{ \App\Data\Helper\Assistant::formatDate($service->create_date) }}</td>
                                <td class="px-6 py-4">
                                    <a href="#" data-service-id="{{ $service->id }}" class="js-open-service-modal inline-flex items-center gap-2 px-3 py-2 rounded-[10px] border border-border-light text-sm text-text-primary hover:bg-bg-tertiary transition">
                                        <!-- eye icon -->
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.66666 10C1.66666 10 4.99999 3.33334 9.99999 3.33334C15 3.33334 18.3333 10 18.3333 10C18.3333 10 15 16.6667 9.99999 16.6667C4.99999 16.6667 1.66666 10 1.66666 10Z" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M10 12.5C11.3807 12.5 12.5 11.3807 12.5 10C12.5 8.61929 11.3807 7.5 10 7.5C8.61929 7.5 7.5 8.61929 7.5 10C7.5 11.3807 8.61929 12.5 10 12.5Z" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Детали
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-sm text-text-secondary">Нет услуг для отображения.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if(isset($serviceJournalList) && $serviceJournalList->hasPages())
            <div class="mt-4">
                {{ $serviceJournalList->links('components.manager-pagination') }}
            </div>
        @endif

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

    <div class="services-tabs">
        @foreach($statusList as $status)
            <a class="tab-btn {{ $service_status_id == $status->id ? 'active' : '' }}"
               href="{{ route('sale_manager.service.list_by_status', ['service_status_id' => $status->id]) }}">
                {{ $status->name }}
            </a>
        @endforeach
    </div>

    <div class="manager-table">
        <div class="table-header">
            <div class="table-header-cell">ID</div>
            <div class="table-header-cell">Клиент</div>
            <div class="table-header-cell">Менеджер</div>
            <div class="table-header-cell">Статус</div>
            <div class="table-header-cell">Дата</div>
            <div class="table-header-cell">Действия</div>
        </div>

        @if(isset($serviceJournalList) && $serviceJournalList->isNotEmpty())
            @foreach($serviceJournalList as $service)
                <div class="table-row">
                    <div class="table-cell">{{ $service->service_no }}</div>
                    <div class="table-cell">{{ $service->client_full_name }}</div>
                    <div class="table-cell">{{ $service->manager_full_name ?? 'Не назначен' }}</div>
                    <div class="table-cell">
                        <span class="status-dot" style="background-color: {{ $service->projectStatus->color ?? '#ccc' }}"></span>
                        <span class="status-text">{{ $service->service_status_name }}</span>
                    </div>
                    <div class="table-cell">{{ \App\Data\Helper\Assistant::formatDate($service->create_date) }}</div>
                    <div class="table-cell">
                        <a href="{{ route('sale_manager.serviceJournal.show', ['servicesJournalId' => $service->id]) }}" class="btn btn-sm btn-primary">Детали</a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="table-row">
                <div class="table-cell" colspan="6">Нет услуг для отображения.</div>
            </div>
        @endif
    </div>

    @if(isset($serviceJournalList) && $serviceJournalList->hasPages())
        {{ $serviceJournalList->links('components.manager-pagination') }}
    @endif
@endsection

    <div class="services-tabs">
        @foreach($statusList as $status)
            <a class="tab-btn {{ $service_status_id == $status->id ? 'active' : '' }}"
               href="{{ route('sale_manager.service.list_by_status', ['service_status_id' => $status->id]) }}">
                {{ $status->name }}
            </a>
        @endforeach
    </div>

    <div class="manager-table">
        <div class="table-header">
            <div class="table-header-cell">ID</div>
            <div class="table-header-cell">Клиент</div>
            <div class="table-header-cell">Менеджер</div>
            <div class="table-header-cell">Статус</div>
            <div class="table-header-cell">Дата</div>
            <div class="table-header-cell">Действия</div>
        </div>

        @if(isset($serviceJournalList) && $serviceJournalList->isNotEmpty())
            @foreach($serviceJournalList as $service)
                <div class="table-row">
                    <div class="table-cell">{{ $service->service_no }}</div>
                    <div class="table-cell">{{ $service->client_full_name }}</div>
                    <div class="table-cell">{{ $service->manager_full_name ?? 'Не назначен' }}</div>
                    <div class="table-cell">
                        <span class="status-dot" style="background-color: {{ $service->projectStatus->color ?? '#ccc' }}"></span>
                        <span class="status-text">{{ $service->service_status_name }}</span>
                    </div>
                    <div class="table-cell">{{ \App\Data\Helper\Assistant::formatDate($service->create_date) }}</div>
                    <div class="table-cell">
                        <a href="{{ route('sale_manager.serviceJournal.show', ['servicesJournalId' => $service->id]) }}" class="btn btn-sm btn-primary">Детали</a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="table-row">
                <div class="table-cell" colspan="6">Нет услуг для отображения.</div>
            </div>
        @endif
    </div>

    @if(isset($serviceJournalList) && $serviceJournalList->hasPages())
        {{ $serviceJournalList->links('components.manager-pagination') }}
    @endif
@endsection
