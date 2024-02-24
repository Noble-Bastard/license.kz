<?php

namespace App\Data\Core\Dal;

use App\Data\Core\Model\Counter;
use App\Data\Helper\Assistant;


class CounterDal
{

    /**
     * Return counter value
     *
     * @param $counterType
     */
    public static function getCounterValue($counterType, $countryId = null)
    {

        $counter = Counter::where('counter_type_id',$counterType);
        if(!is_null($countryId))
        {
            $counter = $counter->where('country_id',$countryId);
        }
        $counter = $counter->first();

        $cntr_mask = $counter->mask;
        $cntr_length = $counter->length;
        $cntr_increase = $counter->increase;
        $cntr_sequence = $counter->sequence;

        $counter->sequence = $cntr_sequence + $cntr_increase;
        $counter->save();

        $cntr_length = $cntr_length - strlen((string)$cntr_sequence);

        if ($cntr_length > 0) {
            $counterValue = $cntr_mask . str_repeat('0',$cntr_length) . (string)$cntr_sequence;
        } else
        {
            $counterValue = $cntr_mask . (string)$cntr_sequence;
        }

        return $counterValue;

    }

    public static function getList(bool $withPaginate)
    {
        if($withPaginate){
            return Counter::with('country')->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return Counter::with('country')->get();
        }
    }

    public static function set(Counter $srcEntity)
    {
        $entity = empty($srcEntity->id) ? new Counter : Counter::where('id', $srcEntity->id)->firstOrFail();
        $entity->counter_type_id = $srcEntity->counter_type_id;
        $entity->mask = $srcEntity->mask;
        $entity->length = $srcEntity->length;
        $entity->increase = $srcEntity->increase;
        $entity->sequence = $srcEntity->sequence;
        $entity->country_id = $srcEntity->country_id;
        $entity->save();

        return $entity;
    }

}
