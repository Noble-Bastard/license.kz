<?php

namespace App\Data\RegistrationForm\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\RegistrationForm\Model\ParameterOptionsetValue
 *
 * @property int $id
 * @property int $registration_form_parameter_id
 * @property string $optionset_value
 * @property int $optionset_id
 * @property int $optionset_type_id
 * @property-read \App\Data\RegistrationForm\Model\RegistrationFormParameter $registrationFormParameter
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\ParameterOptionsetValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\ParameterOptionsetValue whereOptionsetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\ParameterOptionsetValue whereOptionsetTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\ParameterOptionsetValue whereOptionsetValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\ParameterOptionsetValue whereRegistrationFormParameterId($value)
 * @mixin \Eloquent
 */
class ParameterOptionsetValue extends Model
{
    protected $table = 'parameter_optionset_value';
    public $timestamps = false;

    protected $fillable = [
        'registration_form_parameter_id',
        'optionset_value',
        'optionset_id',
        'optionset_type_id'
    ];
    protected $guarded = ['id'];


    public function registrationFormParameter()
    {
        return $this->hasOne('App\Data\RegistrationForm\Model\RegistrationFormParameter','id','registration_form_parameter_id');
    }
}
