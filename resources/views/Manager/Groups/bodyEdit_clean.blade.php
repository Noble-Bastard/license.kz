@extends('layouts.figma-app')

@section('content')
<div class="w-full" x-data="{ showAddExecutorModal: false }">
    <div class="px-5 py-5" style="padding-left:20px;padding-right:20px;">
        <div class="flex items-center justify-between gap-[10px] mb-[30px]">
            <h1 class="text-[39px] leading-[1] font-normal tracking-[-0.02em] text-text-primary">Управление исполнителями: {{ $executorGroup->name }}</h1>
        </div>
    </div>

    <div class="px-5 pb-20" style="padding-left:20px;padding-right:20px;">
        <div class="bg-white rounded-lg p-6 shadow-sm border border-border-light">
            <!-- Add Executor Form -->
            <div class="mb-8">
                {!! Form::open(['url' => route('Manager.groups.bodyUpdate', $executorGroup->id), 'method' => 'put', 'class' => 'space-y-4']) !!}
                <input name="executor_group_id" type="hidden" value="{{ $executorGroup->id }}"/>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                    <div class="md:col-span-2">
                        {!! Form::label('profile_id', 'Выберите исполнителя', ['class' => 'block text-sm font-medium text-text-primary mb-2']) !!}
                        {!! Form::select('profile_id', $executorList, null, array_merge([
                            'placeholder' => 'Выберите исполнителя...',
                            'class' => 'w-full px-3 py-2 border border-border-light rounded-lg bg-white text-text-primary focus:outline-none focus:ring-2 focus:ring-[#279760] focus:border-transparent'
                        ])) !!}
                        @if ($errors->has('profile_id'))
                            <p class="mt-1 text-sm text-red-600">{{ $errors->first('profile_id') }}</p>
                        @endif
                    </div>
                    <div>
                        {!! Form::submit('Добавить исполнителя', ['class' => 'w-full inline-flex items-center justify-center px-4 py-2 bg-[#279760] text-white rounded-lg hover:bg-[#1f7a4f] transition-colors']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

            <!-- Executors List -->
            <div>
                <h3 class="text-lg font-medium text-text-primary mb-4">Исполнители в группе ({{ $executorGroupBodyList->count() }})</h3>
                <div class="space-y-3">
                    @forelse($executorGroupBodyList as $executorGroupBody)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-border-light">
                            <div class="flex items-center gap-3">
                                <img class="w-10 h-10 rounded-full object-cover" src="{{ asset('images/user1.png') }}" alt="{{ $executorGroupBody->profile_full_name }}"/>
                                <span class="text-text-primary font-medium">{{ $executorGroupBody->profile_full_name }}</span>
                            </div>
                            <button onclick="removeExecutor({{ $executorGroupBody->id }}, '{{ $executorGroupBody->profile_full_name }}')"
                                    class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-500 text-white hover:bg-red-600 transition-colors"
                                    title="Удалить исполнителя">
                                <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 5L5 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5 5L15 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.25 3.75L12.5 7.5L8.75 3.75L3.75 8.75L7.5 12.5L3.75 16.25L7.5 20L11.25 16.25L15 20L20 15L16.25 11.25L20 7.5L16.25 3.75Z" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <p class="text-text-secondary">В группе нет исполнителей</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
function removeExecutor(executorBodyId, executorName) {
    if (confirm('Вы уверены, что хотите удалить исполнителя "' + executorName + '" из группы?')) {
        // Create a form to submit DELETE request
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("Manager.groups.bodyDestroy", ":id") }}'.replace(':id', executorBodyId);

        // Add CSRF token
        var csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);

        // Add method field for DELETE
        var methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);

        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection
