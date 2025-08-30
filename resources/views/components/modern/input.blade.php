@php
    $type = $type ?? 'text';
    $name = $name ?? '';
    $id = $id ?? $name;
    $label = $label ?? null;
    $placeholder = $placeholder ?? '';
    $required = $required ?? false;
    $disabled = $disabled ?? false;
    $readonly = $readonly ?? false;
    $value = $value ?? old($name);
    $error = $error ?? null;
    $help = $help ?? null;
    $icon = $icon ?? null;
    $iconPosition = $iconPosition ?? 'left';
    $size = $size ?? 'md';
    $attributes = $attributes ?? '';
    
    // Определяем есть ли ошибка для этого поля
    $hasError = $errors->has($name) || $error;
    $errorMessage = $error ?? $errors->first($name);
    
    $inputClasses = 'block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset transition-colors focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 disabled:bg-neutral-50 disabled:text-text-tertiary disabled:cursor-not-allowed';
    
    if ($hasError) {
        $inputClasses .= ' ring-red-300 placeholder:text-red-300 focus:ring-red-500 text-red-900';
    } else {
        $inputClasses .= ' ring-border placeholder:text-text-tertiary focus:ring-primary-600 text-text-primary';
    }
    
    if ($icon) {
        if ($iconPosition === 'left') {
            $inputClasses .= ' pl-10';
        } else {
            $inputClasses .= ' pr-10';
        }
    }
    
    $sizeClasses = [
        'sm' => 'py-1 text-sm',
        'md' => 'py-1.5 text-sm', 
        'lg' => 'py-2 text-base',
    ];
    
    $inputClasses .= ' ' . $sizeClasses[$size];
@endphp

<div class="space-y-1">
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-text-primary">
            {{ $label }}
            @if($required)
                <span class="text-red-500 ml-1">*</span>
            @endif
        </label>
    @endif

    <div class="relative">
        @if($icon)
            <div class="absolute inset-y-0 {{ $iconPosition === 'left' ? 'left-0 pl-3' : 'right-0 pr-3' }} flex items-center pointer-events-none">
                <i class="{{ $icon }} {{ $hasError ? 'text-red-400' : 'text-text-tertiary' }} text-sm"></i>
            </div>
        @endif

        @if($type === 'textarea')
            <textarea id="{{ $id }}" 
                      name="{{ $name }}" 
                      placeholder="{{ $placeholder }}"
                      class="{{ $inputClasses }} resize-none"
                      @if($required) required @endif
                      @if($disabled) disabled @endif
                      @if($readonly) readonly @endif
                      {{ $attributes }}>{{ $value }}</textarea>
        @elseif($type === 'select')
            <select id="{{ $id }}" 
                    name="{{ $name }}" 
                    class="{{ $inputClasses }}"
                    @if($required) required @endif
                    @if($disabled) disabled @endif
                    {{ $attributes }}>
                @if($placeholder)
                    <option value="">{{ $placeholder }}</option>
                @endif
                {{ $slot }}
            </select>
        @else
            <input type="{{ $type }}" 
                   id="{{ $id }}" 
                   name="{{ $name }}" 
                   value="{{ $value }}"
                   placeholder="{{ $placeholder }}"
                   class="{{ $inputClasses }}"
                   @if($required) required @endif
                   @if($disabled) disabled @endif
                   @if($readonly) readonly @endif
                   {{ $attributes }}>
        @endif
    </div>

    @if($help && !$hasError)
        <p class="text-sm text-text-secondary">{{ $help }}</p>
    @endif

    @if($hasError)
        <p class="text-sm text-red-600">{{ $errorMessage }}</p>
    @endif
</div>



