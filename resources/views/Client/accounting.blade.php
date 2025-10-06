@extends('layouts.client-app')

@section('title', 'Бухгалтерия')

@section('content')
<div class="w-full">
    <!-- Page Header -->
    <div class="flex items-center justify-between px-5 py-3" style="padding-left:20px;padding-right:20px;">
        <h1 class="text-[32px] md:text-[39px] leading-[1] font-normal tracking-[-0.02em] text-text-primary">Бухгалтерия</h1>
        <div class="hidden md:flex items-center gap-[11px] px-[16px] pr-[22px] py-[11px] h-[46px] border border-border-light rounded-[80px] bg-white mr-2">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.8333 15.8333L13.2083 13.2083" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <input type="text" placeholder="Поиск по номеру услуги или компании" class="bg-transparent border-none outline-none text-[12px] font-medium leading-[1] text-text-primary placeholder:text-text-primary" id="searchInput" />
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
            <button onclick="filterServices('all')" 
                    id="filter-all"
                    class="px-[14px] py-[10px] rounded-[80px] text-[12px] font-medium flex-shrink-0 bg-gray-200 text-text-primary">
                Все услуги
            </button>
            <button onclick="filterServices('open')" 
                    id="filter-open"
                    class="px-[14px] py-[10px] rounded-[80px] text-[12px] font-medium flex-shrink-0 text-text-primary">
                Открытые
            </button>
            <button onclick="filterServices('closed')" 
                    id="filter-closed"
                    class="px-[14px] py-[10px] rounded-[80px] text-[12px] font-medium flex-shrink-0 text-text-primary">
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
                    <div class="hidden md:grid grid-cols-[200px,150px,150px,150px,150px] gap-[60px,60px,60px,60px,0px] items-center bg-white rounded-lg shadow-sm mb-3 p-5 accounting-card cursor-pointer hover:bg-gray-50 transition-colors" onclick="openDocumentsModal({{ $service->id }}, '{{ $service->service_no }}')">
                        <div class="text-sm font-medium text-[#1E2B28] leading-[1] service-no">УСЛ-{{ $service->service_no }}</div>
                        <div class="text-sm font-medium text-[#1E2B28] leading-[1]">{{ number_format($service->amount ?? 0, 2, '.', ' ') }} ₸</div>
                        <div class="text-sm font-medium text-[#1E2B28] leading-[1]">{{ number_format($service->tax_amount ?? 0, 2, '.', ' ') }} ₸</div>
                        <div class="text-sm font-medium text-[#1E2B28] leading-[1]">{{ number_format($service->prepayment_amount ?? 0, 2, '.', ' ') }} ₸</div>
                        <div class="text-sm font-medium text-[#1E2B28] leading-[1]">{{ number_format($service->full_payment_amount ?? 0, 2, '.', ' ') }} ₸</div>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="md:hidden bg-white rounded-lg shadow-sm mb-3 p-4 accounting-card cursor-pointer hover:bg-gray-50 transition-colors" onclick="openDocumentsModal({{ $service->id }}, '{{ $service->service_no }}')">
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

<!-- Documents Modal -->
<div id="documentsModal" class="fixed inset-0 z-50 flex items-center justify-center hidden" style="background: rgba(0,0,0,0.4);">
    <div class="bg-white w-[800px] h-[600px] mx-4 flex flex-col rounded-lg">
        <!-- Modal content will be loaded here -->
    </div>
</div>

<script>
let currentServiceId = null;
let currentServiceNo = null;

