<form method="GET" action="{{$route}}" class="form-inline justify-content-center justify-content-md-start">
    <label class="mr-2 text-center text-md-right">@lang('messages.all.service_status'):</label>
    <select class="form-control form-inline form-control-white"
            name="service_status_type" onchange="this.form.submit()">
        <option value="1" {{$serviceStatusType == \App\Data\Helper\ServiceStatusTypeList::Opened ? 'selected' : ''}}>
            @lang('messages.pages.services.status_type.open')
        </option>
        <option value="2" {{$serviceStatusType == \App\Data\Helper\ServiceStatusTypeList::Closed ? 'selected' : ''}}>
            @lang('messages.pages.services.status_type.close')
        </option>
        <option value="-1" {{$serviceStatusType == \App\Data\Helper\ServiceStatusTypeList::All ? 'selected' : ''}}>
            @lang('messages.pages.services.status_type.all')
        </option>
    </select>
</form>