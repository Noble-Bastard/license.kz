<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Data\Employee\Dal\EmployeeEducationDal;
use App\Data\Employee\Dal\EmployeePositionDal;
use App\Data\Employee\Dal\EmployeeSkillAchievementDal;
use App\Data\Employee\Dal\EmployeeSkillDal;
use App\Data\Employee\Dal\EmployeeWorkExperienceDal;
use App\Data\Employee\Model\Employee;
use App\Data\Employee\Model\EmployeeEducation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class EmployeeEducationController extends Controller
{
    private $validateRule = [
        'employee_id' => 'required|numeric',
        'education_place' => 'required|string|max:4096',
        'start_date' => 'required',
        'end_date' => 'required',
    ];
    
    public function getList($employeeId)
    {
        $entityList = EmployeeEducationDal::getListByEmployee($employeeId, false);

        return response()->json($entityList);
    }

    public function get($employeeEducationId)
    {
        $employeeEducationList = EmployeeEducationDal::get($employeeEducationId);

        return response()->json($employeeEducationList);
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
        $entity = new EmployeeEducation();

        if($id){
            $entity->id = Input::get('id');
        }

        $entity->employee_id = Input::get('employee_id');
        $entity->education_place = Input::get('education_place');
        $entity->start_date = Input::get('start_date').'.01.01';
        $entity->end_date = Input::get('end_date').'.01.01';

        $entity = EmployeeEducationDal::set($entity);

        return $entity;
    }

    public function delete()
    {
        EmployeeEducationDal::get(Input::get('entityId'))->delete();

        return response()->json('1');
    }
}
