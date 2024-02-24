<?php
/**
 * Created by PhpStorm.
 * User: R.Biewald
 * Date: 30.11.2018
 * Time: 17:21
 */

namespace App\Http\Controllers\Admin\Service;

use App\Data\Core\Dal\ProfileDal;
use App\Data\Core\Dal\UserDal;
use App\Data\Core\Model\UsersExt;
use App\Data\Helper\RoleList;
use App\Data\Service\Dal\CountryDal;
use App\Data\Service\Dal\ServiceCategoryDal;
use App\Data\Service\Model\ServiceCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ServiceCategoryController extends Controller
{
    private $validateRule = [
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:1024',
        'order_no' => 'required|numeric'
    ];

    public function index(){

        $countryList = CountryDal::getList();

        return view('admin.service.serviceCategory.index',[
            'countryList' => $countryList
        ]);
    }

    public function entityList(){

        $countryId = Input::get('countryId');
        $withPaginate = Input::get('withPaginate') == "true";
        $entityList = ServiceCategoryDal::getServiceCategoryWithoutSystemList(true, $withPaginate, $countryId);

        return response()->json($entityList);
    }

    public function entityWithSystemList(){

        $countryId = Input::get('countryId');
        $withPaginate = Input::get('withPaginate') == "true";
        $entityList = ServiceCategoryDal::getServiceCategoryWithSystemList(true, $withPaginate, $countryId);

        return response()->json($entityList);
    }


    public function getServiceCategoryList(){
        $entityList = ServiceCategoryDal::getServiceCategoryWithoutSystemList(true, false);

        return response()->json($entityList);
    }

    public function store(Request $request){
        Validator::make($request->all(), $this->validateRule)->validate();

        $entity = new ServiceCategory();
        $entity->name = Input::get('name');
        $entity->name_en = Input::get('name_en');
        $entity->description = Input::get('description');
        $entity->description_en = Input::get('description_en');
        $entity->order_no = Input::get('order_no');
        $entity->country_id = Input::get('country_id');
        $entity->is_standart_contract_template_show = !is_null(Input::get('is_standart_contract_template_show'));

        $entity = ServiceCategoryDal::set($entity, true);

        return response()->json($entity);
    }

    public function update(Request $request){
        Validator::make($request->all(), $this->validateRule)->validate();

        $entity = new ServiceCategory();
        $entity->id = Input::get('id');
        $entity->name = Input::get('name');
        $entity->name_en = Input::get('name_en');
        $entity->description = Input::get('description');
        $entity->description_en = Input::get('description_en');
        $entity->order_no = Input::get('order_no');
        $entity->country_id = Input::get('country_id');
        $entity->is_standart_contract_template_show = Input::get('is_standart_contract_template_show');
        $entity = ServiceCategoryDal::set($entity, true);

        return response()->json('1');
    }

    public function delete()
    {
        ServiceCategoryDal::delete(Input::get('entityId'));
        return response()->json('1');
    }

    public function changePhoto($id, Request $request)
    {
        $photo = $request->file('photo');
        ServiceCategoryDal::setPhoto($id, base64_encode(file_get_contents($photo->getRealPath())));

        return response()->json('1');
    }
}