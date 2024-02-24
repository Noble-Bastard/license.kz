<?php

namespace App\Data\Core\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Core\Model\UserRole
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $role_id
 * @property string $create_date
 * @property int|null $created_by
 * @property-read \App\Data\Core\Model\Role $role
 * @property-read \App\User $user
 * @mixin \Eloquent
 */
class UserRole extends Model
{
    protected $table = 'user_role';

    public $timestamps = false;

    protected $fillable = ['user_id', 'role_id', 'create_date', 'created_by'];

    protected $guarded = ['id'];

    public function role()
    {
        return $this->hasOne('App\Data\Core\Model\Role','id','role_id');
    }

    public function user()
    {
        return $this->hasOne('App\User','id', 'user_id');
    }
}
