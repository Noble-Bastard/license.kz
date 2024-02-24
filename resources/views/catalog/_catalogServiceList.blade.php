@foreach($catalogItem->serviceCatalogList->sortByDesc('service.name') as $serviceCatalog)
    <div class="subLicense-group col-12 {{isset($singleNode) && $singleNode ? 'p-3 singleNode mb-3' : ''}}">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class=" service_item"  name="service[]"
                   value="{{$serviceCatalog->service->id}}"
                   id="check_{{$serviceCatalog->service->id}}_{{$loop->index}}"
                   {{isset($preSelected) && $preSelected == $serviceCatalog->service->id ? 'checked' : ''}}
            >
            <label class="custom-control-label"
                   for="check_{{$serviceCatalog->service->id}}_{{$loop->index}}">{{$serviceCatalog->service->name}}</label>
        </div>
    </div>
@endforeach