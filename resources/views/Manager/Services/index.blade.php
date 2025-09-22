@extends('layouts.figma-app')

@section('content')
<div class="w-full">
    <div class="flex items-center justify-between px-5 py-3" style="padding-left:20px;padding-right:20px;">
        <h1 class="text-[32px] md:text-[39px] leading-[1] font-normal tracking-[-0.02em] text-text-primary">Услуги</h1>
        <div class="hidden md:flex items-center gap-[11px] px-[16px] pr-[22px] py-[11px] h-[46px] border border-border-light rounded-[60px] bg-white">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.8333 15.8333L13.2083 13.2083" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <input type="text" placeholder="Поиск по номеру услуги или компании" class="bg-transparent border-none outline-none text-[12px] font-medium leading-[1] text-text-primary placeholder:text-text-primary" />
        </div>
    </div>
    
    <!-- Mobile Search -->
    <div class="md:hidden mb-3 px-5" style="padding-left:20px;padding-right:20px;">
        <div class="flex justify-end">
            <div class="flex items-center justify-center w-[46px] h-[46px] border border-border-light rounded-[60px] bg-white">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.8333 15.8333L13.2083 13.2083" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
        </div>
    </div>

    <div class="px-5" style="padding-left:20px;padding-right:20px;">
        <div class="flex items-center gap-[10px] mb-[16px] md:flex-wrap overflow-x-auto md:overflow-x-visible">
            @php $active = request('status_id'); @endphp
            <a href="{{ route('manager.services.list') }}" class="px-[14px] py-[10px] rounded-[60px] text-[12px] font-medium flex-shrink-0 {{ !$active ? 'bg-[#279760] text-white' : 'bg-white text-text-primary border border-border-light' }}">Все услуги</a>
            @if(isset($statusList))
                @foreach($statusList as $status)
                    <a href="{{ route('manager.services.list', ['status_id' => $status->id]) }}" class="px-[14px] py-[10px] rounded-[60px] text-[12px] font-medium flex-shrink-0 {{ $active == $status->id ? 'bg-[#279760] text-white' : 'bg-white text-text-primary border border-border-light' }}">{{ $status->name }}</a>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Services List -->
    <div class="mb-6">
        <!-- Desktop Headers -->
        <div class="hidden md:grid grid-cols-[200px,150px,200px,200px,200px,150px,150px,150px] gap-[60px,120px,60px,60px,60px,60px,60px,0px] items-center bg-white mx-5 px-5 py-3 rounded-t-lg">
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Номер услуги</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Статус</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Дата обращения</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Исполнитель</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Клиент</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Проверка клиента</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Предоплата</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider text-right pr-5">Полная оплата</div>
        </div>

        @if(isset($serviceJournalList) && $serviceJournalList->isNotEmpty())
            @foreach($serviceJournalList as $service)
                <!-- Desktop Card View -->
                <div class="hidden md:grid grid-cols-[200px,150px,200px,200px,200px,150px,150px,150px] gap-[60px,120px,60px,60px,60px,60px,60px,0px] items-center bg-white rounded-lg shadow-sm mx-5 mb-3 p-5">
                    <!-- Service Number -->
                    <div class="flex items-center gap-[10px]">
                        <span class="text-sm font-medium text-[#1E2B28] leading-[1]">УСЛ-{{ $service->id }}</span>
                                            </div>
                    
                    <!-- Status -->
                    <div class="flex items-center gap-[6px]">
                        @php
                            $statusName = $service->projectStatus->name ?? 'Неизвестен';
                            $statusClass = 'bg-gray-100 text-gray-800';
                            
                            if (str_contains(strtolower($statusName), 'завершен') || str_contains(strtolower($statusName), 'выполнен') || str_contains(strtolower($statusName), 'выполнено')) {
                                $statusClass = 'bg-green-100 text-green-800';
                            } elseif (str_contains(strtolower($statusName), 'ожидает') || str_contains(strtolower($statusName), 'процесс') || str_contains(strtolower($statusName), 'работе')) {
                                $statusClass = 'bg-yellow-100 text-yellow-800';
                            } elseif (str_contains(strtolower($statusName), 'новый')) {
                                $statusClass = 'bg-blue-100 text-blue-800';
                            } elseif (str_contains(strtolower($statusName), 'отменен')) {
                                $statusClass = 'bg-red-100 text-red-800';
                            }
                        @endphp
                        <div class="w-2 h-2 rounded-full {{ $statusClass }}"></div>
                        <span class="text-[13px] font-medium text-[#1E2B28] leading-[1]">{{ $statusName }}</span>
                    </div>
                    
                    <!-- Date -->
                    <div class="flex items-center gap-[10px]">
                        <span class="text-[13px] font-medium text-[#1E2B28] leading-[1]">
                            {{ $service->created_at ? $service->created_at->format('d.m.Y') : 'N/A' }}
                                        </span>
                                            </div>
                    
                    <!-- Executor -->
                    <div class="flex items-center gap-[10px]">
                        @if($service->executor)
                            <div class="w-[26px] h-[26px] rounded-full bg-neutral-300 overflow-hidden">
                                                    @if($service->executor->profile->photo_id)
                                                        <img src="/storage_/{{ $service->executor->profile->photo_path }}" 
                                                             alt="Executor" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-neutral-200 flex items-center justify-center">
                                        <svg class="h-3 w-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <span class="text-[13px] font-medium text-[#1E2B28] leading-[1]">
                                {{ $service->executor->profile->first_name }} {{ $service->executor->profile->last_name }}
                            </span>
                                                    @else
                            <div class="w-[26px] h-[26px] rounded-full bg-neutral-300 overflow-hidden">
                                <div class="w-full h-full bg-neutral-200 flex items-center justify-center">
                                    <svg class="h-3 w-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                                        </div>
                            <span class="text-[13px] font-medium text-[#1E2B28] leading-[1]">Не назначен</span>
                        @endif
                    </div>
                    
                    <!-- Client -->
                    <div class="flex items-center gap-[10px]">
                        @php
                            $clientName = '';
                            if (isset($service->client)) {
                                $profile = $service->client->profile ?? null;
                                if ($profile) {
                                    $clientName = $profile->user_name
                                        ?: trim(($profile->first_name ?? '') . ' ' . ($profile->last_name ?? ''));
                                }
                                if (!$clientName) {
                                    $clientName = $service->client->user_name
                                        ?? ($service->client->email ?? '');
                                }
                            }
                        @endphp
                        <span class="text-[13px] font-medium text-[#1E2B28] leading-[1]">{{ $clientName !== '' ? $clientName : 'Не указан' }}</span>
                    </div>
                    
                    <!-- Client Verification -->
                    <div class="flex items-center gap-[6px]">
                        @if($service->client_verification_status)
                            <div class="w-2 h-2 rounded-full bg-green-100"></div>
                            <span class="text-[13px] font-medium text-green-800 leading-[1]">Проверен</span>
                                        @else
                            <div class="w-2 h-2 rounded-full bg-yellow-100"></div>
                            <span class="text-[13px] font-medium text-yellow-800 leading-[1]">Требует проверки</span>
                                        @endif
                                            </div>
                    
                    <!-- Prepayment -->
                    <div class="flex items-center gap-[6px]">
                        @if($service->prepayment_status)
                            <div class="w-2 h-2 rounded-full bg-green-100"></div>
                            <span class="text-[13px] font-medium text-green-800 leading-[1]">Оплачено</span>
                                        @else
                            <div class="w-2 h-2 rounded-full bg-yellow-100"></div>
                            <span class="text-[13px] font-medium text-yellow-800 leading-[1]">Ожидается</span>
                                        @endif
                    </div>
                    
                    <!-- Full Payment -->
                    <div class="flex items-center justify-end gap-[6px] pr-5">
                        @if($service->full_payment_status)
                            <div class="w-2 h-2 rounded-full bg-green-100"></div>
                            <span class="text-[13px] font-medium text-green-800 leading-[1]">Оплачено</span>
                        @else
                            <div class="w-2 h-2 rounded-full bg-red-100"></div>
                            <span class="text-[13px] font-medium text-red-800 leading-[1]">Не оплачено</span>
                        @endif
                    </div>
                </div>
                
                <!-- Mobile Card View -->
                <div class="md:hidden bg-white rounded-lg shadow-sm mx-4 mb-3 p-4">
                    <!-- Header with service number and status -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-[10px]">
                            <span class="text-base font-medium text-[#1E2B28] leading-[1]">УСЛ-{{ $service->id }}</span>
                        </div>
                        <div class="flex items-center gap-[6px] flex-shrink-0">
                        @php
                            $statusName = $service->projectStatus->name ?? 'Неизвестен';
                            $statusClass = 'bg-gray-100 text-gray-800';
                            
                            if (str_contains(strtolower($statusName), 'завершен') || str_contains(strtolower($statusName), 'выполнен') || str_contains(strtolower($statusName), 'выполнено')) {
                                $statusClass = 'bg-green-100 text-green-800';
                            } elseif (str_contains(strtolower($statusName), 'ожидает') || str_contains(strtolower($statusName), 'процесс') || str_contains(strtolower($statusName), 'работе')) {
                                $statusClass = 'bg-yellow-100 text-yellow-800';
                            } elseif (str_contains(strtolower($statusName), 'новый')) {
                                $statusClass = 'bg-blue-100 text-blue-800';
                            } elseif (str_contains(strtolower($statusName), 'отменен')) {
                                $statusClass = 'bg-red-100 text-red-800';
                            }
                        @endphp
                            <div class="w-2 h-2 rounded-full {{ $statusClass }}"></div>
                            <span class="text-sm font-medium text-[#1E2B28] leading-[1]">{{ $statusName }}</span>
                        </div>
                    </div>
                    
                    <!-- Details - Vertical Layout -->
                    <div class="space-y-2">
                        <div class="flex flex-col">
                            <span class="text-xs font-medium text-gray-500 mb-1">Дата</span>
                            <span class="text-sm font-medium text-[#1E2B28]">
                                {{ $service->created_at ? $service->created_at->format('d.m.Y') : 'N/A' }}
                            </span>
                                            </div>
                        <div class="flex flex-col">
                            <span class="text-xs font-medium text-gray-500 mb-1">Исполнитель</span>
                            <div class="flex items-center gap-[10px]">
                                @if($service->executor)
                                    <div class="w-[32px] h-[32px] rounded-full bg-neutral-300 overflow-hidden flex-shrink-0">
                                        @if($service->executor->profile->photo_id)
                                            <img src="/storage_/{{ $service->executor->profile->photo_path }}" 
                                                 alt="Executor" 
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-neutral-200 flex items-center justify-center">
                                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <span class="text-sm font-medium text-[#1E2B28]">
                                        {{ $service->executor->profile->first_name }} {{ $service->executor->profile->last_name }}
                                    </span>
                                @else
                                    <div class="w-[32px] h-[32px] rounded-full bg-neutral-300 overflow-hidden flex-shrink-0">
                                        <div class="w-full h-full bg-neutral-200 flex items-center justify-center">
                                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <span class="text-sm font-medium text-[#1E2B28]">Не назначен</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs font-medium text-gray-500 mb-1">Клиент</span>
                            @php
                                $clientName = '';
                                if (isset($service->client)) {
                                    $profile = $service->client->profile ?? null;
                                    if ($profile) {
                                        $clientName = $profile->user_name
                                            ?: trim(($profile->first_name ?? '') . ' ' . ($profile->last_name ?? ''));
                                    }
                                    if (!$clientName) {
                                        $clientName = $service->client->user_name
                                            ?? ($service->client->email ?? '');
                                    }
                                }
                            @endphp
                            <span class="text-sm font-medium text-[#1E2B28]">{{ $clientName !== '' ? $clientName : 'Не указан' }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs font-medium text-gray-500 mb-1">Проверка клиента</span>
                            <div class="flex items-center gap-[6px]">
                                @if($service->client_verification_status)
                                    <div class="w-2 h-2 rounded-full bg-green-100"></div>
                                    <span class="text-sm font-medium text-green-800">Проверен</span>
                                        @else
                                    <div class="w-2 h-2 rounded-full bg-yellow-100"></div>
                                    <span class="text-sm font-medium text-yellow-800">Требует проверки</span>
                                @endif
                            </div>
                                            </div>
                        <div class="flex flex-col">
                            <span class="text-xs font-medium text-gray-500 mb-1">Предоплата</span>
                            <div class="flex items-center gap-[6px]">
                                @if($service->prepayment_status)
                                    <div class="w-2 h-2 rounded-full bg-green-100"></div>
                                    <span class="text-sm font-medium text-green-800">Оплачено</span>
                                @else
                                    <div class="w-2 h-2 rounded-full bg-yellow-100"></div>
                                    <span class="text-sm font-medium text-yellow-800">Ожидается</span>
                                        @endif
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs font-medium text-gray-500 mb-1">Полная оплата</span>
                            <div class="flex items-center gap-[6px]">
                                @if($service->full_payment_status)
                                    <div class="w-2 h-2 rounded-full bg-green-100"></div>
                                    <span class="text-sm font-medium text-green-800">Оплачено</span>
                                            @else
                                    <div class="w-2 h-2 rounded-full bg-red-100"></div>
                                    <span class="text-sm font-medium text-red-800">Не оплачено</span>
                                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center py-12">
                                    <div class="text-text-secondary">
                                        <svg class="mx-auto mb-4" width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 3c-3.866 0-7 3.134-7 7v3.5L3 16v1h18v-1l-2-2.5V10c0-3.866-3.134-7-7-7z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 19a3 3 0 006 0" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <p class="text-lg font-medium">Услуги не найдены</p>
                                        <p class="mt-1">Попробуйте изменить параметры фильтрации</p>
                                    </div>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    @if(isset($serviceJournalList) && $serviceJournalList->hasPages())
        <div class="flex justify-center items-center mt-8">
            <div class="flex items-center space-x-2">
                @php
                    $currentPage = $serviceJournalList->currentPage();
                    $lastPage = $serviceJournalList->lastPage();
                    $startPage = max(1, $currentPage - 2);
                    $endPage = min($lastPage, $currentPage + 2);
                @endphp
                
                @for($i = $startPage; $i <= $endPage; $i++)
                    <button class="w-8 h-8 rounded-full text-sm font-medium {{ $i === $currentPage ? 'bg-[#279760] text-white' : 'bg-white text-text-primary border border-border-light hover:bg-bg-tertiary' }} transition-colors">
                        {{ $i }}
                    </button>
                @endfor
            </div>
        </div>
    @endif
</div>
@endsection
