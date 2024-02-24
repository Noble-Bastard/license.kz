<?php

namespace App\Data\RegistrationForm\Dal;


use App\Data\Core\Dal\CounterDal;
use App\Data\Helper\Assistant;
use App\Data\Helper\ParameterTypeList;
use App\Data\RegistrationForm\Model\ParameterBoolValue;
use App\Data\RegistrationForm\Model\ParameterDatetimeValue;
use App\Data\RegistrationForm\Model\ParameterNumberValue;
use App\Data\RegistrationForm\Model\ParameterOptionsetValue;
use App\Data\RegistrationForm\Model\ParameterTableColumnValue;
use App\Data\RegistrationForm\Model\RegistrationForm;
use App\Data\RegistrationForm\Model\RegistrationFormGroup;
use App\Data\RegistrationForm\Model\RegistrationFormParameter;
use App\Data\RegistrationForm\Model\RegistrationFormParameterExt;
use App\Data\RegistrationFormTemplate\Dal\RegistrationFormTemplateDal;
use App\Data\Service\Dal\ServiceDal;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use stdClass;

class RegistrationFormDal
{

    public static function get($entityId)
    {
        $entity = RegistrationForm::where('id', $entityId)->firstOrFail();
        return $entity;
    }

    public static function getByServiceJournal($serviceJournalId)
    {
        $entity = RegistrationForm::where('service_journal_id', $serviceJournalId)->firstOrFail();
        return $entity;
    }

    public static function getRegistrationFormParametersByServiceJournal($serviceJournalId)
    {
        $parameterList = RegistrationFormParameterExt
            ::where('service_journal_id',$serviceJournalId)
            ->get();
        return $parameterList;
    }

    public static function setParameterTableColumnValue($registrationFormParameterId, $rowId, $columnParameterValueId)
    {
        //set ParameterTableColumnValue
        $parameterTableColumnValue = ParameterTableColumnValue
            ::where('registration_form_parameter_id', $registrationFormParameterId)
            ->where('row_id',$rowId)
            ->where('column_value_id',$columnParameterValueId)
            ->first();
        if(is_null($parameterTableColumnValue))
        {
            $parameterTableColumnValue = new ParameterTableColumnValue();
            $parameterTableColumnValue->registration_form_parameter_id = $registrationFormParameterId;
        }
        $parameterTableColumnValue->row_id = $rowId;
        $parameterTableColumnValue->column_value_id = $columnParameterValueId;
        $parameterTableColumnValue->save();

        return $parameterTableColumnValue;
    }

    public static function setParameterBoolValue($registrationFormParameterId, $paramValue)
    {
        //parameter_bool_value
        $parameterBoolValue = ParameterBoolValue
            ::where('registration_form_parameter_id', $registrationFormParameterId)
            ->first();
        if(is_null($parameterBoolValue))
        {
            $parameterBoolValue = new ParameterBoolValue();
            $parameterBoolValue->registration_form_parameter_id = $registrationFormParameterId;
        }
        $parameterBoolValue->parameter_value = $paramValue;
        $parameterBoolValue->save();

        return $parameterBoolValue;
    }

    public static function setParameterNumberValue($registrationFormParameterId, $paramValue)
    {
        //parameter_number_value
        $parameterNumberValue = ParameterNumberValue
            ::where('registration_form_parameter_id', $registrationFormParameterId)
            ->first();
        if(is_null($parameterNumberValue))
        {
            $parameterNumberValue = new ParameterNumberValue();
            $parameterNumberValue->registration_form_parameter_id = $registrationFormParameterId;
        }
        $parameterNumberValue->parameter_value = $paramValue;
        $parameterNumberValue->save();

        return $parameterNumberValue;
    }

    public static function setParameterDatetimeValue($registrationFormParameterId, $paramValue)
    {
        //parameter_datetime_value
        $parameterDatetimeValue = ParameterDatetimeValue
            ::where('registration_form_parameter_id', $registrationFormParameterId)
            ->first();
        if(is_null($parameterDatetimeValue))
        {
            $parameterDatetimeValue = new ParameterDatetimeValue();
            $parameterDatetimeValue->registration_form_parameter_id = $registrationFormParameterId;
        }
        $parameterDatetimeValue->parameter_value = $paramValue;
        $parameterDatetimeValue->save();

        return $parameterDatetimeValue;
    }

