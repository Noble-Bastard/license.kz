@extends('new.layouts.salemanager')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Клиенты</h1>
    </div>

    <div class="manager-table">
        <div class="table-header">
            <div class="table-header-cell">ID</div>
            <div class="table-header-cell">Имя</div>
            <div class="table-header-cell">Email</div>
            <div class="table-header-cell">Телефон</div>
            <div class="table-header-cell">Агент</div>
            <div class="table-header-cell">Действия</div>
        </div>

        @if(isset($clientList) && $clientList->isNotEmpty())
            @foreach($clientList as $client)
                <div class="table-row">
                    <div class="table-cell">{{ $client->id }}</div>
                    <div class="table-cell">{{ $client->full_name }}</div>
                    <div class="table-cell">{{ $client->email }}</div>
                    <div class="table-cell">{{ $client->phone ?? 'N/A' }}</div>
                    <div class="table-cell">{{ $client->agent->full_name ?? 'Не назначен' }}</div>
                    <div class="table-cell">
                        <a href="#" class="btn btn-sm btn-primary">Детали</a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="table-row">
                <div class="table-cell" colspan="6">Нет клиентов для отображения.</div>
            </div>
        @endif
    </div>

    @if(isset($clientList) && $clientList->hasPages())
        {{ $clientList->links('components.manager-pagination') }}
    @endif
@endsection


@section('js')
    <script>
        //activeTab('client-list');
    </script>
@endsection