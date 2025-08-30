{{-- 
Правильный способ использования card компонента:

Простая карточка:
@component('components.modern.card', ['content' => 'Ваш контент здесь'])

С заголовком:
@component('components.modern.card', [
    'content' => 'Основной контент',
    'header' => '<h3 class="text-lg font-medium text-text-primary">Заголовок</h3>'
])

С заголовком и подвалом:
@component('components.modern.card', [
    'content' => 'Основной контент',
    'header' => '<h3 class="text-lg font-medium text-text-primary">Заголовок</h3>',
    'footer' => '<div class="flex justify-end space-x-3">
        <button class="btn btn-secondary">Отмена</button>
        <button class="btn btn-primary">Сохранить</button>
    </div>'
])

Полный список параметров:
- content: основной контент (обязательный)
- header: заголовок карточки
- footer: подвал карточки  
- variant: default|outlined|elevated|flat
- padding: none|sm|default|lg
- shadow: none|sm|default|lg|xl
- hover: true|false (эффект при наведении)
- class: дополнительные CSS классы
--}}

<div>
    {{-- Это файл с документацией, не удаляйте --}}
</div>


