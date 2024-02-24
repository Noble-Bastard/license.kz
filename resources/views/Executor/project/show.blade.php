@extends('new.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="title-main">@lang('messages.executor.project') - {{$project->description}}

                </div>

                <div class="card-body">
                    @include('Executor.Task._taskList', ['taskList' => $taskList])
                </div>
            </div>
        </div>
    </div>
@endsection