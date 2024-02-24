<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2018-12-22
 * Time: 1:28 PM
 */

namespace App\Data\Employee\Dal;


use App\Data\Employee\Model\EmployeeSpeciality;
use App\Data\Helper\Assistant;

class EmployeeSpecialityDal
{
    /**
     * Get EmployeeSpeciality by Id
     *
     * @param $entityId
     * @return mixed
     */
    public static function get($entityId)
    {
        $entity = EmployeeSpeciality::where('id', $entityId)->firstOrFail();
        return $entity;
    }

    /**
     * Get EmployeeSpeciality list
     *
     * @param $employeeId
     * @param $withPaginate
     * @return mixed
     */
    public static function getListByEmployee($employeeId, $withPaginate = false)
    {
        $entity = EmployeeSpeciality::where('employee_id', $employeeId);

        if($withPaginate){
            return $entity->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entity->get();
        }
    }

    /**
     * Insert (or update)  EmployeeSpeciality
     *
     * @param EmployeeSpeciality $srcEntity
     * @return EmployeeSpeciality
     */
    public static function set (EmployeeSpeciality $srcEntity)
    {
        if (empty($srcEntity->id)) {
            $entity = new EmployeeSpeciality;
        } else {
            $entity = EmployeeSpeciality::where('id', $srcEntity->id)->firstOrFail();
        }
        $entity->employee_id = $srcEntity->employee_id;
        $entity->name = $srcEntity->name;
        $entity->value = $srcEntity->value;
        $entity->save();

        return self::get($entity->id);
    }


    /**
     * Delete EmployeeSpeciality
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        EmployeeSpeciality::where('id', $entityId)->delete();
        return true;
    }

    /**
     * Delete EmployeeSpeciality by employee_id
     *
     * @param $employeeId
     * @return bool
     */
    public static function deleteByEmployee($employeeId)
    {
        EmployeeSpeciality::where('employee_id', $employeeId)->delete();
        return true;
    }
}