@extends('new.layouts.executor')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Проекты</h1>
    </div>

    <div class="services-tabs">
        @foreach($statusList as $status)
            <a class="tab-btn {{ $service_status_id == $status->id ? 'active' : '' }}"
               href="{{ route('executor.project.list_by_status', ['service_status_id' => $status->id]) }}">
                {{ $status->name }}
            </a>
        @endforeach
    </div>

    <div class="manager-table">
        <div class="table-header">
            <div class="table-header-cell">Описание</div>
            <div class="table-header-cell">Дата</div>
            <div class="table-header-cell">Действия</div>
        </div>

        @if(isset($projectList) && $projectList->isNotEmpty())
            @foreach($projectList->where('project_status_id', $service_status_id) as $project)
                <div class="table-row">
                    <div class="table-cell">{{ $project->description }}</div>
                    <div class="table-cell">{{ \App\Data\Helper\Assistant::formatDate($project->create_date) }}</div>
                    <div class="table-cell">
                        <a href="{{ route('executor.project.show', ['projectId' => $project->id]) }}" class="btn btn-sm btn-primary">Детали</a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="table-row">
                <div class="table-cell" colspan="3">Нет проектов для отображения.</div>
            </div>
        @endif
    </div>

    @if(isset($projectList) && $projectList->hasPages())
        {{ $projectList->links('components.manager-pagination') }}
    @endif
@endsection

@section('js')
    <script>
        //activeTab('executor-project-list');

        $(function () {

        });
    </script>
@endsection