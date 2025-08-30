<div class="space-y-6">
    <div class="flex items-start justify-between">
        <div>
            <div class="text-sm text-text-secondary">Услуга</div>
            <div class="mt-1 text-xl font-semibold text-text-primary">{{ $serviceJournal->service_name ?? ('УСЛ-' . $serviceJournal->id) }}</div>
            <div class="mt-1 text-sm text-text-secondary">№ {{ $serviceJournal->service_no }} · {{ \App\Data\Helper\Assistant::formatDate($serviceJournal->create_date) }}</div>
        </div>
        @php
            $__statusName = $serviceJournal->project_status_name ?? $serviceJournal->service_status_name ?? '';
            $__dotColor = '#C2BFBF';
            if (stripos($__statusName, 'работ') !== false) { $__dotColor = '#279760'; }
            elseif (stripos($__statusName, 'провер') !== false) { $__dotColor = '#AD6A00'; }
            elseif (stripos($__statusName, 'заверш') !== false || stripos($__statusName, 'готов') !== false) { $__dotColor = '#279760'; }
        @endphp
        <div class="inline-flex items-center gap-2 px-3 py-2 rounded-full border border-border-light text-sm">
            <span class="inline-block w-2.5 h-2.5 rounded-full" style="background-color: {{ $__dotColor }}"></span>
            <span class="text-text-primary">{{ $serviceJournal->service_status_name }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="rounded-[12px] border border-border-light p-4">
            <div class="text-sm text-text-secondary">Клиент</div>
            <div class="mt-1 text-text-primary">{{ $serviceJournal->client_full_name }}</div>
        </div>
        <div class="rounded-[12px] border border-border-light p-4">
            <div class="text-sm text-text-secondary">Менеджер</div>
            <div class="mt-1 text-text-primary">{{ $serviceJournal->manager_full_name ?? 'Не назначен' }}</div>
        </div>
    </div>

    <div>
        <div class="mb-3 text-sm font-medium text-text-primary">Этапы</div>
        <div class="rounded-[12px] border border-border-light divide-y">
            @forelse($serviceJournalStepList as $step)
                <div class="flex items-center justify-between px-4 py-3">
                    <div class="min-w-0">
                        <div class="text-sm text-text-primary truncate">{{ $step->serviceStep->name ?? ('Этап ' . $step->service_step_no) }}</div>
                        <div class="text-xs text-text-secondary mt-0.5">{{ $step->execution_start_date ? 'c ' . \App\Data\Helper\Assistant::formatDate($step->execution_start_date) : 'не начат' }}</div>
                    </div>
                    <div class="shrink-0">
                        @if(($step->is_completed ?? 0) == 1)
                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-[#E9F6EE] text-xs text-[#279760]">Завершен</span>
                        @else
                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-[#FFF3E6] text-xs text-[#AD6A00]">В процессе</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="px-4 py-6 text-center text-sm text-text-secondary">Этапы не найдены.</div>
            @endforelse
        </div>
    </div>
</div>






