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

        switch($roleId){
            case RoleList::Administrator :
                return Redirect::intended(route('admin.users.list'));
                
            case RoleList::SaleManager:
                file_put_contents(storage_path('logs/debug.txt'), "Redirecting SaleManager to: " . route('sale_manager.service.list') . " at " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
                return Redirect::intended(route('sale_manager.service.list'));
                
            case RoleList::Curator:
                return Redirect::intended(route('curator.review.list'));
                
            case RoleList::Manager:
                file_put_contents(storage_path('logs/debug.txt'), "Redirecting Manager to: " . route('manager.services.list') . " at " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
                return Redirect::intended(route('manager.services.list'));
                
            case RoleList::Executor:
                return Redirect::intended(route('executor.project.list'));
                
            case RoleList::Client:
                return redirect()->route('Client.service.list');
                
            case RoleList::Agent:
                return Redirect::intended(route('agent.client.index'));
                
            case RoleList::Head:
                return Redirect::intended(route('Report.index'));
                
            case RoleList::Accountant:
                return Redirect::intended(route('Accountant.services'));
                
            case RoleList::Partner:
                // Если есть маршрут для партнеров, добавляем его
                return redirect()->route('Client.service.list'); // Временно как клиент
                
            default:
                // Если роль неизвестна, направляем в клиентский ЛК по умолчанию
                Log::warning("Unknown role for user {$user->id}: {$roleId}");
                return redirect()->route('Client.service.list');
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
