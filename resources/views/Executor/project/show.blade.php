@extends('layouts.figma-executor')

@section('content')
    <div class="w-full">
        <!-- Header -->
        <div class="flex items-center justify-between px-5 py-5" style="padding-left:20px;padding-right:20px;">
            <h1 class="text-[28px] leading-[1.1] font-semibold tracking-[-0.01em] text-text-primary">@lang('messages.executor.project')</h1>
        </div>

        <!-- Card -->
        <div class="px-5" style="padding-left:20px;padding-right:20px;">
            <div class="bg-white rounded-lg border border-border-light shadow-md">
                <div class="px-6 py-4 border-b border-border-light">
                    <div class="text-[18px] font-medium text-text-primary">{{ $project->description }}</div>
                </div>
                <div class="p-6">
                    @include('Executor.Task._taskList', ['taskList' => $taskList])
                </div>
            </div>
        </div>
    </div>
@endsection