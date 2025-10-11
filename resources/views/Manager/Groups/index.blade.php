@extends('layouts.figma-app')

@section('content')
<div class="w-full" x-data="{ 
    searchQuery: '',
    filterGroups() {
        const searchQuery = this.searchQuery.toLowerCase();
        const groupCards = document.querySelectorAll('.group-card');
        
        groupCards.forEach(card => {
            const groupName = card.querySelector('.group-name')?.textContent.toLowerCase() || '';
            const memberCount = card.querySelector('.member-count')?.textContent.toLowerCase() || '';
            
            const matchesSearch = groupName.includes(searchQuery) || 
                                memberCount.includes(searchQuery);
            
            if (matchesSearch) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }
}">
	<div class="px-5 py-5" style="padding-left:20px;padding-right:20px;">
			<div class="flex items-center justify-between gap-[10px] mb-[30px]">
			<h1 class="text-[39px] leading-[1] font-normal tracking-[-0.02em] text-text-primary">Группы</h1>
				<div class="flex items-center gap-3">
					<div class="flex items-center gap-[11px] h-[46px] border border-border-light rounded-[80px] bg-white w-[46px] md:w-[230px] px-0 md:px-[16px] justify-center md:justify-start">
						<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.8333 15.8333L13.2083 13.2083" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
						<input type="text" placeholder="Поиск по названию группы" class="hidden md:block bg-transparent border-0 outline-none text-[12px] font-medium leading-[1] text-[#191E1D] w-full" x-model="searchQuery" @input="filterGroups()" />
					</div>
					<a href="{{ route('Manager.groups.create') }}" aria-label="Новая группа"
					   class="inline-flex items-center justify-center gap-2 h-[46px] w-[46px] md:w-auto md:px-4 rounded-[60px] text-white text-sm font-medium"
					   style="background-color: #279760; display: inline-flex; align-items: center; gap: 8px; height: 46px; border-radius: 60px; color: white; font-size: 14px; font-weight: 500; text-decoration: none;">
						<svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 4.16675V15.8334" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M4.1665 10H15.8332" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
						<span class="hidden md:inline">Новая группа</span>
					</a>
				</div>
		</div>
	</div>

	<!-- Groups List -->
	<div class="py-5 pb-20" style="background-color: var(--color-bg-secondary); width: 100vw; margin-left: calc(-50vw + 50%); min-height: calc(100vh - 200px);">
		<div class="px-5" style="padding-left:20px;padding-right:20px;">
			<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
				@forelse($groupList ?? [] as $group)
					<div class="bg-white rounded-lg p-5 shadow-sm border border-border-light group-card">
						<div class="flex items-center justify-between mb-4">
							<h3 class="text-[18px] font-medium text-text-primary group-name">{{ $group->name }}</h3>
						</div>
						<div class="mb-3">
							<span class="text-sm text-text-secondary member-count">{{ ($group->members ?? collect())->count() }} исполнителей</span>
						</div>
						<div class="flex items-center gap-2 mt-4">
							@foreach(($group->members ?? collect())->take(4) as $member)
								<img class="w-8 h-8 rounded-full object-cover" src="{{ $member->avatar ?? asset('images/user1.png') }}" alt="{{ $member->full_name }}"/>
@endsection

@section('js')
@endsection