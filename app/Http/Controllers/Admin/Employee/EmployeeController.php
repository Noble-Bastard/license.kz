<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Data\Company\Dal\CompanyDal;
use App\Data\Employee\Dal\EmployeeDal;
use App\Data\Employee\Dal\EmployeeEducationDal;
use App\Data\Employee\Dal\EmployeePositionDal;
use App\Data\Employee\Dal\EmployeeSkillAchievementDal;
use App\Data\Employee\Dal\EmployeeSkillDal;
use App\Data\Employee\Dal\EmployeeSocialDal;
use App\Data\Employee\Dal\EmployeeSpecialityDal;
use App\Data\Employee\Dal\EmployeeWorkExperienceDal;
use App\Data\Employee\Model\Employee;
use App\Data\Helper\FilePathHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    private $validateRule = [
        'employee_position_id' => 'required|numeric',
        'last_name' => 'required|string|max:256',
        'first_name' => 'required|string|max:256',
        'description' => 'required|string',
    ];

    public function index()
    {
        return view('admin.employee.list.index');
    }

    public function getList()
    {
        $entityList = EmployeeDal::getList(true);

        foreach ($entityList as $entity){
            $entity->position = $entity->position->get();
        }

        return response()->json($entityList);
    }

    public function getPositionList()
    {
        return response()->json(EmployeePositionDal::getList(false));
    }

    public function get($employeeId)
    {
        $employee = EmployeeDal::get($employeeId);

        $employeePositionList = EmployeePositionDal::getList(false);

        $result = new \stdClass();
        $result->entity = $employee;
        $result->employeePositionList = $employeePositionList;

        return response()->json($result);
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
        $entity = new Employee();

        if($id){
            $entity->id = Input::get('id');
        }

        $entity->employee_position_id = Input::get('employee_position_id');
        $entity->first_name = Input::get('first_name');
        $entity->last_name = Input::get('last_name');
        $entity->photo_path = null;
        $entity->description = Input::get('description') ?? '';
        $entity->work_experience_description = Input::get('work_experience_description') ?? '';
        $entity->about_me = Input::get('about_me') ?? '';
        $entity->skill_achievement_description = Input::get('skill_achievement_description') ?? '';
        $entity->phone = Input::get('phone') ?? '';
        $entity->address = Input::get('address') ?? '';
        $entity->email = Input::get('email') ?? '';
        $entity->web_site = Input::get('web_site') ?? '';
        $entity = EmployeeDal::set($entity);

        return $entity;
    }

    public function delete()
    {
        $employeeId = Input::get('entityId');

        EmployeeEducationDal::deleteByEmployee($employeeId);
        EmployeeSkillDal::deleteByEmployee($employeeId);
        EmployeeSocialDal::deleteByEmployee($employeeId);
        EmployeeSpecialityDal::deleteByEmployee($employeeId);
        EmployeeWorkExperienceDal::deleteByEmployee($employeeId);
        EmployeeDal::get($employeeId)->delete();

        return response()->json('1');
    }


    public function changePhoto($id, Request $request)
    {
        $path = $request->file('photo')->store(FilePathHelper::getEmployeePhotoPath());

        EmployeeDal::setPhotoPath($id, $path);
        return response()->json('1');
    }
}
