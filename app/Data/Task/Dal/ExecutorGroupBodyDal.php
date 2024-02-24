<?php
/**
 * Created by PhpStorm.
 * User: R.Biewald
 * Date: 17.05.2018
 * Time: 17:24
 */

namespace App\Data\Task\Dal;


use App\Data\Task\Model\ExecutorGroupBody;
use App\Data\Task\Model\ExecutorGroupBodyExt;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ExecutorGroupBodyDal
{
    /**
     * Get ExecutorGroupBody by Id
     *
     * @param $entityId
     * @return ExecutorGroupBodyExt
     */
    public static function get($entityId)
    {
        $entity = ExecutorGroupBodyExt::where('id', $entityId)->firstOrFail();
        return $entity;
    }


    /**
     * @param $executorGroupId
     * @return Collection|ExecutorGroupBodyExt[]
     */
    public static function getListByExecutorGroupId($executorGroupId)
    {
        $entities = ExecutorGroupBodyExt::where('executor_group_id',$executorGroupId)
            ->get();
        return $entities;
    }


    /**
     * @param int $profileId
     * @param int $executorGroupId
     * @return ExecutorGroupBody
     */
    public static function assignProfileToExecutorGroup ($profileId, $executorGroupId)
    {

        $entity = ExecutorGroupBody::where('executor_group_id', $executorGroupId)
            ->where('profile_id', $profileId)
            ->first();
        if ($entity != null) {
            return $entity;
        } else {
            $entity = new ExecutorGroupBody();
        }

        $entity->profile_id = $profileId;
        $entity->executor_group_id = $executorGroupId;
        $entity->save();
        return $entity;
    }

    /**
     * @param int $profileId
     * @param int $executorGroupId
     * @return bool
     */
    public static function unassignProfileToExecutorGroup ($profileId, $executorGroupId)
    {
        $entity = ExecutorGroupBody::where('executor_group_id', $executorGroupId)
            ->where('profile_id', $profileId)
            ->first();
        if ($entity != null) {
            return self::delete($entity->id);
        }
        return false;
    }


    /**
     * @param int $executorGroupId
     * @return bool
     */
    public static function deleteByExecutorGroup($executorGroupId)
    {
        ExecutorGroupBody::where('executor_group_id', $executorGroupId)->delete();
        return true;
    }

    /**
     * @param int $profileId
     * @return bool
     */
    public static function deleteByProfile($profileId)
    {
        ExecutorGroupBody::where('profile_id', $profileId)->delete();
        return true;
    }

    /**
     * Delete ExecutorGroupBody
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        ExecutorGroupBody::where('id', $entityId)->delete();
        return true;
    }
}