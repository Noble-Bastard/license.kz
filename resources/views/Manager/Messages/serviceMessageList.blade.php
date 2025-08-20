@extends('new.layouts.manager')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Сообщения</h1>
    </div>

    <div class="messages-container">
        <div class="messages-sidebar">
            <div class="sidebar-header">
                <div class="search-bar">
                    <img src="{{ asset('new/images/manager/icon-search-gray.svg') }}" alt="Search"/>
                    <input type="text" placeholder="Поиск...">
                </div>
            </div>

            <div class="sidebar-tabs">
                <button class="tab-btn active">Исполнители</button>
                <button class="tab-btn">Клиенты</button>
            </div>

            <div class="messages-list">
                @if(isset($serviceMessageList) && $serviceMessageList->isNotEmpty())
                    @foreach($serviceMessageList as $message)
                        <div class="message-item {{ !$message->is_read ? 'unread' : '' }}">
                            <div class="contact-avatar">
                                <img src="{{ $message->client->avatar ?? asset('images/user1.png') }}" alt="Avatar"/>
                                <span class="status-dot online"></span>
                            </div>
                            <div class="message-details">
                                <div class="message-header">
                                    <span class="contact-name">{{ $message->client->full_name ?? 'Клиент' }}</span>
                                    <span class="message-time">{{ $message->last_date ? $message->last_date->format('H:i') : '' }}</span>
                                </div>
                                <div class="message-preview">
                                    <p>{{ Str::limit($message->last_message->content ?? 'Нет сообщений', 30) }}</p>
                                    @if(!$message->is_read)
                                        <span class="unread-count">1</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="no-messages">Нет сообщений для отображения.</p>
                @endif
            </div>
        </div>

        <div class="chat-window">
            <div class="chat-header">
                <div class="contact-info">
                    <div class="contact-avatar">
                        <img src="{{ asset('images/user1.png') }}" alt="Avatar"/>
                        <span class="status-dot online"></span>
                    </div>
                    <div class="contact-details">
                        <span class="contact-name">Данил Минин</span>
                        <span class="contact-status">В сети</span>
                    </div>
                </div>
                <div class="chat-actions">
                    <button><i class="bi bi-three-dots-vertical"></i></button>
                </div>
            </div>

            <div class="chat-body">
                <!-- Chat messages will be loaded here -->
            </div>

            <div class="chat-footer">
                <button class="attach-btn"><i class="bi bi-paperclip"></i></button>
                <input type="text" class="message-input" placeholder="Напишите сообщение...">
                <button class="send-btn"><i class="bi bi-send"></i></button>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        //activeTab('profile');

        $(function () {
            $(document).on('click', '.messageWindowLink', function(e){
                e.preventDefault();

                $.ajax({
                    type: 'GET',
                    url: $(this).attr('href'),
                    success: function(data){
                        $('#messageModal .modal-content').html(data);
                        $('#messageModal').modal('show');

                        var scrolToElm = $('.msg_container_base .message.unread').first();
                        if(scrolToElm.length === 0){
                            scrolToElm = $('.msg_container_base .message').last();
                        }
                        $('.msg_container_base').scrollTo(scrolToElm);
                    }
                });
            });

            $(document).on('click', '#sendMessage', function(e){
                $.ajax({
                    type: 'POST',
                    url: '{{route('Manager.service.message.create')}}',
                    data: {
                        '_token' : "{{ csrf_token() }}",
                        'serviceJournalId' : $(this).data('servicejournalid'),
                        'messageContent' : $('#messageContent').val()
                    },
                    success: function(data){
                        $('.msg_container_base')
                            .html(data)
                            .scrollTo($('.msg_container_base .message').last());

                        $('#messageContent')
                            .val('')
                            .focus();
                    }
                });
            });

            //$this.parents('.panel').find('.card-body').slideDown();
            //https://stackoverflow.com/questions/4006520/using-html5-file-uploads-with-ajax-and-jquery
        });
    </script>
@endsection