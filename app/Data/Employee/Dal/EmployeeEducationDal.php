<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2018-12-22
 * Time: 1:28 PM
 */

namespace App\Data\Employee\Dal;


use App\Data\Employee\Model\EmployeeEducation;
use App\Data\Helper\Assistant;

class EmployeeEducationDal
{
    /**
     * Get EmployeeEducation by Id
     *
     * @param $EmployeeEducationId
     * @return mixed
     */
    public static function get($entityId)
    {
        $entity = EmployeeEducation::where('id', $entityId)->first();
        return $entity;
    }

    /**
     * Get EmployeeEducation list
     *
     * @param $employeeId
     * @param $withPaginate
     * @return mixed
     */
    public static function getListByEmployee($employeeId, $withPaginate = false)
    {
        $entity = EmployeeEducation::where('employee_id', $employeeId);

        if($withPaginate){
            return $entity->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entity->get();
        }
    }

    /**
     * Insert (or update)  EmployeeEducation
     *
     * @param EmployeeEducation $srcEntity
     * @return EmployeeEducation
     */
    public static function set (EmployeeEducation $srcEntity)
    {
        if (empty($srcEntity->id)) {
            $entity = new EmployeeEducation;
        } else {
            $entity = EmployeeEducation::where('id', $srcEntity->id)->firstOrFail();
        }
        $entity->employee_id = $srcEntity->employee_id;
        $entity->education_place = $srcEntity->education_place;
        $entity->start_date = $srcEntity->start_date;
        $entity->end_date = $srcEntity->end_date;
        $entity->save();

        return self::get($entity->id);
    }


    /**
     * Delete EmployeeEducation
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        EmployeeEducation::where('id', $entityId)->delete();
        return true;
    }

    /**
     * Delete EmployeeEducation by employee_id
     *
     * @param $employeeId
     * @return bool
     */
    public static function deleteByEmployee($employeeId)
    {
        EmployeeEducation::where('employee_id', $employeeId)->delete();
        return true;
    }
}