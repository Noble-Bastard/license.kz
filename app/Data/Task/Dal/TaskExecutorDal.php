<?php
/**
 * Created by PhpStorm.
 * User: R.Biewald
 * Date: 17.05.2018
 * Time: 17:24
 */

namespace App\Data\Task\Dal;


use App\Data\Helper\Assistant;
use App\Data\Task\Model\ExecutorHourlyRate;
use App\Data\Task\Model\TaskExecutorExt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class TaskExecutorDal
{

    public static function get($entityId)
    {
        $taskExecutor = TaskExecutorExt::where('id', $entityId)->firstOrFail();
        return $taskExecutor;
    }
    /**
     * @param $taskId
     * @return TaskExecutorExt
     */
    public static function getListByTask($taskId){
        $taskExecutorList = TaskExecutorExt::where('task_id', $taskId)->get();
        return $taskExecutorList;
    }

    /**
     * @param int $executorId
     * @param float $hourlyRate
     */
    public static function setHourlyRate(int $executorId, float $hourlyRate)
    {
        $executorHourlyRate = new ExecutorHourlyRate();
        $executorHourlyRate->hourly_rate = $hourlyRate;
        $executorHourlyRate->executor_id = $executorId;
        $executorHourlyRate->created_by = Auth::id();
        $executorHourlyRate->create_date=Assistant::getCurrentDate();
        $executorHourlyRate->save();
    }


}