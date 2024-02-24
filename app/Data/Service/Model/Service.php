<?php

namespace App\Data\Service\Model;

use App\Data\Core\Model\BaseTableModel;
use App\Data\Translation\Dal\TranslationDal;

class Service extends BaseTableModel
{
    public function __construct()
    {
        parent::__construct(
            'service',
            false
        );
    }


    public function serviceThematicGroup()
    {
        return $this->hasOne('App\Data\Service\Model\ServiceThematicGroup', 'id', 'service_thematic_group_id');
    }

    public function counterType()
    {
        return $this->hasOne('App\Data\Core\Model\CounterType', 'id', 'counter_type_id');
    }

    public function serviceSteps()
    {
        return $this->hasMany('App\Data\Service\Model\ServiceStep', 'service_id', 'id');
    }

    public function licenseType()
    {
        return $this->belongsTo('App\Data\Service\Model\LicenseType');
    }

    public function serviceType()
    {
//        return $this->belongsTo(ServiceType::class);

        $relation = $this->belongsTo(ServiceType::class);

        $serviceType = new ServiceType();
        TranslationDal::generateQuery($serviceType->getTableName(), $relation, $serviceType->getEntityColumnList(true), true);

        return $relation;
    }

    public function serviceCostHistList()
    {
        return $this->hasMany(ServiceCostHist::class);
    }

    public function latestServiceCostHist()
    {
        return $this->hasOne(ServiceCostHist::class)->latest('create_date');
    }
}
