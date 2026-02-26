@extends('layouts.admin-app')

@section('title', 'Управление каталогом')

@section('content')
    <div class="container py-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 fw-bold">Каталог услуг</h1>
                <p class="text-muted mb-0">
                    Управляйте структурой каталога услуг и категориями
                </p>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <!-- Vue компонент каталога -->
                <catalog :initial-country-list="{{ $countryList }}" ref="catalog"></catalog>
            </div>
        </div>
    </div>
@endsection
