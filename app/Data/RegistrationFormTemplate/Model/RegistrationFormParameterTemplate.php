<?php

namespace App\Data\RegistrationFormTemplate\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplate
 *
 * @property int $id
 * @property int|null $registration_form_group_template_id
 * @property int $parameter_type_id
 * @property string $caption
 * @property int $is_active
 * @property string|null $comment
 * @property int $order_number
 * @property int|null $optionset_type_id
 * @mixin \Eloquent
 */
class RegistrationFormParameterTemplate extends Model
{
    protected $table = 'registration_form_parameter_template';
    public $timestamps = false;

    protected $fillable = [
        'registration_form_group_template_id',
        'parameter_type_id',
        'caption',
        'is_active',
        'comment',
        'order_number',
        'optionset_type_id',
    ];
    protected $guarded = ['id'];


    public function parameterType()
    {
        return $this->hasOne('App\Data\RegistrationFormTemplate\Model\ParameterType','id','parameter_type_id');
    }

    public function optionsetType()
    {
        return $this->hasOne('App\Data\RegistrationFormTemplate\Model\OptionsetType','id','optionset_type_id');
    }

    public function registrationFormGroupTemplate()
    {
        return $this->hasOne('App\Data\RegistrationFormTemplate\Model\RegistrationFormGroupTemplate','id','registration_form_group_template_id');
    }
}
