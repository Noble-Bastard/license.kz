<?php

namespace App\Data\RegistrationForm\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\RegistrationForm\Model\RegistrationFormGroup
 *
 * @property int $id
 * @property int $registration_form_id
 * @property int $parameter_group_id
 * @property int $order_number
 * @property-read \App\Data\RegistrationFormTemplate\Model\ParameterGroup $parameterGroup
 * @property-read \App\Data\RegistrationForm\Model\RegistrationForm $registrationForm
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormGroup whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormGroup whereParameterGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormGroup whereRegistrationFormId($value)
 * @mixin \Eloquent
 */
class RegistrationFormGroup extends Model
{
    protected $table = 'registration_form_group';
    public $timestamps = false;

    protected $fillable = [
        'registration_form_id',
        'parameter_group_id',
        'order_number'
    ];
    protected $guarded = ['id'];

    public function parameterGroup()
    {
        return $this->hasOne('App\Data\RegistrationFormTemplate\Model\ParameterGroup','id','parameter_group_id');
    }

    public function registrationForm()
    {
        return $this->hasOne('App\Data\RegistrationForm\Model\RegistrationForm','id','registration_form_id');
    }
}
