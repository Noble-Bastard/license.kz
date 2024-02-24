<?php

namespace App\Data\Company\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Company\Model\Company
 *
 * @property int $id
 * @property string $address
 * @property int $city_id
 * @property string $email
 * @property string $skype
 * @property string $phone
 * @property string $phone_1
 * @property string $fax
 * @property string $location
 * @property string beneficiary
 * @property string bank
 * @property string BIN
 * @property string IIK
 * @property string KBE
 * @property string BIK
 * @property string payment_code
 * @property string name
 * @property string photo_path
 *
 * @mixin \Eloquent
 */
class Company extends Model
{
    protected $table = 'company';
    public $timestamps = false;

    protected $fillable = [
        'address',
        'city_id',
        'email',
        'skype',
        'phone',
        'phone_1',
        'fax',
        'location',
        'beneficiary',
        'bank',
        'BIN',
        'IIK',
        'KBE',
        'BIK',
        'payment_code',
        'name',
        'photo_path'
    ];
    protected $guarded = ['id'];

    public function city()
    {
        return $this->hasOne('App\Data\Service\Model\City','id','city_id');
    }
}
