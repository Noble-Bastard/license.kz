# UpperLicense - Modern Design System

Современная дизайн-система для UpperLicense, построенная на базе Laravel Blade, Tailwind CSS и Alpine.js с использованием дизайн-токенов из Figma.

## 🎨 Обзор

Эта дизайн-система предоставляет:
- **Современный интерфейс** с использованием последних трендов UI/UX
- **Компонентную архитектуру** для повторного использования
- **Темную тему** и адаптивный дизайн
- **Accessibility** поддержку
- **Консистентность** во всех частях приложения

## 📁 Структура файлов

```
resources/
├── css/
│   └── variables.css          # CSS custom properties и шрифты
├── views/
│   ├── layouts/
│   │   └── modern-app.blade.php    # Основной современный layout
│   ├── components/modern/
│   │   ├── alert.blade.php         # Компонент уведомлений
│   │   ├── badge.blade.php         # Статусные бейджи
│   │   ├── button.blade.php        # Кнопки
│   │   ├── card.blade.php          # Карточки
│   │   ├── input.blade.php         # Поля ввода
│   │   ├── modal.blade.php         # Модальные окна
│   │   ├── pagination.blade.php    # Пагинация
│   │   ├── sidebar.blade.php       # Боковая панель
│   │   ├── stat-card.blade.php     # Статистические карточки
│   │   ├── table.blade.php         # Таблицы
│   │   └── topbar.blade.php        # Верхняя панель
│   └── modern/
│       ├── dashboard/
│       │   └── index.blade.php     # Пример современного дашборда
│       └── commercial-offers/
│           └── index.blade.php     # Пример страницы со списком
├── design-tokens.json              # Дизайн-токены из Figma
tailwind.config.js                  # Конфигурация Tailwind CSS
config/tailwind.php                 # PHP конфигурация для Tailwind
```

## 🚀 Установка и настройка

### 1. Подключение стилей
Подключите новые стили в ваш layout:

```blade
<!-- В секции head -->
<link href="{{ asset('resources/css/variables.css') }}" rel="stylesheet" type="text/css">
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {!! json_encode(config('tailwind')) !!}
</script>

<!-- Alpine.js для интерактивности -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
```

### 2. Использование нового layout
Замените `@extends('layouts.app')` на `@extends('layouts.modern-app')`:

```blade
@extends('layouts.modern-app')

@section('title', 'Заголовок страницы')

@section('page-header')
    <div class="py-6">
        <h1 class="text-2xl font-bold text-text-primary">Заголовок</h1>
        <p class="mt-1 text-sm text-text-secondary">Описание страницы</p>
    </div>
@endsection

@section('content')
    <!-- Ваш контент -->
@endsection
```

## 🧩 Компоненты

### Кнопки

```blade
{{-- Основная кнопка --}}
@include('components.modern.button', [
    'variant' => 'primary',
    'icon' => 'fas fa-plus',
    'href' => route('create')
])
    Создать
@endcomponent

{{-- Варианты: primary, secondary, outline, ghost, danger, success, warning --}}
{{-- Размеры: xs, sm, md, lg, xl --}}
```

### Поля ввода

```blade
{{-- Текстовое поле --}}
@include('components.modern.input', [
    'type' => 'text',
    'name' => 'title',
    'label' => 'Заголовок',
    'placeholder' => 'Введите заголовок',
    'required' => true,
    'icon' => 'fas fa-heading'
])
@endcomponent

{{-- Выпадающий список --}}
@include('components.modern.input', [
    'type' => 'select',
    'name' => 'status',
    'label' => 'Статус',
    'placeholder' => 'Выберите статус'
])
    <option value="active">Активный</option>
    <option value="inactive">Неактивный</option>
@endcomponent
```

### Карточки

```blade
{{-- Базовая карточка --}}
@include('components.modern.card')
    <h3 class="text-lg font-medium text-text-primary">Заголовок</h3>
    <p class="mt-2 text-text-secondary">Содержимое карточки</p>
@endcomponent

{{-- Карточка с заголовком и подвалом --}}
@include('components.modern.card')
    <x-slot name="header">
        <h3 class="text-lg font-medium text-text-primary">Заголовок</h3>
    </x-slot>
    
    Основное содержимое
    
    <x-slot name="footer">
        <div class="flex justify-end space-x-3">
            @include('components.modern.button', ['variant' => 'secondary'])
                Отмена
            @endcomponent
            @include('components.modern.button', ['variant' => 'primary'])
                Сохранить
            @endcomponent
        </div>
    </x-slot>
@endcomponent
```

### Таблицы

```blade
@include('components.modern.table', ['hoverable' => true])
    <x-slot name="head">
        <tr>
            <th class="table-th">Имя</th>
            <th class="table-th">Email</th>
            <th class="table-th">Статус</th>
            <th class="table-th">Действия</th>
        </tr>
    </x-slot>

    @foreach($users as $user)
        <tr class="table-tr">
            <td class="table-td">{{ $user->name }}</td>
            <td class="table-td">{{ $user->email }}</td>
            <td class="table-td">
                @include('components.modern.badge', [
                    'variant' => $user->active ? 'success' : 'danger',
                    'dot' => true
                ])
                    {{ $user->active ? 'Активен' : 'Неактивен' }}
                @endcomponent
            </td>
            <td class="table-td">
                <!-- Действия -->
            </td>
        </tr>
    @endforeach
@endcomponent
```

