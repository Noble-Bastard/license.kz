@extends('layouts.figma-executor')

@section('content')
    <div class="w-full">
        <!-- Page header -->
        <div class="flex items-center justify-between px-5 py-3" style="padding-left:20px;padding-right:20px;">
            <h1 class="text-[32px] md:text-[39px] leading-[1] font-normal tracking-[-0.02em] text-text-primary">Проекты</h1>
            <div class="hidden md:flex items-center gap-[11px] px-[16px] pr-[22px] py-[11px] h-[46px] border border-border-light rounded-[80px] bg-white mr-2">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.8333 15.8333L13.2083 13.2083" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <input id="exec-projects-search" type="text" placeholder="Поиск по проектам" class="bg-transparent border-none outline-none text-[12px] font-medium leading-[1] text-text-primary placeholder:text-text-primary" />
            </div>
        </div>
        
        <!-- Mobile Search -->
        <div class="md:hidden mb-3 px-5" style="padding-left:20px;padding-right:20px;">
            <div class="flex justify-end">
                <div class="flex items-center justify-center w-[46px] h-[46px] border border-border-light rounded-[80px] bg-white">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.8333 15.8333L13.2083 13.2083" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
            </div>
        </div>
        

        <!-- Status tabs -->
        <div class="px-5" style="padding-left:20px;padding-right:20px;">
            <div class="flex items-center gap-[10px] mb-[16px] md:flex-wrap overflow-x-auto md:overflow-x-visible">
                @php $active = $service_status_id ?? null; @endphp
                <a href="{{ route('executor.project.list') }}" class="px-[14px] py-[10px] rounded-[60px] text-[12px] font-medium flex-shrink-0 {{ !$active ? 'bg-gray-200 text-text-primary' : 'bg-white text-text-primary border border-border-light' }}">Все</a>
                @foreach(($statusList ?? []) as $status)
                    <a href="{{ route('executor.project.list_by_status', ['service_status_id' => $status->id]) }}" class="px-[14px] py-[10px] rounded-[60px] text-[12px] font-medium flex-shrink-0 {{ (int)$active === (int)$status->id ? 'bg-gray-200 text-text-primary' : 'bg-white text-text-primary border border-border-light' }}">{{ $status->name }}</a>
                @endforeach
            </div>
        </div>

        <!-- Заголовки колонок -->
        <div class="hidden md:grid grid-cols-[200px,150px,1fr,150px] items-center gap-[60px,120px,60px,0px] text-[12px] font-semibold text-[#6F6F6F] leading-[1] mx-5 px-5 py-3 bg-white">
            <div>Номер услуги</div>
            <div>Дата обращения</div>
            <div>Менеджер</div>
            <div class="text-right pr-5">Статус</div>
        </div>

        <!-- Список проектов -->
        <div class="py-5 pb-20" style="background-color: var(--color-bg-secondary); width: 100vw; margin-left: calc(-50vw + 50%); min-height: calc(100vh - 200px);">
            <div class="px-5" style="padding-left:20px;padding-right:20px;">
                @if(isset($projectList) && $projectList->isNotEmpty())
                    @foreach($projectList->where('project_status_id', $service_status_id) as $project)
                        <!-- Desktop Table View -->
                        <div class="hidden md:block bg-white rounded-lg shadow-sm mb-3 project-row cursor-pointer hover:bg-gray-50 transition-colors" onclick="openExecutorModal({{ $project->service_journal_id }})">
                            <div class="grid grid-cols-[200px,150px,1fr,150px] items-center gap-[60px,120px,60px,0px] w-full p-5">
                                <!-- Номер услуги -->
                                <div class="text-[13px] font-medium text-[#1E2B28] leading-[1] project-no">
                                    {{ $project->description }}
                                </div>
                                <!-- Дата обращения -->
                                <div class="text-[13px] font-medium text-[#1E2B28] leading-[1] project-date">
                                    {{ \App\Data\Helper\Assistant::formatDate($project->create_date) }}
                                </div>
                                <!-- Менеджер -->
                                <div class="flex items-center gap-[10px]">
                                    <div class="w-[26px] h-[26px] rounded-full bg-neutral-300 overflow-hidden">
                                        <img src="{{ asset('images/user1.png') }}" alt="{{ $project->manager_name ?? 'Manager' }}" class="w-full h-full object-cover"/>
                                    </div>
                                    <span class="text-[13px] font-medium text-[#1E2B28] leading-[1] manager-name">{{ $project->manager_name ?? '-' }}</span>
                                </div>
                                <!-- Статус -->
                                <div class="flex items-center justify-end gap-[5px] pr-5">
                                    <div class="w-2 h-2 rounded-full {{ $project->status_color ?? 'bg-[#279760]' }}"></div>
                                    <span class="text-[13px] font-medium text-[#1E2B28] leading-[1]">{{ $project->status_name ?? '-' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile Card View -->
                        <div class="md:hidden bg-white rounded-lg shadow-sm mb-3 p-4 project-row cursor-pointer hover:bg-gray-50 transition-colors" onclick="openExecutorModal({{ $project->service_journal_id }})">
                            <!-- Header with project number and date -->
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-[10px]">
                                    <span class="text-base font-medium text-[#1E2B28] leading-[1] project-no">{{ $project->description }}</span>
                                </div>
                                <div class="flex items-center gap-[6px] flex-shrink-0">
                                    <span class="text-sm font-medium text-[#1E2B28] leading-[1] project-date">
                                        {{ \App\Data\Helper\Assistant::formatDate($project->create_date) }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Details - Vertical Layout -->
                            <div class="space-y-2">
                                <div class="flex flex-col">
                                    <span class="text-xs font-medium text-gray-500 mb-1">Статус</span>
                                    <div class="flex items-center gap-[6px]">
                                        <div class="w-[8px] h-[8px] rounded-full {{ $project->status_color ?? 'bg-[#279760]' }}"></div>
                                        <span class="text-sm font-medium text-[#1E2B28]">{{ $project->status_name ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-xs font-medium text-gray-500 mb-1">Менеджер</span>
                                    <div class="flex items-center gap-[10px]">
                                        <div class="w-[32px] h-[32px] rounded-full bg-neutral-300 overflow-hidden flex-shrink-0">
                                            <img src="{{ asset('images/user1.png') }}" alt="{{ $project->manager_name ?? 'Manager' }}" class="w-full h-full object-cover"/>
                                        </div>
                                        <span class="text-sm font-medium text-[#1E2B28] manager-name">{{ $project->manager_name ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="bg-white rounded-lg shadow-sm mb-3 p-5">
                        <div class="text-center text-text-secondary">Нет проектов для отображения.</div>
                    </div>
                @endif

                <!-- Pagination -->
                @if(isset($projectList) && $projectList->hasPages())
                    <div class="flex justify-center items-center mt-8">
                        <div class="flex items-center space-x-2">
                            {{-- Pagination Numbers --}}
                            @php
                                $currentPage = $projectList->currentPage();
                                $lastPage = $projectList->lastPage();
                                $start = max(1, $currentPage - 2);
                                $end = min($lastPage, $currentPage + 2);
                            @endphp

                            @if($start > 1)
                                <a href="{{ $projectList->url(1) }}" class="w-8 h-8 flex items-center justify-center text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-gray-50">1</a>
                                @if($start > 2)
                                    <span class="w-8 h-8 flex items-center justify-center text-gray-700 bg-white border border-gray-300 rounded-full">...</span>
                                @endif
                            @endif

                            @for($page = $start; $page <= $end; $page++)
                                @if($page == $currentPage)
                                    <span class="w-8 h-8 flex items-center justify-center text-white bg-[#279760] border border-[#279760] rounded-full">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $projectList->url($page) }}" class="w-8 h-8 flex items-center justify-center text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-gray-50">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endfor

                            @if($end < $lastPage)
                                @if($end < $lastPage - 1)
                                    <span class="w-8 h-8 flex items-center justify-center text-gray-700 bg-white border border-gray-300 rounded-full">...</span>
                                @endif
                                <a href="{{ $projectList->url($lastPage) }}" class="w-8 h-8 flex items-center justify-center text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-gray-50">{{ $lastPage }}</a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            const $input = $('#exec-projects-search');
            if ($input.length) {
                $input.on('input', function(){
                    const q = $(this).val().toLowerCase();
                    $('.project-row').each(function(){
                        const $row = $(this);
                        const no = ($row.find('.project-no').text() || '').toLowerCase();
                        const date = ($row.find('.project-date').text() || '').toLowerCase();
                        const manager = ($row.find('.manager-name').text() || '').toLowerCase();
                        const match = no.includes(q) || date.includes(q) || manager.includes(q);
                        if (q === '' || match) {
                            $row.removeClass('hidden');
                        } else {
                            $row.addClass('hidden');
                        }
                    });
                });
            }
        });
    </script>

    <!-- Executor Service Modal -->
    <div id="executorModal" class="fixed inset-0 z-50 flex items-center justify-center hidden" style="background: rgba(0,0,0,0.4);">
        <div class="bg-white w-[800px] h-[700px] mx-4 flex flex-col">
            <!-- Modal content will be loaded here -->
        </div>
    </div>

    <script>
    let currentServiceId = null;

    function openExecutorModal(serviceId) {
        console.log('Opening executor modal for service:', serviceId);
        currentServiceId = serviceId;
        // Show modal
        document.getElementById('executorModal').classList.remove('hidden');
        
        // Load modal content via AJAX
        fetch(`/executor/service-modal/${serviceId}`)
            .then(response => response.text())
            .then(html => {
                // Extract only the modal content from the response
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const modalContent = doc.querySelector('.fixed.inset-0');
                
                if (modalContent) {
                    document.querySelector('#executorModal .bg-white').innerHTML = modalContent.querySelector('.bg-white').innerHTML;
                    // Initialize modal functionality after content is loaded
                    initializeExecutorModalFunctionality();
                }
            })
            .catch(error => {
                console.error('Error loading modal:', error);
            });
    }

    function closeExecutorModal() {
        document.getElementById('executorModal').classList.add('hidden');
        currentServiceId = null;
    }

    function initializeExecutorModalFunctionality() {
        // Убираем переключение вкладок, так как теперь все в одной вкладке

        // Message sending functionality
        const sendMessageBtn = document.getElementById('send-message-btn');
        const messageInput = document.getElementById('message-input');

        if (sendMessageBtn && messageInput) {
            sendMessageBtn.addEventListener('click', function() {
                const message = messageInput.value.trim();
                if (message && currentServiceId) {
                    // Send message via AJAX
                    fetch('/executor/send-message', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            serviceJournalId: currentServiceId,
                            message: message
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            messageInput.value = '';
                            // Reload modal content to show new message
                            openExecutorModal(currentServiceId);
                        } else {
                            alert('Ошибка отправки сообщения: ' + data.error);
                        }
                    })
                    .catch(error => {
                        console.error('Error sending message:', error);
                        alert('Ошибка отправки сообщения');
                    });
                }
            });

            messageInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    sendMessageBtn.click();
                }
            });
        }
    }

    // Close modal when clicking outside
    document.getElementById('executorModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeExecutorModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeExecutorModal();
        }
    });

    // Function to send step comment
    function sendStepComment(stepId, message) {
        if (!message.trim() || !currentServiceId) return;

        fetch('/executor/send-step-message', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                serviceJournalId: currentServiceId,
                stepId: stepId,
                message: message
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Clear input
                document.getElementById('step-comment-input-' + stepId).value = '';
                // Reload modal content
                openExecutorModal(currentServiceId);
            } else {
                alert('Ошибка отправки комментария: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error sending step comment:', error);
            alert('Ошибка отправки комментария');
        });
    }

    // Handle Enter key press for step comments
    function handleStepCommentKeyPress(event, stepId) {
        if (event.key === 'Enter') {
            const input = document.getElementById('step-comment-input-' + stepId);
            const message = input.value.trim();
            if (message) {
                sendStepComment(stepId, message);
            }
        }
    }

    // Function to send service to check
    function sendToCheck(serviceJournalId) {
        if (confirm('Вы уверены, что хотите отправить задачу на проверку?')) {
            const url = '/executor/service-modal/' + serviceJournalId + '/send-to-check';

            fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    // Reload modal content to show updated status
                    openExecutorModal(serviceJournalId);
                } else {
                    alert('Ошибка: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ошибка при отправке на проверку');
            });
        }
    }
</script>
@endsection