    public static function setParameterOptionsetValue($registrationFormParameterId, $optionsetTypeId, $optionsetId, $optionsetValue)
    {
        //parameter_optionset_value
        $parameterOptionSetValue = ParameterOptionsetValue
            ::where('registration_form_parameter_id', $registrationFormParameterId)
            ->first();
        if(is_null($parameterOptionSetValue))
        {
            $parameterOptionSetValue = new ParameterOptionsetValue();
            $parameterOptionSetValue->registration_form_parameter_id = $registrationFormParameterId;
            $parameterOptionSetValue->optionset_type_id = $optionsetTypeId;
        }
        $parameterOptionSetValue->optionset_value = $optionsetValue;
        $parameterOptionSetValue->optionset_id = $optionsetId;
        $parameterOptionSetValue->save();

        return $parameterOptionSetValue;
    }

    public static function setRegistrationFormParameterValue(
        $registrationFormId,
        $registrationFormGroupId,
        $registrationFormParameterTemplate,
        $parameterValue,
        $isForceNewParam
    )
    {

        $registrationFormParameter = RegistrationFormParameter
            ::where('registration_form_parameter_template_id',$registrationFormParameterTemplate->id)
            ->where('registration_form_group_id',$registrationFormGroupId)
            ->where('registration_form_id',$registrationFormId)
            ->first();
        if(is_null($registrationFormParameter) || $isForceNewParam)
        {
            $registrationFormParameter = new RegistrationFormParameter();
            $registrationFormParameter->registration_form_group_id = $registrationFormGroupId;
            $registrationFormParameter->registration_form_id = $registrationFormId;
            $registrationFormParameter->parameter_type_id = $registrationFormParameterTemplate->parameter_type_id;
            $registrationFormParameter->caption = $registrationFormParameterTemplate->caption;
            $registrationFormParameter->comment = $registrationFormParameterTemplate->comment;
            $registrationFormParameter->order_number = $registrationFormParameterTemplate->order_number;
            $registrationFormParameter->registration_form_parameter_template_id = $registrationFormParameterTemplate->id;
        }
        $registrationFormParameter->parameter_formatted_value = $parameterValue;
        $registrationFormParameter->save();

        if($registrationFormParameterTemplate->parameter_type_id == ParameterTypeList::Table){
            return $registrationFormParameter;
        }

        if($registrationFormParameterTemplate->parameter_type_id == ParameterTypeList::Bool)
        {
            self::setParameterBoolValue(
                $registrationFormParameter->id,
                $parameterValue === 'true'
            );

        } else if($registrationFormParameterTemplate->parameter_type_id == ParameterTypeList::Date){

            self::setParameterDatetimeValue(
                $registrationFormParameter->id,
                \DateTime::createFromFormat($registrationFormParameterTemplate->parameter_datetime_format,$parameterValue)
            );

        } else if($registrationFormParameterTemplate->parameter_type_id == ParameterTypeList::Number){

            self::setParameterNumberValue(
                $registrationFormParameter->id,
                (float)$parameterValue
            );

        } else if($registrationFormParameterTemplate->parameter_type_id == ParameterTypeList::OptionSet){

            $parameterOptionSetValue = self::setParameterOptionsetValue(
                $registrationFormParameter->id,
                $registrationFormParameterTemplate->optionset_type_id,
                $parameterValue,
                explode(';',$registrationFormParameterTemplate->optionset_value_list)[(int)$parameterValue - 1]
            );
            $registrationFormParameter->parameter_formatted_value = $parameterOptionSetValue->optionset_value;
            $registrationFormParameter->save();

        } else if($registrationFormParameterTemplate->parameter_type_id == ParameterTypeList::Text
            || $registrationFormParameterTemplate->parameter_type_id == ParameterTypeList::Email
            || $registrationFormParameterTemplate->parameter_type_id == ParameterTypeList::Phone
        ) {

            $registrationFormParameter->parameter_formatted_value = $parameterValue;
            $registrationFormParameter->save();

        }

        return $registrationFormParameter;

    }

