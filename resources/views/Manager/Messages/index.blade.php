@extends('new.layouts.manager')

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Сообщения</h1>
    </div>

    <!-- Navigation Tabs -->
    <div class="messages-tabs">
        <button class="tab-btn active">Исполнители</button>
        <button class="tab-btn">Клиенты</button>
    </div>

    <!-- Messages List -->
    <div class="messages-list">
        @foreach(range(1, 6) as $index)
            <div class="message-item">
                <div class="message-avatar">
                    <img src="{{ asset('images/user1.png') }}" alt="User" />
                </div>
                <div class="message-info">
                    <div class="message-name">Иван Иванов</div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            // Tab switching
            $('.tab-btn').click(function() {
                $('.tab-btn').removeClass('active');
                $(this).addClass('active');
                // Add your tab switching logic here
            });
            
            // Message item click
            $('.message-item').click(function() {
                // Add your message opening logic here
                console.log('Opening message...');
            });
        });
    </script>
@endsection

