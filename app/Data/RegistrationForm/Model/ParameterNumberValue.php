<?php

namespace App\Data\RegistrationForm\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\RegistrationForm\Model\ParameterNumberValue
 *
 * @property int $id
 * @property int $registration_form_parameter_id
 * @property float $parameter_value
 * @property-read \App\Data\RegistrationForm\Model\RegistrationFormParameter $registrationFormParameter
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\ParameterNumberValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\ParameterNumberValue whereParameterValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\ParameterNumberValue whereRegistrationFormParameterId($value)
 * @mixin \Eloquent
 */
class ParameterNumberValue extends Model
{
    protected $table = 'parameter_number_value';
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
