<?php

namespace App\Data\Core\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Core\Model\ProfileLegal
 *
 * @property int $id
 * @property int $profile_id
 * @property string|null $company_name
 * @property string|null $business_identification_number
 * @property string|null $contact_person
 * @property string|null $position
 * @property string|null $scope_activity
 * @property-read \App\Data\Core\Model\Profile $profile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileLegal whereBusinessIdentificationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileLegal whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileLegal whereContactPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileLegal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileLegal wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileLegal whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\ProfileLegal whereScopeActivity($value)
 * @mixin \Eloquent
 */
class ProfileLegal extends Model
{
    protected $table = 'profile_legal';

    public $timestamps = false;

    protected $fillable = [
        'profile_id',
        'company_name',
        'business_identification_number',
        'contact_person',
        'position',
        'scope_activity'
    ];

    protected $guarded = ['id'];

    public function profile()
    {
        return $this->hasOne('App\Data\Core\Model\Profile','id','profile_id');
    }

    public function bankCodeType()
    {
        return $this->hasOne('App\Data\Core\Model\BankCodeType','id','bank_code_type_id');
    }


}
