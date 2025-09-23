@extends('layouts.figma-app')

@section('content')
<div class="w-full">
	<div class="px-5 py-5" style="padding-left:20px;padding-right:20px;">
			<div class="flex items-center justify-between gap-[10px] mb-[30px]">
			<h1 class="text-[39px] leading-[1] font-normal tracking-[-0.02em] text-text-primary">Группы</h1>
				<div class="flex items-center gap-3">
					<div class="flex items-center gap-[11px] h-[46px] border border-border-light rounded-[60px] bg-white w-[46px] md:w-[230px] px-0 md:px-[16px] justify-center md:justify-start">
						<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.8333 15.8333L13.2083 13.2083" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
						<input type="text" placeholder="Поиск по названию группы" class="hidden md:block bg-transparent border-0 outline-none text-[12px] font-medium leading-[1] text-[#191E1D] w-full" />
					</div>
					<a href="{{ route('Manager.groups.create') }}" aria-label="Новая группа"
					   class="inline-flex items-center justify-center gap-2 h-[46px] w-[46px] md:w-auto md:px-4 rounded-[60px] text-white text-sm font-medium"
					   style="background-color: #279760; display: inline-flex; align-items: center; gap: 8px; height: 46px; border-radius: 60px; color: white; font-size: 14px; font-weight: 500; text-decoration: none;">
						<svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 4.16675V15.8334" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M4.1665 10H15.8332" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
						<span class="hidden md:inline">Новая группа</span>
					</a>
				</div>
		</div>

		<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
			@forelse($groupList ?? [] as $group)
				<div class="bg-white rounded-lg p-5 shadow-sm border border-border-light">
					<div class="flex items-center justify-between">
						<h3 class="text-[18px] font-medium text-text-primary">{{ $group->name }}</h3>
						<div class="w-8 h-8 rounded-full bg-[#E9F6EE] flex items-center justify-center">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18.3333 15C18.3333 15.442 18.1577 15.866 17.845 16.1785C17.5323 16.491 17.1087 16.6667 16.6667 16.6667H3.33333C2.89131 16.6667 2.46738 16.491 2.15482 16.1785C1.84226 15.866 1.66667 15.442 1.66667 15V5C1.66667 4.55797 1.84226 4.13405 2.15482 3.82149C2.46738 3.50893 2.89131 3.33333 3.33333 3.33333H7.5L9.16667 5.83333H16.6667C17.1087 5.83333 17.5323 6.00893 17.845 6.32149C18.1577 6.63405 18.3333 7.05797 18.3333 7.5V15Z" stroke="#279760" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</div>
					</div>
					<div class="flex items-center gap-2 mt-4">
						@foreach(($group->members ?? collect())->take(4) as $member)
							<img class="w-8 h-8 rounded-full object-cover" src="{{ $member->avatar ?? asset('images/user1.png') }}" alt="{{ $member->full_name }}"/>
						@endforeach
						@if(($group->members ?? collect())->count() > 4)
							<span class="ml-2 inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#279760] text-white text-sm">+{{ ($group->members->count() - 4) }}</span>
						@endif
						<span class="ml-auto text-sm text-text-secondary">{{ ($group->members ?? collect())->count() }} исполнителей</span>
					</div>
				</div>
			@empty
				<p class="text-text-secondary">Нет созданных групп.</p>
			@endforelse
		</div>
	</div>
</div>

@if(isset($groupList) && $groupList->hasPages())
	<div class="flex justify-center items-center mt-8">
		<div class="flex items-center space-x-2">
			@php
				$currentPage = $groupList->currentPage();
				$lastPage = $groupList->lastPage();
			@endphp
			
			@for($i = 1; $i <= $lastPage; $i++)
				<a href="{{ $groupList->url($i) }}" class="w-8 h-8 rounded-full text-sm font-medium flex items-center justify-center {{ $i === $currentPage ? 'bg-[#279760] text-white' : 'bg-white text-text-primary border border-border-light hover:bg-bg-tertiary' }} transition-colors">
					{{ $i }}
				</a>
			@endfor
		</div>
	</div>
@endif
@endsection

@section('js')
@endsection