<?php

namespace App\Data\RegistrationFormTemplate\Dal;

use App\Data\Helper\Assistant;
use App\Data\RegistrationFormTemplate\Model\ParameterGroup;

class ParameterGroupDal
{
    /**
     * Get ParameterGroup list
     *
     * @param $withPaginate
     * @return mixed
     */
    public static function getList(bool $withPaginate)
    {
        if($withPaginate){
            return ParameterGroup::paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return ParameterGroup::get();
        }
    }

    public static function getAvailableListByRegistrationFormTemplate(int $registrationFormTemplateId)
    {
        $entityList = ParameterGroup::from('parameter_group as pg')
            ->leftJoin('registration_form_group_template as rfgt', function ($join) use($registrationFormTemplateId){
                $join->on('rfgt.parameter_group_id','=','pg.id')
                    ->where('rfgt.registration_form_template_id', $registrationFormTemplateId);
            })
            ->whereNull('rfgt.id')
            ->get(['pg.*']);

        return $entityList;

    }

    /**
     * Get ParameterGroup by Id
     *
     * @param $ParameterGroupId
     * @return mixed
     */
    public static function get($entityId)
    {
        $ParameterGroup = ParameterGroup::where('id', $entityId)->firstOrFail();
        return $ParameterGroup;
    }

    /**
     * Insert (or update)  ParameterGroup
     *
     * @param ParameterGroup $district
     * @return ParameterGroup
     */
    public static function set (ParameterGroup $srcEntity)
    {
        if (empty($srcEntity->id)) {
            $entity = new ParameterGroup;
        } else {
            $entity = ParameterGroup::where('id', $srcEntity->id)->firstOrFail();
        }
        $entity->name = $srcEntity->name;
        $entity->save();
        return $entity;
    }

    /**
     * Delete ParameterGroup
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        ParameterGroup::where('id', $entityId)->delete();
        return true;
    }

}
