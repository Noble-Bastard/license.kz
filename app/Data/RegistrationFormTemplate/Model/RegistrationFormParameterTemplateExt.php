<?php

namespace App\Data\RegistrationFormTemplate\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt
 *
 * @property int $id
 * @property int|null $registration_form_template_id
 * @property int|null $registration_form_group_template_id
 * @property string|null $registration_form_group_template_name
 * @property int|null $registration_form_group_template_order_number
 * @property int $parameter_type_id
 * @property string|null $parameter_type_name
 * @property string|null $parameter_type_data_type
 * @property string $caption
 * @property int $is_active
 * @property string|null $comment
 * @property int $order_number
 * @property int|null $optionset_type_id
 * @property string|null $optionset_type_name
 * @property string|null $optionset_id_list
 * @property string|null $optionset_value_list
 * @property string|null $parameter_datetime_format
 * @property string|null $parameter_datetime_default_value
 * @property float|null $parameter_number_max_value
 * @property float|null $parameter_number_min_value
 * @property int|null $parameter_number_round_type
 * @property float|null $parameter_number_default_value
 * @property string|null $parameter_text_validation_mask
 * @property string|null $parameter_text_default_value
 * @property-read \App\Data\RegistrationFormTemplate\Model\ParameterType $parameterType
 * @property-read \App\Data\RegistrationFormTemplate\Model\RegistrationFormGroupTemplate $registrationFormGroupTemplate
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt whereCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt whereOptionsetIdList($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt whereOptionsetTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt whereOptionsetTypeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt whereOptionsetValueList($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt whereParameterDatetimeDefaultValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt whereParameterDatetimeFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt whereParameterNumberDefaultValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt whereParameterNumberMaxValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt whereParameterNumberMinValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt whereParameterNumberRoundType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt whereParameterTextDefaultValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt whereParameterTextValidationMask($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt whereParameterTypeDataType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt whereParameterTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt whereParameterTypeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt whereRegistrationFormGroupTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt whereRegistrationFormGroupTemplateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt whereRegistrationFormGroupTemplateOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationFormTemplate\Model\RegistrationFormParameterTemplateExt whereRegistrationFormTemplateId($value)
 * @mixin \Eloquent
 */
class RegistrationFormParameterTemplateExt extends Model
{

    protected $table = 'registration_form_parameter_template_ext';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'registration_form_template_id',
        'registration_form_group_template_id',
        'registration_form_group_template_name',
        'registration_form_group_template_order_number',
        'parameter_type_id',
        'parameter_type_name',
        'parameter_type_data_type',
        'caption',
        'is_active',
        'comment',
        'order_number',
        'optionset_type_id',
        'optionset_type_name',
        'optionset_id_list',
        'optionset_value_list',
        'parameter_datetime_format',
        'parameter_datetime_default_value',
        'parameter_number_max_value',
        'parameter_number_min_value',
        'parameter_number_round_type',
        'parameter_number_default_value',
        'parameter_text_validation_mask',
        'parameter_text_default_value'
    ];
    protected $guarded = ['id'];


    public function parameterType()
    {
        return $this->hasOne('App\Data\RegistrationFormTemplate\Model\ParameterType','id','parameter_type_id');
    }

    public function registrationFormGroupTemplate()
    {
        return $this->hasOne('App\Data\RegistrationFormTemplate\Model\RegistrationFormGroupTemplate','id','registration_form_group_template_id');
    }
}
