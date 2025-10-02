@extends('layouts.figma-executor')

@section('content')
    <div class="w-full">
        <div class="flex items-center justify-between px-5 py-5" style="padding-left:20px;padding-right:20px;">
            <h1 class="text-[39px] leading-[1] font-normal tracking-[-0.02em] text-text-primary">Сообщения</h1>
        </div>

        <div class="px-5" style="padding-left:20px;padding-right:20px;">
            <div class="bg-white rounded-lg border border-border-light shadow-md overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-3">
                    <div class="border-r border-border-light p-4">
                        <div class="flex items-center gap-[11px] px-[12px] py-[9px] h-[40px] border border-border-light rounded-[80px] bg-white mb-3">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.8333 15.8333L13.2083 13.2083" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33333 15.8333C12.0152 15.8333 15 12.8486 15 9.16667C15 5.48477 12.0152 2.5 8.33333 2.5C4.65143 2.5 1.66667 5.48477 1.66667 9.16667C1.66667 12.8486 4.65143 15.8333 8.33333 15.8333Z" stroke="#191E1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <input type="text" placeholder="Поиск" class="bg-transparent border-none outline-none text-[12px] font-medium leading-[1] text-text-primary placeholder:text-text-primary" />
                        </div>
                        <div id="messageList" class="space-y-2">
                            @forelse(($taskList ?? []) as $task)
                                <a href="#" class="block rounded-[10px] border border-border-light px-3 py-2 hover:bg-neutral-50 messageWindowLink" data-taskid="{{ $task->id }}">
                                    <div class="text-sm text-text-primary font-medium truncate">Задача #{{ $task->id }}</div>
                                    <div class="text-xs text-text-secondary truncate">{{ $task->description }}</div>
                                    <div class="text-xs text-text-secondary">{{ \App\Data\Helper\Assistant::formatDateTime($task->execution_time) }}</div>
                                </a>
                            @empty
                                <div class="text-xs text-text-secondary">Нет задач</div>
                            @endforelse
                        </div>
                    </div>
                    <div class="md:col-span-2 p-4">
                        <div id="messagePanel">
                            <div class="text-text-secondary">Выберите задачу, чтобы посмотреть сообщения</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $(document).on('click', '.messageWindowLink', function(e){
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('executor.task.messageList') }}',
                    data: { _token: '{{ csrf_token() }}', taskId: $(this).data('taskid') },
                    success: function (data) {
                        $('#messagePanel').html(data);
                        var scrolToElm = $('.msg_container_base .message.unread').first();
                        if(scrolToElm.length === 0){
                            scrolToElm = $('.msg_container_base .message').last();
                        }
                        var container = $('.msg_container_base');
                        if (container.length && scrolToElm.length) {
                            container.scrollTop(scrolToElm.position().top);
                        }
                    }
                });
            });

            $(document).on('click', '#sendMessage', function(){
                $.ajax({
                    type: 'POST',
                    url: '{{ route('executor.task.message.create') }}',
                    data: {
                        _token : "{{ csrf_token() }}",
                        taskId : $(this).data('taskid'),
                        messageContent : $('#messageContent').val()
                    },
                    success: function(data){
                        var container = $('.msg_container_base');
                        container.html(data);
                        var last = container.find('.message').last();
                        if (last.length) container.scrollTop(last.position().top);
                        $('#messageContent').val('').focus();
                    }
                });
            });
        });
    </script>
@endsection






