@extends('layouts.figma-app')

@section('content')
<div class="w-full" x-data="messagesManager()" x-init="init()">
    <!-- Page Header -->
    <div class="flex items-center justify-between px-5 py-3" style="padding-left:20px;padding-right:20px;">
        <h1 class="text-[32px] md:text-[39px] leading-[1] font-normal tracking-[-0.02em] text-text-primary">Сообщения</h1>
        <div class="hidden md:flex items-center gap-[11px] px-[16px] pr-[22px] py-[11px] h-[46px] border border-border-light rounded-[80px] bg-white mr-2">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.8333 15.8333L13.2083 13.2083" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <input type="text" placeholder="Поиск по сообщениям" class="bg-transparent border-none outline-none text-[12px] font-medium leading-[1] text-text-primary placeholder:text-text-primary" x-model="searchQuery" @input="filterMessages()" />
        </div>
    </div>
    
    <!-- Mobile Search -->
    <div class="md:hidden mb-3 px-5" style="padding-left:20px;padding-right:20px;">
        <div class="flex justify-end mr-2">
            <div class="flex items-center justify-center w-[46px] h-[46px] border border-border-light rounded-[80px] bg-white">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.8333 15.8333L13.2083 13.2083" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
        </div>
    </div>
    
    <!-- Navigation Tabs -->
    <div class="px-5" style="padding-left:20px;padding-right:20px;">
        <div class="flex items-center gap-[10px] mb-[16px] md:flex-wrap overflow-x-auto md:overflow-x-visible">
            <button @click="activeTab = 'executors'" 
                    :class="activeTab === 'executors' ? 'bg-gray-200 text-text-primary' : 'text-text-primary'"
                    class="px-[14px] py-[10px] rounded-[80px] text-[12px] font-medium flex-shrink-0">
                Исполнители
            </button>
            <button @click="activeTab = 'clients'" 
                    :class="activeTab === 'clients' ? 'bg-gray-200 text-text-primary' : 'text-text-primary'"
                    class="px-[14px] py-[10px] rounded-[80px] text-[12px] font-medium flex-shrink-0">
                Клиенты
            </button>
        </div>
    </div>

    <!-- Messages List -->
    <div class="px-5" style="padding-left:20px;padding-right:20px;">
        <div class="space-y-3">
            @foreach(range(1, 6) as $index)
                <div class="bg-white rounded-lg shadow-sm p-4 hover:shadow-md transition-shadow cursor-pointer message-item">
                    <div class="flex items-center gap-3">
                        <div class="w-[40px] h-[40px] rounded-full bg-neutral-300 overflow-hidden flex-shrink-0">
                            <div class="w-full h-full bg-neutral-300 flex items-center justify-center">
                                <span class="text-sm font-medium text-gray-700">
                                    ИИ
                                </span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-sm font-medium text-text-primary contact-name">Иван Иванов</div>
                            <div class="text-xs text-text-muted last-message">Последнее сообщение...</div>
                        </div>
                        <div class="text-xs text-text-muted">12:30</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
function messagesManager() {
    return {
        activeTab: 'executors',
        searchQuery: '',

        init() {
            // Initialize component
        },

                filterMessages() {
                    const searchQuery = this.searchQuery.toLowerCase();
                    const messageItems = document.querySelectorAll('.message-item');
                    
                    messageItems.forEach(item => {
                        const contactName = item.querySelector('.contact-name')?.textContent.toLowerCase() || '';
                        const lastMessage = item.querySelector('.last-message')?.textContent.toLowerCase() || '';
                        
                        const matchesSearch = contactName.includes(searchQuery) || 
                                            lastMessage.includes(searchQuery);
                        
                        if (matchesSearch) {
                            item.classList.remove('hidden');
                        } else {
                            item.classList.add('hidden');
                        }
                    });
                }
    }
}
</script>
@endsection

