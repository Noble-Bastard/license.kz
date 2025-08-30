@extends('layouts.figma-app')

@section('content')
<div class="w-full">
    <div class="flex items-center justify-between px-5 py-5" style="padding-left:20px;padding-right:20px;">
        <h1 class="text-[39px] leading-[1] font-normal tracking-[-0.02em] text-text-primary">Услуги</h1>
        <div class="flex items-center gap-[11px] px-[16px] pr-[22px] py-[11px] h-[46px] border border-border-light rounded-[60px] bg-white">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.8333 15.8333L13.2083 13.2083" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <input type="text" placeholder="Поиск по номеру услуги или компании" class="bg-transparent border-none outline-none text-[12px] font-medium leading-[1] text-text-primary placeholder:text-text-primary" />
        </div>
    </div>

    <div class="px-5" style="padding-left:20px;padding-right:20px;">
        <div class="flex items-center gap-[10px] mb-[16px]">
            @php $active = request('status_id'); @endphp
            <a href="{{ route('manager.services.list') }}" class="px-[14px] py-[10px] rounded-[60px] text-[12px] font-medium {{ !$active ? 'bg-[#279760] text-white' : 'bg-white text-text-primary border border-border-light' }}">Все услуги</a>
            @if(isset($statusList))
                @foreach($statusList as $status)
                    <a href="{{ route('manager.services.list', ['status_id' => $status->id]) }}" class="px-[14px] py-[10px] rounded-[60px] text-[12px] font-medium {{ $active == $status->id ? 'bg-[#279760] text-white' : 'bg-white text-text-primary border border-border-light' }}">{{ $status->name }}</a>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Filters -->
    <div class="mb-6">
        <div class="bg-white rounded-lg border border-border-light shadow-md p-6">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div>
                    <input type="text" 
                           name="search"
                           placeholder="Поиск по номеру или клиенту"
                           x-model="filters.search" 
                           @input.debounce.300ms="applyFilters()"
                           class="w-full px-4 py-3 border border-border-light rounded-lg focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent transition-all duration-200">
                </div>
                
                <div>
                    <select name="executor" 
                            x-model="filters.executor" 
                            @change="applyFilters()"
                            class="w-full px-4 py-3 border border-border-light rounded-lg focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent transition-all duration-200">
                        <option value="">Все исполнители</option>
                        <!-- Список исполнителей из базы -->
                    </select>
                </div>
                
                <div>
                    <select name="payment_status" 
                            x-model="filters.payment_status" 
                            @change="applyFilters()"
                            class="w-full px-4 py-3 border border-border-light rounded-lg focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent transition-all duration-200">
                        <option value="">Все</option>
                        <option value="prepaid">Предоплачено</option>
                        <option value="fully_paid">Полностью оплачено</option>
                        <option value="unpaid">Не оплачено</option>
                    </select>
                </div>
                
                <div>
                    <select name="date_range" 
                            x-model="filters.date_range" 
                            @change="applyFilters()"
                            class="w-full px-4 py-3 border border-border-light rounded-lg focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent transition-all duration-200">
                        <option value="">Все периоды</option>
                        <option value="today">Сегодня</option>
                        <option value="week">Эта неделя</option>
                        <option value="month">Этот месяц</option>
                    </select>
                </div>
        </div>

                <div class="flex items-end">
                    <button type="button" 
                            @click="resetFilters()"
                            class="w-full inline-flex items-center justify-center px-4 py-3 bg-white border border-border-light text-text-primary font-medium rounded-lg hover:bg-neutral-50 focus:ring-2 focus:ring-[var(--color-primary)] focus:ring-offset-2 transition-all duration-200">
                        <svg class="mr-2" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21 12a9 9 0 11-3.09-6.7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M21 3v7h-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Сбросить
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Table -->
    <div class="mb-6">
        <div class="bg-white rounded-lg border border-border-light shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-border-light">
                    <thead class="bg-neutral-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Номер услуги</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Статус</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Дата обращения</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Исполнитель</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Клиент</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Проверка клиента</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Предоплата</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Полная оплата</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Действия</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-border-light">
        @if(isset($serviceJournalList) && $serviceJournalList->isNotEmpty())
            @foreach($serviceJournalList as $service)
                                <tr class="hover:bg-neutral-50 cursor-pointer" 
                                    @if(Route::has('Manager.services.show'))
                                        onclick="window.location='{{ route('Manager.services.show', $service->id) }}';"
                                    @endif>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex-shrink-0 w-10 h-10 rounded-lg flex items-center justify-center" style="background:#E9F6EE">
                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 3c-3.866 0-7 3.134-7 7v3.5L3 16v1h18v-1l-2-2.5V10c0-3.866-3.134-7-7-7z" stroke="#279760" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 19a3 3 0 006 0" stroke="#279760" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-text-primary">УСЛ-{{ $service->id }}</div>
                                                <div class="text-xs text-text-secondary">{{ $service->service_name ?? 'Название услуги' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusName = $service->projectStatus->name ?? 'Неизвестен';
                                            
                                            $badgeClass = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium';
                                            if (str_contains(strtolower($statusName), 'завершен')) {
                                                $badgeClass .= ' bg-green-100 text-green-800';
                                            } elseif (str_contains(strtolower($statusName), 'процесс') || str_contains(strtolower($statusName), 'работе')) {
                                                $badgeClass .= ' bg-yellow-100 text-yellow-800';
                                            } elseif (str_contains(strtolower($statusName), 'новый')) {
                                                $badgeClass .= ' bg-blue-100 text-blue-800';
                                            } elseif (str_contains(strtolower($statusName), 'отменен')) {
                                                $badgeClass .= ' bg-red-100 text-red-800';
                                            } else {
                                                $badgeClass .= ' bg-neutral-100 text-neutral-800';
                                            }
                                        @endphp
                                        
                                        <span class="{{ $badgeClass }}">
                                            <span class="w-1.5 h-1.5 bg-current rounded-full mr-1.5"></span>
                                            {{ $statusName }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm">
                                            <div class="font-medium text-text-primary">
                                                {{ $service->created_at ? $service->created_at->format('d.m.Y') : 'N/A' }}
                                            </div>
                                            <div class="text-text-secondary">
                                                {{ $service->created_at ? $service->created_at->format('H:i') : '' }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($service->executor)
                                            <div class="flex items-center space-x-3">
                                                <div class="flex-shrink-0">
                                                    @if($service->executor->profile->photo_id)
                                                        <img src="/storage_/{{ $service->executor->profile->photo_path }}" 
                                                             alt="Executor" 
                                                             class="w-8 h-8 rounded-full object-cover">
                                                    @else
                                                        <div class="w-8 h-8 bg-neutral-200 rounded-full flex items-center justify-center">
                                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" stroke="#6F6F6F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 11a4 4 0 100-8 4 4 0 000 8z" stroke="#6F6F6F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                        </div>
                        @endif
                    </div>
                                                <div class="min-w-0 flex-1">
                                                    <p class="text-sm font-medium text-text-primary truncate">
                                                        {{ $service->executor->profile->first_name }} {{ $service->executor->profile->last_name }}
                                                    </p>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-sm text-text-secondary">Не назначен</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                         @if($service->client)
                                            <div>
                                                <p class="text-sm font-medium text-text-primary">
                                                    {{ $service->client->profile->user_name ?? 'Клиент' }}
                                                </p>
                                                <p class="text-xs text-text-secondary">
                                                    {{ $service->client->email ?? '' }}
                                                </p>
                                            </div>
                                        @else
                                            <span class="text-sm text-text-secondary">Не указан</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($service->client_verification_status)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Проверен
                                            </span>
                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Требует проверки
                                            </span>
                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($service->prepayment_status)
                                            <div class="flex items-center space-x-2 text-green-700">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                <span class="text-sm">Оплачено</span>
                                            </div>
                                        @else
                                            <div class="flex items-center space-x-2 text-yellow-700">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 8v5l3 3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/></svg>
                                                <span class="text-sm">Ожидается</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($service->full_payment_status)
                                            <div class="flex items-center space-x-2 text-green-700">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                <span class="text-sm">Оплачено</span>
                                            </div>
                                        @else
                                            <div class="flex items-center space-x-2 text-red-700">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                                                <span class="text-sm">Не оплачено</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-2">
                                            @if(Route::has('Manager.services.show'))
                                                <a href="{{ route('Manager.services.show', $service->id) }}" 
                                                   class="text-text-primary hover:opacity-80" 
                                                   title="Просмотр">
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/></svg>
                                                </a>
                                            @else
                                                <span class="text-neutral-400" title="Просмотр недоступен">
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/></svg>
                                                </span>
                                            @endif
                                            <a href="#" 
                                               class="text-yellow-700 hover:text-yellow-900" 
                                               title="Редактировать">
                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 20h9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M16.5 3.5a2.121 2.121 0 113 3L7 19l-4 1 1-4 12.5-12.5z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            </a>
                                            <button class="text-green-700 hover:text-green-900" 
                                                    title="Назначить исполнителя">
                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8 11a4 4 0 100-8 4 4 0 000 8z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M20 8v6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M23 11h-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                                            </button>
                </div>
                                    </td>
                                </tr>
            @endforeach
        @else
                            <tr>
                                <td colspan="9" class="px-6 py-12 text-center">
                                    <div class="text-text-secondary">
                                        <svg class="mx-auto mb-4" width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 3c-3.866 0-7 3.134-7 7v3.5L3 16v1h18v-1l-2-2.5V10c0-3.866-3.134-7-7-7z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 19a3 3 0 006 0" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <p class="text-lg font-medium">Услуги не найдены</p>
                                        <p class="mt-1">Попробуйте изменить параметры фильтрации</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    @if(isset($serviceJournalList) && $serviceJournalList->hasPages())
        <div class="flex items-center justify-between border-t border-border-light bg-white px-4 py-3 sm:px-6">
            <div class="flex flex-1 justify-between sm:hidden">
                @if($serviceJournalList->onFirstPage())
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-text-secondary bg-white border border-border-light cursor-default rounded-md">
                        Предыдущая
                    </span>
                @else
                    <a href="{{ $serviceJournalList->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-text-primary bg-white border border-border-light rounded-md hover:bg-neutral-50">
                        Предыдущая
                    </a>
                @endif

                @if($serviceJournalList->hasMorePages())
                    <a href="{{ $serviceJournalList->nextPageUrl() }}" class="relative ml-3 inline-flex items-center px-4 py-2 text-sm font-medium text-text-primary bg-white border border-border-light rounded-md hover:bg-neutral-50">
                        Следующая
                    </a>
                @else
                    <span class="relative ml-3 inline-flex items-center px-4 py-2 text-sm font-medium text-text-secondary bg-white border border-border-light cursor-default rounded-md">
                        Следующая
                    </span>
                @endif
            </div>
            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-text-secondary">
                        Показано
                        <span class="font-medium">{{ $serviceJournalList->firstItem() }}</span>
                        по
                        <span class="font-medium">{{ $serviceJournalList->lastItem() }}</span>
                        из
                        <span class="font-medium">{{ $serviceJournalList->total() }}</span>
                        результатов
                    </p>
                </div>
                <div>
                    {{ $serviceJournalList->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@section('js')
    <script>
function servicesManager() {
    return {
        filters: {
            search: '',
            executor: '',
            payment_status: '',
            date_range: ''
        },

        init() {
            // Инициализация
        },

        applyFilters() {
            // В реальном приложении здесь будет AJAX запрос
            console.log('Applying filters:', this.filters);
        },

        resetFilters() {
            this.filters = {
                search: '',
                executor: '',
                payment_status: '',
                date_range: ''
            };
            this.applyFilters();
        }
    };
}
    </script>
@endsection