<?php

namespace App\Data\Core\Dal;

use App\Data\Core\Dal\ProfileDal;
use App\Data\Core\Model\Profile;
use App\Data\Core\Model\ProfileExt;
use App\Data\Core\Model\UserRole;
use App\Data\Core\Model\UsersExt;
use App\Data\Helper\ProfileStateTypeList;
use App\Data\Helper\RoleList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Data\Core\Model\Role;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserDal
{
    public static function getByName($userName)
    {
        $user = UsersExt::where('name', $userName)->first();
        return $user;
    }

    public static function get($userId)
    {
        $user = UsersExt::where('id', $userId)->firstOrFail();
        return $user;
    }

    /**
     * Return users by role list
     *
     * @param $roleList
     * @return mixed
     */
    public static function getListByRoles($roleList){
        $users = UsersExt::whereIn('role_id',$roleList);
        return $users;
    }

    /**
     * @param $userId
     * @param $isActive
     */
    public static function setUserActiveStatus($userId, $isActive){
        $users = User::where('id', $userId)->firstOrFail();
        $users->is_active = $isActive;
        $users->updated_at = new \DateTime();
        $users->save();
    }

    /**
     * @param UsersExt $entity
     * @return User|null
     */
    public static function insert (UsersExt $entity)
    {
        try {
            DB::beginTransaction();

            $profileExt = new ProfileExt();
            $profileExt->full_name = $entity->name;
            $profileExt->phone = '';
            $profileExt->email = $entity->email;
            $profileExt->password = Hash::make(Str::random(10));
            $profileExt->profile_state_type_id = ProfileStateTypeList::Idividual;
            $profileExt->is_resident = true;
            $profileExt->role_id = $entity->role_id;
            $profileExt->company_id = $entity->company_id;
            $profileExt->manager_id = $entity->manager;
            $profileExt->city_id = $entity->city_id;
            $profileExt->country_name = $entity->country_name;
            $profileExt->country_code = $entity->country_code;
            $profileExt->city_name = $entity->city_name;

            $users = ProfileDal::insert($profileExt);

            DB::commit();

            return $users;
        }
        catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return null;
        }
    }


    public static function update (UsersExt $entity)
    {
        try {
            DB::beginTransaction();

            $users = User::where('id', $entity->id)->firstOrFail();
            $users->name = $entity->name;
            $users->is_active = $entity->is_active;
            $users->email = $entity->email;
            $users->save();

            //if($entity->is_active) {
                $profileExt = new ProfileExt();
                $profileExt->id = $entity->profile_id;
                $profileExt->full_name = $entity->name;
                $profileExt->phone = '';
                $profileExt->email = $entity->email;
                $profileExt->profile_state_type_id = ProfileStateTypeList::Idividual;
                $profileExt->is_resident = true;
                $profileExt->role_id = $entity->role_id;
                $profileExt->manager_id = $entity->manager;

                ProfileDal::update($profileExt);
            //}
            DB::commit();

            return $users;
        }
        catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return null;
        }

    }


    public static function getByUserName($userName){
        return User::where('name', $userName)->where('is_active', 1)->first();
    }

    public static function getByEmail($email){
        return User::where('email', $email)->where('is_active', 1)->first();
    }


    public static function getByUserNameWithNoActiveCheck($userName){
        return User::where('name', $userName)->first();
    }


    public static function getUserRole($userId){
        return UserRole::where('user_id', $userId)->first();
    }

    public static function login($user){
        \Log::info("UserDal::login called for user: " . $user->id);
        
        ProfileDal::setLastLoginDate($user->id, new \DateTime());

        $userProfile = ProfileDal::getByUserId($user->id);
        $roleId = $userProfile ? $userProfile->role_id : null;
        
        \Log::info("User profile found. Role ID: " . ($roleId ?? 'null'));

        $locale = app()->getLocale();
        switch($roleId){
            case RoleList::Administrator :
                return redirect()->to("/{$locale}/admin/users");
                
            case RoleList::SaleManager:
                file_put_contents(storage_path('logs/debug.txt'), "Redirecting SaleManager to: /{$locale}/salemanager/services at " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
                return redirect()->to("/{$locale}/salemanager/services");
                
            case RoleList::Curator:
                return redirect()->to("/{$locale}/curator/reviewList");
                
            case RoleList::Manager:
                file_put_contents(storage_path('logs/debug.txt'), "Redirecting Manager to: /{$locale}/manager/servicesList at " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
                return redirect()->to("/{$locale}/manager/servicesList");
                
            case RoleList::Executor:
                return redirect()->to("/{$locale}/executor/projects");
                
            case RoleList::Client:
                return redirect()->to("/{$locale}/profile/services");
                
            case RoleList::Agent:
                return redirect()->to("/{$locale}/agent/client");
                
            case RoleList::Head:
                return redirect()->to("/{$locale}/report/");
                
            case RoleList::Accountant:
                return redirect()->to("/{$locale}/accountant/services");
                
            case RoleList::Partner:
                // Временно перенаправляем как клиента
                return redirect()->to("/{$locale}/profile/services");
                
            default:
                // Если роль неизвестна, направляем в клиентский ЛК по умолчанию
                Log::warning("Unknown role for user {$user->id}: {$roleId}");
                return redirect()->to("/{$locale}/profile/services");
        }
    }

    public static function sendNewClientEmailToAdmin($newUser)
    {
        $userList = UserRole::where('role_id', RoleList::Administrator)->with('user')->get();
        foreach ($userList as $admin){
            if($admin->user->is_active) {
                $admin->user->sendAdminNewClientEmail($newUser);
            }
        }
    }
}
