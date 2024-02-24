<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Data\Core\Dal\SocialTypeDal;
use App\Data\Employee\Dal\EmployeeSocialDal;
use App\Data\Employee\Model\EmployeeSocial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class EmployeeSocialController extends Controller
{
    private $validateRule = [
        'employee_id' => 'required|numeric',
        'value' => 'required|string|max:128',
        'social_type_id' => 'required|numeric'
    ];
    
    public function getList($employeeId)
    {
        $entityList = EmployeeSocialDal::getListByEmployee($employeeId, false);

        $result = new \stdClass();
        $result->entityList = $entityList;
        $result->socialTypeList = SocialTypeDal::getList(false);

        return response()->json($result);
    }

    public function getSocialTypeList()
    {
        $entityList = SocialTypeDal::getList(false);
        return response()->json($entityList);
    }

    public function get($employeeSocialId)
    {
        $employeeSocialList = EmployeeSocialDal::get($employeeSocialId);

        return response()->json($employeeSocialList);
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), $this->validateRule)->validate();

        $entity = $this->set(false);

        return response()->json($entity);
    }

    public function update(Request $request)
    {
        Validator::make($request->all(), $this->validateRule)->validate();

        $entity = $this->set(true);

        return response()->json($entity);
    }

    private function set(bool $id = false){
        $entity = new EmployeeSocial();

        if($id){
            $entity->id = Input::get('id');
        }

        $entity->employee_id = Input::get('employee_id');
        $entity->social_type_id = Input::get('social_type_id');
        $entity->value = Input::get('value');

        $entity = EmployeeSocialDal::set($entity);

        return $entity;
    }

    public function delete()
    {
        EmployeeSocialDal::get(Input::get('entityId'))->delete();

        return response()->json('1');
    }
}
