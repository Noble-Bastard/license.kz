@extends('layouts.figma-app')

@section('content')
<div class="w-full" x-data="{ 
    searchQuery: '',
    filterExecutors() {
        const searchQuery = this.searchQuery.toLowerCase();
        const executorCards = document.querySelectorAll('.executor-card');
        
        executorCards.forEach(card => {
            const executorName = card.querySelector('.executor-name')?.textContent.toLowerCase() || '';
            const executorEmail = card.querySelector('.executor-email')?.textContent.toLowerCase() || '';
            const executorPhone = card.querySelector('.executor-phone')?.textContent.toLowerCase() || '';
            const executorGroups = card.querySelector('.executor-groups')?.textContent.toLowerCase() || '';
            
            const matchesSearch = executorName.includes(searchQuery) || 
                                executorEmail.includes(searchQuery) || 
                                executorPhone.includes(searchQuery) ||
                                executorGroups.includes(searchQuery);
            
            if (matchesSearch) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }
}">
	<div class="px-5 py-5" style="padding-left: 20px; padding-right: 20px;">
		<div class="mb-[35px]">
		<div class="flex items-center justify-between gap-[10px] mb-[30px]">
			<h1 class="text-[39px] leading-[1] font-normal tracking-[-0.02em] text-text-primary">Исполнители</h1>
			
			<!-- Mobile: Circle with icon only -->
			<div class="md:hidden flex items-center justify-center w-[46px] h-[46px] border border-border-light rounded-full bg-white cursor-pointer" onclick="document.getElementById('mobileSearchInput').focus()">
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M15.8333 15.8333L13.2083 13.2083" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</div>
			<input id="mobileSearchInput" type="text" class="md:hidden hidden" x-model="searchQuery" @input="filterExecutors()" />
			
			<!-- Desktop: Full search bar -->
			<div class="hidden md:flex items-center gap-[11px] px-[16px] pr-[22px] py-[11px] h-[46px] border border-border-light rounded-[80px] bg-white">
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0">
					<path d="M15.8333 15.8333L13.2083 13.2083" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
				<input type="text" placeholder="Поиск по имени, email, телефону или группам" class="bg-transparent border-none outline-none text-[12px] font-medium leading-[1] text-text-primary placeholder:text-text-primary flex-1" x-model="searchQuery" @input="filterExecutors()" />
			</div>
		</div>
		</div>
	</div>

	<!-- Desktop Headers -->
	<div class="hidden md:grid grid-cols-[300px,250px,200px,1fr,150px,150px] items-center gap-[60px,60px,60px,120px,60px] text-[12px] font-semibold text-[#6F6F6F] leading-[1] bg-white mx-5 px-5 py-3">
		<div>Имя исполнителя</div>
		<div>E-mail</div>
		<div>Телефон</div>
		<div>Группы</div>
		<div>Ставка в час, ₸</div>
		<div>Активность</div>
	</div>

	<!-- Executors List -->
	<div class="py-5 pb-20" style="background-color: var(--color-bg-secondary); width: 100vw; margin-left: calc(-50vw + 50%); min-height: calc(100vh - 200px);">
		<div class="px-[40px]">
			<!-- Список исполнителей -->
			<div class="flex flex-col gap-[10px]">
		@foreach($executorList as $executor)
			<div class="bg-white rounded-lg shadow-sm mb-3 executor-card cursor-pointer hover:shadow-md transition-shadow" onclick="openExecutorModal({{ $executor->id }})">
				<!-- Desktop Table View -->
				<div class="hidden md:grid grid-cols-[300px,250px,200px,1fr,150px,150px] items-center gap-[60px,60px,60px,120px,60px] w-full p-5">
					<!-- Имя -->
					<div class="flex items-center gap-[10px]">
						<div class="w-[26px] h-[26px] rounded-full bg-neutral-300 overflow-hidden">
							<img src="{{ asset('images/user1.png') }}" alt="{{ $executor->full_name }}" class="w-full h-full object-cover"/>
						</div>
						<div class="text-[13px] font-medium text-[#1E2B28] leading-[1] truncate executor-name">{{ $executor->full_name }}</div>
					</div>
					<!-- Email -->
					<div class="text-[13px] font-medium text-[#1E2B28] leading-[1] executor-email">{{ $executor->email }}</div>
					<!-- Телефон -->
					<div class="text-[13px] font-medium text-[#1E2B28] leading-[1] executor-phone">{{ $executor->phone ?? '+7 880 765 67 78' }}</div>
					<!-- Группы -->
					<div class="text-[13px] font-medium text-[#1E2B28] leading-[1] executor-groups">
						@if($executor->groups && $executor->groups->isNotEmpty())
							{{ $executor->groups->pluck('name')->implode(', ') }}
						@else
							—
						@endif
					</div>
					<!-- Ставка -->
					<div class="text-[13px] font-medium text-[#1E2B28] leading-[1]">{{ $executor->hourlyRate ?? 140 }}</div>
					<!-- Статус -->
					<div class="flex items-center gap-[10px]">
						<div class="w-2 h-2 rounded-full {{ ($executor->is_active ?? true) ? 'bg-[#279760]' : 'bg-neutral-400' }}"></div>
						<span class="text-[13px] font-medium text-[#1E2B28] leading-[1]">{{ ($executor->is_active ?? true) ? 'В сети' : 'Не в сети' }}</span>
					</div>
				</div>
				
				<!-- Mobile View -->
				<div class="md:hidden p-4 space-y-3">
					<div class="flex items-center gap-3">
						<div class="w-10 h-10 rounded-full bg-neutral-300 overflow-hidden flex-shrink-0">
							<img src="{{ asset('images/user1.png') }}" alt="{{ $executor->full_name }}" class="w-full h-full object-cover"/>
						</div>
						<div class="flex-1 min-w-0">
							<div class="text-sm font-medium text-[#1E2B28] truncate executor-name">{{ $executor->full_name }}</div>
							<div class="flex items-center gap-2 mt-1">
								<div class="w-2 h-2 rounded-full {{ ($executor->is_active ?? true) ? 'bg-[#279760]' : 'bg-neutral-400' }}"></div>
								<span class="text-xs text-gray-500">{{ ($executor->is_active ?? true) ? 'В сети' : 'Не в сети' }}</span>
							</div>
						</div>
					</div>
					<div class="space-y-2 text-sm">
						<div class="flex justify-between">
							<span class="text-gray-500">Email:</span>
							<span class="text-[#1E2B28] font-medium executor-email">{{ $executor->email }}</span>
						</div>
						<div class="flex justify-between">
							<span class="text-gray-500">Телефон:</span>
							<span class="text-[#1E2B28] font-medium executor-phone">{{ $executor->phone ?? '+7 880 765 67 78' }}</span>
						</div>
						<div class="flex justify-between">
							<span class="text-gray-500">Ставка в час:</span>
							<span class="text-[#1E2B28] font-medium">{{ $executor->hourlyRate ?? 140 }} ₸</span>
						</div>
						@if($executor->groups && $executor->groups->isNotEmpty())
						<div class="pt-2 border-t border-gray-100">
							<span class="text-gray-500 text-xs">Группы:</span>
							<div class="mt-1 flex flex-wrap gap-1 executor-groups">
								@foreach($executor->groups as $group)
								<span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-xs">{{ $group->name }}</span>
								@endforeach
							</div>
						</div>
						@endif
					</div>
				</div>
			</div>
		@endforeach
			</div>
		</div>
	</div>

	<!-- Executor Modal -->
	<div id="executorModal" class="fixed inset-0 bg-black/50 z-50 hidden md:items-center md:justify-center items-end">
	<div class="bg-white w-full md:max-w-md md:mx-4" style="max-height: 90vh; overflow-y: auto;">
		<!-- Header -->
		<div class="p-6">
			<div class="flex items-center justify-between">
				<div class="flex items-center gap-3">
					<div class="w-12 h-12 rounded-full bg-neutral-300 overflow-hidden">
						<img id="modalExecutorAvatar" src="{{ asset('images/user1.png') }}" class="w-full h-full object-cover"/>
					</div>
					<h3 id="modalExecutorName" class="text-xl font-semibold text-gray-900"></h3>
				</div>
				<button onclick="closeExecutorModal()" class="p-1 hover:bg-gray-100 rounded-full transition-colors">
					<svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
					</svg>
				</button>
			</div>
		</div>
		
		<!-- Content -->
		<div class="p-6 space-y-4">
			<!-- Ставка в час -->
			<div>
				<label class="block text-sm font-medium text-gray-700 mb-2">Ставка в час, ₸</label>
				<input type="number" id="modalHourlyRate" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#279760]" />
			</div>
			
			<!-- Контакты -->
			<div>
				<h4 class="text-sm font-medium text-gray-700 mb-2">Контакты</h4>
				<div class="space-y-3">
					<div>
						<div class="text-xs font-medium text-gray-500 mb-1">E-mail</div>
						<div id="modalExecutorEmail" class="text-sm text-gray-900"></div>
					</div>
					<div>
						<div class="text-xs font-medium text-gray-500 mb-1">Телефон</div>
						<div id="modalExecutorPhone" class="text-sm text-gray-900"></div>
					</div>
				</div>
			</div>
			
			<!-- Группы -->
			<div>
				<h4 class="text-sm font-medium text-gray-700 mb-2">Группы</h4>
				<!-- Поиск группы -->
				<div class="flex items-center gap-[11px] px-[16px] pr-[22px] py-[11px] h-[46px] border border-border-light rounded-[80px] bg-white mb-3">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M15.8333 15.8333L13.2083 13.2083" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					<input type="text" id="groupSearch" placeholder="Добавить в группу..." class="bg-transparent border-none outline-none text-[12px] font-medium leading-[1] text-text-primary placeholder:text-text-primary flex-1" />
				</div>
				<!-- Добавленные группы -->
				<div id="executorGroups" class="flex flex-wrap gap-2"></div>
			</div>
		</div>
		
		<!-- Footer -->
		<div class="p-6 flex items-center justify-between">
			<button onclick="saveExecutor()" class="px-6 py-2 bg-[#279760] text-white rounded-full hover:bg-[#218655] transition-colors font-medium">
				Сохранить
			</button>
			<a href="{{ route('Manager.service.message.list') }}" class="px-6 py-2 bg-white border border-gray-300 text-gray-700 rounded-full hover:bg-gray-50 transition-colors font-medium inline-block text-center">
				Связаться
			</a>
		</div>
	</div>
	</div>
</div>
@endsection

@section('js')
<script>
let currentExecutorId = null;

function openExecutorModal(executorId) {
	currentExecutorId = executorId;
	
	// Find executor data from the card
	const card = event.target.closest('.executor-card');
	const name = card.querySelector('.executor-name')?.textContent || '';
	const email = card.querySelector('.executor-email')?.textContent || '';
	const phone = card.querySelector('.executor-phone')?.textContent || '';
	const groups = card.querySelector('.executor-groups')?.textContent || '';
	const hourlyRateElement = card.querySelectorAll('.text-\\[13px\\]')[4];
	const hourlyRate = hourlyRateElement?.textContent || '';
	
	// Populate modal
	document.getElementById('modalExecutorName').textContent = name;
	document.getElementById('modalExecutorEmail').textContent = email;
	document.getElementById('modalExecutorPhone').textContent = phone;
	document.getElementById('modalHourlyRate').value = hourlyRate;
	
	// Show groups
	const groupsContainer = document.getElementById('executorGroups');
	if (groups && groups !== '—') {
		const groupArray = groups.split(', ');
		groupsContainer.innerHTML = groupArray.map(group => `
			<span class="px-3 py-1 bg-[#E9F6EE] text-[#279760] rounded-full text-sm flex items-center gap-2">
				${group}
				<button onclick="removeGroup(this)" class="hover:bg-[#279760] hover:text-white rounded-full p-0.5 transition-colors">
					<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
					</svg>
				</button>
			</span>
		`).join('');
	} else {
		groupsContainer.innerHTML = '<p class="text-sm text-gray-500">Нет групп</p>';
	}
	
	// Show modal
	document.getElementById('executorModal').classList.remove('hidden');
	document.getElementById('executorModal').classList.add('flex');
}

function closeExecutorModal() {
	document.getElementById('executorModal').classList.add('hidden');
	document.getElementById('executorModal').classList.remove('flex');
	currentExecutorId = null;
}

function removeGroup(button) {
	button.closest('span').remove();
}

function saveExecutor() {
	// TODO: Implement save functionality
	alert('Сохранение данных исполнителя...');
	closeExecutorModal();
}

// Close on backdrop click
document.getElementById('executorModal')?.addEventListener('click', function(e) {
	if (e.target === this) {
		closeExecutorModal();
	}
});
</script>
@endsection
