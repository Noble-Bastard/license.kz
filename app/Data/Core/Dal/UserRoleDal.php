<?php

namespace App\Data\Core\Dal;

use App\Data\Core\Model\Role;
use App\Data\Core\Model\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserRoleDal
{
    public static function isUserInRole($roleId)
    {
        $userRole = UserRole::where('user_id', Auth::user()->id)
            ->where('role_id', $roleId)->get();

        return !$userRole->isEmpty();
    }

    /**
     * Insert UserRole
     *
     * @param $user_id
     * @param $role_id
     * @param $created_by
     * @return UserRole
     */
    public static function insert ($user_id, $role_id)
    {
        $userRole = new UserRole;
        $userRole->user_id = $user_id;
        $userRole->role_id = $role_id;
        $userRole->created_by = null;
        $userRole->save();
        return $userRole;
    }

    public static function update ($user_id, $role_id)
    {
        $userRole = UserRole::where('user_id', $user_id)->first();
        $userRole->role_id = $role_id;
        $userRole->save();
        return $userRole;
    }


}
