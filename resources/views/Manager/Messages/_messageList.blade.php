@foreach($serviceJournalMessagesList as $serviceJournalMessage)
    <div class="row justify-content-{!! ($serviceJournalMessage->created_by_role_id == \App\Data\Helper\RoleList::Client) ? 'end' : 'start'!!}">
        <div class="col-md-6 col-9 message {!! ($serviceJournalMessage->is_read) ? 'read' : 'unread' !!}">
            <time class="mb-2 text-muted">
                <small>{{\App\Data\Helper\Assistant::formatDateTime($serviceJournalMessage->message_create_date)}}</small>
            </time>
            <span class="text-muted">
                {{$serviceJournalMessage->created_by_full_name}}
            </span>
            <div class="card">
                <div class="card-body">
                    <p class="card-text">{{$serviceJournalMessage->message}}</p>
                </div>
            </div>
        </div>
    </div>
@endforeach
