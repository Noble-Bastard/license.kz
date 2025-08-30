@extends('layouts.modern-app')

@section('title', 'Тест современных компонентов')

@section('page-header')
    <div class="py-6">
        <h1 class="text-2xl font-bold text-text-primary">Тест компонентов</h1>
        <p class="mt-1 text-sm text-text-secondary">Проверка работы всех компонентов</p>
    </div>
@endsection

@section('content')
<div class="space-y-8">
    <!-- Simple Card Test -->
    <div>
        <h2 class="text-xl font-semibold mb-4">Простая карточка</h2>
        @component('components.modern.card', [
            'content' => '<p class="text-text-primary">Это простая карточка с содержимым</p>'
        ])
    </div>

    <!-- Button Test -->
    <div>
        <h2 class="text-xl font-semibold mb-4">Кнопки</h2>
        @component('components.modern.button', [
            'variant' => 'primary',
            'content' => 'Основная кнопка'
        ])
    </div>

    <!-- Alert Test -->
    <div>
        <h2 class="text-xl font-semibold mb-4">Уведомления</h2>
        @component('components.modern.alert', [
            'type' => 'success',
            'message' => 'Это успешное уведомление!'
        ])
    </div>

    <!-- Badge Test -->
    <div>
        <h2 class="text-xl font-semibold mb-4">Бейджи</h2>
        @component('components.modern.badge', [
            'variant' => 'success',
            'content' => 'Активен'
        ])
    </div>
</div>
@endsection


