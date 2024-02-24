<?php

namespace App\Data\RegistrationFormTemplate\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\RegistrationFormTemplate\Model\RegistrationFormTemplate
 *
 * @property int $id
 * @property int $counter_type_id
 * @property string $name
 * @property-read \App\Data\Core\Model\CounterType $counterType
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormTemplate whereCounterTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormTemplate whereName($value)
 * @mixin \Eloquent
 */
class RegistrationFormTemplate extends Model
{
    protected $table = 'registration_form_template';
    public $timestamps = false;

    protected $fillable = [
        'counter_type_id',
        'name'
    ];
    protected $guarded = ['id'];

    public function counterType()
    {
        return $this->hasOne('App\Data\Core\Model\CounterType','id','counter_type_id');
    }

}
