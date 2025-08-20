@extends('new.layouts.client')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Мои услуги</h1>
    </div>

    <div class="services-list client-services">
        @if(isset($serviceJournalList) && $serviceJournalList->isNotEmpty())
            @foreach($serviceJournalList as $service)
                <div class="service-card">
                    <a href="{{ route('Client.serviceJournal.show', $service->id) }}" class="service-card-link">
                        <div class="service-header">
                            <div class="service-id">УСЛ-{{ $service->service_no }}</div>
                            <div class="service-date">{{ $service->created_at->format('d.m.Y') }}</div>
                        </div>
                        <div class="service-status">
                             <span class="status-dot" style="background-color: {{ $service->projectStatus->color ?? '#ccc' }}"></span>
                             <span class="status-text">{{ $service->service_status_name }}</span>
                        </div>
                        <div class="service-details">
                            <div class="detail-row">
                                <div class="detail-label">Услуга</div>
                                <div class="detail-value">{{ $service->service_name }}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Менеджер</div>
                                <div class="detail-value">{{ $service->manager_full_name ?? 'Не назначен' }}</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @else
            <p>У вас пока нет заказанных услуг.</p>
        @endif
    </div>

    @if(isset($serviceJournalList) && $serviceJournalList->hasPages())
        @include('components.manager-pagination', ['paginator' => $serviceJournalList])
    @endif
@endsection
