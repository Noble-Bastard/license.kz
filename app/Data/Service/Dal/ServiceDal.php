<?php

namespace App\Data\Service\Dal;

use App\Data\Catalog\Dal\CatalogDal;
use App\Data\Catalog\Dal\ServiceCatalogDal;
use App\Data\Core\Dal\SettingDal;
use App\Data\DocumentTemplate\CommercialOfferDocumentManager;
use App\Data\DocumentTemplate\ServiceRequirementDocumentManager;
use App\Data\Helper\Assistant;
use App\Data\Helper\CatalogTypeList;
use App\Data\Helper\EmailNotifyTypeList;
use App\Data\Helper\ServiceStatusList;
use App\Data\Notify\Model\EmailJournal;
use App\Data\RegistrationFormTemplate\Dal\ServiceRegistrationFormTemplateDal;
use App\Data\RegistrationFormTemplate\Model\ServiceRegistrationFormTemplate;
use App\Data\Service\Helper\CommercialOfferTypeList;
use App\Data\Service\Model\CommercialOffer;
use App\Data\Service\Model\CommercialOfferService;
use App\Data\Core\Model\Currency;
use App\Data\Service\Model\ServiceStep;
use App\Data\Service\Model\ServiceCostHist;
use App\Data\Service\Model\ServiceStatus;
use App\Data\Service\Model\ServiceStepExt;
use App\Data\Translation\Dal\TranslationDal;
use App\Mail\CommercialOfferNotification;
use App\Mail\ServiceRequirementNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

    /**
     * Альтернативный метод получения данных услуги без использования view service_ext
     * Использует прямые запросы к таблицам для избежания проблем с view
     *
     * @param $entityId
     * @param bool $translateData
     * @return mixed
     */
    public static function getServiceInfo($entityId, bool $translateData = false)
    {
        try {
            // Используем прямые запросы к таблицам вместо view service_ext
            $service = Service::with([
                'serviceThematicGroup.serviceCategory',
                'counterType',
                'licenseType'
            ])->find($entityId);

            if (!$service) {
                return null;
            }

            // Получаем дополнительные данные из связанных таблиц
            $latestCostHist = ServiceCostHist::where('service_id', $entityId)
                ->latest('create_date')
                ->first();

            $totalServiceCost = 0;
            $totalExecutionWorkDay = 0;
            $currencyId = null;

            if ($latestCostHist) {
                $totalServiceCost = $latestCostHist->base_cost + $latestCostHist->additional_cost;
                $currencyId = $latestCostHist->currency_id;
            }

            // Получаем общие данные о шагах услуги
            $serviceSteps = ServiceStep::join('service_step_map', function ($join) use ($entityId) {
                $join->on('service_step_map.service_step_id', '=', 'service_step.id')
                    ->where('service_step_map.service_id', '=', $entityId);
            })
            ->selectRaw('SUM(service_step.execution_work_day_cnt) as total_days')
            ->first();

            if ($serviceSteps) {
                $totalExecutionWorkDay = $serviceSteps->total_days ?? 0;
            }

            // Получаем валюту
            $currency = null;
            if ($currencyId) {
                $currency = Currency::find($currencyId);
            }

            // Создаем объект с данными услуги
            $result = new \stdClass();
            $result->id = $service->id;
            $result->name = $service->name;
            $result->code = $service->code;
            $result->description = $service->description;
            $result->is_active = $service->is_active;
            $result->service_start_date = $service->service_start_date;
            $result->service_end_date = $service->service_end_date;
            $result->service_thematic_group_id = $service->service_thematic_group_id;
            $result->service_thematic_group_name = $service->serviceThematicGroup ? $service->serviceThematicGroup->name : null;
            $result->execution_days_from = $service->execution_days_from;
            $result->execution_days_to = $service->execution_days_to;
            $result->counter_type_id = $service->counter_type_id;
            $result->counter_type_name = $service->counterType ? $service->counterType->name : null;
            $result->total_service_cost = $totalServiceCost;
            $result->total_execution_work_day_cnt = $totalExecutionWorkDay;
            $result->currency_id = $currencyId;
            $result->currency_name = $currency ? $currency->name : null;
            $result->service_category_id = $service->serviceThematicGroup && $service->serviceThematicGroup->serviceCategory ? $service->serviceThematicGroup->serviceCategory->id : null;
            $result->country_id = $service->serviceThematicGroup && $service->serviceThematicGroup->serviceCategory ? $service->serviceThematicGroup->serviceCategory->country_id : null;
            $result->comment = $service->comment;
            $result->license_type_id = $service->license_type_id;
            $result->executive_agency = $service->executive_agency;
            $result->live_period = $service->live_period;
            $result->service_type_id = $service->service_type_id;
            $result->base_cost = $latestCostHist ? $latestCostHist->base_cost : 0;
            $result->additional_cost = $latestCostHist ? $latestCostHist->additional_cost : 0;
            $result->service_currency_id = $currencyId;
            $result->service_currency_name = $currency ? $currency->name : null;
            $result->additional_approvals = $service->additional_approvals;
            $result->special_terms = $service->special_terms;
            $result->npa_link = $service->npa_link;

            // Добавляем связи для совместимости
            $result->serviceThematicGroup = $service->serviceThematicGroup;
            $result->counterType = $service->counterType;
            $result->licenseType = $service->licenseType;
            $result->latestServiceCostHist = $latestCostHist;

            return $result;

        } catch (\Exception $e) {
            Log::error('Error in getServiceInfo: ' . $e->getMessage());
            // Fallback к обычному методу если что-то пойдет не так
            return self::get($entityId, $translateData);
        }
    }

    public function getExtByName(int $licenseTypeId, int $serviceThematicGroupId, string $serviceName)
    {
        $entityList = ServiceExt::where('service_ext.name', $serviceName)
            ->where('service_ext.license_type_id', $licenseTypeId)
            ->where('service_ext.service_thematic_group_id', $serviceThematicGroupId);

        TranslationDal::generateViewQuery(self::entityName, $entityList, self::baseField, false);

        return $entityList->first();

    }

    public function getByName(int $licenseTypeId, int $serviceThematicGroupId, string $serviceName)
    {
        $entityList = Service::where('name', $serviceName)
            ->where('license_type_id', $licenseTypeId)
            ->where('service_thematic_group_id', $serviceThematicGroupId);

        TranslationDal::generateQuery(self::entityName, $entityList, ['service.*'], false);

        return $entityList->first();
    }

    public function getByCode(string $serviceCode)
    {
        $entityList = Service::where('code', $serviceCode);

        TranslationDal::generateQuery(self::entityName, $entityList, ['service.*'], false);

        return $entityList->first();
    }


    public static function getServiceListByServiceCategoryAndCountry($serviceCategoryId, $countryId, bool $translationData = false)
    {
        $entityList = ServiceExt::where('service_ext.service_category_id', $serviceCategoryId)
            ->where('service_ext.country_id', $countryId);

        TranslationDal::generateViewQuery(self::entityName, $entityList, self::baseField, $translationData);
        $result = $entityList->get();

        return $result;
    }

    public static function search($searchValue)
    {
            $results = DB::select(
                DB::raw("select `service_ext`.`id`
        from `service_ext`
                 left join `translation` as `tn_name_c`
                           on `tn_name_c`.`pk_value` = `service_ext`.`id` and `tn_name_c`.`translation_attribute_id` = 12 and
            `tn_name_c`.`language_id` = 1
                 left join `translation` as `tn_name_en`
                           on `tn_name_en`.`pk_value` = `service_ext`.`id` and `tn_name_en`.`translation_attribute_id` = 12 and
            `tn_name_en`.`language_id` = 2
            and `tn_name_en`.`value` like :searchA
        where `service_ext`.`name` like :searchB
        "), array(
                'searchA' => '%'.$searchValue.'%',
                'searchB' => '%'.$searchValue.'%'
            ));

        $results = array_column( $results, 'id' );

        $entityList = ServiceExt::whereIn('service_ext.id', $results);

        TranslationDal::generateViewQuery(self::entityName, $entityList, ['service_ext.name'], true, ['name']);

        return $entityList->select('service_ext.id', 'name')->with('catalog')->get();
    }

    /**
     * @return ServiceExt[]|\Illuminate\Support\Collection
     */
    public static function getList(
        $withPaginate = false,
        $countryId = null,
        $serviceCategoryId = null,
        $searchText = null,
        $serviceIdList = null
    )
    {
        $entityList = ServiceExt::
        join('service_category as sc', 'service_ext.service_category_id', '=', 'sc.id')
            ->orderBy("sc.order_no")
            ->orderBy("service_ext.service_thematic_group_name");

        $baseFields = self::baseField;
        array_push($baseFields, "sc.name as service_category_name");
        TranslationDal::generateViewQuery(self::entityName, $entityList, self::baseField, true);

        if (!is_null($countryId)) {
            $entityList = $entityList->where('sc.country_id', $countryId);
        }

        if (!is_null($serviceCategoryId)) {
            $entityList = $entityList->where('sc.id', $serviceCategoryId);
        }

        if (!is_null($searchText)) {
            $entityList->where(function ($query) use ($searchText) {
                $query->orWhere('service_ext.name', 'like', '%' . $searchText . '%')
                    ->orWhere('service_ext.description', 'like', '%' . $searchText . '%')
                    ->orWhere('service_ext.code', 'like', '%' . $searchText . '%');
            });
        }

        if (!is_null($serviceIdList)) {
            $entityList = $entityList->whereIn('service_ext.id', $serviceIdList);
        }

        if ($withPaginate) {
            return $entityList->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entityList->get();
        }
    }

    public static function getServiceStatusList()
    {
        $baseFields = [
            'service_status.id',
            'service_status.name'
        ];

        $entityList = ServiceStatus::from('service_status')
            ->where('service_status.id', '!=', ServiceStatusList::SendBill)
            ->where('service_status.id', '!=', ServiceStatusList::ClientCheck)
            ->orderBy('service_status.status_order');

        TranslationDal::generateQuery('service_status', $entityList, $baseFields, true);

        return $entityList->get();
    }


    public static function set($srcEntity)
    {

        try {
            DB::beginTransaction();

            $entity = empty($srcEntity->id) ? new Service : (new Service)->where('id', $srcEntity->id)->firstOrFail();
            $entity->is_active = $srcEntity->is_active;
            $entity->name = $srcEntity->name;
            $entity->code = $srcEntity->code;
            $entity->description = $srcEntity->description;
            $entity->comment = $srcEntity->comment;
            $entity->execution_days_from = $srcEntity->execution_days_from;
            $entity->execution_days_to = $srcEntity->execution_days_to;
            $entity->service_thematic_group_id = $srcEntity->service_thematic_group_id;
            $entity->service_start_date = $srcEntity->service_start_date;
            $entity->service_end_date = $srcEntity->service_end_date;
            $entity->counter_type_id = $srcEntity->counter_type_id;
            $entity->license_type_id = $srcEntity->license_type_id;
            $entity->service_type_id = $srcEntity->service_type_id;
            $entity->executive_agency_id = $srcEntity->executive_agency_id;
            $entity->live_period = $srcEntity->live_period;
            $entity->service_type_id = $srcEntity->service_type_id;
            $entity->additional_approvals = $srcEntity->additional_approvals;
            $entity->executive_agency = $srcEntity->executive_agency;
            $entity->save();

            TranslationDal::setEntityTranslation(self::entityName, $entity->id, $srcEntity);

            self::setServiceCost($entity->id, /*property_exists($srcEntity, 'attributes.base_cost') && */isset($srcEntity->base_cost) ? $srcEntity->base_cost : 0, /*property_exists($srcEntity, 'attributes.additional_cost') && */isset($srcEntity->additional_cost) ? $srcEntity->additional_cost : 0);

            $serviceRegistrationFormTemplate = new ServiceRegistrationFormTemplate();
            $serviceRegistrationFormTemplate->service_id = $entity->id;
            $serviceRegistrationFormTemplate->registration_form_template_id = $srcEntity->registration_form_template_id;
            ServiceRegistrationFormTemplateDal::set($serviceRegistrationFormTemplate);

            DB::commit();
            return self::get($entity->id);


        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }

    }

    public static function setServiceActiveStatus($entityId, $isActive)
    {
        $entity = (new Service)->where('id', $entityId)->firstOrFail();
        $entity->is_active = $isActive;
        $entity->save();
        return $entity;
    }


    /**
     * Delete Service
     *
     * @param $entityId
     * @return bool
     * @throws \Exception
     */
    public static function delete($entityId)
    {

        try {
            DB::beginTransaction();
            TranslationDal::deleteByEntity(self::entityName, $entityId);
            ServiceRegistrationFormTemplateDal::deleteByService($entityId);

            (new ServiceStepResultDal())->deleteByServiceId($entityId);
            (new ServiceStepRequiredDocumentDal())->deleteByServiceId($entityId);
            (new ServiceStepMapDal())->deleteByServiceId($entityId);

            Service::where('id', $entityId)->delete();

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }

    }

    public static function move($entityId, $serviceThematicGroupId)
    {
        $entity = Service::where('id', $entityId)->first();

        $entity->service_thematic_group_id = $serviceThematicGroupId;
        $entity->save();
    }


    public static function getServiceTotals($serviceIdList, $serviceStepIdList)
    {
        $result = new \stdClass();
        $result->stepCostTotal = 0;
        $result->stepTaxTotal = 0;
        $result->stepTaxMRPTotal = 0;
        $result->executionWorkDayTotal = 0;

        $serviceStepExtQuery = ServiceStepExt::whereIn('service_id', $serviceIdList);
        if (!is_null($serviceStepIdList)) {
            $serviceStepExtQuery = $serviceStepExtQuery->whereIn('id', $serviceStepIdList);
        }

        $serviceStepExtList = $serviceStepExtQuery->select(
            DB::raw('max(step_cost) as step_cost'),
            DB::raw('max(step_tax) as step_tax')
        )
            ->groupBy('id')
            ->get();


        foreach ($serviceStepExtList as $serviceStepExt) {
            $result->stepCostTotal += $serviceStepExt->step_cost;
            $result->stepTaxTotal += $serviceStepExt->step_tax;
        }

        $serviceStepExtQuery = ServiceStepExt::whereIn('service_id', $serviceIdList);
        if (!is_null($serviceStepIdList)) {
            $serviceStepExtQuery = $serviceStepExtQuery->whereIn('id', $serviceStepIdList);
        }
        $result->executionWorkDayTotal = $serviceStepExtQuery->groupBy('execution_parallel_no')
        ->get([
            'execution_parallel_no',
            DB::raw('MAX(execution_work_day_cnt) as execution_work_day_cnt')
        ])
        ->sum('execution_work_day_cnt');

        $serviceList = ServiceDal::getListByIdArray($serviceIdList, true);
        $result->stepCostTotal += self::getServiceCost($serviceList);

        $numberToWords = new \NumberToWords\NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer(\Illuminate\Support\Facades\App::getLocale());

        $mrp = SettingDal::getMrp();

        $result->stepTaxMRPTotal = $result->stepTaxTotal;
        $result->stepTaxTotal *= $mrp;

        $result->stepCostTotalWords = $numberTransformer->toWords($result->stepCostTotal);
        $result->stepTaxTotalWords = $numberTransformer->toWords($result->stepTaxTotal);
        $result->serviceTotalWords = $numberTransformer->toWords($result->stepCostTotal + $result->stepTaxTotal);

        $result->executionWorkDayTotalWords = $numberTransformer->toWords($result->executionWorkDayTotal);

        $serviceList = ServiceStepExt::whereIn('service_id', $serviceIdList)->with('currencyTrans')->first();
        $result->currency = $serviceList->currencyTrans;

        return $result;
    }

    /**
     * Альтернативный метод получения списка услуг по массиву ID без использования view service_ext
     * @param $idList
     * @param bool $translateData
     * @return mixed
     */
    public static function getServiceListByIdArray($idList, bool $translateData = false)
    {
        try {
            $services = Service::with([
                'serviceThematicGroup.serviceCategory',
                'counterType',
                'licenseType'
            ])->whereIn('id', $idList)->get();

            $result = [];
            foreach ($services as $service) {
                $serviceInfo = self::getServiceInfo($service->id, $translateData);
                $result[] = $serviceInfo;
            }

            return collect($result);

        } catch (\Exception $e) {
            Log::error('Error in getServiceListByIdArray: ' . $e->getMessage());
            // Fallback к обычному методу если что-то пойдет не так
            return self::getListByIdArray($idList, $translateData);
        }
    }

    public static function generateCommercialOffer($serviceIdList)
    {
        return (new CommercialOfferDocumentManager($serviceIdList))->getPdfFileName();
    }

    public static function generateServiceRequirement($serviceIdList)
    {
        return (new ServiceRequirementDocumentManager($serviceIdList))->getPdfFileName();
    }

    public static function getServiceCost($serviceList)
    {
        $totalCost = 0;
        if ($serviceList->count() > 0) {
            $totalCost += $serviceList[0]->latestServiceCostHist == null ? 0 : $serviceList[0]->latestServiceCostHist->base_cost;
            $selectedAdditionalCost = $serviceList[0]->latestServiceCostHist == null ? 0 : $serviceList[0]->latestServiceCostHist->additional_cost;
            foreach ($serviceList as $service) {
                $totalCost += $service->latestServiceCostHist == null ? 0 : $service->latestServiceCostHist->additional_cost;
            }
            $totalCost -= $selectedAdditionalCost;
        }

        return $totalCost;
    }

    public static function setServiceCost($serviceId, $baseCost, $additionalCost)
    {
        $currency = (new CurrencyDal())->getByCode('KZT');
        $serviceCostHist = new ServiceCostHist();
        $serviceCostHist->service_id = $serviceId;
        $serviceCostHist->base_cost = $baseCost;
        $serviceCostHist->additional_cost = $additionalCost;
        $serviceCostHist->created_by = Auth::id();
        $serviceCostHist->currency_id = $currency->id;
        $serviceCostHist->save();
    }

    public function sendCommercialOffer($params)
    {
        $this->createCommercialOffer($params, CommercialOfferTypeList::commercialOffer);

        $commercialOffer = ServiceDal::generateCommercialOffer($params['serviceIdList']);

        $emailEntity = new EmailJournal();
        $emailEntity->recipients = $params['emailToSend'];
        $emailEntity->subject = trans('messages.services.commercialOffer.email_title');
        $emailEntity->email_notify_type_id = EmailNotifyTypeList::NewMessage;

        $attachList = array();
        $attach = new \stdClass();
        $attach->file_path = $commercialOffer;
        $attach->name = trans('messages.services.commercialOffer.email_title');
        array_push($attachList, $attach);

        (new CommercialOfferNotification($emailEntity, $attachList))->setData();
    }

    public function sendServiceRequirement($params)
    {
        $this->createCommercialOffer($params, CommercialOfferTypeList::requirement);

        $serviceRequirement = ServiceDal::generateServiceRequirement($params['serviceIdList']);

        $emailEntity = new EmailJournal();
        $emailEntity->recipients = $params['emailToSend'];
        $emailEntity->subject = trans('messages.services.serviceRequirement.email_title');
        $emailEntity->email_notify_type_id = EmailNotifyTypeList::NewMessage;

        $attachList = array();
        $attach = new \stdClass();
        $attach->file_path = $serviceRequirement;
        $attach->name = trans('messages.services.serviceRequirement.email_title');
        array_push($attachList, $attach);

        (new ServiceRequirementNotification($emailEntity, $attachList))->setData();
    }

    public function createCommercialOffer($params, $commercialOfferType)
    {
        $commercialOfferDal = new CommercialOfferDal();

        $commercialOffer = new CommercialOffer();
        $commercialOffer->name = $params['name'];
        $commercialOffer->phone = $params['phone'];
        $commercialOffer->email = $params['emailToSend'];
        $commercialOffer->service_id = '';
        $commercialOffer->commercial_offer_type_id = $commercialOfferType;
        $commercialOffer = $commercialOfferDal->set($commercialOffer);
        foreach ($params['serviceIdList'] as $serviceId){
            $commercialOfferService = new CommercialOfferService();
            $commercialOfferService->commercial_offer_id = $commercialOffer->id;
            $commercialOfferService->service_id = $serviceId;
            $commercialOfferService->save();
        }
    }
}
