<?php

namespace App\Http\Controllers\Admin;

use App\Data\Career\Dal\CareerDal;
use App\Data\Company\Dal\CompanyDal;
use App\Data\Core\Dal\ProfileDal;
use App\Data\Core\Dal\RoleDal;
use App\Data\Core\Dal\UserDal;
use App\Data\Core\Model\ProfilePartner;
use App\Data\Core\Model\UsersExt;
use App\Data\Helper\FilePathHelper;
use App\Data\Helper\RoleList;
use App\Data\Helper\RoleTypeList;
use App\Data\Service\Dal\CityDal;
use App\Data\Service\Dal\LicenseTypeDal;
use App\Data\Translation\Dal\TranslationDal;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $roleList = RoleDal::getByRoleType(RoleTypeList::Employees, true);
        $roleTypeList = RoleDal::getRoleTypeList();
        $managerList = ProfileDal::getListByRoles(array(RoleList::Manager), false, null, true);

        $companyProfileAddressList = CompanyDal::getList(false);
        $cityList = CityDal::getList(false, false);

        return view('admin.users.index')
            ->with('managerList', $managerList)
            ->with('roleTypeList',$roleTypeList)
            ->with('companyProfileAddressList', $companyProfileAddressList)
            ->with('cityList', $cityList)
            ->with('roleList', $roleList);
    }

    public function userList(){

        $searchText = Input::get('searchText');
        $roleTypeId = Input::get('roleTypeId');

        $userList = ProfileDal::getListByRoleType(
            $roleTypeId,
            true,
            $searchText,
            true
        );

        return response()->json($userList);
    }

    public function getCityList()
    {
        $cityList = CityDal::getList(false, false);
        return response()->json($cityList);
    }

    public function getManagerList()
    {
        $managerList = ProfileDal::getListByRoles(array(RoleList::Manager), false, null, true);
        return response()->json($managerList);
    }

    public function create(){
        $roleList = RoleDal::getByRoleType(RoleTypeList::Employees, true);
        $managerList = ProfileDal::getListByRoles(array(RoleList::Manager), false, null, true);

        return view('admin.users.create')
            ->with('managerList', $managerList->pluck('full_name', 'id'))
            ->with('roleList', $roleList);
    }

    public function store(Request $request){
        $validateRule = [
            'user_name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'role_id' => 'required'
        ];

        $roleNeedCompany = array(
            RoleList::Administrator,
            RoleList::Executor,
            RoleList::Manager,
            RoleList::SaleManager,
            RoleList::Curator,
            RoleList::Head,
            RoleList::Accountant,
        );

        if(in_array(Input::get('role_id'), $roleNeedCompany)){
            $validateRule['company_id'] = 'required';
        }

        if(Input::get('role_id') == RoleList::Executor) {
            $validateRule['manager_id'] = 'required';
        }

        if(Input::get('role_id') == RoleList::Partner) {
            $validateRule['city_id'] = 'required';
        }

        Validator::make($request->all(), $validateRule)->validate();

        $userExt = new UsersExt();
        $userExt->name = Input::get('user_name');
        $userExt->email = Input::get('email');
        $userExt->role_id = Input::get('role_id');
        $userExt->is_active = true;
        $userExt->manager = Input::get('manager_id');
        $userExt->city_id = Input::get('city_id');
        $userExt->country_name = Input::get('country_name');
        $userExt->country_code = Input::get('country_code');
        $userExt->city_name = Input::get('city_name');

        $userExt->company_id = Input::get('company_id');

        $user = UserDal::insert($userExt);

        $user->sendWelcomeEmail();

        return response()->json($user);
    }

    public function edit($id)
    {
        $user = ProfileDal::get($id);

        $roleList = RoleDal::getByRoleType(RoleTypeList::Employees, true);
        $managerList = ProfileDal::getListByRoles(array(RoleList::Manager), false, null, true);

        return view('admin.users.edit')
            ->with('user', $user)
            ->with('managerList', $managerList->pluck('full_name', 'id'))
            ->with('roleList', $roleList);
    }

    public function update(Request $request){
        $validateRule = [
            'user_name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,id,'.$request->get('id'),
            'role_id' => 'required'
        ];

        if(Input::get('role_id') == RoleList::Executor) {
            $validateRule['manager_id'] = 'required';
        }

        Validator::make($request->all(), $validateRule)->validate();

        $userExt = new UsersExt();
        $userExt->id = Input::get('user_id');
        $userExt->profile_id = Input::get('id');
        $userExt->name = Input::get('user_name');
        $userExt->email = Input::get('email');
        $userExt->role_id = Input::get('role_id');
        $userExt->is_active = !is_null(Input::get('user_is_active'));
        $userExt->manager = Input::get('manager_id');
        UserDal::update($userExt);

        return 1;
    }

    public function deactivate($id)
    {
        UserDal::setUserActiveStatus($id, false);
        return 1;
    }

    public function activate($id)
    {
        UserDal::setUserActiveStatus($id, true);
        return 1;
    }


    public function destroy($id)
    {
        UserDal::setUserActiveStatus($id, false);
        return redirect(route('admin.users.list'));
    }

    public function getPartnerExtra($id)
    {
        $entity = ProfileDal::getPartnerData($id);

        return response()->json($entity);
    }

    public function setPartnerExtra(Request $request)
    {
        $validateRule = [
            'profile_id' => 'required',
            'company_name' => 'required|string|max:255',
            'company_site' => 'required|string|max:128',
            'company_activity_field' => 'string|max:248',
            'company_founder' => 'string|max:248',
            'company_services' => 'string|max:248',
            'company_projects' => 'string|max:248',
            'company_awards' => 'string|max:248',
        ];

        Validator::make($request->all(), $validateRule)->validate();

        $profilePartner = new ProfilePartner();
        $profilePartner->profile_id = Input::get('profile_id');
        $profilePartner->company_name = Input::get('company_name');
        $profilePartner->company_site = Input::get('company_site');
        $profilePartner->company_activity_field = Input::get('company_activity_field');
        $profilePartner->company_founder = Input::get('company_founder');
        $profilePartner->company_services = Input::get('company_services');
        $profilePartner->company_projects = Input::get('company_projects');
        $profilePartner->company_awards = Input::get('company_awards');

        TranslationDal::extendEntityAttribute('profile_partner', $profilePartner);

        if(!is_null($request->file('company_logo'))){
            $path = $request->file('company_logo')->store(FilePathHelper::getPartnerFormPath());

            $profilePartner->company_logo = $path;
        }

        ProfileDal::setPartnerData($profilePartner);

        return 1;
    }

    public function getProfileCites($id)
    {
        $profile = ProfileDal::getByUserId($id);

        return response()->json($profile->cites);
    }

    public function setProfileCity($id, $cityId)
    {
        ProfileDal::setProfileCity($id, $cityId);

        return $this->getProfileCites($id);
    }

    public function deleteProfileCity($id, $profileCityId)
    {
        ProfileDal::deleteProfileCity($profileCityId);

        return $this->getProfileCites($id);
    }

    public function getLicenseTypeList()
    {
        $licenseType = (new LicenseTypeDal())->getList();
        return response()->json($licenseType);
    }

    public function getProfileLicenseType($id)
    {
        $profile = ProfileDal::getByUserId($id);

        return response()->json($profile->licenseTypeList);
    }

    public function setProfileLicenseType($id, $licenseTypeId)
    {
        ProfileDal::setProfileLicenseType($id, $licenseTypeId);

        return $this->getProfileLicenseType($id);
    }

    public function deleteProfileLicenseType($id, $profileLicenseTypeId)
    {
        ProfileDal::deleteProfileLicenseType($profileLicenseTypeId);

        return $this->getProfileLicenseType($id);
    }
}
