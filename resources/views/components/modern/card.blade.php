@php
    $variant = $variant ?? 'default';
    $padding = $padding ?? 'default';
    $shadow = $shadow ?? 'default';
    $hover = $hover ?? false;
    
    $baseClasses = 'bg-white rounded-lg border border-border-light transition-all duration-200';
    
    $variantClasses = [
        'default' => '',
        'outlined' => 'border-2',
        'elevated' => 'border-0',
        'flat' => 'border-0 shadow-none bg-neutral-50',
    ];
    
    $shadowClasses = [
        'none' => '',
        'sm' => 'shadow-sm',
        'default' => 'shadow-md',
        'lg' => 'shadow-lg',
        'xl' => 'shadow-xl',
    ];
    
    $paddingClasses = [
        'none' => '',
        'sm' => 'p-4',
        'default' => 'p-6',
        'lg' => 'p-8',
    ];
    
    $classes = $baseClasses . ' ' . $variantClasses[$variant] . ' ' . $shadowClasses[$shadow] . ' ' . $paddingClasses[$padding];
    
    if ($hover) {
        $classes .= ' hover:shadow-lg hover:-translate-y-1 cursor-pointer';
    }
    
    if (isset($class)) {
        $classes .= ' ' . $class;
    }
@endphp

<div class="{{ $classes }}">
    @if(isset($slot) && trim($slot) !== '')
        {{ $slot }}
    @else
        {!! isset($content) ? $content : '' !!}
    @endif
</div>
<div class="{{ $classes }}">{!! isset($content) ? $content : '' !!}</div>
<div class="{{ $classes }}">{!! isset($content) ? $content : '' !!}</div>