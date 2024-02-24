<?php

namespace App\Data\Service\Dal;

use App\Data\Core\Dal\BaseDal;
use App\Data\Service\Model\ServiceStepExt;
use App\Data\Service\Model\ServiceStepMap;
use App\Data\Translation\Dal\TranslationDal;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceStepMapDal extends BaseDal
{
    protected $rules = [
        'service_id' => 'required|numeric',
        'service_step_id' => 'required|numeric',
        'step_number' => 'required|numeric'
    ];

    public function __construct()
    {
        parent::__construct(ServiceStepMap::class);
    }

    public function getExtByService($serviceId, bool $translateData = false)
    {
        $entityList = ServiceStepExt::where('service_step_ext.service_id', $serviceId)
            ->orderBy('service_step_ext.step_number');
        TranslationDal::generateViewQuery('service_step', $entityList, ['service_step_ext.*'], $translateData);
        return $entityList->get();
    }

    public function getExtByStepIdList($serviceStepIdList, $serviceIdList, bool $translateData = false)
    {
        $entityList = ServiceStepExt::whereIn('service_step_ext.id', $serviceStepIdList)
            ->whereIn('service_step_ext.service_id', $serviceIdList)
            ->orderBy('service_step_ext.step_number');
        TranslationDal::generateViewQuery('service_step', $entityList, ['service_step_ext.*'], $translateData);
        return $entityList->get();
    }

    public function getByService($serviceId, bool $translateData = false)
    {
        $entityList = ServiceStepMap::where('service_id', $serviceId)
            ->with(['serviceStep', 'service'])
            ->orderBy('step_number');

        return $entityList->get();
    }

    public function set ($entity_data)
    {
        $entity_data = $this->prepareSet(parent::objectToArray($entity_data));
        return parent::set($entity_data);
    }

    private function prepareSet($entity_data)
    {
        if (empty($entity_data["id"])) {
            $executionParallelNo = ServiceStepMap::where('service_id', $entity_data["service_id"])->count();
            if (is_null($executionParallelNo))
                $executionParallelNo = 0;
            $entity_data["execution_parallel_no"] = $executionParallelNo + 1;
        }
        return $entity_data;
    }

    public function delete($entityId)
    {
        $serviceStepMap = self::get($entityId);
        try {
            DB::beginTransaction();
            (new ServiceStepResultDal())->deleteByServiceStepAndService($serviceStepMap->service_step_id, $serviceStepMap->service_id);
            (new ServiceStepRequiredDocumentDal())->deleteByServiceStepAndService($serviceStepMap->service_step_id, $serviceStepMap->service_id);
            parent::delete($entityId);
            self::reorderServiceStepMapExecutionParallel($serviceStepMap->service_id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

    public static function reorderServiceStepMapExecutionParallel($serviceId)
    {
        $serviceStepMapList = ServiceStepMap::where('service_id',$serviceId)->get();
        $isNeedToReorder = ServiceStepMap::where('service_id',$serviceId)
                ->where('execution_parallel_no','>',count($serviceStepMapList))
                ->count() != 0;

        if($isNeedToReorder){
            $executionParallelNo = 1;
            $executionParallelPairList = new Collection([['srcNo' => 0, 'newNo'  => 0]]);
            foreach ($serviceStepMapList as $serviceStepMap)
            {
                $existPair = $executionParallelPairList->where('srcNo', $serviceStepMap->execution_parallel_no)->first();
                if(is_null($existPair)) {
                    $executionParallelPair = new \stdClass();
                    $executionParallelPair->srcNo = $serviceStepMap->execution_parallel_no;
                    $executionParallelPair->newNo = $executionParallelNo;
                    $executionParallelNo++;
                    $executionParallelPairList->push($executionParallelPair);
                    $existPair = $executionParallelPair;
                }
                $serviceStepMap->execution_parallel_no = $existPair->newNo;
                $serviceStepMap->save();
            }
        }
    }

    public function getListByServiceArray($serviceIdArray)
    {
        $serviceStepMapList = ServiceStepMap::
            select(
                'service_step_id',
                DB::raw('max(execution_parallel_no) as execution_parallel_no'),
                DB::raw('max(is_required) as is_required'),
                DB::raw('min(step_number) as step_number')
            )
            ->whereIn('service_id', $serviceIdArray)
            ->where('is_active', true)
            ->groupBy('service_step_id')
            ->with('serviceStepWithLastCostHist')
            ->orderBy('step_number')
            ->get();

        return $serviceStepMapList;
    }

    public function deleteByServiceId(int $serviceId)
    {
        ServiceStepMap::where('service_id',$serviceId)->delete();
    }
}
