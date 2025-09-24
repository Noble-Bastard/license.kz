@extends('layouts.client-app')

@section('title', 'Бухгалтерия')

@section('content')
<div class="min-h-screen bg-gray-50 p-6" x-data="clientAccounting()" x-init="init()">
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Бухгалтерия</h1>
        <div class="relative">
            <input type="text" 
                   placeholder="Поиск по номеру услуги или компании"
                   class="w-80 px-4 py-2 pl-10 pr-4 text-gray-500 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                   x-model="searchQuery"
                   @input="filterServices()">
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
            Все услуги
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

    <!-- Table Headers -->
    <div class="hidden md:grid grid-cols-[200px,150px,150px,150px,150px] gap-[60px,60px,60px,60px,0px] items-center mx-5 mb-3 px-5">
        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Номер услуги</div>
        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Стоимость</div>
        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Налог, пошлина</div>
        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Предоплата</div>
        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Полная оплата</div>
    </div>

    <!-- Accounting List -->
    <div class="py-5 pb-20" style="background-color: var(--color-bg-secondary); width: 100vw; margin-left: calc(-50vw + 50%); min-height: calc(100vh - 200px);">
        <div class="px-5" style="padding-left:20px;padding-right:20px;">
            @if(isset($serviceJournalList) && $serviceJournalList->isNotEmpty())
                @foreach($serviceJournalList as $service)
                    <!-- Desktop Card View -->
                    <div class="hidden md:grid grid-cols-[200px,150px,150px,150px,150px] gap-[60px,60px,60px,60px,0px] items-center bg-white rounded-lg shadow-sm mb-3 p-5" @click="openDocumentsModal('{{ $service->id }}', '{{ $service->service_no }}')">
                        <div class="text-sm font-medium text-[#1E2B28] leading-[1]">УСЛ-{{ $service->service_no }}</div>
                        <div class="text-sm font-medium text-[#1E2B28] leading-[1]">{{ number_format($service->amount ?? 0, 2, '.', ' ') }} ₸</div>
                        <div class="text-sm font-medium text-[#1E2B28] leading-[1]">{{ number_format($service->tax_amount ?? 0, 2, '.', ' ') }} ₸</div>
                        <div class="text-sm font-medium text-[#1E2B28] leading-[1]">{{ number_format($service->prepayment_amount ?? 0, 2, '.', ' ') }} ₸</div>
                        <div class="text-sm font-medium text-[#1E2B28] leading-[1]">{{ number_format($service->full_payment_amount ?? 0, 2, '.', ' ') }} ₸</div>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="md:hidden bg-white rounded-lg shadow-sm mb-3 p-4" @click="openDocumentsModal('{{ $service->id }}', '{{ $service->service_no }}')">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-base font-medium text-[#1E2B28] leading-[1]">УСЛ-{{ $service->service_no }}</span>
                        </div>
                        
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-xs font-medium text-gray-500">Стоимость</span>
                                <span class="text-sm font-medium text-[#1E2B28]">{{ number_format($service->amount ?? 0, 2, '.', ' ') }} ₸</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-xs font-medium text-gray-500">Налог, пошлина</span>
                                <span class="text-sm font-medium text-[#1E2B28]">{{ number_format($service->tax_amount ?? 0, 2, '.', ' ') }} ₸</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-xs font-medium text-gray-500">Предоплата</span>
                                <span class="text-sm font-medium text-[#1E2B28]">{{ number_format($service->prepayment_amount ?? 0, 2, '.', ' ') }} ₸</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-xs font-medium text-gray-500">Полная оплата</span>
                                <span class="text-sm font-medium text-[#1E2B28]">{{ number_format($service->full_payment_amount ?? 0, 2, '.', ' ') }} ₸</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-white rounded-lg shadow-sm mb-3 p-5">
                    <div class="text-center text-text-secondary">Нет данных по бухгалтерии</div>
                </div>
            @endif

            <!-- Pagination -->
            <div class="flex justify-center items-center mt-8">
                <div class="flex items-center space-x-2">
                    <button class="w-8 h-8 rounded-full text-sm font-medium bg-[#279760] text-white flex items-center justify-center">1</button>
                    <button class="w-8 h-8 rounded-full text-sm font-medium bg-white text-text-primary border border-border-light hover:bg-bg-tertiary flex items-center justify-center transition-colors">2</button>
                    <button class="w-8 h-8 rounded-full text-sm font-medium bg-white text-text-primary border border-border-light hover:bg-bg-tertiary flex items-center justify-center transition-colors">3</button>
                    <span class="px-3 py-2 text-sm text-gray-500">...</span>
                    <button class="w-8 h-8 rounded-full text-sm font-medium bg-white text-text-primary border border-border-light hover:bg-bg-tertiary flex items-center justify-center transition-colors">10</button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('Client.partials.documents-modal')

@push('scripts')
<script>
function clientAccounting() {
    return {
        searchQuery: '',
        filterStatus: 'all',
        showDocumentsModal: false,
        selectedServiceId: null,
        selectedServiceNo: '000319',

        init() {
            // Initialize component
        },

        filterServices() {
            // Filter logic here
        },

        openDocumentsModal(serviceId, serviceNo) {
            this.selectedServiceId = serviceId;
            this.selectedServiceNo = serviceNo;
            this.showDocumentsModal = true;
        },

        closeDocumentsModal() {
            this.showDocumentsModal = false;
            this.selectedServiceId = null;
            this.selectedServiceNo = '000319';
        },

        downloadDocument(documentId) {
            // Handle document download
            console.log('Downloading document:', documentId);
        }
    }
}
</script>
@endpush
@endsection