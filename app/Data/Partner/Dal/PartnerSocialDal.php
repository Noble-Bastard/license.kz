<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-02-01
 * Time: 4:42 PM
 */

namespace App\Data\Partner\Dal;


use App\Data\Partner\Model\PartnerSocial;
use App\Data\Helper\Assistant;
use App\Data\Translation\Dal\TranslationDal;

class PartnerSocialDal
{
    const entityName = 'partner_form_social';

    /**
     * Get partner by Id
     *
     * @param $entityId
     * @return mixed
     */
    public static function get($entityId)
    {
        $partnerFormSocial = PartnerSocial::where('id', $entityId)->first();
        return $partnerFormSocial;
    }

    /**
     * Get PartnerSocial
     *
     * @param $withPaginate
     * @return mixed
     */
    public static function getList(bool $withPaginate)
    {
        $entityList = PartnerSocial::select('partner_form_social.*');
        if ($withPaginate) {
            return $entityList->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entityList->get();
        }
    }

    /**
     * Insert (or update)  PartnerSocial
     *
     * @param PartnerSocial $srcEntity
     * @return PartnerSocial
     */
    public static function set(PartnerSocial $srcEntity)
    {
        $srcEntity->save();

        TranslationDal::setEntityTranslation(self::entityName, $srcEntity->id, $srcEntity);

        return $srcEntity;
    }

    /**
     * Delete PartnerSocial
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        TranslationDal::deleteByEntity(self::entityName, $entityId);

        PartnerSocial::where('id', $entityId)->delete();
        return true;
    }

    public static function deleteByForm($partnerFormId)
    {
        PartnerSocial::where('partner_form_id', $partnerFormId)->delete();
        return true;
    }
}