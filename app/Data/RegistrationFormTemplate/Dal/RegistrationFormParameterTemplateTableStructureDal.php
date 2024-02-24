<?php

namespace App\Data\RegistrationFormTemplate\Dal;

use App\Data\Helper\Assistant;
use App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplate;
use App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateTableStructure;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegistrationFormParameterTemplateTableStructureDal
{

    public static function get($entityId)
    {
        return RegistrationFormParameterTemplateTableStructure::where('id',$entityId)
            ->firstOrFail();
    }

    public static function getList($tableParameterId)
    {
        $registrationFormParameterTemplateTable = RegistrationFormParameterTemplateTableDal::getByParameterId($tableParameterId);

        if(is_null($registrationFormParameterTemplateTable))
        {
            return new RegistrationFormParameterTemplateTableStructure();
        }

        return RegistrationFormParameterTemplateTableStructure::from('registration_form_parameter_template_table_structure as ts')
            ->join('registration_form_parameter_template_table as ptt','ts.registration_form_parameter_template_table_id','=','ptt.id')
            ->join('registration_form_parameter_template as pt','ts.column_parameter_template_id','=','pt.id')
            ->leftJoin('optionset_type as ot','pt.optionset_type_id','=','ot.id')
            ->join('parameter_type as prmt','pt.parameter_type_id','=','prmt.id')
            ->where('registration_form_parameter_template_table_id',$registrationFormParameterTemplateTable->id)
            ->orderBy('pt.order_number')
            ->get([
                'ts.*',
                'pt.parameter_type_id',
                'ptt.registration_form_parameter_template_id as tableParameterId',
                'prmt.name as parameter_type_name',
                'pt.caption',
                'pt.is_active',
                'pt.comment',
                'pt.order_number',
                'pt.optionset_type_id',
                'ot.name as optionset_type_name',
            ]);
    }

    public static function set(
        int $templateTableId,
        RegistrationFormParameterTemplate $registrationFormParameterTemplate
    )
    {
        try {
            DB::beginTransaction();

            //save parameter information
            $parameterEntity = RegistrationFormParameterTemplateDal::set(
                $registrationFormParameterTemplate,
                $templateTableId
            );

            //link parameter to table parameter
            $tableStructureEntity = RegistrationFormParameterTemplateTableStructure::where('registration_form_parameter_template_table_id',$templateTableId)
                ->where('column_parameter_template_id',$parameterEntity->id)
                ->first();
            if(is_null($tableStructureEntity))
            {
                $tableStructureEntity = new RegistrationFormParameterTemplateTableStructure();
                $tableStructureEntity->column_parameter_template_id = $parameterEntity->id;
                $tableStructureEntity->registration_form_parameter_template_table_id = $templateTableId;
                $tableStructureEntity->save();
            }

            DB::commit();

            return $tableStructureEntity;

        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }

    }

    public static function delete($entityId)
    {
        $tableStructure = self::get($entityId);

        try {
            DB::beginTransaction();

            RegistrationFormParameterTemplateTableStructure::where('id',$entityId)
                ->delete();

            RegistrationFormParameterTemplateDal::delete($tableStructure->column_parameter_template_id);

            DB::commit();

            return true;

        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }

    }

}
