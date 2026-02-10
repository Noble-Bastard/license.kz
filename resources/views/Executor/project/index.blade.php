@extends('new.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="title-main">Список проектов

                </div>

                <div class="card-body">
                    <div class="row pb-3">
                        <div class="col-6 flex-align-left">
                            <span class="badge badge-primary">@lang('messages.executor.hourly_rate') {{$hourlyRate}}</span>
                        </div>
                        <div class="col-6 flex-align-right">
                            <div class="btn-group btn-group-toggle btn-success-toggle ">
                                @foreach($statusList as $status)
                                    <a  class="btn btn-success {{$service_status_id == $status->id ? 'active' : ''}}" href="{{route('executor.project.list_by_status', ['service_status_id' => $status->id])}}">{{$status->name}}</a>
                                @endforeach
                            </div>
                        </div>

                    </div>
                    <div>
                        <table id="services" class="table table-striped table-responsive-sm col-12">
                            <thead>
                            <tr>
                                <th class="w-90">@lang('messages.all.name')</th>
                                <th class="w-10">@lang('messages.executor.date')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($projectList->Where('project_status_id',$service_status_id) as $project)
                                <tr>
                                    <td>
                                        <a class="messageWindowLink"
                                           href="{{route('executor.project.show', ['projectId'=>$project->id])}}">
                                        {{$project->description}}
                                        </a>
                                    </td>
                                    <td class="text-center">{{\App\Data\Helper\Assistant::formatDate($project->create_date) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="row padding-t-15">
                            <div class="col">
                                {{ $projectList->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        //activeTab('executor-project-list');

        $(function () {

        });
    </script>
@endsection