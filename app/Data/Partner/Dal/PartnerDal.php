<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-02-01
 * Time: 4:42 PM
 */

namespace App\Data\Partner\Dal;


use App\Data\Partner\Model\Partner;
use App\Data\Helper\Assistant;
use App\Data\Translation\Dal\TranslationDal;

class PartnerDal
{
    const entityName = 'partner_form';

    /**
     * Get partner by Id
     *
     * @param $partnerId
     * @return mixed
     */
    public static function get($entityId)
    {
        $partner = Partner::where('id', $entityId)->first();
        return $partner;
    }

    /**
     * Get partnerList
     *
     * @param $withPaginate
     * @return mixed
     */
    public static function getList(bool $withPaginate)
    {
        $entityList = Partner::select('partner_form.*');
        if ($withPaginate) {
            return $entityList->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entityList->get();
        }
    }

    /**
     * Insert (or update)  Partner
     *
     * @param Partner $srcEntity
     * @return Partner
     */
    public static function set(Partner $srcEntity)
    {
        $srcEntity->save();

        TranslationDal::setEntityTranslation(self::entityName, $srcEntity->id, $srcEntity);

        return $srcEntity;
    }

    /**
     * Delete Partner
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        TranslationDal::deleteByEntity(self::entityName, $entityId);

        Partner::where('id', $entityId)->delete();
        return true;
    }
}