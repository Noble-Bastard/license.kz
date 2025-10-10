@extends('layouts.figma-app')

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
        
            <button onclick="closeServiceModal()" class="close-modal-btn flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-100 transition-colors">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 5L5 15" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M5 5L15 15" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="px-8 py-2 flex-1 flex flex-col">
        
        <!-- Tabs and New Task Button -->
        <div class="flex items-center justify-between mb-2">
            <div class="flex items-center gap-1">
                <button class="px-4 py-2 text-[14px] font-medium bg-gray-200 text-text-primary rounded-full transition-colors" id="tasks-tab">
                    Задачи
                </button>
                <button class="px-4 py-2 text-[14px] font-medium text-text-muted hover:text-text-primary transition-colors rounded-full" id="messages-tab">
                    Сообщения с клиентом
                </button>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex items-center gap-2">
                @php
                    // Определяем условие показа специальных кнопок
                    // Показываем только для услуг с назначенным менеджером и определёнными статусами
                    $showSpecialButtons = $serviceJournal->manager_id != null
                                        && in_array($serviceJournal->service_status_id, [3, 4, 5, 8, 9]); // DataCollection, Check, Execution, Prepayment, ClientCheck
                @endphp

                @if($showSpecialButtons)
                <!-- Return to Client Button -->
                <button onclick="returnToClient({{ $serviceJournal->id }})"
                        class="flex items-center gap-2 px-3 py-2 bg-orange-500 text-white text-[12px] font-medium rounded-full hover:bg-orange-600 transition-colors">
                    <svg width="14" height="14" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 4L4 10L10 16" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16 4L10 10L16 16" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Вернуть клиенту
                </button>

                <!-- View Client Documents Button -->
                <a href="{{ route('manager.serviceJournal.show', $serviceJournal->id) }}"
                   target="_blank"
                   class="flex items-center gap-2 px-3 py-2 bg-blue-500 text-white text-[12px] font-medium rounded-full hover:bg-blue-600 transition-colors">
                    <svg width="14" height="14" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.6667 1.66667H5C4.55797 1.66667 4.13405 1.84226 3.82149 2.15482C3.50893 2.46738 3.33333 2.89131 3.33333 3.33334V16.6667C3.33333 17.1087 3.50893 17.5326 3.82149 17.8452C4.13405 18.1577 4.55797 18.3333 5 18.3333H15C15.442 18.3333 15.866 18.1577 16.1785 17.8452C16.4911 17.5326 16.6667 17.1087 16.6667 16.6667V6.66667L11.6667 1.66667Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M11.6667 1.66667V6.66667H16.6667" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Документы клиента
                </a>
                @endif

                <!-- New Task Button -->
                <button class="flex items-center gap-2 px-4 py-2 bg-[#279760] text-white text-[14px] font-medium rounded-full hover:bg-[#1e7a4f] transition-colors">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 3.33333V12.6667" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M3.33333 8H12.6667" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Новая задача
                </button>
            </div>
        </div>

        <!-- Tasks Tab Content -->
        <div id="tasks-content" class="flex-1 overflow-y-auto">
        
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

    <!-- Documents Section -->
        <div class="mb-6">
            <!-- Service Status and Executor -->
            <div class="mb-2 flex items-center justify-between">
                @php
                    $serviceStatusName = $serviceJournal->projectStatus->name ?? 'Не указано';
                    $serviceStatusColor = '#6F6F6F';
                    
                    if (str_contains(strtolower($serviceStatusName), 'завершен') || str_contains(strtolower($serviceStatusName), 'выполнен') || str_contains(strtolower($serviceStatusName), 'выполнено')) {
                        $serviceStatusColor = '#279760';
                    } elseif (str_contains(strtolower($serviceStatusName), 'ожидает') || str_contains(strtolower($serviceStatusName), 'процесс') || str_contains(strtolower($serviceStatusName), 'работе')) {
                        $serviceStatusColor = '#F59E0B';
                    } elseif (str_contains(strtolower($serviceStatusName), 'новый')) {
                        $serviceStatusColor = '#3B82F6';
                    } elseif (str_contains(strtolower($serviceStatusName), 'отменен')) {
                        $serviceStatusColor = '#EF4444';
                    }
                @endphp
                <!-- Status, Date, Time and Executor -->
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-[6px]">
                        <div class="w-2 h-2 rounded-full" style="background-color: {{ $serviceStatusColor }};"></div>
                        <span class="text-[13px] font-medium leading-[1] text-text-primary">{{ $serviceStatusName }}</span>
                    </div>
                    
                    <span class="text-[12px] text-text-muted">
                        {{ $serviceJournal->created_at ? $serviceJournal->created_at->format('d.m.Y') : 'N/A' }}
                    </span>
                    <span class="text-[12px] text-text-muted">
                        {{ $serviceJournal->created_at ? $serviceJournal->created_at->format('H:i') : 'N/A' }}
                    </span>
                    
                    <!-- Executor -->
                    <div class="w-[32px] h-[32px] rounded-full bg-neutral-300 overflow-hidden flex-shrink-0">
                        @if($serviceJournal->executor && ($serviceJournal->executor->profile->photo_id ?? false))
                            <img src="/storage_/{{ $serviceJournal->executor->profile->photo_path }}" 
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
                </div>
            </div>
            
            <h2 class="text-[14px] font-semibold text-text-primary mb-2">Документы</h2>
            
            @if(isset($documents) && $documents->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($documents as $document)
                    <div class="flex items-center gap-3 p-4 border border-border-light rounded-lg hover:shadow-md transition-shadow cursor-pointer">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.6667 1.66667H5C4.55797 1.66667 4.13405 1.84226 3.82149 2.15482C3.50893 2.46738 3.33333 2.89131 3.33333 3.33334V16.6667C3.33333 17.1087 3.50893 17.5326 3.82149 17.8452C4.13405 18.1577 4.55797 18.3333 5 18.3333H15C15.442 18.3333 15.866 18.1577 16.1785 17.8452C16.4911 17.5326 16.6667 17.1087 16.6667 16.6667V6.66667L11.6667 1.66667Z" stroke="#3B82F6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M11.6667 1.66667V6.66667H16.6667" stroke="#3B82F6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[14px] font-medium text-text-primary truncate">{{ $document->name }}</p>
                            <p class="text-[12px] text-text-muted">{{ $document->category ?? 'Документ' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Comments Section -->
        <div>
            <div class="flex items-center justify-between mb-2">
                <h2 class="text-[14px] font-semibold text-text-primary">Комментарии</h2>
            </div>
            
            <div class="h-24 overflow-y-auto space-y-1 mb-2" id="comments-list">
                @if(isset($comments) && $comments->isNotEmpty())
                    @foreach($comments as $comment)
                        <div class="flex items-start gap-2">
                            <div class="w-[20px] h-[20px] rounded-full bg-neutral-300 overflow-hidden flex-shrink-0">
                                @if($comment->user->profile->photo_id ?? false)
                                    <img src="/storage_/{{ $comment->user->profile->photo_path }}" 
                                         alt="User" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-neutral-200 flex items-center justify-center">
                                        <svg class="h-2.5 w-2.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-0.5">
                                    <span class="text-[10px] font-medium text-text-primary">
                                        {{ $comment->user->profile->first_name ?? '' }} {{ $comment->user->profile->last_name ?? '' }}
                                    </span>
                                    <span class="text-[9px] text-text-muted">{{ $comment->created_at->format('d.m.Y H:i') }}</span>
                                </div>
                                <p class="text-[10px] text-text-secondary">{{ $comment->message }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="flex items-start gap-3">
                        <div class="w-[32px] h-[32px] rounded-full bg-neutral-300 overflow-hidden flex-shrink-0">
                            <div class="w-full h-full bg-neutral-200 flex items-center justify-center">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-[12px] text-text-secondary">Комментарии отсутствуют</p>
                </div>
                </div>
                @endif
            </div>
            
            <!-- Comment Input -->
            <div class="flex items-center gap-3 pt-4">
                <input 
                    type="text" 
                    placeholder="Сообщение" 
                    class="flex-1 px-4 py-3 border border-border-light rounded-[60px] text-[14px] focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                    id="comment-input"
                />
                <button 
                    class="w-10 h-10 rounded-full bg-primary hover:bg-primary-dark transition-colors flex items-center justify-center"
                    id="send-comment-btn"
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

        <!-- Messages Tab Content -->
        <div id="messages-content" class="hidden flex items-start justify-center h-full pt-2">
            <div class="border border-border-light rounded-lg p-3 w-full max-w-xl">
                <h2 class="text-[15px] font-semibold text-text-primary mb-1">Сообщения с клиентом</h2>
                <div class="h-80 overflow-y-auto space-y-1.5 mb-2" id="messages-list">
                @if(isset($messages) && $messages->isNotEmpty())
                    @foreach($messages as $serviceMessage)
                        <div class="flex items-start gap-2.5">
                            <div class="w-[32px] h-[32px] rounded-full bg-neutral-300 overflow-hidden flex-shrink-0">
                                @if($serviceMessage->createdBy->profile->photo_id ?? false)
                                    <img src="/storage_/{{ $serviceMessage->createdBy->profile->photo_path }}" 
                                         alt="User" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-neutral-200 flex items-center justify-center">
                                        <svg class="h-3.5 w-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-0.5">
                                    <span class="text-[12px] font-medium text-text-primary">
                                        {{ $serviceMessage->createdBy->profile->first_name ?? '' }} {{ $serviceMessage->createdBy->profile->last_name ?? '' }}
                                    </span>
                                    <span class="text-[11px] text-text-muted">{{ \Carbon\Carbon::parse($serviceMessage->create_date)->format('d.m.Y H:i') }}</span>
                                </div>
                                <p class="text-[11px] text-text-secondary">{{ $serviceMessage->message->message ?? '' }}</p>
        </div>
                </div>
                    @endforeach
                @else
                    <div class="text-center py-2">
                        <p class="text-[10px] text-text-muted">Сообщения с клиентом отсутствуют</p>
                        <p class="text-[8px] text-gray-500 mt-0.5">Напишите первое сообщение ниже</p>
                    </div>
                @endif
            </div>
            
            <!-- Message Input -->
            <div class="flex items-center gap-3">
                <input 
                    type="text" 
                    placeholder="Сообщение" 
                    class="flex-1 px-4 py-3 border border-border-light rounded-[60px] text-[15px] focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                    id="message-input"
                />
                <button 
                    class="w-11 h-11 rounded-full bg-primary hover:bg-primary-dark transition-colors flex items-center justify-center"
                    id="send-message-btn"
                >
                    <svg width="17" height="17" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.3333 1.66667L9.16667 10.8333" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M18.3333 1.66667L12.5 18.3333L9.16667 10.8333L1.66667 7.5L18.3333 1.66667Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Return to Client Modal -->
    <div id="returnToClientModal" class="fixed inset-0 z-50 flex items-center justify-center hidden" style="background: rgba(0,0,0,0.4);">
        <div class="bg-white w-[500px] mx-4 flex flex-col rounded-lg">
            <!-- Modal Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-border-light">
                <h2 class="text-[18px] font-semibold text-text-primary">Вернуть клиенту для сбора данных</h2>
                <button onclick="closeReturnToClientModal()" class="flex items-center justify-center w-8 h-8 rounded-full hover:bg-gray-100 transition-colors">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 4L4 12" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4 4L12 12" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="px-6 py-4">
                <form id="returnToClientForm">
                    <div class="mb-4">
                        <label for="rejectReason" class="block text-[14px] font-medium text-text-primary mb-2">
                            Укажите причину возврата:
                        </label>
                        <textarea
                            id="rejectReason"
                            name="rejectReason"
                            rows="4"
                            class="w-full px-3 py-2 border border-border-light rounded-lg text-[14px] focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent resize-none"
                            placeholder="Опишите причину, по которой услуга возвращается клиенту для сбора дополнительных данных..."
                            required
                        ></textarea>
                    </div>

                    <div class="flex items-center justify-end gap-3">
                        <button type="button" onclick="closeReturnToClientModal()"
                                class="px-4 py-2 text-[14px] font-medium text-text-muted hover:text-text-primary transition-colors">
                            Отмена
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-orange-500 text-white text-[14px] font-medium rounded-full hover:bg-orange-600 transition-colors">
                            Вернуть клиенту
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
<script>
// Close modal when clicking outside
document.getElementById('returnToClientModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeReturnToClientModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeReturnToClientModal();
    }
});
</script>
@endsection
