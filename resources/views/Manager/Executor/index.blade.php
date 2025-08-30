@extends('layouts.figma-app')

@section('content')
<div class="w-full">
	<div class="px-5 py-5" style="padding-left: 20px; padding-right: 20px;">
		<div class="mb-[35px]">
			<div class="flex items-center justify-between gap-[10px] mb-[30px]">
				<h1 class="text-[39px] leading-[1] font-normal tracking-[-0.02em] text-text-primary">Исполнители</h1>
				<div class="flex items-center gap-[11px] px-[16px] pr-[22px] py-[11px] h-[46px] border border-border-light rounded-[60px] bg-white">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M15.8333 15.8333L13.2083 13.2083" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					<input type="text" placeholder="Поиск по номеру услуги или компании" class="bg-transparent border-none outline-none text-[12px] font-medium leading-[1] text-text-primary placeholder:text-text-primary" />
				</div>
			</div>

			<!-- Заголовки колонок -->
			<div class="grid grid-cols-[251px,167px,137px,1fr,100px,120px] items-center px-5 text-[12px] font-semibold text-[#6F6F6F] leading-[1]">
				<div>Имя исполнителя</div>
				<div>E-mail</div>
				<div>Телефон</div>
				<div>Группы</div>
				<div>Ставка в час, ₸</div>
				<div class="text-right">Активность</div>
			</div>
		</div>

		<!-- Список исполнителей -->
		<div class="flex flex-col gap-[10px] px-5 pb-[30px]">
			@foreach($executorList as $executor)
				<div class="bg-white rounded-lg p-5 shadow-sm">
					<div class="grid grid-cols-[251px,167px,137px,1fr,100px,120px] items-center gap-[30px] w-full">
						<!-- Имя -->
						<div class="flex items-center gap-[10px]">
							<div class="w-[26px] h-[26px] rounded-full bg-neutral-300 overflow-hidden">
								<img src="{{ asset('images/user1.png') }}" alt="{{ $executor->full_name }}" class="w-full h-full object-cover"/>
							</div>
							<div class="text-[13px] font-medium text-[#1E2B28] leading-[1] truncate">{{ $executor->full_name }}</div>
						</div>
						<!-- Email -->
						<div class="text-[13px] font-medium text-[#1E2B28] leading-[1]">{{ $executor->email }}</div>
						<!-- Телефон -->
						<div class="text-[13px] font-medium text-[#1E2B28] leading-[1]">{{ $executor->phone ?? '+7 880 765 67 78' }}</div>
						<!-- Группы -->
						<div class="text-[13px] font-medium text-[#1E2B28] leading-[1]">
							@if($executor->groups && $executor->groups->isNotEmpty())
								{{ $executor->groups->pluck('name')->implode(', ') }}
							@else
								—
							@endif
						</div>
						<!-- Ставка -->
						<div class="text-[13px] font-medium text-[#1E2B28] leading-[1]">{{ $executor->hourlyRate ?? 140 }}</div>
						<!-- Статус -->
						<div class="flex items-center justify-end">
							<div class="flex items-center gap-[10px]">
								<div class="w-2 h-2 rounded-full {{ ($executor->is_active ?? true) ? 'bg-[#279760]' : 'bg-neutral-400' }}"></div>
								<span class="text-[13px] font-medium text-[#1E2B28] leading-[1]">{{ ($executor->is_active ?? true) ? 'В сети' : 'Не в сети' }}</span>
							</div>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
</div>
@endsection
