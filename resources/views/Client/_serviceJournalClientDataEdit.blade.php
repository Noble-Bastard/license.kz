
@foreach($serviceEntityList as $serviceEntity)
    <div class="col-12 services-hdr">
        <h5>Необходимые данные</h5>
    </div>
    @if(!is_null($serviceEntity->formGroupList))
        <div class="col-12 services-body">
            {!! Form::open(['url' => route('Client.serviceJournal.setData'), 'method' => 'post', 'class' => 'form-horizontal']) !!}
            <input name="serviceJournalId" type="hidden" value="{{$serviceJournal->id}}"/>
            <input name="serviceId" type="hidden" value="{{$serviceEntity->serviceId}}"/>
            @foreach($serviceEntity->formGroupList->sortBy('order_number')->all() as $formGroup)
                <div class="card mb-3">
                    <div class="card-header">
                        {{$formGroup->parameter_group_name}}
                    </div>
                    <div class="card-body">
                        @foreach($serviceEntity->formParameterList->where('registration_form_group_template_id', $formGroup->parameter_group_id)->sortBy('order_number')->all() as $formParameter)
                            @php
                                $fieldData = collect($data)->where('registration_form_parameter_template_id', $formParameter->id)->first();
                            @endphp

                            <div class="form-row">
                                {!! Form::label('paramerId_'.$formParameter->id, $formParameter->caption, ['class' => 'col-xl-3 col-lg-4 col-md-3 col-sm-3 control-label']) !!}
                                @if($formParameter->parameter_type_id != 6)
                                    <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9 elementinline pb-3">
                                        @include('Client._formFieldTemplate', ['_formParameter'=>$formParameter, '_fieldData'=>$fieldData])
                                    </div>
                                @else
                                    <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9">
                                        <button type="button" class="btn btn-success float-right mb-2 addAdditionalTableParam"
                                                data-param="table-parameter-{{$formParameter->id}}">@lang('messages.all.add')
                                        </button>
                                    </div>
                                    <div class="col-12 elementinline pb-3">
                                        @include('Client._formFieldTemplate', ['_formParameter'=>$formParameter, '_fieldData'=>null])
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
            <div class="form-row">
                <div class="col-12">
                    <submitfiled>{!! Form::submit(trans('messages.all.submit'), ['class' => 'btn btn-success float-right']) !!}</submitfiled>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    @endif
@endforeach