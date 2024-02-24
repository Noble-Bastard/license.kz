<?php

namespace App\Data\Service\Dal;

use App\Data\Helper\LanguageList;
use App\Data\Helper\TranslationAttributeList;
use App\Data\Service\Model\City;
use App\Data\Translation\Dal\TranslationDal;
use App\Data\Translation\Model\Translation;
use Illuminate\Support\Facades\DB;

class CityDal
{
    const entityName = 'city';

    public static function getList(bool $withPagination = false, bool $translateData = false)
    {
        $baseFields = [
            'city.id',
            'city.country_id',
            'country.name as country_name'
        ];
        $entityList = City::
            from('city')
            ->leftJoin('country', 'country.id', '=', 'city.country_id')
            ->orderBy('city.country_id', 'asc')
            ->orderBy('city.value', 'asc');
        TranslationDal::generateQuery(self::entityName, $entityList, $baseFields, $translateData);

        if($withPagination){
            return $entityList->paginate(15);
        } else {
            return $entityList->get();
        }
    }

    public static function getListByCountry(int $countryId, bool $withPagination = false, bool $translateData = false)
    {
        $baseFields = [
            'city.id',
            'city.country_id'
        ];

        $entityList = City::from('city')->where('country_id', $countryId)->orderBy('city.value', 'asc');
        TranslationDal::generateQuery(self::entityName, $entityList, $baseFields, $translateData);

        if($withPagination){
            return $entityList->paginate(15);
        } else {
            return $entityList->get();
        }
    }

    /**
     * Get city by Id
     *
     * @param $cityId
     * @return mixed
     */
    public static function get($entityId, bool $translateData = false)
    {
        $baseFields = [
            'city.id',
            'city.country_id'
        ];
        $entityList = City::where('city.id', $entityId);
        TranslationDal::generateQuery(self::entityName, $entityList, $baseFields, $translateData);

        $entityList = $entityList->firstOrFail();
        return $entityList;
    }

    public static function getByName($name, $countryId)
    {
        $city = City::where('country_id', $countryId)->where('value', $name)->first();
        if(is_null($city)){
            $city = new City();
            $city->country_id = $countryId;
            $city->value = $name;
            $city->save();
        }

        return $city;
    }

    /**
     * Insert (or update)  City
     *
     * @param City $srcEntity
     * @return City
     */
    public static function set (City $srcEntity)
    {
        if (empty($srcEntity->id)) {
            $entity = new City();
        } else {
            $entity = City::where('id', $srcEntity->id)->firstOrFail();
        }
        $entity->country_id = $srcEntity->country_id;
        $entity->value = $srcEntity->value;
        $entity->save();

        TranslationDal::setEntityTranslation(self::entityName, $entity->id, $srcEntity);

        return $entity;
    }

    /**
     * Delete City
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        TranslationDal::deleteByEntity(self::entityName, $entityId);

        City::where('id', $entityId)->delete();
        return true;
    }

}
