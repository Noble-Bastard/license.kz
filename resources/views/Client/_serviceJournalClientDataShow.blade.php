<div class="col-12 services-hdr">
    <div class="row">
        <div class="col-5 services-hdr-show">
            <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true" aria-controls="collapseExample">
                <h5>@lang('messages.client.required_data') <span><i class="fa fa-caret-down"></i></span></h5>

            </a>
        </div>
        <div class="col-7">
            @if(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Client))
            <a href="{{route('Client.serviceJournal.sendToCheck', ['servicesJournalId'=>$serviceJournal->id])}}"
               class="btn btn-success float-right ">@lang('messages.client.send_for_review')</a>
            <a href="{{route('Client.serviceJournal.edit', ['servicesJournalId'=>$serviceJournal->id])}}"
               class="btn btn-success float-right btn-marin-r">@lang('messages.all.edit')</a>
            @elseif(Auth::user()->isUserInRole(\App\Data\Helper\RoleList::Manager) || Auth::user()->isUserInRole(\App\Data\Helper\RoleList::SaleManager))
                <a href="{{route('Client.serviceJournal.edit', ['servicesJournalId'=>$serviceJournal->id])}}"
                   class="btn btn-success float-right btn-marin-r">@lang('messages.client.view')</a>
            @endif
        </div>
    </div>

</div>
@if(!is_null($formGroupList))
    <div class="col-12 services-body collapse" id="collapseExample">
        <div class="row">
            <div class="col-12">
                @foreach($formGroupList->sortBy('order_number')->all() as $formGroup)
                    <div class="card mb-3">
                        <div class="card-header">
                            {{$formGroup->parameter_group_name}}
                        </div>
                        <div class="card-body">
                            @foreach($formParameterList->where('registration_form_group_template_id', $formGroup->parameter_group_id)->sortBy('order_number')->all() as $formParameter)
                                <div class="form-row">
                                    <label class="col-6 control-label">{{$formParameter->caption}}</label>

                                    @if($formParameter->parameter_type_id != 6)
                                        <div class="col-6 elementinline pb-3">
                                            @include('Client._formData', ['_formParameter'=>$formParameter])
                                        </div>
                                    @else
                                        <div class="col-12 elementinline pb-3">
                                            @include('Client._formData', ['_formParameter'=>$formParameter])
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif