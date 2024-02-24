<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Data\Employee\Dal\EmployeeSpecialityDal;
use App\Data\Employee\Model\EmployeeSpeciality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class EmployeeSpecialityController extends Controller
{
    private $validateRule = [
        'employee_id' => 'required|numeric',
        'name' => 'required|string|max:512',
        'value' => 'required|numeric|min:1|max:10'
    ];
    
    public function getList($employeeId)
    {
        $entityList = EmployeeSpecialityDal::getListByEmployee($employeeId, false);

        return response()->json($entityList);
    }

    public function get($employeeSpecialityId)
    {
        $employeeSpecialityList = EmployeeSpecialityDal::get($employeeSpecialityId);

        return response()->json($employeeSpecialityList);
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
        $entity = new EmployeeSpeciality();

        if($id){
            $entity->id = Input::get('id');
        }

        $entity->employee_id = Input::get('employee_id');
        $entity->name = Input::get('name');
        $entity->value = Input::get('value');

        $entity = EmployeeSpecialityDal::set($entity);

        return $entity;
    }

    public function delete()
    {
        EmployeeSpecialityDal::get(Input::get('entityId'))->delete();

        return response()->json('1');
    }
}
