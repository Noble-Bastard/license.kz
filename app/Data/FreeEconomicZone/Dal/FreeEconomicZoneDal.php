<?php

namespace App\Data\FreeEconomicZone\Dal;


use App\Data\FreeEconomicZone\Model\BusinessActivityType;
use App\Data\FreeEconomicZone\Model\BusinessLicenseType;
use App\Data\FreeEconomicZone\Model\CountryRegion;
use App\Data\FreeEconomicZone\Model\FreeEconomicZone;
use App\Data\FreeEconomicZone\Model\FreeEconomicZoneActivity;
use App\Data\FreeEconomicZone\Model\FreeEconomicZoneLicense;

class FreeEconomicZoneDal
{


    public static function getRegionListByCountry($countryId)
    {
        $entityList = CountryRegion::where('country_id',$countryId)->get();
        return $entityList;
    }

    public static function getActivityList()
    {
        $entityList = BusinessActivityType::get();
        return $entityList;
    }

    public static function getLicenseList()
    {
        $entityList = BusinessLicenseType::get();
        return $entityList;
    }


    public static function getList()
    {
        $entityList = FreeEconomicZone::where('is_visible',true)
            ->orderBy('position_order')
            ->get();
        return $entityList;
    }

    public static function getListByFilter(
        $businessActivityTypeId,
        $businessLicenseTypeId,
        $countryRegionId
    )
    {

        $entityList = FreeEconomicZone::from("free_economic_zone as fez")
            ->where('fez.is_visible',true);
        if(!is_null($countryRegionId))
            $entityList = $entityList->where('country_region_id',$countryRegionId);

        if(!is_null($businessActivityTypeId)){
            $entityList =
                $entityList->join('free_economic_zone_activity as eza', function ($join) use($businessActivityTypeId){
                    $join->on('eza.free_economic_zone_id','fez.id')
                        ->where('eza.business_activity_type_id', $businessActivityTypeId);
                });
        }

        if(!is_null($businessLicenseTypeId)){
            $entityList =
                $entityList->join('free_economic_zone_license as ezl', function ($join) use($businessLicenseTypeId){
                    $join->on('ezl.free_economic_zone_id','fez.id')
                        ->where('ezl.business_license_type_id', $businessLicenseTypeId);
                });
        }

        return $entityList->orderBy('fez.position_order')->get(["fez.*"]);
    }

}
