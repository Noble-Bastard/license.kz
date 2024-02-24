<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-02-01
 * Time: 4:42 PM
 */

namespace App\Data\Career\Dal;


use App\Data\Career\Model\CareerExperience;
use App\Data\Helper\Assistant;
use App\Data\Translation\Dal\TranslationDal;

class CareerExperienceDal
{
    const entityName = 'career_form_experience';

    /**
     * Get career by Id
     *
     * @param $entityId
     * @return mixed
     */
    public static function get($entityId)
    {
        $careerExperience = CareerExperience::where('id', $entityId)->first();
        return $careerExperience;
    }

    /**
     * Get CareerExperience
     *
     * @param $withPaginate
     * @return mixed
     */
    public static function getList(bool $withPaginate)
    {
        $entityList = CareerExperience::select('career_form_editor_speed.*');
        if ($withPaginate) {
            return $entityList->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entityList->get();
        }
    }

    /**
     * Insert (or update)  CareerExperience
     *
     * @param CareerExperience $srcEntity
     * @return CareerExperience
     */
    public static function set(CareerExperience $srcEntity)
    {
        $srcEntity->save();

        TranslationDal::setEntityTranslation(self::entityName, $srcEntity->id, $srcEntity);

        return $srcEntity;
    }

    /**
     * Delete CareerExperience
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        TranslationDal::deleteByEntity(self::entityName, $entityId);

        CareerExperience::where('id', $entityId)->delete();
        return true;
    }


    public static function deleteByForm($careerFormId)
    {
        CareerExperience::where('career_form_id', $careerFormId)->delete();
        return true;
    }
}