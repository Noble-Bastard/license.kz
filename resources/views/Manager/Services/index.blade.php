@extends('new.layouts.manager')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Услуги</h1>
        <div class="header-actions">
            <button class="search-btn">
                <img src="{{ asset('new/images/manager/icon-search.svg') }}" alt="Search" />
                <span>Поиск по номеру услуги или компании</span>
            </button>
        </div>
    </div>

    <div class="services-tabs">
        <a href="{{ route('manager.services.list') }}" class="tab-btn {{ !request('status_id') ? 'active' : '' }}">Все услуги</a>
        @if(isset($statusList))
            @foreach($statusList as $status)
                <a href="{{ route('manager.services.list', ['status_id' => $status->id]) }}" class="tab-btn {{ request('status_id') == $status->id ? 'active' : '' }}">
                    {{ $status->name }}
                </a>
            @endforeach
        @endif
    </div>

    <div class="manager-table">
        <div class="table-header">
            <div class="table-header-cell service-number">Номер услуги</div>
            <div class="table-header-cell status">Статус</div>
            <div class="table-header-cell date">Дата обращения</div>
            <div class="table-header-cell executor">Исполнитель</div>
            <div class="table-header-cell client">Клиент</div>
            <div class="table-header-cell client-check">Проверка клиента</div>
            <div class="table-header-cell prepayment">Предоплата</div>
            <div class="table-header-cell full-payment">Полная оплата</div>
        </div>

        @if(isset($serviceJournalList) && $serviceJournalList->isNotEmpty())
            @foreach($serviceJournalList as $service)
                <div class="table-row" onclick="window.location='{{ route('Manager.services.show', $service->id) }}';">
                    <div class="table-cell service-number">УСЛ-{{ $service->id }}</div>
                    <div class="table-cell status">
                        <div class="status-indicator">
                            <span class="status-dot" style="background-color: {{ $service->projectStatus->color ?? '#ccc' }};"></span>
                            <span class="status-text">{{ $service->projectStatus->name ?? 'Неизвестен' }}</span>
                        </div>
                    </div>
                    <div class="table-cell date">{{ $service->created_at ? $service->created_at->format('d.m.Y') : 'N/A' }}</div>
                    <div class="table-cell executor">
                        @if($service->executor)
                            <div class="executor-avatar">
                                <img src="{{ $service->executor->avatar ?? asset('images/user1.png') }}" alt="{{ $service->executor->full_name }}">
                            </div>
                            <span>{{ $service->executor->full_name }}</span>
                        @else
                            Не назначен
                        @endif
                    </div>
                    <div class="table-cell client">
                         @if($service->client)
                            <div class="executor-avatar">
                                <img src="{{ $service->client->avatar ?? asset('images/user1.png') }}" alt="{{ $service->client->full_name }}">
                            </div>
                            <span>{{ $service->client->full_name }}</span>
                        @else
                            Не назначен
                        @endif
                    </div>
                    <div class="table-cell client-check">
                        {{-- Logic for client check status --}}
                        <span class="status-icon success"></span> Пройдена
                    </div>
                    <div class="table-cell prepayment">
                        {{-- Logic for prepayment status --}}
                        <span class="status-icon success"></span> Оплачено
                    </div>
                    <div class="table-cell full-payment">
                        {{-- Logic for full payment status --}}
                        <span class="status-icon pending"></span> Не оплачено
                    </div>
                </div>
            @endforeach
        @else
            <div class="table-row">
                <div class="table-cell" colspan="8">Нет услуг для отображения.</div>
            </div>
        @endif
    </div>

    @if(isset($serviceJournalList) && $serviceJournalList->hasPages())
        {{ $serviceJournalList->links('components.manager-pagination') }}
    @endif
@endsection

@section('js')
    <script>
        $(function () {
            // Tab switching
            $('.tab-btn').click(function() {
                $('.tab-btn').removeClass('active');
                $(this).addClass('active');
                // Add your tab switching logic here
            });
        });
    </script>
@endsection





