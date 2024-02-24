@php
    $fieldData = collect($data)->where('registration_form_parameter_template_id', $_formParameter->id)->first();
@endphp

@switch($_formParameter->parameter_type_id)
    @case(1)
    {{is_null($fieldData) ? "" : $fieldData->parameter_formatted_value}}
    @break
    @case(2)
    {{is_null($fieldData) ? "" : $fieldData->parameter_formatted_value}}
    @break
    @case(3)
    {{is_null($fieldData) ? "" : $fieldData->parameter_formatted_value}}
    @break
    @case(4)
    {{is_null($fieldData) ? "" : $fieldData->parameter_formatted_value}}
    @break
    @case(5)
    {{is_null($fieldData) ? "" : $fieldData->parameter_formatted_value}}
    @break
    @case(6)
    @php
        $table = collect($tableList)->where('tableParameterId', $_formParameter->id)->first();
    @endphp
    @if(sizeof($table->columnParameterList) > 0)
        <table class="table table-bordered table-parameter-{{$_formParameter->id}}">
            <thead>
            <tr>
                @foreach($table->columnParameterList as $columnParameter)
                    <th class="w-30">{{$columnParameter["caption"]}}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @php
                $paramId = collect($table->columnParameterList)->sortBy("order_number")->first()["id"];

                $_tableData = collect($tableData)->where('registration_form_parameter_id', $_formParameter->id)->first();
                if(is_null($_tableData)){
                    $rowCnt = 0;
                } else {
                    $rowCnt = sizeof(collect($_tableData->columnParameterList)->where('registration_form_parameter_template_id', $paramId)->all());
                }
            @endphp
            @for($i = 1; $i <= $rowCnt; $i++)
                <tr>
                    @foreach(collect($table->columnParameterList)->sortBy("order_number")->all() as $columnParameter)
                        @php
                            $fieldTableData = collect($_tableData->columnParameterList)->where('registration_form_parameter_template_id', $columnParameter['id'])->where('row_id', $i)->first();
                        @endphp
                        <td>
                            {{collect($fieldTableData['column_value'])['parameter_formatted_value']}}
                        </td>
                    @endforeach
                </tr>
            @endfor
            </tbody>
        </table>
    @endif
    @break
    @case(7)
    {{is_null($fieldData) ? "" : $fieldData->parameter_formatted_value}}
    @break
    @case(8)
    {{is_null($fieldData) ? "" : $fieldData->parameter_formatted_value}}
    @break
@endswitch