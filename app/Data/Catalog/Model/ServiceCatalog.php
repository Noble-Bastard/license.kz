<?php

namespace App\Data\Catalog\Model;

use App\Data\Core\Model\BaseTableModel;
use App\Data\Service\Model\Service;
use App\Data\Translation\Dal\TranslationDal;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Catalog\Model\CatalogNodeType
 *
 * @property int $id
 * @property int service_id
 * @property int catalog_id
 *
 * @mixin \Eloquent
 */
class ServiceCatalog extends BaseTableModel
{
    public function __construct()
    {
        parent::__construct(
            'service_catalog',
            false
        );
    }

    public function catalog()
    {
        return $this->hasOne('App\Data\Company\Model\Catalog','id','catalog_id');
    }

    public function service(){

        $relation =  $this->hasOne(Service::class,'id','service_id');

        $service = new Service();
        TranslationDal::generateQuery($service->getTableName(), $relation, $service->getEntityColumnList(true), true);

        return $relation;
    }
}
