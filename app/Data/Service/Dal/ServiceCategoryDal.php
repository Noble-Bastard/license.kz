<?php

namespace App\Data\Service\Dal;

use App\Data\Catalog\Dal\CatalogDal;
use App\Data\Catalog\Dal\ServiceCategoryCatalogDal;
use App\Data\Helper\Assistant;
use App\Data\Helper\LanguageList;
use App\Data\Helper\ServiceCategoryTypeList;
use App\Data\Helper\TranslationAttributeList;
use App\Data\Service\Model\ServiceCategory;
use App\Data\Translation\Dal\TranslationDal;
use App\Data\Translation\Model\Translation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceCategoryDal
{
    const entityName = 'service_category';

    const baseField = [
        'service_category.id',
        'service_category.name',
        'service_category.description',
        'service_category.img',
        'service_category.icon',
        'service_category.order_no',
        'service_category.country_id',
        'service_category.service_category_type_id',
        'service_category.is_standart_contract_template_show',
        'service_category.is_hot_offer'
    ];

    public static function get($entityId, bool $translateData = false)
    {
        $entity = ServiceCategory::where('service_category.id', $entityId);

        TranslationDal::generateQuery(self::entityName, $entity, self::baseField, $translateData);

        return $entity->first();
    }

    /**
     * @param $serviceCategoryId
     * @return ServiceCategory|\Illuminate\Database\Eloquent\Model
     */
    public static function getServiceCategory($serviceCategoryId, $isShort = false)
    {
        $serviceCategory = ServiceCategory::from('service_category as sc')
            ->leftJoin('country as c', function ($join){
                $join->on('c.id','sc.country_id');
            })
            ->leftJoin('translation as tn', function ($join){
                $join->on('tn.pk_value','sc.id')
                    ->where('tn.translation_attribute_id',TranslationAttributeList::ServiceCategoryName)
                    ->where('tn.language_id',LanguageList::English);
            })
            ->leftJoin('translation as td', function ($join){
                $join->on('td.pk_value','sc.id')
                    ->where('td.translation_attribute_id',TranslationAttributeList::ServiceCategoryDescription)
                    ->where('td.language_id',LanguageList::English);
            })
            ->where('sc.id', $serviceCategoryId);

        if($isShort)
        {
            $serviceCategory = $serviceCategory->firstOrFail([
                "sc.id", "sc.name", "sc.description", "sc.order_no",
                "sc.country_id","c.name as country_name",
                DB::raw("ifnull(tn.value, sc.name) as name_en"),
                DB::raw("ifnull(td.value, sc.description) as description_en"),
                "sc.is_standart_contract_template_show",
                "sc.service_category_type_id"
            ]);
        } else {
            $serviceCategory = $serviceCategory->firstOrFail([
                "sc.*",
                "c.name as country_name",
                DB::raw("ifnull(tn.value, sc.name) as name_en"),
                DB::raw("ifnull(td.value, sc.description) as description_en"),
            ]);
        }

        return $serviceCategory;
    }

    public static function getServiceCategoryWithoutSystemList(
        $isShort = false,
        $withPaginate = false,
        $countryId = null
    )
    {
        return self::getServiceCategoryListBase(
            $isShort,
            $withPaginate,
            $countryId,
            true
        );
    }

    public static function getServiceCategoryWithRootCatalog(
        $isShort = false,
        $withPaginate = false,
        $countryId = null,
        $withRootCatalog = false,
        $onlyTop = false
    )
    {
        $serviceCatalogList = self::getServiceCategoryListBase(
            $isShort,
            $withPaginate,
            $countryId,
            true,
            true,
            $onlyTop
        );

        if($withRootCatalog) {
            foreach ($serviceCatalogList as $serviceCatalog) {
                $serviceCatalog->catalogNodes = CatalogDal::get($serviceCatalog->catalog_id, true, true);
            }
        }

        return $serviceCatalogList;
    }


    public static function getServiceCategoryWithSystemList(
        $isShort = false,
        $withPaginate = false,
        $countryId = null
    )
    {
        return self::getServiceCategoryListBase(
            $isShort,
            $withPaginate,
            $countryId,
            false
        );
    }

    private static function getServiceCategoryListBase(
        $isShort,
        $withPaginate,
        $countryId,
        $excludeSystemCategory,
        $withServiceCategory = false,
        $onlyTop = false
    )
    {
        $entityList = ServiceCategory::from('service_category as sc')
            ->leftJoin('country as c', function ($join){
                $join->on('c.id','sc.country_id');
            })
            ->leftJoin('translation as tn', function ($join){
                $join->on('tn.pk_value','sc.id')
                    ->where('tn.translation_attribute_id',TranslationAttributeList::ServiceCategoryName)
                    ->where('tn.language_id',LanguageList::English);
            })
            ->leftJoin('translation as td', function ($join){
                $join->on('td.pk_value','sc.id')
                    ->where('td.translation_attribute_id',TranslationAttributeList::ServiceCategoryDescription)
                    ->where('td.language_id',LanguageList::English);
            });


        if($excludeSystemCategory){
            $entityList = $entityList->whereNotIn('service_category_type_id',self::getSystemServiceCategoryTypeList());
        }

        if(!is_null($countryId))
        {
            $entityList = $entityList->where('sc.country_id',$countryId);
        }

        if($withServiceCategory){
            $entityList = $entityList->leftJoin('service_category_catalog as scc', function($join) {
               $join->on('scc.service_category_id', 'sc.id');
            });
        }

        $selectList = [];
        if($isShort) {
            $selectList = [
                "sc.id", "sc.name", "sc.description", "sc.order_no",
                "sc.country_id","c.name as country_name",
                DB::raw("ifnull(tn.value, sc.name) as name_en"),
                DB::raw("ifnull(td.value, sc.description) as description_en"),
                "sc.is_standart_contract_template_show",
                "sc.service_category_type_id",
            ];
        } else {
            $selectList = [
                "sc.*", "c.name as country_name",
                DB::raw("ifnull(tn.value, sc.name) as name_en"),
                DB::raw("ifnull(td.value, sc.description) as description_en"),
            ];
        }

        if($withServiceCategory) {
            $selectList[] = "scc.catalog_id";
        }
        $entityList = $entityList->select($selectList);

        if($onlyTop){
            $entityList = $entityList->where('sc.is_hot_offer', 1);
        }

        $entityList = $entityList->orderBy('order_no', 'asc');

        if($withPaginate){
            return $entityList->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entityList->get();
        }
    }

    private static function getSystemServiceCategoryTypeList()
    {
        $systemCategoryTypeList = array();
        array_push($systemCategoryTypeList,ServiceCategoryTypeList::FreeEconomicZone);
        return $systemCategoryTypeList;
    }


    public static function set(ServiceCategory $srcEntity, $returnShort = false)
    {
        try {
            DB::beginTransaction();
            $newEntity = is_null($srcEntity->id) ? new ServiceCategory() : ServiceCategory::where('id', $srcEntity->id)->firstOrFail();
            $newEntity->name = $srcEntity->name;
            $newEntity->description = $srcEntity->description;
            $newEntity->order_no = $srcEntity->order_no;
            $newEntity->country_id = $srcEntity->country_id;
            $newEntity->is_standart_contract_template_show = $srcEntity->is_standart_contract_template_show;
            $newEntity->service_category_type_id = ServiceCategoryTypeList::Catalog;
            $newEntity->save();

            if($srcEntity->name_en != $srcEntity->name)
            {
                $translation = new Translation();
                $translation->value = $srcEntity->name_en;
                $translation->language_id = LanguageList::English;
                $translation->pk_value = $newEntity->id;
                $translation->translation_attribute_id = TranslationAttributeList::ServiceCategoryName;
                TranslationDal::set(
                    $translation
                );
            }

            if($srcEntity->description_en != $srcEntity->description)
            {

                $translation = new Translation();
                $translation->value = $srcEntity->description_en;
                $translation->language_id = LanguageList::English;
                $translation->pk_value = $newEntity->id;
                $translation->translation_attribute_id = TranslationAttributeList::ServiceCategoryDescription;
                TranslationDal::set(
                    $translation
                );
            }

            DB::commit();
            return self::getServiceCategory($newEntity->id, $returnShort);

        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

    public static function delete(int $entityId)
    {
        try {
            DB::beginTransaction();
            ServiceCategory::where('id', $entityId)->delete();

            TranslationDal::delete(
                TranslationAttributeList::ServiceCategoryName,
                $entityId
            );
            TranslationDal::delete(
                TranslationAttributeList::ServiceCategoryDescription,
                $entityId
            );

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

    public static function setPhoto($entityId, $photoBase64)
    {
        $entity = ServiceCategory::where('id', $entityId)->firstOrFail();
        $entity->img = $photoBase64;
        $entity->save();
    }

    public static function getServiceCategoryByService(int $serviceId)
    {
        $serviceCategory = ServiceCategory::from('service_category as sc')
            ->join('service_thematic_group', 'service_thematic_group.service_category_id', '=', 'sc.id')
            ->join('service', 'service_thematic_group.id', '=', 'service.service_thematic_group_id')
            ->where('service.id', $serviceId)
            ->select('sc.*')
            ->firstOrFail([
                "sc.id"
            ]);

        return self::get($serviceCategory->id, true);
    }
}