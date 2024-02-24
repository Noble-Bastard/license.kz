<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-02-09
 * Time: 9:12 PM
 */

namespace App\Data\Catalog\Dal;


use App\Data\Catalog\Model\Catalog;
use App\Data\Catalog\Model\ServiceCategoryCatalog;
use App\Data\Service\Dal\ServiceCategoryDal;
use App\Data\Service\Model\ServiceCategory;

class ServiceCategoryCatalogDal
{
    public static function getByServiceCategory($serviceCategoryId, bool $translateDate = false)
    {
        $serviceCategoryCatalog = ServiceCategoryCatalog::where('service_category_id', $serviceCategoryId)->first();
        $serviceCategory = ServiceCategory::where('id', $serviceCategoryId)->first();
        if(!is_null($serviceCategory)) {
            if (is_null($serviceCategoryCatalog)) {
                $rootNode = new Catalog();
                $rootNode->name = "root_" . $serviceCategoryId;
                $rootNode->catalog_parent_id = null;
                $rootNode->catalog_node_type_id = null;
                $rootNode->description = null;
                $rootNode->image_path = null;
                $rootNode->serviceCategoryId = $serviceCategoryId;
                $rootNode = CatalogDal::set($rootNode);
            } else {
                $rootNode = CatalogDal::get($serviceCategoryCatalog->catalog_id, $translateDate);
            }
        } else {
            $rootNode = CatalogDal::get($serviceCategoryId, $translateDate);
        }

        return $rootNode;
    }

    public static function getByCatalog($catalogId, bool $translateDate = false){
        $serviceCategoryCatalog = ServiceCategoryCatalog::where('catalog_id', $catalogId)->first();
        return ServiceCategoryDal::get($serviceCategoryCatalog->service_category_id, $translateDate);
    }

    public static function set(ServiceCategoryCatalog $serviceCategoryCatalog)
    {
        return $serviceCategoryCatalog->save();
    }

    public static function deleteByCatalog($catalogId)
    {
        ServiceCategoryCatalog::where('catalog_id', $catalogId)->delete();
    }
}