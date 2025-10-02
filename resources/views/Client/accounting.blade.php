@extends('layouts.client-app')

@section('title', 'Бухгалтерия')

@section('content')
<div class="w-full" x-data="clientAccounting()" x-init="init()">
    <!-- Page Header -->
    <div class="flex items-center justify-between px-5 py-3" style="padding-left:20px;padding-right:20px;">
        <h1 class="text-[32px] md:text-[39px] leading-[1] font-normal tracking-[-0.02em] text-text-primary">Бухгалтерия</h1>
        <div class="hidden md:flex items-center gap-[11px] px-[16px] pr-[22px] py-[11px] h-[46px] border border-border-light rounded-[80px] bg-white mr-2">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.8333 15.8333L13.2083 13.2083" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <input type="text" placeholder="Поиск по номеру услуги или компании" class="bg-transparent border-none outline-none text-[12px] font-medium leading-[1] text-text-primary placeholder:text-text-primary" x-model="searchQuery" @input="filterServices()" />
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
                Все услуги
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

    <!-- Table Headers -->
    <div class="hidden md:grid grid-cols-[200px,150px,150px,150px,150px] gap-[60px,60px,60px,60px,0px] items-center mx-5 mb-3 px-5 py-3">
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
                    <div class="hidden md:grid grid-cols-[200px,150px,150px,150px,150px] gap-[60px,60px,60px,60px,0px] items-center bg-white rounded-lg shadow-sm mb-3 p-5 accounting-card" @click="openDocumentsModal('{{ $service->id }}', '{{ $service->service_no }}')">
                        <div class="text-sm font-medium text-[#1E2B28] leading-[1] service-no">УСЛ-{{ $service->service_no }}</div>
                        <div class="text-sm font-medium text-[#1E2B28] leading-[1]">{{ number_format($service->amount ?? 0, 2, '.', ' ') }} ₸</div>
                        <div class="text-sm font-medium text-[#1E2B28] leading-[1]">{{ number_format($service->tax_amount ?? 0, 2, '.', ' ') }} ₸</div>
                        <div class="text-sm font-medium text-[#1E2B28] leading-[1]">{{ number_format($service->prepayment_amount ?? 0, 2, '.', ' ') }} ₸</div>
                        <div class="text-sm font-medium text-[#1E2B28] leading-[1]">{{ number_format($service->full_payment_amount ?? 0, 2, '.', ' ') }} ₸</div>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="md:hidden bg-white rounded-lg shadow-sm mb-3 p-4 accounting-card" @click="openDocumentsModal('{{ $service->id }}', '{{ $service->service_no }}')">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-base font-medium text-[#1E2B28] leading-[1] service-no">УСЛ-{{ $service->service_no }}</span>
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
            @if(isset($serviceJournalList) && method_exists($serviceJournalList, 'links'))
                <div class="flex justify-center items-center mt-8">
                    <div class="flex items-center space-x-2">
                        @if($serviceJournalList->currentPage() > 1)
                            <a href="{{ $serviceJournalList->previousPageUrl() }}" class="w-8 h-8 rounded-full text-sm font-medium bg-white text-text-primary border border-border-light hover:bg-green-100 flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </a>
                        @endif

                        @foreach($serviceJournalList->getUrlRange(1, $serviceJournalList->lastPage()) as $page => $url)
                            @if($page == $serviceJournalList->currentPage())
                                <span class="w-8 h-8 rounded-full text-sm font-medium bg-green-700 text-white flex items-center justify-center">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="w-8 h-8 rounded-full text-sm font-medium bg-white text-text-primary border border-border-light hover:bg-green-100 flex items-center justify-center transition-colors">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if($serviceJournalList->hasMorePages())
                            <a href="{{ $serviceJournalList->nextPageUrl() }}" class="w-8 h-8 rounded-full text-sm font-medium bg-white text-text-primary border border-border-light hover:bg-green-100 flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            @endif
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
            const searchQuery = this.searchQuery.toLowerCase();
            const accountingCards = document.querySelectorAll('.accounting-card');
            
            accountingCards.forEach(card => {
                const serviceNo = card.querySelector('.service-no')?.textContent.toLowerCase() || '';
                
                const matchesSearch = serviceNo.includes(searchQuery);
                
                if (matchesSearch) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
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