<a
        class="btn btn-success"
        href="{{Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client) ? route('Client.service.message.list') : route('Manager.service.message.list')}}"
        title="
            @if(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client))
                @lang('messages.all.message-manager')
        @else
                @lang('messages.all.message-client')
        @endif
                "
>
    @if(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client))
        @lang('messages.all.message-manager')
    @else
        @lang('messages.all.message-client')
    @endif
    @if($messageCnt > 0)
        <span class="badge badge-danger pull-right message-cnt">{{$messageCnt}}</span>
    @endif
</a>