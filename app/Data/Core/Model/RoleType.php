<?php

namespace App\Data\Core\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Core\Model\RoleType
 *
 * @property int $id
 * @property string $name
 * @mixin \Eloquent
 */
class RoleType extends Model
{
    protected $table = 'role_type';

    public $timestamps = false;

    protected $guarded = ['id', 'name'];

}
