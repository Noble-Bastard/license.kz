@extends('layouts.figma-sales')

@section('content')
    <div class="px-5 py-6" style="padding-left: 40px; padding-right: 40px;">
        <!-- Page title and actions -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-[24px] leading-[1.2] font-semibold text-text-primary">Потенциальные клиенты</h1>
                <p class="mt-1 text-sm text-text-secondary">Заявки с сайта и их статусы</p>
            </div>
        </div>

        <!-- Filters row: search -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-5">
            <!-- Search -->
            <div class="relative w-full md:max-w-[360px]">
                <input type="text" placeholder="Поиск по имени, email или телефону"
                       class="w-full h-[48px] rounded-[14px] border border-border-light bg-white pl-12 pr-4 text-sm text-text-primary placeholder-text-muted outline-none focus:ring-2 focus:ring-primary/20"/>
                <svg class="absolute left-4 top-1/2 -translate-y-1/2" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.58333 16.25C13.0651 16.25 15.9167 13.3984 15.9167 9.91667C15.9167 6.43492 13.0651 3.58333 9.58333 3.58333C6.10158 3.58333 3.25 6.43492 3.25 9.91667C3.25 13.3984 6.10158 16.25 9.58333 16.25Z" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16.75 17.0833L14.4167 14.75" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>

        <!-- Card with table -->
        <div class="bg-white rounded-[14px] border border-border-light overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-bg-secondary">
                        <tr>
                            <th class="text-left text-xs font-medium text-text-secondary px-6 py-3">Дата</th>
                            <th class="text-left text-xs font-medium text-text-secondary px-6 py-3">Имя</th>
                            <th class="text-left text-xs font-medium text-text-secondary px-6 py-3">Email</th>
                            <th class="text-left text-xs font-medium text-text-secondary px-6 py-3">Телефон</th>
                            <th class="text-left text-xs font-medium text-text-secondary px-6 py-3">Услуги</th>
                            <th class="text-left text-xs font-medium text-text-secondary px-6 py-3">Действия</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-light">
                        @forelse(($potentialClientList ?? collect()) as $potentialClient)
                            <tr class="hover:bg-bg-tertiary/30">
                                <td class="px-6 py-4 text-sm text-text-primary">{{ \App\Data\Helper\Assistant::formatDate($potentialClient->created_at) }}</td>
                                <td class="px-6 py-4 text-sm text-text-primary">{{ $potentialClient->name }}</td>
                                <td class="px-6 py-4 text-sm text-text-primary">{{ $potentialClient->email }}</td>
                                <td class="px-6 py-4 text-sm text-text-primary">
                                    @if(!empty($potentialClient->phone))
                                        <a href="tel:{{ $potentialClient->phone }}" class="text-primary hover:underline">{{ $potentialClient->phone }}</a>
                                    @else
                                        <span class="text-text-secondary">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-text-primary">
                                    @php
                                        $serviceNames = collect($potentialClient->serviceList ?? [])->pluck('name')->filter()->values();
                                    @endphp
                                    @if($serviceNames->isEmpty())
                                        <span class="text-text-secondary">—</span>
                                    @else
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($serviceNames as $serviceName)
                                                <span class="px-2 py-1 rounded-[8px] bg-bg-tertiary text-[12px] text-text-primary">{{ $serviceName }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        @if(!$potentialClient->is_account_generate)
                                            <a href="{{ route('sale_manager.potential_client.createCabinet', ['potentialClientId' => $potentialClient->id]) }}"
                                               class="inline-flex items-center gap-2 px-3 py-2 rounded-[10px] border border-border-light text-sm text-text-primary hover:bg-bg-tertiary transition">
                                                Создать кабинет
                                            </a>
                                        @endif
                                        @if(!$potentialClient->is_contacted)
                                            <a href="{{ route('sale_manager.potential_client.setContacted', ['potentialClientId' => $potentialClient->id]) }}"
                                               class="inline-flex items-center gap-2 px-3 py-2 rounded-[10px] border border-border-light text-sm text-text-primary hover:bg-bg-tertiary transition">
                                                Связались
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-sm text-text-secondary">Нет записей для отображения.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if(isset($potentialClientList) && method_exists($potentialClientList, 'hasPages') && $potentialClientList->hasPages())
            <div class="mt-4">
                {{ $potentialClientList->links('components.manager-pagination') }}
            </div>
        @endif
    </div>
@endsection