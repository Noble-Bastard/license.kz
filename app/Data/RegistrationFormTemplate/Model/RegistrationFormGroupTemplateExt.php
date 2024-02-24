<?php

namespace App\Data\RegistrationFormTemplate\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\RegistrationFormTemplate\Model\RegistrationFormGroupTemplateExt
 *
 * @property int $id
 * @property int $registration_form_template_id
 * @property string|null $registration_form_template_name
 * @property int $parameter_group_id
 * @property string|null $parameter_group_name
 * @property int $order_number
 * @property-read \App\Data\RegistrationFormTemplate\Model\ParameterGroup $parameterGroup
 * @property-read \App\Data\RegistrationFormTemplate\Model\RegistrationFormTemplate $registrationFormTemplate
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormGroupTemplateExt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormGroupTemplateExt whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormGroupTemplateExt whereParameterGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormGroupTemplateExt whereParameterGroupName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormGroupTemplateExt whereRegistrationFormTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormGroupTemplateExt whereRegistrationFormTemplateName($value)
 * @mixin \Eloquent
 */
class RegistrationFormGroupTemplateExt extends Model
{

    protected $table = 'registration_form_group_template_ext';
    public $timestamps = false;

    protected $fillable = [
        'registration_form_template_id',
        'registration_form_template_name',
        'parameter_group_id',
        'parameter_group_name',
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
