<?php

namespace App\Data\Service\Model;

use App\Data\Translation\Dal\TranslationDal;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Service\Model\ServiceStepCostHist
 *
 * @property int $id
 * @property int $service_id
 * @property float $base_cost
 * @property float $additional_cost
 * @property int $currency_id
 * @property int|null $created_by
 * @property string $create_date
 * @property-read \App\User $createdBy
 * @property-read \App\Data\Service\Model\Currency $currency
 * @property-read \App\Data\Service\Model\ServiceStep $serviceStep
 * @mixin \Eloquent
 */
class ServiceCostHist extends Model
{
    protected $table = 'service_cost_hist';
    public $timestamps = false;

    protected $fillable = [
        'service_id',
        'base_cost',
        'additional_cost',
        'currency_id',
        'created_by',
        'create_date'
    ];
    protected $guarded = ['id'];


    public function service()
    {
        return $this->hasOne(Service::class,'id','service_id');
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
