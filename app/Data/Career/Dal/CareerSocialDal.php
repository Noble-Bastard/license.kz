<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-02-01
 * Time: 4:42 PM
 */

namespace App\Data\Career\Dal;


use App\Data\Career\Model\CareerSocial;
use App\Data\Helper\Assistant;
use App\Data\Translation\Dal\TranslationDal;

class CareerSocialDal
{
    const entityName = 'career_form_social';

    /**
     * Get career by Id
     *
     * @param $entityId
     * @return mixed
     */
    public static function get($entityId)
    {
        $careerFormSocial = CareerSocial::where('id', $entityId)->first();
        return $careerFormSocial;
    }

    /**
     * Get CareerSocial
     *
     * @param $withPaginate
     * @return mixed
     */
    public static function getList(bool $withPaginate)
    {
        $entityList = CareerSocial::select('career_form_social.*');
        if ($withPaginate) {
            return $entityList->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entityList->get();
        }
    }

    /**
     * Insert (or update)  CareerSocial
     *
     * @param CareerSocial $srcEntity
     * @return CareerSocial
     */
    public static function set(CareerSocial $srcEntity)
    {
        $srcEntity->save();

        TranslationDal::setEntityTranslation(self::entityName, $srcEntity->id, $srcEntity);

        return $srcEntity;
    }

    /**
     * Delete CareerSocial
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        TranslationDal::deleteByEntity(self::entityName, $entityId);

        CareerSocial::where('id', $entityId)->delete();
        return true;
    }

    public static function deleteByForm($careerFormId)
    {
        CareerSocial::where('career_form_id', $careerFormId)->delete();
        return true;
    }
}