<?php
/**
 * Created by PhpStorm.
 * User: R.Biewald
 * Date: 17.05.2018
 * Time: 17:24
 */

namespace App\Data\Task\Dal;


use App\Data\Task\Model\ExecutorGroup;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ExecutorGroupDal
{
    /**
     * Get ExecutorGroup by Id
     *
     * @param $entityId
     * @return ExecutorGroup
     */
    public static function get($entityId)
    {
        $executorGroup = ExecutorGroup::where('id', $entityId)->firstOrFail();
        return $executorGroup;
    }


    /**
     * @return Collection|ExecutorGroup[]
     */
    public static function getList( bool $withPaginate)
    {
        if($withPaginate){
            return $entities = ExecutorGroup::paginate(15);
        } else {
            return  $entities = ExecutorGroup::get();
        }

    }
    
    /**
     * Insert (or update)  ExecutorGroup
     *
     * @param ExecutorGroup $srcEntity
     * @return ExecutorGroup
     */
    public static function set (ExecutorGroup $srcEntity)
    {
        if (empty($srcEntity->id)) {
            $entity = new ExecutorGroup;
        } else {
            $entity = ExecutorGroup::where('id', $srcEntity->id)->firstOrFail();
        }
        $entity->name = $srcEntity->name;
        $entity->save();
        return $entity;
    }

    /**
     * Delete ExecutorGroup
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        ExecutorGroup::where('id', $entityId)->delete();
        return true;
    }
}