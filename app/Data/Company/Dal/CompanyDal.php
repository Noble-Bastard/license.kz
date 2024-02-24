<?php

namespace App\Data\Company\Dal;

use App\Data\Company\Model\Company;
use App\Data\Helper\Assistant;
use App\Data\Helper\LanguageList;
use App\Data\Helper\TranslationAttributeList;
use App\Data\Translation\Dal\TranslationDal;
use App\Data\Translation\Model\Translation;
use Illuminate\Support\Facades\DB;


class CompanyDal
{
    const entityName = 'company';

    /**
     * Get companyProfileAddress by Id
     *
     * @param $companyProfileAddressId
     * @return mixed
     */
    public static function get($entityId)
    {
        $companyProfileAddress = Company::where('id', $entityId)->first();
        return $companyProfileAddress;
    }

    /**
     * Get companyProfileAddressList
     *
     * @param $withPaginate
     * @return mixed
     */
    public static function getList(bool $withPaginate)
    {
        $entityList = Company::
        leftJoin('city', 'city.id', '=', 'company.city_id')
            ->leftJoin('country', 'country.id', '=', 'city.country_id')
            ->select('company.*', 'city.value as city_name', 'country.name as country_name');
        if ($withPaginate) {
            return $entityList->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entityList->get();
        }
    }

    /**
     * Get companyProfileAddress by Id
     *
     * @param $countryId
     * @param $withPaginate
     * @param $translateData
     * @return mixed
     */
    public static function getListByCountry(int $countryId, bool $withPaginate, bool $translateData = false)
    {
        $baseFields = [
            'company.id',
            'company.city_id',
            'company.email',
            'company.skype',
            'company.phone',
            'company.phone_1',
            'company.fax',
            'company.location',
            'company.beneficiary',
            'company.bank',
            'company.BIN',
            'company.IIK',
            'company.KBE',
            'company.BIK',
            'company.payment_code',
            'company.photo_path'
        ];

        $entityList = Company::from('company')
            ->join('city as c', function ($join) use ($countryId) {
                $join->on('company.city_id', 'c.id')
                    ->where('c.country_id', $countryId);
            });

        TranslationDal::generateQuery(self::entityName, $entityList, $baseFields, $translateData);

        if ($withPaginate) {
            return $entityList->with('city')->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entityList->with('city')->get();
        }
    }

    /**
     * Insert (or update)  Company
     *
     * @param Company $srcEntity
     * @return Company
     */
    public static function set(Company $srcEntity)
    {
        if (empty($srcEntity->id)) {
            $entity = new Company;
        } else {
            $entity = Company::where('id', $srcEntity->id)->first();
        }

        $entity->name = $srcEntity->name;
        $entity->address = $srcEntity->address;
        $entity->city_id = $srcEntity->city_id;
        $entity->email = $srcEntity->email;
        $entity->skype = $srcEntity->skype;
        $entity->phone = $srcEntity->phone;
        $entity->phone_1 = $srcEntity->phone_1;
        $entity->fax = $srcEntity->fax;
        $entity->location = $srcEntity->location;
        $entity->beneficiary = $srcEntity->beneficiary;
        $entity->bank = $srcEntity->bank;
        $entity->BIN = $srcEntity->BIN;
        $entity->IIK = $srcEntity->IIK;
        $entity->KBE = $srcEntity->KBE;
        $entity->BIK = $srcEntity->BIK;
        $entity->payment_code = $srcEntity->payment_code;

        $entity->save();

        TranslationDal::setEntityTranslation(self::entityName, $entity->id, $srcEntity);

        return $entity;
    }

    /**
     * Delete Company
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        TranslationDal::deleteByEntity(self::entityName, $entityId);

        Company::where('id', $entityId)->delete();
        return true;
    }

    public static function setPhotoPath($entityId, $photoPath)
    {
        $entity = Company::where('id', $entityId)->first();
        $entity->photo_path = $photoPath;
        $entity->save();
    }
}
