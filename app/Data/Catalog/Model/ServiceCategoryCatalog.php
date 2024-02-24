<?php

namespace App\Data\Catalog\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Catalog\Model\CatalogNodeType
 *
 * @property int $id
 * @property int service_category_id
 * @property int catalog_id
 *
 * @mixin \Eloquent
 */
class ServiceCategoryCatalog extends Model
{
    protected $table = 'service_category_catalog';
    public $timestamps = false;

    protected $fillable = [
        'service_category_id',
        'catalog_id'
    ];
    protected $guarded = ['id'];

    public function catalogList()
    {
        return $this->hasMany('App\Data\Company\Model\Catalog','id','catalog_id');
    }

    public function serviceCategory(){
        return $this->hasOne('App\Data\Service\Model\ServiceCategory','id','service_category_id');
    }
}
