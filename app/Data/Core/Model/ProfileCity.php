<?php

namespace App\Data\Core\Model;

use App\Data\Service\Model\City;
use Illuminate\Database\Eloquent\Model;


class ProfileCity extends Model
{
    protected $table = 'profile_city';

    public $timestamps = false;

    protected $fillable = [
        'profile_id',
        'city_id'
    ];

    protected $guarded = ['id'];

    public function profile()
    {
        return $this->hasOne(Profile::class,'id','profile_id')->with('city');
    }

    public function city()
    {
        return $this->hasOne(City::class,'id', 'city_id')->with('country');
    }
}
