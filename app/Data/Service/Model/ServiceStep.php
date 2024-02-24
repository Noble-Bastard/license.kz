<?php

namespace App\Data\Service\Model;

use App\Data\Core\Model\BaseTableModel;

class ServiceStep extends BaseTableModel
{

    public function __construct()
    {
        parent::__construct(
            'service_step',
            false
        );
    }

    public function service()
    {
        return $this->belongsTo('App\Data\Service\Model\Service');
    }

    public function counterType()
    {
        return $this->belongsTo('App\Data\Core\Model\CounterType');
    }

    public function serviceStepCostHistList()
    {
        return $this->hasMany('App\Data\Service\Model\ServiceStepCostHist');
    }

    public function latestServiceStepCostHist()
    {
        return $this->hasOne(ServiceStepCostHist::class)->latest('create_date');
    }

    public function serviceStepRequiredDocumentList()
    {
        return $this->hasMany('App\Data\Service\Model\ServiceStepRequiredDocument')
            ->with('serviceRequiredDocument');
    }

    public function serviceStepResultList()
    {
        return $this->hasMany('App\Data\Service\Model\ServiceStepResult')
            ->with('serviceResult');
    }

    public function licenseType(){
        return $this->belongsTo('App\Data\Service\Model\LicenseType');
    }

    public function serviceStepCostHistLast()
    {
        return $this->hasOne(ServiceStepCostHist::class)
            ->latest('create_date')
            ->with('currency');
    }
}
