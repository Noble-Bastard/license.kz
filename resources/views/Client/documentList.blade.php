@extends('layouts.client-app')

@section('title', 'Документы')

@section('content')
<div class="w-full" x-data="clientDocuments()" x-init="init()">
    <!-- Page Header -->
    <div class="flex items-center justify-between px-5 py-3" style="padding-left:20px;padding-right:20px;">
        <h1 class="text-[32px] md:text-[39px] leading-[1] font-normal tracking-[-0.02em] text-text-primary">Документы</h1>
        <div class="hidden md:flex items-center gap-[11px] px-[16px] pr-[22px] py-[11px] h-[46px] border border-border-light rounded-[80px] bg-white mr-2">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.8333 15.8333L13.2083 13.2083" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <input type="text" placeholder="Поиск по названию документа или услуге" class="bg-transparent border-none outline-none text-[12px] font-medium leading-[1] text-text-primary placeholder:text-text-primary" x-model="searchQuery" @input="filterDocuments()" />
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

    <!-- Status Filter Tabs -->
    <div class="px-5" style="padding-left:20px;padding-right:20px;">
        <div class="flex items-center gap-[10px] mb-[16px] md:flex-wrap overflow-x-auto md:overflow-x-visible">
            <button @click="filterStatus = 'all'" 
                    :class="filterStatus === 'all' ? 'bg-gray-200 text-text-primary' : 'text-text-primary'"
                    class="px-[14px] py-[10px] rounded-[80px] text-[12px] font-medium flex-shrink-0">
                Все документы
            </button>
            <button @click="filterStatus = 'open'" 
                    :class="filterStatus === 'open' ? 'bg-gray-200 text-text-primary' : 'text-text-primary'"
                    class="px-[14px] py-[10px] rounded-[80px] text-[12px] font-medium flex-shrink-0">
                Открытые
            </button>
            <button @click="filterStatus = 'closed'" 
                    :class="filterStatus === 'closed' ? 'bg-gray-200 text-text-primary' : 'text-text-primary'"
                    class="px-[14px] py-[10px] rounded-[80px] text-[12px] font-medium flex-shrink-0">
                Закрытые
            </button>
        </div>
    </div>

    <!-- Documents Content -->
    <div class="py-5 pb-20" style="background-color: var(--color-bg-secondary); width: 100vw; margin-left: calc(-50vw + 50%); min-height: calc(100vh - 200px);">
        <div class="px-5" style="padding-left:20px;padding-right:20px;">
            @if(isset($serviceJournalList) && $serviceJournalList->isNotEmpty())
                @foreach($serviceJournalList as $serviceJournal)
            <!-- Service Group -->
            <div class="mb-8 service-group">
                <div class="flex items-center mb-4">
                    <h2 class="text-lg font-medium text-gray-900 service-no">УСЛ-{{ $serviceJournal->service_no }}</h2>
                    <span class="ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                        {{ $serviceJournal->serviceStatus && strtolower($serviceJournal->serviceStatus->name) === 'выполнено' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $serviceJournal->serviceStatus->name ?? 'Выполнение услуги' }}
                    </span>
                </div>

                <!-- Document Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @if(isset($serviceJournal->clientDocuments) && $serviceJournal->clientDocuments->isNotEmpty())
                        @foreach($serviceJournal->clientDocuments as $document)
                            @if($document && $document->document)
                                @php
                                    $fileName = basename($document->document->path);
                                    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                                    $description = $document->description ?? 'Документ клиента';
                                @endphp
                                <div class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-md transition-shadow cursor-pointer"
                                     @click="downloadDocument('{{ $document->document->path }}')">
                                    <div class="flex flex-col items-center text-center">
                                        <!-- File Icon -->
                                        <div class="w-16 h-20 mb-4 flex items-center justify-center rounded-lg bg-green-100">
                                            <div class="text-white text-xs font-medium bg-green-600 px-2 py-1 rounded">
                                                .{{ $fileExtension }}
                                            </div>
                                        </div>
                                        
                                        <!-- Document Info -->
                                        <h3 class="text-sm font-medium text-gray-900 mb-1 document-name">{{ $fileName }}</h3>
                                        <p class="text-xs text-gray-500">{{ $description }}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="col-span-full text-center py-8 text-gray-500">
                            Нет документов для данной услуги
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="bg-white rounded-lg shadow p-8">
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Документов пока нет</h3>
                    <p class="text-gray-500 mb-6">У вас пока нет документов по услугам</p>
                </div>
            </div>
        </div>
    @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
function clientDocuments() {
    return {
        searchQuery: '',
        filterStatus: 'all',

        init() {
            // Initialize component
        },

        filterDocuments() {
            const searchQuery = this.searchQuery.toLowerCase();
            const serviceGroups = document.querySelectorAll('.service-group');
            
            serviceGroups.forEach(group => {
                const serviceNo = group.querySelector('.service-no')?.textContent.toLowerCase() || '';
                const documentNames = group.querySelectorAll('.document-name');
                let hasMatchingDocument = false;
                
                documentNames.forEach(docName => {
                    const docText = docName.textContent.toLowerCase();
                    if (docText.includes(searchQuery)) {
                        hasMatchingDocument = true;
                    }
                });
                
                const matchesSearch = serviceNo.includes(searchQuery) || hasMatchingDocument;
                
                if (matchesSearch) {
                    group.style.display = 'block';
                } else {
                    group.style.display = 'none';
                }
            });
        },

        downloadDocument(fileName) {
            // Handle document download
            console.log('Downloading:', fileName);
            // In real implementation, you would trigger the actual download
        }
    }
}
</script>
@endpush
@endsection