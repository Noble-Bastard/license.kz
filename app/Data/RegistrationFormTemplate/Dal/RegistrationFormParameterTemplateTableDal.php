<?php

namespace App\Data\RegistrationFormTemplate\Dal;

use App\Data\Helper\Assistant;
use App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateTable;

use App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateTableStructure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegistrationFormParameterTemplateTableDal
{

    /**
     * Get RegistrationFormParameterTemplateTable by Id
     *
     * @param $registrationFormParameterTemplateId
     * @return mixed
     */
    public static function get($entityId)
    {
        $registrationFormParameterTemplateTable = RegistrationFormParameterTemplateTable::where('id', $entityId)->firstOrFail();
        return $registrationFormParameterTemplateTable;
    }


    public static function getByParameterId ($tableParameterId)
    {
        $entity = RegistrationFormParameterTemplateTable::where('registration_form_parameter_template_id', $tableParameterId)
            ->first();
        return $entity;
    }

    /**
     * Insert (or update)  RegistrationFormParameterTemplateTable
     *
     * @param int $registrationFormParameterTemplateId
     * @param string $tableCaption
     * @return RegistrationFormParameterTemplateTable
     */
    public static function set ($registrationFormParameterTemplateId, $tableCaption)
    {
        $entity = RegistrationFormParameterTemplateTable::where('registration_form_parameter_template_id', $registrationFormParameterTemplateId)->first();

        if (is_null($entity)) {
            $entity = new RegistrationFormParameterTemplateTable;
            $entity->registration_form_parameter_template_id = $registrationFormParameterTemplateId;
        }

        $entity->table_caption = $tableCaption;
        $entity->save();
        return $entity;
    }


    /**
     * Delete RegistrationFormParameterTemplateTable
     *
     * @param $parameterId - registration_form_parameter_template id
     * @return bool
     */
    public static function deleteByRegistrationFormParameterTemplateId($registrationFormParameterTemplateId)
    {

        $registrationFormParameterTemplateTable = RegistrationFormParameterTemplateTable::where('registration_form_parameter_template_id',$registrationFormParameterTemplateId)
            ->firstOrFail();

        try {
            DB::beginTransaction();

            $tableStructureList = RegistrationFormParameterTemplateTableStructureDal::getList($registrationFormParameterTemplateTable->registration_form_parameter_template_id);
            foreach ($tableStructureList as $tableStructure)
            {
                RegistrationFormParameterTemplateTableStructureDal::delete($tableStructure->id);
            }

            $registrationFormParameterTemplateTable->delete();

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
