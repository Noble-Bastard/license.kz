<?php

namespace App\Data\Service\Model;

use App\Data\Core\Model\BaseTableModel;
use App\Data\Translation\Dal\TranslationDal;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Service\Model\ServiceStepCostHist
 *
 * @property int $id
 * @property int $service_step_id
 * @property float $cost
 * @property float $tax
 * @property int $currency_id
 * @property int|null $created_by
 * @property string $create_date
 * @property-read \App\User $createdBy
 * @property-read \App\Data\Service\Model\Currency $currency
 * @property-read \App\Data\Service\Model\ServiceStep $serviceStep
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Service\Model\ServiceStepCostHist whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Service\Model\ServiceStepCostHist whereCreateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Service\Model\ServiceStepCostHist whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Service\Model\ServiceStepCostHist whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Service\Model\ServiceStepCostHist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Service\Model\ServiceStepCostHist whereServiceStepId($value)
 * @mixin \Eloquent
 */
class ServiceStepCostHist extends BaseTableModel
{

    public function __construct()
    {
        parent::__construct(
            'service_step_cost_hist',
            false
        );
    }

    public function serviceStep()
    {
        return $this->hasOne('App\Data\Service\Model\ServiceStep','id','service_step_id');
    }

    public function currency()
    {
        return $this->hasOne('App\Data\Service\Model\Currency','id','currency_id');
    }
    
    public function currencyTrans()
    {
        $relation = $this->hasOne('App\Data\Service\Model\Currency','id','currency_id');

        $currency = new Currency();
        TranslationDal::generateQuery($currency->getTableName(), $relation, $currency->getEntityColumnList(true), true);

        return $relation;
    }

    public function createdBy()
    {
        return $this->hasOne('App\User','id', 'created_by');
    }
}
