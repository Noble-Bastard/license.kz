<?php

namespace App\Data\Service\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Service\Model\City
 *
 * @property int $id
 * @property int $country_id
 * @property string $value
 * @mixin \Eloquent
 */
class City extends Model
{
    protected $table = 'city';
    public $timestamps = false;

    protected $fillable = [
        'country_id',
        'value'
    ];
    protected $guarded = ['id'];

    public function country()
    {
        return $this->hasOne('App\Data\Service\Model\Country','id', 'country_id');
    }
}
