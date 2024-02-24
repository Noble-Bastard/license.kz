<?php

namespace App\Data\Core\Model;

use App\Data\Service\Model\City;
use App\Data\Service\Model\LicenseType;
use Illuminate\Database\Eloquent\Model;


class ProfileLicenseType extends Model
{
    protected $table = 'profile_license_type';

    public $timestamps = false;

    protected $fillable = [
        'profile_id',
        'license_type_id'
    ];

    protected $guarded = ['id'];

    public function profile()
    {
        return $this->hasOne(Profile::class,'id','profile_id');
    }

    public function licenseType()
    {
        return $this->hasOne(LicenseType::class,'id','license_type_id');
    }
}
