@php
    $paginator = $paginator ?? null;
    $size = $size ?? 'md';
    $showInfo = $showInfo ?? true;
    
    if (!$paginator) {
        return;
    }
    
    $sizeClasses = [
        'sm' => 'px-2 py-1 text-xs',
        'md' => 'px-3 py-2 text-sm',
        'lg' => 'px-4 py-3 text-base',
    ];
    
    $pageClasses = 'relative inline-flex items-center border border-border text-text-primary bg-white hover:bg-neutral-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-primary-500 focus:border-primary-500 transition-colors';
    $activePageClasses = 'relative inline-flex items-center border border-primary-500 text-primary-600 bg-primary-50 hover:bg-primary-100 focus:z-10 focus:outline-none focus:ring-1 focus:ring-primary-500 focus:border-primary-500';
    $disabledClasses = 'relative inline-flex items-center border border-border text-text-tertiary bg-neutral-50 cursor-not-allowed';
@endphp

@if($paginator->hasPages())
    <div class="flex items-center justify-between border-t border-border-light bg-white px-4 py-3 sm:px-6">
        @if($showInfo)
            <div class="flex flex-1 justify-between sm:hidden">
                @if($paginator->onFirstPage())
                    <span class="{{ $disabledClasses }} {{ $sizeClasses[$size] }} rounded-md">
                        Предыдущая
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="{{ $pageClasses }} {{ $sizeClasses[$size] }} rounded-md">
                        Предыдущая
                    </a>
                @endif

                @if($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="{{ $pageClasses }} {{ $sizeClasses[$size] }} rounded-md ml-3">
                        Следующая
                    </a>
                @else
                    <span class="{{ $disabledClasses }} {{ $sizeClasses[$size] }} rounded-md ml-3">
                        Следующая
                    </span>
                @endif
            </div>
        @endif

        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            @if($showInfo)
                <div>
                    <p class="text-sm text-text-secondary">
                        Показано
                        <span class="font-medium">{{ $paginator->firstItem() ?: 0 }}</span>
                        по
                        <span class="font-medium">{{ $paginator->lastItem() ?: 0 }}</span>
                        из
                        <span class="font-medium">{{ $paginator->total() }}</span>
                        результатов
                    </p>
                </div>
            @endif

            <div>
                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                    {{-- Previous Page Link --}}
                    @if($paginator->onFirstPage())
                        <span class="{{ $disabledClasses }} {{ $sizeClasses[$size] }} rounded-l-md">
                            <span class="sr-only">Предыдущая</span>
                            <i class="fas fa-chevron-left" aria-hidden="true"></i>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" class="{{ $pageClasses }} {{ $sizeClasses[$size] }} rounded-l-md">
                            <span class="sr-only">Предыдущая</span>
                            <i class="fas fa-chevron-left" aria-hidden="true"></i>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                        @if($page == $paginator->currentPage())
                            <span class="{{ $activePageClasses }} {{ $sizeClasses[$size] }} z-10" aria-current="page">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="{{ $pageClasses }} {{ $sizeClasses[$size] }}" aria-label="Перейти на страницу {{ $page }}">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" class="{{ $pageClasses }} {{ $sizeClasses[$size] }} rounded-r-md">
                            <span class="sr-only">Следующая</span>
                            <i class="fas fa-chevron-right" aria-hidden="true"></i>
                        </a>
                    @else
                        <span class="{{ $disabledClasses }} {{ $sizeClasses[$size] }} rounded-r-md">
                            <span class="sr-only">Следующая</span>
                            <i class="fas fa-chevron-right" aria-hidden="true"></i>
                        </span>
                    @endif
                </nav>
            </div>
        </div>
    </div>
@endif



