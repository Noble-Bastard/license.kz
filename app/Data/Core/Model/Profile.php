<?php

namespace App\Data\Core\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Core\Model\Profile
 *
 * @property int $id
 * @property int $user_id
 * @property int $profile_state_type_id
 * @property string $phone
 * @property string $email
 * @property string|null $last_login_date
 * @property string $create_date
 * @property int|null $created_by
 * @property int $is_resident
 * @property string|null $full_name
 * @property int|null $photo_id
 * @property int|null $manager_id
 * @property int|null $is_active
 * @property int|null $company_id
 * @property int|null $city_id
 * @property-read \App\User $user

 * @mixin \Eloquent
 */
class Profile extends Model
{
    protected $table = 'profile';

    public $timestamps = false;

    protected $fillable = [
        'full_name',
        'user_id',
        'profile_state_type_id',
        'phone',
        'email',
        'last_login_date',
        'create_date',
        'created_by',
        'is_resident',
        'photo_id',
        'manager_id',
        'company_id',
        'city_id'
    ];

    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function city()
    {
        return $this->hasOne('App\Data\Service\Model\City','id', 'city_id')->with('country');
    }

    public function profileLegal()
    {
        return $this->hasOne('App\Data\Core\Model\ProfileLegal','profile_id','id')
            ->with('bankCodeType');
    }
}
