<?php

namespace App\Data\Core\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Core\Model\Role
 *
 * @property int $id
 * @property string $name
 * @property integer $role_type_id
 * @property string $caption
 * @mixin \Eloquent
 */
class Role extends Model
{
    protected $table = 'role';

    public $timestamps = false;

    protected $guarded = ['id', 'name', 'role_type_id', 'caption'];


    public function roleType()
    {
        return $this->hasOne('App\Data\Core\Model\RoleType','id', 'role_type_id');
    }

}
