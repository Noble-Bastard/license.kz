<?php

namespace App\Data\RegistrationForm\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\RegistrationForm\Model\RegistrationFormParameterExt
 *
 * @property int $id
 * @property int $registration_form_parameter_template_id
 * @property int|null $registration_form_group_id
 * @property int $registration_form_id
 * @property string|null $registration_form_form_number
 * @property string|null $registration_form_create_date
 * @property int|null $service_journal_id
 * @property int|null $parameter_group_id
 * @property string|null $parameter_group_name
 * @property int $parameter_type_id
 * @property string|null $parameter_type_name
 * @property string|null $parameter_type_data_type
 * @property string $caption
 * @property string|null $comment
 * @property int $order_number
 * @property string|null $parameter_formatted_value
 * @property float|null $parameter_number_value
 * @property string|null $parameter_datetime_value
 * @property int|null $parameter_bool_value
 * @property int|null $parameter_optionset_id
 * @property int|null $parameter_optionset_type_id
 * @property string|null $parameter_optionset_value
 * @property string|null $parameter_optionset_type_name
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
 * @property-read \App\Data\RegistrationForm\Model\RegistrationFormGroup $registrationFormGroup
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereOptionsetIdList($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereOptionsetValueList($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereParameterBoolValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereParameterDatetimeDefaultValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereParameterDatetimeFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereParameterDatetimeValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereParameterFormattedValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereParameterGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereParameterGroupName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereParameterNumberDefaultValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereParameterNumberMaxValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereParameterNumberMinValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereParameterNumberRoundType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereParameterNumberValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereParameterOptionsetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereParameterOptionsetTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereParameterOptionsetTypeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereParameterOptionsetValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereParameterTextDefaultValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereParameterTextValidationMask($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereParameterTypeDataType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereParameterTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereParameterTypeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereRegistrationFormCreateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereRegistrationFormFormNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereRegistrationFormGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereRegistrationFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereRegistrationFormParameterTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationFormParameterExt whereServiceJournalId($value)
 * @mixin \Eloquent
 */
class RegistrationFormParameterExt extends Model
{
    protected $table = 'registration_form_parameter_ext';
    public $timestamps = false;

    protected $fillable = [
        'caption',
        'comment',
        'order_number',
        'service_journal_id',
        'registration_form_parameter_template_id',
        'registration_form_id',
        'registration_form_form_number',
        'registration_form_create_date',
        'registration_form_group_id',
        'parameter_group_id',
        'parameter_group_name',
        'parameter_type_id',
        'parameter_type_name',
        'parameter_type_data_type',
        'parameter_formatted_value',
        'parameter_text_validation_mask',
        'parameter_text_default_value',
        'parameter_number_value',
        'parameter_number_default_value',
        'parameter_number_round_type',
        'parameter_number_min_value',
        'parameter_number_max_value',
        'parameter_datetime_value',
        'parameter_datetime_format',
        'parameter_datetime_default_value',
        'parameter_optionset_id',
        'parameter_optionset_value',
        'optionset_id_list',
        'optionset_value_list',
        'parameter_optionset_type_id',
        'parameter_optionset_type_name',
        'parameter_bool_value'
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
}
