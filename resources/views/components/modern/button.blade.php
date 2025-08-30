@php
    $variant = $variant ?? 'primary';
    $size = $size ?? 'md';
    $type = $type ?? 'button';
    $disabled = $disabled ?? false;
    $loading = $loading ?? false;
    $href = $href ?? null;
    $icon = $icon ?? null;
    $iconPosition = $iconPosition ?? 'left';
    
    $baseClasses = 'inline-flex items-center justify-center font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed';
    
    $variantClasses = [
        'primary' => 'bg-primary-600 text-white hover:bg-primary-700 focus:ring-primary-500 shadow-sm',
        'secondary' => 'bg-white text-text-primary border border-border hover:bg-neutral-50 focus:ring-primary-500 shadow-sm',
        'outline' => 'bg-transparent text-primary-600 border border-primary-300 hover:bg-primary-50 focus:ring-primary-500',
        'ghost' => 'bg-transparent text-text-secondary hover:bg-neutral-100 hover:text-text-primary focus:ring-primary-500',
        'danger' => 'bg-accent-red text-white hover:bg-red-700 focus:ring-red-500 shadow-sm',
        'success' => 'bg-primary-600 text-white hover:bg-primary-700 focus:ring-primary-500 shadow-sm',
        'warning' => 'bg-accent-yellow text-text-primary hover:bg-yellow-400 focus:ring-yellow-500 shadow-sm',
    ];
    
    $sizeClasses = [
        'xs' => 'px-2.5 py-1.5 text-xs',
        'sm' => 'px-3 py-2 text-sm',
        'md' => 'px-4 py-2.5 text-sm',
        'lg' => 'px-6 py-3 text-base',
        'xl' => 'px-8 py-4 text-lg',
    ];
    
    $classes = $baseClasses . ' ' . $variantClasses[$variant] . ' ' . $sizeClasses[$size];
    
    if (isset($class)) {
        $classes .= ' ' . $class;
    }
    
    $content = $content ?? $slot ?? '';
    $extraAttributes = $attributes ?? '';
@endphp

@if($href)
    <a href="{{ $href }}" 
       class="{{ $classes }}"
       @if($disabled) aria-disabled="true" tabindex="-1" @endif
       {!! $extraAttributes !!}>
        @if($loading)
            <i class="fas fa-spinner fa-spin mr-2 text-sm"></i>
        @elseif($icon && $iconPosition === 'left')
            <i class="{{ $icon }} mr-2 text-sm"></i>
        @endif
        
        {!! $content !!}
        
        @if($icon && $iconPosition === 'right')
            <i class="{{ $icon }} ml-2 text-sm"></i>
        @endif
    </a>
    <!-- Debug: href={{ $href }}, content={{ $content }}, classes={{ $classes }}, slot={{ $slot ?? 'NO_SLOT' }} -->
@else
    <button type="{{ $type }}" 
            class="{{ $classes }}"
            @if($disabled || $loading) disabled @endif
            {!! $extraAttributes !!}>
        @if($loading)
            <i class="fas fa-spinner fa-spin mr-2 text-sm"></i>
        @elseif($icon && $iconPosition === 'left')
            <i class="{{ $icon }} mr-2 text-sm"></i>
        @endif
        
        {!! $content !!}
        
        @if($icon && $iconPosition === 'right')
            <i class="{{ $icon }} ml-2 text-sm"></i>
        @endif
    </button>
    <!-- Debug: type={{ $type }}, content={{ $content }}, classes={{ $classes }}, slot={{ $slot ?? 'NO_SLOT' }} -->
@endif

