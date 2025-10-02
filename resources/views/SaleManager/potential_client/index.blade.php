@extends('layouts.figma-sales')

@section('content')
    <div class="px-5 py-6" style="padding-left: 40px; padding-right: 40px;">
        <!-- Page title + Search on same row -->
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-[24px] leading-[1.2] font-semibold text-text-primary">Потенциальные клиенты</h1>
            <div class="hidden md:flex items-center gap-[11px] px-[16px] pr-[22px] py-[11px] h-[46px] border border-border-light rounded-[80px] bg-white mr-2">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.8333 15.8333L13.2083 13.2083" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <input id="sm-pc-search" type="text" placeholder="Поиск по имени, email, телефону" class="bg-transparent border-none outline-none text-[12px] font-medium leading-[1] text-text-primary placeholder:text-text-primary" />
            </div>
        </div>

        <!-- Status pills -->
        <div class="flex items-center gap-2 mb-5 overflow-x-auto md:flex-wrap md:overflow-x-visible">
            @php $activeStatus = request('status'); @endphp
            <a href="{{ route('sale_manager.potential_client.index') }}" class="px-[14px] py-[8px] rounded-[60px] text-xs font-medium transition flex-shrink-0 {{ !$activeStatus ? 'bg-gray-200 text-text-primary' : 'text-text-primary hover:bg-bg-tertiary' }}">
                Все клиенты
            </a>
            <a href="{{ route('sale_manager.potential_client.index', ['status' => 'new']) }}" class="px-[14px] py-[8px] rounded-[60px] text-xs font-medium transition flex-shrink-0 {{ $activeStatus == 'new' ? 'bg-gray-200 text-text-primary' : 'text-text-primary hover:bg-bg-tertiary' }}">
                Новые
            </a>
            <a href="{{ route('sale_manager.potential_client.index', ['status' => 'contacted']) }}" class="px-[14px] py-[8px] rounded-[60px] text-xs font-medium transition flex-shrink-0 {{ $activeStatus == 'contacted' ? 'bg-gray-200 text-text-primary' : 'text-text-primary hover:bg-bg-tertiary' }}">
                Связались
            </a>
            <a href="{{ route('sale_manager.potential_client.index', ['status' => 'account_created']) }}" class="px-[14px] py-[8px] rounded-[60px] text-xs font-medium transition flex-shrink-0 {{ $activeStatus == 'account_created' ? 'bg-gray-200 text-text-primary' : 'text-text-primary hover:bg-bg-tertiary' }}">
                Создан кабинет
            </a>
            <a href="{{ route('sale_manager.potential_client.index', ['status' => 'in_progress']) }}" class="px-[14px] py-[8px] rounded-[60px] text-xs font-medium transition flex-shrink-0 {{ $activeStatus == 'in_progress' ? 'bg-gray-200 text-text-primary' : 'text-text-primary hover:bg-bg-tertiary' }}">
                В работе
            </a>
            <a href="{{ route('sale_manager.potential_client.index', ['status' => 'completed']) }}" class="px-[14px] py-[8px] rounded-[60px] text-xs font-medium transition flex-shrink-0 {{ $activeStatus == 'completed' ? 'bg-gray-200 text-text-primary' : 'text-text-primary hover:bg-bg-tertiary' }}">
                Завершено
            </a>
        </div>

        <!-- Desktop Headers -->
        <div class="hidden md:grid grid-cols-[200px,200px,200px,200px,200px,150px] gap-[60px,60px,60px,60px,60px,0px] items-center bg-white px-5 py-3 mx-5 mb-3">
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Дата</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Имя</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Email</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Телефон</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Услуги</div>
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider text-right pr-5"></div>
        </div>

        <!-- Gray background section -->
        <div class="py-5 pb-20" style="background-color: var(--color-bg-secondary); width: 100vw; margin-left: calc(-50vw + 50%); min-height: calc(100vh - 200px);">
            <div class="px-[40px]">
                @if(isset($potentialClientList) && $potentialClientList->isNotEmpty())
                @foreach($potentialClientList as $potentialClient)
                    <!-- Desktop Card View -->
                    <div class="hidden md:grid grid-cols-[200px,200px,200px,200px,200px,150px] gap-[60px,60px,60px,60px,60px,0px] items-center bg-white rounded-lg shadow-sm mb-3 p-5">
                    <!-- Date -->
                    <div class="flex items-center gap-[10px]">
                        <span class="text-[13px] font-medium text-[#1E2B28] leading-[1]">{{ \App\Data\Helper\Assistant::formatDate($potentialClient->created_at) }}</span>
                    </div>
                    
                    <!-- Name -->
                    <div class="flex items-center gap-[10px]">
                        <span class="text-[13px] font-medium text-[#1E2B28] leading-[1]">{{ $potentialClient->name }}</span>
                    </div>
                    
                    <!-- Email -->
                    <div class="flex items-center gap-[10px]">
                        <span class="text-[13px] font-medium text-[#1E2B28] leading-[1]">{{ $potentialClient->email }}</span>
                    </div>
                    
                    <!-- Phone -->
                    <div class="flex items-center gap-[10px]">
                        @if(!empty($potentialClient->phone))
                            <a href="tel:{{ $potentialClient->phone }}" class="text-[13px] font-medium text-[#1E2B28] leading-[1] hover:underline">{{ $potentialClient->phone }}</a>
                        @else
                            <span class="text-[13px] font-medium text-[#1E2B28] leading-[1]">—</span>
                        @endif
                    </div>
                    
                    <!-- Services -->
                    <div class="flex items-center gap-[10px]">
                        @php
                            $serviceNames = collect($potentialClient->serviceList ?? [])->pluck('name')->filter()->values();
                        @endphp
                        @if($serviceNames->isEmpty())
                            <span class="text-[13px] font-medium text-[#1E2B28] leading-[1]">—</span>
                        @else
                            <div class="flex flex-wrap gap-1">
                                @foreach($serviceNames as $serviceName)
                                    <span class="px-2 py-1 rounded-[8px] bg-bg-tertiary text-[12px] text-text-primary">{{ $serviceName }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    
                    <!-- Action -->
                    <div class="flex items-center justify-end gap-[6px] pr-5">
                        <div class="flex items-center gap-2">
                            @if(!$potentialClient->is_account_generate)
                                <a href="{{ route('sale_manager.potential_client.createCabinet', ['potentialClientId' => $potentialClient->id]) }}"
                                   class="inline-flex items-center gap-2 px-4 py-2 rounded-[20px] border border-border-light text-sm text-text-primary hover:bg-bg-tertiary transition whitespace-nowrap">
                                    Создать кабинет
                                </a>
                            @endif
                            @if(!$potentialClient->is_contacted)
                                <a href="{{ route('sale_manager.potential_client.setContacted', ['potentialClientId' => $potentialClient->id]) }}"
                                   class="inline-flex items-center gap-2 px-4 py-2 rounded-[20px] border border-border-light text-sm text-text-primary hover:bg-bg-tertiary transition whitespace-nowrap">
                                    Связались
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Mobile Card View -->
                <div class="md:hidden bg-white rounded-lg shadow-sm mb-3 p-4">
                    <!-- Header with name and date -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-[10px]">
                            <span class="text-base font-medium text-[#1E2B28] leading-[1]">{{ $potentialClient->name }}</span>
                        </div>
                        <div class="flex items-center gap-[6px] flex-shrink-0">
                            <span class="text-sm font-medium text-[#1E2B28] leading-[1]">{{ \App\Data\Helper\Assistant::formatDate($potentialClient->created_at) }}</span>
                        </div>
                    </div>
                    
                    <!-- Details - Vertical Layout -->
                    <div class="space-y-2">
                        <div class="flex flex-col">
                            <span class="text-xs font-medium text-gray-500 mb-1">Email</span>
                            <span class="text-sm font-medium text-[#1E2B28]">{{ $potentialClient->email }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs font-medium text-gray-500 mb-1">Телефон</span>
                            @if(!empty($potentialClient->phone))
                                <a href="tel:{{ $potentialClient->phone }}" class="text-sm font-medium text-[#1E2B28] hover:underline">{{ $potentialClient->phone }}</a>
                            @else
                                <span class="text-sm font-medium text-[#1E2B28]">—</span>
                            @endif
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs font-medium text-gray-500 mb-1">Услуги</span>
                            @php
                                $serviceNames = collect($potentialClient->serviceList ?? [])->pluck('name')->filter()->values();
                            @endphp
                            @if($serviceNames->isEmpty())
                                <span class="text-sm font-medium text-[#1E2B28]">—</span>
                            @else
                                <div class="flex flex-wrap gap-1">
                                    @foreach($serviceNames as $serviceName)
                                        <span class="px-2 py-1 rounded-[8px] bg-bg-tertiary text-[12px] text-text-primary">{{ $serviceName }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="flex flex-wrap items-center gap-2 pt-2">
                            @if(!$potentialClient->is_account_generate)
                                <a href="{{ route('sale_manager.potential_client.createCabinet', ['potentialClientId' => $potentialClient->id]) }}"
                                   class="inline-flex items-center gap-2 px-3 py-2 rounded-[20px] border border-border-light text-xs text-text-primary hover:bg-bg-tertiary transition whitespace-nowrap">
                                    Создать кабинет
                                </a>
                            @endif
                            @if(!$potentialClient->is_contacted)
                                <a href="{{ route('sale_manager.potential_client.setContacted', ['potentialClientId' => $potentialClient->id]) }}"
                                   class="inline-flex items-center gap-2 px-3 py-2 rounded-[20px] border border-border-light text-xs text-text-primary hover:bg-bg-tertiary transition whitespace-nowrap">
                                    Связались
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center py-12">
                <div class="text-text-secondary">
                    <svg class="mx-auto mb-4" width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 3c-3.866 0-7 3.134-7 7v3.5L3 16v1h18v-1l-2-2.5V10c0-3.866-3.134-7-7-7z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 19a3 3 0 006 0" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <p class="text-lg font-medium">Клиенты не найдены</p>
                    <p class="mt-1">Попробуйте изменить параметры фильтрации</p>
                </div>
            </div>
        @endif

        <!-- Pagination -->
        @if(isset($potentialClientList) && method_exists($potentialClientList, 'hasPages') && $potentialClientList->hasPages())
            <div class="mt-4">
                {{ $potentialClientList->links('components.manager-pagination') }}
            </div>
        @endif
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    const searchInput = document.getElementById('sm-pc-search');
    if (!searchInput) return;
    searchInput.addEventListener('input', function(){
        const q = this.value.toLowerCase();
        const rows = document.querySelectorAll('.hidden.md\\:grid.rounded-lg');
        rows.forEach(row => {
            const date = row.querySelector(':scope > div:nth-child(1)')?.textContent.toLowerCase() || '';
            const name = row.querySelector(':scope > div:nth-child(2)')?.textContent.toLowerCase() || '';
            const email = row.querySelector(':scope > div:nth-child(3)')?.textContent.toLowerCase() || '';
            const phone = row.querySelector(':scope > div:nth-child(4)')?.textContent.toLowerCase() || '';
            const services = row.querySelector(':scope > div:nth-child(5)')?.textContent.toLowerCase() || '';
            const match = date.includes(q) || name.includes(q) || email.includes(q) || phone.includes(q) || services.includes(q);
            row.style.display = match ? '' : 'none';
        });
    });
});
</script>
@endpush