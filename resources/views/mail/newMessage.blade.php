<p>
    @lang('messages.mail.new_message')
    @if(!is_null($serviceJournalId))
        <a href="{{route('Client.serviceJournal.show', ['serviceJournalId' => $serviceJournalId])}}">@lang('messages.mail.goto')</a>
    @else
        <a href="{{route('profile')}}">@lang('messages.mail.goto')</a>
    @endif
</p>