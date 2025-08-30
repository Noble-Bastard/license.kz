@extends('layouts.modern-app')

@section('title', 'Управление пользователями')

@section('page-header')
    <div class="py-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-text-primary">Пользователи системы</h1>
                <p class="mt-1 text-sm text-text-secondary">
                    Управляйте пользователями, их ролями и правами доступа
                </p>
            </div>
            <div class="flex items-center space-x-3">
                @component('components.modern.button', [
                    'variant' => 'outline',
                    'icon' => 'fas fa-download'
                ])
                    Экспорт
                @endcomponent
                
                @component('components.modern.button', [
                    'variant' => 'primary',
                    'icon' => 'fas fa-user-plus'
                ])
                    Добавить пользователя
                @endcomponent
            </div>
        </div>
    </div>
@endsection

@section('content')
    @component('components.modern.card', ['padding' => 'none'])
        <!-- Vue компонент пользователей -->
        <div class="p-6">
            <user-list
                :initial-role-type-list="{{$roleTypeList}}"
                :role-list-prop="{{$roleList}}"
                :manager-list-prop="{{$managerList}}"
                :company-profile-address-list-prop="{{$companyProfileAddressList}}"
                :city-list-prop="{{$cityList}}"
            ></user-list>
        </div>
    @endcomponent
@endsection

@section('js')
<script>
    // Подключаем стили для Vue компонента к нашей дизайн-системе
    document.addEventListener('DOMContentLoaded', function() {
        // Ждем пока Vue компонент загрузится
        setTimeout(() => {
            // Применяем наши современные стили к элементам Vue компонента
            const vueContainer = document.querySelector('user-list');
            if (vueContainer) {
                // Добавляем современные классы к кнопкам
                const buttons = vueContainer.querySelectorAll('.btn');
                buttons.forEach(btn => {
                    if (btn.classList.contains('btn-success')) {
                        btn.classList.add('bg-primary-600', 'hover:bg-primary-700', 'text-white', 'font-medium', 'rounded-md', 'transition-colors');
                    }
                    if (btn.classList.contains('btn-secondary')) {
                        btn.classList.add('bg-white', 'hover:bg-neutral-50', 'text-text-primary', 'border', 'border-border', 'font-medium', 'rounded-md', 'transition-colors');
                    }
                });

                // Добавляем современные стили к таблице
                const tables = vueContainer.querySelectorAll('.table');
                tables.forEach(table => {
                    table.classList.add('min-w-full', 'divide-y', 'divide-border-light');
                    
                    const thead = table.querySelector('thead');
                    if (thead) {
                        thead.classList.add('bg-neutral-50');
                        const ths = thead.querySelectorAll('th');
                        ths.forEach(th => {
                            th.classList.add('px-6', 'py-3', 'text-left', 'text-xs', 'font-medium', 'text-text-tertiary', 'uppercase', 'tracking-wider');
                        });
                    }

                    const tbody = table.querySelector('tbody');
                    if (tbody) {
                        tbody.classList.add('bg-white', 'divide-y', 'divide-border-light');
                        const tds = tbody.querySelectorAll('td');
                        tds.forEach(td => {
                            td.classList.add('px-6', 'py-4', 'whitespace-nowrap', 'text-sm', 'text-text-primary');
                        });
                        
                        const trs = tbody.querySelectorAll('tr');
                        trs.forEach(tr => {
                            tr.classList.add('hover:bg-neutral-50', 'transition-colors');
                        });
                    }
                });

                // Добавляем современные стили к формам
                const inputs = vueContainer.querySelectorAll('input[type="text"], input[type="email"], select');
                inputs.forEach(input => {
                    input.classList.add('block', 'w-full', 'rounded-md', 'border-0', 'py-1.5', 'shadow-sm', 'ring-1', 'ring-inset', 'ring-border', 'placeholder:text-text-tertiary', 'focus:ring-2', 'focus:ring-inset', 'focus:ring-primary-600', 'sm:text-sm', 'sm:leading-6');
                });

                // Добавляем современные стили к карточкам
                const cards = vueContainer.querySelectorAll('.card');
                cards.forEach(card => {
                    card.classList.add('bg-white', 'rounded-lg', 'border', 'border-border-light', 'shadow-md');
                    
                    const cardBody = card.querySelector('.card-body');
                    if (cardBody) {
                        cardBody.classList.add('p-6');
                    }
                });
            }
        }, 1000);
    });
</script>
@endsection