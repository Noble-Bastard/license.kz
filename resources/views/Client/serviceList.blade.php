@extends('layouts.client-app')

@section('title', 'Услуги')

@section('content')
<div class="min-h-screen bg-gray-50 p-6" x-data="clientServices()" x-init="init()">
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Услуги</h1>
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

    <!-- Services Table -->
    <div class="bg-white rounded-lg shadow">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Номер услуги</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Менеджер</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Статус</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Процесс выполнения</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if(isset($serviceJournalList) && $serviceJournalList->isNotEmpty())
                        @foreach($serviceJournalList as $service)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    УСЛ-{{ $service->service_no }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($service->manager && $service->manager->first_name)
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8">
                                                <div class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center">
                                                    <span class="text-xs font-medium text-gray-700">
                                                        {{ substr($service->manager->first_name, 0, 1) }}{{ substr($service->manager->last_name ?? '', 0, 1) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900">{{ $service->manager->first_name }} {{ $service->manager->last_name }}</div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8">
                                                <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm text-gray-500">Не назначен</div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
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
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClass }}">
                                        {{ $statusText }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusName = $service->serviceStatus->name ?? '';
                                        $progress = 'Шаг 1/7';
                                        $progressText = 'Услуга проверяется менеджером';
                                        
                                        switch(strtolower($statusName)) {
                                            case 'выполнено':
                                            case 'завершено':
                                                $progress = 'Выполнено';
                                                $progressText = 'Выполнено';
                                                break;
                                            case 'проверка':
                                                $progress = 'Шаг 1/3';
                                                $progressText = 'Услуга проверяется менеджером';
                                                break;
                                            case 'выставлен счет':
                                                $progress = 'Требуется оплата';
                                                $progressText = 'Требуется оплата';
                                                break;
                                            case 'создание':
                                                $progress = 'Назначение менеджера';
                                                $progressText = 'Назначение менеджера';
                                                break;
                                            default:
                                                $totalSteps = $service->serviceStepList ? $service->serviceStepList->count() : 7;
                                                $completedSteps = $service->serviceStepList ? $service->serviceStepList->where('is_completed', true)->count() : 1;
                                                $progress = "Шаг {$completedSteps}/{$totalSteps}";
                                                $progressText = 'Услуга проверяется менеджером';
                                                break;
                                        }
                                    @endphp
                                    <div class="text-sm text-gray-900">{{ $progress }}</div>
                                    <div class="text-sm text-gray-500">{{ $progressText }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button @click="openServiceModal('{{ $service->id }}')" 
                                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        Связаться
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                Услуги не найдены
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if(is_object($serviceJournalList) && method_exists($serviceJournalList, 'hasPages') && $serviceJournalList->hasPages())
        <div class="flex justify-center mt-6">
            <nav class="flex items-center space-x-2">
                <button class="px-3 py-2 text-sm font-medium text-white bg-green-600 rounded-md">1</button>
                <button class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">2</button>
                <button class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">3</button>
                <span class="px-3 py-2 text-sm text-gray-500">...</span>
                <button class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">10</button>
            </nav>
        </div>
    @endif
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
            // Filter logic here
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