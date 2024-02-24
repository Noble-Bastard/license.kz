<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-02-11
 * Time: 11:47 AM
 */

namespace App\Data\Catalog\Dal;


use App\Data\Catalog\Model\Catalog;
use App\Data\Catalog\Model\CatalogNodeType;
use App\Data\Catalog\Model\ServiceCatalog;
use App\Data\Catalog\Model\ServiceCategoryCatalog;
use App\Data\Helper\MoveTypeList;
use App\Data\Service\Dal\ServiceCategoryDal;
use App\Data\Translation\Dal\TranslationDal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CatalogDal
{
    const entityName = 'catalog';

    const baseField = [
        'catalog.id',
        'catalog.catalog_parent_id',
        'catalog.catalog_node_type_id',
        'catalog.name',
        'catalog.description',
        'catalog.image_path',
        'catalog.is_visible',
        'catalog.is_blank_page',
        'catalog.pretty_url'
    ];

    public static function geNodeListByParentId($parentNodeId, bool $isShowAll = false, bool $translateData = false)
    {
        $entityList = Catalog::where('catalog.catalog_parent_id', $parentNodeId)->orderBy('order_no');
        if(!$isShowAll){
            $entityList->where('is_visible', true);
        }

        TranslationDal::generateQuery(self::entityName, $entityList, self::baseField, $translateData);

        return $entityList->with('nodeType')->with('serviceCatalogList')->get();
    }

    public static function get($entityId, bool $translateData = false, $withChildNodes = false)
    {
        $entity = Catalog::where('catalog.id', $entityId);

        TranslationDal::generateQuery(self::entityName, $entity, self::baseField, $translateData);

        $entity = $entity->with('nodeType')->with('serviceCatalogList');

        if($withChildNodes){
            $entity = $entity->with('childNodeList');
        }

        return $entity->first();
    }

    public static function getByPrettyName($prettyUrl, bool $translateData = false)
    {
        $entity = Catalog::where('catalog.pretty_url', $prettyUrl);

        TranslationDal::generateQuery(self::entityName, $entity, self::baseField, $translateData);

        return $entity->with('nodeType')->with('serviceCatalogList')->first();
    }

    public static function set(Catalog $srcEntity)
    {
        try {
            DB::beginTransaction();

            if (empty($srcEntity->id)) {
                $entity = new Catalog;
            } else {
                $entity = Catalog::where('id', $srcEntity->id)->firstOrFail();
            }
            $entity->name = $srcEntity->name;
            $entity->description = $srcEntity->description;
            $entity->catalog_parent_id = $srcEntity->catalog_parent_id;
            $entity->catalog_node_type_id = $srcEntity->catalog_node_type_id;
            $entity->order_no = self::getNextOrderNo($srcEntity->catalog_parent_id);
            $entity->pretty_url = is_null($srcEntity->pretty_url) ? \Illuminate\Support\Str::slug($srcEntity->name, "_") : $srcEntity->pretty_url;
            $entity->seo_title = $srcEntity->seo_title;
            $entity->seo_description = $srcEntity->seo_description;
            $entity->seo_keys = $srcEntity->seo_keys;
            $entity->save();

            TranslationDal::setEntityTranslation(self::entityName, $entity->id, $srcEntity);

            if (isset($srcEntity->serviceCategoryId)) {
                $serviceCategoryCatalog = new ServiceCategoryCatalog();
                $serviceCategoryCatalog->catalog_id = $entity->id;
                $serviceCategoryCatalog->service_category_id = $srcEntity->serviceCategoryId;
                ServiceCategoryCatalogDal::set($serviceCategoryCatalog);
            }
            DB::commit();
            return $entity;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

    public static function setPhoto($entityId, $photoPath)
    {
        $entity = Catalog::where('id', $entityId)->firstOrFail();
        $entity->image_path = $photoPath;
        $entity->save();
    }

    public static function getNextOrderNo($parentId)
    {
        $orderNo = Catalog::where('catalog.catalog_parent_id', $parentId)->max('order_no');
        if (is_null($orderNo)) {
            return 0;
        } else {
            return $orderNo + 10;
        }
    }

    public static function move($entityId, $moveType)
    {
        $entity = Catalog::where('id', $entityId)->firstOrFail();
        $currentOrderNumber = $entity->order_no;

        $destEntity = Catalog::where('catalog_parent_id', $entity->catalog_parent_id);

        if ($moveType == MoveTypeList::UP) {
            $destEntity = $destEntity
                ->where('order_no', '<', $entity->order_no)
                ->orderBy('order_no', 'desc')
                ->first();
        } else {
            $destEntity = $destEntity
                ->where('order_no', '>', $entity->order_no)
                ->orderBy('order_no')
                ->first();
        }

        try {
            DB::beginTransaction();

            if (!is_null($destEntity)) {
                $entity->order_no = $destEntity->order_no;
                $entity->save();
                $destEntity->order_no = $currentOrderNumber;
                $destEntity->save();
            }

            DB::commit();

            return $entity;

        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

    public static function assignService($catalogNodeId, $serviceId)
    {
        $entity = new ServiceCatalog();
        $entity->catalog_id = $catalogNodeId;
        $entity->service_id = $serviceId;
        $entity->save();
    }

    public static function unassignService($serviceCatalogId)
    {
        $entity = ServiceCatalog::where('id', $serviceCatalogId)->first();
        if (is_null($entity)) {
            return;
        }

        $entity->delete();
    }

    public static function delete($entityId)
    {
        if(is_null($entityId)){
            return true;
        }

        try {
            DB::beginTransaction();
            $childsList = $entityList = Catalog::where('catalog.catalog_parent_id', $entityId)->get();
            foreach ($childsList as $child) {
                self::delete($child->id);
            }

            TranslationDal::deleteByEntity(self::entityName, $entityId);
            ServiceCategoryCatalogDal::deleteByCatalog($entityId);
            ServiceCatalogDal::deleteByCatalog($entityId);
            Catalog::where('id', $entityId)->delete();
            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

    public static function changeChildNodeType($parentNodeId, $typeId)
    {
        try {
            DB::beginTransaction();

            $childsList = $entityList = Catalog::where('catalog.catalog_parent_id', $parentNodeId)->get();
            foreach ($childsList as $child) {
                $child->catalog_node_type_id = $typeId;
                $child->save();
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

    public static function toggleVisibility($entityId)
    {
        $entity = Catalog::where('catalog.id', $entityId)->first();
        if(!is_null($entity)) {
            $entity->is_visible = !$entity->is_visible;
            $entity->save();
        }
    }

    public static function toggleBlankPage($entityId)
    {
        $entity = Catalog::where('catalog.id', $entityId)->first();
        if(!is_null($entity)) {
            $entity->is_blank_page = !$entity->is_blank_page;
            $entity->save();
        }
    }

    public static function getRootNode($entityId, $translateData = false)
    {
        $entity = Catalog::where('catalog.id', $entityId)->first();
        if(is_null($entity)) {
          return null;
        }
        if(is_null($entity->catalog_parent_id)){
            if($translateData) {
                TranslationDal::generateQuery(self::entityName, $entity, self::baseField, $translateData);
            }
            return $entity;
        } else {
            return self::getRootNode($entity->catalog_parent_id, $translateData);
        }
    }

    public static function getParentNodeByType($catalogId, $parentNodeType)
    {
        $entity = Catalog::where('catalog.id', $catalogId)->first();
        if(is_null($entity->catalog_parent_id) || $entity->catalog_node_type_id == $parentNodeType){
            return $entity;
        } else {
            return self::getParentNodeByType($entity->catalog_parent_id, $parentNodeType);
        }
    }

    public static function getFirstServiceByCatalogNode($catalogId){
        $catalogList = Catalog::where('id', $catalogId)->with('children')->get();
        foreach ($catalogList as $catalog){
            if($catalog->existServiceCatalog()){
                return $catalog->serviceCatalogList->first()->service;
            } else {
                foreach ($catalog->children as $child){
                    if($child->existServiceCatalog()){
                        return $child->serviceCatalogList()->with('service')->first()->service;
                    } else {
                        return self::getFirstServiceByCatalogNode($child->id);
                    }
                }
            }
        }

        return null;
    }
}
