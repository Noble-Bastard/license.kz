@php
    $subItem = $catalogRootNode->childNodeList->first();
    $preSelected = isset($preSelected) ? $preSelected : null;
@endphp

<div class="catalog-list w-full">
    @foreach(collect($catalogRootNode->childNodeList->where('is_visible', 1)->all())->sortBy('name') as $catalogItem)
        @switch($catalogItem->catalog_node_type_id)
            @case(1)
            {{-- Link Type Catalog --}}
            <div class="catalog-link-item">
                <a href="{{ route('services.catalog.list', ['catalogId' => $catalogItem->id]) }}" 
                   class="block p-4 bg-gradient-to-r from-primary-50 to-primary-100 border border-primary-200 rounded-lg hover:from-primary-100 hover:to-primary-200 transition-all duration-200 group">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-primary-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-folder-open text-white"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-semibold text-primary-800 group-hover:text-primary-900">
                                {{ $catalogItem->name }}
                            </h4>
                            <p class="text-xs text-primary-600">Перейти к каталогу</p>
                        </div>
                        <i class="fas fa-arrow-right text-primary-600 group-hover:text-primary-700"></i>
                    </div>
                </a>
            </div>
            @break

            @case(2)
            {{-- Group Link Type Catalog --}}
            <div class="catalog-link-item">
                <a href="{{ route('services.groupList', ['serviceCategoryId' => $catalogItem->pretty_url]) }}" 
                   class="block p-4 bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-lg hover:from-blue-100 hover:to-blue-200 transition-all duration-200 group">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-layer-group text-white"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-semibold text-blue-800 group-hover:text-blue-900">
                                {{ $catalogItem->name }}
                            </h4>
                            <p class="text-xs text-blue-600">Просмотр группы услуг</p>
                        </div>
                        <i class="fas fa-arrow-right text-blue-600 group-hover:text-blue-700"></i>
                    </div>
                </a>
            </div>
            @break

            @case(8)
            {{-- Expandable Catalog Type --}}
            <div class="catalog-expandable-item bg-white border border-border-light rounded-lg mb-4" 
                 data-group="{{ $catalogItem->id }}">
                <!-- Sub-group Header -->
                <div class="px-4 py-3 border-b border-border-light bg-neutral-50 rounded-t-lg">
                    <div class="flex items-center justify-between">
                        <button type="button" 
                                @click="toggleGroup('sub_{{ $catalogItem->id }}')"
                                class="flex-1 flex items-center justify-between text-left">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-sitemap text-amber-600 text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-text-primary">{{ $catalogItem->name }}</h4>
                                    <p class="text-xs text-text-secondary">
                                        {{ $catalogItem->childNodeList->where('is_visible', 1)->count() + $catalogItem->serviceCatalogList->count() }} элементов
                                    </p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-down text-text-tertiary transition-transform duration-200"
                               :class="openGroups.includes('sub_{{ $catalogItem->id }}') ? 'rotate-180' : ''"></i>
                        </button>

                        <div class="ml-4 flex items-center space-x-3">
                            <span class="text-xs text-text-secondary">
                                Выбрано: <span class="font-medium" x-text="getGroupSelectedCount('{{ $catalogItem->id }}')">0</span>
                            </span>
                            <label class="inline-flex items-center">
                                <input type="checkbox" 
                                       class="sr-only sub-group-select-all"
                                       data-group="{{ $catalogItem->id }}"
                                       @change="toggleGroupAll('{{ $catalogItem->id }}', $event.target.checked)">
                                <div class="relative">
                                    <div class="w-4 h-4 bg-white border border-border rounded transition-colors"
                                         :class="isGroupAllSelected('{{ $catalogItem->id }}') ? 'bg-primary-600 border-primary-600' : 'border-border'">
                                        <i class="fas fa-check text-white text-xs absolute inset-0 flex items-center justify-center"
                                           x-show="isGroupAllSelected('{{ $catalogItem->id }}')"></i>
                                    </div>
                                </div>
                                <span class="ml-2 text-xs text-text-secondary">Все</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Sub-group Content -->
                <div x-show="openGroups.includes('sub_{{ $catalogItem->id }}')" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="p-4">
                    
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-3">
                        {{-- Include Services --}}
                        @include('catalog._catalogServiceList', ['catalogItem' => $catalogItem, 'singleNode' => false, 'preSelected' => $preSelected])

                        {{-- Include Nested Catalogs --}}
                        @include('catalog._catalogList', ['catalogRootNode' => $catalogItem, 'preSelected' => $preSelected])
                    </div>
                </div>
            </div>
            @break

            @default
            {{-- Default catalog item display --}}
            <div class="catalog-default-item">
                <div class="p-3 bg-neutral-50 border border-neutral-200 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-neutral-400 rounded-lg flex items-center justify-center">
                            <i class="fas fa-file text-white text-sm"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-text-primary">{{ $catalogItem->name }}</h4>
                            <p class="text-xs text-text-secondary">Тип: {{ $catalogItem->catalog_node_type_id }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endswitch
    @endforeach
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>