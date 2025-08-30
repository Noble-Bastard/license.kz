@foreach($catalogItem->serviceCatalogList->sortByDesc('service.name') as $serviceCatalog)
    <div class="service-item {{ isset($singleNode) && $singleNode ? 'single-node' : '' }}" 
         data-group="{{ $catalogItem->id }}">
        <label class="group relative flex items-start p-4 bg-white border border-border-light rounded-lg hover:border-primary-300 hover:shadow-sm transition-all duration-200 cursor-pointer">
            <!-- Checkbox -->
            <div class="flex items-center">
                <input type="checkbox" 
                       class="service-checkbox sr-only" 
                       name="service[]"
                       value="{{ $serviceCatalog->service->id }}"
                       id="check_{{ $serviceCatalog->service->id }}_{{ $loop->index }}"
                       {{ isset($preSelected) && (is_array($preSelected) ? in_array($serviceCatalog->service->id, $preSelected) : $preSelected == $serviceCatalog->service->id) ? 'checked' : '' }}>
                
                <!-- Custom Checkbox -->
                <div class="relative">
                    <div class="w-5 h-5 bg-white border-2 border-border rounded transition-colors group-hover:border-primary-400"
                         :class="selectedServices.includes('{{ $serviceCatalog->service->id }}') ? 'bg-primary-600 border-primary-600' : 'border-border'">
                        <i class="fas fa-check text-white text-xs absolute inset-0 flex items-center justify-center"
                           x-show="selectedServices.includes('{{ $serviceCatalog->service->id }}')"></i>
                    </div>
                </div>
            </div>

            <!-- Service Info -->
            <div class="ml-4 flex-1">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h4 class="text-sm font-medium text-text-primary group-hover:text-primary-700 transition-colors">
                            {{ $serviceCatalog->service->name }}
                        </h4>
                        
                        @if($serviceCatalog->service->description)
                            <p class="text-xs text-text-secondary mt-1 line-clamp-2">
                                {{ Str::limit($serviceCatalog->service->description, 100) }}
                            </p>
                        @endif

                        <!-- Service Tags -->
                        <div class="flex items-center space-x-2 mt-2">
                            @if($serviceCatalog->service->price)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-tenge mr-1"></i>
                                    {{ number_format($serviceCatalog->service->price) }} ₸
                                </span>
                            @endif
                            
                            @if($serviceCatalog->service->deadline_days)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-clock mr-1"></i>
                                    {{ $serviceCatalog->service->deadline_days }} дней
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Service Icon -->
                    <div class="ml-4">
                        <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-certificate text-primary-600 text-sm"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Selection Indicator -->
            <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity"
                 x-show="selectedServices.includes('{{ $serviceCatalog->service->id }}')">
                <div class="w-6 h-6 bg-primary-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-check text-white text-xs"></i>
                </div>
            </div>
        </label>
    </div>
@endforeach