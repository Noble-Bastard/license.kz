@extends('layouts.modern-app')

@section('title', $catalogRootNode->name)

@section('page-header')
    <div class="py-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('services') }}" 
                       class="inline-flex items-center text-sm font-medium text-text-secondary hover:text-primary-600">
                        <i class="fas fa-home mr-2"></i>
                        Услуги
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-text-tertiary mx-2"></i>
                        <span class="text-sm font-medium text-text-primary">{{ $serviceCategory->description }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div class="flex-1">
                <h1 class="text-3xl font-bold text-text-primary">
                    {{ $serviceCategory->description }}
                </h1>
                <div class="mt-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-100 text-primary-800">
                        <i class="fas fa-certificate mr-2"></i>
                        @lang('messages.pages.services.activity_licensing')
                    </span>
                </div>
                <h2 class="text-xl font-semibold text-text-secondary mt-4">
                    {{ $catalogRootNode->name }}
                </h2>
                
                @if($catalogRootNode->id === 400)
                    <div class="mt-4 p-4 bg-amber-50 border border-amber-200 rounded-lg">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-exclamation-triangle text-amber-600 mt-0.5"></i>
                            <p class="text-sm text-amber-800">@lang('messages.pages.services.note_400')</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Selected Counter -->
            <div class="mt-6 lg:mt-0 lg:ml-8">
                <div class="bg-white rounded-lg border border-border-light p-4 shadow-sm">
                    <div class="flex items-center space-x-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-primary-600" id="selectedCounter">0</div>
                            <div class="text-xs text-text-secondary">Выбрано</div>
                        </div>
                        <button type="button" 
                                id="selectAllBtn"
                                class="px-4 py-2 bg-neutral-100 hover:bg-neutral-200 text-text-primary font-medium rounded-lg transition-colors">
                            <i class="fas fa-check-square mr-2"></i>
                            Выбрать все
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div x-data="catalogData()" x-init="initCatalog()">
    <!-- Instructions -->
    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
        <div class="flex items-start space-x-3">
            <i class="fas fa-info-circle text-blue-600 mt-0.5"></i>
            <div>
                <h3 class="text-sm font-medium text-blue-800 mb-1">@lang('messages.pages.services.mark_necessary')</h3>
                <p class="text-sm text-blue-700">Выберите необходимые лицензии и сравните услуги по их получению</p>
            </div>
        </div>
    </div>

    <!-- Services Form -->
    <form method="get" action="{{ route('services.servicesCompare') }}" class="space-y-6">
        @foreach(collect($catalogRootNode->childNodeList->where('is_visible', 1)->all())->sortBy('name') as $catalogItem)
            <div class="bg-white rounded-lg border border-border-light shadow-sm">
                <!-- Group Header -->
                <div class="px-6 py-4 border-b border-border-light">
                    <div class="flex items-center justify-between">
                        <button type="button" 
                                @click="toggleGroup('{{ $catalogItem->id }}')"
                                class="flex-1 flex items-center justify-between text-left">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-folder text-primary-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-text-primary">{{ $catalogItem->name }}</h3>
                                    <p class="text-sm text-text-secondary">
                                        {{ $catalogItem->childNodeList->where('is_visible', 1)->count() + $catalogItem->serviceCatalogList->count() }} услуг
                                    </p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-down transition-transform duration-200"
                               :class="openGroups.includes('{{ $catalogItem->id }}') ? 'rotate-180' : ''"></i>
                        </button>

                        <div class="ml-4 flex items-center space-x-4">
                            <span class="text-sm text-text-secondary">
                                Выбрано: <span class="font-medium" x-text="getGroupSelectedCount('{{ $catalogItem->id }}')">0</span>
                            </span>
                            <label class="inline-flex items-center">
                                <input type="checkbox" 
                                       class="sr-only group-select-all"
                                       data-group="{{ $catalogItem->id }}"
                                       @change="toggleGroupAll('{{ $catalogItem->id }}', $event.target.checked)">
                                <div class="relative">
                                    <div class="w-5 h-5 bg-white border-2 border-border rounded transition-colors"
                                         :class="isGroupAllSelected('{{ $catalogItem->id }}') ? 'bg-primary-600 border-primary-600' : 'border-border'">
                                        <i class="fas fa-check text-white text-xs absolute inset-0 flex items-center justify-center"
                                           x-show="isGroupAllSelected('{{ $catalogItem->id }}')"></i>
                                    </div>
                                </div>
                                <span class="ml-2 text-sm text-text-secondary">Выбрать все</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Group Content -->
                <div x-show="openGroups.includes('{{ $catalogItem->id }}')" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     class="px-6 py-4">
                    
                    @if($catalogItem->catalog_node_type_id == 1 || $catalogItem->catalog_node_type_id == 8)
                        <!-- Services Grid -->
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @include('catalog._catalogServiceList', ['catalogItem' => $catalogItem, 'singleNode' => false, 'preSelected' => $preSelected])
                            @include('catalog._catalogList', ['catalogRootNode' => $catalogItem, 'preSelected' => $preSelected])
                        </div>
                    @endif
                </div>
            </div>
        @endforeach

        <!-- Bottom Actions -->
        <div class="sticky bottom-0 bg-white border-t border-border-light p-6 shadow-lg">
            <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                <div class="flex items-center space-x-4">
                    <button type="button" 
                            id="selectAllServicesBtn"
                            class="inline-flex items-center px-4 py-2 bg-neutral-100 hover:bg-neutral-200 text-text-primary font-medium rounded-lg transition-colors">
                        <i class="fas fa-check-square mr-2"></i>
                        @lang('messages.all.check_all')
                    </button>
                    <div class="text-sm text-text-secondary">
                        <span>@lang('messages.pages.services.selected'): </span>
                        <span class="font-medium text-primary-600" x-text="getTotalSelectedCount()">0</span>
                    </div>
                </div>

                <button type="submit" 
                        :disabled="getTotalSelectedCount() === 0"
                        class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 disabled:bg-neutral-300 text-white font-medium rounded-lg transition-colors disabled:cursor-not-allowed">
                    <span class="uppercase">@lang('messages.all.next')</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('js')
<script>
function catalogData() {
    return {
        openGroups: [],
        selectedServices: [],

        initCatalog() {
            // Initialize with preselected services
            @if(isset($preSelected) && is_array($preSelected))
                this.selectedServices = @json($preSelected);
            @endif
            this.updateCounters();
        },

        toggleGroup(groupId) {
            const index = this.openGroups.indexOf(groupId);
            if (index > -1) {
                this.openGroups.splice(index, 1);
            } else {
                this.openGroups.push(groupId);
            }
        },

        toggleGroupAll(groupId, isChecked) {
            const groupServices = document.querySelectorAll(`[data-group="${groupId}"] .service-checkbox`);
            groupServices.forEach(checkbox => {
                checkbox.checked = isChecked;
                this.toggleService(checkbox.value, isChecked);
            });
            this.updateCounters();
        },

        toggleService(serviceId, isSelected) {
            const index = this.selectedServices.indexOf(serviceId);
            if (isSelected && index === -1) {
                this.selectedServices.push(serviceId);
            } else if (!isSelected && index > -1) {
                this.selectedServices.splice(index, 1);
            }
        },

        isGroupAllSelected(groupId) {
            const groupServices = document.querySelectorAll(`[data-group="${groupId}"] .service-checkbox`);
            if (groupServices.length === 0) return false;
            
            return Array.from(groupServices).every(checkbox => 
                this.selectedServices.includes(checkbox.value)
            );
        },

        getGroupSelectedCount(groupId) {
            const groupServices = document.querySelectorAll(`[data-group="${groupId}"] .service-checkbox`);
            return Array.from(groupServices).filter(checkbox => 
                this.selectedServices.includes(checkbox.value)
            ).length;
        },

        getTotalSelectedCount() {
            return this.selectedServices.length;
        },

        updateCounters() {
            // Update counter in header
            const counter = document.getElementById('selectedCounter');
            if (counter) {
                counter.textContent = this.getTotalSelectedCount();
            }
        }
    };
}

// Legacy support for existing scripts
document.addEventListener('DOMContentLoaded', function() {
    // Select all button in header
    const selectAllBtn = document.getElementById('selectAllBtn');
    if (selectAllBtn) {
        selectAllBtn.addEventListener('click', function() {
            const allCheckboxes = document.querySelectorAll('.service-checkbox');
            const allChecked = Array.from(allCheckboxes).every(cb => cb.checked);
            
            allCheckboxes.forEach(checkbox => {
                checkbox.checked = !allChecked;
                checkbox.dispatchEvent(new Event('change'));
            });
        });
    }

    // Select all services button
    const selectAllServicesBtn = document.getElementById('selectAllServicesBtn');
    if (selectAllServicesBtn) {
        selectAllServicesBtn.addEventListener('click', function() {
            const allCheckboxes = document.querySelectorAll('.service-checkbox');
            const allChecked = Array.from(allCheckboxes).every(cb => cb.checked);
            
            allCheckboxes.forEach(checkbox => {
                checkbox.checked = !allChecked;
                checkbox.dispatchEvent(new Event('change'));
            });
        });
    }

    // Service checkbox change handler
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('service-checkbox')) {
            // Update Alpine.js data
            const catalogComponent = document.querySelector('[x-data]').__x.$data;
            catalogComponent.toggleService(e.target.value, e.target.checked);
            catalogComponent.updateCounters();
        }
    });
});
</script>
@endsection