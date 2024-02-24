<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-02-01
 * Time: 4:42 PM
 */

namespace App\Data\Career\Dal;


use App\Data\Career\Model\Career;
use App\Data\Helper\Assistant;
use App\Data\Translation\Dal\TranslationDal;

class CareerDal
{
    const entityName = 'career_form';

    /**
     * Get career by Id
     *
     * @param $careerId
     * @return mixed
     */
    public static function get($entityId)
    {
        $career = Career::where('id', $entityId)->first();
        return $career;
    }

    /**
     * Get careerList
     *
     * @param $withPaginate
     * @return mixed
     */
    public static function getList(bool $withPaginate)
    {
        $entityList = Career::select('career_form.*');
        if ($withPaginate) {
            return $entityList->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entityList->get();
        }
    }

    /**
     * Insert (or update)  Career
     *
     * @param Career $srcEntity
     * @return Career
     */
    public static function set(Career $srcEntity)
    {
        $srcEntity->save();

        TranslationDal::setEntityTranslation(self::entityName, $srcEntity->id, $srcEntity);

        return $srcEntity;
    }

    /**
     * Delete Career
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        TranslationDal::deleteByEntity(self::entityName, $entityId);

        Career::where('id', $entityId)->delete();
        return true;
    }

    public static function setPhotoPath($entityId, $photoPath)
    {
        $entity = Career::where('id', $entityId)->first();
        $entity->photo_path = $photoPath;
        $entity->save();
    }
}