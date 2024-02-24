<p>
    У услуги {{$serviceJournal->service_no}} изменился статус на - <strong>{{$serviceJournal->serviceStatus->name}}</strong>
</p>
@if($serviceJournal->serviceStatus->id == \App\Data\Helper\ServiceStatusList::Rejected || $serviceJournal->serviceStatus->id == \App\Data\Helper\ServiceStatusList::DataCollection)
    <h3>Причина</h3>
    <p>
        {{$serviceJournal->reject_reason}}
    </p>
@endif