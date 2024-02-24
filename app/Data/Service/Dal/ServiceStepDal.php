<?php

namespace App\Data\Service\Dal;

use App\Data\Core\Dal\BaseDal;
use App\Data\Core\Dal\SettingDal;
use App\Data\Helper\Assistant;
use App\Data\Service\Model\ServiceStep;
use App\Data\Service\Model\ServiceStepCostHist;
use App\Data\Translation\Dal\TranslationDal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceStepDal extends BaseDal
{
    protected $rules = [
        'description' => 'required|string|max:4096',
        'description_en' => 'string|max:4096',
        'execution_work_day_cnt' => 'required|numeric',
        'counter_type_id' => 'required|numeric',
        'execution_time_plan' => 'required|numeric',
        'cost' => 'required|numeric',
        'tax' => 'numeric',
        'currency_id' => 'required|numeric'
    ];

    public function __construct()
    {
        parent::__construct(ServiceStep::class);
    }

    public function getByLicenseType($licenseTypeId, bool $translateData = false)
    {
        $entityList = ServiceStep::where('license_type_id', $licenseTypeId)
            ->with(['latestServiceStepCostHist', 'counterType', 'licenseType']);
        TranslationDal::generateQuery($this->tableName, $entityList, ['service_step.*'], $translateData);
        return $entityList->get();
    }

    public function getByLicenseTypeAndDescription($licenseTypeId, string $serviceStepDescription)
    {
        $entityList = ServiceStep::where('license_type_id', $licenseTypeId)
            ->where('description', $serviceStepDescription);
        TranslationDal::generateQuery($this->tableName, $entityList, $this->getColumnListWithTableName(), false);
        return $entityList->first();
    }

    public function set($entity_data)
    {
        try {
            DB::beginTransaction();

            $cost = 0;
            if(isset($entity_data['cost'])) {
                $cost = $entity_data['cost'];
                unset($entity_data['cost']);
            }

            $tax = 0;
            if(isset($entity_data['tax'])) {
                $tax = $entity_data['tax'];
                unset($entity_data['tax']);
            }

            $tax *= SettingDal::getMrp();

            $currency_id = null;
            if(isset($entity_data['currency_id'])) {
                $currency_id = $entity_data['currency_id'];
                unset($entity_data['currency_id']);
            }

            $entity = parent::set($entity_data);

            if($currency_id != null && $tax != 0 && $cost != 0) {
                $oldCostHist = ServiceStepCostHistDal::getByServiceStep($entity->id)->sortByDesc('create_date')->first();
                if ($oldCostHist == null || $oldCostHist->cost != $cost || $oldCostHist->tax != $tax) {
                    $entityCostHist = new ServiceStepCostHist();
                    $entityCostHist->service_step_id = $entity->id;
                    $entityCostHist->cost = $cost;
                    $entityCostHist->tax = $tax;
                    $entityCostHist->currency_id = $currency_id;
                    $entityCostHist->created_by = Auth::id();
                    $entityCostHist->create_date = Assistant::getCurrentDate();
                    ServiceStepCostHistDal::set($entityCostHist);
                }
            }

            DB::commit();
            return  $entity;
        }
        catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }

    }

    public function delete($entityId)
    {
        try {
            DB::beginTransaction();
            ServiceStepCostHistDal::deleteByServiceStep($entityId);
            TranslationDal::deleteByEntity($this->tableName, $entityId);
            parent::delete($entityId);

            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

}
