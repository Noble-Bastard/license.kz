<?php

namespace App\Data\Core\Dal;

use App\Data\Core\Dal\ProfileDal;
use App\Data\Core\Model\Faq;
use App\Data\Core\Model\Profile;
use App\Data\Core\Model\ProfileExt;
use App\Data\Core\Model\UserRole;
use App\Data\Core\Model\UsersExt;
use App\Data\Helper\Assistant;
use App\Data\Helper\ProfileStateTypeList;
use App\Data\Helper\RoleList;
use App\Data\Helper\TranslationAttributeList;
use App\Data\Service\Model\ServiceExt;
use App\Data\Translation\Dal\TranslationDal;
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

class FaqDal
{
    const entityName = 'faq';

    const baseField = [
        'faq.*'
    ];

    public static function get($entityId, bool $translateData = false)
    {
        $entityList = Faq::where('faq.id', $entityId);

        TranslationDal::generateQuery(self::entityName, $entityList, self::baseField, $translateData);

        $result = $entityList->first();
        return $result;
    }


    public static function set($srcEntity)
    {
        try {
            DB::beginTransaction();

            $entity = empty($srcEntity->id) ? new Faq : (new Faq)->where('id', $srcEntity->id)->firstOrFail();
            $entity->question = $srcEntity->question;
            $entity->answer = $srcEntity->answer;
            $entity->is_moderate = $srcEntity->is_moderate;
            $entity->save();

            TranslationDal::setEntityTranslation(self::entityName, $entity->id, $srcEntity);

            DB::commit();
            return self::get($entity->id);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }


    public static function getList(bool $withPaginate, $translateData = false){
        $faqList = Faq::where('faq.id', '>', 0);
        TranslationDal::generateQuery(self::entityName, $faqList, ['faq.*'], false);
        if($withPaginate){
            return $faqList->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $faqList->get();
        }
    }

//    public static function getByName($userName)
//    {
//        $user = UsersExt::where('name', $userName)->first();
//        return $user;
//    }
//
//    public static function get($userId)
//    {
//        $user = UsersExt::where('id', $userId)->firstOrFail();
//        return $user;
//    }
//
//    /**
//     * Return users by role list
//     *
//     * @param $roleList
//     * @return mixed
//     */
//    public static function getListByRoles($roleList){
//        $users = UsersExt::whereIn('role_id',$roleList);
//        return $users;
//    }
//
//    /**
//     * @param $userId
//     * @param $isActive
//     */
//    public static function setUserActiveStatus($userId, $isActive){
//        $users = User::where('id', $userId)->firstOrFail();
//        $users->is_active = $isActive;
//        $users->updated_at = new \DateTime();
//        $users->save();
//    }
//
//    /**
//     * @param UsersExt $entity
//     * @return User|null
//     */
//    public static function insert (UsersExt $entity)
//    {
//        try {
//            DB::beginTransaction();
//
//            $profileExt = new ProfileExt();
//            $profileExt->full_name = $entity->name;
//            $profileExt->phone = '';
//            $profileExt->email = $entity->email;
//            $profileExt->password = Hash::make(Str::random(10));
//            $profileExt->profile_state_type_id = ProfileStateTypeList::Idividual;
//            $profileExt->is_resident = true;
//            $profileExt->role_id = $entity->role_id;
//            $profileExt->company_id = $entity->company_id;
//            $profileExt->manager_id = $entity->manager;
//            $profileExt->city_id = $entity->city_id;
//            $profileExt->country_name = $entity->country_name;
//            $profileExt->country_code = $entity->country_code;
//            $profileExt->city_name = $entity->city_name;
//
//            $users = ProfileDal::insert($profileExt);
//
//            DB::commit();
//
//            return $users;
//        }
//        catch (\Exception $e) {
//            DB::rollBack();
//            Log::error($e);
//            return null;
//        }
//    }
//
//
//    public static function update (UsersExt $entity)
//    {
//        try {
//            DB::beginTransaction();
//
//            $users = User::where('id', $entity->id)->firstOrFail();
//            $users->name = $entity->name;
//            $users->is_active = $entity->is_active;
//            $users->email = $entity->email;
//            $users->save();
//
//            //if($entity->is_active) {
//                $profileExt = new ProfileExt();
//                $profileExt->id = $entity->profile_id;
//                $profileExt->full_name = $entity->name;
//                $profileExt->phone = '';
//                $profileExt->email = $entity->email;
//                $profileExt->profile_state_type_id = ProfileStateTypeList::Idividual;
//                $profileExt->is_resident = true;
//                $profileExt->role_id = $entity->role_id;
//                $profileExt->manager_id = $entity->manager;
//
//                ProfileDal::update($profileExt);
//            //}
//            DB::commit();
//
//            return $users;
//        }
//        catch (\Exception $e) {
//            DB::rollBack();
//            Log::error($e);
//            return null;
//        }
//
//    }
//
//
//    public static function getByUserName($userName){
//        return User::where('name', $userName)->where('is_active', 1)->first();
//    }
//
//    public static function getByEmail($email){
//        return User::where('email', $email)->where('is_active', 1)->first();
//    }
//
//
//    public static function getByUserNameWithNoActiveCheck($userName){
//        return User::where('name', $userName)->first();
//    }
//
//
//    public static function getUserRole($userId){
//        return UserRole::where('user_id', $userId)->first();
//    }
//
//    public static function login($user){
//        ProfileDal::setLastLoginDate($user->id, new \DateTime());
//
//        switch(ProfileDal::getByUserId($user->id)->role_id){
//            case RoleList::Administrator :
//                return Redirect::intended(route('admin.users.list'));
//                break;
//            case RoleList::SaleManager:
//                return Redirect::intended(route('sale_manager.service.list'));
//            case RoleList::Curator:
//                return Redirect::intended(route('curator.review.list'));
//                break;
//            case RoleList::Manager:
//                return Redirect::intended(route('manager.services.list'));
//                break;
//            case RoleList::Executor:
//                return Redirect::intended(route('executor.project.list'));
//                break;
//            case RoleList::Client :
//            {
//                return Redirect::intended();
//                break;
//            }
//            case RoleList::Agent:
//                return Redirect::intended(route('agent.client.index'));
//                break;
//            case RoleList::Head:
//                return Redirect::intended(route('Report.index'));
//                break;
//            case RoleList::Accountant:
//                return Redirect::intended(route('Accountant.services'));
//                break;
//        }
//
//        return Redirect::intended();
//    }
//
//    public static function sendNewClientEmailToAdmin($newUser)
//    {
//        $userList = UserRole::where('role_id', RoleList::Administrator)->with('user')->get();
//        foreach ($userList as $admin){
//            if($admin->user->is_active) {
//                $admin->user->sendAdminNewClientEmail($newUser);
//            }
//        }
//    }
}
