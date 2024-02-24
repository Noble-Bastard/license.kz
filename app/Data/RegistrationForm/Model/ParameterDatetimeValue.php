<?php

namespace App\Data\RegistrationForm\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\RegistrationForm\Model\ParameterDatetimeValue
 *
 * @property int $id
 * @property int $registration_form_parameter_id
 * @property string $parameter_value
 * @property-read \App\Data\RegistrationForm\Model\RegistrationFormParameter $registrationFormParameter
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\ParameterDatetimeValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\ParameterDatetimeValue whereParameterValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\ParameterDatetimeValue whereRegistrationFormParameterId($value)
 * @mixin \Eloquent
 */
class ParameterDatetimeValue extends Model
{
    protected $table = 'parameter_datetime_value';
    public $timestamps = false;

    protected $fillable = [
        'registration_form_parameter_id',
        'parameter_value'
    ];
    protected $guarded = ['id'];


    public function registrationFormParameter()
    {
        return $this->hasOne('App\Data\RegistrationForm\Model\RegistrationFormParameter','id','registration_form_parameter_id');
    }
}
