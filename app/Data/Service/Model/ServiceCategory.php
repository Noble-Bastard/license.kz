<?php

namespace App\Data\Service\Model;

use App\Data\Catalog\Model\Catalog;
use App\Data\Translation\Dal\TranslationDal;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Service\Model\ServiceCategory
 *
 * @property int $id
 * @property string $name
 * @property string $name_en
 * @property string $description
 * @property string $description_en
 * @property string $img
 * @property string $icon
 * @property int $order_no
 * @property int $country_id
 * @property int $service_category_type_id
 * @property bool $is_standart_contract_template_show
 * @property bool $is_hot_offer
 * @mixin \Eloquent
 */
class ServiceCategory extends Model
{
    protected $table = 'service_category';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'name_en',
        'description',
        'description_en',
        'img',
        'icon',
        'order_no',
        'country_id',
        'service_category_type_id',
        'is_standart_contract_template_show',
        'is_hot_offer',
        'hot_offer_order_no',
    ];
    protected $guarded = ['id'];

    public function serviceThematicGroups()
    {
        return $this->hasMany('App\Data\Service\Model\ServiceThematicGroup', 'service_category_id', 'id');
    }

    public function serviceCategoryType()
    {
        return $this->hasMany('App\Data\Service\Model\ServiceCategoryType', 'service_category_type_id', 'id');
    }

    public function country()
    {
        return $this->hasOne('App\Data\Service\Model\Country','id','country_id');
    }

    public function usefulInformations()
    {
        return $this->hasMany('App\Data\Service\Model\ServiceCategoryUsefulInformation', 'service_category_id', 'id');
    }
}
