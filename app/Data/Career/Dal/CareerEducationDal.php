<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-02-01
 * Time: 4:42 PM
 */

namespace App\Data\Career\Dal;


use App\Data\Career\Model\CareerEducation;
use App\Data\Helper\Assistant;
use App\Data\Translation\Dal\TranslationDal;

class CareerEducationDal
{
    const entityName = 'career_form_education';

    /**
     * Get career by Id
     *
     * @param $entityId
     * @return mixed
     */
    public static function get($entityId)
    {
        $careerEditorSpeed = CareerEducation::where('id', $entityId)->first();
        return $careerEditorSpeed;
    }

    /**
     * Get CareerEducation
     *
     * @param $withPaginate
     * @return mixed
     */
    public static function getList(bool $withPaginate)
    {
        $entityList = CareerEducation::select('career_form_editor_speed.*');
        if ($withPaginate) {
            return $entityList->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entityList->get();
        }
    }

    /**
     * Insert (or update)  CareerEducation
     *
     * @param CareerEducation $srcEntity
     * @return CareerEducationDal
     */
    public static function set(CareerEducation $srcEntity)
    {
        $srcEntity->save();

        TranslationDal::setEntityTranslation(self::entityName, $srcEntity->id, $srcEntity);

        return $srcEntity;
    }

    /**
     * Delete CareerEducationDal
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        TranslationDal::deleteByEntity(self::entityName, $entityId);

        CareerEducation::where('id', $entityId)->delete();
        return true;
    }



    public static function deleteByForm($careerFormId)
    {
        CareerEducation::where('career_form_id', $careerFormId)->delete();
        return true;
    }
}