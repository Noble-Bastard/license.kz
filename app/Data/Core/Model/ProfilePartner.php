<?php

namespace App\Data\Core\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Core\Model\ProfilePartner
 *
 * @property int id
 * @property int profile_id
 * @property string|null company_name
 * @property string|null company_site
 * @property string|null company_logo
 * @property string|null company_activity_field
 * @property string|null company_founder
 * @property string|null company_services
 * @property string|null company_projects
 * @property string|null company_awards

 * @mixin \Eloquent
 */
class ProfilePartner extends Model
{
    protected $table = 'profile_partner';

    public $timestamps = false;

    protected $fillable = [
        'profile_id',
        'company_name',
        'company_site',
        'company_logo',
        'company_activity_field',
        'company_founder',
        'company_services',
        'company_projects',
        'company_awards'
    ];

    protected $guarded = ['id'];

    public function profile()
    {
        return $this->hasOne('App\Data\Core\Model\Profile','id','profile_id')->with('city');
    }
}
