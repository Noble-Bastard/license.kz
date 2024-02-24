<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-02-09
 * Time: 9:12 PM
 */

namespace App\Data\Catalog\Dal;


use App\Data\Catalog\Model\Catalog;
use App\Data\Catalog\Model\ServiceCatalog;
use App\Data\Catalog\Model\ServiceCategoryCatalog;
use App\Data\Service\Model\ServiceCategory;

class ServiceCatalogDal
{

    public static function deleteByCatalog($catalogId)
    {
        ServiceCatalog::where('catalog_id', $catalogId)->delete();
    }

    public static function getNodeByService($serviceId)
    {
        return ServiceCatalog::where('service_id', $serviceId)->first();
    }
}