<?php namespace App\Data\Core\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Core\Model\CounterType
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\CounterType whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\CounterType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Core\Model\CounterType whereName($value)
 * @mixin \Eloquent
 */
class CounterType extends Model {

    protected $table = 'counter_type';

    public $timestamps = false;

    protected $fillable = ['code','name'];

    protected $guarded = ['id'];

}
