<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2018-12-22
 * Time: 1:28 PM
 */

namespace App\Data\Employee\Dal;


use App\Data\Employee\Model\EmployeeWorkExperience;
use App\Data\Helper\Assistant;

class EmployeeWorkExperienceDal
{
    /**
     * Get EmployeeWorkExperience by Id
     *
     * @param $EmployeeWorkExperienceId
     * @return mixed
     */
    public static function get($entityId)
    {
        $entity = EmployeeWorkExperience::where('id', $entityId)->firstOrFail();
        return $entity;
    }

    /**
     * Get EmployeeWorkExperience list
     *
     * @param $employeeId
     * @param $withPaginate
     * @return mixed
     */
    public static function getListByEmployee($employeeId, $withPaginate = false)
    {
        $entity = EmployeeWorkExperience::where('employee_id', $employeeId);

        if($withPaginate){
            return $entity->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entity->get();
        }
    }

    /**
     * Insert (or update)  EmployeeWorkExperience
     *
     * @param EmployeeWorkExperience $srcEntity
     * @return EmployeeWorkExperience
     */
    public static function set (EmployeeWorkExperience $srcEntity)
    {
        if (empty($srcEntity->id)) {
            $entity = new EmployeeWorkExperience;
        } else {
            $entity = EmployeeWorkExperience::where('id', $srcEntity->id)->firstOrFail();
        }
        $entity->employee_id = $srcEntity->employee_id;
        $entity->work_place = $srcEntity->work_place;
        $entity->description = $srcEntity->description;
        $entity->start_date = $srcEntity->start_date;
        $entity->save();

        return self::get($entity->id);
    }


    /**
     * Delete EmployeeWorkExperience
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        EmployeeWorkExperience::where('id', $entityId)->delete();
        return true;
    }

    /**
     * Delete EmployeeWorkExperience by employee_id
     *
     * @param $employeeId
     * @return bool
     */
    public static function deleteByEmployee($employeeId)
    {
        EmployeeWorkExperience::where('employee_id', $employeeId)->delete();
        return true;
    }
}