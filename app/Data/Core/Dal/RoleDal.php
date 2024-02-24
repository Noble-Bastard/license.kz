<?php

namespace App\Data\Core\Dal;

use App\Data\Core\Model\Role;
use App\Data\Core\Model\RoleType;
use App\Data\Helper\Assistant;
use App\Data\Helper\TranslationAttributeList;
use Illuminate\Support\Facades\DB;

class RoleDal
{
    public static function getList($translateData = false)
    {
        $entityList = Role::from('role as r')
            ->leftJoin('translation as tn', function ($join){
                $join->on('tn.pk_value','r.id')
                    ->where('tn.translation_attribute_id',TranslationAttributeList::RoleCaption)
                    ->where('tn.language_id', Assistant::getCurrentLanguageId());
            })
            ->orderBy('id', 'asc')
            ->get([
                'r.id',
                'r.name',
                'r.role_type_id',
                $translateData ? DB::raw("ifnull(tn.value, r.caption) as caption") :  'r.caption'
            ]);
        return $entityList;
    }


    public static function getRoleTypeList()
    {
        $entityList = RoleType::get();
        return $entityList;
    }

    public static function getByName($roleName, $translateData = false)
    {
        $role = Role::from('role as r')
            ->leftJoin('translation as tn', function ($join){
                $join->on('tn.pk_value','r.id')
                    ->where('tn.translation_attribute_id',TranslationAttributeList::RoleCaption)
                    ->where('tn.language_id', Assistant::getCurrentLanguageId());
            })
            ->where('name', $roleName)
            ->where('r.is_active', true)
            ->firstOrFail([
                'r.id',
                'r.name',
                'r.role_type_id',
                $translateData ? DB::raw("ifnull(tn.value, r.caption) as caption") :  'r.caption'
            ]);
        return $role;
    }

    public static function getByRoleType($roleTypeId, $translateData = false)
    {
        $roleList = Role::from('role as r')
            ->leftJoin('translation as tn', function ($join){
                $join->on('tn.pk_value','r.id')
                    ->where('tn.translation_attribute_id',TranslationAttributeList::RoleCaption)
                    ->where('tn.language_id', Assistant::getCurrentLanguageId());
            })
            ->where('is_active', true)
            ->where('r.role_type_id', $roleTypeId);


        return $roleList->get([
            'r.id',
            'r.name',
            'r.role_type_id',
            $translateData ? DB::raw("ifnull(tn.value, r.caption) as caption") :  'r.caption'
        ]);

    }

    public static function get($roleId, $translateData = false)
    {
        $role = Role::from('role as r')
            ->leftJoin('translation as tn', function ($join){
                $join->on('tn.pk_value','r.id')
                    ->where('tn.translation_attribute_id',TranslationAttributeList::RoleCaption)
                    ->where('tn.language_id', Assistant::getCurrentLanguageId());
            })
            ->where('id', $roleId)
            ->where('r.is_active', true)
            ->firstOrFail([
                'r.id',
                'r.name',
                'r.role_type_id',
                $translateData ? DB::raw("ifnull(tn.value, r.caption) as caption") :  'r.caption'
            ]);

        return $role;
    }

}
