<div class="col-12 mb-3 text-end">
    <a href="{{route('Client.serviceJournal.sendToCheck', ['servicesJournalId'=>$serviceJournal->id])}}"
       class="btn btn-success btn-sm uploadFilesModalOpen">
        @lang('messages.client.send_for_review')
    </a>
</div>
<div class="col-12">
    @foreach($serviceJournal->serviceStepList as $serviceJournalStep)
        <div class="row mb-3">
            <div class="col-12">
                <div class="myService-group-step_description">
                    <span class="pr-1">@lang('messages.all.step') {{$loop->index+1}}:</span> {{$serviceJournalStep->serviceStep->description}}
                </div>

                    @foreach($serviceJournalStep->requiredDocumentByStep() as $requiredDocumentItem)
                    <div class="row pb-3 mb-3 border-bottom">
                        <div class="col-12 col-md-9 mb-3 mb-md-0">{{$loop->index+1}}:{{$requiredDocumentItem->description}}</div>
                        <div class="col-12 col-md-3 text-end">
                            @php
                                $clientDocument = $serviceJournalStep->clientAttachedDocument->first(function ($value, $key) use ($requiredDocumentItem) {
                                    return $value->service_required_document_id == $requiredDocumentItem->id;
                                })
                            @endphp
                            @if($clientDocument)
                                <div class="btn-group-sm">
                                    <a href="/storage_/{{$clientDocument->document->path}}" target="_blank" class="btn btn-success btn-sm">
                                        @lang('messages.all.downloadFile')
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm detachClientDocument" data-journal_id="{{$serviceJournal->id}}" data-href="{{route('Client.deleteDocument', [$serviceJournal->id,$clientDocument->id,0])}}">Удалить</button>
                                </div>
                            @else
                            <button type="button" class="btn btn-success btn-sm uploadFilesModalOpen"
                                    href="{{route('Client._serviceDocList', [$serviceJournalStep->service_step_id, $serviceJournal->id])}}"
                                    data-step_id="{{$serviceJournalStep->service_step_id}}"
                                    data-journal_id="{{$serviceJournal->id}}"
                                    data-document_id="{{$requiredDocumentItem->id}}"
                                    data-document_name="{{$requiredDocumentItem->description}}"
                            >
                                @lang('messages.client.download_document')
                            </button>
                            @endif
                        </div>
                    </div>
                    @endforeach

            </div>
        </div>
    @endforeach
</div>
