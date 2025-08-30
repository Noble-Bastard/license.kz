@php
    $variant = $variant ?? 'default';
    $size = $size ?? 'md';
    $striped = $striped ?? false;
    $hoverable = $hoverable ?? true;
    $bordered = $bordered ?? true;
    
    $tableClasses = 'min-w-full divide-y divide-border-light';
    $theadClasses = 'bg-neutral-50';
    $tbodyClasses = 'bg-white divide-y divide-border-light';
    
    if ($striped) {
        $tbodyClasses = 'bg-white';
    }
    
    $thClasses = 'px-6 py-3 text-left text-xs font-medium text-text-tertiary uppercase tracking-wider';
    $tdClasses = 'px-6 py-4 whitespace-nowrap text-sm text-text-primary';
    
    if ($hoverable) {
        $trClasses = 'hover:bg-neutral-50 transition-colors';
    } else {
        $trClasses = '';
    }
    
    if ($size === 'sm') {
        $thClasses = 'px-4 py-2 text-left text-xs font-medium text-text-tertiary uppercase tracking-wider';
        $tdClasses = 'px-4 py-2 whitespace-nowrap text-sm text-text-primary';
    } elseif ($size === 'lg') {
        $thClasses = 'px-8 py-4 text-left text-xs font-medium text-text-tertiary uppercase tracking-wider';
        $tdClasses = 'px-8 py-6 whitespace-nowrap text-sm text-text-primary';
    }
@endphp

@php $extraAttributes = $attributes ?? '' @endphp

<div class="overflow-hidden {{ $bordered ? 'shadow ring-1 ring-black ring-opacity-5' : '' }} md:rounded-lg">
    <table class="{{ $tableClasses }}" {!! $extraAttributes !!}>
        @if(isset($head))
            <thead class="{{ $theadClasses }}">
                {{ $head }}
            </thead>
        @endif
        
        <tbody class="{{ $tbodyClasses }}">
            {{ $slot }}
        </tbody>
        
        @if(isset($foot))
            <tfoot class="{{ $theadClasses }}">
                {{ $foot }}
            </tfoot>
        @endif
    </table>
</div>

{{-- Helper components for table cells --}}
@push('table-styles')
<style>
    .table-th {
        @apply {{ $thClasses }};
    }
    .table-td {
        @apply {{ $tdClasses }};
    }
    .table-tr {
        @apply {{ $trClasses }};
        @if($striped)
            @apply odd:bg-white even:bg-neutral-25;
        @endif
    }
</style>
@endpush



