<?php

namespace App\Data\Service\Model;

use App\Data\Core\Model\BaseTableModel;
use App\Data\Translation\Dal\TranslationDal;


class ServiceStepResult extends BaseTableModel
{

    public function __construct()
    {
        parent::__construct(
            'service_step_result',
            false
        );
    }


    public function serviceStep()
    {
        return $this->hasOne('App\Data\Service\Model\ServiceStep','id','service_step_id');
    }

    public function serviceResult()
    {
        return $this->hasOne('App\Data\Service\Model\ServiceResult','id','service_result_id');
    }

    public function service()
    {
        return $this->belongsTo('App\Data\Service\Model\Service');
    }



    public function serviceResultWithTrans()
    {
        $relation = $this->hasOne('App\Data\Service\Model\ServiceResult','id','service_result_id');

        $serviceResult = new ServiceResult;
        TranslationDal::generateQuery($serviceResult->getTableName(), $relation, $serviceResult->getEntityColumnList(true), true);

        return $relation;
    }


}
