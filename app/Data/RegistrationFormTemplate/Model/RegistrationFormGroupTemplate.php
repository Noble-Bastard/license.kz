<?php

namespace App\Data\RegistrationFormTemplate\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\RegistrationFormTemplate\Model\RegistrationFormGroupTemplate
 *
 * @property int $id
 * @property int $registration_form_template_id
 * @property int $parameter_group_id
 * @property int $order_number
 * @property-read \App\Data\RegistrationFormTemplate\Model\ParameterGroup $parameterGroup
 * @property-read \App\Data\RegistrationFormTemplate\Model\RegistrationFormTemplate $registrationFormTemplate
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormGroupTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormGroupTemplate whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormGroupTemplate whereParameterGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormGroupTemplate whereRegistrationFormTemplateId($value)
 * @mixin \Eloquent
 */
class RegistrationFormGroupTemplate extends Model
{

    protected $table = 'registration_form_group_template';
    public $timestamps = false;

    protected $fillable = [
        'registration_form_template_id',
        'parameter_group_id',
        'order_number'
    ];
    protected $guarded = ['id'];

    public function parameterGroup()
    {
        return $this->hasOne('App\Data\RegistrationFormTemplate\Model\ParameterGroup','id','parameter_group_id');
    }

    public function registrationFormTemplate()
    {
        return $this->hasOne('App\Data\RegistrationFormTemplate\Model\RegistrationFormTemplate','id','registration_form_template_id');
    }

}
