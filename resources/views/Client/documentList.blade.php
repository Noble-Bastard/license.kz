@extends('layouts.client-app')

@section('title', 'Документы')

@section('content')
<div class="min-h-screen bg-gray-50 p-6" x-data="clientDocuments()" x-init="init()">
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Документы</h1>
        <div class="relative">
            <input type="text" 
                   placeholder="Поиск по названию документа или услуге"
                   class="w-80 px-4 py-2 pl-10 pr-4 text-gray-500 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                   x-model="searchQuery"
                   @input="filterDocuments()">
            <svg class="absolute left-3 top-3 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
    </div>

    <!-- Status Filter Tabs -->
    <div class="flex space-x-1 mb-6">
        <button @click="filterStatus = 'all'" 
                :class="filterStatus === 'all' ? 'bg-gray-200 text-gray-900' : 'text-gray-500 hover:text-gray-700'"
                class="px-4 py-2 rounded-lg text-sm font-medium transition-colors">
            Все документы
        </button>
        <button @click="filterStatus = 'open'" 
                :class="filterStatus === 'open' ? 'bg-gray-200 text-gray-900' : 'text-gray-500 hover:text-gray-700'"
                class="px-4 py-2 rounded-lg text-sm font-medium transition-colors">
            Открытые
        </button>
        <button @click="filterStatus = 'closed'" 
                :class="filterStatus === 'closed' ? 'bg-gray-200 text-gray-900' : 'text-gray-500 hover:text-gray-700'"
                class="px-4 py-2 rounded-lg text-sm font-medium transition-colors">
            Закрытые
        </button>
    </div>

    @if(isset($serviceJournalList) && $serviceJournalList->isNotEmpty())
        @foreach($serviceJournalList as $serviceJournal)
            <!-- Service Group -->
            <div class="mb-8">
                <div class="flex items-center mb-4">
                    <h2 class="text-lg font-medium text-gray-900">УСЛ-{{ $serviceJournal->service_no }}</h2>
                    <span class="ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                        {{ $serviceJournal->serviceStatus && strtolower($serviceJournal->serviceStatus->name) === 'выполнено' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $serviceJournal->serviceStatus->name ?? 'Выполнение услуги' }}
                    </span>
                </div>

                <!-- Document Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @php
                        $clientDocuments = $serviceJournal->clientDocumentList();
                    @endphp

                    @if($clientDocuments->isNotEmpty())
                        @foreach($clientDocuments as $document)
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
                                        <h3 class="text-sm font-medium text-gray-900 mb-1">{{ $fileName }}</h3>
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
            // Filter logic here
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