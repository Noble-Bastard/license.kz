<?php

namespace App\Data\Core\Dal;

use App\Data\Core\Model\CounterType;
use App\Data\Helper\Assistant;


class CounterTypeDal
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
            return CounterType::paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return CounterType::get();
        }
    }

    public static function set(CounterType $srcEntity)
    {
        $entity = empty($srcEntity->id) ? new CounterType : CounterType::where('id', $srcEntity->id)->firstOrFail();
        $entity->name = $srcEntity->name;
        $entity->code = $srcEntity->code;

        $entity->save();
        return $entity;
    }

}
