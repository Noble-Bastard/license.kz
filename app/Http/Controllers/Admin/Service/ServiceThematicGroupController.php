<?php

namespace App\Http\Controllers\Admin\Service;

use App\Data\Service\Dal\ServiceThematicGroupDal;
use App\Data\Service\Model\ServiceThematicGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ServiceThematicGroupController extends Controller
{
    private $validateRule = [
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:1024',
        'service_category_id' => 'required|numeric'
    ];

    public function index(){
        return view('admin.service.serviceThematicGroup.index');
    }

    public function entityList($serviceCategoryId){
        $withPaginate = Input::get('withPaginate') == "true";
        $entityList = ServiceThematicGroupDal::getListByServiceCategory($serviceCategoryId, $withPaginate);

        return response()->json($entityList);
    }

    public function store(Request $request){
        Validator::make($request->all(), $this->validateRule)->validate();

        $entity = new ServiceThematicGroup();
        $entity->name = Input::get('name');
        $entity->description = Input::get('description');
        $entity->service_category_id = Input::get('service_category_id');
        $entity = ServiceThematicGroupDal::set($entity);

        return response()->json($entity);
    }

    public function update(Request $request){
        Validator::make($request->all(), $this->validateRule)->validate();

        $entity = new ServiceThematicGroup();
        $entity->id = Input::get('id');
        $entity->name = Input::get('name');
        $entity->description = Input::get('description');
        $entity->service_category_id = Input::get('service_category_id');
        $entity = ServiceThematicGroupDal::set($entity);

        return response()->json('1');
    }

    public function delete()
    {
        ServiceThematicGroupDal::delete(Input::get('entityId'));
        return response()->json('1');
    }
}
