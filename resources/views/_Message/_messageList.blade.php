{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: r.biewald--}}
 {{--* Date: 21.08.2018--}}
 {{--* Time: 22:58--}}
 {{--*/--}}

@foreach($messagesList as $message)
    <div class="row justify-content-{!! (\Illuminate\Support\Facades\Auth::id() == $message->created_by) ? 'end' : 'start'!!}">
        <div class="col-md-6 col-9 message {!! ($message->is_read) ? 'read' : 'unread' !!}">
            <time class="mb-2 text-muted">
                <small>{{\App\Data\Helper\Assistant::formatDateTime($message->message_create_date)}}</small>
            </time>
            <span class="text-muted">
                {{$message->created_by_full_name}}
            </span>
            <div class="card">
                <div class="card-body">
                    <p class="card-text">{{$message->message}}</p>
                </div>
            </div>
        </div>
    </div>
@endforeach