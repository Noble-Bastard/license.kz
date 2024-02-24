<div>
    <table class="table table-striped table-responsive-sm col-12 col-12">
        <thead>
        <tr>
            <th class="w-10">@lang('messages.all.service_number')</th>
            <th class="w-40">@lang('messages.all.name')</th>
            <th class="w-25">@lang('messages.all.status')</th>
            <th class="w-25">@lang('messages.all.manager')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($serviceJournalList as $serviceJournal)
            <tr>
                <td class="text-center">
                    <a class="messageWindowLink"
                       href="{{route('Client.serviceJournal.show', ['servicesId'=>$serviceJournal->id])}}">
                        №{{$serviceJournal->service_no}}
                    </a>
                </td>
                <td>
                    {{$serviceJournal->service_name}}
                </td>
                <td>
                    {{$serviceJournal->service_status_name}}
                </td>
                <td class="text-center">{{$serviceJournal->manager_full_name}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="pt-2">
    {{$serviceJournalList->links()}}
</div>