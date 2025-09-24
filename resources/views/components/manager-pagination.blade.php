@if ($paginator->hasPages())
    <div class="flex flex-col items-center space-y-4">
        <!-- Pagination Info -->
        <div class="text-sm text-gray-500">
            <span>
                Показано {{ $paginator->firstItem() ?? 0 }} - {{ $paginator->lastItem() ?? 0 }} из {{ $paginator->total() }} результатов
            </span>
        </div>

        <!-- Pagination Controls - Only Numbers -->
        <div class="flex items-center space-x-2">
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="inline-flex items-center justify-center w-8 h-8 text-sm font-medium text-gray-500">
                        {{ $element }}
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="inline-flex items-center justify-center w-8 h-8 text-sm font-medium text-white bg-primary-600 rounded-full">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="inline-flex items-center justify-center w-8 h-8 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>
    </div>
@endif
