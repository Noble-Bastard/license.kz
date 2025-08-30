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

    <!-- Accounting Table -->
    <div class="bg-white rounded-lg shadow">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Номер услуги</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Стоимость</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Налог, пошлина</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Предоплата</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Полная оплата</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if(isset($serviceJournalList) && $serviceJournalList->isNotEmpty())
                        @foreach($serviceJournalList as $service)
                            <tr class="hover:bg-gray-50 cursor-pointer" @click="openDocumentsModal('{{ $service->id }}', '{{ $service->service_no }}')">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    УСЛ-{{ $service->service_no }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format($service->amount ?? 0, 2, '.', ' ') }} ₸
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format($service->tax_amount ?? 0, 2, '.', ' ') }} ₸
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format($service->prepayment_amount ?? 0, 2, '.', ' ') }} ₸
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format($service->full_payment_amount ?? 0, 2, '.', ' ') }} ₸
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                Нет данных по бухгалтерии
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mt-6">
        <nav class="flex items-center space-x-2">
            <button class="px-3 py-2 text-sm font-medium text-white bg-green-600 rounded-md">1</button>
            <button class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">2</button>
            <button class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">3</button>
            <span class="px-3 py-2 text-sm text-gray-500">...</span>
            <button class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">10</button>
        </nav>
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