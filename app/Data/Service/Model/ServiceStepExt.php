<?php

namespace App\Data\Service\Model;

use App\Data\Core\Model\BaseTableModel;
use App\Data\Translation\Dal\TranslationDal;
use Illuminate\Database\Eloquent\Model;

class ServiceStepExt extends BaseTableModel
{

    public function __construct()
    {
        parent::__construct(
            'service_step_ext',
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

    public function licenseType(){
        return $this->belongsTo('App\Data\Service\Model\LicenseType');
    }

    public function currencyTrans()
    {
        $relation = $this->hasOne(Currency::class,'id','step_currency_id');

        $currency = new Currency();
        TranslationDal::generateQuery($currency->getTableName(), $relation, $currency->getEntityColumnList(true), true);

        return $relation;
    }
}
