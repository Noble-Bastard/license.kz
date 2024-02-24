@switch($_formParameter->parameter_type_id)
    @case(1)
    {!! Form::text(
        'paramerId_'.$_formParameter->id,
        is_null($_fieldData) ? null : $_fieldData->parameter_formatted_value,
        array_merge([
            'class' => $errors->has('paramerId_'.$_formParameter->id) ? 'form-control is-invalid' : 'form-control',
            'placeholder' => $_formParameter->parameter_text_default_value
            ],
            $errors->has('paramerId_'.$_formParameter->id) ?['autofocus' =>  'autofocus'] : []
        )
    ) !!}
    @break
    @case(2)
    {!! Form::number(
        'paramerId_'.$_formParameter->id,
        is_null($_fieldData) ? null : $_fieldData->parameter_number_value,
        array_merge([
            'class' => $errors->has('paramerId_'.$_formParameter->id) ? 'form-control is-invalid' : 'form-control',
            'min' => (!is_null($_formParameter->parameter_number_min_value)) ? $_formParameter->parameter_number_min_value : '',
            'max' => (!is_null($_formParameter->parameter_number_max_value)) ? $_formParameter->parameter_number_max_value : '',
            ],
            $errors->has('paramerId_'.$_formParameter->id) ?['autofocus' =>  'autofocus'] : []
        )
    ) !!}
    @break
    @case(3)
    <div class="input-group">
        {!! Form::text(
            'paramerId_'.$_formParameter->id,
             is_null($_fieldData) ? null : $_fieldData->parameter_datetime_value,
            array_merge([
                'class' => $errors->has('paramerId_'.$_formParameter->id) ? 'form-control datepicker is-invalid' : 'form-control datepicker',
                ],
                $errors->has('paramerId_'.$_formParameter->id) ?['autofocus' =>  'autofocus'] : []
            )
        ) !!}
        <div class="input-group-append">
            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
        </div>
    </div>
    @break
    @case(4)
    <div class="form-group form-check">
        {!! Form::checkbox(
            'paramerId_'.$_formParameter->id,
            is_null($_fieldData) ? null : $_fieldData->parameter_bool_value,
            array_merge([
                'class' => $errors->has('paramerId_'.$_formParameter->id) ? 'form-check-input is-invalid' : 'form-check-input',
                ],
                $errors->has('paramerId_'.$_formParameter->id) ?['autofocus' =>  'autofocus'] : []
            )
        ) !!}
    </div>
    @break
    @case(5)
    @php
        $idList = explode(';', $_formParameter->optionset_id_list);
        $valueList = explode(';', $_formParameter->optionset_value_list);
        $selectList = [];

        foreach($idList as $index => $id){
            $selectList = $selectList + [$id => $valueList[$index]];
        }

    @endphp
    {!! Form::select(
        'paramerId_'.$_formParameter->id,
        $selectList,
        is_null($_fieldData) ? null : $_fieldData->parameter_optionset_id,
        array_merge([
            'placeholder' => '',
            'class' => $errors->has('paramerId_'.$_formParameter->id) ? 'form-control is-invalid' : 'form-control',
            ],
            $errors->has('paramerId_'.$_formParameter->id) ?['autofocus' =>  'autofocus'] : []
        )
    ) !!}
    @break
    @case(6)
    @php
        $table = collect($serviceEntity->tableList)->where('tableParameterId', $_formParameter->id)->first();
    @endphp
    @if(sizeof($table->columnParameterList) > 0)
        <table class="table table-bordered table-parameter-{{$_formParameter->id}}">
            <thead>
            <tr>
                @foreach($table->columnParameterList as $columnParameter)
                    <th class="w-30">{{$columnParameter["caption"]}}</th>
                @endforeach
            </tr>
            <tr class="template-row hide">
                @foreach(collect($table->columnParameterList)->sortBy("order_number")->all() as $columnParameter)
                    <td>
                        @php
                            $_columnParameter = new stdClass();
                            $_columnParameter->id = 'table_'.$_formParameter->id.'_'.$columnParameter["id"]."[]";
                            $_columnParameter->registration_form_template_id = $columnParameter["registration_form_template_id"];
                            $_columnParameter->registration_form_group_template_id = $columnParameter["registration_form_group_template_id"];
                            $_columnParameter->registration_form_group_template_name = $columnParameter["registration_form_group_template_name"];
                            $_columnParameter->registration_form_group_template_order_number = $columnParameter["registration_form_group_template_order_number"];
                            $_columnParameter->parameter_type_id = $columnParameter["parameter_type_id"];
                            $_columnParameter->parameter_type_name = $columnParameter["parameter_type_name"];
                            $_columnParameter->parameter_type_data_type = $columnParameter["parameter_type_data_type"];
                            $_columnParameter->caption = $columnParameter["caption"];
                            $_columnParameter->is_active = $columnParameter["is_active"];
                            $_columnParameter->comment = $columnParameter["comment"];
                            $_columnParameter->order_number = $columnParameter["order_number"];
                            $_columnParameter->optionset_type_id = $columnParameter["optionset_type_id"];
                            $_columnParameter->optionset_type_name = $columnParameter["optionset_type_name"];
                            $_columnParameter->optionset_id_list = $columnParameter["optionset_id_list"];
                            $_columnParameter->optionset_value_list = $columnParameter["optionset_value_list"];
                            $_columnParameter->parameter_datetime_format = $columnParameter["parameter_datetime_format"];
                            $_columnParameter->parameter_datetime_default_value = $columnParameter["parameter_datetime_default_value"];
                            $_columnParameter->parameter_number_max_value= $columnParameter["parameter_number_max_value"];
                            $_columnParameter->parameter_number_min_value= $columnParameter["parameter_number_min_value"];
                            $_columnParameter->parameter_number_round_type= $columnParameter["parameter_number_round_type"];
                            $_columnParameter->parameter_number_default_value= $columnParameter["parameter_number_default_value"];
                            $_columnParameter->parameter_text_validation_mask= $columnParameter["parameter_text_validation_mask"];
                            $_columnParameter->parameter_text_default_value= $columnParameter["parameter_text_default_value"];
                        @endphp
                        @include('Client._formFieldTemplate', ['_formParameter'=>$_columnParameter])
                    </td>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @php
                $paramId = collect($table->columnParameterList)->sortBy("order_number")->first()["id"];
                $_tableData = collect($tableData)->where('registration_form_parameter_id', $_formParameter->id)->first();

                $rowCnt = 0;

                if(!is_null($_tableData)){
                    $rowCnt = sizeof(collect($_tableData->columnParameterList)->where('registration_form_parameter_template_id', $paramId)->all());
                }
                $columnParamName = collect($table->columnParameterList)->sortBy("order_number")->first();

                if(old('paramerId_table_'.$_formParameter->id.'_'.$columnParamName["id"])){
                   $rowCnt = sizeof(old('paramerId_table_'.$_formParameter->id.'_'.$columnParamName["id"]))-1;
                }

                if($rowCnt == 0){
                    $rowCnt = 1;
                }
            @endphp
            @for($i = 1; $i <= $rowCnt; $i++)
                <tr>
                    @foreach(collect($table->columnParameterList)->sortBy("order_number")->all() as $columnParameter)
                        @php
                            $fieldTableData = null;
                            if(!is_null($_tableData)){
                                $fieldTableData = collect($_tableData->columnParameterList)->where('registration_form_parameter_template_id', $columnParameter['id'])->where('row_id', $i)->first();
                            }
                        @endphp
                        <td>
                            @php
                                $_columnParameter = new stdClass();
                                $_columnParameter->id = 'table_'.$_formParameter->id.'_'.$columnParameter["id"]."[]";
                                $_columnParameter->registration_form_template_id = $columnParameter["registration_form_template_id"];
                                $_columnParameter->registration_form_group_template_id = $columnParameter["registration_form_group_template_id"];
                                $_columnParameter->registration_form_group_template_name = $columnParameter["registration_form_group_template_name"];
                                $_columnParameter->registration_form_group_template_order_number = $columnParameter["registration_form_group_template_order_number"];
                                $_columnParameter->parameter_type_id = $columnParameter["parameter_type_id"];
                                $_columnParameter->parameter_type_name = $columnParameter["parameter_type_name"];
                                $_columnParameter->parameter_type_data_type = $columnParameter["parameter_type_data_type"];
                                $_columnParameter->caption = $columnParameter["caption"];
                                $_columnParameter->is_active = $columnParameter["is_active"];
                                $_columnParameter->comment = $columnParameter["comment"];
                                $_columnParameter->order_number = $columnParameter["order_number"];
                                $_columnParameter->optionset_type_id = $columnParameter["optionset_type_id"];
                                $_columnParameter->optionset_type_name = $columnParameter["optionset_type_name"];
                                $_columnParameter->optionset_id_list = $columnParameter["optionset_id_list"];
                                $_columnParameter->optionset_value_list = $columnParameter["optionset_value_list"];
                                $_columnParameter->parameter_datetime_format = $columnParameter["parameter_datetime_format"];
                                $_columnParameter->parameter_datetime_default_value = $columnParameter["parameter_datetime_default_value"];
                                $_columnParameter->parameter_number_max_value= $columnParameter["parameter_number_max_value"];
                                $_columnParameter->parameter_number_min_value= $columnParameter["parameter_number_min_value"];
                                $_columnParameter->parameter_number_round_type= $columnParameter["parameter_number_round_type"];
                                $_columnParameter->parameter_number_default_value= $columnParameter["parameter_number_default_value"];
                                $_columnParameter->parameter_text_validation_mask= $columnParameter["parameter_text_validation_mask"];
                                $_columnParameter->parameter_text_default_value= $columnParameter["parameter_text_default_value"];

                                $_field = null;
                                if(!is_null($fieldTableData)){
                                    $tempField = collect($fieldTableData['column_value']);
                                    $_field = new stdClass();
                                    $_field->parameter_formatted_value = $tempField["parameter_formatted_value"];
                                    $_field->parameter_number_value = $tempField["parameter_number_value"];
                                    $_field->parameter_datetime_value = $tempField["parameter_datetime_value"];
                                    $_field->parameter_bool_value = $tempField["parameter_bool_value"];
                                    $_field->parameter_optionset_id = $tempField["parameter_optionset_id"];
                                    $_field->parameter_optionset_type_id = $tempField["parameter_optionset_type_id"];
                                    $_field->parameter_optionset_value = $tempField["parameter_optionset_value"];
                                    $_field->parameter_optionset_type_name = $tempField["parameter_optionset_type_name"];
                                }
                            @endphp
                            @include('Client._formFieldTemplate', ['_formParameter'=>$_columnParameter, '_fieldData'=>$_field])
                        </td>
                    @endforeach
                </tr>
            @endfor
            </tbody>
        </table>
    @endif
    @break
    @case(7)
    {!! Form::text(
        'paramerId_'.$_formParameter->id,
        is_null($_fieldData) ? null : $_fieldData->parameter_formatted_value,
        array_merge([
            'class' => $errors->has('paramerId_'.$_formParameter->id) ? 'form-control is-invalid' : 'form-control',
            'placeholder' => $_formParameter->parameter_text_default_value
            ],
            $errors->has('paramerId_'.$_formParameter->id) ?['autofocus' =>  'autofocus'] : []
        )
    ) !!}
    @break
    @case(8)
    {!! Form::text(
        'paramerId_'.$_formParameter->id,
        is_null($_fieldData) ? null : $_fieldData->parameter_formatted_value,
        array_merge([
            'class' => $errors->has('paramerId_'.$_formParameter->id) ? 'form-control is-invalid' : 'form-control',
            'placeholder' => $_formParameter->parameter_text_default_value
            ],
            $errors->has('paramerId_'.$_formParameter->id) ?['autofocus' =>  'autofocus'] : []
        )
    ) !!}
    @break

@endswitch



@if ($errors->has('paramerId_'.$_formParameter->id))
    <span class="help-block invalid-feedback">
        <strong>{{ $errors->first('paramerId_'.$_formParameter->id) }}</strong>
    </span>
@endif