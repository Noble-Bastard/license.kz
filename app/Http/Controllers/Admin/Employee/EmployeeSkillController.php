<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Data\Employee\Dal\EmployeeSkillDal;
use App\Data\Employee\Model\EmployeeSkill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class EmployeeSkillController extends Controller
{
    private $validateRule = [
        'employee_id' => 'required|numeric',
        'value' => 'required|string|max:512'
    ];
    
    public function getList($employeeId)
    {
        $entityList = EmployeeSkillDal::getListByEmployee($employeeId, false);

        return response()->json($entityList);
    }

    public function get($employeeSkillId)
    {
        $employeeSkillList = EmployeeSkillDal::get($employeeSkillId);

        return response()->json($employeeSkillList);
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
        $entity = new EmployeeSkill();

        if($id){
            $entity->id = Input::get('id');
        }

        $entity->employee_id = Input::get('employee_id');
        $entity->value = Input::get('value');

        $entity = EmployeeSkillDal::set($entity);

        return $entity;
    }

    public function delete()
    {
        EmployeeSkillDal::get(Input::get('entityId'))->delete();

        return response()->json('1');
    }
}
