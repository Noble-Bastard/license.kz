@extends('layouts.figma-sales')

@section('content')
<div class="min-h-screen bg-white">
    <!-- Header -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Desktop Layout -->
            <div class="hidden lg:flex items-end justify-between" style="min-height: 140px; padding: 30px 0;">
                <div class="flex flex-col" style="margin-left: -80px;">
                    <a href="{{ route('sale_manager.service.list') }}" class="flex items-center gap-2 mb-3 text-gray-600 hover:text-gray-900 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        <span class="text-xs font-medium">Услуги</span>
                    </a>
                    <h1 class="font-semibold text-gray-900" style="font-size: 40px;">УСЛ-{{ $serviceJournal->id }}</h1>
                </div>
                <div class="flex items-start space-x-4" style="margin-right: -65px;">
                    <button class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-full hover:bg-green-700 transition-colors">
                        Отправить на проверку
                    </button>
                </div>
            </div>
            
            <!-- Mobile Layout -->
            <div class="lg:hidden py-6">
                <a href="{{ route('sale_manager.service.list') }}" class="flex items-center gap-2 mb-3 text-gray-600 hover:text-gray-900 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <span class="text-xs font-medium">Услуги</span>
                </a>
                <h1 class="font-semibold text-gray-900 mb-4" style="font-size: 32px;">УСЛ-{{ $serviceJournal->id }}</h1>
                <div class="flex justify-center">
                    <button class="w-full px-6 py-3 bg-green-600 text-white text-base font-medium rounded-full hover:bg-green-700 transition-colors">
                        Отправить на проверку
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row min-h-screen">
        <!-- Vertical Divider Line (desktop only) -->
        <div class="py-6 px-4 w-full lg:w-1/3 lg:relative">
            <div class="hidden lg:block" style="position: absolute; top: 0; right: 24px; bottom: 0; width: 1px; background-color: rgb(229, 231, 235);"></div>
            
            <!-- Left Panel - Service Progress -->
            <div style="padding-left: 0; padding-right: 48px;">
                <div>
                    <div class="space-y-0">
                        @if(isset($serviceJournalStepList) && $serviceJournalStepList->isNotEmpty())
                            @foreach($serviceJournalStepList as $index => $step)
                                <div class="relative" style="margin-bottom: var(--spacing-4); position: relative;">
                                    <div class="flex items-start gap-3">
                                        <div class="flex-shrink-0" style="color: var(--color-text-muted); position: relative;">
                                            @if($step->is_completed == 1 || $step->is_completed === true)
                                                <!-- Выполнен - галочка -->
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            @elseif($step->execution_start_date && $step->execution_start_date != null)
                                                <!-- В процессе - часы -->
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                                                    <path d="M12 6V12L16 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            @else
                                                <!-- Не начат - пустой круг -->
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                                                </svg>
                                            @endif
                                        </div>
                                        
                                        <p style="color: var(--color-text-primary); font-family: var(--font-family-sans); font-weight: var(--font-weight-medium); font-size: var(--font-size-sm); line-height: var(--line-height-normal); flex: 1;">
                                            {{ $step->serviceStep->description ?? 'Шаг ' . $step->service_step_no }}
                                        </p>
                                    </div>
                                    @if($index < count($serviceJournalStepList) - 1)
                                        <div style="position: absolute; top: 20px; left: 7px; width: 2px; height: calc(100% - 12px); background-color: var(--color-border-medium);"></div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-4">
                                <p class="text-sm text-gray-500">Шаги не найдены</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel - Tasks -->
        <div class="py-6 px-3 lg:px-4 w-full lg:flex-1">
                <div>
                    <div class="px-0 py-0 mb-4 hidden lg:block">
                        <h2 class="text-2xl font-semibold text-gray-900">Задачи</h2>
                    </div>
                    
                    <div class="p-0 lg:p-6">
                        <div class="space-y-4">
                            @if(isset($serviceJournalStepList) && $serviceJournalStepList->isNotEmpty())
                                @foreach($serviceJournalStepList as $step)
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <!-- Task Header -->
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="flex-1">
                                                <h3 class="text-sm font-medium text-gray-900 mb-2">
                                                    {{ $step->serviceStep->description ?? 'Задача ' . $step->service_step_no }}
                                                </h3>
                                                
                                                @php
                                                    $taskStatusColor = $step->is_completed ? 'bg-green-500' : 'bg-yellow-500';
                                                    $taskStatusText = $step->is_completed ? 'Выполнено' : 'В работе';
                                                @endphp
                                                
                                                <div class="flex items-center gap-2 mb-3">
                                                    <div class="flex items-center gap-2">
                                                        <div class="w-2 h-2 rounded-full {{ $taskStatusColor }}"></div>
                                                        <span class="text-xs text-gray-700">{{ $taskStatusText }}</span>
                                                    </div>
                                                    <div class="flex items-center gap-1">
                                                        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                        <span class="text-xs text-gray-500">
                                                            {{ $step->execution_time_plan ?? '1 день' }}
                                                        </span>
                                                    </div>
                                                </div>
                                                
                                                <!-- Manager and Executor (mobile only - below status) -->
                                                <div class="lg:hidden flex gap-4 mb-3">
                                                    <div class="flex-1">
                                                        <div class="text-xs text-gray-500 mb-2">Менеджер</div>
                                                        <div class="flex items-center mb-1">
                                                            <div class="w-6 h-6 rounded-full bg-gray-300 flex-shrink-0 flex items-center justify-center">
                                                                @if($serviceJournal->manager->photo_id ?? false)
                                                                    <img src="/storage_/{{ $serviceJournal->manager->photo_path }}" 
                                                                         alt="Manager" 
                                                                         class="w-full h-full object-cover rounded-full">
                                                                @else
                                                                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                                    </svg>
                                                                @endif
                                                            </div>
                                                            <div class="text-xs font-medium text-gray-900 ml-2">
                                                                {{ $serviceJournal->manager->first_name ?? '' }} {{ $serviceJournal->manager->last_name ?? '' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="flex-1">
                                                        <div class="text-xs text-gray-500 mb-2">Исполнитель</div>
                                                        <div class="flex items-center mb-1">
                                                            <div class="w-6 h-6 rounded-full bg-gray-300 flex-shrink-0 flex items-center justify-center">
                                                                @if($executor && ($executor->photo_id ?? false))
                                                                    <img src="/storage_/{{ $executor->photo_path }}" 
                                                                         alt="Executor" 
                                                                         class="w-full h-full object-cover rounded-full">
                                                                @else
                                                                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                                    </svg>
                                                                @endif
                                                            </div>
                                                            <div class="text-xs font-medium text-gray-900 ml-2">
                                                                {{ $executor->first_name ?? '' }} {{ $executor->last_name ?? 'Не назначен' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Documents Section -->
                                                <div>
                                                    <h4 class="text-sm font-medium text-gray-700 mb-2">Документы</h4>
                                                    <div class="grid grid-cols-3 md:grid-cols-4 gap-3">
                                                        @if(isset($documents) && $documents->isNotEmpty())
                                                            @foreach($documents as $document)
                                                                <div class="flex items-center space-x-2 p-2 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                                                    <div class="w-8 h-8 bg-green-100 rounded flex items-center justify-center">
                                                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                                        </svg>
                                                                    </div>
                                                                    <div class="flex-1 min-w-0">
                                                                        <p class="text-xs font-medium text-gray-900 truncate">{{ $document->document->name ?? 'Документ' }}</p>
                                                                        <p class="text-xs text-gray-500">
                                                                            @php
                                                                                $extension = pathinfo($document->document->name ?? '', PATHINFO_EXTENSION);
                                                                                echo $extension ?: 'doc';
                                                                            @endphp
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                        
                                                        <!-- Add Document Button -->
                                                        <div class="flex flex-col items-center cursor-pointer">
                                                            <div class="w-full aspect-square flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg hover:border-green-500 transition-colors">
                                                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                                </svg>
                                                            </div>
                                                            <p class="text-xs text-gray-500 mt-2 text-center">Добавить документ</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Manager and Executor on the right (desktop) / below status (mobile) -->
                                            <div class="hidden lg:flex flex-col gap-3 ml-6">
                                                <div class="text-center">
                                                    <div class="text-xs text-gray-500 mb-2">Менеджер</div>
                                                    <div class="flex items-center justify-center mb-1">
                                                        <div class="w-6 h-6 rounded-full bg-gray-300 flex-shrink-0 flex items-center justify-center">
                                                            @if($serviceJournal->manager->photo_id ?? false)
                                                                <img src="/storage_/{{ $serviceJournal->manager->photo_path }}" 
                                                                     alt="Manager" 
                                                                     class="w-full h-full object-cover rounded-full">
                                                            @else
                                                                <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                                </svg>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="text-xs font-medium text-gray-900">
                                                        {{ $serviceJournal->manager->first_name ?? '' }} {{ $serviceJournal->manager->last_name ?? '' }}
                                                    </div>
                                                </div>
                                                
                                                <div class="text-center">
                                                    <div class="text-xs text-gray-500 mb-2">Исполнитель</div>
                                                    <div class="flex items-center justify-center mb-1">
                                                        <div class="w-6 h-6 rounded-full bg-gray-300 flex-shrink-0 flex items-center justify-center">
                                                            @if($executor && ($executor->photo_id ?? false))
                                                                <img src="/storage_/{{ $executor->photo_path }}" 
                                                                     alt="Executor" 
                                                                     class="w-full h-full object-cover rounded-full">
                                                            @else
                                                                <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                                </svg>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="text-xs font-medium text-gray-900">
                                                        {{ $executor->first_name ?? '' }} {{ $executor->last_name ?? 'Не назначен' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Comments Section -->
                                        <div class="mb-4">
                                            <div class="flex items-center gap-2 mb-2">
                                                <h4 class="text-sm font-medium text-gray-700">Комментарии</h4>
                                                <button class="text-xs text-gray-500 hover:text-gray-700">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            
                                            @if(isset($messages) && $messages->isNotEmpty())
                                                <div class="space-y-2">
                                                    @foreach($messages->take(3) as $message)
                                                        <div class="flex items-start space-x-2">
                                                            <div class="w-6 h-6 rounded-full bg-gray-300 flex-shrink-0 flex items-center justify-center">
                                                                @if($message->createdBy->profile->photo_id ?? false)
                                                                    <img src="/storage_/{{ $message->createdBy->profile->photo_path }}" 
                                                                         alt="User" 
                                                                         class="w-full h-full object-cover rounded-full">
                                                                @else
                                                                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                                    </svg>
                                                                @endif
                                                            </div>
                                                            <div class="flex-1">
                                                                <div class="flex items-center space-x-2 mb-1">
                                                                    <span class="text-xs font-medium text-gray-900">
                                                                        {{ $message->createdBy->profile->first_name ?? '' }} {{ $message->createdBy->profile->last_name ?? '' }}
                                                                    </span>
                                                                    <span class="text-xs text-gray-500">
                                                                        {{ \Carbon\Carbon::parse($message->create_date)->format('d.m.Y H:i') }}
                                                                    </span>
                                                                </div>
                                                                <p class="text-xs text-gray-700">{{ $message->message->message ?? '' }}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="text-center py-2">
                                                    <p class="text-xs text-gray-500">Комментарии отсутствуют</p>
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-8">
                                    <p class="text-sm text-gray-500">Задачи не найдены</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
