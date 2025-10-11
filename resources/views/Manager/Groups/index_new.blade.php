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
                <a href="/manager/manager/groups/create" aria-label="Новая группа"
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
                            <div class="w-8 h-8 rounded-full bg-[#E9F6EE] flex items-center justify-center">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18.3333 15C18.3333 15.442 18.1577 15.866 17.845 16.1785C17.5323 16.491 17.1087 16.6667 16.6667 16.6667H3.33333C2.89131 16.6667 2.46738 16.491 2.15482 16.1785C1.84226 15.866 1.66667 15.442 1.66667 15V5C1.66667 4.55797 1.84226 4.13405 2.15482 3.82149C2.46738 3.50893 2.89131 3.33333 3.33333 3.33333H7.5L9.16667 5.83333H16.6667C17.1087 5.83333 17.5323 6.00893 17.845 6.32149C18.1577 6.63405 18.3333 7.05797 18.3333 7.5V15Z" stroke="#279760" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                        </div>
                        <div class="mb-3">
                            <span class="text-sm text-text-secondary member-count">{{ ($group->members ?? collect())->count() }} исполнителей</span>
                        </div>
                        <div class="flex items-center gap-2 mb-4">
                            @foreach(($group->members ?? collect())->take(4) as $member)
                                <img class="w-8 h-8 rounded-full object-cover" src="{{ $member->avatar ?? asset('images/user1.png') }}" alt="{{ $member->full_name }}"/>
                            @endforeach
                            @if(($group->members ?? collect())->count() > 4)
                                <span class="ml-2 inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#279760] text-white text-sm">+{{ ($group->members->count() - 4) }}</span>
                            @endif
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="/manager/manager/groups/{{ $group->id }}/edit" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#279760] text-white hover:bg-[#1f7a4f] transition-colors" title="Редактировать группу">
                                <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.05 3L13.45 5.39L4.89 13.95L1.89 14.95L2.89 11.95L11.05 3Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 5L15 11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                            <a href="/manager/manager/groups/{{ $group->id }}/bodyEdit" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-500 text-white hover:bg-blue-600 transition-colors" title="Управление исполнителями">
                                <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.25 3.75L12.5 7.5L8.75 3.75L3.75 8.75L7.5 12.5L3.75 16.25L7.5 20L11.25 16.25L15 20L20 15L16.25 11.25L20 7.5L16.25 3.75Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M7.5 12.5L12.5 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                            <button onclick="deleteGroup({{ $group->id }}, '{{ $group->name }}')" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-500 text-white hover:bg-red-600 transition-colors" title="Удалить группу">
                                <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 5L5 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M5 5L15 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18.3333 15C18.3333 15.442 18.1577 15.866 17.845 16.1785C17.5323 16.491 17.1087 16.6667 16.6667 16.6667H3.33333C2.89131 16.6667 2.46738 16.491 2.15482 16.1785C1.84226 15.866 1.66667 15.442 1.66667 15V5C1.66667 4.55797 1.84226 4.13405 2.15482 3.82149C2.46738 3.50893 2.89131 3.33333 3.33333 3.33333H7.5L9.16667 5.83333H16.6667C17.1087 5.83333 17.5323 6.00893 17.845 6.32149C18.1577 6.63405 18.3333 7.05797 18.3333 7.5V15Z" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <p class="text-text-secondary text-lg mb-2">Нет созданных групп</p>
                        <p class="text-text-secondary text-sm">Создайте первую группу исполнителей</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if(isset($groupList) && $groupList->hasPages())
                <div class="flex justify-center items-center mt-8">
                    <div class="flex items-center space-x-2">
                        @php
                            $currentPage = $groupList->currentPage();
                            $lastPage = $groupList->lastPage();
                            $startPage = max(1, $currentPage - 2);
                            $endPage = min($lastPage, $currentPage + 2);
                        @endphp

                        @for($i = $startPage; $i <= $endPage; $i++)
                            <a href="{{ $groupList->url($i) }}" class="w-8 h-8 rounded-full text-sm font-medium flex items-center justify-center {{ $i === $currentPage ? 'bg-[#279760] text-white' : 'bg-white text-text-primary border border-border-light hover:bg-bg-tertiary' }} transition-colors">
                                {{ $i }}
                            </a>
                        @endfor
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
function deleteGroup(groupId, groupName) {
    if (confirm('Вы уверены, что хотите удалить группу "' + groupName + '"?')) {
        // Create a form to submit POST request to the GET route (Laravel will handle it)
        var form = document.createElement('form');
        form.method = 'GET';
        form.action = '/manager/manager/groups/destroy/' + groupId;

        // Add CSRF token
        var csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);

        // Laravel GET routes can handle POST requests due to implicit routing
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection
