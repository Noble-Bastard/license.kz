<?php

namespace App\Data\Service\Model;

use App\Data\Core\Model\BaseTableModel;
use App\Data\Translation\Dal\TranslationDal;


class ServiceStepMap extends BaseTableModel
{

    public function __construct()
    {
        parent::__construct(
            'service_step_map',
            false
        );
    }


    public function service()
    {
        return $this->hasOne('App\Data\Service\Model\Service','id','service_id');
    }

    public function serviceStep()
    {
        return $this->hasOne('App\Data\Service\Model\ServiceStep','id','service_step_id')
            ->with('service')
            ->with('counterType')
            ->with('serviceStepCostHistList')
            ->with('serviceStepRequiredDocumentList')
            ->with('serviceStepResultList')
            ->with('latestServiceStepCostHist');
    }

    public function serviceStepWithLastCostHist()
    {
        $hasOne = $this->hasOne('App\Data\Service\Model\ServiceStep','id','service_step_id');

        $serviceStep = new ServiceStep;
        TranslationDal::generateQuery($serviceStep->table, $hasOne, $serviceStep->getEntityColumnList(true), true);

        return $hasOne
            ->with('service')
            ->with('counterType')
            ->with('serviceStepCostHistLast')
            ->with('serviceStepResultList');
    }

}
