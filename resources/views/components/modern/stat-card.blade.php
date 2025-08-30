@php
    $title = $title ?? '';
    $value = $value ?? '';
    $change = $change ?? null;
    $changeType = $changeType ?? 'neutral'; // positive, negative, neutral
    $icon = $icon ?? null;
    $iconColor = $iconColor ?? 'primary';
    $href = $href ?? null;
    
    $iconColorClasses = [
        'primary' => 'text-primary-600 bg-primary-100',
        'success' => 'text-green-600 bg-green-100',
        'warning' => 'text-yellow-600 bg-yellow-100',
        'danger' => 'text-red-600 bg-red-100',
        'info' => 'text-blue-600 bg-blue-100',
    ];
    
    $changeClasses = [
        'positive' => 'text-green-600',
        'negative' => 'text-red-600',
        'neutral' => 'text-text-secondary',
    ];
    
    $cardClasses = 'bg-white overflow-hidden shadow-sm rounded-lg border border-border-light transition-all duration-200';
    
    if ($href) {
        $cardClasses .= ' hover:shadow-md hover:-translate-y-1 cursor-pointer';
    }
@endphp

@if($href)
    <a href="{{ $href }}" class="{{ $cardClasses }}">
@else
    <div class="{{ $cardClasses }}">
@endif
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    @if($icon)
                        <div class="flex items-center justify-center h-12 w-12 rounded-md {{ $iconColorClasses[$iconColor] }}">
                            <i class="{{ $icon }} text-xl"></i>
                        </div>
                    @endif
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-text-secondary truncate">{{ $title }}</dt>
                        <dd class="flex items-baseline">
                            <div class="text-2xl font-semibold text-text-primary">{{ $value }}</div>
                            @if($change !== null)
                                <div class="ml-2 flex items-baseline text-sm font-semibold {{ $changeClasses[$changeType] }}">
                                    @if($changeType === 'positive')
                                        <i class="fas fa-arrow-up text-xs mr-1"></i>
                                    @elseif($changeType === 'negative')
                                        <i class="fas fa-arrow-down text-xs mr-1"></i>
                                    @endif
                                    {{ $change }}
                                </div>
                            @endif
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        
        @if(isset($footer))
            <div class="bg-neutral-50 px-6 py-3">
                <div class="text-sm">
                    {{ $footer }}
                </div>
            </div>
        @endif
@if($href)
    </a>
@else
    </div>
@endif



