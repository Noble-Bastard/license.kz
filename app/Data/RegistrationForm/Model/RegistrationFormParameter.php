<?php

namespace App\Data\RegistrationForm\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\RegistrationForm\Model\RegistrationFormParameter
 *
 * @property int $id
 * @property int|null $registration_form_group_id
 * @property int $parameter_type_id
 * @property string $caption
 * @property string|null $comment
 * @property string|null $parameter_formatted_value
 * @property int $order_number
 * @property int $registration_form_parameter_template_id
 * @property int $registration_form_id
 * @property-read \App\Data\RegistrationFormTemplate\Model\ParameterType $parameterType
 * @property-read \App\Data\RegistrationForm\Model\RegistrationForm $registrationForm
 * @property-read \App\Data\RegistrationForm\Model\RegistrationFormGroup $registrationFormGroup
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameter whereCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameter whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameter whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameter whereParameterFormattedValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameter whereParameterTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameter whereRegistrationFormGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameter whereRegistrationFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameter whereRegistrationFormParameterTemplateId($value)
 * @mixin \Eloquent
 */
class RegistrationFormParameter extends Model
{
    protected $table = 'registration_form_parameter';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'registration_form_group_id',
        'registration_form_id',
        'parameter_type_id',
        'caption',
        'comment',
        'parameter_formatted_value',
        'order_number'
    ];
    protected $guarded = ['id'];

    public function parameterType()
    {
        return $this->hasOne('App\Data\RegistrationFormTemplate\Model\ParameterType','id','parameter_type_id');
    }

    public function registrationFormGroup()
    {
        return $this->hasOne('App\Data\RegistrationForm\Model\RegistrationFormGroup','id','registration_form_group_id');
    }

    public function registrationForm()
    {
        return $this->hasOne('App\Data\RegistrationForm\Model\RegistrationForm','id','registration_form_id');
    }
}
