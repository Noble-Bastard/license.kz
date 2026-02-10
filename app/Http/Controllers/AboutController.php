<?php

namespace App\Http\Controllers;

use App\Data\Employee\Dal\EmployeeDal;
use App\Data\Employee\Dal\EmployeeEducationDal;
use App\Data\Employee\Dal\EmployeePositionDal;
use App\Data\Employee\Dal\EmployeeSkillDal;
use App\Data\Employee\Dal\EmployeeSocialDal;
use App\Data\Employee\Dal\EmployeeSpecialityDal;
use App\Data\Employee\Dal\EmployeeWorkExperienceDal;
use App\Data\Service\Dal\CityDal;
use Illuminate\Http\Request;
use App\Data\Helper\Assistant;
use App\Data\Service\Dal\CountryDal;
use App\Data\Article\Dal\ArticleDal;
use App\Data\Article\Model\Article;
class AboutController extends Controller
{
       /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $articleList=ArticleDal::getArticleByType(3, true);
//
//        $countryList = CountryDal::getList(false, true, false);
//        foreach ($countryList as $country){
//            $country->cityList = CityDal::getListByCountry($country->id, false, true);
//        }
//
//        $employeeList = EmployeeDal::getList(false);
//
//        return view('about')
//            ->with('countryList', $countryList)
//            ->with('employeeList', $employeeList)
//            ->with('articleList',$articleList);

        return view('about');
    }

       /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
        */
    public function indexNew()
    {
        return view('new.pages.about');
    }

    public function showEmployee($emplyeeId)
    {
        $employee = EmployeeDal::get($emplyeeId);
        $employee->employee_education_list = EmployeeEducationDal::getListByEmployee($emplyeeId);
        $employee->employee_skill_list = EmployeeSkillDal::getListByEmployee($emplyeeId);
        $employee->employee_social_list = EmployeeSocialDal::getListByEmployee($emplyeeId);
        $employee->employee_speciality_list = EmployeeSpecialityDal::getListByEmployee($emplyeeId);
        $employee->employee_work_experience_list = EmployeeWorkExperienceDal::getListByEmployee($emplyeeId);
        $employee->employee_position = EmployeePositionDal::get($employee->employee_position_id);

        return view('employee.show')
            ->with('employee', $employee);
    }
}
