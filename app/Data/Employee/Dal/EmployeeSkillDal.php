<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2018-12-22
 * Time: 1:28 PM
 */

namespace App\Data\Employee\Dal;


use App\Data\Employee\Model\EmployeeSkill;
use App\Data\Helper\Assistant;

class EmployeeSkillDal
{
    /**
     * Get EmployeeSkill by Id
     *
     * @param $EmployeeSkillId
     * @return mixed
     */
    public static function get($entityId)
    {
        $entity = EmployeeSkill::where('id', $entityId)->firstOrFail();
        return $entity;
    }

    /**
     * Get EmployeeSkill list
     *
     * @param $employeeId
     * @param $withPaginate
     * @return mixed
     */
    public static function getListByEmployee($employeeId, $withPaginate = false)
    {
        $entity = EmployeeSkill::where('employee_id', $employeeId);

        if($withPaginate){
            return $entity->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entity->get();
        }
    }

    /**
     * Insert (or update)  EmployeeSkill
     *
     * @param EmployeeSkill $srcEntity
     * @return EmployeeSkill
     */
    public static function set (EmployeeSkill $srcEntity)
    {
        if (empty($srcEntity->id)) {
            $entity = new EmployeeSkill;
        } else {
            $entity = EmployeeSkill::where('id', $srcEntity->id)->firstOrFail();
        }
        $entity->employee_id = $srcEntity->employee_id;
        $entity->value = $srcEntity->value;
        $entity->save();
        return self::get($entity->id);
    }


    /**
     * Delete EmployeeSkill
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        EmployeeSkill::where('id', $entityId)->delete();
        return true;
    }

    /**
     * Delete EmployeeSkill by employee_id
     *
     * @param $employeeId
     * @return bool
     */
    public static function deleteByEmployee($employeeId)
    {
        EmployeeSkill::where('employee_id', $employeeId)->delete();
        return true;
    }
}