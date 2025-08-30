@extends('layouts.figma-sales')

@section('title', 'Test Button')

@section('content')
<div class="py-6">
    <h1 class="text-2xl font-bold text-text-primary mb-6">Тест кнопки</h1>
    
    <div class="space-y-4">
        <div>
            <h3 class="text-lg font-medium mb-2">Кнопка с href:</h3>
            @component('components.modern.button', [
                'variant' => 'primary',
                'icon' => 'fas fa-plus',
                'href' => '#',
                'content' => 'Создать КП'
            ])
        </div>
        
        <div>
            <h3 class="text-lg font-medium mb-2">Обычная кнопка:</h3>
            @component('components.modern.button', [
                'variant' => 'primary',
                'icon' => 'fas fa-plus',
                'content' => 'Тест кнопка'
            ])
        </div>
        
        <div>
            <h3 class="text-lg font-medium mb-2">Кнопка с content:</h3>
            @component('components.modern.button', [
                'variant' => 'primary',
                'icon' => 'fas fa-plus',
                'content' => 'Тест через content'
            ])
        </div>
    </div>
</div>
@endsection




