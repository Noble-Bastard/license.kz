@extends('layouts.client-app')

@section('title', 'Услуги')

@section('content')
<div class="w-full" x-data="clientServices()" x-init="init()">
    <!-- Page Header -->
    <div class="flex items-center justify-between px-5 py-3" style="padding-left:20px;padding-right:20px;">
        <h1 class="text-[32px] md:text-[39px] leading-[1] font-normal tracking-[-0.02em] text-text-primary">Услуги</h1>
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

    <!-- Desktop Headers -->
    <div class="hidden md:grid grid-cols-[200px,150px,200px,200px] gap-[60px,120px,60px,0px] items-center mx-5 mb-3 px-5 py-3">
        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Номер услуги</div>
        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Менеджер</div>
        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Статус</div>
        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Процесс выполнения</div>
    </div>

    <!-- Services List -->
    <div class="py-5 pb-20" style="background-color: var(--color-bg-secondary); width: 100vw; margin-left: calc(-50vw + 50%); min-height: calc(100vh - 200px);">
        <div class="px-5" style="padding-left:20px;padding-right:20px;">
            @if(isset($serviceJournalList) && $serviceJournalList->isNotEmpty())
                @foreach($serviceJournalList as $service)
                    <!-- Desktop Card View -->
                    <div class="hidden md:grid grid-cols-[200px,150px,200px,200px] gap-[60px,120px,60px,0px] items-center bg-white rounded-lg shadow-sm mb-3 p-5 service-card">
                        <!-- Service Number -->
                        <div class="flex items-center gap-[10px]">
                            <span class="text-sm font-medium text-[#1E2B28] leading-[1] service-no">УСЛ-{{ $service->service_no }}</span>
                        </div>
                        
                        <!-- Manager -->
                        <div class="flex items-center gap-[10px]">
                            @if($service->manager && $service->manager->first_name)
                                <div class="w-[26px] h-[26px] rounded-full bg-neutral-300 overflow-hidden">
                                    <div class="w-full h-full bg-neutral-300 flex items-center justify-center">
                                        <span class="text-xs font-medium text-gray-700">
                                            {{ substr($service->manager->first_name, 0, 1) }}{{ substr($service->manager->last_name ?? '', 0, 1) }}
                                        </span>
                                    </div>
                                </div>
                                <span class="text-[13px] font-medium text-[#1E2B28] leading-[1] manager-name">{{ $service->manager->first_name }} {{ $service->manager->last_name }}</span>
                            @else
                                <div class="w-[26px] h-[26px] rounded-full bg-neutral-300 overflow-hidden">
                                    <div class="w-full h-full bg-neutral-200 flex items-center justify-center">
                                        <svg class="h-3 w-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <span class="text-[13px] text-gray-500">Не назначен</span>
                            @endif
                        </div>
                        
                        <!-- Status -->
                        <div class="flex items-center gap-[5px]">
                            @php
                                $statusClass = 'bg-gray-100 text-gray-800';
                                $statusText = $service->serviceStatus->name ?? 'Неизвестно';
                                
                                switch(strtolower($statusText)) {
                                    case 'выполнено':
                                    case 'завершено':
                                        $statusClass = 'bg-green-100 text-green-800';
                                        break;
                                    case 'проверка':
                                        $statusClass = 'bg-yellow-100 text-yellow-800';
                                        break;
                                    case 'выставлен счет':
                                        $statusClass = 'bg-red-100 text-red-800';
                                        break;
                                    case 'выполнение услуги':
                                    case 'создание':
                                    default:
                                        $statusClass = 'bg-yellow-100 text-yellow-800';
                                        break;
                                }
                            @endphp
                            <div class="w-2 h-2 rounded-full {{ $statusClass }}"></div>
                            <span class="text-[13px] font-medium text-[#1E2B28] leading-[1]">{{ $statusText }}</span>
                        </div>
                        
                        <!-- Process Execution -->
                        <div class="flex items-center gap-[5px]">
                            @php
                                $totalSteps = $service->serviceStepList ? $service->serviceStepList->count() : 0;
                                $completedSteps = $service->serviceStepList ? $service->serviceStepList->where('is_completed', 1)->count() : 0;
                                $processText = $totalSteps > 0 ? "Шаг {$completedSteps}/{$totalSteps}" : "В процессе";
                            @endphp
                            <span class="text-[13px] font-medium text-[#1E2B28] leading-[1]">{{ $processText }}</span>
                        </div>guiu
                    </div>

                    <!-- Mobile Card View -->
                    <div class="md:hidden bg-white rounded-lg shadow-sm mb-3 p-4 service-card">
                        <!-- Header with service number and status -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-[10px]">
                                <span class="text-base font-medium text-[#1E2B28] leading-[1] service-no">УСЛ-{{ $service->service_no }}</span>
                            </div>
                            <div class="flex items-center gap-[6px] flex-shrink-0">
                                @php
                                    $statusClass = 'bg-gray-100 text-gray-800';
                                    $statusText = $service->serviceStatus->name ?? 'Неизвестно';
                                    
                                    switch(strtolower($statusText)) {
                                        case 'выполнено':
                                        case 'завершено':
                                            $statusClass = 'bg-green-100 text-green-800';
                                            break;
                                        case 'проверка':
                                            $statusClass = 'bg-yellow-100 text-yellow-800';
                                            break;
                                        case 'выставлен счет':
                                            $statusClass = 'bg-red-100 text-red-800';
                                            break;
                                        case 'выполнение услуги':
                                        case 'создание':
                                        default:
                                            $statusClass = 'bg-yellow-100 text-yellow-800';
                                            break;
                                    }
                                @endphp
                                <div class="w-2 h-2 rounded-full {{ $statusClass }}"></div>
                                <span class="text-sm font-medium text-[#1E2B28] leading-[1]">{{ $statusText }}</span>
                            </div>
                        </div>
                        
                        <!-- Details - Vertical Layout -->
                        <div class="space-y-2">
                            <div class="flex flex-col">
                                <span class="text-xs font-medium text-gray-500 mb-1">Дата</span>
                                <span class="text-sm font-medium text-[#1E2B28]">
                                    {{ $service->created_at ? \App\Data\Helper\Assistant::formatDate($service->created_at) : '-' }}
                                </span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs font-medium text-gray-500 mb-1">Менеджер</span>
                                <div class="flex items-center gap-[10px]">
                                    @if($service->manager && $service->manager->first_name)
                                        <div class="w-[32px] h-[32px] rounded-full bg-neutral-300 overflow-hidden flex-shrink-0">
                                            <div class="w-full h-full bg-neutral-300 flex items-center justify-center">
                                                <span class="text-xs font-medium text-gray-700">
                                                    {{ substr($service->manager->first_name, 0, 1) }}{{ substr($service->manager->last_name ?? '', 0, 1) }}
                                                </span>
                                            </div>
                                        </div>
                                        <span class="text-sm font-medium text-[#1E2B28] manager-name">{{ $service->manager->first_name }} {{ $service->manager->last_name }}</span>
                                    @else
                                        <div class="w-[32px] h-[32px] rounded-full bg-neutral-300 overflow-hidden flex-shrink-0">
                                            <div class="w-full h-full bg-neutral-200 flex items-center justify-center">
                                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <span class="text-sm font-medium text-[#1E2B28]">Не назначен</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-white rounded-lg shadow-sm mb-3 p-5">
                    <div class="text-center text-text-secondary">Услуги не найдены</div>
                </div>
            @endif

            <!-- Pagination -->
            @if(is_object($serviceJournalList) && method_exists($serviceJournalList, 'hasPages') && $serviceJournalList->hasPages())
                <div class="flex justify-center items-center mt-8">
                    <div class="flex items-center space-x-2">
                        {{-- Pagination Numbers --}}
                        @php
                            $currentPage = $serviceJournalList->currentPage();
                            $lastPage = $serviceJournalList->lastPage();
                            $startPage = max(1, $currentPage - 2);
                            $endPage = min($lastPage, $currentPage + 2);
                        @endphp
                        
                        @for($i = $startPage; $i <= $endPage; $i++)
                            <button class="w-8 h-8 rounded-full text-sm font-medium {{ $i === $currentPage ? 'bg-[#279760] text-white' : 'bg-white text-text-primary border border-border-light hover:bg-bg-tertiary' }} transition-colors">
                                {{ $i }}
                            </button>
                        @endfor
                    </div>
                </div>
            @endif
        </div>
    </div>
                </div>
                
