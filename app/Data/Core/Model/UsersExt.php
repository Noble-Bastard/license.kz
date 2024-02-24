<?php

namespace App\Data\Core\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Core\Model\UsersExt
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int|null $role_id
 * @property string|null $role_name
 * @property int $is_active
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\UsersExt whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\UsersExt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\UsersExt whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\UsersExt whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\UsersExt wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\UsersExt whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\UsersExt whereRoleName($value)
 * @mixin \Eloquent
 */
class UsersExt extends Model
{
    protected $table = 'users_ext';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'role_name',
        'is_active'
    ];

    protected $guarded = ['id'];
}
