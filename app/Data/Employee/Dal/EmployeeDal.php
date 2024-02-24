<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2018-12-22
 * Time: 1:28 PM
 */

namespace App\Data\Employee\Dal;


use App\Data\Employee\Model\Employee;
use App\Data\Helper\Assistant;
use Illuminate\Support\Facades\App;

class EmployeeDal
{
    /**
     * Get Employee by Id
     *
     * @param $EmployeeId
     * @return mixed
     */
    public static function get($entityId)
    {
        $entity = Employee::where('id', $entityId)->firstOrFail();
        return $entity;
    }

    /**
     * Get Employee list
     *
     * @param $employeeId
     * @param $withPaginate
     * @return mixed
     */
    public static function getListByPosition($positionId, $withPaginate = false)
    {
        if($positionId){
            $entity = Employee::query();
        }
        else {
            $entity = Employee::where('employee_position_id', $positionId);
        }

        if($withPaginate){
            return $entity->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entity->get();
        }
    }

    /**
     * Get Employee list
     *
     * @param $withPaginate
     * @return mixed
     */
    public static function getList($withPaginate = false)
    {
        $locale = App::getLocale();

        $entity = Employee::
            leftJoin('employee_position', 'employee_position.id', '=', 'employee.employee_position_id')
            ->select('employee.*', 'employee_position.value as employee_position_value')
        ;
        if($withPaginate){
            return $entity->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entity->get();
        }
    }

    /**
     * Insert (or update)  Employee
     *
     * @param Employee $srcEntity
     * @return Employee
     */
    public static function set (Employee $srcEntity)
    {
        if (empty($srcEntity->id)) {
            $entity = new Employee;
        } else {
            $entity = Employee::where('id', $srcEntity->id)->firstOrFail();
        }

        $entity->employee_position_id = $srcEntity->employee_position_id;
        $entity->first_name = $srcEntity->first_name;
        $entity->last_name = $srcEntity->last_name;
        $entity->description = $srcEntity->description;
        $entity->phone = $srcEntity->phone;
        $entity->address = $srcEntity->address;
        $entity->email = $srcEntity->email;
        $entity->save();

        return self::get($entity->id);
    }


    /**
     * Delete Employee
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        Employee::where('id', $entityId)->delete();
        return true;
    }


    public static function setPhotoPath($entityId, $photoPath)
    {
        $entity = Employee::where('id', $entityId)->first();
        $entity->photo_path = $photoPath;
        $entity->save();
    }
}