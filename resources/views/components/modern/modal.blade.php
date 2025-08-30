@php
    $size = $size ?? 'md';
    $closable = $closable ?? true;
    $backdrop = $backdrop ?? true;
    $title = $title ?? null;
    
    $sizeClasses = [
        'xs' => 'max-w-xs',
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        '2xl' => 'max-w-2xl',
        '3xl' => 'max-w-3xl',
        '4xl' => 'max-w-4xl',
        '5xl' => 'max-w-5xl',
        '6xl' => 'max-w-6xl',
        'full' => 'max-w-full mx-4',
    ];
@endphp

<div x-data="{ open: false }" 
     x-show="open" 
     @open-modal.window="
        console.log('Modal event received:', $event.detail);
        if ($event.detail.name === '{{ $name ?? 'default' }}') {
            console.log('Opening modal: {{ $name ?? 'default' }}');
            open = true;
        }
     "
     @close-modal.window="
        if ($event.detail.name === '{{ $name ?? 'default' }}') {
            console.log('Closing modal: {{ $name ?? 'default' }}');
            open = false;
        }
     "
     @keydown.escape.window="if (open) open = false"
     class="fixed inset-0 z-50 overflow-y-auto" 
     aria-labelledby="modal-title" 
     role="dialog" 
     aria-modal="true">
    
    <!-- Background backdrop -->
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        @if($backdrop)
            <div x-show="open" 
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="open = false"
                 class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" 
                 aria-hidden="true"></div>
        @endif

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <!-- Modal panel -->
        <div x-show="open" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle {{ $sizeClasses[$size] }} sm:w-full">
            
            @if($title || $closable)
                <div class="flex items-center justify-between p-6 border-b border-border-light">
                    @if($title)
                        <h3 class="text-lg font-medium text-text-primary" id="modal-title">
                            {{ $title }}
                        </h3>
                    @else
                        <div></div>
                    @endif
                    
                    @if($closable)
                        <button @click="open = false" 
                                type="button" 
                                class="rounded-md text-text-tertiary hover:text-text-secondary focus:outline-none focus:ring-2 focus:ring-primary-500">
                            <span class="sr-only">Закрыть</span>
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    @endif
                </div>
            @endif

            <!-- Modal body -->
            <div class="p-6">
                {{ $slot }}
            </div>

            @if(isset($footer))
                <div class="px-6 py-4 bg-neutral-50 border-t border-border-light sm:flex sm:flex-row-reverse">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>



