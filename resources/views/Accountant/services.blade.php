@extends('new.layouts.accountant')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Услуги</h1>
    </div>

    <div class="manager-table">
        <div class="table-header">
            <div class="table-header-cell">ID</div>
            <div class="table-header-cell">Клиент</div>
            <div class="table-header-cell">Услуга</div>
            <div class="table-header-cell">Статус</div>
            <div class="table-header-cell">Дата</div>
            <div class="table-header-cell">Действия</div>
        </div>

        @if(isset($serviceJournalList) && $serviceJournalList->isNotEmpty())
            @foreach($serviceJournalList as $service)
                <div class="table-row">
                    <div class="table-cell">{{ $service->id }}</div>
                    <div class="table-cell">{{ $service->client->full_name ?? 'N/A' }}</div>
                    <div class="table-cell">{{ $service->service_name }}</div>
                    <div class="table-cell">
                        <span class="status-dot" style="background-color: {{ $service->projectStatus->color ?? '#ccc' }}"></span>
                        <span class="status-text">{{ $service->service_status_name }}</span>
                    </div>
                    <div class="table-cell">{{ $service->created_at->format('d.m.Y') }}</div>
                    <div class="table-cell">
                        <a href="#" class="btn btn-sm btn-primary">Детали</a>
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
        @include('components.manager-pagination', ['paginator' => $serviceJournalList])
    @endif
@endsection