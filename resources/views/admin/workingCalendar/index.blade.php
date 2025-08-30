@extends('layouts.modern-app')

@section('title', 'Рабочий календарь')

@section('page-header')
    <div class="py-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-text-primary">@lang('messages.admin.workingCalendar.working_calendar')</h1>
                <p class="mt-1 text-sm text-text-secondary">
                    Настройте рабочие дни недели и календарь событий
                </p>
            </div>
            <div class="flex items-center space-x-3">
                @component('components.modern.button', [
                    'variant' => 'primary',
                    'icon' => 'fas fa-plus',
                    'href' => route('admin.workingCalendar.create')
                ])
                    @lang('messages.all.add')
                @endcomponent
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="space-y-8">
    <!-- Working Days Configuration -->
    <div>
        @component('components.modern.card')
            <x-slot name="header">
                <h3 class="text-lg font-medium text-text-primary">
                    <i class="fas fa-calendar-week mr-2 text-primary-600"></i>
                    Настройка рабочих дней недели
                </h3>
            </x-slot>

            <form method="POST" action="{{ route('admin.workingCalendar.updateWeekDays', $weekWorkingDay->id) }}">
                @csrf
                @method('PUT')
                <input name="id" type="hidden" value="{{ $weekWorkingDay->id }}"/>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="space-y-4">
                        <h4 class="text-sm font-medium text-text-primary uppercase tracking-wider">Будние дни</h4>
                        
                        <!-- Monday -->
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" 
                                   name="mon" 
                                   value="1"
                                   {{ $weekWorkingDay->mon == 1 ? 'checked' : '' }}
                                   class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-border rounded">
                            <span class="text-sm font-medium text-text-primary">@lang('messages.all.week_days.monday')</span>
                        </label>
                        
                        <!-- Tuesday -->
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" 
                                   name="tue" 
                                   value="1"
                                   {{ $weekWorkingDay->tue == 1 ? 'checked' : '' }}
                                   class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-border rounded">
                            <span class="text-sm font-medium text-text-primary">@lang('messages.all.week_days.tuesday')</span>
                        </label>
                        
                        <!-- Wednesday -->
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" 
                                   name="wed" 
                                   value="1"
                                   {{ $weekWorkingDay->wed == 1 ? 'checked' : '' }}
                                   class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-border rounded">
                            <span class="text-sm font-medium text-text-primary">@lang('messages.all.week_days.wednesday')</span>
                        </label>
                    </div>
                    
                    <div class="space-y-4">
                        <h4 class="text-sm font-medium text-text-primary uppercase tracking-wider">&nbsp;</h4>
                        
                        <!-- Thursday -->
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" 
                                   name="thu" 
                                   value="1"
                                   {{ $weekWorkingDay->thu == 1 ? 'checked' : '' }}
                                   class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-border rounded">
                            <span class="text-sm font-medium text-text-primary">@lang('messages.all.week_days.thursday')</span>
                        </label>
                        
                        <!-- Friday -->
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" 
                                   name="fri" 
                                   value="1"
                                   {{ $weekWorkingDay->fri == 1 ? 'checked' : '' }}
                                   class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-border rounded">
                            <span class="text-sm font-medium text-text-primary">@lang('messages.all.week_days.friday')</span>
                        </label>
                    </div>
                    
                    <div class="space-y-4">
                        <h4 class="text-sm font-medium text-text-primary uppercase tracking-wider">Выходные</h4>
                        
                        <!-- Saturday -->
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" 
                                   name="sat" 
                                   value="1"
                                   {{ $weekWorkingDay->sat == 1 ? 'checked' : '' }}
                                   class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-border rounded">
                            <span class="text-sm font-medium text-text-primary">@lang('messages.all.week_days.saturday')</span>
                        </label>
                        
                        <!-- Sunday -->
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" 
                                   name="sun" 
                                   value="1"
                                   {{ $weekWorkingDay->sun == 1 ? 'checked' : '' }}
                                   class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-border rounded">
                            <span class="text-sm font-medium text-text-primary">@lang('messages.all.week_days.sunday')</span>
                        </label>
                    </div>
                    
                    <div class="flex items-end">
                        @component('components.modern.button', [
                            'type' => 'submit',
                            'variant' => 'primary',
                            'icon' => 'fas fa-save'
                        ])
                            @lang('messages.all.change')
                        @endcomponent
                    </div>
                </div>
            </form>
        @endcomponent
    </div>

    <!-- Calendar Events -->
    <div>
        @component('components.modern.card', ['padding' => 'none'])
            <x-slot name="header">
                <div class="px-6 py-4">
                    <h3 class="text-lg font-medium text-text-primary">
                        <i class="fas fa-calendar-alt mr-2 text-primary-600"></i>
                        События календаря
                    </h3>
                </div>
            </x-slot>

            <div class="overflow-x-auto">
                @component('components.modern.table', ['hoverable' => true])
                    <x-slot name="head">
                        <tr>
                            <th class="table-th">@lang('messages.all.decsription')</th>
                            <th class="table-th">@lang('messages.admin.workingCalendar.start_date')</th>
                            <th class="table-th">@lang('messages.admin.workingCalendar.end_date')</th>
                            <th class="table-th">@lang('messages.admin.workingCalendar.type')</th>
                            <th class="table-th">@lang('messages.all.actions')</th>
                        </tr>
                    </x-slot>

                    @forelse($workingCalendarList as $workingCalendar)
                        <tr class="table-tr">
                            <td class="table-td">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-primary-100 flex items-center justify-center">
                                            <i class="fas fa-calendar text-primary-600 text-sm"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-text-primary">
                                            {{ $workingCalendar->decsription }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="table-td">
                                <div class="text-sm">
                                    <div class="font-medium text-text-primary">
                                        {{ \Carbon\Carbon::parse($workingCalendar->start_date)->format('d.m.Y') }}
                                    </div>
                                    <div class="text-text-secondary">
                                        {{ \Carbon\Carbon::parse($workingCalendar->start_date)->format('l') }}
                                    </div>
                                </div>
                            </td>
                            <td class="table-td">
                                <div class="text-sm">
                                    <div class="font-medium text-text-primary">
                                        {{ \Carbon\Carbon::parse($workingCalendar->end_date)->format('d.m.Y') }}
                                    </div>
                                    <div class="text-text-secondary">
                                        {{ \Carbon\Carbon::parse($workingCalendar->end_date)->format('l') }}
                                    </div>
                                </div>
                            </td>
                            <td class="table-td">
                                @php
                                    $badgeVariant = 'default';
                                    $dayTypeName = $workingCalendar->dayType->name ?? 'Неизвестно';
                                    
                                    if (str_contains(strtolower($dayTypeName), 'выходной') || str_contains(strtolower($dayTypeName), 'отпуск')) {
                                        $badgeVariant = 'danger';
                                    } elseif (str_contains(strtolower($dayTypeName), 'рабочий')) {
                                        $badgeVariant = 'success';
                                    } elseif (str_contains(strtolower($dayTypeName), 'сокращенный')) {
                                        $badgeVariant = 'warning';
                                    }
                                @endphp
                                
                                @component('components.modern.badge', ['variant' => $badgeVariant, 'dot' => true])
                                    {{ $dayTypeName }}
                                @endcomponent
                            </td>
                            <td class="table-td">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.workingCalendar.edit', ['id' => $workingCalendar->id]) }}" 
                                       class="text-yellow-600 hover:text-yellow-900" 
                                       title="Редактировать">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <form method="POST" 
                                          action="{{ route('admin.workingCalendar.destroy', $workingCalendar->id) }}" 
                                          style="display: inline;"
                                          onsubmit="return confirm('Вы уверены, что хотите удалить это событие?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-900" 
                                                title="Удалить">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="table-td text-center py-12">
                                <div class="text-text-secondary">
                                    <i class="fas fa-calendar-times text-4xl mb-4"></i>
                                    <p class="text-lg font-medium">События календаря не найдены</p>
                                    <p class="mt-1">Добавьте первое событие для начала работы</p>
                                    <div class="mt-6">
                                        @component('components.modern.button', [
                                            'variant' => 'primary',
                                            'href' => route('admin.workingCalendar.create'),
                                            'icon' => 'fas fa-plus'
                                        ])
                                            Добавить событие
                                        @endcomponent
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                @endcomponent
            </div>
        @endcomponent
    </div>

    <!-- Pagination -->
    @if($workingCalendarList->hasPages())
        @component('components.modern.pagination', ['paginator' => $workingCalendarList])
        @endcomponent
    @endif
</div>
@endsection

@section('js')
<script>
    // Дополнительная логика для календаря
    document.addEventListener('DOMContentLoaded', function() {
        // Подсветка текущего дня недели
        const today = new Date().getDay();
        const weekDays = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
        const currentDayInput = document.querySelector(`input[name="${weekDays[today]}"]`);
        
        if (currentDayInput) {
            const label = currentDayInput.closest('label');
            if (label) {
                label.classList.add('bg-primary-50', 'p-2', 'rounded-md', 'border', 'border-primary-200');
                
                // Добавляем индикатор "сегодня"
                const todayBadge = document.createElement('span');
                todayBadge.className = 'ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800';
                todayBadge.textContent = 'сегодня';
                label.appendChild(todayBadge);
            }
        }

        // Анимация при изменении чекбоксов
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const label = this.closest('label');
                if (this.checked) {
                    label.classList.add('transform', 'scale-105');
                    setTimeout(() => {
                        label.classList.remove('transform', 'scale-105');
                    }, 150);
                }
            });
        });
    });
</script>
@endsection