<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2018-12-22
 * Time: 1:28 PM
 */

namespace App\Data\Employee\Dal;


use App\Data\Employee\Model\EmployeeSocial;
use App\Data\Helper\Assistant;

class EmployeeSocialDal
{
    /**
     * Get EmployeeSocial by Id
     *
     * @param $entityId
     * @return mixed
     */
    public static function get($entityId)
    {
        $entity = EmployeeSocial::where('id', $entityId)->firstOrFail();
        return $entity;
    }

    /**
     * Get EmployeeSocial list
     *
     * @param $employeeId
     * @param $withPaginate
     * @return mixed
     */
    public static function getListByEmployee($employeeId, $withPaginate = false)
    {
        $entity = EmployeeSocial::
            leftJoin('social_type', 'social_type.id', '=', 'employee_social.social_type_id')
            ->where('employee_social.employee_id', $employeeId)
            ->select('employee_social.*', 'social_type.value as social_type_value');

        if($withPaginate){
            return $entity->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entity->get();
        }
    }

    /**
     * Insert (or update)  EmployeeSocial
     *
     * @param EmployeeSocial $srcEntity
     * @return EmployeeSocial
     */
    public static function set (EmployeeSocial $srcEntity)
    {
        if (empty($srcEntity->id)) {
            $entity = new EmployeeSocial;
        } else {
            $entity = EmployeeSocial::where('id', $srcEntity->id)->firstOrFail();
        }
        $entity->employee_id = $srcEntity->employee_id;
        $entity->social_type_id = $srcEntity->social_type_id;
        $entity->value = $srcEntity->value;
        $entity->save();

        return self::get($entity->id);
    }


    /**
     * Delete EmployeeSocial
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        EmployeeSocial::where('id', $entityId)->delete();
        return true;
    }

    /**
     * Delete EmployeeSocial by employee_id
     *
     * @param $employeeId
     * @return bool
     */
    public static function deleteByEmployee($employeeId)
    {
        EmployeeSocial::where('employee_id', $employeeId)->delete();
        return true;
    }
}