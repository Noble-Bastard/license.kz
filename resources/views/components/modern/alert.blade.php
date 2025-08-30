@php
    $alertClasses = [
        'success' => 'bg-green-50 border-green-200 text-green-800',
        'error' => 'bg-red-50 border-red-200 text-red-800',
        'warning' => 'bg-yellow-50 border-yellow-200 text-yellow-800',
        'info' => 'bg-blue-50 border-blue-200 text-blue-800'
    ];
    
    $iconClasses = [
        'success' => 'fas fa-check-circle text-green-400',
        'error' => 'fas fa-exclamation-circle text-red-400',
        'warning' => 'fas fa-exclamation-triangle text-yellow-400',
        'info' => 'fas fa-info-circle text-blue-400'
    ];
    
    $type = $type ?? 'info';
    $dismissible = $dismissible ?? true;
@endphp

<div x-data="{ show: true }" 
     x-show="show"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform scale-95"
     x-transition:enter-end="opacity-100 transform scale-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 transform scale-100"
     x-transition:leave-end="opacity-0 transform scale-95"
     class="rounded-md border p-4 mb-4 {{ $alertClasses[$type] }}"
     role="alert">
    <div class="flex">
        <div class="flex-shrink-0">
            <i class="{{ $iconClasses[$type] }} text-lg"></i>
        </div>
        <div class="ml-3 flex-1">
            @if(isset($title))
                <h3 class="text-sm font-medium">
                    {{ $title }}
                </h3>
            @endif
            <div class="text-sm {{ isset($title) ? 'mt-2' : '' }}">
                {{ $message ?? $slot }}
            </div>
        </div>
        @if($dismissible)
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button @click="show = false" 
                            type="button" 
                            class="inline-flex rounded-md p-1.5 focus:outline-none focus:ring-2 focus:ring-offset-2 hover:opacity-75 transition-opacity
                                   {{ $type === 'success' ? 'text-green-500 hover:bg-green-100 focus:ring-green-600 focus:ring-offset-green-50' : '' }}
                                   {{ $type === 'error' ? 'text-red-500 hover:bg-red-100 focus:ring-red-600 focus:ring-offset-red-50' : '' }}
                                   {{ $type === 'warning' ? 'text-yellow-500 hover:bg-yellow-100 focus:ring-yellow-600 focus:ring-offset-yellow-50' : '' }}
                                   {{ $type === 'info' ? 'text-blue-500 hover:bg-blue-100 focus:ring-blue-600 focus:ring-offset-blue-50' : '' }}">
                        <span class="sr-only">Закрыть</span>
                        <i class="fas fa-times text-sm"></i>
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>



