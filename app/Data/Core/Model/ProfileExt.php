<?php

namespace App\Data\Core\Model;

use App\Data\Service\Model\LicenseType;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Core\Model\ProfileExt
 *
 * @property int $id
 * @property string|null $full_name
 * @property int $user_id
 * @property string|null $user_name
 * @property int|null $role_id
 * @property string|null $role_name
 * @property int|null $is_active
 * @property string $phone
 * @property string $email
 * @property string|null $last_login_date
 * @property string $create_date
 * @property int|null $created_by
 * @property int $is_resident
 * @property int $profile_state_type_id
 * @property string|null $profile_state_type_name
 * @property int|null $profile_legal_id
 * @property string|null $company_name
 * @property string|null $business_identification_number
 * @property string|null $contact_person
 * @property string|null $position
 * @property string|null $scope_activity
 * @property int|null $photo_id
 * @property string|null $photo_path
 * @property int|null $manager_id
 * @property string|null $manager_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileExt whereBusinessIdentificationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileExt whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileExt whereContactPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileExt whereCreateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileExt whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileExt whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileExt whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileExt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileExt whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileExt whereIsResident($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileExt whereLastLoginDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileExt whereManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileExt whereManagerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileExt wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileExt wherePhotoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileExt wherePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileExt wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileExt whereProfileLegalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileExt whereProfileStateTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileExt whereProfileStateTypeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileExt whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileExt whereRoleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileExt whereScopeActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileExt whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileExt whereUserName($value)
 * @mixin \Eloquent
 */
class ProfileExt extends Model
{
    protected $table = 'profile_ext';

    public $timestamps = false;

    protected $fillable = [
        'full_name',
        'user_id',
        'user_name',
        'role_id',
        'role_name',
        'is_active',
        'phone',
        'email',
        'last_login_date',
        'create_date',
        'created_by',
        'is_resident',
        'profile_legal_id',
        'profile_state_type_id',
        'profile_state_type_name',
        'company_legal_name',
        'company_name',
        'business_identification_number',
        'contact_person',
        'position',
        'scope_activity',
        'photo_id',
        'photo_path',
        'manager_id',
        'manager_name',
        'company_id',
        'city_id'
    ];

    protected $guarded = ['id'];

    public function cites()
    {
        return $this->hasMany(ProfileCity::class, 'profile_id', 'id')->with('city.country');
    }

    public function licenseTypeList()
    {
        return $this->hasMany(ProfileLicenseType::class, 'profile_id', 'id')->with('licenseType');
    }
}