### Модальные окна

```blade
{{-- Определение модального окна --}}
@include('components.modern.modal', [
    'name' => 'user-modal',
    'size' => 'lg',
    'title' => 'Редактирование пользователя'
])
    {{-- Содержимое модального окна --}}
    <form>
        @include('components.modern.input', [
            'name' => 'name',
            'label' => 'Имя',
            'required' => true
        ])
        @endcomponent
    </form>
    
    <x-slot name="footer">
        @include('components.modern.button', [
            'variant' => 'secondary',
            'attributes' => '@click="closeModal(\'user-modal\')"'
        ])
            Отмена
        @endcomponent
        @include('components.modern.button', ['variant' => 'primary'])
            Сохранить
        @endcomponent
    </x-slot>
@endcomponent

{{-- JavaScript для открытия --}}
<script>
    function openUserModal() {
        openModal('user-modal');
    }
</script>
```

### Статистические карточки

```blade
@include('components.modern.stat-card', [
    'title' => 'Активные услуги',
    'value' => '24',
    'change' => '+12%',
    'changeType' => 'positive',
    'icon' => 'fas fa-concierge-bell',
    'iconColor' => 'primary',
    'href' => route('services.index')
])
@endcomponent
```

### Бейджи

```blade
{{-- Статусные бейджи --}}
@include('components.modern.badge', ['variant' => 'success', 'dot' => true])
    Выполнено
@endcomponent

@include('components.modern.badge', ['variant' => 'warning'])
    В работе
@endcomponent

@include('components.modern.badge', ['variant' => 'outline-danger'])
    Отклонено
@endcomponent
```

### Уведомления

```blade
{{-- В layout уже подключена система уведомлений --}}
{{-- JavaScript для показа уведомлений --}}
<script>
    // Успешное уведомление
    showNotification('success', 'Успешно!', 'Данные сохранены');
    
    // Ошибка
    showNotification('error', 'Ошибка!', 'Не удалось сохранить');
    
    // Предупреждение
    showNotification('warning', 'Внимание!', 'Проверьте данные');
    
    // Информация
    showNotification('info', 'Информация', 'Новое обновление доступно');
</script>
```

## 🎨 Цветовая палитра

### Основные цвета
- **Primary**: `#279760` (зеленый) - основной цвет бренда
- **Secondary**: `#191E1D` (темно-серо-зеленый) - вторичный цвет
- **Success**: `#279760` - успех, положительные действия
- **Warning**: `#F0CB23` - предупреждения
- **Danger**: `#FE5959` - ошибки, удаление
- **Info**: `#64748b` - информационные сообщения

### Текстовые цвета
- **Primary**: `#1E2B28` - основной текст
- **Secondary**: `#6F6F6F` - вторичный текст
- **Tertiary**: `#282828` - третичный текст

### Фоновые цвета
- **Primary**: `#FFFFFF` - основной фон
- **Secondary**: `#F7F7F7` - вторичный фон
- **Tertiary**: `#F5F5F5` - третичный фон

## 📱 Адаптивность

Дизайн-система использует mobile-first подход:
- **xs**: 475px+
- **sm**: 640px+
- **md**: 768px+
- **lg**: 1024px+
- **xl**: 1280px+
- **2xl**: 1536px+

## ♿ Accessibility

Все компоненты включают:
- Правильные ARIA атрибуты
- Поддержку клавиатурной навигации
- Семантическую разметку
- Контрастные цвета согласно WCAG 2.1

## 🌙 Темная тема

Система поддерживает автоматическое переключение темы:
```javascript
// Переключение темы
toggleTheme();

// Система автоматически сохраняет выбор в localStorage
```

## 📊 Примеры страниц

### Дашборд
Пример современного дашборда находится в `resources/views/modern/dashboard/index.blade.php`

### Список коммерческих предложений
Пример страницы со списком данных в `resources/views/modern/commercial-offers/index.blade.php`

## 🔧 Кастомизация

### CSS Variables
Все цвета и размеры настраиваются через CSS переменные в `resources/css/variables.css`:

```css
:root {
    --color-primary-500: #279760;
    --color-text-primary: #1E2B28;
    --font-size-base: 1rem;
    /* ... */
}
```

### Tailwind Configuration
Расширенная конфигурация в `tailwind.config.js` и `config/tailwind.php`

## 📞 Поддержка

При возникновении вопросов или проблем:
1. Проверьте документацию компонентов
2. Убедитесь, что подключены все необходимые стили и скрипты
3. Проверьте консоль браузера на наличие ошибок

## 🚀 Миграция

### Поэтапное обновление
1. Создайте новые страницы используя `layouts.modern-app`
2. Постепенно переносите существующие страницы
3. Обновляйте компоненты на новые версии
4. Тестируйте функциональность

### Обратная совместимость
Старые layouts остаются рабочими, новая система работает параллельно.

---

**Версия**: 1.0.0  
**Дата создания**: {{ date('d.m.Y') }}  
**Технологии**: Laravel Blade, Tailwind CSS, Alpine.js, Inter Font