<!-- Service Detail Modal -->
<div x-show="showServiceModal" 
     x-transition:enter="ease-out duration-300" 
     x-transition:enter-start="opacity-0" 
     x-transition:enter-end="opacity-100"
     x-transition:leave="ease-in duration-200" 
     x-transition:leave-start="opacity-100" 
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto"
     style="display: none;">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="closeServiceModal()"></div>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-6 pt-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900" x-text="'УСЛ-' + selectedService.service_no">УСЛ-000319</h3>
                    <button @click="closeServiceModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="text-sm text-gray-500 mb-6" x-text="'Создана ' + selectedService.created_at">Создана 13.08.2024</div>

                <!-- Manager Contact -->
                <div class="flex items-center mb-6">
                    <div class="flex-shrink-0 h-10 w-10">
                        <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                            <span class="text-sm font-medium text-gray-700" x-text="selectedService.manager_initials">ИИ</span>
                        </div>
                    </div>
                    <div class="ml-3 flex-1">
                        <div class="text-sm font-medium text-gray-900" x-text="selectedService.manager_name">Иван Иванов</div>
                    </div>
                    <button class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                        Связаться
                    </button>
                </div>
                
                <!-- Progress Steps -->
                <div class="space-y-4 mb-6">
                    <!-- Step 1 - Completed -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="h-6 w-6 rounded-full bg-green-500 flex items-center justify-center">
                                <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                </div>
            </div>
                        <div class="ml-3 flex-1">
                            <div class="text-sm font-medium text-gray-900">Предварительная проверка документов</div>
                            <div class="text-xs text-gray-500">13.08.2024 18:58</div>
                        </div>
    </div>

                    <!-- Step 2 - Completed -->
                    <div class="flex items-start">
                                    <div class="flex-shrink-0">
                            <div class="h-6 w-6 rounded-full bg-green-500 flex items-center justify-center">
                                <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                        </div>
                                    </div>
                        <div class="ml-3 flex-1">
                            <div class="text-sm font-medium text-gray-900">Оплата государственной пошлины</div>
                            <div class="text-xs text-gray-500">13.08.2024 18:58</div>
                                    </div>
                                </div>
                                
                    <!-- Step 3 - Current -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="h-6 w-6 rounded-full bg-yellow-500 flex items-center justify-center">
                                <div class="h-2 w-2 rounded-full bg-white"></div>
                            </div>
                                </div>
                        <div class="ml-3 flex-1">
                            <div class="text-sm font-medium text-gray-900">Подача документов на получение лицензии (личное присутствие не требуется)</div>
                            <div class="text-xs text-gray-500">13.08.2024 18:58</div>
                                </div>
                            </div>

                    <!-- Step 4 - Pending -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="h-6 w-6 rounded-full border-2 border-gray-300 bg-white"></div>
                                    </div>
                        <div class="ml-3 flex-1">
                            <div class="text-sm text-gray-500">Проведение обследования уполномоченным органом объекта на соответствие установленным лицензионным требованиям с выездом на место</div>
                            <div class="text-xs text-gray-400">13.08.2024 18:58</div>
                                    </div>
                                </div>

                    <!-- Step 5 - Pending -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="h-6 w-6 rounded-full border-2 border-gray-300 bg-white"></div>
                        </div>
                        <div class="ml-3 flex-1">
                            <div class="text-sm text-gray-500">Получение оригинального комплекта документов (личное присутствие не требуется)*</div>
                            <div class="text-xs text-gray-400">13.08.2024 18:58</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function clientServices() {
    return {
        searchQuery: '',
        filterStatus: 'all',
        showServiceModal: false,
        selectedService: {},

        init() {
            // Initialize component
        },

        filterServices() {
            const searchQuery = this.searchQuery.toLowerCase();
            const serviceCards = document.querySelectorAll('.service-card');
            
            serviceCards.forEach(card => {
                const serviceNo = card.querySelector('.service-no')?.textContent.toLowerCase() || '';
                const managerName = card.querySelector('.manager-name')?.textContent.toLowerCase() || '';
                const companyName = card.querySelector('.company-name')?.textContent.toLowerCase() || '';
                
                const matchesSearch = serviceNo.includes(searchQuery) || 
                                    managerName.includes(searchQuery) || 
                                    companyName.includes(searchQuery);
                
                if (matchesSearch) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        },

        openServiceModal(serviceId) {
            // Find service data from the services list
            const services = @json($serviceJournalList);
            const service = services.find(s => s.id == serviceId);
            
            if (service) {
                this.selectedService = {
                    id: service.id,
                    service_no: service.service_no,
                    manager_name: service.manager ? `${service.manager.first_name} ${service.manager.last_name}` : 'Не назначен',
                    manager_initials: service.manager ? `${service.manager.first_name.charAt(0)}${(service.manager.last_name || '').charAt(0)}` : 'НН',
                    created_at: service.created_at ? new Date(service.created_at).toLocaleDateString('ru-RU') : ''
                };
            } else {
                // Fallback data
                this.selectedService = {
                    id: serviceId,
                    service_no: '000000',
                    manager_name: 'Не назначен',
                    manager_initials: 'НН',
                    created_at: ''
                };
            }
            this.showServiceModal = true;
        },

        closeServiceModal() {
            this.showServiceModal = false;
            this.selectedService = {};
        }
    }
}
</script>
@endpush
@endsection