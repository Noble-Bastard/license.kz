<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-02-01
 * Time: 4:42 PM
 */

namespace App\Data\Career\Dal;


use App\Data\Career\Model\CareerLangKnowledge;
use App\Data\Helper\Assistant;
use App\Data\Translation\Dal\TranslationDal;

class CareerLangKnowledgeDal
{
    const entityName = 'career_form_lang_knowledge';

    /**
     * Get career by Id
     *
     * @param $entityId
     * @return mixed
     */
    public static function get($entityId)
    {
        $careerLangKnowledge = CareerLangKnowledge::where('id', $entityId)->first();
        return $careerLangKnowledge;
    }

    /**
     * Get CareerLangKnowledge
     *
     * @param $withPaginate
     * @return mixed
     */
    public static function getList(bool $withPaginate)
    {
        $entityList = CareerLangKnowledge::select('career_form_editor_speed.*');
        if ($withPaginate) {
            return $entityList->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entityList->get();
        }
    }

    /**
     * Insert (or update)  CareerLangKnowledge
     *
     * @param CareerLangKnowledge $srcEntity
     * @return CareerLangKnowledge
     */
    public static function set(CareerLangKnowledge $srcEntity)
    {
        $srcEntity->save();

        TranslationDal::setEntityTranslation(self::entityName, $srcEntity->id, $srcEntity);

        return $srcEntity;
    }

    /**
     * Delete CareerLangKnowledge
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        TranslationDal::deleteByEntity(self::entityName, $entityId);

        CareerLangKnowledge::where('id', $entityId)->delete();
        return true;
    }

    public static function deleteByForm($careerFormId)
    {
        CareerLangKnowledge::where('career_form_id', $careerFormId)->delete();
        return true;
    }
}