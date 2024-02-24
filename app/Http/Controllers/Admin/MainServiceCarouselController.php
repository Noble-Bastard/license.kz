<?php

namespace App\Http\Controllers\Admin;

use App\Data\Helper\Assistant;
use App\Data\Service\Dal\CountryDal;
use App\Data\Service\Dal\MainCarouselDal;
use App\Data\Service\Dal\ServiceCategoryDal;
use App\Data\Service\Dal\ServiceDal;
use App\Data\Service\Dal\ServiceThematicGroupDal;
use App\Data\Service\Model\MainCarousel;
use App\Data\Service\Model\MainCarouselImage;
use App\Data\Service\Model\ServiceCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Data\Helper\FilePathHelper;
use Intervention\Image\Facades\Image;


class MainServiceCarouselController extends Controller
{
    public function index()
    {
        $mainServiceCarouselList = MainCarouselDal::getList(true);
        return view('admin.serviceCarousel.index')->with('mainServiceCarouselList', $mainServiceCarouselList);
    }

    public function create(){
        $serviceCategoryList = ServiceCategoryDal::getServiceCategoryWithoutSystemList()->sortBy('name');
        $countryList = CountryDal::getList(false);
        $serviceList = collect();
        $displayDimentionList=MainCarouselDal::getdisplayDimentionList();

        return view('admin.serviceCarousel.create')
            ->with('serviceCategoryList', $serviceCategoryList->pluck('name', 'id'))
            ->with('countryList', $countryList->pluck('name', 'id'))
            ->with('serviceList', $serviceList)
            ->with('displayDimentionList',$displayDimentionList);
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'service_id' => 'required',
            'order_no' => 'required|numeric'
        ])->validate();

        $new = new MainCarousel();
        $new->service_id = Input::get('service_id');
        $new->order_no = Input::get('order_no');

        $mainCarousel = MainCarouselDal::set($new);
        $displayDimentionList = MainCarouselDal::getdisplayDimentionList();

        foreach ($displayDimentionList as $displayDimention) {
            $MainCarouselImageOld=MainCarouselDal::getImagebyDimensionType($mainCarousel->id,$displayDimention->display_dimension_type);
            if($MainCarouselImageOld!=null){
                $MainCarouselImageId=$MainCarouselImageOld->id;}
            else{
                $MainCarouselImageId=null;
            }

            $MainCarouselImage = new MainCarouselImage();
            $MainCarouselImage->id = $MainCarouselImageId;
            $MainCarouselImage->main_service_carousel_id = $mainCarousel->id;
            $MainCarouselImage->display_dimension_type = $displayDimention->id;

            $file = $request->file('img'.$displayDimention->id);
            if($file!=null) {
                $img = Image::make($file);
                Response::make($img->encode('png'));

                $MainCarouselImage->img = $img;
                MainCarouselDal::addImage($MainCarouselImage);
            }
        }
        //why?
       // return redirect(route('admin.mainServiceCarousel.get', ['id' => $mainCarousel->id]));
        $mainServiceCarouselList = MainCarouselDal::getList(true);
        return view('admin.serviceCarousel.index')->with('mainServiceCarouselList', $mainServiceCarouselList);
    }

    public function get($id)
    {
        $mainServiceCarousel = MainCarouselDal::get($id);
        $mainServiceCarouselImgList=MainCarouselDal::getImageList($id);
        $service=ServiceDal::get($mainServiceCarousel->service_id);
        $serviceCategoryList = ServiceCategoryDal::getServiceCategoryWithoutSystemList()->sortBy('name');
        $countryList = CountryDal::getList(false);
        $serviceList = collect();
        $displayDimentionList=MainCarouselDal::getdisplayDimentionList();

        return view('admin.serviceCarousel.edit')
        ->with('mainServiceCarousel', $mainServiceCarousel)
        ->with('mainServiceCarouselImgList', $mainServiceCarouselImgList)
        ->with('service',$service)
        ->with('serviceCategoryList', $serviceCategoryList->pluck('name', 'id'))
        ->with('countryList', $countryList->pluck('name', 'id'))
        ->with('serviceList', $serviceList)
        ->with('displayDimentionList',$displayDimentionList);
    }

    public function edit($id)
    {
        $mainServiceCarousel = MainCarouselDal::get($id);
        $mainServiceCarouselImgList=MainCarouselDal::getImageList($id);
        $service=ServiceDal::get($mainServiceCarousel->service_id);
        $service_category_id = ServiceThematicGroupDal::getServiceThematicGroup($service->service_thematic_group_id)->service_category_id;
        $serviceCategoryList = ServiceCategoryDal::getServiceCategoryWithoutSystemList()->sortBy('name');
        $countryList = CountryDal::getList(false);
        $serviceList = collect();
        $displayDimentionList=MainCarouselDal::getdisplayDimentionList();

        return view('admin.serviceCarousel.edit')
            ->with('mainServiceCarousel', $mainServiceCarousel)
            ->with('mainServiceCarouselImgList', $mainServiceCarouselImgList)
            ->with('service',$service)
            ->with('service_category_id',$service_category_id)
            ->with('serviceCategoryList', $serviceCategoryList->pluck('name', 'id'))
            ->with('countryList', $countryList->pluck('name', 'id'))
            ->with('serviceList', $serviceList)
            ->with('displayDimentionList',$displayDimentionList);
    }

    public function serviceListByCategory($serviceCategory, $countryId)
    {
        $serviceList = ServiceDal::getServiceListByServiceCategoryAndCountry($serviceCategory, $countryId);

        return view('admin.serviceCarousel._serviceListByCategory')
            ->with('serviceList', $serviceList);
    }

    public function getImage($mainServiceCarouselId, $displayDimensionType)
    {
        $img = MainCarouselDal::getImage($mainServiceCarouselId, $displayDimensionType);
        if(is_null($img)){
            return response(Storage::get('/core/defaultCarousel.png'), 200, ['Content-Type' => 'image/png']);
        } else {
            return response($img->img, 200, ['Content-Type' => 'image/png']);
        }
    }


    public function update(Request $request){

        Validator::make($request->all(), [
            'service_id' => 'required',
            'order_no' => 'required|numeric'
        ])->validate();

        $new = new MainCarousel();
        $new->id = Input::get('id');
        $new->service_id = Input::get('service_id');
        $new->order_no = Input::get('order_no');

        $mainCarousel = MainCarouselDal::set($new);

        $displayDimentionList = MainCarouselDal::getdisplayDimentionList();
        foreach ($displayDimentionList as $displayDimention) {
            $MainCarouselImageOld=MainCarouselDal::getImagebyDimensionType($mainCarousel->id,$displayDimention->display_dimension_type);
            if($MainCarouselImageOld!=null){
                $MainCarouselImageId=$MainCarouselImageOld->id;}
            else{
                $MainCarouselImageId=null;
            }

            $MainCarouselImage = new MainCarouselImage();
            $MainCarouselImage->id = $MainCarouselImageId;
            $MainCarouselImage->main_service_carousel_id = $mainCarousel->id;
            $MainCarouselImage->display_dimension_type = $displayDimention->id;

            $file = $request->file('img'.$displayDimention->id);
            if($file!=null) {
                $img = Image::make($file);
                Response::make($img->encode('png'));

                $MainCarouselImage->img = $img;
                MainCarouselDal::addImage($MainCarouselImage);
            }
        }

        $mainServiceCarouselList = MainCarouselDal::getList(true);
        return view('admin.serviceCarousel.index')->with('mainServiceCarouselList', $mainServiceCarouselList);
    }

    public function destroy($id)
    {
        $mainServiceCarouselImgList=MainCarouselDal::getImageList($id);
        foreach ($mainServiceCarouselImgList as $mainServiceCarouselImg){
            MainCarouselDal::deleteImg($mainServiceCarouselImg->id);
        }

        MainCarouselDal::delete($id);

        $mainServiceCarouselList = MainCarouselDal::getList(true);
        return view('admin.serviceCarousel.index')->with('mainServiceCarouselList', $mainServiceCarouselList);
    }
}
