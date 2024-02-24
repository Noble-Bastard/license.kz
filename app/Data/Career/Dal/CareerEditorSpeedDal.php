<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-02-01
 * Time: 4:42 PM
 */

namespace App\Data\Career\Dal;


use App\Data\Career\Model\CareerEditorSpeed;
use App\Data\Helper\Assistant;
use App\Data\Translation\Dal\TranslationDal;

class CareerEditorSpeedDal
{
    const entityName = 'career_form_editor_speed';

    /**
     * Get career by Id
     *
     * @param $entityId
     * @return mixed
     */
    public static function get($entityId)
    {
        $careerEditorSpeed = CareerEditorSpeed::where('id', $entityId)->first();
        return $careerEditorSpeed;
    }

    /**
     * Get CareerEditorSpeed
     *
     * @param $withPaginate
     * @return mixed
     */
    public static function getList(bool $withPaginate)
    {
        $entityList = CareerEditorSpeed::select('career_form_editor_speed.*');
        if ($withPaginate) {
            return $entityList->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entityList->get();
        }
    }

    /**
     * Insert (or update)  CareerEditorSpeed
     *
     * @param CareerEditorSpeed $srcEntity
     * @return CareerEditorSpeedDal
     */
    public static function set(CareerEditorSpeed $srcEntity)
    {
        $srcEntity->save();

        TranslationDal::setEntityTranslation(self::entityName, $srcEntity->id, $srcEntity);

        return $srcEntity;
    }

    /**
     * Delete CareerEditorSpeedDal
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        TranslationDal::deleteByEntity(self::entityName, $entityId);

        CareerEditorSpeed::where('id', $entityId)->delete();
        return true;
    }

    public static function deleteByForm($careerFormId)
    {
        CareerEditorSpeed::where('career_form_id', $careerFormId)->delete();
        return true;
    }
}