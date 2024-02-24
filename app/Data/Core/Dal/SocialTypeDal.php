<?php

namespace App\Data\Core\Dal;

use App\Data\Core\Model\SocialType;
use App\Data\Helper\Assistant;


class SocialTypeDal
{
    /**
     * Get counter type list
     *
     * @param $withPaginate
     * @return mixed
     */
    public static function getList(bool $withPaginate)
    {
        if($withPaginate){
            return SocialType::paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return SocialType::get();
        }
    }

    public static function set(SocialType $srcEntity)
    {
        $entity = empty($srcEntity->id) ? new SocialType : SocialType::where('id', $srcEntity->id)->firstOrFail();
        $entity->value = $srcEntity->value;

        $entity->save();
        return $entity;
    }
}
