@extends('new.layouts.app')

@section('title', 'Управление пользователями')

@section('content')
    <div class="container py-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 fw-bold">Пользователи системы</h1>
                <p class="text-muted mb-0">
                    Управляйте пользователями, их ролями и правами доступа
                </p>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <!-- Vue компонент пользователей -->
                <user-list
                    :initial-role-type-list="{{$roleTypeList}}"
                    :role-list-prop="{{$roleList}}"
                    :manager-list-prop="{{$managerList}}"
                    :company-profile-address-list-prop="{{$companyProfileAddressList}}"
                    :city-list-prop="{{$cityList}}"
                ></user-list>
            </div>
        </div>
    </div>
@endsection
