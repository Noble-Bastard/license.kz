<?php namespace App\Data\Core\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Core\Model\Counter
 *
 * @property int $id
 * @property int $counter_type_id
 * @property string $mask
 * @property int $length
 * @property int $increase
 * @property int $sequence
 * @property int $country_id
 * @mixin \Eloquent
 */
class Counter extends Model {

    protected $table = 'counter';

    public $timestamps = false;

    protected $fillable = [
        'counter_type_id',
        'mask',
        'length',
        'increase',
        'sequence',
        'country_id',
    ];

    protected $guarded = ['id'];


    public function counterType()
    {
        return $this->hasOne('App\Data\Core\Model\CounterType','id','counter_type_id');
    }

    public function country()
    {
        return $this->hasOne('App\Data\Service\Model\Country','id','country_id');
    }

}
