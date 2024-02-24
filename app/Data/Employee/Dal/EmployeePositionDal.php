<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2018-12-22
 * Time: 1:28 PM
 */

namespace App\Data\Employee\Dal;


use App\Data\Employee\Model\EmployeePosition;
use App\Data\Helper\Assistant;

class EmployeePositionDal
{
    /**
     * Get EmployeePosition by Id
     *
     * @param $EmployeePositionId
     * @return mixed
     */
    public static function get($entityId)
    {
        $entity = EmployeePosition::where('id', $entityId)->firstOrFail();
        return $entity;
    }

    /**
     * Get EmployeePosition list
     *
     * @param $withPaginate
     * @return mixed
     */
    public static function getList($withPaginate = false)
    {
        if($withPaginate){
            return EmployeePosition::paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return EmployeePosition::get();
        }
    }

    /**
     * Insert (or update)  EmployeePosition
     *
     * @param EmployeePosition $srcEntity
     * @return EmployeePosition
     */
    public static function set (EmployeePosition $srcEntity)
    {
        if (empty($srcEntity->id)) {
            $entity = new EmployeePosition;
        } else {
            $entity = EmployeePosition::where('id', $srcEntity->id)->firstOrFail();
        }
        $entity->value = $srcEntity->value;
        $entity->save();
        return self::get($entity->id);
    }


    /**
     * Delete EmployeePosition
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        EmployeePosition::where('id', $entityId)->delete();
        return true;
    }
}