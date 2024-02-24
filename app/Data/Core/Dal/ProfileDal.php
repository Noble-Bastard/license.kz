<?php

namespace App\Data\Core\Dal;

use App\Data\Core\Model\Client;
use App\Data\Core\Model\Profile;
use App\Data\Core\Model\ProfileCity;
use App\Data\Core\Model\ProfileExt;
use App\Data\Core\Model\ProfileLegal;
use App\Data\Core\Model\ProfileLicenseType;
use App\Data\Core\Model\ProfilePartner;
use App\Data\Core\Model\UserRole;
use App\Data\Document\Dal\DocumentDal;
use App\Data\Document\Model\Document;
use App\Data\Helper\Assistant;
use App\Data\Helper\DocumentTypeList;
use App\Data\Helper\ProfileStateTypeList;
use App\Data\Helper\RoleList;
use App\Data\Helper\RoleTypeList;
use App\Data\Helper\TranslationAttributeList;
use App\Data\Service\Dal\CityDal;
use App\Data\Service\Dal\CountryDal;
use App\Data\Subsciption\Dal\EventSubscriptionDal;
use App\Data\Translation\Dal\TranslationDal;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProfileDal
{
    public static function getList()
    {
        $profiles = ProfileExt::get();
        return $profiles;
    }

    public static function get($profileId)
    {
        $user = ProfileExt::where('id', $profileId)->firstOrFail();
        return $user;
    }

    public static function getSimpleEntityByUserId($userId)
    {
        $profile= Profile::where('user_id', $userId)->first();
        return $profile;
    }

    public static function getByUserId($userId)
    {
        $user = ProfileExt::where('user_id', $userId)->firstOrFail();
        return $user;
    }

    /**
     * @param $roleList
     * @param bool $withPaginate
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
     */
    public static function getListByRoles($roleList, bool $withPaginate, $searchText = null, $translateData = false){
        $users = ProfileExt::from('profile_ext as pe')
            ->leftJoin('role as r', function ($join){
                $join->on('r.id','pe.role_id');
            })
            ->leftJoin('translation as tn', function ($join){
                $join->on('tn.pk_value','pe.role_id')
                    ->where('tn.translation_attribute_id',TranslationAttributeList::RoleCaption)
                    ->where('tn.language_id', Assistant::getCurrentLanguageId());
            })
            ->whereIn('role_id',$roleList);

        if(!is_null($searchText))
        {
            $users->where(function($query) use ($searchText){
                $query->orWhere('full_name', 'like', '%' . $searchText . '%')
                    ->orWhere('user_name', 'like', '%' . $searchText . '%')
                    ->orWhere('email', 'like', '%' . $searchText . '%');
            });
        }

        if($withPaginate){
            return $users->select([
                'pe.*',
                $translateData ? DB::raw("ifnull(tn.value, r.caption) as role_caption") : 'r.caption as role_caption'
            ])->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $users->get([
                'pe.*',
                $translateData ? DB::raw("ifnull(tn.value, r.caption) as role_caption") : 'r.caption as role_caption'
            ]);
        }
    }


    public static function getListByRoleType($roleTypeId, bool $withPaginate, $searchText = null, $translateData = false){
        $users = ProfileExt::from('profile_ext as pe')
            ->join('role as r',function($join) use($roleTypeId){
                $join->on('r.id','=','pe.role_id')
                    ->where('r.role_type_id', $roleTypeId);
            })
            ->leftJoin('translation as tn', function ($join){
                $join->on('tn.pk_value','pe.role_id')
                    ->where('tn.translation_attribute_id',TranslationAttributeList::RoleCaption)
                    ->where('tn.language_id', Assistant::getCurrentLanguageId());
            });

        if(!is_null($searchText))
        {
            $users->where(function($query) use ($searchText){
                $query->orWhere('pe.full_name', 'like', '%' . $searchText . '%')
                    ->orWhere('pe.user_name', 'like', '%' . $searchText . '%')
                    ->orWhere('pe.email', 'like', '%' . $searchText . '%');
            });
        }

        if($withPaginate){
            return $users->select([
                'pe.*',
                $translateData ? DB::raw("ifnull(tn.value, r.caption) as role_caption") : 'r.caption as role_caption'
            ])->paginate(15);
        } else {
            return $users->get([
                'pe.*',
                $translateData ? DB::raw("ifnull(tn.value, r.caption) as role_caption") : 'r.caption as role_caption'
            ]);
        }
    }

    public static function getListByRolesAndManager($roleList, $manegerId, bool $withPaginate){
        $users = ProfileExt::whereIn('role_id',$roleList)
            ->where('manager_id', $manegerId);

        if($withPaginate){
            return $users->paginate(15);
        } else {
            return $users->get();
        }
    }


    /**
     * insert new profile
     *
     * @param ProfileExt $profileExt
     * @return User
     * @throws \Exception
     */
    public static function insert(ProfileExt $profileExt)
    {
        try {
            DB::beginTransaction();

            $user = User::query()->where('email', $profileExt["email"])->first();
            if($user){
              return $user;
            }

            $user = User::create([
                'name' => $profileExt["full_name"],
                'email' => $profileExt["email"],
                'password' => bcrypt($profileExt['password']),
            ]);

            //assign userRole
            UserRoleDal::insert(
                $user["id"],
                $profileExt["role_id"]
            );

            if($profileExt["role_id"] === 3){
                (new EventSubscriptionDal())->subscipt($profileExt["full_name"], $profileExt["email"]);
            }

            $cityId = $profileExt["city_id"];

            if($profileExt["role_id"] == RoleList::Partner && $cityId == -1){
                $country = CountryDal::getByCodeOrCreate($profileExt["country_code"], $profileExt["country_name"]);
                $city = CityDal::getByName($profileExt["city_name"], $country->id);

                $cityId = $city->id;
            }

            //insert profile
            $profile = new Profile();
            $profile->full_name = $profileExt["full_name"];
            $profile->user_id = $user["id"];
            $profile->phone =$profileExt["phone"];
            $profile->email = $profileExt["email"];
            $profile->profile_state_type_id = $profileExt["profile_state_type_id"];
            $profile->is_resident = $profileExt["is_resident"];
            $profile->created_by = null;
            $profile->manager_id = $profileExt["manager_id"];
            $profile->company_id = $profileExt["company_id"];
            $profile->city_id = $cityId;
            $profile->save();

            if($profileExt->profile_state_type_id == ProfileStateTypeList::LegalPerson)
            {
                $profileLegal = new ProfileLegal();
                $profileLegal->profile_id = $profile->id;
                $profileLegal->company_name = $profileExt["full_name"];
                $profileLegal->business_identification_number = $profileExt["business_identification_number"];
                $profileLegal->contact_person = $profileExt["contact_person"];
                $profileLegal->position = $profileExt["position"];
                $profileLegal->scope_activity = $profileExt["scope_activity"];
                $profileLegal->bank_code_type_id = $profileExt["bank_code_type_id"];
                $profileLegal->bank_code = $profileExt["bank_code"];
                $profileLegal->director_name = $profileExt["director_name"];
                $profileLegal->legal_address = $profileExt["legal_address"];
                $profileLegal->save();
            }

            DB::commit();

            UserDal::sendNewClientEmailToAdmin($user);

            if($profileExt["send_pass"]){
                $user->sendWelcomeWithPassEmail($profileExt['password']);
            } else {
                $user->sendWelcomeEmail();
            }

            return $user;

        } catch
        (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }


    /**
     * update profile
     *
     * @param ProfileExt $profileExt
     * @return null
     */
    public static function update(ProfileExt $profileExt)
    {
        try {

            $curProfile = self::get($profileExt->id);
            $profileExt->user_id = $curProfile->user_id;

            DB::beginTransaction();

            //update userRole
            UserRoleDal::update(
                $profileExt->user_id,
                $profileExt->role_id
            );

            //update profile
            $profile = Profile::where('id', $profileExt->id)->first();
            $profile->full_name = $profileExt->full_name;
            $profile->user_id = $profileExt->user_id;
            $profile->phone =$profileExt->phone;
            $profile->email = $profileExt->email;
            $profile->is_resident = $profileExt->is_resident;
            $profile->manager_id = $profileExt["manager_id"];
            $profile->save();

            if($profile->profile_state_type_id == ProfileStateTypeList::LegalPerson)
            {
                $profileLegal = ProfileLegal::where('profile_id', $profileExt->id)->first();
                $profileLegal->company_name = $profileExt->company_legal_name;
                $profileLegal->business_identification_number = $profileExt->business_identification_number;
                $profileLegal->contact_person = $profileExt->contact_person;
                $profileLegal->position = $profileExt->position;
                $profileLegal->scope_activity = $profileExt->scope_activity;
                $profileLegal->save();
            }

            DB::commit();

            return self::get($profile->id);

        } catch
        (Exception $e) {
            DB::rollBack();
            Log::error($e);
            return null;
        }
    }

    public static function delete($profileId)
    {
        try {

            $curProfile = self::get($profileId);

            DB::beginTransaction();

            UserDal::setUserActiveStatus($curProfile->user_id,false);

            DB::commit();

            return true;

        } catch
        (Exception $e) {
            DB::rollBack();
            Log::error($e);
            return null;
        }
    }

    /**
     * Set profile last login date
     *
     * @param $userId
     * @param $lastLoginDate
     */
    public static function setLastLoginDate($userId, $lastLoginDate)
    {
        $profile = Profile::where('user_id', $userId)->first();
        $profile->last_login_date = $lastLoginDate;
        $profile->save();
    }


    /**
     * Set profile photo
     *
     * @param $profileId
     * @param Document $photo
     * @return Document|null
     */
    public static function setProfilePhoto($profileId, Document $photo )
    {

        //TODO file replace logic (remove previouse file, store new)

        try {
            DB::beginTransaction();

            $profile = Profile::where('id', $profileId)->firstOrFail();
            $photo->id = $profile->photo_id;
            $photo->document_type_id = DocumentTypeList::ProfilePhoto;
            $savedDocument = DocumentDal::set($photo);
            $profile->photo_id = $savedDocument->id;
            $profile->save();

            DB::commit();

            return $photo;

        } catch
        (Exception $e) {
            DB::rollBack();
            Log::error($e);
            return null;
        }
    }


    public static function getCountClient($country, $start_date, $end_date){
        $users_count = ProfileExt::where('role_id',\App\Data\Helper\RoleList::Client)
            ->whereBetween('create_date', [$start_date, $end_date])
            ->count();
        return $users_count;
    }

    public static function setAgent($profileId, $agentId)
    {
        $client = Client::where('profile_id', $profileId)->first();
        if(is_null($client)){
            $client = new Client();
            $client->profile_id = $profileId;
        }

        $client->agent_id = $agentId;
        $client->save();

        return $client;
    }

    public static function getListWithAgentInfo(bool $withPaginate, $searchText = null, $translateData = false)
    {
        $roleTypeId = RoleTypeList::External;

        $users = ProfileExt::from('profile_ext as pe')
            ->join('role as r',function($join) use($roleTypeId){
                $join->on('r.id','=','pe.role_id')
                    ->where('r.role_type_id', $roleTypeId);
            })
            ->leftJoin('translation as tn', function ($join){
                $join->on('tn.pk_value','pe.role_id')
                    ->where('tn.translation_attribute_id',TranslationAttributeList::RoleCaption)
                    ->where('tn.language_id', Assistant::getCurrentLanguageId());
            })
            ->leftJoin('client', 'client.profile_id', '=', 'pe.id')
            ->leftJoin('profile as agent', 'client.agent_id', '=', 'agent.id');


        if(!is_null($searchText))
        {
            $users->where(function($query) use ($searchText){
                $query->orWhere('pe.full_name', 'like', '%' . $searchText . '%')
                    ->orWhere('pe.user_name', 'like', '%' . $searchText . '%')
                    ->orWhere('pe.email', 'like', '%' . $searchText . '%');
            });
        }

        $users = $users->select([
            'pe.*',
            'client.agent_id',
            'agent.full_name as agent_name',
            $translateData ? DB::raw("ifnull(tn.value, r.caption) as role_caption") : 'r.caption as role_caption'
        ]);

        if($withPaginate){
            return $users->paginate(15);
        } else {
            return $users->get();
        }
    }

    public static function getListByAgent($agentId, bool $withPaginate)
    {
        $roleTypeId = RoleTypeList::External;

        $users = ProfileExt::from('profile_ext as pe')
            ->join('role as r', function($join) use($roleTypeId){
                $join->on('r.id','=','pe.role_id')
                    ->where('r.role_type_id', $roleTypeId);
            })
            ->join('client', function($join) use ($agentId){
                $join->on('client.profile_id', 'pe.id')
                    ->where('client.agent_id', $agentId);
            });

        $users = $users->select([
            'pe.*'
        ]);

        if($withPaginate){
            return $users->paginate(15);
        } else {
            return $users->get();
        }
    }


    public static function getEmailsByHeadRole() : string
    {
        $heads = ProfileExt::where('role_id',RoleList::Head)
            ->get();

        return  $heads->implode('email', ';');
    }

    public static function getPartnerData($profileId, bool $translateData = false)
    {
        $entityName = 'profile_partner';
        $baseFields = [
            'profile_partner.id',
            'profile_partner.profile_id',
            'profile_partner.company_name',
            'profile_partner.company_site',
            'profile_partner.company_logo',
            'profile_partner.company_activity_field',
            'profile_partner.company_founder',
            'profile_partner.company_services',
            'profile_partner.company_projects',
            'profile_partner.company_awards'
        ];

        $entity = ProfilePartner::where('profile_partner.profile_id', $profileId);
        TranslationDal::generateQuery($entityName, $entity, $baseFields, $translateData);

        return $entity->first();
    }


    public static function getPartnerDataById($Id, bool $translateData = false)
    {
        $entityName = 'profile_partner';
        $baseFields = [
            'profile_partner.id',
            'profile_partner.profile_id',
            'profile_partner.company_name',
            'profile_partner.company_site',
            'profile_partner.company_logo',
            'profile_partner.company_activity_field',
            'profile_partner.company_founder',
            'profile_partner.company_services',
            'profile_partner.company_projects',
            'profile_partner.company_awards'
        ];

        $entity = ProfilePartner::where('profile_partner.id', $Id);
        TranslationDal::generateQuery($entityName, $entity, $baseFields, $translateData);

        return $entity->first();
    }

    public static function setPartnerData(ProfilePartner $profilePartner)
    {

        $entity = ProfilePartner::where('profile_id', $profilePartner->profile_id)->first();
        if($entity == null){
            $entity = new ProfilePartner();
        }

        $entity->profile_id = $profilePartner->profile_id;
        $entity->company_name = $profilePartner->company_name;
        $entity->company_site = $profilePartner->company_site;
        $entity->company_logo = $profilePartner->company_logo;
        $entity->company_activity_field = $profilePartner->company_activity_field;
        $entity->company_founder = $profilePartner->company_founder;
        $entity->company_services = $profilePartner->company_services;
        $entity->company_projects = $profilePartner->company_projects;
        $entity->company_awards = $profilePartner->company_awards;

        $entity->save();

        TranslationDal::setEntityTranslation('profile_partner', $entity->id, $profilePartner);

        return $entity;
    }

    public static function getPartnerList(bool $translateData = false)
    {
        $entityName = 'profile_partner';
        $baseFields = [
            'profile_partner.id',
            'profile_partner.profile_id',
            'profile_partner.company_name',
            'profile_partner.company_site',
            'profile_partner.company_logo',
            'profile_partner.company_activity_field',
            'profile_partner.company_founder',
            'profile_partner.company_services',
            'profile_partner.company_projects',
            'profile_partner.company_awards'
        ];
        $entity = ProfilePartner::with(['profile']);
        TranslationDal::generateQuery($entityName, $entity, $baseFields, $translateData);

        return $entity->get();
    }

    public static function setProfileCity($id, $cityId)
    {
        $profile = ProfileDal::getByUserId($id);

        $profileCity = new ProfileCity();
        $profileCity->profile_id = $profile->id;
        $profileCity->city_id = $cityId;
        $profileCity->save();

        return $profileCity;
    }

    public static function deleteProfileCity($id){
        ProfileCity::where('id', $id)->delete();
    }

    public static function setProfileLicenseType($id, $licenseTypeId)
    {
        $profile = ProfileDal::getByUserId($id);

        $profileLicenseType = new ProfileLicenseType();
        $profileLicenseType->profile_id = $profile->id;
        $profileLicenseType->license_type_id = $licenseTypeId;
        $profileLicenseType->save();

        return $profileLicenseType;
    }

    public static function deleteProfileLicenseType($id){
        ProfileLicenseType::where('id', $id)->delete();
    }
}
