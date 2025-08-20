@extends('new.layouts.salemanager')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Услуги</h1>
    </div>

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
