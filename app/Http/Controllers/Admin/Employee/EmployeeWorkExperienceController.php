<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Data\Employee\Dal\EmployeeWorkExperienceDal;
use App\Data\Employee\Model\EmployeeWorkExperience;
use App\Data\Helper\Assistant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class EmployeeWorkExperienceController extends Controller
{
    private $validateRule = [
        'employee_id' => 'required|numeric',
        'work_place' => 'required|string|max:2048',
        'description' => 'required|string',
        'start_date' => 'required'
    ];
    
    public function getList($employeeId)
    {
        $entityList = EmployeeWorkExperienceDal::getListByEmployee($employeeId, false);

        return response()->json($entityList);
    }

    public function get($employeeWorkExperienceId)
    {
        $employeeWorkExperienceList = EmployeeWorkExperienceDal::get($employeeWorkExperienceId);

        return response()->json($employeeWorkExperienceList);
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
        $entity = new EmployeeWorkExperience();

        if($id){
            $entity->id = Input::get('id');
        }

        $entity->employee_id = Input::get('employee_id');
        $entity->work_place = Input::get('work_place');
        $entity->description = Input::get('description');
        $entity->start_date =  Assistant::convertStringToDate(Input::get('start_date'), 'Y');

        $entity = EmployeeWorkExperienceDal::set($entity);

        return $entity;
    }

    public function delete()
    {
        EmployeeWorkExperienceDal::get(Input::get('entityId'))->delete();

        return response()->json('1');
    }
}
