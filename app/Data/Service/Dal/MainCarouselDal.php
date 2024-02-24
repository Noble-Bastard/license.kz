<?php
/**
 * Created by PhpStorm.
 * User: R.Biewald
 * Date: 25.07.2018
 * Time: 14:08
 */

namespace App\Data\Service\Dal;


use App\Data\Helper\Assistant;
use App\data\Service\Model\DisplayDimensionType;
use App\Data\Service\Model\MainCarousel;
use App\Data\Service\Model\MainCarouselImage;

class MainCarouselDal
{

    public static function get($entityId)
    {
        $mainCarousel = MainCarousel::where('id', $entityId)->firstOrFail();
        return $mainCarousel;
    }

    public static function getList(bool $withPagination)
    {
        $mainCarousel = MainCarousel::from('main_service_carousel as msc')
            ->join('service as s', 'msc.service_id', '=', 's.id')
            ->join('service_thematic_group as stg', 's.service_thematic_group_id', '=', 'stg.id')
            ->join('service_category as sc', 'stg.service_category_id', '=', 'sc.id')
            ->join('country as cr','sc.country_id','=','cr.id')
            ->select(
                'msc.*',
                's.name as service_name',
                'cr.code as country_code',
                'cr.id as country_id',
                'cr.name as country_name'
            );

        if($withPagination){
            return $mainCarousel->paginate(15);
        } else {
            return $mainCarousel->get();
        }
    }


    public static function getdisplayDimentionList(){
        $displayDimentionList=DisplayDimensionType::get();
        return $displayDimentionList;
    }

    public static function getListByCarousel()
    {
        return self::getList(false)->where('country_code', Assistant::getCountryLocation());
    }

    public static function set($mainCarousel)
    {
        if (empty($mainCarousel->id)) {
            $newMainCarousel = new MainCarousel;
        } else {
            $newMainCarousel = MainCarousel::where('id', $mainCarousel->id)->firstOrFail();
        }

        $newMainCarousel->service_id = $mainCarousel->service_id;
        $newMainCarousel->order_no = $mainCarousel->order_no;
        $newMainCarousel->save();

        return $newMainCarousel;
    }

    public static function addImage(MainCarouselImage $mainCarouselImage)
    {
        if (empty($mainCarouselImage->id)) {
            $newImage = new MainCarouselImage();
        } else {
            $newImage = MainCarouselImage::where('id', $mainCarouselImage->id)->firstOrFail();
        }
        $newImage->main_service_carousel_id = $mainCarouselImage->main_service_carousel_id;
        $newImage->display_dimension_type = $mainCarouselImage->display_dimension_type;
        $newImage->img = $mainCarouselImage->img;
        $newImage->save();
    }

    public static function getImageList($mainServiceCarouselId)
    {
        return MainCarouselImage::
            join('display_dimension_type', 'main_service_carousel_image.display_dimension_type', '=', 'display_dimension_type.id')
            ->where('main_service_carousel_id', $mainServiceCarouselId)
            ->select('main_service_carousel_image.*', 'display_dimension_type.description')
            ->get();
    }

    public static function getImage($mainServiceCarouselId, $displayDimensionType)
    {
        return MainCarouselImage::where('main_service_carousel_id', $mainServiceCarouselId)
            ->where('display_dimension_type', '<=', $displayDimensionType)
            ->orderBy('display_dimension_type', 'desc')
            ->first();
    }

    public static function getImagebyDimensionType($mainServiceCarouselId, $displayDimensionType)
    {
        return MainCarouselImage::where('main_service_carousel_id', $mainServiceCarouselId)
            ->where('display_dimension_type', $displayDimensionType)
            ->first();
    }

    public static function delete($entityId)
    {
        MainCarousel::where('id', $entityId)->delete();
        return true;
    }
    public static function deleteImg($entityId)
    {
        MainCarouselImage::where('id', $entityId)->delete();
        return true;
    }
}