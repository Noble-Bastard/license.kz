@extends('layouts.modern-app')

@section('title', 'Управление каталогом')

@section('page-header')
    <div class="py-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-text-primary">Каталог услуг</h1>
                <p class="mt-1 text-sm text-text-secondary">
                    Управляйте структурой каталога услуг и категориями
                </p>
            </div>
            <div class="flex items-center space-x-3">
                @component('components.modern.button', [
                    'variant' => 'outline',
                    'icon' => 'fas fa-download'
                ])
                    Экспорт каталога
                @endcomponent
                
                @component('components.modern.button', [
                    'variant' => 'primary',
                    'icon' => 'fas fa-folder-plus'
                ])
                    Добавить категорию
                @endcomponent
            </div>
        </div>
    </div>
@endsection

@section('content')
    @component('components.modern.card', ['padding' => 'none'])
        <!-- Vue компонент каталога -->
        <div class="p-6">
            <catalog :initial-country-list="{{ $countryList }}" ref="catalog"></catalog>
        </div>
    @endcomponent
@endsection

@section('js')
    <script>
    // Подключаем стили для Vue компонента каталога
    document.addEventListener('DOMContentLoaded', function() {
        // Ждем пока Vue компонент загрузится
        setTimeout(() => {
            const vueContainer = document.querySelector('catalog');
            if (vueContainer) {
                // Применяем современные стили
                applyCatalogStyles(vueContainer);
            }
        }, 1000);

        // Слушаем изменения в DOM для динамически добавляемых элементов
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                mutation.addedNodes.forEach(function(node) {
                    if (node.nodeType === 1) { // ELEMENT_NODE
                        const catalogElement = node.querySelector ? node.querySelector('catalog') : null;
                        if (catalogElement || node.tagName === 'CATALOG') {
                            applyCatalogStyles(catalogElement || node);
                        }
                    }
                });
            });
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    });

    function applyCatalogStyles(container) {
        // Стили для кнопок
        const buttons = container.querySelectorAll('.btn, button');
        buttons.forEach(btn => {
            btn.classList.add('inline-flex', 'items-center', 'justify-center', 'font-medium', 'rounded-md', 'focus:outline-none', 'focus:ring-2', 'focus:ring-offset-2', 'transition-all', 'duration-200');
            
            if (btn.classList.contains('btn-success') || btn.classList.contains('btn-primary')) {
                btn.classList.add('bg-primary-600', 'text-white', 'hover:bg-primary-700', 'focus:ring-primary-500', 'shadow-sm', 'px-4', 'py-2', 'text-sm');
            } else if (btn.classList.contains('btn-secondary')) {
                btn.classList.add('bg-white', 'text-text-primary', 'border', 'border-border', 'hover:bg-neutral-50', 'focus:ring-primary-500', 'shadow-sm', 'px-4', 'py-2', 'text-sm');
            } else if (btn.classList.contains('btn-danger')) {
                btn.classList.add('bg-accent-red', 'text-white', 'hover:bg-red-700', 'focus:ring-red-500', 'shadow-sm', 'px-4', 'py-2', 'text-sm');
            } else {
                // Кнопки без специальных классов
                btn.classList.add('bg-neutral-100', 'text-text-secondary', 'hover:bg-neutral-200', 'px-3', 'py-1.5', 'text-sm');
            }
        });

        // Стили для таблиц
        const tables = container.querySelectorAll('.table, table');
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
                    td.classList.add('px-6', 'py-4', 'text-sm', 'text-text-primary');
                });
                
                const trs = tbody.querySelectorAll('tr');
                trs.forEach(tr => {
                    tr.classList.add('hover:bg-neutral-50', 'transition-colors');
                });
            }
        });

        // Стили для форм
        const inputs = container.querySelectorAll('input[type="text"], input[type="email"], input[type="password"], input[type="number"], select, textarea');
        inputs.forEach(input => {
            input.classList.add(
                'block', 'w-full', 'rounded-md', 'border-0', 'py-1.5', 'px-3',
                'shadow-sm', 'ring-1', 'ring-inset', 'ring-border', 
                'placeholder:text-text-tertiary', 'focus:ring-2', 'focus:ring-inset', 
                'focus:ring-primary-600', 'text-text-primary', 'sm:text-sm', 'sm:leading-6'
            );
        });

        // Стили для карточек
        const cards = container.querySelectorAll('.card, .panel');
        cards.forEach(card => {
            card.classList.add('bg-white', 'rounded-lg', 'border', 'border-border-light', 'shadow-sm', 'overflow-hidden');
            
            const cardHeader = card.querySelector('.card-header, .panel-heading');
            if (cardHeader) {
                cardHeader.classList.add('px-6', 'py-4', 'border-b', 'border-border-light', 'bg-neutral-50');
            }

            const cardBody = card.querySelector('.card-body, .panel-body');
            if (cardBody) {
                cardBody.classList.add('p-6');
            }
        });

        // Стили для списков
        const lists = container.querySelectorAll('ul, ol');
        lists.forEach(list => {
            if (list.classList.contains('list-group')) {
                list.classList.add('divide-y', 'divide-border-light', 'border', 'border-border-light', 'rounded-md');
                
                const items = list.querySelectorAll('li');
                items.forEach(item => {
                    item.classList.add('px-4', 'py-3', 'hover:bg-neutral-50', 'transition-colors');
                });
            }
        });

        // Стили для бейджей и лейблов
        const badges = container.querySelectorAll('.badge, .label');
        badges.forEach(badge => {
            badge.classList.add('inline-flex', 'items-center', 'px-2.5', 'py-0.5', 'rounded-full', 'text-xs', 'font-medium');
            
            if (badge.classList.contains('badge-success') || badge.classList.contains('label-success')) {
                badge.classList.add('bg-green-100', 'text-green-800');
            } else if (badge.classList.contains('badge-danger') || badge.classList.contains('label-danger')) {
                badge.classList.add('bg-red-100', 'text-red-800');
            } else if (badge.classList.contains('badge-warning') || badge.classList.contains('label-warning')) {
                badge.classList.add('bg-yellow-100', 'text-yellow-800');
            } else if (badge.classList.contains('badge-info') || badge.classList.contains('label-info')) {
                badge.classList.add('bg-blue-100', 'text-blue-800');
            } else {
                badge.classList.add('bg-neutral-100', 'text-text-secondary');
            }
        });

        // Стили для дропдаунов
        const dropdowns = container.querySelectorAll('.dropdown-menu');
        dropdowns.forEach(dropdown => {
            dropdown.classList.add(
                'absolute', 'right-0', 'mt-2', 'w-56', 'bg-white', 'rounded-md', 
                'shadow-lg', 'ring-1', 'ring-black', 'ring-opacity-5', 'z-50'
            );
            
            const items = dropdown.querySelectorAll('.dropdown-item');
            items.forEach(item => {
                item.classList.add('block', 'px-4', 'py-2', 'text-sm', 'text-text-secondary', 'hover:bg-neutral-50', 'hover:text-text-primary');
            });
        });

        // Стили для модальных окон
        const modals = container.querySelectorAll('.modal');
        modals.forEach(modal => {
            const modalDialog = modal.querySelector('.modal-dialog');
            if (modalDialog) {
                modalDialog.classList.add('bg-white', 'rounded-lg', 'shadow-xl');
            }
            
            const modalHeader = modal.querySelector('.modal-header');
            if (modalHeader) {
                modalHeader.classList.add('px-6', 'py-4', 'border-b', 'border-border-light');
            }
            
            const modalBody = modal.querySelector('.modal-body');
            if (modalBody) {
                modalBody.classList.add('p-6');
            }
            
            const modalFooter = modal.querySelector('.modal-footer');
            if (modalFooter) {
                modalFooter.classList.add('px-6', 'py-4', 'border-t', 'border-border-light', 'bg-neutral-50');
            }
        });

        // Стили для алертов
        const alerts = container.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.classList.add('rounded-md', 'p-4', 'mb-4');
            
            if (alert.classList.contains('alert-success')) {
                alert.classList.add('bg-green-50', 'border', 'border-green-200', 'text-green-800');
            } else if (alert.classList.contains('alert-danger')) {
                alert.classList.add('bg-red-50', 'border', 'border-red-200', 'text-red-800');
            } else if (alert.classList.contains('alert-warning')) {
                alert.classList.add('bg-yellow-50', 'border', 'border-yellow-200', 'text-yellow-800');
            } else if (alert.classList.contains('alert-info')) {
                alert.classList.add('bg-blue-50', 'border', 'border-blue-200', 'text-blue-800');
            }
        });
    }
    </script>
@endsection