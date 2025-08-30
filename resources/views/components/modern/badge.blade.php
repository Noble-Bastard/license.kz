@php
    $variant = $variant ?? 'default';
    $size = $size ?? 'md';
    $icon = $icon ?? null;
    $dot = $dot ?? false;
    
    $baseClasses = 'inline-flex items-center font-medium rounded-full';
    
    $variantClasses = [
        'default' => 'bg-neutral-100 text-text-secondary',
        'primary' => 'bg-primary-100 text-primary-800',
        'success' => 'bg-green-100 text-green-800',
        'warning' => 'bg-yellow-100 text-yellow-800',
        'danger' => 'bg-red-100 text-red-800',
        'info' => 'bg-blue-100 text-blue-800',
        'dark' => 'bg-gray-100 text-gray-800',
        
        // Outline variants
        'outline-default' => 'bg-transparent text-text-secondary border border-border',
        'outline-primary' => 'bg-transparent text-primary-600 border border-primary-300',
        'outline-success' => 'bg-transparent text-green-600 border border-green-300',
        'outline-warning' => 'bg-transparent text-yellow-600 border border-yellow-300',
        'outline-danger' => 'bg-transparent text-red-600 border border-red-300',
        'outline-info' => 'bg-transparent text-blue-600 border border-blue-300',
    ];
    
    $sizeClasses = [
        'sm' => 'px-2 py-0.5 text-xs',
        'md' => 'px-2.5 py-0.5 text-xs',
        'lg' => 'px-3 py-1 text-sm',
    ];
    
    $dotColors = [
        'default' => 'bg-text-secondary',
        'primary' => 'bg-primary-600',
        'success' => 'bg-green-500',
        'warning' => 'bg-yellow-500',
        'danger' => 'bg-red-500',
        'info' => 'bg-blue-500',
        'dark' => 'bg-gray-500',
        'outline-default' => 'bg-text-secondary',
        'outline-primary' => 'bg-primary-600',
        'outline-success' => 'bg-green-500',
        'outline-warning' => 'bg-yellow-500',
        'outline-danger' => 'bg-red-500',
        'outline-info' => 'bg-blue-500',
    ];
    
    $classes = $baseClasses . ' ' . $variantClasses[$variant] . ' ' . $sizeClasses[$size];
    
    if (isset($class)) {
        $classes .= ' ' . $class;
    }
    $extraAttributes = $attributes ?? '';
    $content = $content ?? $slot ?? '';
@endphp

<span class="{{ $classes }}" {!! $extraAttributes !!}>
    @if($dot)
        <span class="w-1.5 h-1.5 {{ $dotColors[$variant] }} rounded-full mr-1.5"></span>
    @endif
    
    @if($icon)
        <i class="{{ $icon }} {{ $size === 'sm' ? 'text-xs' : 'text-xs' }} mr-1"></i>
    @endif
    
    {!! $content !!}
</span>



