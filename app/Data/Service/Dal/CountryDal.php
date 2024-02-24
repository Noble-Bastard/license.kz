<?php

namespace App\Data\Service\Dal;

use App\Data\Helper\Assistant;
use App\Data\Helper\FilePathHelper;
use App\Data\Helper\LanguageList;
use App\Data\Helper\TranslationAttributeList;
use App\Data\Service\Model\Country;
use App\Data\Translation\Dal\TranslationDal;
use App\Data\Translation\Model\Translation;
use App\Services\Countries\CountriesRest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CountryDal
{
    const entityName = 'country';
    const baseFields = [
            'country.id',
            'country.code',
            'country.is_visible'
        ];

    public static function getList(bool $withPagination = false, bool $translateData = false, bool $getAll = true)
    {
        $entityList = Country::from('country')->orderBy('name', 'asc');
        if(!$getAll){
            $entityList = $entityList->where('is_visible', true);
        }

        TranslationDal::generateQuery(self::entityName, $entityList, self::baseFields, $translateData);

        if ($withPagination) {
            return $entityList->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entityList->get();
        }
    }

    public static function getListPaginate()
    {
        $country = Country::orderBy('name', 'asc');
        return $country;
    }

    /**
     * Get country by Id
     *
     * @param $countryId
     * @return mixed
     */
    public static function get($entityId, bool $translateData = false)
    {
        $entityList = Country::from('country')
            ->where('country.id', $entityId);

        TranslationDal::generateQuery(self::entityName, $entityList, self::baseFields, $translateData);

        $entityList = $entityList->firstOrFail();
        return $entityList;
    }

    public static function getByCode($code)
    {
        $entityList = Country::from('country')->where('code', $code);
        TranslationDal::generateQuery(self::entityName, $entityList, self::baseFields, true);
        $entityList = $entityList->first();

        if (is_null($entityList)) {
            return self::getByCode('kz');
        }
        return $entityList;
    }

    public static function getByCodeOrCreate($code, $name)
    {
        $country = Country::from('country')->where('code', $code)->first();
        if(!is_null($country)){
            return $country;
        }

        $newCountry = CountriesRest::getByCode($code);

        if(is_null($newCountry)){
            return null;
        }

        if (is_null($country)) {
            $country = new Country();
            $country->code = $code;
            $country->name = $name;
            $country->name_en = $newCountry->name;
            $country->is_visible = false;
            $country = self::set($country);

            $contents = file_get_contents($newCountry->flag);
            Storage::put(FilePathHelper::getCountryFlagPath() . '/flag_'.$code.'.svg', $contents);
        }

        return $country;
    }

    /**
     * Insert (or update)  Country
     *
     * @param Country $srcEntity
     * @return Country
     */
    public static function set(Country $srcEntity)
    {
        if (empty($srcEntity->id)) {
            $entity = new Country;
        } else {
            $entity = Country::where('id', $srcEntity->id)->firstOrFail();
        }
        $entity->code = $srcEntity->code;
        $entity->name = $srcEntity->name;
        $entity->is_visible = $srcEntity->is_visible;
        $entity->save();

        TranslationDal::setEntityTranslation(self::entityName, $entity->id, $srcEntity);

        return $entity;
    }

    /**
     * Delete Country
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        TranslationDal::deleteByEntity(self::entityName, $entityId);
        Country::where('id', $entityId)->delete();
        return true;
    }

}
