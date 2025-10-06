@extends('layouts.figma-sales')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-semibold text-gray-900">УСЛ-{{ $serviceJournal->id }}</h1>
                    @php
                        $statusColor = 'bg-gray-100 text-gray-800';
                        $statusName = $serviceJournal->serviceStatus->name ?? 'Не указано';
                        
                        if (str_contains(strtolower($statusName), 'завершен') || str_contains(strtolower($statusName), 'выполнен')) {
                            $statusColor = 'bg-green-100 text-green-800';
                        } elseif (str_contains(strtolower($statusName), 'ожидает') || str_contains(strtolower($statusName), 'процесс')) {
                            $statusColor = 'bg-yellow-100 text-yellow-800';
                        } elseif (str_contains(strtolower($statusName), 'новый')) {
                            $statusColor = 'bg-blue-100 text-blue-800';
                        } elseif (str_contains(strtolower($statusName), 'отменен')) {
                            $statusColor = 'bg-red-100 text-red-800';
                        }
                    @endphp
                    <span class="ml-4 px-3 py-1 text-sm font-medium rounded-full {{ $statusColor }}">
                        {{ $statusName }}
                    </span>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                        Отправить на проверку
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Left Panel - Service Progress -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Прогресс услуги</h2>
                    
                    <div class="space-y-4">
                        @if(isset($serviceJournalStepList) && $serviceJournalStepList->isNotEmpty())
                            @foreach($serviceJournalStepList as $index => $step)
                                <div class="flex items-center space-x-3">
                                    @php
                                        $stepStatusColor = $step->is_completed ? 'bg-green-500' : ($index === 0 ? 'bg-yellow-500' : 'bg-gray-300');
                                        $stepStatusIcon = $step->is_completed ? '✓' : ($index === 0 ? '⏱' : '○');
                                    @endphp
                                    
                                    <div class="flex-shrink-0">
                                        <div class="w-8 h-8 rounded-full {{ $stepStatusColor }} flex items-center justify-center text-white text-sm font-medium">
                                            {{ $stepStatusIcon }}
                                        </div>
                                    </div>
                                    
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $step->serviceStep->description ?? 'Шаг ' . $step->service_step_no }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ $step->execution_time_plan ?? '1 день' }}
                                        </p>
                                    </div>
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

            <!-- Right Panel - Tasks -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-900">Задачи</h2>
                            <button class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                                Отправить на проверку
                            </button>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-6">
                            @if(isset($serviceJournalStepList) && $serviceJournalStepList->isNotEmpty())
                                @foreach($serviceJournalStepList as $step)
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <!-- Task Header -->
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex items-center space-x-3">
                                                @php
                                                    $taskStatusColor = $step->is_completed ? 'bg-green-500' : 'bg-yellow-500';
                                                    $taskStatusText = $step->is_completed ? 'Выполнено' : 'В работе';
                                                @endphp
                                                
                                                <div class="w-3 h-3 rounded-full {{ $taskStatusColor }}"></div>
                                                <h3 class="text-sm font-medium text-gray-900">
                                                    {{ $step->serviceStep->description ?? 'Задача ' . $step->service_step_no }}
                                                </h3>
                                                <span class="text-xs text-gray-500">
                                                    {{ $step->execution_time_plan ?? '1 день' }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Documents Section -->
                                        <div class="mb-4">
                                            <h4 class="text-sm font-medium text-gray-700 mb-2">Документы</h4>
                                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
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
                                                <div class="flex items-center justify-center p-2 border-2 border-dashed border-gray-300 rounded-lg hover:border-green-500 cursor-pointer">
                                                    <div class="text-center">
                                                        <svg class="w-6 h-6 text-gray-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                        </svg>
                                                        <p class="text-xs text-gray-500">Добавить документ</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Comments Section -->
                                        <div class="mb-4">
                                            <div class="flex items-center justify-between mb-2">
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

                                        <!-- Assigned Personnel -->
                                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                            <div class="flex items-center space-x-4">
                                                <div class="flex items-center space-x-2">
                                                    <span class="text-xs text-gray-500">Менеджер:</span>
                                                    <div class="flex items-center space-x-1">
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
                                                        <span class="text-xs font-medium text-gray-900">
                                                            {{ $serviceJournal->manager->first_name ?? '' }} {{ $serviceJournal->manager->last_name ?? '' }}
                                                        </span>
                                                    </div>
                                                </div>
                                                
                                                <div class="flex items-center space-x-2">
                                                    <span class="text-xs text-gray-500">Исполнитель:</span>
                                                    <div class="flex items-center space-x-1">
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
                                                        <span class="text-xs font-medium text-gray-900">
                                                            {{ $executor->first_name ?? '' }} {{ $executor->last_name ?? 'Не назначен' }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
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
</div>
@endsection