function openDocumentsModal(serviceId, serviceNo) {
    console.log('Opening documents modal for service:', serviceId, serviceNo);
    currentServiceId = serviceId;
    currentServiceNo = serviceNo;
    // Show modal
    document.getElementById('documentsModal').classList.remove('hidden');
    
    // Load modal content via AJAX
    fetch(`/client/service-documents/${serviceId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                renderDocuments(data.documents, data.service_info);
            } else {
                console.error('Error loading service documents:', data.error);
                renderError(data.error);
            }
        })
        .catch(error => {
            console.error('Error loading service documents:', error);
            renderError('Ошибка загрузки документов услуги');
        });
}

function closeDocumentsModal() {
    document.getElementById('documentsModal').classList.add('hidden');
    currentServiceId = null;
    currentServiceNo = null;
}

function renderDocuments(documents, serviceInfo) {
    const modalContent = document.querySelector('#documentsModal .bg-white');
    
    // Отладочная информация
    console.log('Rendering documents:', documents);
    
    let documentsHtml = '';
    
    // Service info header
    documentsHtml += `
        <div class="p-6 border-b bg-gray-50">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Документы УСЛ-${serviceInfo.service_no}</h3>
                <button onclick="closeDocumentsModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-600">Стоимость:</span>
                    <span class="font-medium ml-2">${formatNumber(serviceInfo.amount)} ₸</span>
                </div>
                <div>
                    <span class="text-gray-600">Налог, пошлина:</span>
                    <span class="font-medium ml-2">${formatNumber(serviceInfo.tax_amount)} ₸</span>
                </div>
                <div>
                    <span class="text-gray-600">Предоплата:</span>
                    <span class="font-medium ml-2">${formatNumber(serviceInfo.prepayment_amount)} ₸</span>
                </div>
                <div>
                    <span class="text-gray-600">Полная оплата:</span>
                    <span class="font-medium ml-2">${formatNumber(serviceInfo.full_payment_amount)} ₸</span>
                </div>
            </div>
        </div>
    `;
    
    // Documents content
    documentsHtml += '<div class="flex-1 overflow-y-auto p-6">';
    
    // Client Check documents
    if (documents.client_check && documents.client_check.length > 0) {
        console.log('Rendering client_check documents:', documents.client_check);
        documentsHtml += `
            <div class="mb-6">
                <h4 class="text-base font-medium text-gray-900 mb-3">Проверка клиента</h4>
                <div class="space-y-2">
                    ${documents.client_check.map(doc => renderDocumentItem(doc)).join('')}
                </div>
            </div>
        `;
    }
    
    // Prepayment documents
    if (documents.prepayment && documents.prepayment.length > 0) {
        console.log('Rendering prepayment documents:', documents.prepayment);
        documentsHtml += `
            <div class="mb-6">
                <h4 class="text-base font-medium text-gray-900 mb-3">Предоплата</h4>
                <div class="space-y-2">
                    ${documents.prepayment.map(doc => renderDocumentItem(doc)).join('')}
                </div>
            </div>
        `;
    }
    
    // Full Payment documents
    if (documents.full_payment && documents.full_payment.length > 0) {
        console.log('Rendering full_payment documents:', documents.full_payment);
        documentsHtml += `
            <div class="mb-6">
                <h4 class="text-base font-medium text-gray-900 mb-3">Полная оплата</h4>
                <div class="space-y-2">
                    ${documents.full_payment.map(doc => renderDocumentItem(doc)).join('')}
                </div>
            </div>
        `;
    }
    
    // No documents message
    if ((!documents.client_check || documents.client_check.length === 0) && 
        (!documents.prepayment || documents.prepayment.length === 0) && 
        (!documents.full_payment || documents.full_payment.length === 0)) {
        documentsHtml += `
            <div class="text-center py-8 text-gray-500">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <p class="mt-2 text-sm">Документы не найдены</p>
            </div>
        `;
    }
    
    documentsHtml += '</div>';
    
    modalContent.innerHTML = documentsHtml;
}

function renderDocumentItem(doc) {
    const documentId = doc.document_id || doc.name || 'Неизвестно';
    const documentType = doc.type || 'Документ';
    
    return `
        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
            <div class="flex items-center">
                <span class="text-sm text-gray-600 mr-3">${documentId}</span>
                <span class="text-sm text-gray-900">${documentType}</span>
            </div>
            <div class="flex items-center space-x-2">
                <button class="text-gray-400 hover:text-gray-600" onclick="downloadDocument('${documentId}')">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </button>
            </div>
        </div>
    `;
}

function renderError(error) {
    const modalContent = document.querySelector('#documentsModal .bg-white');
    modalContent.innerHTML = `
        <div class="flex items-center justify-between p-6 border-b">
            <h3 class="text-lg font-medium text-gray-900">Ошибка</h3>
            <button onclick="closeDocumentsModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto p-6">
            <div class="text-center py-8 text-red-500">
                <p>${error}</p>
            </div>
        </div>
    `;
}

function downloadDocument(documentId) {
    console.log('Downloading document:', documentId);
    
    // Определяем тип документа и формируем URL для скачивания
    let downloadUrl = '';
    
    if (documentId.includes('IP') || documentId.includes('Счет фактура')) {
        downloadUrl = '{{ route("client.invoice.downloadPdf") }}?document_id=' + documentId;
    } else if (documentId.includes('ОПЛ') || documentId.includes('Счета на оплату')) {
        downloadUrl = '{{ route("client.paymentInvoice.downloadPdf") }}?document_id=' + documentId;
    } else if (documentId.includes('ДОГ') || documentId.includes('Договор')) {
        downloadUrl = '{{ route("client.agreement.downloadPdf") }}?document_id=' + documentId;
    }
    
    if (downloadUrl) {
        const link = document.createElement('a');
        link.href = downloadUrl;
        link.download = documentId + '.pdf';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    } else {
        console.error('Неизвестный тип документа:', documentId);
        alert('Ошибка: Неизвестный тип документа');
    }
}

function formatNumber(number) {
    return new Intl.NumberFormat('ru-RU', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(number);
}

function filterServices(status) {
    // Update button styles
    document.querySelectorAll('[id^="filter-"]').forEach(btn => {
        btn.classList.remove('bg-gray-200', 'text-text-primary');
        btn.classList.add('text-text-primary');
    });
    
    const activeBtn = document.getElementById(`filter-${status}`);
    if (activeBtn) {
        activeBtn.classList.add('bg-gray-200', 'text-text-primary');
        activeBtn.classList.remove('text-text-primary');
    }
    
    console.log('Filtering by status:', status);
}

// Close modal when clicking outside
document.getElementById('documentsModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDocumentsModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDocumentsModal();
    }
});

// Search functionality
document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchQuery = e.target.value.toLowerCase();
            const accountingCards = document.querySelectorAll('.accounting-card');
            
            accountingCards.forEach(card => {
                const serviceNo = card.querySelector('.service-no')?.textContent.toLowerCase() || '';
                
                const matchesSearch = serviceNo.includes(searchQuery);
                
                if (matchesSearch) {
            card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
});
</script>
@endsection