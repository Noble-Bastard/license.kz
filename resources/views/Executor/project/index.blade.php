@extends('layouts.figma-executor')

@section('content')
    <div class="w-full">
        <!-- Page header -->
        <div class="flex items-center justify-between px-5 py-5" style="padding-left:20px;padding-right:20px;">
            <h1 class="text-[39px] leading-[1] font-normal tracking-[-0.02em] text-text-primary">Проекты</h1>
            <div class="flex items-center gap-[11px] px-[16px] pr-[22px] py-[11px] h-[46px] border border-border-light rounded-[60px] bg-white">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.8333 15.8333L13.2083 13.2083" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <input type="text" placeholder="Поиск по проектам" class="bg-transparent border-none outline-none text-[12px] font-medium leading-[1] text-text-primary placeholder:text-text-primary" />
            </div>
        </div>

        <!-- Status tabs -->
        <div class="px-5" style="padding-left:20px;padding-right:20px;">
            <div class="flex items-center gap-[10px] mb-[16px]">
                @php $active = $service_status_id ?? null; @endphp
                <a href="{{ route('executor.project.list') }}" class="px-[14px] py-[10px] rounded-[60px] text-[12px] font-medium {{ !$active ? 'bg-[#279760] text-white' : 'bg-white text-text-primary border border-border-light' }}">Все</a>
                @foreach(($statusList ?? []) as $status)
                    <a href="{{ route('executor.project.list_by_status', ['service_status_id' => $status->id]) }}" class="px-[14px] py-[10px] rounded-[60px] text-[12px] font-medium {{ (int)$active === (int)$status->id ? 'bg-[#279760] text-white' : 'bg-white text-text-primary border border-border-light' }}">{{ $status->name }}</a>
                @endforeach
            </div>
        </div>

        <!-- Projects table/list -->
        <div class="mb-6 px-5" style="padding-left:20px;padding-right:20px;">
            <div class="bg-white rounded-lg border border-border-light shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-border-light">
                        <thead class="bg-neutral-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Описание</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Дата</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary uppercase tracking-wider">Действия</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-border-light">
                        @if(isset($projectList) && $projectList->isNotEmpty())
                            @foreach($projectList->where('project_status_id', $service_status_id) as $project)
                                <tr class="hover:bg-neutral-50">
                                    <td class="px-6 py-4 align-top">
                                        <div class="text-sm text-text-primary">{{ $project->description }}</div>
                                    </td>
                                    <td class="px-6 py-4 align-top">
                                        <div class="text-sm text-text-primary">{{ \App\Data\Helper\Assistant::formatDate($project->create_date) }}</div>
                                    </td>
                                    <td class="px-6 py-4 align-top">
                                        <a href="{{ route('executor.project.show', ['projectId' => $project->id]) }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-[10px] border border-border-light text-text-primary text-sm hover:bg-neutral-50">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z" stroke="#191E1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="3" stroke="#191E1D" stroke-width="1.5"/></svg>
                                            Детали
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center text-text-secondary">Нет проектов для отображения.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        @if(isset($projectList) && $projectList->hasPages())
            <div class="px-5" style="padding-left:20px;padding-right:20px;">
                {{ $projectList->links('components.manager-pagination') }}
            </div>
        @endif
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            // Executor projects page scripts can be added here
        });
    </script>
@endsection