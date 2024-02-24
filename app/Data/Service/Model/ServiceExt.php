<?php

namespace App\Data\Service\Model;

use App\Data\Catalog\Model\ServiceCatalog;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Service\Model\ServiceExt
 *
 * @property int $id
 * @property string $description
 * @property int $is_active
 * @property string $name
 * @property string $code
 * @property string $service_start_date
 * @property string|null $service_end_date
 * @property int $service_thematic_group_id
 * @property string|null $service_thematic_group_name
 * @property int $execution_days_from
 * @property int $execution_days_to
 * @property int|null $counter_type_id
 * @property string|null $counter_type_name
 * @property float|null $total_service_cost
 * @property float|null $total_execution_work_day_cnt
 * @property int|null $currency_id
 * @property string|null $currency_name
 * @property string|null $country_code
 * @property string|null $country_name
 * @property string|null $service_category_id
 * @property string|null $country_id
 * @property string|null $comment
 * @property string|null $registration_form_template_id
 * @property string|null $registration_form_template_name
 * @property string|null $license_type_id
 * @property-read \App\Data\Core\Model\CounterType $counterType
 * @property-read \App\Data\Service\Model\Country $country
 * @property-read \App\Data\Service\Model\ServiceThematicGroup $serviceThematicGroup
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ServiceExt extends Model
{
    protected $table = 'service_ext';
    public $timestamps = false;

    protected $fillable = [
        'service_thematic_group_id',
        'service_thematic_group_name',
        'required_document',
        'execution_days_from',
        'execution_days_to',
        'service_start_date',
        'service_end_date',
        'name',
        'code',
        'description',
        'is_active',
        'counter_type_id',
        'counter_type_name',
        'total_service_cost',
        'total_execution_work_day_cnt',
        'currency_id',
        'currency_name',
        'country_code',
        'country_name',
        'service_category_id',
        'country_id',
        'comment',
        'registration_form_template_id',
        'registration_form_template_name',
        'license_type_id',
        'service_type_id',
        'base_cost',
        'additional_cost',
        'currency_id service_currency_id',
        'service_currency_name',
        'additional_approvals',
        'special_terms'
    ];

    protected $guarded = ['id'];

    public function serviceThematicGroup()
    {
        return $this->hasOne('App\Data\Service\Model\ServiceThematicGroup','id','service_thematic_group_id');
    }

    public function counterType()
    {
        return $this->hasOne('App\Data\Core\Model\CounterType','id','counter_type_id');
    }

    public function country()
    {
        return $this->hasOne('App\Data\Service\Model\Country','id','country_id');
    }

    public function registrationFormTemplate()
    {
        return $this->hasOne('App\Data\RegistrationFormTemplate\Model\RegistrationFormTemplateExt.php','id','registration_form_template_id');
    }

    public function latestServiceCostHist()
    {
        return $this->hasOne(ServiceCostHist::class, 'service_id', 'id')->latest('create_date');
    }

    public function additionalApprovalsMap()
    {
        return $this->hasMany(AdditionalApprovalsMap::class, 'service_id', 'id')->with('additionalApprovals');
    }

    public function catalog()
    {
        return $this->hasMany(ServiceCatalog::class, 'service_id', 'id');
    }
}
