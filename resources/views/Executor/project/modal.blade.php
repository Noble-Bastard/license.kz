@extends('layouts.figma-executor')

@section('content')
<div class="fixed inset-0 z-50 flex items-center justify-center" style="background: rgba(0,0,0,0.4);">
    <div class="bg-white w-[800px] h-[700px] mx-4 flex flex-col">
        <!-- Modal Header -->
        <div class="flex items-center justify-between px-8 py-6">
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <h1 class="text-[18px] leading-[1] font-semibold text-text-primary">УСЛ-{{ $serviceJournal->id }}</h1>
                    @php
                        $statusName = $serviceJournal->projectStatus->name ?? 'Не указано';
                        $statusColor = '#6F6F6F';
                        
                        if (str_contains(strtolower($statusName), 'завершен') || str_contains(strtolower($statusName), 'выполнен') || str_contains(strtolower($statusName), 'выполнено')) {
                            $statusColor = '#279760';
                        } elseif (str_contains(strtolower($statusName), 'ожидает') || str_contains(strtolower($statusName), 'процесс') || str_contains(strtolower($statusName), 'работе')) {
                            $statusColor = '#F59E0B';
                        } elseif (str_contains(strtolower($statusName), 'новый')) {
                            $statusColor = '#3B82F6';
                        } elseif (str_contains(strtolower($statusName), 'отменен')) {
                            $statusColor = '#EF4444';
                        }
                    @endphp
                    <div class="flex items-center gap-[6px]">
                        <div class="w-2 h-2 rounded-full" style="background-color: {{ $statusColor }};"></div>
                        <span class="text-[13px] font-medium leading-[1] text-text-primary">{{ $statusName }}</span>
                    </div>
                </div>
                <p class="text-[12px] text-text-muted">Создана {{ $serviceJournal->created_at ? $serviceJournal->created_at->format('d.m.Y') : 'N/A' }}</p>
        </div>
        
            <button onclick="closeExecutorModal()" class="flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-100 transition-colors">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 5L5 15" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M5 5L15 15" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="px-8 py-2 flex-1 flex flex-col">
        
        <!-- Header with New Task Button -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-[16px] font-semibold text-text-primary">Задачи и сообщения</h2>
            <button class="flex items-center gap-2 px-4 py-2 bg-[#279760] text-white text-[14px] font-medium rounded-full hover:bg-[#1e7a4f] transition-colors">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 3.33333V12.6667" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3.33333 8H12.6667" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Новая задача
            </button>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto">
        
        <!-- All Content in One Frame -->
        <div class="border border-border-light rounded-lg p-3">
        
        <!-- Service Information Card -->
        <div class="mb-3">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <!-- Service Name -->
                <div class="flex flex-col">
                    <span class="text-[14px] font-medium text-text-primary">
                        {{ $serviceJournal->service->name ?? 'Не указано' }}
                    </span>
            </div>
        </div>

        <!-- Service Steps with Documents -->
        <div class="space-y-4">
            @if(isset($serviceJournalStepList) && $serviceJournalStepList->isNotEmpty())
                @foreach($serviceJournalStepList as $step)
                    <div class="border border-border-light rounded-lg p-4">
                        <!-- Step Header -->
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-3">
                                @php
                                    $stepStatusColor = $step->is_completed ? '#279760' : '#F59E0B';
                                    $stepStatusText = $step->is_completed ? 'Выполнено' : 'В работе';
                                @endphp
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full" style="background-color: {{ $stepStatusColor }};"></div>
                                    <span class="text-[14px] font-medium text-text-primary">{{ $step->serviceStep->description ?? 'Шаг ' . $step->service_step_no }}</span>
                                </div>
                                <span class="text-[12px] text-text-muted">{{ $step->execution_time_plan ?? '1 день 3 часа' }}</span>
                            </div>
                            
                            @if(!$step->is_completed)
                                <button class="px-4 py-2 bg-[#279760] text-white text-[12px] font-medium rounded-full hover:bg-[#1e7a4f] transition-colors">
                                    Отправить на проверку
                                </button>
                            @endif
                        </div>

                        <!-- Step Documents -->
                        <div class="mb-4">
                            <h3 class="text-[13px] font-semibold text-text-primary mb-2">Документы</h3>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                @if(isset($step->documents) && $step->documents->isNotEmpty())
                                    @foreach($step->documents as $document)
                                        <div class="flex items-center gap-2 p-2 border border-border-light rounded-lg hover:shadow-md transition-shadow cursor-pointer">
                                            <div class="w-8 h-8 rounded bg-green-100 flex items-center justify-center flex-shrink-0">
                                                <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11.6667 1.66667H5C4.55797 1.66667 4.13405 1.84226 3.82149 2.15482C3.50893 2.46738 3.33333 2.89131 3.33333 3.33334V16.6667C3.33333 17.1087 3.50893 17.5326 3.82149 17.8452C4.13405 18.1577 4.55797 18.3333 5 18.3333H15C15.442 18.3333 15.866 18.1577 16.1785 17.8452C16.4911 17.5326 16.6667 17.1087 16.6667 16.6667V6.66667L11.6667 1.66667Z" stroke="#279760" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M11.6667 1.66667V6.66667H16.6667" stroke="#279760" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-[11px] font-medium text-text-primary truncate">{{ $document->name ?? 'Документ' }}</p>
                                                <p class="text-[10px] text-text-muted">xlsx</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                
                                <!-- Add Document Button -->
                                <div class="flex items-center justify-center p-2 border-2 border-dashed border-border-light rounded-lg hover:border-[#279760] transition-colors cursor-pointer">
                                    <div class="text-center">
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-1">
                                            <path d="M10 3.33333V16.6667" stroke="#6F6F6F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M3.33333 10H16.6667" stroke="#6F6F6F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <p class="text-[10px] text-text-muted">Добавить документ</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step Comments - пока отключено, так как нет привязки к шагам -->
                        <div>
                            <h3 class="text-[13px] font-semibold text-text-primary mb-2">Комментарии</h3>
                            <div class="space-y-2 mb-3">
                                <div class="text-center py-2">
                                    <p class="text-[11px] text-text-muted">Комментарии к шагам временно недоступны</p>
                                </div>
                            </div>
                            
                            <!-- Comment Input for this step - пока отключено -->
                            <div class="flex items-center gap-2">
                                <input 
                                    type="text" 
                                    placeholder="Сообщение (временно недоступно)" 
                                    class="flex-1 px-3 py-2 border border-border-light rounded-full text-[12px] focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                    disabled
                                />
                                <button 
                                    class="w-8 h-8 rounded-full bg-gray-300 cursor-not-allowed flex items-center justify-center"
                                    disabled
                                >
                                    <svg width="14" height="14" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.3333 1.66667L9.16667 10.8333" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M18.3333 1.66667L12.5 18.3333L9.16667 10.8333L1.66667 7.5L18.3333 1.66667Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-8 text-text-muted">
                    <p class="text-[14px]">Шаги не найдены</p>
                </div>
            @endif

            <!-- General Messages Section -->
            <div class="mt-6 border-t border-border-light pt-4">
                <h3 class="text-[14px] font-semibold text-text-primary mb-3">Общие сообщения</h3>
                
                <!-- Messages List -->
                <div class="space-y-3 mb-4 max-h-40 overflow-y-auto">
                    @if(isset($messages) && $messages->isNotEmpty())
                        @foreach($messages as $message)
                            <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                                <div class="w-8 h-8 rounded-full bg-neutral-300 overflow-hidden flex-shrink-0">
                                    @if($message->createdBy->profile->photo_id ?? false)
                                        <img src="/storage_/{{ $message->createdBy->profile->photo_path }}" 
                                             alt="User" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-neutral-200 flex items-center justify-center">
                                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-[12px] font-medium text-text-primary">
                                            {{ $message->createdBy->profile->first_name ?? '' }} {{ $message->createdBy->profile->last_name ?? '' }}
                                        </span>
                                        <span class="text-[11px] text-text-muted">{{ \Carbon\Carbon::parse($message->create_date)->format('d.m.Y H:i') }}</span>
                                    </div>
                                    <p class="text-[12px] text-text-secondary">{{ $message->message->message ?? '' }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <p class="text-[12px] text-text-muted">Сообщения отсутствуют</p>
                        </div>
                    @endif
                </div>
                
                <!-- Message Input -->
                <div class="flex items-center gap-3">
                    <input 
                        type="text" 
                        placeholder="Написать сообщение..." 
                        class="flex-1 px-4 py-3 border border-border-light rounded-full text-[14px] focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                        id="message-input"
                    />
                    <button 
                        class="w-10 h-10 rounded-full bg-primary hover:bg-primary-dark transition-colors flex items-center justify-center"
                        id="send-message-btn"
                    >
                        <svg width="18" height="18" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.3333 1.66667L9.16667 10.8333" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M18.3333 1.66667L12.5 18.3333L9.16667 10.8333L1.66667 7.5L18.3333 1.66667Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
