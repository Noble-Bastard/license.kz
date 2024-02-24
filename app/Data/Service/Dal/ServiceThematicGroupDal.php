<?php

namespace App\Data\Service\Dal;

use App\Data\Helper\Assistant;
use App\Data\Service\Model\ServiceThematicGroup;


class ServiceThematicGroupDal
{


    public static function getServiceThematicGroup($id){
        $ServiceThematicGroup=(new ServiceThematicGroup)->Where('id', $id)->firstOrFail();
        return $ServiceThematicGroup;
    }

    /**
     * Get service thematic group list by service category
     *
     * @param int $serviceCategoryId
     * @param bool $withPaginate
     * @return Collection | ServiceThematicGroup
     */
    public static function getListByServiceCategory($serviceCategoryId, bool $withPaginate)
    {
        $entityList = ServiceThematicGroup::where('service_category_id',$serviceCategoryId)
            ->orderBy('name');

        if($withPaginate){
            return $entityList->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entityList->get();
        }
    }


    /**
     * Return service list by service category and country
     *
     * @param $serviceCategoryId
     * @param $country
     * @return mixed
     */
    public static function getServiceThematicGroupListByCountryServiceCategory($serviceCategoryId, $countryId)
    {
        $entityList = ServiceThematicGroup::From('service_thematic_group as stg')
            ->join('service_category as sc', function ($join){
                $join->on('stg.service_category_id','sc.id');
            })
            ->where('sc.id',$serviceCategoryId)
            ->where('sc.country_id',$countryId)
            ->get(['stg.*']);

        return $entityList;
    }

    /**
     * @param ServiceThematicGroup $srcEntity
     * @return bool
     */
    public static function set(ServiceThematicGroup $srcEntity)
    {
        $newEntity = is_null($srcEntity->id) ? new ServiceThematicGroup() : ServiceThematicGroup::where('id', $srcEntity->id)->firstOrFail();
        $newEntity->name = $srcEntity->name;
        $newEntity->service_category_id = $srcEntity->service_category_id;
        $newEntity->description = $srcEntity->description;

        return $newEntity->save();
    }

    /**
     * @param int $entityId
     */
    public static function delete(int $entityId)
    {
        ServiceThematicGroup::where('id', $entityId)->delete();
    }
}