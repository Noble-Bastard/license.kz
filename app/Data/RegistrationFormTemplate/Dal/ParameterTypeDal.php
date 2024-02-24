<?php

namespace App\Data\RegistrationFormTemplate\Dal;

use App\Data\Helper\Assistant;
use App\Data\RegistrationFormTemplate\Model\ParameterType;

class ParameterTypeDal
{
    /**
     * Get ParameterType list
     *
     * @param $withPaginate
     * @return mixed
     */
    public static function getList(bool $withPaginate)
    {
        if($withPaginate){
            return ParameterType::paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return ParameterType::get();
        }
    }

    /**
     * Get ParameterType by Id
     *
     * @param $ParameterGroupId
     * @return mixed
     */
    public static function get($entityId)
    {
        $ParameterGroup = ParameterType::where('id', $entityId)->firstOrFail();
        return $ParameterGroup;
    }


}