    /**
     * Fill registration form values
     *
     * @param $parameterValueList - array(registration_form_parameter_template.id, parameter_value)
     * @param $tableDataList - array (registration_form_parameter_template.id (tableParameterId), rowId, array(registration_form_parameter_template.id (columnTemplateId), parameter_value) )
     */
    public static function set($serviceJournalId, $serviceId, $parameterValueList, $tableDataList)
    {

        $serviceJournalExt = ServiceJournalDal::getExt($serviceJournalId);

        try {
            DB::beginTransaction();

            //set registration form
            $registrationForm = RegistrationForm::where('service_journal_id', $serviceJournalId)->first();
            $registration_form_template_counter_type_id = self::getRegistrationFormTemplateCounterId($serviceId);
            if (is_null($registrationForm)) {
                $registrationForm = new RegistrationForm();
                $registrationForm->form_number = CounterDal::getCounterValue($registration_form_template_counter_type_id);
                $registrationForm->service_journal_id = $serviceJournalExt->id;
            }
            $registrationForm->create_date = Assistant::getCurrentDate();
            $registrationForm->save();

            //set registration form group
            $registrationFormGroupTemplateList = RegistrationFormTemplateDal::getRegistrationFormGroupTemplateList($serviceId);
            $registrationFormParameterTemplateList = RegistrationFormTemplateDal::getRegistrationFormParameterTemplateList($serviceId);
            foreach ($registrationFormGroupTemplateList as $registrationFormGroupTemplate)
            {
                $registrationFormGroup = RegistrationFormGroup::where('registration_form_id',$registrationForm->id)
                    ->where('parameter_group_id',$registrationFormGroupTemplate->parameter_group_id)
                    ->first();
                if(is_null($registrationFormGroup))
                {
                    $registrationFormGroup = new RegistrationFormGroup();
                    $registrationFormGroup->registration_form_id = $registrationForm->id;
                    $registrationFormGroup->parameter_group_id = $registrationFormGroupTemplate->parameter_group_id;
                    $registrationFormGroup->order_number = $registrationFormGroupTemplate->order_number;
                    $registrationFormGroup->save();
                }

                //set registration_form_parameter
                foreach (collect($registrationFormParameterTemplateList)->where('registration_form_group_template_id', $registrationFormGroupTemplate->id) as $registrationFormParameterTemplate)
                {
                    $parameterValue = collect($parameterValueList)->where('paramId',$registrationFormParameterTemplate->id)->first()['paramValue'];

                    $registrationFormParameter = self::setRegistrationFormParameterValue(
                        $registrationForm->id,
                        $registrationFormGroup->id,
                        $registrationFormParameterTemplate,
                        $parameterValue,
                        false
                    );

                    if($registrationFormParameterTemplate->parameter_type_id == ParameterTypeList::Table){

                        //remove prev saved table
                        ParameterTableColumnValue
                            ::where('registration_form_parameter_id',$registrationFormParameter->id)
                            ->delete();

                        //set parameter_table_column_value values
                        foreach (collect($tableDataList)->where('tableParameterId',$registrationFormParameterTemplate->id)->first()->columnParameterList as $columnItem) {

                            //get input data
                            $columnItemRowId = $columnItem['row_id'];
                            $columnItemParamId = $columnItem['paramId'];
                            $columnItemParamValue = $columnItem['paramValue'];

                            //get parameter template
                            $columnParameterTemplate = RegistrationFormTemplateDal::getRegistrationFormParameterTemplate($columnItemParamId);

                            //set column param value
                            $columnParameter = self::setRegistrationFormParameterValue(
                                $registrationForm->id,
                                null,
                                $columnParameterTemplate,
                                $columnItemParamValue,
                                true
                            );

                            //set parameter table column
                            self::setParameterTableColumnValue(
                                $registrationFormParameter->id,
                                $columnItemRowId,
                                $columnParameter->id
                            );

                        }
                    }
                }
            }

            DB::commit();

            return self::getByServiceJournal($serviceJournalId);

        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return $e;
        }

    }

    public static function getTableData($serviceJournalId)
    {
        //get all table parameters
        $tableParameterList = RegistrationFormParameterExt
            ::where('service_journal_id',$serviceJournalId)
            ->where('parameter_type_id', ParameterTypeList::Table)
            ->get();

        $entityList = array();

        foreach ($tableParameterList as $tableParameter) {

            $tableData = new stdClass();
            $tableData->tableParameterId = $tableParameter->id;
            $tableData->registration_form_parameter_id = $tableParameter->registration_form_parameter_template_id;
            $tableData->columnParameterList = [];

            $tableColumns = ParameterTableColumnValue::where('registration_form_parameter_id',$tableParameter->id)->get();
            foreach ($tableColumns as $tableColumn) {
                $tableColumnParameter = RegistrationFormParameterExt::where('id', $tableColumn->column_value_id)->first();
                array_push(
                    $tableData->columnParameterList,
                    [
                        'row_id' => $tableColumn->row_id,
                        'registration_form_parameter_template_id' => $tableColumnParameter->registration_form_parameter_template_id,
                        'order_number' => $tableColumnParameter->order_number,
                        'column_value' => $tableColumnParameter
                    ]
                );
            }

            array_push($entityList, $tableData);
        }

        return $entityList;
    }


    private static function getRegistrationFormTemplateCounterId($serviceId): int
    {
        $service = ServiceDal::get($serviceId);
        $registrationFormTemplate = RegistrationFormTemplateDal::get($service->registration_form_template_id);
        return $registrationFormTemplate->counter_type_id;
    }

}
